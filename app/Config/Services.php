<?php

namespace Config;

use CodeIgniter\Config\BaseService;
use App\Libraries\CISmarty;

class Services extends BaseService
{
    public static function smarty($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('smarty');
        }

        return new CISmarty();
    }

    /**
     * Override Shield LoginResponse
     */
    public static function loginResponse($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('loginResponse');
        }

        return new \App\Authentication\LoginResponse();
    }
}
