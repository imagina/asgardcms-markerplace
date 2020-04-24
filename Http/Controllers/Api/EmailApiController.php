<?php

namespace Modules\Marketplace\Http\Controllers\Api;

// Requests & Response
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;
use Illuminate\Support\Facades\Mail;

class EmailApiController extends BaseApiController
{
    public function __construct()
    {}


    /**
     * CREATE A ITEM
     *
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {

        \DB::beginTransaction();
        try {

            $data = (object)$request->input('attributes') ?? [];//Get data
            \Log::error($request->input('attributes') );
            $email=$data->store_email;
            $sender=$data->name;

            $title="Solisitud de servicio - ". $data->service;
            $from=$data->email;

            \Mail::send(['marketplace::frontend.emails.form', 'marketplace::frontend.emails.textform'],
                [
                    'data' => $data,
                ], function ($message) use ($email, $sender, $title,$from) {
                    $message->to($email, $sender)
                        ->from($from, $sender)
                        ->subject($title);
                });

            //Response
            $response = ["data" => trans('Marketplace::leads.messages.message sent successfully')];
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

}
