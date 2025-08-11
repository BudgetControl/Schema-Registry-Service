<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateEntriesKeywordsTable extends AbstractMigration
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
        $table = $this->table('entries_keywords');
        $table
            ->addColumn('entry_id', 'integer', ['null' => false])
            ->addColumn('keyword', 'text', ['null' => false])
            ->addColumn('score', 'float', ['default' => 0, 'null' => false])
            ->addColumn('created_at', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'null' => false
            ])
            ->addColumn('updated_at', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
                'null' => false
            ])
            ->addForeignKey('entry_id', 'entries', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ])
            ->create();

        // Add GIN index for full-text search on 'keyword' column
        $this->execute('CREATE INDEX idx_keyword_fulltext ON entries_keywords USING GIN (to_tsvector(\'english\', keyword))');

        $this->table('entries')->addColumn('has_keywords', 'boolean', [
            'default' => false,
            'null' => false
        ])->update();
    }

    public function down(): void
    {
        $this->table('entries_keywords')->drop()->save();
    }
}
