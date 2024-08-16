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
use Playground\Crm\Models\Organization;

/**
 * \Playground\Crm\Api\Http\Controllers\OrganizationController
 */
class OrganizationController extends Controller
{
    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'model_attribute' => 'title',
        'model_label' => 'Organization',
        'model_label_plural' => 'Organizations',
        'model_route' => 'playground.crm.api.organizations',
        'model_slug' => 'organization',
        'model_slug_plural' => 'organizations',
        'module_label' => 'CRM',
        'module_label_plural' => 'CRMS',
        'module_route' => 'playground.crm.api',
        'module_slug' => 'crm',
        'privilege' => 'playground-crm-api:organization',
        'table' => 'crm_organizations',
    ];

    /**
     * Create the Organization resource in storage.
     *
     * @route GET /api/crm/organizations/create playground.crm.api.organizations.create
     */
    public function create(
        Requests\Organization\CreateRequest $request
    ): JsonResponse|Resources\Organization {

        $validated = $request->validated();

        $user = $request->user();

        $organization = new Organization($validated);

        return (new Resources\Organization($organization))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }

    /**
     * Edit the Organization resource in storage.
     *
     * @route GET /api/crm/organizations/edit playground.crm.api.organizations.edit
     */
    public function edit(
        Organization $organization,
        Requests\Organization\EditRequest $request
    ): JsonResponse|Resources\Organization {
        return (new Resources\Organization($organization))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }

    /**
     * Remove the Organization resource from storage.
     *
     * @route DELETE /api/crm/organizations/{organization} playground.crm.api.organizations.destroy
     */
    public function destroy(
        Organization $organization,
        Requests\Organization\DestroyRequest $request
    ): Response {

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $organization->modified_by_id = $user->id;
        }

        if (empty($validated['force'])) {
            $organization->delete();
        } else {
            $organization->forceDelete();
        }

        return response()->noContent();
    }

    /**
     * Lock the Organization resource in storage.
     *
     * @route PUT /api/crm/organizations/{organization} playground.crm.api.organizations.lock
     */
    public function lock(
        Organization $organization,
        Requests\Organization\LockRequest $request
    ): JsonResponse|Resources\Organization {

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $organization->modified_by_id = $user->id;
        }

        $organization->locked = true;

        $organization->save();

        return (new Resources\Organization($organization))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }

    /**
     * Display a listing of Organization resources.
     *
     * @route GET /api/crm/organizations playground.crm.api.organizations
     */
    public function index(
        Requests\Organization\IndexRequest $request
    ): JsonResponse|Resources\OrganizationCollection {

        $user = $request->user();

        $validated = $request->validated();

        $query = Organization::addSelect(sprintf('%1$s.*', $this->packageInfo['table']));

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

        return (new Resources\OrganizationCollection($paginator))->response($request);
    }

    /**
     * Restore the Organization resource from the trash.
     *
     * @route PUT /api/crm/organizations/restore/{organization} playground.crm.api.organizations.restore
     */
    public function restore(
        Organization $organization,
        Requests\Organization\RestoreRequest $request
    ): JsonResponse|Resources\Organization {

        $user = $request->user();

        if ($user?->id) {
            $organization->modified_by_id = $user->id;
        }

        $organization->restore();

        return (new Resources\Organization($organization))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }

    /**
     * Display the Organization resource.
     *
     * @route GET /api/crm/organizations/{organization} playground.crm.api.organizations.show
     */
    public function show(
        Organization $organization,
        Requests\Organization\ShowRequest $request
    ): JsonResponse|Resources\Organization {
        return (new Resources\Organization($organization))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }

   /**
     * Store a newly created API Organization resource in storage.
     *
     * @route POST /api/crm/organizations playground.crm.api.organizations.post
     */
    public function store(
        Requests\Organization\StoreRequest $request
    ): Response|JsonResponse|Resources\Organization {
        $validated = $request->validated();

        $user = $request->user();

        $organization = new Organization($validated);

        $organization->created_by_id = $user?->id;

        $organization->save();

        return (new Resources\Organization($organization))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request)->setStatusCode(201);
    }

    /**
     * Unlock the Organization resource in storage.
     *
     * @route DELETE /api/crm/organizations/lock/{organization} playground.crm.api.organizations.unlock
     */
    public function unlock(
        Organization $organization,
        Requests\Organization\UnlockRequest $request
    ): JsonResponse|Resources\Organization {

        $validated = $request->validated();

        $user = $request->user();

        $organization->locked = false;

        if ($user?->id) {
            $organization->modified_by_id = $user->id;
        }

        $organization->save();

        return (new Resources\Organization($organization))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }

    /**
     * Update the Organization resource in storage.
     *
     * @route PATCH /api/crm/organizations/{organization} playground.crm.api.organizations.patch
     */
    public function update(
        Organization $organization,
        Requests\Organization\UpdateRequest $request
    ): JsonResponse {

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $organization->modified_by_id = $user->id;
        }

        $organization->update($validated);

        return (new Resources\Organization($organization))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }
}
