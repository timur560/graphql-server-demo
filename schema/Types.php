<?php 

namespace app\schema;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\UnionType;
use yii\base\Model;

// т.к. наши мутации в другом неймспейсе
// необходимо их подключить
use app\schema\mutations\UserMutationType;
use app\schema\mutations\AddressMutationType;

class Types
{
    private static $query;
    private static $mutation;

    private static $user;
    private static $address;
    private static $city;

    private static $userMutation;
    private static $addressMutation;

    private static $validationError;
    private static $validationErrorsList;


    // здесь будут наши нагенеренные валидирующе типы
    private static $valitationTypes;

    // root types

    public static function query()
    {
        return self::$query ?: (self::$query = new QueryType());
    }

    public static function mutation()
    {
        return self::$mutation ?: (self::$mutation = new MutationType());
    }

    // query types

    public static function user()
    {
        return self::$user ?: (self::$user = new UserType());
    }

    public static function address()
    {
        return self::$address ?: (self::$address = new AddressType());
    }

    public static function city()
    {
        return self::$city ?: (self::$city = new CityType());
    }

    // mutation types

    public static function userMutation()
    {
        return self::$userMutation ?: (self::$userMutation = new UserMutationType());
    }

    public static function addressMutation()
    {
        return self::$addressMutation ?: (self::$addressMutation = new AddressMutationType());
    }

    // validation

    // c этими двумя всё ясно

    public static function validationError()
    {
        return self::$validationError ?: (self::$validationError = new ValidationErrorType());
    }

    public static function validationErrorsList()
    {
        return self::$validationErrorsList ?: (self::$validationErrorsList = new ValidationErrorsListType());
    }

    // метод возвращает новый сгенерированный тип, на основе
    // типа, который пришел в аргументе
    public static function validationErrorsUnionType(ObjectType $type)
    {
        // перво-наперво мы должны убедиться в том, что генерируем
        // этот тип первый раз, иначе словим ошибку
        // (я уже упоминал ранее о том, что одноименных/одинаковых
        // типов в схеме GraphQL быть не может)
        if (!isset(self::$valitationTypes[$type->name . 'ValidationErrorsType'])) {
            // self::$valitationTypes будет хранить наши типы, чтобы не повторяться
            self::$valitationTypes[$type->name . 'ValidationErrorsType'] = new UnionType([
                // генерируем имя типа
                'name' => $type->name . 'ValidationErrorsType',
                // перечисляем какие типы мы объединяем
                // (фактически мы их не объединяем, а говорим один из каких
                // существующих типом вы будем возвращать)
                'types' => [
                    $type,
                    Types::validationErrorsList(),
                ],
                // в аргументе в resolveType
                // в случае успеха нам придет наш
                // сохраненный/измененный объект,
                // в случае ошибок валидации
                // придет ассоциативный массив из $model->getError()
                // о котором я также упоминал
                'resolveType' => function ($value) use ($type) {
                    if ($value instanceof Model) {
                        // пришел объект
                        return $type;
                    } else {
                        // пришел массив (ну или вообще неизвестно что,
                        // это нас уже мало волнует,
                        // хотя должен массив)
                        return Types::validationErrorsList();
                    }
                }
            ]);
        }

        return self::$valitationTypes[$type->name . 'ValidationErrorsType'];
    }

}
