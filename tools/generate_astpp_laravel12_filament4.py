import re, shutil, zipfile
from pathlib import Path
from datetime import datetime, timezone

SQL_PATH = Path('/mnt/data/astpp_schema.sql')
OUT = Path('/mnt/data/astpp_laravel12_filament4_fresh_overlay')
ZIP = Path('/mnt/data/astpp_laravel12_filament4_fresh_overlay.zip')
if OUT.exists(): shutil.rmtree(OUT)
OUT.mkdir(parents=True)
SQL = SQL_PATH.read_text(errors='ignore')

def studly(s:str)->str:
    return ''.join(p[:1].upper()+p[1:] for p in re.split(r'[^A-Za-z0-9]+', s) if p)

def camel(s:str)->str:
    x=studly(s)
    return x[:1].lower()+x[1:] if x else s

SPECIAL = {
 'accounts':'Account','cdrs':'Cdr','dids':'Did','ci_sessions':'CiSession','roles_and_permission':'RolePermission',
 'accounts_callerid':'AccountCallerid','freeswich_servers':'FreeswichServer','sip_profiles':'SipProfile','sip_devices':'SipDevice',
 'countrycode':'CountryCode','q850code':'Q850Code','ratedeck':'Ratedeck','calltype':'Calltype','sweeplist':'Sweeplist',
 'system':'SystemSetting','ani_map':'AniMap','ip_map':'IpMap','userlevels':'Userlevel','pricelists':'Pricelist',
}
def singular(table:str)->str:
    if table in SPECIAL: return SPECIAL[table]
    if table.endswith('ies'): return studly(table[:-3]+'y')
    if table.endswith('s') and not table.endswith('ss'): return studly(table[:-1])
    return studly(table)

def label(s): return s.replace('_',' ').title().replace(' Id',' ID').replace('Ip','IP').replace('Cdr','CDR').replace('Sip','SIP')

schemas={}
for m in re.finditer(r'CREATE TABLE `([^`]+)` \((.*?)\) ENGINE=', SQL, flags=re.S):
    table=m.group(1); body=m.group(2)
    cols=[]; pk=[]; unique=[]; indexes=[]
    for raw in body.splitlines():
        line=raw.strip().rstrip(',')
        if not line: continue
        if line.startswith('`'):
            mm=re.match(r'`([^`]+)`\s+([^\s,]+)(.*)', line)
            if mm:
                name,typ,rest=mm.group(1),mm.group(2).lower(),mm.group(3)
                cols.append({'name':name,'type':typ,'rest':rest})
        elif line.startswith('PRIMARY KEY'):
            pk=re.findall(r'`([^`]+)`', line)
        elif line.startswith('UNIQUE KEY'):
            unique.append(re.findall(r'`([^`]+)`', line))
        elif line.startswith('KEY'):
            indexes.append(re.findall(r'`([^`]+)`', line))
    schemas[table]={'columns':cols,'primary':pk,'unique':unique,'indexes':indexes}

model={t:singular(t) for t in schemas}

def primary(table):
    p=schemas[table]['primary']
    return p[0] if len(p)==1 else 'id'

def colnames(table): return [c['name'] for c in schemas[table]['columns']]

def has_col(table,col): return col in colnames(table)

