<?php

namespace Modules\Marketplace\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Marketplace\Entities\LevelType;
use Modules\Marketplace\Http\Requests\CreateLevelTypeRequest;
use Modules\Marketplace\Http\Requests\UpdateLevelTypeRequest;
use Modules\Marketplace\Repositories\LevelTypeRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class LevelTypeController extends AdminBaseController
{
    /**
     * @var LevelTypeRepository
     */
    private $leveltype;

    public function __construct(LevelTypeRepository $leveltype)
    {
        parent::__construct();

        $this->leveltype = $leveltype;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$leveltypes = $this->leveltype->all();

        return view('marketplace::admin.leveltypes.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('marketplace::admin.leveltypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateLevelTypeRequest $request
     * @return Response
     */
    public function store(CreateLevelTypeRequest $request)
    {
        $this->leveltype->create($request->all());

        return redirect()->route('admin.marketplace.leveltype.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('marketplace::leveltypes.title.leveltypes')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  LevelType $leveltype
     * @return Response
     */
    public function edit(LevelType $leveltype)
    {
        return view('marketplace::admin.leveltypes.edit', compact('leveltype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LevelType $leveltype
     * @param  UpdateLevelTypeRequest $request
     * @return Response
     */
    public function update(LevelType $leveltype, UpdateLevelTypeRequest $request)
    {
        $this->leveltype->update($leveltype, $request->all());

        return redirect()->route('admin.marketplace.leveltype.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('marketplace::leveltypes.title.leveltypes')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  LevelType $leveltype
     * @return Response
     */
    public function destroy(LevelType $leveltype)
    {
        $this->leveltype->destroy($leveltype);

        return redirect()->route('admin.marketplace.leveltype.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('marketplace::leveltypes.title.leveltypes')]));
    }
}
