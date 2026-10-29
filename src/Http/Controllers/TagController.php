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
use Playground\Crm\Models\Tag;

/**
 * \Playground\Crm\Api\Http\Controllers\TagController
 */
class TagController extends Controller
{
    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'model_attribute' => 'title',
        'model_camel' => 'tag',
        'model_camels' => 'tags',
        'model_kebab' => 'tag',
        'model_kebabs' => 'tags',
        'model_lower' => 'tag',
        'model_lowers' => 'tags',
        'model_label' => 'Tag',
        'model_labels' => 'Tags',
        'model_label_plural' => 'Tags',
        'model_route' => 'playground.crm.api.tags',
        'model_route_param' => 'tag',
        'model_slug' => 'tag',
        'model_slugs' => 'tags',
        'model_slug_plural' => 'tags',
        'model_snake' => 'tag',
        'model_snakes' => 'tags',
        'model_studly' => 'Tag',
        'model_studlies' => 'Tags',
        'model_variable' => 'tag',
        'model_variables' => 'tags',
        'model_variable_plural' => 'tags',
        'module_label' => 'CRM',
        'module_labels' => 'CRMs',
        'module_label_plural' => 'CRMs',
        'module_route' => 'playground.crm.api',
        'module_slug' => 'crm',
        'module_slugs' => 'crms',
        'privilege' => 'playground-crm-api:tag',
        'table' => 'crm_tags',
    ];

    /**
     * Create the Tag resource in storage.
     *
     * @route GET /api/crm/tags/create playground.crm.api.tags.create
     */
    public function create(
        Requests\Tag\CreateRequest $request
    ): JsonResponse|Resources\Tag {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $tag = new Tag($validated);

        return new Resources\Tag($tag)->additional(['meta' => [
            'info' => $packageInfo,
        ]])->response($request);
    }

    /**
     * Edit the Tag resource in storage.
     *
     * @route GET /api/crm/tags/edit/{tag} playground.crm.api.tags.edit
     */
    public function edit(
        Tag $tag,
        Requests\Tag\EditRequest $request
    ): JsonResponse|Resources\Tag {

        $packageInfo = $this->packageInfo();

        return new Resources\Tag($tag)->additional(['meta' => [
            'info' => $packageInfo,
        ]])->response($request);
    }

    /**
     * Remove the Tag resource from storage.
     *
     * @route DELETE /api/crm/tags/{tag} playground.crm.api.tags.destroy
     */
    public function destroy(
        Tag $tag,
        Requests\Tag\DestroyRequest $request
    ): Response {

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $tag->modified_by_id = $user->id;
        }

        if (empty($validated['force'])) {
            $tag->delete();
        } else {
            $tag->forceDelete();
        }

        return response()->noContent();
    }

    /**
     * Lock the Tag resource in storage.
     *
     * @route PUT /api/crm/tags/{tag} playground.crm.api.tags.lock
     */
    public function lock(
        Tag $tag,
        Requests\Tag\LockRequest $request
    ): JsonResponse|Resources\Tag {

        $packageInfo = $this->packageInfo();

        $user = $request->user();

        if ($user?->id) {
            $tag->modified_by_id = $user->id;
        }

        $tag->locked = true;

        $tag->save();

        return new Resources\Tag($tag)->additional(['meta' => [
            'info' => $packageInfo,
        ]])->response($request);
    }

    /**
     * Display a listing of Tag resources.
     *
     * @route GET /api/crm/tags playground.crm.api.tags
     */
    public function index(
        Requests\Tag\IndexRequest $request
    ): JsonResponse|Resources\TagCollection {

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

        $query = Tag::addSelect(sprintf('%1$s.*', $packageInfo->table()));

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

        return new Resources\TagCollection($paginator)->response($request);
    }

    /**
     * Restore the Tag resource from the trash.
     *
     * @route PUT /api/crm/tags/restore/{tag} playground.crm.api.tags.restore
     */
    public function restore(
        Tag $tag,
        Requests\Tag\RestoreRequest $request
    ): JsonResponse|Resources\Tag {

        $packageInfo = $this->packageInfo();

        $user = $request->user();

        $tag->modified_by_id = $user?->id;

        $tag->restore();

        return new Resources\Tag($tag)->additional(['meta' => [
            'info' => $packageInfo,
        ]])->response($request);
    }

    /**
     * Display the Tag resource.
     *
     * @route GET /api/crm/tags/{tag} playground.crm.api.tags.show
     */
    public function show(
        Tag $tag,
        Requests\Tag\ShowRequest $request
    ): JsonResponse|Resources\Tag {

        $packageInfo = $this->packageInfo();

        return new Resources\Tag($tag)->additional(['meta' => [
            'info' => $packageInfo,
        ]])->response($request);
    }

    /**
     * Store a newly created API Tag resource in storage.
     *
     * @route POST /api/crm/tags playground.crm.api.tags.post
     */
    public function store(
        Requests\Tag\StoreRequest $request
    ): Response|JsonResponse|Resources\Tag {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        $tag = new Tag($validated);

        $tag->created_by_id = $user?->id;

        $tag->save();

        return new Resources\Tag($tag)->additional(['meta' => [
            'info' => $packageInfo,
        ]])->response($request)->setStatusCode(201);
    }

    /**
     * Unlock the Tag resource in storage.
     *
     * @route DELETE /api/crm/tags/lock/{tag} playground.crm.api.tags.unlock
     */
    public function unlock(
        Tag $tag,
        Requests\Tag\UnlockRequest $request
    ): JsonResponse|Resources\Tag {

        $packageInfo = $this->packageInfo();

        $user = $request->user();

        $tag->locked = false;

        $tag->modified_by_id = $user?->id;

        $tag->save();

        return new Resources\Tag($tag)->additional(['meta' => [
            'info' => $packageInfo,
        ]])->response($request);
    }

    /**
     * Update the Tag resource in storage.
     *
     * @route PATCH /api/crm/tags/{tag} playground.crm.api.tags.patch
     */
    public function update(
        Tag $tag,
        Requests\Tag\UpdateRequest $request
    ): JsonResponse {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        $tag->modified_by_id = $user?->id;

        $tag->update($validated);

        return new Resources\Tag($tag)->additional(['meta' => [
            'info' => $packageInfo,
        ]])->response($request);
    }
}
