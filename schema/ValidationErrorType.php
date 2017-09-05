<?php

namespace app\schema;


use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class ValidationErrorType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function() {
                return [
                    'field' => Type::string(),
                    'messages' => Type::listOf(Type::string()),
                ];
            },
        ];

        parent::__construct($config);
    }
}