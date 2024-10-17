<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ForeignKeys extends AbstractMigration
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
        $this->table('wallets')
            ->addForeignKey('workspace_id', 'workspaces', 'id', ['delete' => 'RESTRICT', 'update' => 'CASCADE'])
            ->update();

        $this->table('budgets')
            ->addForeignKey('workspace_id', 'workspaces', 'id', ['delete' => 'RESTRICT', 'update' => 'CASCADE'])
            ->update();

        $this->table('labels')
            ->addForeignKey('workspace_id', 'workspaces', 'id', ['delete' => 'RESTRICT', 'update' => 'CASCADE'])
            ->update();

        $this->table('payees')
            ->addForeignKey('workspace_id', 'workspaces', 'id', ['delete' => 'RESTRICT', 'update' => 'CASCADE'])
            ->update();

        $this->table('entries')
            ->addForeignKey('workspace_id', 'workspaces', 'id', ['delete' => 'RESTRICT', 'update' => 'CASCADE'])
            ->addForeignKey('account_id', 'wallets', 'id', ['delete' => 'RESTRICT', 'update' => 'CASCADE'])
            ->addForeignKey('payee_id', 'payees', 'id', ['delete' => 'RESTRICT', 'update' => 'CASCADE'])
            ->addForeignKey('category_id', 'sub_categories', 'id', ['delete' => 'RESTRICT', 'update' => 'CASCADE'])
            ->addForeignKey('currency_id', 'currencies', 'id', ['delete' => 'RESTRICT', 'update' => 'CASCADE'])
            ->addForeignKey('payment_type', 'payments_types', 'id', ['delete' => 'RESTRICT', 'update' => 'CASCADE'])
            ->update();

        $this->table('sub_categories')
            ->addForeignKey('category_id', 'categories', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->update();

        $this->table('workspaces')
            ->addForeignKey('user_id', 'users', 'id', ['delete' => 'RESTRICT', 'update' => 'CASCADE'])
            ->update();

        $this->table('workspace_settings')
            ->addForeignKey('workspace_id', 'workspaces', 'id', ['delete' => 'RESTRICT', 'update' => 'CASCADE'])
            ->update();
    }
}
