<?php
namespace Budgetcontrol\Registry\Schema;

final class Categories {

    const table = 'categories';
    
    const id = 'id';
    const uuid = 'uuid';
    const name = 'name';
    const icon = 'icon';
    const type = 'type';
    const slug = 'slug';
    const created_at = 'created_at';
    const updated = 'updated_at';
    const deleted_at = 'deleted_at';
    const date_time = 'date_time';

    public static function getSchema()
    {
        return [
            'table' => self::table,
            'schema' => [
                self::id,
                self::uuid,
                self::name,
                self::icon,
                self::type,
                self::slug,
                self::created_at,
                self::updated,
                self::deleted_at,
                self::date_time
            ]
        ];
    }

}