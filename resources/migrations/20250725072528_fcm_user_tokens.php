<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class FcmUserTokens extends AbstractMigration
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
        //Create platform enumeration
        $this->execute("CREATE TYPE platform AS ENUM ('android', 'ios', 'web');");

        $table = $this->table('fcm_tokens');
        $table
            ->addColumn('user_id', 'integer', ['null' => false])
            ->addColumn('token', 'text', ['null' => false])
            ->addColumn('device_info', 'text', ['null' => true])
            ->addColumn('platform', \Phinx\Util\Literal::from('platform'), [
                'null' => false
            ])
            ->addColumn('lang', \Phinx\Util\Literal::from('lang'), [
                'null' => false
            ])
            ->addColumn('created_at', 'datetime', [
            'default' => 'CURRENT_TIMESTAMP',
            'null' => false
            ])
            ->addColumn('updated_at', 'datetime', [
            'default' => 'CURRENT_TIMESTAMP',
            'update' => 'CURRENT_TIMESTAMP',
            'null' => false
            ])
            ->addIndex(['token'], ['unique' => true])
            ->addForeignKey('user_id', 'users', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION'
            ])
            ->create();
    }

    public function down(): void
    {
        $this->execute("DROP TYPE IF EXISTS platform;");
        $this->table('fcm_tokens')->drop()->save();
    }

}
