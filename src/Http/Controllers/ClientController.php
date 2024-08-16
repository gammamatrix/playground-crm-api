<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Crm\Api\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Playground\Crm\Api\Http\Requests;
use Playground\Crm\Api\Http\Resources;
use Playground\Crm\Models\Client;

/**
 * \Playground\Crm\Api\Http\Controllers\ClientController
 */
class ClientController extends Controller
{
    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'model_attribute' => 'title',
        'model_label' => 'Client',
        'model_label_plural' => 'Clients',
        'model_route' => 'playground.crm.api.clients',
        'model_slug' => 'client',
        'model_slug_plural' => 'clients',
        'module_label' => 'CRM',
        'module_label_plural' => 'CRMS',
        'module_route' => 'playground.crm.api',
        'module_slug' => 'crm',
        'privilege' => 'playground-crm-api:client',
        'table' => 'crm_clients',
    ];

    /**
     * Create the Client resource in storage.
     *
     * @route GET /api/crm/clients/create playground.crm.api.clients.create
     */
    public function create(
        Requests\Client\CreateRequest $request
    ): JsonResponse|Resources\Client {

        $validated = $request->validated();

        $user = $request->user();

        $client = new Client($validated);

        return (new Resources\Client($client))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }

    /**
     * Edit the Client resource in storage.
     *
     * @route GET /api/crm/clients/edit playground.crm.api.clients.edit
     */
    public function edit(
        Client $client,
        Requests\Client\EditRequest $request
    ): JsonResponse|Resources\Client {
        return (new Resources\Client($client))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }

    /**
     * Remove the Client resource from storage.
     *
     * @route DELETE /api/crm/clients/{client} playground.crm.api.clients.destroy
     */
    public function destroy(
        Client $client,
        Requests\Client\DestroyRequest $request
    ): Response {

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $client->modified_by_id = $user->id;
        }

        if (empty($validated['force'])) {
            $client->delete();
        } else {
            $client->forceDelete();
        }

        return response()->noContent();
    }

    /**
     * Lock the Client resource in storage.
     *
     * @route PUT /api/crm/clients/{client} playground.crm.api.clients.lock
     */
    public function lock(
        Client $client,
        Requests\Client\LockRequest $request
    ): JsonResponse|Resources\Client {

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $client->modified_by_id = $user->id;
        }

        $client->locked = true;

        $client->save();

        return (new Resources\Client($client))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }

    /**
     * Display a listing of Client resources.
     *
     * @route GET /api/crm/clients playground.crm.api.clients
     */
    public function index(
        Requests\Client\IndexRequest $request
    ): JsonResponse|Resources\ClientCollection {

        $user = $request->user();

        $validated = $request->validated();

        $query = Client::addSelect(sprintf('%1$s.*', $this->packageInfo['table']));

        $query->sort($validated['sort'] ?? null);

        if (! empty($validated['filter']) && is_array($validated['filter'])) {

            $query->filterTrash($validated['filter']['trash'] ?? null);

            $query->filterIds(
                $request->getPaginationIds(),
                $validated
            );

            $query->filterFlags(
                $request->getPaginationFlags(),
                $validated
            );

            $query->filterDates(
                $request->getPaginationDates(),
                $validated
            );

            $query->filterColumns(
                $request->getPaginationColumns(),
                $validated
            );
        }

        $perPage = ! empty($validated['perPage']) && is_int($validated['perPage']) ? $validated['perPage'] : null;
        $paginator = $query->paginate($perPage);

        $paginator->appends($validated);

        return (new Resources\ClientCollection($paginator))->response($request);
    }

    /**
     * Restore the Client resource from the trash.
     *
     * @route PUT /api/crm/clients/restore/{client} playground.crm.api.clients.restore
     */
    public function restore(
        Client $client,
        Requests\Client\RestoreRequest $request
    ): JsonResponse|Resources\Client {

        $user = $request->user();

        if ($user?->id) {
            $client->modified_by_id = $user->id;
        }

        $client->restore();

        return (new Resources\Client($client))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }

    /**
     * Display the Client resource.
     *
     * @route GET /api/crm/clients/{client} playground.crm.api.clients.show
     */
    public function show(
        Client $client,
        Requests\Client\ShowRequest $request
    ): JsonResponse|Resources\Client {
        return (new Resources\Client($client))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }

    /**
     * Store a newly created API Client resource in storage.
     *
     * @route POST /api/crm/clients playground.crm.api.clients.post
     */
    public function store(
        Requests\Client\StoreRequest $request
    ): Response|JsonResponse|Resources\Client {
        $validated = $request->validated();

        $user = $request->user();

        $client = new Client($validated);

        $client->created_by_id = $user?->id;

        $client->save();

        return (new Resources\Client($client))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request)->setStatusCode(201);
    }

    /**
     * Unlock the Client resource in storage.
     *
     * @route DELETE /api/crm/clients/lock/{client} playground.crm.api.clients.unlock
     */
    public function unlock(
        Client $client,
        Requests\Client\UnlockRequest $request
    ): JsonResponse|Resources\Client {

        $validated = $request->validated();

        $user = $request->user();

        $client->locked = false;

        if ($user?->id) {
            $client->modified_by_id = $user->id;
        }

        $client->save();

        return (new Resources\Client($client))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }

    /**
     * Update the Client resource in storage.
     *
     * @route PATCH /api/crm/clients/{client} playground.crm.api.clients.patch
     */
    public function update(
        Client $client,
        Requests\Client\UpdateRequest $request
    ): JsonResponse {

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $client->modified_by_id = $user->id;
        }

        $client->update($validated);

        return (new Resources\Client($client))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }
}
