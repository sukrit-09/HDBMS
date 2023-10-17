CREATE DATABASE IF NOT EXISTS Hospital_DB;
USE Hospital_DB;

CREATE TABLE IF NOT EXISTS BedAvailability (
    BedID INT AUTO_INCREMENT PRIMARY KEY,
    AvailableBeds INT
);

CREATE TABLE IF NOT EXISTS Patients (
    PatientID INT AUTO_INCREMENT PRIMARY KEY,
    PatientName VARCHAR(255) NOT NULL,
    ContactNumber VARCHAR(10) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    DateOfBirth DATE NOT NULL,
    BedID INT,
    AdmissionDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (BedID) REFERENCES BedAvailability(BedID)
);

-- Insert initial bed availability data
INSERT INTO BedAvailability (AvailableBeds) VALUES (500);


DELIMITER //

CREATE PROCEDURE AdmitPatient(IN in_patientName VARCHAR(255), IN in_bedID INT)
BEGIN
    DECLARE CurrentAvailableBeds INT;
    
    SELECT AvailableBeds INTO CurrentAvailableBeds FROM BedAvailability ORDER BY BedID DESC LIMIT 1;
    
    IF CurrentAvailableBeds > 0 THEN
        UPDATE BedAvailability SET AvailableBeds = CurrentAvailableBeds - 1;
        INSERT INTO Patients (PatientName, BedID) VALUES (in_patientName, in_bedID);
        SELECT CONCAT('Patient admitted successfully. Bed ID: ', in_bedID) AS Message;
    ELSE
        SELECT 'No available beds.' AS Message;
    END IF;
END;
//

DELIMITER ;
