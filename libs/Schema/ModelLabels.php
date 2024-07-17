<?php
namespace Budgetcontrol\Registry\Schema;

final class EntryLabels {

    const table = 'model_labels';

    const id = 'id';
    const models_id = 'models_id';
    const labels_id = 'labels_id';
    const created_at = 'created_at';
    const updated_at = 'updated_at';
    const date_time = 'date_time';

    public static function getSchema()
    {
        return [
            'table' => self::table,
            'schema' => [
                self::id,
                self::models_id,
                self::labels_id,
                self::created_at,
                self::updated_at,
                self::date_time
            ]
        ];
    }

}