<?php
namespace Budgetcontrol\Registry\Schema;

final class Models {

    const table = 'models';

    const id = 'id';
    const created_at = 'created_at';
    const updated_at = 'updated_at';
    const uuid = 'uuid';
    const name = 'name';
    const amount = 'amount';
    const note = 'note';
    const type = 'type';
    const category_id = 'category_id';
    const account_id = 'account_id';
    const currency_id = 'currency_id';
    const payment_type = 'payment_type';
    const deleted_at = 'deleted_at';
    const workspace_id = 'workspace_id';

    public static function getSchema()
    {
        return [
            'table' => self::table,
            'schema' => [
                self::id,
                self::created_at,
                self::updated_at,
                self::uuid,
                self::name,
                self::amount,
                self::note,
                self::type,
                self::category_id,
                self::account_id,
                self::currency_id,
                self::payment_type,
                self::deleted_at,
                self::workspace_id
            ]
        ];
    }

}