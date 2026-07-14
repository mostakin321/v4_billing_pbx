<?php
namespace App\Observers\FusionPBX;

use App\Models\FusionPBX\Extension;
use App\Services\Freeswitch\EslClient;
use Illuminate\Support\Facades\Log;

class ExtensionObserver
{
    public function __construct(private EslClient $esl) {}

    public function saved(Extension $extension): void
    {
        try {
            $this->esl->reloadXml();
            Log::info('ESL: reloadXml after extension save', ['extension' => $extension->extension]);
        } catch (\Throwable $e) {
            Log::warning('ESL: reloadXml failed', ['error' => $e->getMessage()]);
        }
    }

    public function deleted(Extension $extension): void
    {
        try {
            $this->esl->reloadXml();
            Log::info('ESL: reloadXml after extension delete', ['extension' => $extension->extension]);
        } catch (\Throwable $e) {
            Log::warning('ESL: reloadXml failed', ['error' => $e->getMessage()]);
        }
    }
}
