<?php

namespace Modules\Marketplace\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Arr;

class LevelTransformer extends Resource
{
    public function toArray($request)
    {
        $data = [
            'id' => $this->when($this->id, $this->id),
            'name' => $this->when($this->name, $this->name),
            'description' => $this->when($this->description, $this->description),
            'levelTypeId' => $this->when($this->level_type_id, $this->level_type_id),
            'options' => $this->when($this->options, $this->options),
            'levelType' => new LevelTypeTransformer($this->levelType),

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
                  $this->translate("$lang")['description'] : '';
          }
        }

        return $data;

    }
}
