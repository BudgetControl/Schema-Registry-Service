<?php
declare(strict_types=1);
use Phinx\Migration\AbstractMigration;

final class CreateSyncTables extends AbstractMigration
{
    public function change(): void
    {
        $this->table('sync_authorizations', ['id' => false, 'primary_key' => ['state_hash']])
            ->addColumn('state_hash', 'string', ['limit' => 64, 'null' => false])
            ->addColumn('user_uuid', 'string', ['limit' => 36])
            ->addColumn('workspace_id', 'integer', ['null' => false])
            ->addColumn('expires_at', 'datetime')
            ->create();
        $this->table('sync_connections')
            ->addColumn('user_uuid', 'string', ['limit' => 36])
            ->addColumn('workspace_id', 'integer', ['null' => false])
            ->addColumn('session_ciphertext', 'text')
            ->addColumn('accounts_json', 'text')
            ->addColumn('valid_until', 'datetime', ['null' => true])
            ->addColumn('created_at', 'datetime')
            ->create();
        // Written by Entries in the same transaction as the new expense.
        $this->table('sync_imported_expenses', ['id' => false, 'primary_key' => ['workspace_id', 'source_hash']])
            ->addColumn('workspace_id', 'integer', ['null' => false])
            ->addColumn('source_hash', 'string', ['limit' => 64, 'null' => false])
            ->addColumn('entry_uuid', 'string', ['limit' => 36])
            ->addColumn('created_at', 'datetime')
            ->create();
    }
}
