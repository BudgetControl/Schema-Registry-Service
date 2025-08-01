<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UpdateWalletTrigger extends AbstractMigration
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

        $this->execute("DROP TRIGGER trigger_update_wallet_balance ON entries;");
        $this->execute("DROP FUNCTION update_wallet_balance;");

        $stm = "CREATE OR REPLACE FUNCTION update_wallet_balance()
      RETURNS TRIGGER AS $$
      BEGIN

    -- Ignora le entry di tipo saving
        IF (TG_OP = 'INSERT' AND NEW.type = 'saving') OR 
            (TG_OP = 'UPDATE' AND NEW.type = 'saving') THEN
            RETURN NEW;
        END IF;

     -- Caso INSERT: aggiungi l'importo al bilancio se l'entry è confermata e non pianificata
    	  IF TG_OP = 'INSERT' THEN
    		  IF NEW.confirmed = true AND NEW.planned = false THEN
    			  UPDATE wallets
    			  SET balance = balance + NEW.amount
    			  WHERE id = NEW.account_id;
    		  END IF;
    		  RETURN NEW;
    	  END IF;
        -- Caso DELETE logico: sottrai l'importo dal bilancio se l'entry era confermata e non pianificata
        IF TG_OP = 'UPDATE' THEN
            -- Controlla se `deleted_at` è passato da NULL a un valore (soft delete)
            IF OLD.deleted_at IS NULL AND NEW.deleted_at IS NOT NULL THEN
                IF OLD.confirmed = true AND OLD.planned = false THEN
                    UPDATE wallets
                    SET balance = balance - OLD.amount
                    WHERE id = OLD.account_id;
                END IF;
            END IF;
    
            -- Altri casi di UPDATE (come già presenti)
            -- Se l'importo cambia e la entry è confermata, bilancia l'importo differenziale
            IF OLD.amount <> NEW.amount AND OLD.confirmed = true AND OLD.planned = false THEN
                UPDATE wallets
                SET balance = balance - OLD.amount + NEW.amount
                WHERE id = NEW.account_id;
            END IF;
    
            -- Caso 1: planned cambia da true a false
            IF OLD.planned = true AND NEW.planned = false THEN
                UPDATE wallets
                SET balance = balance + NEW.amount
                WHERE id = NEW.account_id;
            END IF;
    
            -- Caso 2: planned cambia da false a true
            IF OLD.planned = false AND NEW.planned = true THEN
                UPDATE wallets
                SET balance = balance - NEW.amount
                WHERE id = NEW.account_id;
            END IF;
    
            -- Caso 3: confirmed cambia da true a false
            IF OLD.confirmed = true AND NEW.confirmed = false THEN
                UPDATE wallets
                SET balance = balance - NEW.amount
                WHERE id = NEW.account_id;
            END IF;
    
            -- Caso 4: confirmed cambia da false a true
            IF OLD.confirmed = false AND NEW.confirmed = true AND OLD.planned = false THEN
                UPDATE wallets
                SET balance = balance + NEW.amount
                WHERE id = NEW.account_id;
            END IF;
    
            RETURN NEW;
        END IF;
    
        RETURN NULL;
    END;
      $$ LANGUAGE plpgsql;";

        $this->execute($stm);
        $this->execute("CREATE TRIGGER trigger_update_wallet_balance
        AFTER INSERT OR UPDATE OR DELETE ON entries
        FOR EACH ROW
        EXECUTE FUNCTION update_wallet_balance();");
    }

    public function down(): void
    {
        $this->execute("DROP TRIGGER trigger_update_wallet_balance ON entries;");
        $this->execute("DROP FUNCTION update_wallet_balance;");
    }
}
