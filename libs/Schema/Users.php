<?php
namespace Budgetcontrol\Registry\Schema;

final class Users {

    const table = 'users';

    const id = 'id';
    const uuid = 'uuid';
    const name = 'name';
    const email = 'email';
    const email_verified_at = 'email_verified_at';
    const password = 'password';
    const remember_token = 'remember_token';
    const created_at = 'created_at';
    const updated = 'updated_at';
    const deleted_at = 'deleted_at';
    const sub = 'sub';

    public static function getSchema()
    {
        return [
            'table' => self::table,
            'schema' => [
                self::id,
                self::uuid,
                self::name,
                self::email,
                self::email_verified_at,
                self::password,
                self::remember_token,
                self::created_at,
                self::updated,
                self::deleted_at,
                self::sub
            ]
        ];
    }

}