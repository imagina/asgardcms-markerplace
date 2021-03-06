<?php

namespace Modules\Marketplace\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Marketplace\Entities\Store;
use Modules\User\Transformers\UserProfileTransformer;
use Illuminate\Support\Arr;

class CategoryTransformer extends Resource
{
  public function toArray($request)
  {
    $data = [
        'id' => (int)$this->when($this->id, $this->id),
        'title' => $this->when($this->title, $this->title),
        'slug' => $this->when($this->slug, $this->slug),
        'description' => $this->description ?? '',
        'icon'=>$this->when($this->icon, $this->icon),
        'metaTitle' => $this->when($this->meta_title, $this->meta_title),
        'metaDescription' => $this->when($this->meta_description, $this->meta_description),
        'metaKeywords' => $this->when($this->meta_keywords, $this->meta_keywords),
        'mainImage' => $this->mainImage,
        'secondaryImage' => $this->when($this->secondaryImage, $this->secondaryImage),
        'createdAt' => $this->when($this->created_at, $this->created_at),
        'updatedAt' => $this->when($this->updated_at, $this->updated_at),
        'options' => $this->when($this->options, $this->options),
        'parent' => new CategoryTransformer($this->whenLoaded('parent')),
        'parentId' => $this->parent_id,
        'children' => CategoryTransformer::collection($this->whenLoaded('children')),
        'stores'=>StoreTransformer::collection($this->whenLoaded('stores')),
    ];

    $filter = json_decode($request->filter);

    // Return data with available translations
    if (isset($filter->allTranslations) && $filter->allTranslations) {
      // Get langs avaliables
      $languages = \LaravelLocalization::getSupportedLocales();

      foreach ($languages as $lang => $value) {
          $data[$lang]['title'] = $this->hasTranslation($lang) ?
              $this->translate("$lang")['title'] : '';
          $data[$lang]['slug'] = $this->hasTranslation($lang) ?
              $this->translate("$lang")['slug'] : '';
          $data[$lang]['description'] = $this->hasTranslation($lang) ?
              $this->translate("$lang")['description'] ?? '' : '';
          $data[$lang]['metaTitle'] = $this->hasTranslation($lang) ?
              $this->translate("$lang")['meta_title'] : '';
          $data[$lang]['metaDescription'] = $this->hasTranslation($lang) ?
              $this->translate("$lang")['meta_description'] : '';
      }
    }

    return $data;

  }
}
