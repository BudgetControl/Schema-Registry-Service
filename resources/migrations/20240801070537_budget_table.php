<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class BudgetTable extends AbstractMigration
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
        $this->table('budgets', ['id' => false, 'primary_key' => 'uuid'])
            ->addColumn('uuid', 'string', ['limit' => 36, 'null' => false])
            ->addColumn('name', 'string')
            ->addColumn('description', 'text')
            ->addColumn('amount', 'float', ['null' => false])
            ->addColumn('configuration', 'json')
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('deleted_at', 'datetime', ['null' => true])
            ->addColumn('notification', 'boolean', ['default' => false])
            ->addColumn('workspace_id','integer', [ 'signed' => false, 'null' => false])
            ->addColumn('emails', 'text', ['null' => true])
            ->create();
    }
}
