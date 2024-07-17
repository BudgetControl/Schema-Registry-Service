<?php

namespace Budgetcontrol\Registry\Schema;

final class Payees
{

    const table = 'payees';

    const id = 'id';
    const uuid = 'uuid';
    const name = 'name';
    const created_at = 'created_at';
    const updated_at = 'updated_at';
    const date_time = 'date_time';
    const deleted_at = 'deleted_at';
    const workspace_id = 'workspace_id';

    public static function getSchema()
    {
        return [
            'table' => self::table,
            'schema' => [
                self::id,
                self::uuid,
                self::name,
                self::created_at,
                self::updated_at,
                self::date_time,
                self::deleted_at,
                self::workspace_id
            ]
        ];
    }
}
