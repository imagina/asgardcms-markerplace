<?php

namespace Modules\Marketplace\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Marketplace\Entities\StoreContact;
use Modules\Marketplace\Http\Requests\CreateStoreContactRequest;
use Modules\Marketplace\Http\Requests\UpdateStoreContactRequest;
use Modules\Marketplace\Repositories\StoreContactRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class StoreContactController extends AdminBaseController
{
    /**
     * @var StoreContactRepository
     */
    private $storecontact;

    public function __construct(StoreContactRepository $storecontact)
    {
        parent::__construct();

        $this->storecontact = $storecontact;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$storecontacts = $this->storecontact->all();

        return view('marketplace::admin.storecontacts.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('marketplace::admin.storecontacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateStoreContactRequest $request
     * @return Response
     */
    public function store(CreateStoreContactRequest $request)
    {
        $this->storecontact->create($request->all());

        return redirect()->route('admin.marketplace.storecontact.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('marketplace::storecontacts.title.storecontacts')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  StoreContact $storecontact
     * @return Response
     */
    public function edit(StoreContact $storecontact)
    {
        return view('marketplace::admin.storecontacts.edit', compact('storecontact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreContact $storecontact
     * @param  UpdateStoreContactRequest $request
     * @return Response
     */
    public function update(StoreContact $storecontact, UpdateStoreContactRequest $request)
    {
        $this->storecontact->update($storecontact, $request->all());

        return redirect()->route('admin.marketplace.storecontact.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('marketplace::storecontacts.title.storecontacts')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  StoreContact $storecontact
     * @return Response
     */
    public function destroy(StoreContact $storecontact)
    {
        $this->storecontact->destroy($storecontact);

        return redirect()->route('admin.marketplace.storecontact.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('marketplace::storecontacts.title.storecontacts')]));
    }
}
