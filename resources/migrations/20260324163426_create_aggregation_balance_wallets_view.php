<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateAggregationBalanceWalletsView extends AbstractMigration
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
        $sql = "CREATE OR REPLACE VIEW aggregated_balances AS
                SELECT
                    w.*,
                    totals.wallet_balance,
                    totals.payee_balance,
                    totals.goal_balance
                FROM wallets w
                LEFT JOIN (
                    SELECT
                        e.account_id,
                        COALESCE(SUM(
                            CASE
                                WHEN e.type IN ('incoming','expenses','transfer') 
                                AND e.confirmed = true
                                AND e.planned = false
                                AND e.deleted_at IS NULL
                                THEN e.amount ELSE 0
                            END
                        ), 0) AS wallet_balance,
                        COALESCE(SUM(
                            CASE
                                WHEN e.type = 'debit' 
                                AND e.confirmed = true
                                AND e.planned = false
                                AND e.deleted_at IS NULL
                                THEN e.amount ELSE 0
                            END
                        ), 0) AS payee_balance,
                        COALESCE(SUM(
                            CASE
                                WHEN e.type = 'saving' 
                                AND e.confirmed = true
                                AND e.planned = false
                                AND e.deleted_at IS NULL
                                THEN e.amount ELSE 0
                            END
                        ), 0) AS goal_balance
                    FROM entries e
                    GROUP BY e.account_id
                ) AS totals ON totals.account_id = w.id;";

        $this->execute($sql);
    }

    public function down(): void
    {
        $this->execute("DROP VIEW IF EXISTS aggregated_balances;");
    }
    }
