<?php

namespace Modules\Marketplace\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;
use Modules\Marketplace\Http\Requests\CreateFavoriteStoreRequest;
use Modules\Marketplace\Http\Requests\UpdateFavoriteStoreRequest;
use Modules\Marketplace\Repositories\FavoriteStoreRepository;
use Modules\Marketplace\Transformers\FavoriteStoreTransformer;



class FavoriteStoreApiController extends BaseApiController
{
    /**
     * @var CategoryStoreRepository
     */
    private $favoriteStore;

   
    public function __construct(FavoriteStoreRepository $favoriteStore)
    {
        parent::__construct();

        $this->favoriteStore = $favoriteStore;

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
            $dataEntity = $this->favoriteStore->getItemsBy($params);

            //Response
            $response = ["data" => FavoriteStoreTransformer::collection($dataEntity)];

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
            $dataEntity = $this->favoriteStore->getItem($criteria, $params);

            //Break if no found item
            if (!$dataEntity) throw new \Exception('Item not found', 204);

            //Response
            $response = ["data" => new FavoriteStoreTransformer($dataEntity)];

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
            $data = $request->input('attributes') ?? [];//Get data
            //Validate Request

            $this->validateRequestApi(new CreateFavoriteStoreRequest($data));

            //Create item
            $dataEntity = $this->favoriteStore->create($data);
           
            //Response
            $response = ["data" => new FavoriteStoreTransformer($dataEntity)];
            \DB::commit(); //Commit to Data Base
        } catch (\Exception $e) {
            \Log::error($e);
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
            $this->validateRequestApi(new UpdateFavoriteStoreRequest($data));

            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);

            //Request to Repository
            $dataEntity = $this->favoriteStore->getItem($criteria, $params);

            if (!$dataEntity) throw new Exception('Item not found', 204);

            //Request to Repository
            $this->favoriteStore->update($dataEntity, $data);

            //Response
            $response = ["data" => 'Item Updated'];
            \DB::commit();//Commit to DataBase
        } catch (\Exception $e) {
            \Log::error($e);
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
            $dataEntity = $this->favoriteStore->getItem($criteria, $params);

            if (!$dataEntity) throw new Exception('Item not found', 204);
            //call Method delete
            $this->favoriteStore->destroy($dataEntity);


            //Response
            $response = ["data" => "Item deleted"];
            \DB::commit();//Commit to Data Base
        } catch (\Exception $e) {
            \Log::error($e);
            \DB::rollback();//Rollback to Data Base
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

   

}
