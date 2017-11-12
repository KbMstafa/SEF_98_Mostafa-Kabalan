CREATE DATABASE HospitalRecords;
use HospitalRecords;
CREATE TABLE IF NOT EXISTS AnestProcedures (
    proc_id int NOT NULL UNIQUE AUTO_INCREMENT,
    anest_name varchar(30) NOT NULL,
    start_time time NOT NULL,
    end_time time NOT NULL
);

INSERT INTO AnestProcedures VALUES (0, "'Albert'", "08:00", "11:00");
INSERT INTO AnestProcedures VALUES (0, "'Albert'", "09:00", "13:00");
INSERT INTO AnestProcedures VALUES (0, "'Kamal'", "08:00", "13:30");
INSERT INTO AnestProcedures VALUES (0, "'Kamal'", "09:00", "15:30");
INSERT INTO AnestProcedures VALUES (0, "'Kamal'", "10:00", "11:30");
INSERT INTO AnestProcedures VALUES (0, "'Kamal'", "12:00", "13:30");
INSERT INTO AnestProcedures VALUES (0, "'Kamal'", "13:30", "14:30");
INSERT INTO AnestProcedures VALUES (0, "'Kamal'", "18:30", "19:00");


DELIMITER @

CREATE FUNCTION count_overlap (name varchar(30), curTime time)
    RETURNS integer
    BEGIN
        DECLARE total integer;
        SELECT COUNT(proc_id) INTO total
        FROM AnestProcedures
        WHERE ( name = anest_name )
                AND ( ( curTime >= start_time ) AND ( curTime < end_time ) ) ;
        RETURN total;
    END; @

CREATE FUNCTION max_overlap (name varchar(30), startT time, endT time)
    RETURNS integer
    BEGIN
        DECLARE max integer;
        DECLARE curTime time;
        SET curTime = startT;
        SET max = 0;
        WHILE curTime <= endT DO
            SET max = GREATEST(max, count_overlap (name, curTime));
            SET curTime = ADDTIME(curTime,"00:05");
        END WHILE;
        RETURN max;
    END; @

DELIMITER ;

SELECT proc_id, max_overlap(anest_name, start_time, end_time) AS max_inst_count
FROM AnestProcedures;