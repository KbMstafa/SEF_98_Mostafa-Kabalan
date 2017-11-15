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

CREATE TABLE IF NOT EXISTS ClaimStatusCodes (
    claim_status VARCHAR(2) NOT NULL,
    claim_status_desc VARCHAR(30) NOT NULL,
    claim_seq INT NOT NULL UNIQUE
);