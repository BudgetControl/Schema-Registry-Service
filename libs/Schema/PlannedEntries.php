<?php
namespace Budgetcontrol\Registry\Schema;

final class PlannedEntries {

    const table = 'planned_entries';

    const id = 'id';
    const date_time = 'date_time';
    const end_date_time = 'end_date_time';
    const updated_at = 'updated_at';
    const created_at = 'created_at';
    const uuid = 'uuid';
    const amount = 'amount';
    const note = 'note';
    const planning = 'planning';
    const type = 'type';
    const waranty = 'waranty';
    const transfer = 'transfer';
    const confirmed = 'confirmed';
    const planned = 'planned';
    const category_id = 'category_id';
    const model_id = 'model_id';
    const account_id = 'account_id';
    const transfer_id = 'transfer_id';
    const currency_id = 'currency_id';
    const payment_type = 'payment_type';
    const payee_id = 'payee_id';
    const geolocation_id = 'geolocation_id';
    const deleted_at = 'deleted_at';
    const workspace_id = 'workspace_id';

    public static function getSchema()
    {
        return [
            'table' => self::table,
            'schema' => [
                self::id,
                self::date_time,
                self::end_date_time,
                self::updated_at,
                self::created_at,
                self::uuid,
                self::amount,
                self::note,
                self::planning,
                self::type,
                self::waranty,
                self::transfer,
                self::confirmed,
                self::planned,
                self::category_id,
                self::model_id,
                self::account_id,
                self::transfer_id,
                self::currency_id,
                self::payment_type,
                self::payee_id,
                self::geolocation_id,
                self::deleted_at,
                self::workspace_id
            ]
        ];
    }
}