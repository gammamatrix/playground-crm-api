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
use Playground\Crm\Models\Tagged;

/**
 * \Playground\Crm\Api\Http\Controllers\TaggedController
 */
class TaggedController extends Controller
{
    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'model_attribute' => 'tag_id',
        'model_camel' => 'tagged',
        'model_camels' => 'tagged',
        'model_kebab' => 'tagged',
        'model_kebabs' => 'tagged',
        'model_lower' => 'tagged',
        'model_lowers' => 'tagged',
        'model_label' => 'Tagged',
        'model_labels' => 'Tagged',
        'model_label_plural' => 'Tagged',
        'model_route' => 'playground.crm.api.tagged',
        'model_route_param' => 'tagged',
        'model_slug' => 'tagged',
        'model_slugs' => 'tagged',
        'model_slug_plural' => 'tagged',
        'model_snake' => 'tagged',
        'model_snakes' => 'tagged',
        'model_studly' => 'Tagged',
        'model_studlies' => 'Tagged',
        'model_variable' => 'tagged',
        'model_variables' => 'tagged',
        'model_variable_plural' => 'tagged',
        'module_label' => 'CRM',
        'module_labels' => 'CRMs',
        'module_label_plural' => 'CRMs',
        'module_route' => 'playground.crm.api',
        'module_slug' => 'crm',
        'module_slugs' => 'crms',
        'privilege' => 'playground-crm-api',
        'table' => 'crm_tagged',
    ];

    /**
     * Remove the Tagged resource from storage.
     *
     * @route DELETE /api/crm/tagged/{tagged} playground.crm.api.tagged.destroy
     */
    public function destroy(
        Tagged $tagged,
        Requests\Tagged\DestroyRequest $request
    ): Response {

        $validated = $request->validated();

        $tagged->delete();

        return response()->noContent();
    }

    /**
     * Store a newly created API Tagged resource in storage.
     *
     * @route POST /api/crm/tagged playground.crm.api.tagged.post
     */
    public function store(
        Requests\Tagged\StoreRequest $request
    ): Response|JsonResponse|Resources\Tagged {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        $tagged = new Tagged($validated);

        $tagged->created_by_id = $user?->id;

        $tagged->save();

        return new Resources\Tagged($tagged)->additional(['meta' => [
            'info' => $packageInfo,
        ]])->response($request)->setStatusCode(201);
    }
}
