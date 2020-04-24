<?php

namespace Modules\Marketplace\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Marketplace\Entities\LevelCriteria;
use Modules\Marketplace\Http\Requests\CreateLevelCriteriaRequest;
use Modules\Marketplace\Http\Requests\UpdateLevelCriteriaRequest;
use Modules\Marketplace\Repositories\LevelCriteriaRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class LevelCriteriaController extends AdminBaseController
{
    /**
     * @var LevelCriteriaRepository
     */
    private $levelcriteria;

    public function __construct(LevelCriteriaRepository $levelcriteria)
    {
        parent::__construct();

        $this->levelcriteria = $levelcriteria;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$levelcriterias = $this->levelcriteria->all();

        return view('marketplace::admin.levelcriterias.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('marketplace::admin.levelcriterias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateLevelCriteriaRequest $request
     * @return Response
     */
    public function store(CreateLevelCriteriaRequest $request)
    {
        $this->levelcriteria->create($request->all());

        return redirect()->route('admin.marketplace.levelcriteria.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('marketplace::levelcriterias.title.levelcriterias')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  LevelCriteria $levelcriteria
     * @return Response
     */
    public function edit(LevelCriteria $levelcriteria)
    {
        return view('marketplace::admin.levelcriterias.edit', compact('levelcriteria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LevelCriteria $levelcriteria
     * @param  UpdateLevelCriteriaRequest $request
     * @return Response
     */
    public function update(LevelCriteria $levelcriteria, UpdateLevelCriteriaRequest $request)
    {
        $this->levelcriteria->update($levelcriteria, $request->all());

        return redirect()->route('admin.marketplace.levelcriteria.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('marketplace::levelcriterias.title.levelcriterias')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  LevelCriteria $levelcriteria
     * @return Response
     */
    public function destroy(LevelCriteria $levelcriteria)
    {
        $this->levelcriteria->destroy($levelcriteria);

        return redirect()->route('admin.marketplace.levelcriteria.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('marketplace::levelcriterias.title.levelcriterias')]));
    }
}