# Inferred relationship targets, based on ASTPP names
TARGETS={
 'accountid':'accounts','account_id':'accounts','account_no':'accounts','reseller_id':'accounts','provider_id':'accounts','created_by':'accounts',
 'pricelist_id':'pricelists','currency_id':'currency','country_id':'countrycode','sip_profile_id':'sip_profiles','trunk_id':'trunks',
 'gateway_id':'gateways','failover_gateway_id':'gateways','failover_gateway_id1':'gateways','invoiceid':'invoices','invoice_id':'invoices',
 'order_id':'orders','order_item_id':'order_items','product_id':'products','package_id':'products','payment_id':'payment_transaction',
 'routes_id':'routes','route_id':'routes','taxes_id':'taxes','tax_id':'taxes','permission_id':'permissions','localization_id':'localization',
 'timezone_id':'timezone','language_id':'language','sweep_id':'sweeplist','parent_id':None,'parent_order_id':'orders','call_type':'calltype',
 'calltype':'calltype','did_call_type':'did_call_types','did_id':'dids','category_id':'category'
}
RELNAMES={
 'accountid':'account','account_id':'account','reseller_id':'reseller','provider_id':'provider','created_by':'creator',
 'pricelist_id':'pricelist','currency_id':'currency','country_id':'country','sip_profile_id':'sipProfile','trunk_id':'trunk','gateway_id':'gateway',
 'failover_gateway_id':'failoverGateway','failover_gateway_id1':'failoverGateway1','invoiceid':'invoice','invoice_id':'invoice',
 'order_id':'order','order_item_id':'orderItem','product_id':'product','package_id':'packageProduct','payment_id':'paymentTransaction',
 'routes_id':'route','route_id':'route','taxes_id':'tax','tax_id':'tax','permission_id':'permission','localization_id':'localization',
 'timezone_id':'timezone','language_id':'language','sweep_id':'sweep','parent_id':'parent','parent_order_id':'parentOrder',
 'call_type':'calltype','calltype':'calltype','did_call_type':'didCallType','did_id':'did','category_id':'category'
}
DISPLAY_PREF=['number','name','company_name','email','username','gateway_name','trunk_name','sip_profile_name','profile_name','destination','pattern','product_name','order_id','invoiceid','country','nicename','currency','currencyname','timezone_name','module_name','display_name','subject','id']
def display_col(table):
    cols=colnames(table)
    for c in DISPLAY_PREF:
        if c in cols: return c
    return primary(table) if primary(table) in cols else (cols[0] if cols else 'id')

def make_dirs(path): Path(path).mkdir(parents=True, exist_ok=True)
for p in ['app/Models/Astpp','app/Services/Astpp','app/Filament/Resources/Astpp','app/Providers/Filament','config','tools']:
    make_dirs(OUT/p)

# Base model
(OUT/'app/Models/Astpp/BaseAstppModel.php').write_text('''<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Model;

abstract class BaseAstppModel extends Model
{
    protected $connection = 'astpp';
    public $timestamps = false;
    protected $guarded = [];
}
''')

# Password service
(OUT/'app/Services/Astpp/AstppPasswordService.php').write_text('''<?php

namespace App\Services\Astpp;

class AstppPasswordService
{
    public static function encode(string $plainText, ?string $privateKey = null): string
    {
        $privateKey ??= self::privateKeyFromConfig();
        $ivSize = openssl_cipher_iv_length('BF-ECB');
        $iv = $ivSize > 0 ? openssl_random_pseudo_bytes($ivSize) : false;
        $encrypted = openssl_encrypt($plainText, 'BF-ECB', $privateKey, OPENSSL_RAW_DATA, $iv);

        return str_replace(['+', '/', '='], ['-', '$', ''], base64_encode((string) $encrypted));
    }

    public static function privateKeyFromConfig(): string
    {
        $path = env('ASTPP_CONFIG_PATH', '/var/lib/astpp/astpp-config.conf');
        $config = is_file($path) ? parse_ini_file($path) : [];

        return trim((string) ($config['PRIVATE_KEY'] ?? env('ASTPP_PRIVATE_KEY', '')), "\"'");
    }
}
''')

