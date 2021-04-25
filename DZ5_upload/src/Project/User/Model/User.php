<?php

namespace Project\User\Model;

use Project\Core\Model\AbstractModel;

class User extends AbstractModel
{
    public $tableName = 'user';

    //получаем хэш пароля по логину из БД
    public function getHash(array $arr): string
    {
        return $this->getByAttribute($arr)->getData('password');
    }

    //получаем все логины зарегистрированные в БД
    public function getAllLogins(string $columnName): self
    {
        return $this->getByColumn($columnName);
    }
}
