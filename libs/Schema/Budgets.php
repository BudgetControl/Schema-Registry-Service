<?php
namespace Budgetcontrol\Registry\Schema;

final class Budgets {

    const table = 'budgets';

    const id = 'id';
    const uuid = 'uuid';
    const name = 'name';
    const description = 'description';
    const amount = 'amount';
    const configuration = 'configuration';
    const created_at = 'created_at';
    const updated = 'updated_at';
    const deleted_at = 'deleted_at';
    const notification = 'notification';
    const workspace_id = 'workspace_id';
    const emails = 'emails';

    public static function getSchema()
    {
        return [
            'table' => self::table,
            'schema' => [
                self::id,
                self::uuid,
                self::name,
                self::description,
                self::amount,
                self::configuration,
                self::created_at,
                self::updated,
                self::deleted_at,
                self::notification,
                self::workspace_id,
                self::emails
            ]
        ];
    }

}