<?php

namespace Modules\Marketplace\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Arr;

class ThemeTransformer extends Resource
{
    public function toArray($request)
    {
        $data = [
            'id' => $this->when($this->id, $this->id),
            'name' => $this->when($this->name, $this->name),
            'description' => $this->when($this->value, $this->value),
            'type'=> $this->type,
            // 'type'=>$this->when($this->type, $this->present()->type),
            'mainImage' => $this->when($this->mainImage, $this->mainImage),
            // 'mainImage' => [
            //   "path"=>'/statics/img/product.jpg',
            //   "mimeType"=>'jpg'
            // ],
        ];
        $filter = json_decode($request->filter);

        // Return data with available translations
        if (isset($filter->allTranslations) && $filter->allTranslations) {
            // Get langs avaliables
            $languages = \LaravelLocalization::getSupportedLocales();

            foreach ($languages as $lang => $value) {
                $data[$lang]['name'] = $this->hasTranslation($lang) ?
                    $this->translate("$lang")['name'] : '';
                $data[$lang]['description'] = $this->hasTranslation($lang) ?
                    $this->translate("$lang")['description'] ?? '' : '';
            }
        }

        return $data;

    }
}
