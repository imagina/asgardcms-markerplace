<?php

namespace Modules\Marketplace\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Marketplace\Entities\Themes;
use Modules\Marketplace\Http\Requests\CreateThemesRequest;
use Modules\Marketplace\Http\Requests\UpdateThemesRequest;
use Modules\Marketplace\Repositories\ThemesRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ThemesController extends AdminBaseController
{
    /**
     * @var ThemesRepository
     */
    private $themes;

    public function __construct(ThemesRepository $themes)
    {
        parent::__construct();

        $this->themes = $themes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$themes = $this->themes->all();

        return view('marketplace::admin.themes.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('marketplace::admin.themes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateThemesRequest $request
     * @return Response
     */
    public function store(CreateThemesRequest $request)
    {
        $this->themes->create($request->all());

        return redirect()->route('admin.marketplace.themes.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('marketplace::themes.title.themes')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Themes $themes
     * @return Response
     */
    public function edit(Themes $themes)
    {
        return view('marketplace::admin.themes.edit', compact('themes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Themes $themes
     * @param  UpdateThemesRequest $request
     * @return Response
     */
    public function update(Themes $themes, UpdateThemesRequest $request)
    {
        $this->themes->update($themes, $request->all());

        return redirect()->route('admin.marketplace.themes.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('marketplace::themes.title.themes')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Themes $themes
     * @return Response
     */
    public function destroy(Themes $themes)
    {
        $this->themes->destroy($themes);

        return redirect()->route('admin.marketplace.themes.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('marketplace::themes.title.themes')]));
    }
}
