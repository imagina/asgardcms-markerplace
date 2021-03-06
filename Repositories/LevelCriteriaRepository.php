<?php

namespace Modules\Marketplace\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface LevelCriteriaRepository extends BaseRepository
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


}
