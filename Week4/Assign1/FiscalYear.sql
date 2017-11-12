CREATE DATABASE FinanceDB;
use FinanceDB;
CREATE TABLE IF NOT EXISTS FiscalYearTable (
    fiscal_year int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    start_date date NOT NULL,
    end_date date NOT NULL
);

delimiter @

CREATE TRIGGER FY_start
    BEFORE INSERT
    ON FiscalYearTable FOR EACH ROW
    BEGIN
        IF ( YEAR ( NEW.start_date ) = NEW.fiscal_year ) THEN
            IF ( MONTH ( NEW.start_date ) = 10 ) THEN
                IF ( DAY ( NEW.start_date ) <> 1 ) THEN
                    SIGNAL SQLSTATE '45000'
                        SET MESSAGE_TEXT = 'start_date day must be 01 (first)';
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

delimiter ;