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
                    'zip' => [
                        'type' => Type::string(),
                    ],
                    'street' => [
                        'type' => Type::string(),
                    ],
                ];
            }
        ];

        parent::__construct($config);
    }

}