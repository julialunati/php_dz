<?php

namespace Project\Account\Model;

class Auth
{
    public static function isAuth() : bool
    {
        return !empty($_SESSION['user_id']);
    }

    public static function getUserId() : ?string
    {
        return $_SESSION['user_id'] ?? null;
    }
}