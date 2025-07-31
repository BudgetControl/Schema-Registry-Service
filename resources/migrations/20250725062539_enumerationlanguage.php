<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Enumerationlanguage extends AbstractMigration
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
        //create language enumeration
        $this->execute("CREATE TYPE lang AS ENUM ('en', 'es', 'fr', 'de', 'zh', 'ja', 'ru');");
    }

    public function down(): void
    {
        // Drop the language enumeration type
        $this->execute("DROP TYPE IF EXISTS lang;");
    }
}
