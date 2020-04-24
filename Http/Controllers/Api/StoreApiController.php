<?php

namespace Modules\Marketplace\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;
use Modules\Marketplace\Http\Requests\CreateStoreRequest;
use Modules\Marketplace\Http\Requests\UpdateStoreRequest;
use Modules\Marketplace\Repositories\StoreRepository;
use Modules\Marketplace\Transformers\StoreTransformer;
use Modules\Marketplace\Services\History;
use Exception;
use Modules\Setting\Contracts\Setting;

class StoreApiController extends BaseApiController
{
    /**
     * @var CategoryStoreRepository
     */
    private $store;

    private $setting;
    private $history;

    public function __construct(StoreRepository $store, History $history,Setting $setting)
    {
        parent::__construct();

        $this->setting = $setting;
        $this->store = $store;
        $this->history=$history;
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
            $dataEntity = $this->store->getItemsBy($params);

            //Response
            $response = ["data" => StoreTransformer::collection($dataEntity)];

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
            $dataEntity = $this->store->getItem($criteria, $params);

            //Break if no found item
            if (!$dataEntity) throw new \Exception('Item not found', 204);

            //Response
            $response = ["data" => new StoreTransformer($dataEntity)];

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
            $data = $request->input('attributes') ?? [];//Get data
            //Validate Request

            $this->validateRequestApi(new CreateStoreRequest($data));

            //Create item
            $dataEntity = $this->store->create($data);
            //History
            $this->history->create($request,$dataEntity->id);
            //Response
            $response = ["data" => new StoreTransformer($dataEntity)];
            \DB::commit(); //Commit to Data Base
        } catch (\Exception $e) {
            \DB::rollback();//Rollback to Data Base
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage(),'line'=>$e->getLine(),'trace'=>$e->getTrace()];
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
            $this->validateRequestApi(new UpdateStoreRequest($data));

            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);

            //Request to Repository
            $dataEntity = $this->store->getItem($criteria, $params);

            if (!$dataEntity) throw new Exception('Item not found', 204);

            // $response = ["data" => $dataEntity,'data2'=>$data];

            //Request to Repository
            $this->store->update($dataEntity, $data);

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
     * Rating the specified resource in storage.
     *
     * @param $criteria
     * @param Request $request
     * @return Response
     */
    public function rating($criteria, Request $request)
    {
        \DB::beginTransaction(); //DB Transaction
        try {
            //Get data
            $data = $request->input('attributes') ?? [];//Get data

            //Validate Request
            // $this->validateRequestApi(new UpdateStoreRequest($data));

            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);

            //Request to Repository
            $dataEntity = $this->store->getItem($criteria, $params);
            $oldRating=$dataEntity->sumRating();

            if (!$dataEntity) throw new Exception('Item not found', 204);
            $rating=\willvincent\Rateable\Rating::where('user_id',\Auth::id())
            ->where('rateable_id',$criteria)
            ->where('rateable_type',\Modules\Marketplace\Entities\Store::class)
            ->first();
            if ($rating) throw new Exception('Ya has calificado esta tienda.', 500);
            //Request to Repository
            $rating = new \willvincent\Rateable\Rating;
            $rating->rating = $data['rating'];
            $rating->user_id = \Auth::id();

            $dataEntity->ratings()->save($rating);
            $dataEntity->update(['sum_rating'=>$oldRating+$data['rating']]);


            $checkbox = $this->setting->get('iredeems::points-per-rating-product-checkbox');
            if($checkbox){
              $points=$this->setting->get('iredeems::points-per-rating-store');

              //Points by rating
              iredeems_StorePointUser([
                "user_id"=>\Auth::id(),
                "pointable_id"=>$criteria,
                "pointable_type"=>"store",
                "description"=>"Puntos por calificar una tienda",
                "points"=>$points
              ]);

            }//Checkbox

            //Response
            $response = ["data" => 'Rating successful'];
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
            $dataEntity = $this->store->getItem($criteria, $params);
            if (!$dataEntity) throw new Exception('Item not found', 204);
            //call Method delete
            $this->store->destroy($dataEntity);


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
            $dataEntity = $this->store->getItemsBy($params);
            $crterians = $dataEntity->pluck('id');
            $dataEntity = $this->store->updateItems($crterians, $data);
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
            $dataEntity = $this->store->getItemsBy($params);
            $crterians = $dataEntity->pluck('id');
            $this->store->deleteItems($crterians);
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
