CREATE DATABASE IF NOT EXISTS medical_institution;

USE medical_institution;

CREATE TABLE IF NOT EXISTS Claims (
    claim_id INT NOT NULL PRIMARY KEY,
    patient_name VARCHAR(30) NOT NULL
);

CREATE TABLE IF NOT EXISTS Defendants (
    claim_id INT NOT NULL,
    defendant_name VARCHAR(30) NOT NULL
);

CREATE TABLE IF NOT EXISTS LegalEvents (
    claim_id INT NOT NULL,
    defendant_name VARCHAR(30) NOT NULL,
    claim_status VARCHAR(2) NOT NULL,
    change_date DATE NOT NULL
);

