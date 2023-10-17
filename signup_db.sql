-- Create the signup_db database
CREATE DATABASE signup_db;

-- Use the signup_db database
USE signup_db;

-- Create a table to store user information
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    signup_as ENUM('receptionist', 'doctor', 'nurse', 'nonmedicalstaff') NOT NULL,
    email VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);
