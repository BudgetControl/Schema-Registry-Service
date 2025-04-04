<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Enums extends AbstractMigration
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
        $this->execute("CREATE TYPE wallet AS ENUM ('bank', 'cache', 'credit-card', 'investment', 'loan', 'other', 'prepaid-card', 'credit-card-revolving','voucher');");
        $this->execute("CREATE TYPE entry AS ENUM ('expenses', 'incoming', 'saving', 'investments', 'debit','transfer');");
        $this->execute("CREATE TYPE planning AS ENUM ('daily', 'weekly', 'monthly', 'yearly', 'once-shot', 'recursively');");
    }

    /**
     * Migrate Down.
     */
    public function down(): void
    {
        $this->execute("DROP TYPE IF EXISTS wallet;");
        $this->execute("DROP TYPE IF EXISTS entry;");
        $this->execute("DROP TYPE IF EXISTS planning;");
    }
}
