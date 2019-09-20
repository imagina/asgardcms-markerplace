<?php

namespace Modules\Marketplace\Services;

use Modules\Marketplace\Repositories\StoreHistoryRepository;
use Modules\User\Contracts\Authentication;

final class StoreHistory implements History
{
    /**
     * @var NotificationRepository
     */
    private $storeHistory;
    /**
     * @var Authentication
     */
    private $auth;
    /**
     * @var int
     */
    private $userId;

    public function __construct(StoreHistoryRepository $storeHistory, Authentication $auth)
    {
        $this->storeHistory = $storeHistory;
        $this->auth = $auth;
    }

    /**
     * Push a notification on the dashboard
     * @param $request
     * @return
     */
    public function create($request,$store)
    {
        $ip=$request->ip();
        $user= \Auth::user()->id;
        $change=json_encode($request->input('attributes'));
        $data=['ip'=>$ip,'change'=>$change,'user_id' => $user,'store_id'=>$store];
        $history=$this->storeHistory->create($data);
        dd($history);


    }


    /**
     * Set a user id to set the notification to
     * @param int $userId
     * @return $this
     */
    public function to($userId)
    {
        $this->userId = $userId;

        return $this;
    }


}
