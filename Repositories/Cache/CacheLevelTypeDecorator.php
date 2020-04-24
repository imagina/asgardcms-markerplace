<?php

namespace Modules\Marketplace\Repositories\Cache;

use Modules\Marketplace\Repositories\LevelTypeRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheLevelTypeDecorator extends BaseCacheDecorator implements LevelTypeRepository
{
    public function __construct(LevelTypeRepository $leveltype)
    {
        parent::__construct();
        $this->entityName = 'marketplace.leveltypes';
        $this->repository = $leveltype;
    }

    /**
     * Get all the read notifications for the given filters
     * @param array $params
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getItemsBy($params)
    {
        return $this->cache
            ->tags([$this->entityName, 'global'])
            ->remember(
                "{$this->locale}.{$this->entityName}.getItemBy",
                $this->cacheTime,
                function () use ($params) {
                    return $this->repository->getItemsBy($params);
                }
            );
    }

    /**
     * Get the read notification for the given filters
     * @param string $criteria
     * @param array $params
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getItem($criteria, $params)
    {
        return $this->cache
            ->tags([$this->entityName, 'global'])
            ->remember(
                "{$this->locale}.{$this->entityName}.getItem",
                $this->cacheTime,
                function () use ($criteria, $params) {
                    return $this->repository->getItem($criteria, $params);
                }
            );
    }
}
