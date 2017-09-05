<?php

namespace app\schema;


use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class ValidationErrorsListType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function() {
                return [
                    'errors' => Type::listOf(Types::validationError()),
                ];
            },
        ];

        parent::__construct($config);
    }
}