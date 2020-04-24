<?php

return [
    'name' => 'Marketplace',

    'relations' => [
      /*
        'store' => [
            'products' => function ($self) {
                return $self->morphedByMany('Modules\Icommerce\Entities\Product', 'storable', 'imarketplace__storables', 'store_id');
            }
        ],
        'category' => [
            'stores' => function ($self) {
                return $self->morphToMany('Modules\Icommerce\Entities\Store', 'storable', 'imarketplace__storables', 'storable_id');
            }
        ],
        'theme'=>[

        ],
        'comment'=>[

        ]
*/
    ],

];
