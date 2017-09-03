<?php 

namespace app\schema;

use GraphQL\Type\Definition\ObjectType;

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
}
