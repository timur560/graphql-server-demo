<?php

namespace app\schema\mutations;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use app\models\User;
use app\schema\Types;

class UserMutationType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function() {
                return [
                    // для теста реализуем здесь
                    // один метод для изменения данных
                    // объекта User
                    'update' => [
                        // какой должен быть возвращаемый тип
                        // здесь 2 варианта - либо
                        // булев - удача / неудача
                        // либо же сам объект типа User.
                        // позже мы поговорим о валидации
                        // тогда всё станет яснее, а пока
                        // оставим булев для простоты
                        
                        // 'type' => Type::boolean(),

                        // с валидацией
                        'type' => Types::validationErrorsUnionType(Types::user()),
                        
                        'description' => 'Update user data.',
                        'args' => [
                            // сюда засунем все то, что
                            // разрешаем изменять у User.
                            // в примере оставим все поля необязательными
                            // но просто если нужно, то можно
                            'firstname' => Type::string(),
                            'lastname' => Type::string(),
                            'status' => Type::int(),
                            'email' => Type::string(),
                        ],
                        'resolve' => function(User $user, $args) {
                            // ну а здесь всё проще простого,
                            // т.к. библиотека уже все проверила за нас:
                            // есть ли у нас юзер, правильные ли у нас
                            // аргументы и всё ли пришло, что необходимо
                            $user->setAttributes($args);
                            
                            if ($user->save()) {
                                return $user;
                            } else {
                                // на практике, этот весь код что ниже -
                                // переиспользуемый, и должен быть вынесен
                                // в отдельную библиотеку
                                foreach ($user->getErrors() as $field => $messages) {
                                    $errors[] = [
                                        'field' => $field,
                                        'messages' => $messages,
                                    ];
                                }

                                // возвращаемый формат ассоциативного
                                // массива должен соответствовать
                                // полям типа (в нашем случае ValidationErrorsListType)
                                return ['errors' => $errors]; 
                            }
                        }
                    ],
                ];
            }
        ];

        parent::__construct($config);
    }

}