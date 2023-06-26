<?php


namespace App\Models\External\AD;


use Adldap\Laravel\Facades\Adldap;
use Exception;

class AD
{

    static private $provider;

    private function __construct() {}

    public static function init()
    {
        $providerConfig = config('ldap_auth.connection');

        self::$provider =  Adldap::getProvider($providerConfig);
    }

    public static function membroDe($userName, $grupo)
    {
        try {
            $user = self::$provider->search()->whereEquals('cn', $userName)->firstOrFail();

            if (in_array($grupo, $user->getGroupNames()))

                return true;
            else
                return false;
        } catch (Exception $e)
        {
            return false;
        }
    }
}
