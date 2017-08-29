<?php

namespace app\schema;

use GraphQL\Type\Definition\ObjectType;

class MutationType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function() {
                return [
                    // здесь будут поля типами для мутаций
                ];
            }
        ];

        parent::__construct($config);
    }
}
