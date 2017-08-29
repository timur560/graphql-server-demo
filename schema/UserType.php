<?php

namespace app\schema;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use app\models\User;

class UserType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function() {
                return [
                    'firstname' => [
                        'type' => Type::string(),
                    ],
                    'lastname' => [
                        'type' => Type::string(),
                    ],
                    'createDate' => [
                        'type' => Type::string(),
                        
                        // текстовое описание, поясняющее
                        // что именно хранит поле
                        // немного позже вы увидите в чем его удобство
                        // (оно еще больше сократит ваше общение с юайщиком)
                        'description' => 'Date when user was created',
                        
                        // чтобы можно было форматировать дату, добавим
                        // дополнительный аргумент format
                        'args' => [
                            'format' => Type::string(),
                        ],

                        // и собственно опишем что с этим аргументом
                        // делать
                        'resolve' => function(User $user, $args) {
                            if (isset($args['format'])) {
                                return date($args['format'], strtotime($user->createDate));
                            }

                            // коли ничего в format не пришло, 
                            // оставляем как есть
                            return $user->createDate;
                        },
                    ],

                    // при необходимости с остальными датами можно
                    // произвести те же действия, но мы
                    // сейчас этого делать, конечно же, не будем
                    'modityDate' => [
                        'type' => Type::string(),
                    ],
                    'lastVisitDate' => [
                        'type' => Type::string(),
                    ],
                    'status' => [
                        'type' => Type::int(),
                    ],

                    // теперь самая интересная часть схемы - 
                    // связи
                    'addresses' => [
                        // так как адресов у нас много,
                        // то нам необходимо применить
                        // модификатор Type::listOf, который
                        // указывает на то, что поле должно вернуть
                        // массив объектов типа, указанного
                        // в скобках
                        'type' => Type::listOf(Types::address()),
                        'resolve' => function(User $user) {
                            // примечательно то, что мы можем сразу же
                            // обращаться к переменной $user без дополнительных проверок
                            // вроде, не пустой ли он, и т.п.
                            // так как если бы он был пустой, до текущего
                            // уровня вложенности мы бы просто не дошли
                            return $user->addresses;
                        },
                    ],
                ];
            }
        ];

        parent::__construct($config);
    }

}