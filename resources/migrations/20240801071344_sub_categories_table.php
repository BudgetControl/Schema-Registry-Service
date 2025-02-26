<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class SubCategoriesTable extends AbstractMigration
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
        $this->table('sub_categories')
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('uuid', 'string', ['limit' => 36, 'null' => false])
            ->addColumn('name', 'string')
            ->addColumn('category_id','integer', [ 'signed' => false, 'null' => false])
            ->addColumn('deleted_at', 'datetime', ['null' => true])
            ->addColumn('exclude_from_stats', 'boolean', ['default' => false])
            ->addColumn('slug', 'string')
            ->addIndex(['category_id'])
            ->addIndex('id', ['unique' => true])
            ->create();
    }
}