# Models
for table,sc in schemas.items():
    cls=model[table]; pk=primary(table); cols=sc['columns']; cn=[c['name'] for c in cols]
    imports=[]; methods=[]; used=set()
    # belongsTo
    for c in cols:
        col=c['name']; target=TARGETS.get(col)
        if col=='parent_id': target=table
        if not target or target not in schemas: continue
        rn=RELNAMES.get(col, camel(col[:-3] if col.endswith('_id') else col))
        if rn in used: rn += 'Relation'
        used.add(rn)
        methods.append(f"    public function {rn}(): BelongsTo\n    {{\n        return $this->belongsTo({model[target]}::class, '{col}', '{primary(target)}');\n    }}\n")
    if methods: imports.append('use Illuminate\\Database\\Eloquent\\Relations\\BelongsTo;')
    # Inverse hasMany only for central tables, with unique safe names
    inverse=[]
    central={'accounts','pricelists','sip_profiles','gateways','trunks','products','orders','invoices','taxes','currency','countrycode','routes','calltype','dids'}
    if table in central:
        for other,osc in schemas.items():
            for oc in colnames(other):
                target=TARGETS.get(oc)
                if oc=='parent_id': target=other
                if target==table:
                    base=camel(other)
                    suffix='' if oc in ['accountid','account_id'] else 'By'+studly(oc)
                    rn=base+suffix
                    if rn in used: rn += 'List'
                    used.add(rn)
                    inverse.append(f"    public function {rn}(): HasMany\n    {{\n        return $this->hasMany({model[other]}::class, '{oc}', '{pk}');\n    }}\n")
    if inverse: imports.append('use Illuminate\\Database\\Eloquent\\Relations\\HasMany;')
    casts=[]
    for c in cols:
        name,typ=c['name'],c['type']
        if name==pk: continue
        if any(x in typ for x in ['int','bigint','smallint','tinyint']): casts.append(f"        '{name}' => 'integer',")
        elif any(x in typ for x in ['decimal','double','float']): casts.append(f"        '{name}' => 'decimal:6',")
        elif 'datetime' in typ or 'timestamp' in typ: casts.append(f"        '{name}' => 'datetime',")
        elif typ.startswith('date'): casts.append(f"        '{name}' => 'date',")
    inc='true' if any(c['name']==pk and 'AUTO_INCREMENT' in c['rest'].upper() for c in cols) else 'false'
    keytype='string' if any(c['name']==pk and any(x in c['type'] for x in ['char','varchar','text']) for c in cols) else 'int'
    text="<?php\n\nnamespace App\\Models\\Astpp;\n\n" + ('\n'.join(imports)+'\n\n' if imports else '')
    text += f"class {cls} extends BaseAstppModel\n{{\n    protected $table = '{table}';\n    protected $primaryKey = '{pk}';\n    public $incrementing = {inc};\n    protected $keyType = '{keytype}';\n\n    protected $casts = [\n" + '\n'.join(casts) + "\n    ];\n\n"
    if table=='accounts':
        text += "    public const TYPE_ADMIN = -1;\n    public const TYPE_CUSTOMER = 0;\n    public const TYPE_RESELLER = 1;\n    public const TYPE_PROVIDER = 3;\n\n"
        text += "    public function getTypeLabelAttribute(): string\n    {\n        return match ((int) $this->type) {\n            self::TYPE_ADMIN => 'Admin',\n            self::TYPE_CUSTOMER => 'Customer',\n            self::TYPE_RESELLER => 'Reseller',\n            self::TYPE_PROVIDER => 'Provider',\n            default => 'Other',\n        };\n    }\n\n"
        text += "    public function scopeCustomers($query) { return $query->where('type', self::TYPE_CUSTOMER); }\n    public function scopeResellers($query) { return $query->where('type', self::TYPE_RESELLER); }\n    public function scopeProviders($query) { return $query->where('type', self::TYPE_PROVIDER); }\n\n"
    if methods or inverse:
        text += "    // Relationships are inferred from ASTPP's legacy schema column names.\n"
        text += '\n'.join(methods+inverse) + '\n'
    text += "}\n"
    (OUT/f'app/Models/Astpp/{cls}.php').write_text(text)

