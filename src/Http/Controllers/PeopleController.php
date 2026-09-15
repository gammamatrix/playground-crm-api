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
use Playground\Crm\Models\People;

/**
 * \Playground\Crm\Api\Http\Controllers\PeopleController
 */
class PeopleController extends Controller
{
    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'model_attribute' => 'title',
        'model_label' => 'People',
        'model_label_plural' => 'People',
        'model_route' => 'playground.crm.api.peoples',
        'model_slug' => 'people',
        'model_slug_plural' => 'peoples',
        'model_variable' => 'people',
        'model_variable_plural' => 'peoples',
        'module_label' => 'CRM',
        'module_label_plural' => 'CRMs',
        'module_route' => 'playground.crm.api',
        'module_slug' => 'crm',
        'privilege' => 'playground-crm-api:people',
        'table' => 'crm_peoples',
    ];

    /**
     * Create the People resource in storage.
     *
     * @route GET /api/crm/peoples/create playground.crm.api.peoples.create
     */
    public function create(
        Requests\People\CreateRequest $request
    ): JsonResponse|Resources\People {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $people = new People($validated);

        return new Resources\People($people)->additional(['meta' => [
            'info' => $packageInfo,
        ]])->response($request);
    }

    /**
     * Edit the People resource in storage.
     *
     * @route GET /api/crm/peoples/edit/{people} playground.crm.api.peoples.edit
     */
    public function edit(
        People $people,
        Requests\People\EditRequest $request
    ): JsonResponse|Resources\People {

        $packageInfo = $this->packageInfo();

        return new Resources\People($people)->additional(['meta' => [
            'info' => $packageInfo,
        ]])->response($request);
    }

    /**
     * Remove the People resource from storage.
     *
     * @route DELETE /api/crm/peoples/{people} playground.crm.api.peoples.destroy
     */
    public function destroy(
        People $people,
        Requests\People\DestroyRequest $request
    ): Response {

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $people->modified_by_id = $user->id;
        }

        if (empty($validated['force'])) {
            $people->delete();
        } else {
            $people->forceDelete();
        }

        return response()->noContent();
    }

    /**
     * Lock the People resource in storage.
     *
     * @route PUT /api/crm/peoples/{people} playground.crm.api.peoples.lock
     */
    public function lock(
        People $people,
        Requests\People\LockRequest $request
    ): JsonResponse|Resources\People {

        $packageInfo = $this->packageInfo();

        $user = $request->user();

        if ($user?->id) {
            $people->modified_by_id = $user->id;
        }

        $people->locked = true;

        $people->save();

        return new Resources\People($people)->additional(['meta' => [
            'info' => $packageInfo,
        ]])->response($request);
    }

    /**
     * Display a listing of People resources.
     *
     * @route GET /api/crm/people playground.crm.api.peoples
     */
    public function index(
        Requests\People\IndexRequest $request
    ): JsonResponse|Resources\PeopleCollection {

        $packageInfo = $this->packageInfo();

        /**
         * @var array{
         *     sort: string|array<mixed>,
         *     filter: array{
         *         trash: string
         *     },
         *     perPage: int
         * } $validated
         */
        $validated = $request->validated();

        $query = People::addSelect(sprintf('%1$s.*', $packageInfo->table()));

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

        return new Resources\PeopleCollection($paginator)->response($request);
    }

    /**
     * Restore the People resource from the trash.
     *
     * @route PUT /api/crm/peoples/restore/{people} playground.crm.api.peoples.restore
     */
    public function restore(
        People $people,
        Requests\People\RestoreRequest $request
    ): JsonResponse|Resources\People {

        $packageInfo = $this->packageInfo();

        $user = $request->user();

        $people->modified_by_id = $user?->id;

        $people->restore();

        return new Resources\People($people)->additional(['meta' => [
            'info' => $packageInfo,
        ]])->response($request);
    }

    /**
     * Display the People resource.
     *
     * @route GET /api/crm/peoples/{people} playground.crm.api.peoples.show
     */
    public function show(
        People $people,
        Requests\People\ShowRequest $request
    ): JsonResponse|Resources\People {

        $packageInfo = $this->packageInfo();

        return new Resources\People($people)->additional(['meta' => [
            'info' => $packageInfo,
        ]])->response($request);
    }

    /**
     * Store a newly created API People resource in storage.
     *
     * @route POST /api/crm/people playground.crm.api.peoples.post
     */
    public function store(
        Requests\People\StoreRequest $request
    ): Response|JsonResponse|Resources\People {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        $people = new People($validated);

        $people->created_by_id = $user?->id;

        $people->save();

        return new Resources\People($people)->additional(['meta' => [
            'info' => $packageInfo,
        ]])->response($request)->setStatusCode(201);
    }

    /**
     * Unlock the People resource in storage.
     *
     * @route DELETE /api/crm/peoples/lock/{people} playground.crm.api.peoples.unlock
     */
    public function unlock(
        People $people,
        Requests\People\UnlockRequest $request
    ): JsonResponse|Resources\People {

        $packageInfo = $this->packageInfo();

        $user = $request->user();

        $people->locked = false;

        $people->modified_by_id = $user?->id;

        $people->save();

        return new Resources\People($people)->additional(['meta' => [
            'info' => $packageInfo,
        ]])->response($request);
    }

    /**
     * Update the People resource in storage.
     *
     * @route PATCH /api/crm/peoples/{people} playground.crm.api.peoples.patch
     */
    public function update(
        People $people,
        Requests\People\UpdateRequest $request
    ): JsonResponse {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        $people->modified_by_id = $user?->id;

        $people->update($validated);

        return new Resources\People($people)->additional(['meta' => [
            'info' => $packageInfo,
        ]])->response($request);
    }
}
