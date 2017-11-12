CREATE DATABASE HospitalRecords;
use HospitalRecords;
CREATE TABLE IF NOT EXISTS AnestProcedures (
    proc_id int NOT NULL UNIQUE AUTO_INCREMENT,
    anest_name varchar(30) NOT NULL,
    start_time time NOT NULL,
    end_time time NOT NULL
);

DELIMITER @

CREATE FUNCTION count_overlap (name varchar(30), curTime time)
    RETURNS integer
    BEGIN
        DECLARE total integer;
        SELECT COUNT(proc_id) INTO total
        FROM AnestProcedures
        WHERE ( name = IDanest_name )
                AND /*( curTime BETWEEN start_time AND end_time)*/( ( curTime >= start_time ) AND ( curTime < end_time ) ) ;
        RETURN total;
    END; @

DELIMITER ;