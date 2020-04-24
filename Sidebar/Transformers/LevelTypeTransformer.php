<?php

namespace Modules\Marketplace\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Arr;

class LevelTypeTransformer extends Resource
{
    public function toArray($request)
    {
        $data = [
            'id' => $this->when($this->id, $this->id),
            'name' => $this->when($this->name, $this->name),
            'entityNamespace' => $this->entity_namespace,
        ];

        $filter = json_decode($request->filter);

        // Return data with available translations
        if (isset($filter->allTranslations) && $filter->allTranslations) {
          // Get langs avaliables
          $languages = \LaravelLocalization::getSupportedLocales();

          foreach ($languages as $lang => $value) {
              $data[$lang]['name'] = $this->hasTranslation($lang) ?
                  $this->translate("$lang")['name'] : '';
          }
        }

        return $data;

    }
}
