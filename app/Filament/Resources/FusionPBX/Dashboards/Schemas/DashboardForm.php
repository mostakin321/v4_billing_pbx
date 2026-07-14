<?php

namespace App\Filament\Resources\FusionPBX\Dashboards\Schemas;

use Carbon\Carbon;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class DashboardForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Dashboard')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('dashboard_name')
                        ->label('Dashboard Name')->placeholder('dashboard name'),
                    TextInput::make('dashboard_path')
                        ->label('Dashboard Path')->placeholder('dashboard path'),
                    TextInput::make('dashboard_icon')
                        ->label('Dashboard Icon')->placeholder('dashboard icon'),
                    TextInput::make('dashboard_icon_color')
                        ->label('Dashboard Icon Color')->placeholder('dashboard icon color'),
                    TextInput::make('dashboard_url')
                        ->label('Dashboard Url')->placeholder('dashboard url'),
                    TextInput::make('dashboard_target')
                        ->label('Dashboard Target')->placeholder('dashboard target'),
                    TextInput::make('dashboard_width')
                        ->label('Dashboard Width')->placeholder('dashboard width'),
                    TextInput::make('dashboard_height')
                        ->label('Dashboard Height')->placeholder('dashboard height'),
                    TextInput::make('dashboard_content')
                        ->label('Dashboard Content')->placeholder('dashboard content'),
                    TextInput::make('dashboard_content_text_align')
                        ->label('Dashboard Content Text Align')->placeholder('dashboard content text align'),
                    TextInput::make('dashboard_content_details')
                        ->label('Dashboard Content Details')->placeholder('dashboard content details'),
                    TextInput::make('dashboard_chart_type')
                        ->label('Dashboard Chart Type')->placeholder('dashboard chart type'),
                    Select::make('dashboard_label_enabled')
                        ->label('Dashboard Label Enabled')
                        ->native(false)->options(['true'=>'Yes','false'=>'No'])->default('false'),
                    TextInput::make('dashboard_label_text_color')
                        ->label('Dashboard Label Text Color')->placeholder('dashboard label text color'),
                    TextInput::make('dashboard_label_text_color_hover')
                        ->label('Dashboard Label Text Color Hover')->placeholder('dashboard label text color hover'),
                    TextInput::make('dashboard_label_background_color')
                        ->label('Dashboard Label Background Color')->placeholder('dashboard label background color'),
                    TextInput::make('dashboard_label_background_color_hover')
                        ->label('Dashboard Label Background Color Hover')->placeholder('dashboard label background color hover'),
                    TextInput::make('dashboard_number_text_color')
                        ->label('Dashboard Number Text Color')->placeholder('dashboard number text color'),
                    TextInput::make('dashboard_number_text_color_hover')
                        ->label('Dashboard Number Text Color Hover')->placeholder('dashboard number text color hover'),
                    TextInput::make('dashboard_number_background_color')
                        ->label('Dashboard Number Background Color')->placeholder('dashboard number background color'),
                    TextInput::make('dashboard_background_color')
                        ->label('Dashboard Background Color')->placeholder('dashboard background color'),
                    TextInput::make('dashboard_background_color_hover')
                        ->label('Dashboard Background Color Hover')->placeholder('dashboard background color hover'),
                    TextInput::make('dashboard_detail_background_color')
                        ->label('Dashboard Detail Background Color')->placeholder('dashboard detail background color'),
                    TextInput::make('dashboard_background_gradient_style')
                        ->label('Dashboard Background Gradient Style')->placeholder('dashboard background gradient style'),
                    TextInput::make('dashboard_background_gradient_angle')
                        ->label('Dashboard Background Gradient Angle')->placeholder('dashboard background gradient angle'),
                    TextInput::make('dashboard_column_span')
                        ->label('Dashboard Column Span')->placeholder('dashboard column span'),
                    TextInput::make('dashboard_row_span')
                        ->label('Dashboard Row Span')->placeholder('dashboard row span'),
                    TextInput::make('dashboard_details_state')
                        ->label('Dashboard Details State')->placeholder('dashboard details state'),
                    Select::make('dashboard_enabled')
                        ->label('Dashboard Enabled')
                        ->native(false)->options(['true'=>'Yes','false'=>'No'])->default('false'),
                    Textarea::make('dashboard_description')
                        ->label('Dashboard Description')->rows(2)->columnSpanFull(),
                                ]),
                        ]),

                    Tabs\Tab::make('Advanced')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            Section::make('Advanced')
                                ->columns(2)
                                ->schema([
                    TextInput::make('dashboard_order')
                        ->label('Dashboard Order')
                        ->numeric(),
                                ]),
                        ]),
                ]),

            Section::make('Record Info')
                ->description('System identifiers — read only.')
                ->icon('heroicon-o-information-circle')
                ->collapsed()->columns(3)
                ->schema([
                    Placeholder::make('dashboard_parent_uuid')
                        ->label('UUID')
                        ->content(fn ($record) => $record?->dashboard_parent_uuid
                            ? new HtmlString('<code style="font-family:monospace;font-size:0.72rem;color:#8b95ab;word-break:break-all;">'.$record->dashboard_parent_uuid.'</code>')
                            : 'Assigned on save'),
                    Placeholder::make('insert_date')->label('Created')
                        ->content(fn ($record) => $record?->insert_date
                            ? Carbon::parse($record->insert_date)->format('M j, Y H:i') : '—'),
                    Placeholder::make('update_date')->label('Last Updated')
                        ->content(fn ($record) => $record?->update_date
                            ? Carbon::parse($record->update_date)->diffForHumans() : '—'),
                ])
                ->visibleOn('edit'),
        ]);
    }
}
