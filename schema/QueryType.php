<?php

namespace app\schema;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use app\models\User;
use app\models\Address;

class QueryType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function() {
                return [
                    'user' => [
                        'type' => Types::user(),

                        // добавим сюда аргументов, дабы
                        // выбрать необходимого нам юзера
                        'args' => [
                            // чтобы агрумент сделать обязательным
                            // применим модификатор Type::nonNull()
                            'id' => Type::nonNull(Type::int()),
                        ],
                        'resolve' => function($root, $args) {
                            // таким образом тут мы уверены в том
                            // что в $args обязательно присутствет элемент с индексом
                            // `id`, и он обязательно целочисленный, иначе мы бы сюда не попали

                            // так же мы не боимся, что юзера с этим `id`
                            // в базе у нас не существует
                            // библиотека корректно это обработает
                            return User::find()->where(['id' => $args['id']])->one();
                        },
                    ],

                    // в принципе на поле user можно остановиться, в случае
                    // если нам нужно обращаться к данным лиш конкретного пользователя
                    // но если нам нужны данные с другими привязками добавим
                    // для примера еще полей

                    'addresses' => [
                        // без дополтинельных параметров
                        // просто вернет нам списох всех
                        // адресов
                        'type' => Type::listOf(Types::address()), 

                        // добавим фильтров для интереса
                        'args' => [
                            'zip' => Type::string(),
                            'street' => Type::string(),
                        ],
                        'resolve' => function($root, $args) {
                            $query = Address::find();

                            if (!empty($args)) {
                                $query->where($args);
                            }

                            return $query->all();
                        },
                    ],
                ];
            }
        ];

        parent::__construct($config);
    }
}
