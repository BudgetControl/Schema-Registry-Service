<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreatePayeeBalanceTriggerUpdate extends AbstractMigration
{
    public function up(): void
    {
        $stm = <<<SQL
        CREATE OR REPLACE FUNCTION update_payee_balance()
        RETURNS TRIGGER AS $$
        BEGIN
            IF (TG_OP = 'DELETE' OR OLD.type = 'debit' OR NEW.type = 'debit') THEN
                -- Caso DELETE: sottrai l'importo dal bilancio se era confermato e non pianificato
                IF TG_OP = 'DELETE' THEN
                    IF OLD.confirmed = true AND OLD.planned = false THEN
                        UPDATE payees
                        SET balance = balance - OLD.amount
                        WHERE id = OLD.payee_id;
                    END IF;
                    RETURN OLD;
                END IF;

                -- Caso INSERT: aggiungi l'importo al bilancio se è confermato e non pianificato
                IF TG_OP = 'INSERT' THEN
                    IF NEW.confirmed = true AND NEW.planned = false AND NEW.type = 'debit' THEN
                        UPDATE payees
                        SET balance = balance + NEW.amount
                        WHERE id = NEW.payee_id;
                    END IF;
                    RETURN NEW;
                END IF;

                -- Caso UPDATE: gestisci tutte le modifiche
                IF TG_OP = 'UPDATE' THEN
                    -- Gestione cambio payee_id
                    IF OLD.payee_id <> NEW.payee_id THEN
                        -- Rimuovi dal vecchio payee
                        IF OLD.confirmed = true AND OLD.planned = false THEN
                            UPDATE payees
                            SET balance = balance - OLD.amount
                            WHERE id = OLD.payee_id;
                        END IF;
                        
                        -- Aggiungi al nuovo payee
                        IF NEW.confirmed = true AND NEW.planned = false THEN
                            UPDATE payees
                            SET balance = balance + NEW.amount
                            WHERE id = NEW.payee_id;
                        END IF;
                    ELSE
                        -- Aggiornamento standard se il payee non cambia
                        IF OLD.amount <> NEW.amount AND OLD.confirmed = true AND OLD.planned = false THEN
                            UPDATE payees
                            SET balance = balance - OLD.amount + NEW.amount
                            WHERE id = NEW.payee_id;
                        END IF;

                        -- Gestione cambiamenti planned/confirmed
                        IF OLD.planned = true AND NEW.planned = false THEN
                            UPDATE payees
                            SET balance = balance + NEW.amount
                            WHERE id = NEW.payee_id;
                        ELSIF OLD.planned = false AND NEW.planned = true THEN
                            UPDATE payees
                            SET balance = balance - NEW.amount
                            WHERE id = NEW.payee_id;
                        END IF;

                        IF OLD.confirmed = true AND NEW.confirmed = false THEN
                            UPDATE payees
                            SET balance = balance - NEW.amount
                            WHERE id = NEW.payee_id;
                        ELSIF OLD.confirmed = false AND NEW.confirmed = true AND NEW.planned = false THEN
                            UPDATE payees
                            SET balance = balance + NEW.amount
                            WHERE id = NEW.payee_id;
                        END IF;
                    END IF;
                    RETURN NEW;
                END IF;
            END IF;
            RETURN NULL;
        END;
        $$ LANGUAGE plpgsql;
        SQL;

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
