CREATE DATABASE IF NOT EXISTS medical_institution;
USE medical_institution;

CREATE TABLE IF NOT EXISTS Claims (
    claim_id INT NOT NULL PRIMARY KEY,
    patient_name VARCHAR(30) NOT NULL
);
