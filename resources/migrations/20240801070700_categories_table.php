<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CategoriesTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $this->table('categories')
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('date_time', 'datetime')
            ->addColumn('uuid', 'uuid')
            ->addColumn('name', 'string')
            ->addColumn('icon', 'string')
            ->addColumn('deleted_at', 'datetime', ['null' => true])
            ->addColumn('type', 'string')
            ->addColumn('slug', 'string')
            ->addIndex('id', ['unique' => true])
            ->create();
    }
}
