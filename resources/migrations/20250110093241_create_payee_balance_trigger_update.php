<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreatePayeeBalanceTriggerUpdate extends AbstractMigration
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

      $stm = "CREATE OR REPLACE FUNCTION update_payee_balance()
      RETURNS TRIGGER AS $$
      BEGIN
        -- Esegui il trigger solo se type = 'debit'
        IF NEW.type = 'debit' THEN
            -- Caso DELETE: sottrai l'importo dal bilancio se l'entry era confermata e non pianificata
            IF TG_OP = 'DELETE' THEN
                IF OLD.confirmed = true AND OLD.planned = false THEN
                    UPDATE payees
                    SET balance = balance - OLD.amount
                    WHERE id = OLD.payee_id;
                END IF;
                RETURN OLD;
            END IF;
        
            -- Caso INSERT: aggiungi l'importo al bilancio se l'entry è confermata e non pianificata
            IF TG_OP = 'INSERT' THEN
                IF NEW.confirmed = true AND NEW.planned = false THEN
                    UPDATE payees
                    SET balance = balance + NEW.amount
                    WHERE id = NEW.payee_id;
                END IF;
                RETURN NEW;
            END IF;
        
            -- Caso UPDATE: gestisci le modifiche a amount, planned e confirmed
            IF TG_OP = 'UPDATE' THEN
                -- Se l'importo cambia e la entry è confermata, bilancia l'importo differenziale
                IF OLD.amount <> NEW.amount AND OLD.confirmed = true AND OLD.planned = false THEN
                    UPDATE payees
                    SET balance = balance - OLD.amount + NEW.amount
                    WHERE id = NEW.payee_id;
                END IF;
        
                -- Caso 1: planned cambia da true a false
                IF OLD.planned = true AND NEW.planned = false THEN
                    UPDATE payees
                    SET balance = balance + NEW.amount
                    WHERE id = NEW.payee_id;
                END IF;
        
                -- Caso 2: planned cambia da false a true
                IF OLD.planned = false AND NEW.planned = true THEN
                    UPDATE payees
                    SET balance = balance - NEW.amount
                    WHERE id = NEW.payee_id;
                END IF;
        
                -- Caso 3: confirmed cambia da true a false
                IF OLD.confirmed = true AND NEW.confirmed = false THEN
                    UPDATE payees
                    SET balance = balance - NEW.amount
                    WHERE id = NEW.payee_id;
                END IF;
        
                -- Caso 4: confirmed cambia da false a true
                IF OLD.confirmed = false AND NEW.confirmed = true AND OLD.planned = false THEN
                    UPDATE payees
                    SET balance = balance + NEW.amount
                    WHERE id = NEW.payee_id;
                END IF;
        
                RETURN NEW;
            END IF;
        
            RETURN NULL;
        END IF;
        RETURN NULL;
      END;
      $$ LANGUAGE plpgsql;";

        $this->execute($stm);
        $this->execute("CREATE TRIGGER trigger_update_payee_balance
        AFTER INSERT OR UPDATE OR DELETE ON entries
        FOR EACH ROW
        EXECUTE FUNCTION update_payee_balance();");
    }

    public function down(): void
    {
        $this->execute("DROP TRIGGER trigger_update_payee_balance ON entries;");
        $this->execute("DROP FUNCTION update_payee_balance;");
    }
}
