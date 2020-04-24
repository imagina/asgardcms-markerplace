<?php

namespace Modules\Marketplace\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Marketplace\Entities\Level;
use Modules\Marketplace\Http\Requests\CreateLevelRequest;
use Modules\Marketplace\Http\Requests\UpdateLevelRequest;
use Modules\Marketplace\Repositories\LevelRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class LevelController extends AdminBaseController
{
    /**
     * @var LevelRepository
     */
    private $level;

    public function __construct(LevelRepository $level)
    {
        parent::__construct();

        $this->level = $level;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$levels = $this->level->all();

        return view('marketplace::admin.levels.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('marketplace::admin.levels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateLevelRequest $request
     * @return Response
     */
    public function store(CreateLevelRequest $request)
    {
        $this->level->create($request->all());

        return redirect()->route('admin.marketplace.level.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('marketplace::levels.title.levels')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Level $level
     * @return Response
     */
    public function edit(Level $level)
    {
        return view('marketplace::admin.levels.edit', compact('level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Level $level
     * @param  UpdateLevelRequest $request
     * @return Response
     */
    public function update(Level $level, UpdateLevelRequest $request)
    {
        $this->level->update($level, $request->all());

        return redirect()->route('admin.marketplace.level.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('marketplace::levels.title.levels')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Level $level
     * @return Response
     */
    public function destroy(Level $level)
    {
        $this->level->destroy($level);

        return redirect()->route('admin.marketplace.level.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('marketplace::levels.title.levels')]));
    }
}
