CREATE TABLE admitted_patients_db (
    id INT AUTO_INCREMENT PRIMARY KEY,
    doctor_name VARCHAR(255) NOT NULL,
    admission_date DATE NOT NULL,
    planned_procedure VARCHAR(255) NOT NULL,
    patient_name VARCHAR(255) NOT NULL,
    date_of_birth DATE NOT NULL,
    parent_name VARCHAR(255) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    marital_status VARCHAR(20),
    employment_status VARCHAR(20),
    phone_number VARCHAR(20) NOT NULL,
    emergency_phone_number VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    address TEXT NOT NULL
);
