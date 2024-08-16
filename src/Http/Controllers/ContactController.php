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
use Playground\Crm\Models\Contact;

/**
 * \Playground\Crm\Api\Http\Controllers\ContactController
 */
class ContactController extends Controller
{
    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'model_attribute' => 'title',
        'model_label' => 'Contact',
        'model_label_plural' => 'Contacts',
        'model_route' => 'playground.crm.api.contacts',
        'model_slug' => 'contact',
        'model_slug_plural' => 'contacts',
        'module_label' => 'CRM',
        'module_label_plural' => 'CRMS',
        'module_route' => 'playground.crm.api',
        'module_slug' => 'crm',
        'privilege' => 'playground-crm-api:contact',
        'table' => 'crm_contacts',
    ];

    /**
     * Create the Contact resource in storage.
     *
     * @route GET /api/crm/contacts/create playground.crm.api.contacts.create
     */
    public function create(
        Requests\Contact\CreateRequest $request
    ): JsonResponse|Resources\Contact {

        $validated = $request->validated();

        $user = $request->user();

        $contact = new Contact($validated);

        return (new Resources\Contact($contact))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }

    /**
     * Edit the Contact resource in storage.
     *
     * @route GET /api/crm/contacts/edit playground.crm.api.contacts.edit
     */
    public function edit(
        Contact $contact,
        Requests\Contact\EditRequest $request
    ): JsonResponse|Resources\Contact {
        return (new Resources\Contact($contact))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }

    /**
     * Remove the Contact resource from storage.
     *
     * @route DELETE /api/crm/contacts/{contact} playground.crm.api.contacts.destroy
     */
    public function destroy(
        Contact $contact,
        Requests\Contact\DestroyRequest $request
    ): Response {

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $contact->modified_by_id = $user->id;
        }

        if (empty($validated['force'])) {
            $contact->delete();
        } else {
            $contact->forceDelete();
        }

        return response()->noContent();
    }

    /**
     * Lock the Contact resource in storage.
     *
     * @route PUT /api/crm/contacts/{contact} playground.crm.api.contacts.lock
     */
    public function lock(
        Contact $contact,
        Requests\Contact\LockRequest $request
    ): JsonResponse|Resources\Contact {

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $contact->modified_by_id = $user->id;
        }

        $contact->locked = true;

        $contact->save();

        return (new Resources\Contact($contact))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }

    /**
     * Display a listing of Contact resources.
     *
     * @route GET /api/crm/contacts playground.crm.api.contacts
     */
    public function index(
        Requests\Contact\IndexRequest $request
    ): JsonResponse|Resources\ContactCollection {

        $user = $request->user();

        $validated = $request->validated();

        $query = Contact::addSelect(sprintf('%1$s.*', $this->packageInfo['table']));

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

        return (new Resources\ContactCollection($paginator))->response($request);
    }

    /**
     * Restore the Contact resource from the trash.
     *
     * @route PUT /api/crm/contacts/restore/{contact} playground.crm.api.contacts.restore
     */
    public function restore(
        Contact $contact,
        Requests\Contact\RestoreRequest $request
    ): JsonResponse|Resources\Contact {

        $user = $request->user();

        if ($user?->id) {
            $contact->modified_by_id = $user->id;
        }

        $contact->restore();

        return (new Resources\Contact($contact))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }

    /**
     * Display the Contact resource.
     *
     * @route GET /api/crm/contacts/{contact} playground.crm.api.contacts.show
     */
    public function show(
        Contact $contact,
        Requests\Contact\ShowRequest $request
    ): JsonResponse|Resources\Contact {
        return (new Resources\Contact($contact))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }

    /**
     * Store a newly created API Contact resource in storage.
     *
     * @route POST /api/crm/contacts playground.crm.api.contacts.post
     */
    public function store(
        Requests\Contact\StoreRequest $request
    ): Response|JsonResponse|Resources\Contact {
        $validated = $request->validated();

        $user = $request->user();

        $contact = new Contact($validated);

        $contact->created_by_id = $user?->id;

        $contact->save();

        return (new Resources\Contact($contact))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request)->setStatusCode(201);
    }

    /**
     * Unlock the Contact resource in storage.
     *
     * @route DELETE /api/crm/contacts/lock/{contact} playground.crm.api.contacts.unlock
     */
    public function unlock(
        Contact $contact,
        Requests\Contact\UnlockRequest $request
    ): JsonResponse|Resources\Contact {

        $validated = $request->validated();

        $user = $request->user();

        $contact->locked = false;

        if ($user?->id) {
            $contact->modified_by_id = $user->id;
        }

        $contact->save();

        return (new Resources\Contact($contact))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }

    /**
     * Update the Contact resource in storage.
     *
     * @route PATCH /api/crm/contacts/{contact} playground.crm.api.contacts.patch
     */
    public function update(
        Contact $contact,
        Requests\Contact\UpdateRequest $request
    ): JsonResponse {

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $contact->modified_by_id = $user->id;
        }

        $contact->update($validated);

        return (new Resources\Contact($contact))->additional(['meta' => [
            'info' => $this->packageInfo,
        ]])->response($request);
    }
}
