<?php

namespace Budgetcontrol\Registry\Schema;

final class Entries
{

    const table = 'entries';

    const id = 'id';
    const date_time = 'date_time';
    const updated_at = 'updated_at';
    const created_at = 'created_at';
    const uuid = 'uuid';
    const amount = 'amount';
    const note = 'note';
    const type = 'type';
    const waranty = 'waranty';
    const transfer = 'transfer';
    const confirmed = 'confirmed';
    const planned = 'planned';
    const installment = 'installment';
    const category_id = 'category_id';
    const model_id = 'model_id';
    const account_id = 'account_id';
    const transfer_id = 'transfer_id';
    const transfer_relation = 'transfer_relation';
    const currency_id = 'currency_id';
    const payment_type = 'payment_type';
    const payee_id = 'payee_id';
    const deleted_at = 'deleted_at';
    const geolocation = 'geolocation';
    const workspace_id = 'workspace_id';
    const exclude_from_stats = 'exclude_from_stats';

    public static function getSchema()
    {
        return [
            'table' => self::table,
            'schema' => [
                self::id,
                self::date_time,
                self::updated_at,
                self::created_at,
                self::uuid,
                self::amount,
                self::note,
                self::type,
                self::waranty,
                self::transfer,
                self::confirmed,
                self::planned,
                self::installment,
                self::category_id,
                self::model_id,
                self::account_id,
                self::transfer_id,
                self::transfer_relation,
                self::currency_id,
                self::payment_type,
                self::payee_id,
                self::deleted_at,
                self::geolocation,
                self::workspace_id,
                self::exclude_from_stats
            ]
        ];
    }
}
