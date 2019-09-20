<?php

namespace Modules\Marketplace\Repositories\Cache;

use Modules\Marketplace\Repositories\ThemesRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheThemesDecorator extends BaseCacheDecorator implements ThemesRepository
{
    public function __construct(ThemesRepository $themes)
    {
        parent::__construct();
        $this->entityName = 'marketplace.themes';
        $this->repository = $themes;
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

    /**
     * Update the notifications for the given ids
     * @param array $criterias
     * @param array $data
     * @return bool
     */
    public function updateItems($criterias, $data)
    {
        $this->cache->tags($this->entityName)->flush();

        return $this->repository->updateItems($criterias, $data);
    }

    /**
     * Delete the notifications for the given ids
     * @param array $criterias
     * @return bool
     */
    public function deleteItems($criterias)
    {
        $this->cache->tags($this->entityName)->flush();

        return $this->repository->deleteItems($criterias);
    }
}
