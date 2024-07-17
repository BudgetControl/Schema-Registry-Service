<?php
namespace Budgetcontrol\Registry\Schema;

final class Labels {

    const table = 'labels';

    const id = 'id';
    const created_at = 'created_at';
    const updated_at = 'updated_at';
    const date_time = 'date_time';
    const uuid = 'uuid';
    const name = 'name';
    const color = 'color';
    const deleted_at = 'deleted_at';
    const archive = 'archive';
    const workspace_id = 'workspace_id';

    public static function getSchema()
    {
        return [
            'table' => self::table,
            'schema' => [
                self::id,
                self::created_at,
                self::updated_at,
                self::date_time,
                self::uuid,
                self::name,
                self::color,
                self::deleted_at,
                self::archive,
                self::workspace_id
            ]
        ];
    }

}