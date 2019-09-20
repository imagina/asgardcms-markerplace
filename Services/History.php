<?php

namespace Modules\Marketplace\Services;

interface History
{
    /**
     * Push a notification on the dashboard
     * @param $request
     * @param $store
     * @return
     */
    public function create($request, $store);

}
