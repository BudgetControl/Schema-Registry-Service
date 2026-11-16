<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateSyncAccountSettings extends AbstractMigration
{
    public function change(): void
    {
        $this->table('sync_account_settings')
            ->addColumn('connection_id', 'integer')
            ->addColumn('account_uid', 'string', ['limit' => 128])
            ->addColumn('user_uuid', 'string', ['limit' => 36])
            ->addColumn('workspace_id', 'integer')
            ->addColumn('account_id', 'integer')
            ->addColumn('category_id', 'integer')
            ->addColumn('income_category_id', 'integer')
            ->addColumn('currency_id', 'integer')
            ->addColumn('payment_type', 'integer')
            ->addColumn('date_from', 'date')
            ->addColumn('updated_at', 'datetime')
            ->addIndex(['connection_id', 'account_uid'], ['unique' => true])
            ->addIndex(['workspace_id', 'account_id'], ['unique' => true])
            ->create();
    }
}
