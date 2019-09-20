<?php

namespace Modules\Marketplace\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Marketplace\Entities\CategoryStore;
use Modules\Marketplace\Http\Requests\CreateCategoryStoreRequest;
use Modules\Marketplace\Http\Requests\UpdateCategoryStoreRequest;
use Modules\Marketplace\Repositories\CategoryStoreRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class CategoryStoreController extends AdminBaseController
{
    /**
     * @var CategoryStoreRepository
     */
    private $categorystore;

    public function __construct(CategoryStoreRepository $categorystore)
    {
        parent::__construct();

        $this->categorystore = $categorystore;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$categorystores = $this->categorystore->all();

        return view('marketplace::admin.categorystores.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('marketplace::admin.categorystores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCategoryStoreRequest $request
     * @return Response
     */
    public function store(CreateCategoryStoreRequest $request)
    {
        $this->categorystore->create($request->all());

        return redirect()->route('admin.marketplace.categorystore.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('marketplace::categorystores.title.categorystores')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  CategoryStore $categorystore
     * @return Response
     */
    public function edit(CategoryStore $categorystore)
    {
        return view('marketplace::admin.categorystores.edit', compact('categorystore'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryStore $categorystore
     * @param  UpdateCategoryStoreRequest $request
     * @return Response
     */
    public function update(CategoryStore $categorystore, UpdateCategoryStoreRequest $request)
    {
        $this->categorystore->update($categorystore, $request->all());

        return redirect()->route('admin.marketplace.categorystore.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('marketplace::categorystores.title.categorystores')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  CategoryStore $categorystore
     * @return Response
     */
    public function destroy(CategoryStore $categorystore)
    {
        $this->categorystore->destroy($categorystore);

        return redirect()->route('admin.marketplace.categorystore.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('marketplace::categorystores.title.categorystores')]));
    }
}
