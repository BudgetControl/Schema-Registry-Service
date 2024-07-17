<?php
namespace Budgetcontrol\Registry\Schema;

final class PaymentsTypes {

    const table = 'payments_types';

    const id = 'id';
    const created_at = 'created_at';
    const updated_at = 'updated_at';
    const date_time = 'date_time';
    const uuid = 'uuid';
    const name = 'name';
    const deleted_at = 'deleted_at';
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
                self::deleted_at,
                self::slug
            ]
        ];
    }

}