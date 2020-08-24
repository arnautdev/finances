<?php

namespace Modules\Common\Traits;


use Modules\Common\Entities\SeoOptimization;

trait SeoAwareTrait
{

    /**
     * Get seo
     * @return mixed
     */
    public function getSeo()
    {
        return $this->hasOne(SeoOptimization::class, 'itemId', 'id')->firstOrNew([], []);
    }
}