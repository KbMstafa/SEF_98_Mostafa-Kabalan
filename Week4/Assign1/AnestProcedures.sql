CREATE DATABASE HospitalRecords;
use HospitalRecords;
CREATE TABLE IF NOT EXISTS AnestProcedures (
    proc_id int NOT NULL UNIQUE AUTO_INCREMENT,
    anest_name varchar(30) NOT NULL,
    start_time time NOT NULL,
    end_time time NOT NULL
);