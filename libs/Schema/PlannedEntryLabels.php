<?php
namespace Budgetcontrol\Registry\Schema;

final class PlannedEntryLabels {

    const table = 'planned_entry_labels';
    
    const id = 'id';
    const planned_entry_id = 'planned_entry_id';
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
                self::planned_entry_id,
                self::labels_id,
                self::created_at,
                self::updated_at,
                self::date_time
            ]
        ];
    }
}