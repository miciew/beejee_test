<?php
/**
 * Created by PhpStorm.
 * User: PC-Mic
 * Date: 11.05.2019
 * Time: 18:09
 */

namespace Miciew;
use \pmill\Auth\Interfaces\AuthUser;

class User extends Model implements AuthUser
{
    protected static $_table = 'users';

    public function safe()
    {
        return [
            'email', 'username', 'password'
        ];
    }

    /**
     * @return int
     */
    public function getAuthId()
    {
        return $this->id;
    }
    /**
     * @return string
     */
    public function getAuthUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * @return string|null
     */
    public function getTwoFactorSecret()
    {
    }
}