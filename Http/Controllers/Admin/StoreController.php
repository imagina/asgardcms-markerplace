<?php

namespace Modules\Marketplace\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Marketplace\Entities\Store;
use Modules\Marketplace\Http\Requests\CreateStoreRequest;
use Modules\Marketplace\Http\Requests\UpdateStoreRequest;
use Modules\Marketplace\Repositories\StoreRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class StoreController extends AdminBaseController
{
    /**
     * @var StoreRepository
     */
    private $store;

    public function __construct(StoreRepository $store)
    {
        parent::__construct();

        $this->store = $store;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$stores = $this->store->all();

        return view('marketplace::admin.stores.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('marketplace::admin.stores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateStoreRequest $request
     * @return Response
     */
    public function store(CreateStoreRequest $request)
    {
        $this->store->create($request->all());

        return redirect()->route('admin.marketplace.store.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('marketplace::stores.title.stores')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Store $store
     * @return Response
     */
    public function edit(Store $store)
    {
        return view('marketplace::admin.stores.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Store $store
     * @param  UpdateStoreRequest $request
     * @return Response
     */
    public function update(Store $store, UpdateStoreRequest $request)
    {
        $this->store->update($store, $request->all());

        return redirect()->route('admin.marketplace.store.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('marketplace::stores.title.stores')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Store $store
     * @return Response
     */
    public function destroy(Store $store)
    {
        $this->store->destroy($store);

        return redirect()->route('admin.marketplace.store.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('marketplace::stores.title.stores')]));
    }
}
