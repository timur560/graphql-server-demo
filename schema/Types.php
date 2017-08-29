<?php 

namespace app\schema;

use GraphQL\Type\Definition\ObjectType;


class Types
{
    private static $query;
    private static $mutation;

    private static $user;
    private static $address;
    private static $city;


    public static function query()
    {
        return self::$query ?: (self::$query = new QueryType());
    }

    // public static function mutation()
    // {
    //     return self::$mutation ?: (self::$mutation = new MutationType());
    // }

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

}