# Filament resources
NAV={
 'accounts':'ASTPP Accounts','account_unverified':'ASTPP Accounts','accounts_callerid':'ASTPP Accounts','ani_map':'ASTPP Accounts','ip_map':'ASTPP Accounts','speed_dial':'ASTPP Accounts','cli_group':'ASTPP Accounts','block_patterns':'ASTPP Accounts','localization':'ASTPP Accounts','login_activity_report':'ASTPP Accounts','usertracking':'ASTPP Accounts',
 'sip_devices':'ASTPP PBX','sip_profiles':'ASTPP PBX','gateways':'ASTPP PBX','trunks':'ASTPP PBX','freeswich_servers':'ASTPP PBX','outbound_routes':'ASTPP PBX','routes':'ASTPP Routing','routing':'ASTPP Routing','ratedeck':'ASTPP Rating','pricelists':'ASTPP Rating','package_patterns':'ASTPP Rating','calltype':'ASTPP Rating','did_call_types':'ASTPP DID','dids':'ASTPP DID','accessnumber':'ASTPP DID',
 'cdrs':'ASTPP CDR','cdrs_staging':'ASTPP CDR','reseller_cdrs':'ASTPP CDR','accounts_cdr_summary':'ASTPP CDR','cdrs_day_by_summary':'ASTPP CDR','provider_cdr_summary':'ASTPP CDR','activity_reports':'ASTPP Reports',
 'products':'ASTPP Products','orders':'ASTPP Products','order_items':'ASTPP Products','reseller_products':'ASTPP Products','counters':'ASTPP Products','commission':'ASTPP Products',
 'invoices':'ASTPP Billing','invoice_details':'ASTPP Billing','invoice_conf':'ASTPP Billing','payment_transaction':'ASTPP Billing','taxes':'ASTPP Billing','taxes_to_accounts':'ASTPP Billing','refill_coupon':'ASTPP Billing',
 'permissions':'ASTPP System','roles_and_permission':'ASTPP System','menu_modules':'ASTPP System','system':'ASTPP System','cron_settings':'ASTPP System','addons':'ASTPP System','backup_database':'ASTPP System','mail_details':'ASTPP System','default_templates':'ASTPP System','language':'ASTPP System','languages':'ASTPP System','currency':'ASTPP System','countrycode':'ASTPP System','timezone':'ASTPP System','translations':'ASTPP System','q850code':'ASTPP System','license':'ASTPP System','sweeplist':'ASTPP System','userlevels':'ASTPP System','category':'ASTPP System','reports_process_list':'ASTPP System','automated_report_log':'ASTPP System'
}
ICONS=['heroicon-o-user-group','heroicon-o-phone','heroicon-o-currency-dollar','heroicon-o-document-text','heroicon-o-circle-stack','heroicon-o-cog-6-tooth']

def form_comp(col,typ,is_pk):
    if is_pk and col=='id': return None
    target=TARGETS.get(col)
    if col=='parent_id': target=None # avoid self recursion select by default
    if target and target in schemas:
        rn=RELNAMES.get(col, camel(col[:-3] if col.endswith('_id') else col))
        return f"                    Select::make('{col}')->label('{label(col)}')->relationship('{rn}', '{display_col(target)}')->searchable()->preload(),"
    if typ.startswith('tinyint(1)'):
        return f"                    Toggle::make('{col}')->label('{label(col)}'),"
    if any(x in typ for x in ['text','longtext','mediumtext']) or col in ['description','comment','message','permissions','edit_permissions','template','files','gateway_data','profile_data','dir_params','dir_vars']:
        return f"                    Textarea::make('{col}')->label('{label(col)}')->rows(3)->columnSpanFull(),"
    if 'datetime' in typ or 'timestamp' in typ:
        return f"                    DateTimePicker::make('{col}')->label('{label(col)}'),"
    if typ.startswith('date'):
        return f"                    DatePicker::make('{col}')->label('{label(col)}'),"
    numeric=any(x in typ for x in ['int','decimal','double','float'])
    extra='->numeric()' if numeric else ''
    m=re.search(r'(?:varchar|char)\((\d+)\)',typ); maxlen=f"->maxLength({m.group(1)})" if m else ''
    if col=='password': extra += '->password()->revealable()'
    if col=='email': extra += '->email()'
    return f"                    TextInput::make('{col}')->label('{label(col)}'){extra}{maxlen},"

def tab_col(col,typ):
    target=TARGETS.get(col)
    if target and target in schemas:
        rn=RELNAMES.get(col, camel(col[:-3] if col.endswith('_id') else col))
        return f"                TextColumn::make('{rn}.{display_col(target)}')->label('{label(col)}')->searchable()->sortable()->toggleable(),"
    if 'datetime' in typ or 'timestamp' in typ:
        return f"                TextColumn::make('{col}')->label('{label(col)}')->dateTime()->sortable()->toggleable(),"
    if typ.startswith('date'):
        return f"                TextColumn::make('{col}')->label('{label(col)}')->date()->sortable()->toggleable(),"
    if col in ['status','deleted','type'] or typ.startswith('tinyint'):
        return f"                TextColumn::make('{col}')->label('{label(col)}')->badge()->sortable()->toggleable(),"
    return f"                TextColumn::make('{col}')->label('{label(col)}')->searchable()->sortable()->limit(40)->toggleable(),"

