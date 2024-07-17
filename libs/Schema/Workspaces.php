<?php

namespace Budgetcontrol\Registry\Schema;

final class Workspaces
{

    const table = 'workspaces';

    const id = 'id';
    const uuid = 'uuid';
    const name = 'name';
    const description = 'description';
    const current = 'current';
    const created_at = 'created_at';
    const updated_at = 'updated_at';
    const deleted_at = 'deleted_at';
    const user_id = 'user_id';

    public static function getSchema()
    {
        return [
            'table' => self::table,
            'schema' => [
                self::id,
                self::uuid,
                self::name,
                self::description,
                self::current,
                self::created_at,
                self::updated_at,
                self::deleted_at,
                self::user_id
            ]
        ];
    }
}
