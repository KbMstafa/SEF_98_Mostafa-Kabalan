CREATE DATABASE FinanceDB;
use FinanceDB;
CREATE TABLE IF NOT EXISTS FiscalYearTable (
    fiscal_year int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    start_date date NOT NULL,
    end_date date NOT NULL
);