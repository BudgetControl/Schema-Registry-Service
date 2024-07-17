<?php

namespace Budgetcontrol\Registry\Schema;

final class WorkspaceSettings
{

    const table = 'workspace_settings';

    const id = 'id';
    const workspace_id = 'workspace_id';
    const setting = 'setting';
    const data = 'data';
    const created_at = 'created_at';
    const updated_at = 'updated_at';
    const deleted_at = 'deleted_at';

    public static function getSchema()
    {
        return [
            'table' => self::table,
            'schema' => [
                self::id,
                self::workspace_id,
                self::setting,
                self::data,
                self::created_at,
                self::updated_at,
                self::deleted_at
            ]
        ];
    }
}