for idx,(table,sc) in enumerate(schemas.items()):
    cls=model[table]; res=cls+'Resource'; base=OUT/f'app/Filament/Resources/Astpp/{cls}Resource'
    for sub in ['Pages','Schemas','Tables']: make_dirs(base/sub)
    nav=NAV.get(table,'ASTPP')
    (base/f'{res}.php').write_text(f'''<?php

namespace App\Filament\Resources\Astpp\{cls}Resource;

use App\Filament\Resources\Astpp\{cls}Resource\Pages;
use App\Filament\Resources\Astpp\{cls}Resource\Schemas\{cls}Form;
use App\Filament\Resources\Astpp\{cls}Resource\Tables\{cls}Table;
use App\Models\Astpp\{cls};
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class {res} extends Resource
{{
    protected static ?string $model = {cls}::class;

    public static function getNavigationGroup(): ?string {{ return '{nav}'; }}
    public static function getNavigationIcon(): string|Htmlable|null {{ return '{ICONS[idx % len(ICONS)]}'; }}
    public static function getNavigationLabel(): string {{ return '{label(table)}'; }}
    public static function getModelLabel(): string {{ return '{label(table)}'; }}
    public static function getPluralModelLabel(): string {{ return '{label(table)}'; }}
    public static function getNavigationSort(): ?int {{ return {idx+1}; }}

    public static function form(Schema $schema): Schema
    {{
        return {cls}Form::configure($schema);
    }}

    public static function table(Table $table): Table
    {{
        return {cls}Table::configure($table);
    }}

    public static function getEloquentQuery(): Builder
    {{
        $query = parent::getEloquentQuery();
        $model = $query->getModel();
        $columns = $model->getConnection()->getSchemaBuilder()->getColumnListing($model->getTable());

        if (in_array('deleted', $columns, true)) {{
            $query->where('deleted', 0);
        }}

        return $query;
    }}

    public static function getPages(): array
    {{
        return [
            'index' => Pages\List{cls}Records::route('/'),
            'create' => Pages\Create{cls}::route('/create'),
            'edit' => Pages\Edit{cls}::route('/{{record}}/edit'),
        ];
    }}
}}
''')
    comps=[]
    for c in sc['columns'][:45]:
        fc=form_comp(c['name'],c['type'],c['name']==primary(table))
        if fc: comps.append(fc)
    if not comps: comps=["                    TextInput::make('id')->disabled(),"]
    (base/'Schemas'/f'{cls}Form.php').write_text(f'''<?php

namespace App\Filament\Resources\Astpp\{cls}Resource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class {cls}Form
{{
    public static function configure(Schema $schema): Schema
    {{
        return $schema->schema([
            Section::make('{label(table)}')
                ->columns(3)
                ->schema([
{chr(10).join(comps)}
                ]),
        ]);
    }}
}}
''')
    # table cols, prioritize practical cols
    cols=sc['columns']
    priorities=[primary(table),display_col(table),'number','name','company_name','email','accountid','account_id','reseller_id','provider_id','status','deleted','creation','created_date','date']
    ordered=[]
    for p in priorities:
        for c in cols:
            if c['name']==p and c not in ordered: ordered.append(c)
    for c in cols:
        if c not in ordered: ordered.append(c)
    tcols=[tab_col(c['name'],c['type']) for c in ordered[:10]]
    (base/'Tables'/f'{cls}Table.php').write_text(f'''<?php

namespace App\Filament\Resources\Astpp\{cls}Resource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class {cls}Table
{{
    public static function configure(Table $table): Table
    {{
        return $table
            ->columns([
{chr(10).join(tcols)}
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }}
}}
''')
    (base/'Pages'/f'List{cls}Records.php').write_text(f'''<?php

namespace App\Filament\Resources\Astpp\{cls}Resource\Pages;

use App\Filament\Resources\Astpp\{cls}Resource\{cls}Resource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class List{cls}Records extends ListRecords
{{
    protected static string $resource = {cls}Resource::class;

    protected function getHeaderActions(): array
    {{
        return [CreateAction::make()];
    }}
}}
''')
    (base/'Pages'/f'Create{cls}.php').write_text(f'''<?php

namespace App\Filament\Resources\Astpp\{cls}Resource\Pages;

use App\Filament\Resources\Astpp\{cls}Resource\{cls}Resource;
use Filament\Resources\Pages\CreateRecord;

class Create{cls} extends CreateRecord
{{
    protected static string $resource = {cls}Resource::class;
}}
''')
    (base/'Pages'/f'Edit{cls}.php').write_text(f'''<?php

namespace App\Filament\Resources\Astpp\{cls}Resource\Pages;

use App\Filament\Resources\Astpp\{cls}Resource\{cls}Resource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class Edit{cls} extends EditRecord
{{
    protected static string $resource = {cls}Resource::class;

    protected function getHeaderActions(): array
    {{
        return [DeleteAction::make()];
    }}
}}
''')

