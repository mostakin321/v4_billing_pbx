<?php

namespace App\Http\Controllers\Api\FusionPBX;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

/**
 * Generic CRUD controller for FusionPBX models.
 *
 * Notes:
 * - Models are UUID primary keys.
 * - FusionPBX models use insert_date/update_date timestamps.
 * - This controller is intentionally "thin" (no heavy validation).
 *   You can add FormRequests per-resource later.
 */
abstract class BaseCrudController extends Controller
{
    /** @var class-string<\Illuminate\Database\Eloquent\Model> */
    protected string $modelClass;

    /** Primary key field name (string UUID). */
    protected string $primaryKey = 'id';

    /** Default per-page for pagination. */
    protected int $perPage = 50;

    protected function query()
    {
        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = new $this->modelClass;

        $q = $model->newQuery();

        // Optional: include soft-deleted rows if the model uses SoftDeletes
        if (in_array('Illuminate\\Database\\Eloquent\\SoftDeletes', class_uses_recursive($model)) && request()->boolean('with_trashed')) {
            $q->withTrashed();
        }

        return $q;
    }

    public function index(Request $request): JsonResponse
    {
        $perPage = (int) $request->query('per_page', $this->perPage);
        $perPage = max(1, min(200, $perPage));

        $items = $this->query()->paginate($perPage);

        return response()->json($items);
    }

    public function show(string $id): JsonResponse
    {
        $item = $this->query()->where($this->primaryKey, $id)->firstOrFail();
        return response()->json($item);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $this->sanitize($request);

        $item = ($this->modelClass)::create($data);

        return response()->json($item, 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $item = $this->query()->where($this->primaryKey, $id)->firstOrFail();

        $data = $this->sanitize($request);

        $item->fill($data);
        $item->save();

        return response()->json($item);
    }

    public function destroy(Request $request, string $id): JsonResponse
    {
        $item = $this->query()->where($this->primaryKey, $id)->firstOrFail();

        // SoftDeletes-aware; force delete if ?force=1
        if ($request->boolean('force') && method_exists($item, 'forceDelete')) {
            $item->forceDelete();
            return response()->json(['deleted' => true, 'force' => true]);
        }

        $item->delete();

        return response()->json(['deleted' => true]);
    }

    /**
     * Remove fields we should not accept from the client by default.
     */
    protected function sanitize(Request $request): array
    {
        $blocked = [
            $this->primaryKey,
            'insert_date',
            'update_date',
            'created_at',
            'updated_at',
            'deleted_at',
        ];

        // Common non-data fields
        $blocked = array_merge($blocked, ['_token', '_method']);

        return $request->except($blocked);
    }
}
