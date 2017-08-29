<?php

namespace app\schema;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class CityType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function() {
                return [
                	'name' => [
                		'type' => Type::string(),
                	],
                ];
            }
        ];

        parent::__construct($config);
    }

}