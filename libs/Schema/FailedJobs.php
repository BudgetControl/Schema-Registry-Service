<?php
namespace Budgetcontrol\Registry\Schema;

final class Budgets {

    const table = 'failed_jobs';

    const uuid = 'uuid';
    const command = 'command';
    const exception = 'exception';
    const failed_at = 'failed_at';

    public static function getSchema()
    {
        return [
            'table' => self::table,
            'schema' => [
                self::uuid,
                self::command,
                self::exception,
                self::failed_at
            ]
        ];
    }

}