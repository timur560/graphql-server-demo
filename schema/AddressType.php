<?php

namespace app\schema;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class AddressType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function() {
                return [
                	'user' => [
                		'type' => Types::user(),
                	],
                    'city' => [
                        'type' => Types::city(),
                    ],

                    // остальные поля не столь интересны
                    // посему оставляю их вам на 
                    // личное растерзание
                ];
            }
        ];

        parent::__construct($config);
    }

}