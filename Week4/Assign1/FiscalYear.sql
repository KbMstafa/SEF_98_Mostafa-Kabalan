CREATE DATABASE FinanceDB;
use FinanceDB;
CREATE TABLE IF NOT EXISTS FiscalYearTable (
    fiscal_year int NOT NULL PRIMARY KEY,
    start_date date NOT NULL,
    end_date date NOT NULL
);

delimiter @

CREATE TRIGGER FY_start
    BEFORE INSERT
    ON FiscalYearTable FOR EACH ROW
    BEGIN
        IF ( YEAR ( NEW.start_date ) = NEW.fiscal_year - 1 ) THEN
            IF ( MONTH ( NEW.start_date ) = 10 ) THEN
                IF ( DAY ( NEW.start_date ) <> 1 ) THEN
                    SIGNAL SQLSTATE '45000'
                        SET MESSAGE_TEXT = 'start_date day must be 1 (first)';
                END IF;
            ELSE
                SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'start_date month must be 10 (october)';
            END IF;
        ELSE
            SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'start_date year must be equal to fiscal_year';
        END IF;
    END;@

CREATE TRIGGER FY_end
    BEFORE INSERT
    ON FiscalYearTable FOR EACH ROW
    BEGIN
        IF ( YEAR ( NEW.end_date ) = NEW.fiscal_year ) THEN
            IF ( MONTH ( NEW.end_date ) = 9 ) THEN
                IF ( DAY ( NEW.end_date ) <> 30 ) THEN
                    SIGNAL SQLSTATE '45000'
                        SET MESSAGE_TEXT = 'end_date day must be 30 (last)';
                END IF;
            ELSE
                SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'end_date month must be 9 (september)';
            END IF;
        ELSE
            SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'end_date year must be next year of fiscal_year';
        END IF;
    END;@

delimiter ;