CREATE DATABASE IF NOT EXISTS medical_institution;

USE medical_institution;

CREATE TABLE IF NOT EXISTS Claims (
    claim_id INT NOT NULL PRIMARY KEY,
    patient_name VARCHAR(30) NOT NULL
);

INSERT INTO Claims VALUES (1, 'Bassem Dghaidi'), 
                          (2, 'Omar Breidi'), 
                          (3, 'Marwan Sawwan');

CREATE TABLE IF NOT EXISTS Defendants (
    claim_id INT NOT NULL,
    defendant_name VARCHAR(30) NOT NULL
);

INSERT INTO Defendants VALUES (1, 'Jean Skaff'),
                              (1, 'Elie Meouchi'),
                              (1, 'Radwan Sameh'),
                              (2, 'Joseph Eid'),
                              (2, 'Paul Syoufi'),
                              (2, 'Radwan Sameh'),
                              (3, 'Issam Awwad');

CREATE TABLE IF NOT EXISTS LegalEvents (
    claim_id INT NOT NULL,
    defendant_name VARCHAR(30) NOT NULL,
    claim_status VARCHAR(2) NOT NULL,
    change_date DATE NOT NULL
);

INSERT INTO LegalEvents VALUES (1, 'Jean Skaff', 'AP', '2016-01-01'),
                               (1, 'Jean Skaff', 'OR', '2016-02-02'),
                               (1, 'Jean Skaff', 'SF', '2016-03-01'),
                               (1, 'Jean Skaff', 'CL', '2016-04-01'),
                               (1, 'Radwan Sameh', 'AP', '2016-01-01'),
                               (1, 'Radwan Sameh', 'OR', '2016-02-02'),
                               (1, 'Radwan Sameh', 'SF', '2016-03-01'),
                               (1, 'Elie Meouchi', 'AP', '2016-01-01'),
                               (1, 'Elie Meouchi', 'OR', '2016-02-02'),
                               (2, 'Radwan Sameh', 'AP', '2016-01-01'),
                               (2, 'Radwan Sameh', 'OR', '2016-02-01'),
                               (2, 'Paul Syoufi', 'AP', '2016-01-01'),
                               (3, 'Issam Awwad', 'AP', '2016-01-01');

CREATE TABLE IF NOT EXISTS ClaimStatusCodes (
    claim_status VARCHAR(2) NOT NULL,
    claim_status_desc VARCHAR(30) NOT NULL,
    claim_seq INT NOT NULL UNIQUE
);

INSERT INTO ClaimStatusCodes VALUES ('AP', 'Awaiting review panel', 1),
                                    ('OR', 'Panel opinion rendered', 2),
                                    ('SF', 'Suit filed', 3),
                                    ('CL', 'Closed', 4);

SELECT 
    PCC.claim_id, PCC.patient_name, C2S.claim_status
FROM
    (SELECT 
        LC.claim_id,
            Claims.patient_name,
            MIN(LC.last_claim) AS claim_code
    FROM
        (SELECT 
        LE.claim_id,
            LE.defendant_name,
            MAX(S2C.claim_seq) AS last_claim
    FROM
        LegalEvents AS LE, ClaimStatusCodes AS S2C
    WHERE
        LE.claim_status = S2C.claim_status
    GROUP BY LE.defendant_name , LE.claim_id
    ORDER BY LE.claim_id) AS LC, Claims
    WHERE
        Claims.claim_id = LC.claim_id
    GROUP BY LC.claim_id) AS PCC,
    ClaimStatusCodes AS C2S
WHERE
    PCC.claim_code = C2S.claim_seq
ORDER BY PCC.claim_id;