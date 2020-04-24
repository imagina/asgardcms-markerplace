<?php

namespace Modules\Marketplace\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Marketplace\Entities\Benefits;
use Modules\Marketplace\Http\Requests\CreateBenefitsRequest;
use Modules\Marketplace\Http\Requests\UpdateBenefitsRequest;
use Modules\Marketplace\Repositories\BenefitsRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class BenefitsController extends AdminBaseController
{
    /**
     * @var BenefitsRepository
     */
    private $benefits;

    public function __construct(BenefitsRepository $benefits)
    {
        parent::__construct();

        $this->benefits = $benefits;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$benefits = $this->benefits->all();

        return view('marketplace::admin.benefits.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('marketplace::admin.benefits.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateBenefitsRequest $request
     * @return Response
     */
    public function store(CreateBenefitsRequest $request)
    {
        $this->benefits->create($request->all());

        return redirect()->route('admin.marketplace.benefits.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('marketplace::benefits.title.benefits')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Benefits $benefits
     * @return Response
     */
    public function edit(Benefits $benefits)
    {
        return view('marketplace::admin.benefits.edit', compact('benefits'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Benefits $benefits
     * @param  UpdateBenefitsRequest $request
     * @return Response
     */
    public function update(Benefits $benefits, UpdateBenefitsRequest $request)
    {
        $this->benefits->update($benefits, $request->all());

        return redirect()->route('admin.marketplace.benefits.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('marketplace::benefits.title.benefits')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Benefits $benefits
     * @return Response
     */
    public function destroy(Benefits $benefits)
    {
        $this->benefits->destroy($benefits);

        return redirect()->route('admin.marketplace.benefits.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('marketplace::benefits.title.benefits')]));
    }
}
