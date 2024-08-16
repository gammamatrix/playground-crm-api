<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Crm\Api\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Playground\Crm\Api\Http\Requests;
use Playground\Crm\Api\Http\Resources;
use Playground\Crm\Models\Location;

/**
 * \Playground\Crm\Api\Http\Controllers\LocationController
 */
class LocationController extends Controller
{
    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'model_attribute' => 'title',
        'model_label' => 'Location',
        'model_label_plural' => 'Locations',
        'model_route' => 'playground.crm.api.locations',
        'model_slug' => 'location',
        'model_slug_plural' => 'locations',
        'module_label' => 'CRM',
        'module_label_plural' => 'CRMS',
        'module_route' => 'playground.crm.api',
        'module_slug' => 'crm',
        'privilege' => 'playground-crm-api:location',
        'table' => 'crm_locations',
    ];

    /**
     * Create the Location resource in storage.
     *
     * @route GET /api/crm/locations/create playground.crm.api.locations.create
     */
    public function create(
        Requests\Location\CreateRequest $request
    ): JsonResponse|Resources\Location {

        $validated = $request->validated();

        $user = $request->user();

        $location = new Location($validated);

        return (new Resources\Location($location))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }

    /**
     * Edit the Location resource in storage.
     *
     * @route GET /api/crm/locations/edit playground.crm.api.locations.edit
     */
    public function edit(
        Location $location,
        Requests\Location\EditRequest $request
    ): JsonResponse|Resources\Location {
        return (new Resources\Location($location))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }

    /**
     * Remove the Location resource from storage.
     *
     * @route DELETE /api/crm/locations/{location} playground.crm.api.locations.destroy
     */
    public function destroy(
        Location $location,
        Requests\Location\DestroyRequest $request
    ): Response {

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $location->modified_by_id = $user->id;
        }

        if (empty($validated['force'])) {
            $location->delete();
        } else {
            $location->forceDelete();
        }

        return response()->noContent();
    }

    /**
     * Lock the Location resource in storage.
     *
     * @route PUT /api/crm/locations/{location} playground.crm.api.locations.lock
     */
    public function lock(
        Location $location,
        Requests\Location\LockRequest $request
    ): JsonResponse|Resources\Location {

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $location->modified_by_id = $user->id;
        }

        $location->locked = true;

        $location->save();

        return (new Resources\Location($location))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }

    /**
     * Display a listing of Location resources.
     *
     * @route GET /api/crm/locations playground.crm.api.locations
     */
    public function index(
        Requests\Location\IndexRequest $request
    ): JsonResponse|Resources\LocationCollection {

        $user = $request->user();

        $validated = $request->validated();

        $query = Location::addSelect(sprintf('%1$s.*', $this->packageInfo['table']));

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

        return (new Resources\LocationCollection($paginator))->response($request);
    }

    /**
     * Restore the Location resource from the trash.
     *
     * @route PUT /api/crm/locations/restore/{location} playground.crm.api.locations.restore
     */
    public function restore(
        Location $location,
        Requests\Location\RestoreRequest $request
    ): JsonResponse|Resources\Location {

        $user = $request->user();

        if ($user?->id) {
            $location->modified_by_id = $user->id;
        }

        $location->restore();

        return (new Resources\Location($location))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }

    /**
     * Display the Location resource.
     *
     * @route GET /api/crm/locations/{location} playground.crm.api.locations.show
     */
    public function show(
        Location $location,
        Requests\Location\ShowRequest $request
    ): JsonResponse|Resources\Location {
        return (new Resources\Location($location))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }

   /**
     * Store a newly created API Location resource in storage.
     *
     * @route POST /api/crm/locations playground.crm.api.locations.post
     */
    public function store(
        Requests\Location\StoreRequest $request
    ): Response|JsonResponse|Resources\Location {
        $validated = $request->validated();

        $user = $request->user();

        $location = new Location($validated);

        $location->created_by_id = $user?->id;

        $location->save();

        return (new Resources\Location($location))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request)->setStatusCode(201);
    }

    /**
     * Unlock the Location resource in storage.
     *
     * @route DELETE /api/crm/locations/lock/{location} playground.crm.api.locations.unlock
     */
    public function unlock(
        Location $location,
        Requests\Location\UnlockRequest $request
    ): JsonResponse|Resources\Location {

        $validated = $request->validated();

        $user = $request->user();

        $location->locked = false;

        if ($user?->id) {
            $location->modified_by_id = $user->id;
        }

        $location->save();

        return (new Resources\Location($location))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }

    /**
     * Update the Location resource in storage.
     *
     * @route PATCH /api/crm/locations/{location} playground.crm.api.locations.patch
     */
    public function update(
        Location $location,
        Requests\Location\UpdateRequest $request
    ): JsonResponse {

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $location->modified_by_id = $user->id;
        }

        $location->update($validated);

        return (new Resources\Location($location))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }
}
