<?php

namespace Modules\Marketplace\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface CommentRepository extends BaseRepository
{
    /**
     * Get all the read notifications for the given filters
     * @param array $params
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getItemsBy($params);

    /**
     * Get the read notification for the given filters
     * @param string $criteria
     * @param array $params
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getItem($criteria, $params);


    /**
     * Update the notifications for the given ids
     * @param array $criterias
     * @param array $data
     * @return bool
     */
    public function updateItems($criterias, $data);

    /**
     * Delete the notifications for the given ids
     * @param array $criterias
     * @return bool
     */
    public function deleteItems($criterias);
}
