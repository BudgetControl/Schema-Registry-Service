<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateGoalsTable extends AbstractMigration
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
        $table = $this->table('goals');
        $table->addColumn('uuid', 'string', ['limit' => 36])
            ->addColumn('name', 'string')
            ->addColumn('amount', 'decimal', ['precision' => 10, 'scale' => 2])
            ->addColumn('description', 'text', ['null' => true])
            ->addColumn('due_date', 'datetime')
            ->addColumn('status', \Phinx\Util\Literal::from('status'), ['default' => 'active'])
            ->addColumn('category_icon', 'string', ['null' => true])
            ->addColumn('workspace_id','integer', [ 'signed' => false, 'null' => false])
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->addColumn('deleted_at', 'datetime', ['null' => true])
            ->addIndex('uuid', ['unique' => true])
            ->addIndex('workspace_id')
            ->addIndex('id', ['unique' => true])
            ->addIndex(['status'])
            ->create();
        
        $table->addForeignKey('workspace_id', 'workspaces', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION'
        ])->save();

    }
}
