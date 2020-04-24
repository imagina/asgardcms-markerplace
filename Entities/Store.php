<?php

namespace Modules\Marketplace\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Iquiz\Entities\Poll;
use Modules\Marketplace\Presenters\StorePresenter;
use Modules\Media\Entities\File;
use Modules\Media\Support\Traits\MediaRelation;
use Modules\Core\Traits\NamespacedEntity;
use willvincent\Rateable\Rateable;
use Modules\Icommerce\Entities\PaymentMethod;
use Modules\Icommerce\Entities\ShippingMethod;
class Store extends Model
{
    use Translatable, PresentableTrait, NamespacedEntity, MediaRelation,Rateable;

    protected $table = 'marketplace__stores';
    protected static $entityNamespace = 'asgardcms/store';
    public $translatedAttributes = ['name', 'slug', 'slogan', 'description',
     'meta_title', 'meta_description', 'meta_keywords', 'translatable_options'];
    protected $fillable = [
      'neighborhood_id','address', 'city', 'city_id', 'province_id', 'schedules',
      'status','social', 'options', 'user_id', 'theme_id','sum_rating','type'
     ];

    protected $casts = [
        'options' => 'array',
        'schedules' => 'array',
        'social' => 'array'
    ];
    protected $presenter = StorePresenter::class;
    public function user()
    {
        $driver = config('asgard.user.config.driver');

        return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User");
    }

    public function getCountCompletedOrdersAttribute(){
     $count= $this->hasMany('Modules\Icommerce\Entities\Order')->where('status_id',4)->count();

     return $count??0;

    }

    public function getCountFavoriteStoresAttribute(){
        return $this->hasMany(FavoriteStore::class)->count();

    }
    public function orders(){
      return $this->hasMany('Modules\Icommerce\Entities\Order');
    }

    public function polls(){
      return $this->hasMany('Modules\Iquiz\Entities\Poll');
    }
    public function bannersAds(){
        return $this->hasMany('Modules\Ibanners\Entities\Position');
    }
    public function categories()
    {
        return $this->belongsToMany(CategoryStore::class, 'marketplace__store_category',"store_id","category_store_id")->withTimestamps();
    }

    public function paymentMethods()
    {
        return $this->belongsToMany(PaymentMethod::class, 'marketplace__store_payment_methods',"store_id","payment_method_id")->withTimestamps();
    }

    public function shippingMethods()
    {
        return $this->belongsToMany(ShippingMethod::class, 'marketplace__store_shipping_methods',"store_id","shipping_method_id")->withTimestamps();
    }

    public function city()
    {
        return $this->belongsTo('Modules\Ilocations\Entities\City');
    }

    public function province()
    {
        return $this->belongsTo('Modules\Ilocations\Entities\Province');
    }

    public function theme()
    {
        return $this->belongsTo(Themes::class);
    }
    public function storeHistories()
    {
        return $this->hasMany(StoreHistory::class);
    }

    public function favoriteStores()
    {
        return $this->hasMany(FavoriteStore::class);
    }
    public function settings()
    {
        return $this->hasMany(Setting::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function productCategories()
    {
        return $this->hasMany('Modules\Icommerce\Entities\Category');
    }

    public function products()
    {
        return $this->hasMany('Modules\Icommerce\Entities\Product');
    }

    public function coupons()
    {
        return $this->hasMany('Modules\Icommerce\Entities\Coupon');
    }

    public function currency()
    {
        return $this->hasMany('Modules\Icommerce\Entities\Currency');
    }

    public function manufacturers()
    {
        return $this->hasMany('Modules\Icommerce\Entities\Manufacturer');
    }

    public function taxRate()
    {
        return $this->hasMany('Modules\Icommerce\Entities\TaxRate');
    }

    public function paymentMethod()
    {
        return $this->hasMany('Modules\Icommerce\Entities\PaymentMethod');
    }

    public function shippingMethod()
    {
        return $this->hasMany('Modules\Icommerce\Entities\ShippingMethod');
    }

    public function getOptionsAttribute($value)
    {
        try {
            return json_decode(json_decode($value));
        } catch (\Exception $e) {
            return json_decode($value);
        }
    }

    public function getSecondaryImageAttribute()
    {
        $images = \Storage::disk('publicmedia')->files('assets/marketplace/store/'.$this->id.'/slider');
        if (count($images)) {
            $response = array();
            foreach ($images as $image) {
                $response = ["mimetype" => "image/jpeg", "path" => $image];
            }
        } else {
            $gallery = $this->files()->where('zone', 'slider')->get();
            $response = [];
            foreach ($gallery as $img) {
                array_push($response, [
                    'mimeType' => $img->mimetype,
                    'path' => $img->path_string
                ]);
            }

        }
        if(is_array($response)){
            $response= reset($response);
        }

        return json_decode(json_encode($response));
    }

    public function getMainImageAttribute()
    {
        $thumbnail = $this->files()->where('zone', 'mainimage')->first();
        if (!$thumbnail) {
            if (isset($this->options->mainimage)) {
                $image = [
                    'mimeType' => 'image/jpeg',
                    'path' => url($this->options->mainimage)
                ];
            } else {
                $image = [
                    'mimeType' => 'image/jpeg',
                    'path' => url('modules/iblog/img/post/default.jpg')
                ];
            }
        } else {
            $image = [
                'mimeType' => $thumbnail->mimetype,
                'path' => $thumbnail->path_string
            ];
        }
        return json_decode(json_encode($image));

    }

    public function getGalleryAttribute()
    {
        $images = \Storage::disk('publicmedia')->files('assets/marketplace/store/'.$this->id.'/gallery');
        if (count($images)) {
            $response = array();
            foreach ($images as $image) {
                $response = ["mimetype" => "image/jpeg", "path" => $image];
            }
        } else {
            $gallery = $this->filesByZone('gallery')->get();
            $response = [];
            foreach ($gallery as $img) {
                array_push($response, [
                    'mimeType' => $img->mimetype,
                    'path' => $img->path_string
                ]);
            }

        }

        return json_decode(json_encode($response));
    }
    public function getSliderAttribute()
    {
        $images = \Storage::disk('publicmedia')->files('assets/marketplace/store/'.$this->id.'/slider');
        if (count($images)) {
            $response = array();
            foreach ($images as $image) {
                $response = ["mimetype" => "image/jpeg", "path" => $image];
            }
        } else {
          $gallery = $this->files()->where('zone', 'slider')->get();
            $response = [];
            foreach ($gallery as $img) {
                array_push($response, [
                    'mimeType' => $img->mimetype,
                    'path' => $img->path_string
                ]);
            }

        }

        return json_decode(json_encode($response));
    }

    // public function getCityAttribute(){
    //     if(isset($this->city_id) && !empty($this->city_id)){
    //         return $this->locationCity();
    //         // return $this->locationCity()->name;
    //     }else{
    //         return $this->city??false;
    //     }
    // }

    /**
     * URL post
     * @return string
     */
    public function getUrlAttribute()
    {

      return \URL::route(\LaravelLocalization::getCurrentLocale() . '.marketplace.store', [$this->slug]);

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
        $config = implode('.', ['asgard.marketplace.config.relations.store', $method]);

        #i: Relation method resolver
        if (config()->has($config)) {
            $function = config()->get($config);

            return $function($this);
        }

        #i: No relation found, return the call to parent (Eloquent) to handle it.
        return parent::__call($method, $parameters);
    }

}