# Provider replacement using discovery to avoid manually listing resources
(OUT/'app/Providers/Filament/AdminPanelProvider.php').write_text('''<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors(['primary' => Color::Blue])
            ->brandName('Kazitel ASTPP')
            ->darkMode(true)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
''')

(OUT/'config/astpp-database-snippet.php').write_text('''<?php
// Add this inside config/database.php -> connections array.
'astpp' => [
    'driver' => 'mysql',
    'host' => env('ASTPP_DB_HOST', '127.0.0.1'),
    'port' => env('ASTPP_DB_PORT', '3306'),
    'database' => env('ASTPP_DB_DATABASE', 'astpp'),
    'username' => env('ASTPP_DB_USERNAME', 'astppuser'),
    'password' => env('ASTPP_DB_PASSWORD', ''),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'strict' => false,
    'engine' => null,
],
''')
(OUT/'config/env-example.txt').write_text('''ASTPP_DB_HOST=127.0.0.1
ASTPP_DB_PORT=3306
ASTPP_DB_DATABASE=astpp
ASTPP_DB_USERNAME=astppuser
ASTPP_DB_PASSWORD="your_actual_astpp_password"
ASTPP_CONFIG_PATH=/var/lib/astpp/astpp-config.conf
''')
(OUT/'tools/generate_astpp_laravel12_filament4.py').write_text(Path(__file__).read_text() if '__file__' in globals() else '')
(OUT/'README.md').write_text(f'''# ASTPP Laravel 12 + Filament 4 Fresh Overlay

Generated from the uploaded ASTPP schema on {datetime.now(timezone.utc).isoformat()}.

## Contents

- Models for all {len(schemas)} ASTPP tables in `app/Models/Astpp`.
- Filament 4 resources for all tables in `app/Filament/Resources/Astpp`.
- `SipProfile` and `SipDevice` models/resources included.
- `AstppPasswordService` for ASTPP-compatible encoded passwords.
- Optional replacement `AdminPanelProvider.php` that discovers resources automatically.

## Install

Copy the overlay into your Laravel 12 project root:

```bash
unzip astpp_laravel12_filament4_fresh_overlay.zip -d /tmp/astpp-overlay
cp -r /tmp/astpp-overlay/* /var/www/kazitel-ui/
cd /var/www/kazitel-ui
composer dump-autoload
php artisan optimize:clear
```

Add the `astpp` connection from `config/astpp-database-snippet.php` into `config/database.php`.

Add `.env` values from `config/env-example.txt`.

## Important

Do not run Laravel migrations on the live ASTPP database. Start read-only, then carefully enable writes table-by-table.

Relationships are inferred from ASTPP legacy field names because the schema has few explicit foreign keys.
''')

# Zip
if ZIP.exists(): ZIP.unlink()
with zipfile.ZipFile(ZIP,'w',zipfile.ZIP_DEFLATED) as z:
    for f in OUT.rglob('*'):
        if f.is_file(): z.write(f, f.relative_to(OUT))
print(ZIP)
print(f'Tables: {len(schemas)}, PHP files: {len(list(OUT.rglob("*.php")))}')
