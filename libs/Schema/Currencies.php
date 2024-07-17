<?php
namespace Budgetcontrol\Registry\Schema;

final class Budgets {

    const table = 'currencies';

    const id = 'id';
    const uuid = 'uuid';
    const name = 'name';
    const label = 'label';
    const icon = 'icon';
    const exchange_rate = 'exchange_rate';
    const created_at = 'created_at';
    const updated_at = 'updated_at';
    const date_time = 'date_time';
    const slug = 'slug';

    public static function getSchema()
    {
        return [
            'table' => self::table,
            'schema' => [
                self::id,
                self::uuid,
                self::name,
                self::label,
                self::icon,
                self::exchange_rate,
                self::created_at,
                self::updated_at,
                self::date_time,
                self::slug
            ]
        ];
    }
}