<?php

namespace Modules\Marketplace\Repositories\Cache;

use Modules\Marketplace\Repositories\BenefitsRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheBenefitsDecorator extends BaseCacheDecorator implements BenefitsRepository
{
    public function __construct(BenefitsRepository $benefits)
    {
        parent::__construct();
        $this->entityName = 'marketplace.benefits';
        $this->repository = $benefits;
    }
}
