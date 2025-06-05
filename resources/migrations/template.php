<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Template extends AbstractMigration
{
    public function up(): void
    {
        $table = $this->table('table_name', ['id' => false, 'primary_key' => 'id']);
        $table->addColumn('id', 'uuid')
            ->addColumn('workspace_id', 'uuid')
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
            ->addColumn('deleted_at', 'timestamp', ['null' => true])
            ->addIndex(['workspace_id'])
            ->create();
    }

    public function down(): void
    {
        $this->table('table_name')->drop()->save();
    }
}