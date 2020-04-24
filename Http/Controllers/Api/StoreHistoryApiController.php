<?php

namespace Modules\Marketplace\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;
use Modules\Marketplace\Http\Requests\CreateStoreHistoryRequest;
use Modules\Marketplace\Http\Requests\UpdateStoreHistoryRequest;
use Modules\Marketplace\Repositories\StoreHistoryRepository;
use Modules\Marketplace\Transformers\StoreHistoryTransformer;


class StoreHistoryApiController extends BaseApiController
{
    /**
     * @var CategoryStoreRepository
     */
    private $storeHistory;

    public function __construct(StoreHistoryRepository $storeHistory)
    {
        parent::__construct();

        $this->storeHistory = $storeHistory;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        try {
            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);

            //Request to Repository
            $dataEntity = $this->storeHistory->getItemsBy($params);

            //Response
            $response = ["data" => StoreHistoryTransformer::collection($dataEntity)];

            //If request pagination add meta-page
            $params->page ? $response["meta"] = ["page" => $this->pageTransformer($dataEntity)] : false;
        } catch (\Exception $e) {
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $criteria
     * @param Request $request
     * @return Response
     */
    public function show($criteria, Request $request)
    {
        try {
            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);

            //Request to Repository
            $dataEntity = $this->storeHistory->getItem($criteria, $params);

            //Break if no found item
            if (!$dataEntity) throw new Exception('Item not found', 204);

            //Response
            $response = ["data" => new StoreHistoryTransformer($dataEntity)];

            //If request pagination add meta-page
            $params->page ? $response["meta"] = ["page" => $this->pageTransformer($dataEntity)] : false;
        } catch (\Exception $e) {
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */

    public function create(Request $request)
    {
        \DB::beginTransaction();
        try {
            
            dd($request);
            $data = $request->input('attributes') ?? [];//Get data  
            //Validate Request
            $this->validateRequestApi(new CreateStoreHistoryRequest($data));

            //Create item
            $dataEntity = $this->storeHistory->create($data);

            //Response
            $response = ["data" => new StoreHistoryTransformer($dataEntity)];
            \DB::commit(); //Commit to Data Base
        } catch (\Exception $e) {
            \DB::rollback();//Rollback to Data Base
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }
        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param $criteria
     * @param Request $request
     * @return Response
     */
    public function update($criteria, Request $request)
    {
        \DB::beginTransaction(); //DB Transaction
        try {
            //Get data
            $data = $request->input('attributes') ?? [];//Get data

            //Validate Request
            $this->validateRequestApi(new UpdateStoreHistoryRequest($data));

            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);

            //Request to Repository
            $dataEntity = $this->storeHistory->getItem($criteria, $params);

            if (!$dataEntity) throw new Exception('Item not found', 204);

            //Request to Repository
            $this->storeHistory->update($dataEntity, $data);

            //Response
            $response = ["data" => 'Item Updated'];
            \DB::commit();//Commit to DataBase
        } catch (\Exception $e) {
            \DB::rollback();//Rollback to Data Base
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $criteria
     * @param Request $request
     * @return Response
     */

    public function delete($criteria, Request $request)
    {
        \DB::beginTransaction();
        try {
            //Get params
            $params = $this->getParamsRequest($request);

            //Request to Repository
            $dataEntity = $this->storeHistory->getItem($criteria, $params);
            if (!$dataEntity) throw new Exception('Item not found', 204);
            //call Method delete
            $this->storeHistory->delete($dataEntity);


            //Response
            $response = ["data" => "Item deleted"];
            \DB::commit();//Commit to Data Base
        } catch (\Exception $e) {
            \DB::rollback();//Rollback to Data Base
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    public function updateAll(Request $request)
    {
        try {
            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);
            $data = $request->input('attributes') ?? [];//Get data
            //Request to Repository
            $dataEntity = $this->storeHistory->getItemsBy($params);
            $crterians = $dataEntity->pluck('id');
            $dataEntity = $this->storeHistory->updateItems($crterians, $data);
            //Response
            $response = ["data" => NotificationTransformer::collection($dataEntity)];
            //If request pagination add meta-page
            $params->page ? $response["meta"] = ["page" => $this->pageTransformer($dataEntity)] : false;
        } catch (\Exception $e) {
            \Log::error($e);
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    public function deleteAll(Request $request)
    {
        try {
            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);
            //Request to Repository
            $dataEntity = $this->storeHistory->getItemsBy($params);
            $crterians = $dataEntity->pluck('id');
            $this->storeHistory->deleteItems($crterians);
            //Response
            $response = ["data" => "Items deleted"];

        } catch (\Exception $e) {
            \Log::error($e);
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

}
