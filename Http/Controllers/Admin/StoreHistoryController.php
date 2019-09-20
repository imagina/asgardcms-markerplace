<?php

namespace Modules\Marketplace\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Marketplace\Entities\StoreHistory;
use Modules\Marketplace\Http\Requests\CreateStoreHistoryRequest;
use Modules\Marketplace\Http\Requests\UpdateStoreHistoryRequest;
use Modules\Marketplace\Repositories\StoreHistoryRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class StoreHistoryController extends AdminBaseController
{
    /**
     * @var StoreHistoryRepository
     */
    private $storehistory;

    public function __construct(StoreHistoryRepository $storehistory)
    {
        parent::__construct();

        $this->storehistory = $storehistory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$storehistories = $this->storehistory->all();

        return view('marketplace::admin.storehistories.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('marketplace::admin.storehistories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateStoreHistoryRequest $request
     * @return Response
     */
    public function store(CreateStoreHistoryRequest $request)
    {
        $this->storehistory->create($request->all());

        return redirect()->route('admin.marketplace.storehistory.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('marketplace::storehistories.title.storehistories')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  StoreHistory $storehistory
     * @return Response
     */
    public function edit(StoreHistory $storehistory)
    {
        return view('marketplace::admin.storehistories.edit', compact('storehistory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreHistory $storehistory
     * @param  UpdateStoreHistoryRequest $request
     * @return Response
     */
    public function update(StoreHistory $storehistory, UpdateStoreHistoryRequest $request)
    {
        $this->storehistory->update($storehistory, $request->all());

        return redirect()->route('admin.marketplace.storehistory.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('marketplace::storehistories.title.storehistories')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  StoreHistory $storehistory
     * @return Response
     */
    public function destroy(StoreHistory $storehistory)
    {
        $this->storehistory->destroy($storehistory);

        return redirect()->route('admin.marketplace.storehistory.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('marketplace::storehistories.title.storehistories')]));
    }
}
