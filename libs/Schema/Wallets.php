<?php

namespace Budgetcontrol\Registry\Schema;

final class Wallets
{

    const table = 'wallets';

    const id = 'id';
    const uuid = 'uuid';
    const name = 'name';
    const color = 'color';
    const type = 'type';
    const installement = 'installement';
    const installement_value = 'installement_value';
    const currency = 'currency';
    const balance = 'balance';
    const exclude_from_stats = 'exclude_from_stats';
    const invoice_date = 'invoice_date';
    const payment_account = 'payment_account';
    const closing_date = 'closing_date';
    const sorting = 'sorting';
    const workspace_id = 'workspace_id';
    const created_at = 'created_at';
    const updated_at = 'updated_at';
    const deleted_at = 'deleted_at';

    public static function getSchema()
    {
        return [
            'table' => self::table,
            'schema' => [
                self::id,
                self::uuid,
                self::name,
                self::color,
                self::type,
                self::installement,
                self::installement_value,
                self::currency,
                self::balance,
                self::exclude_from_stats,
                self::invoice_date,
                self::payment_account,
                self::closing_date,
                self::sorting,
                self::workspace_id,
                self::created_at,
                self::updated_at,
                self::deleted_at
            ]
        ];
    }
}
