<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RestoreEntryBalanceTriggers extends AbstractMigration
{
    public function up(): void
    {
        foreach (['wallet', 'goals', 'payee'] as $name) {
            $this->execute("DROP TRIGGER IF EXISTS trigger_update_{$name}_balance ON entries");
            $this->execute("CREATE TRIGGER trigger_update_{$name}_balance
                AFTER INSERT OR UPDATE OR DELETE ON entries
                FOR EACH ROW EXECUTE FUNCTION update_{$name}_balance()");
        }
    }

    public function down(): void
    {
        foreach (['wallet', 'goals', 'payee'] as $name) {
            $this->execute("DROP TRIGGER IF EXISTS trigger_update_{$name}_balance ON entries");
        }
    }
}
