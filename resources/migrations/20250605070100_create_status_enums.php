<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateStatusEnums extends AbstractMigration
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
    public function up(): void
    {
        $this->execute("CREATE TYPE status AS ENUM ('active', 'complete', 'deleted', 'pending', 'paused');");
    }

    /**
     * Migrate Down.
     */
    public function down(): void
    {
        $this->execute("DROP TYPE IF EXISTS status;");
    }
}
