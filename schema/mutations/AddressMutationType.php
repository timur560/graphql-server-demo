<?php

namespace app\schema\mutations;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use app\models\Address;
use app\schema\Types;

class AddressMutationType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function() {
                return [
                    'update' => [
                        'type' => Type::boolean(),
                        'description' => 'Update address.',
                        'args' => [
                            'street' => Type::string(),
                            'zip' => Type::string(),
                            'status' => Type::int(),
                        ],
                        'resolve' => function(Address $address, $args) {
                            $address->setAttributes($args);
                            return $address->save();
                        }
                    ],

                    // так как у нас адрес имеет поле 
                    // user, то можем позволить редактировать
                    // его прямо отсюда
                    // как именно, посмотрим на этапе тестирования
                    'user' => [
                        'type' => Types::userMutation(),
                        'description' => 'Edit user directly from his address',
                        // а вот поле relove должно возвращать
                        // что, как думаете?
                        'resolve' => function(Address $address) {
                            // именно!
                            // юзера из связки нашего адреса
                            // (кстати, если связка окажется пуста -
                            // не страшно, GraphQL, все это корректно
                            // кушает, а вот если она окажется типа
                            // отличного от User, тогда он скажет, что мол
                            // что-то пошло не так)
                            return $address->user;
                        }
                    ],
                ];
            }
        ];

        parent::__construct($config);
    }

}