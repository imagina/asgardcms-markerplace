<?php

namespace Modules\Marketplace\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\User\Transformers\UserProfileTransformer;
use Modules\Iplaces\Transformers\CityTransformer;
use Modules\Ilocations\Transformers\ProvinceTransformer;
use Illuminate\Support\Arr;

class StoreTransformer extends Resource
{
  public function toArray($request)
  {
    $data = [
        'id' => $this->when($this->id, $this->id),
        'name' => $this->when($this->name, $this->name),
        'slug' => $this->when($this->slug, $this->slug),
        'slogan' => $this->when($this->slogan, $this->slogan),
        'description' => $this->description ?? '',
        'metaTitle' => $this->when($this->meta_title, $this->meta_title),
        'metaDescription' => $this->when($this->meta_description, $this->meta_description),
        'metaKeywords' => $this->when($this->meta_keywords, $this->meta_keywords),
        'mainImage' => $this->mainImage,
        'secondaryImage' => $this->when($this->secondaryImage, $this->secondaryImage),
        'createdAt' => $this->when($this->created_at, $this->created_at),
        'updatedAt' => $this->when($this->updated_at, $this->updated_at),
        'options' => $this->when($this->options, $this->options),
        'translatableOptions' => $this->when($this->translatable_options, $this->translatable_options),
        'neighborhood'=>$this->when($this->neighborhood, $this->neighborhood),
        'schedules'=>$this->when($this->schedules, $this->schedules),
        'status' => $this->when($this->status, intval($this->status)),
        'statusName' => $this->when($this->status, $this->present()->status),
        'statusClass'=>$this->when($this->status, $this->present()->status),
        'owner'=>new UserProfileTransformer($this->whenLoaded('user_id')),
        'categories' => CategoryTransformer::collection($this->whenLoaded('categories')),
        'province'=>new ProvinceTransformer($this->whenLoaded('province')),
        'comments' => CommentTransformer::collection($this->whenLoaded('comments')),
        'theme'=>new ThemeTransformer($this->whenLoaded('theme')),
        'settings' => SettingTransformer::collection($this->whenLoaded('settings')),
        'city'=>$this->when($this->city, $this->city),
        'city_id'=>$this->when($this->city_id, $this->city_id),

    ];




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
    }

    return $data;

  }
}
