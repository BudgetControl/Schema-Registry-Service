<?php
namespace Budgetcontrol\Registry\Schema;

final class SubCategories {

    const table = 'sub_categories';
    
    const id = 'id';
    const created_at = 'created_at';
    const updated_at = 'updated_at';
    const date_time = 'date_time';
    const uuid = 'uuid';
    const name = 'name';
    const category_id = 'category_id';
    const deleted_at = 'deleted_at';
    const custom = 'custom';
    const exclude_from_stats = 'exclude_from_stats';
    const slug = 'slug';

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
                self::category_id,
                self::deleted_at,
                self::custom,
                self::exclude_from_stats,
                self::slug
            ]
        ];
    }
}