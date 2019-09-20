<?php

namespace Modules\Marketplace\Entities;

use Illuminate\Database\Eloquent\Model;

class StoreTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','slug','slogan','description','meta_title','meta_description','meta_keywords','translatable_options'];
    protected $table = 'marketplace__store_translations';

    protected $casts = [
        'translatable_options' => 'array'
    ];
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function getTranslatableOptionsAttribute($value) {

        $options=json_decode($value);
        return $options;
    }
    /**
     * @return mixed
     */
    public function getMetaTitleAttribute(){

        return $this->meta_title ?? $this->title;
    }
}
