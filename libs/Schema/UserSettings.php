<?php

namespace Budgetcontrol\Registry\Schema;

final class UserSettings
{

    const table = 'user_settings';

    const id = 'id';
    const created_at = 'created_at';
    const updated_at = 'updated_at';
    const setting = 'setting';
    const data = 'data';
    const workspace_id = 'workspace_id';

    public static function getSchema()
    {
        return [
            'table' => self::table,
            'schema' => [
                self::id,
                self::created_at,
                self::updated_at,
                self::setting,
                self::data,
                self::workspace_id
            ]
        ];
    }
}
