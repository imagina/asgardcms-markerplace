<?php

namespace Modules\Marketplace\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Marketplace\Entities\FavoriteStore;
use Modules\Marketplace\Http\Requests\CreateFavoriteStoreRequest;
use Modules\Marketplace\Http\Requests\UpdateFavoriteStoreRequest;
use Modules\Marketplace\Repositories\FavoriteStoreRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class FavoriteStoreController extends AdminBaseController
{
    /**
     * @var FavoriteStoreRepository
     */
    private $favoritestore;

    public function __construct(FavoriteStoreRepository $favoritestore)
    {
        parent::__construct();

        $this->favoritestore = $favoritestore;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$favoritestores = $this->favoritestore->all();

        return view('marketplace::admin.favoritestores.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('marketplace::admin.favoritestores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateFavoriteStoreRequest $request
     * @return Response
     */
    public function store(CreateFavoriteStoreRequest $request)
    {
        $this->favoritestore->create($request->all());

        return redirect()->route('admin.marketplace.favoritestore.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('marketplace::favoritestores.title.favoritestores')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  FavoriteStore $favoritestore
     * @return Response
     */
    public function edit(FavoriteStore $favoritestore)
    {
        return view('marketplace::admin.favoritestores.edit', compact('favoritestore'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  FavoriteStore $favoritestore
     * @param  UpdateFavoriteStoreRequest $request
     * @return Response
     */
    public function update(FavoriteStore $favoritestore, UpdateFavoriteStoreRequest $request)
    {
        $this->favoritestore->update($favoritestore, $request->all());

        return redirect()->route('admin.marketplace.favoritestore.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('marketplace::favoritestores.title.favoritestores')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  FavoriteStore $favoritestore
     * @return Response
     */
    public function destroy(FavoriteStore $favoritestore)
    {
        $this->favoritestore->destroy($favoritestore);

        return redirect()->route('admin.marketplace.favoritestore.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('marketplace::favoritestores.title.favoritestores')]));
    }
}
