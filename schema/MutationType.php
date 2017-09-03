<?php

namespace app\schema;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use app\models\User;
use app\models\Address;

class MutationType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function() {
                return [
                    'user' => [
                        'type' => Types::userMutation(),
                        'args' => [
                            'id' => Type::nonNull(Type::int()),
                        ],
                        'resolve' => function($root, $args) {
                            return User::find()->where($args)->one();
                        },
                    ],
                    'address' => [
                        'type' => Types::addressMutation(),
                        'args' => [
                            'id' => Type::nonNull(Type::int()),
                        ],
                        'resolve' => function($root, $args) {
                            return Address::find()->where($args)->one();
                        },
                    ],
                ];
            }
        ];

        parent::__construct($config);
    }
}
