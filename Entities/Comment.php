<?php

namespace Modules\Marketplace\Entities;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{


    protected $table = 'marketplace__comments';

    protected $fillable = ['body','commentable_id','commentable_type','user_id'];


    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * Magic Method modification to allow dynamic relations to other entities.
     * @var $value
     * @var $destination_path
     * @return string
     */
    public function __call($method, $parameters)
    {
        #i: Convert array to dot notation
        $config = implode('.', ['asgard.marketplace.config.relations.comment', $method]);

        #i: Relation method resolver
        if (config()->has($config)) {
            $function = config()->get($config);

            return $function($this);
        }

        #i: No relation found, return the call to parent (Eloquent) to handle it.
        return parent::__call($method, $parameters);
    }

}
