create database medcard_db;


use medcard_db;
-- Create the viloyatlar table
CREATE TABLE IF NOT EXISTS viloyatlar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Create the tumans table
CREATE TABLE IF NOT EXISTS tumans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    viloyat_id INT NOT NULL,
    FOREIGN KEY (viloyat_id) REFERENCES viloyatlar(id) ON DELETE CASCADE
);

-- Create the patients table
CREATE TABLE IF NOT EXISTS patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL,
    viloyat_id INT NOT NULL,
    tuman_id INT NOT NULL,
    FOREIGN KEY (viloyat_id) REFERENCES viloyatlar(id) ON DELETE CASCADE,
    FOREIGN KEY (tuman_id) REFERENCES tumans(id) ON DELETE CASCADE
);

CREATE TABLE drugs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    manufacturer VARCHAR(255),
    expiration_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    image VARCHAR(255)
);


