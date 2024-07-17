<?php

namespace Budgetcontrol\Registry\Schema;

final class WorkspacesUsersMM
{

    const table = 'workspaces_users_mm';

    const id = 'id';
    const workspace_id = 'workspace_id';
    const user_id = 'user_id';
    const created_at = 'created_at';
    const updated_at = 'updated_at';

    public static function getSchema()
    {
        return [
            'table' => self::table,
            'schema' => [
                self::id,
                self::workspace_id,
                self::user_id,
                self::created_at,
                self::updated_at
            ]
        ];
    }
}
