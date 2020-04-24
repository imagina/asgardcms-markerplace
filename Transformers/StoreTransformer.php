<?php

namespace Modules\Marketplace\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\User\Transformers\UserProfileTransformer;
use Modules\Icommerce\Transformers\PaymentMethodTransformer;
use Modules\Icommerce\Transformers\ShippingMethodTransformer;
use Modules\Iplaces\Transformers\CityTransformer;
use Modules\Ilocations\Transformers\ProvinceTransformer;
use Modules\Icommerce\Transformers\ProductTransformer;
use Modules\Icommerce\Transformers\CategoryTransformer as ProductCategoriesTransformer;
use Illuminate\Support\Arr;
use Modules\Ihelpers\Transformers\BaseApiTransformer;

class StoreTransformer extends BaseApiTransformer
{
    public function toArray($request)
    {
        $data = [
            'id' => $this->when($this->id, $this->id),
            'name' => $this->when($this->name, $this->name),
            'address' => $this->when($this->address, $this->address),
            'slug' => $this->when($this->slug, $this->slug),
            'slogan' => $this->when($this->slogan, $this->slogan),
            'description' => $this->description ?? '',
            'metaTitle' => $this->when($this->meta_title, $this->meta_title),
            'metaDescription' => $this->when($this->meta_description, $this->meta_description),
            'metaKeywords' => $this->when($this->meta_keywords, $this->meta_keywords),
            'mainImage' => $this->secondaryImage,
            'secondaryImage' => $this->when($this->secondaryImage, $this->secondaryImage),
            'createdAt' => $this->when($this->created_at, $this->created_at),
            'updatedAt' => $this->when($this->updated_at, $this->updated_at),
            'options' => $this->when($this->options, $this->options),
            'social' => $this->when($this->social, $this->social),
            'translatableOptions' => $this->when($this->translatable_options, $this->translatable_options),
            'neighborhoodId' => $this->when($this->neighborhood_id, (int)$this->neighborhood_id),
            'schedules' => $this->when($this->schedules, $this->schedules),
            'status' => $this->when($this->status, intval($this->status)),
            'statusName' => $this->when($this->status, $this->present()->status),
            'statusClass' => $this->when($this->status, $this->present()->status),
            'owner' => new UserProfileTransformer($this->whenLoaded('user_id')),
            // 'categories' => CategoryTransformer::collection($this->whenLoaded('categories')),
            'province' => new ProvinceTransformer($this->whenLoaded('province')),
            'comments' => CommentTransformer::collection($this->whenLoaded('comments')),
            'theme' => new ThemeTransformer($this->whenLoaded('theme')),
            'settings' => SettingTransformer::collection($this->whenLoaded('settings')),
            'products' => ProductTransformer::collection($this->whenLoaded('products')),
            'categoriesProducts' => ProductCategoriesTransformer::collection($this->whenLoaded('productCategories')),
            'city' => $this->when($this->city, $this->city),
            'cityId' => $this->when($this->city_id, (int)$this->city_id),
            'provinceId' => $this->when($this->province_id, (int)$this->province_id),
            'themeId' => $this->theme_id,
            // 'paymentMethods'=>$this->when($this->paymentMethods, $this->paymentMethods),
            // 'shippingMethods'=>$this->when($this->shippingMethods, $this->shippingMethods),
            'slider' => $this->slider,
            'logo' => $this->mainImage,
            'gallery' => $this->gallery,
            'userId' => $this->user_id,
            'averageRating' => (float)number_format((float)$this->averageRating ?? 0, 1, '.', ','),
            'countRatings' => (integer)count($this->ratings) ?? 0,
            'usersFollowing' => $this->favoriteStores->count(),
            'type' => $this->type,
            'level'=>$this->present()->level,
            'completedOrders' => $this->count_completed_orders,

        ];


        $this->ifRequestInclude('paymentMethods') ?
            $data['paymentMethods'] = ($this->paymentMethods ? PaymentMethodTransformer::collection($this->paymentMethods) : []) : [];

        $this->ifRequestInclude('shippingMethods') ?
            $data['shippingMethods'] = ($this->shippingMethods ? ShippingMethodTransformer::collection($this->shippingMethods) : []) : [];

        $this->ifRequestInclude('categories') ?
            $data['categories'] = ($this->categories ? CategoryTransformer::collection($this->categories) : []) : [];


        if (isset($this->options->map)) {
            $data['options']->map = googleMaps($this->options->map);
        }
        if (isset($this->options->youtube)) {
            $data['options']->youtube = youtubeID($this->options->youtube);
        }

        $filter = json_decode($request->filter);

        // Return data with available translations
        if (isset($filter->allTranslations) && $filter->allTranslations) {
            // Get langs avaliables
            $languages = \LaravelLocalization::getSupportedLocales();

            foreach ($languages as $lang => $value) {
                $data[$lang]['name'] = $this->hasTranslation($lang) ?
                    $this->translate("$lang")['name'] : '';
                $data[$lang]['slug'] = $this->hasTranslation($lang) ?
                    $this->translate("$lang")['slug'] : '';
                $data[$lang]['slogan'] = $this->hasTranslation($lang) ?
                    $this->translate("$lang")['slogan'] : '';
                $data[$lang]['description'] = $this->hasTranslation($lang) ?
                    $this->translate("$lang")['description'] ?? '' : '';
                $data[$lang]['metaTitle'] = $this->hasTranslation($lang) ?
                    $this->translate("$lang")['meta_title'] : '';
                $data[$lang]['metaDescription'] = $this->hasTranslation($lang) ?
                    $this->translate("$lang")['meta_description'] : '';
                $data[$lang]['metaKeywords'] = $this->hasTranslation($lang) ?
                    $this->translate("$lang")['meta_keywords'] : '';
                $data[$lang]['translatable_options'] = $this->hasTranslation($lang) ?
                    $this->translate("$lang")['translatable_options'] : '';
            }


         /*   if (config()->has('asgard.marketplace.config.transformer.fields')) {

                #i: Convert array to dot notation
                $config = config('asgard.marketplace.config.transformer.fields');

                #i: Relation method resolver
                if ($config) {
                    foreach ($config as $item) {
                        if ($item['type'] == 'single') {
                            $data[$item['name'] = new $item['transformer']($this->whenLoaded($item['relationName']));
                        }
                        if ($item['type'] == 'collection') {
                            $data[$item['name'] = $item['transformer']::collection($this->whenLoaded($item['relationName']));
                        }

                    }

                }
            }*/


        }

        return $data;

    }
}
