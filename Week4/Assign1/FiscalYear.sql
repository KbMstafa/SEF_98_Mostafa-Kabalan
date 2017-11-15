delimiter @

CREATE DATABASE IF NOT EXISTS FinanceDB@
use FinanceDB@
CREATE TABLE IF NOT EXISTS FiscalYearTable (
    fiscal_year int NOT NULL PRIMARY KEY,
    start_date date NOT NULL,
    end_date date NOT NULL
)@

CREATE TRIGGER FY_add
    BEFORE INSERT
    ON FiscalYearTable FOR EACH ROW
    BEGIN
        IF ( TIMESTAMPDIFF(MONTH, NEW.start_date, NEW.end_date) < 6 ) THEN
            SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'a fiscal year length should be at least 6 months';
        ELSEIF ( TIMESTAMPDIFF(MONTH, NEW.start_date, NEW.end_date) > 18 ) THEN
            SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'a fiscal year length should be at most 18 months';
        ELSEIF ((SELECT count(*) FROM (SELECT start_date, end_date 
                  FROM FiscalYearTable 
                  WHERE NEW.start_date BETWEEN start_date AND end_date
                     OR NEW.end_date BETWEEN start_date AND end_date) t) <> 0
                ) THEN
            SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'the given fiscal_year overlaps with another fiscal_year';
        END IF;
    END; @

CREATE TRIGGER FY_upd
    BEFORE UPDATE
    ON FiscalYearTable FOR EACH ROW
    BEGIN
        IF ( TIMESTAMPDIFF(MONTH, NEW.start_date, NEW.end_date) < 6 ) THEN
            SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'a fiscal year length should be at least 6 months';
        ELSEIF ( TIMESTAMPDIFF(MONTH, NEW.start_date, NEW.end_date) > 18 ) THEN
            SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'a fiscal year length should be at most 18 months';
        ELSEIF ((SELECT count(*) FROM (SELECT start_date, end_date 
                  FROM FiscalYearTable 
                  WHERE NEW.start_date BETWEEN start_date AND end_date
                     OR NEW.end_date BETWEEN start_date AND end_date) t) <> 0
                ) THEN
            SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'the given fiscal_year overlaps with another fiscal_year';
        END IF;
    END; @

delimiter ;