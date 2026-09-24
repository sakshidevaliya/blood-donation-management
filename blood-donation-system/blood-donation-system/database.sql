-- ============================================
-- Blood Donation Management System Database
-- Import this file in phpMyAdmin (Import tab)
-- ============================================

CREATE DATABASE IF NOT EXISTS blood_donation_db;
USE blood_donation_db;

-- Donors table
CREATE TABLE IF NOT EXISTS donors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  blood_group VARCHAR(5) NOT NULL,
  city VARCHAR(100) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  email VARCHAR(150),
  last_donation_date DATE NULL,
  available ENUM('Yes','No') DEFAULT 'Yes',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Blood requests table (submitted by recipients/hospitals)
CREATE TABLE IF NOT EXISTS requests (
  id INT AUTO_INCREMENT PRIMARY KEY,
  patient_name VARCHAR(150) NOT NULL,
  blood_group VARCHAR(5) NOT NULL,
  city VARCHAR(100) NOT NULL,
  contact_phone VARCHAR(20) NOT NULL,
  hospital_name VARCHAR(150),
  units_needed INT DEFAULT 1,
  status VARCHAR(50) DEFAULT 'Pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Admin table
CREATE TABLE IF NOT EXISTS admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL
);

-- ============================================
-- Sample FAKE donor data (for demo purposes only)
-- ============================================
INSERT INTO donors (name, blood_group, city, phone, email, last_donation_date, available) VALUES
('Rahul Sharma', 'O+', 'Mumbai', '9800000001', 'donor1@example.com', '2026-04-10', 'Yes'),
('Priya Patel', 'A+', 'Mumbai', '9800000002', 'donor2@example.com', '2026-05-01', 'Yes'),
('Amit Verma', 'B+', 'Pune', '9800000003', 'donor3@example.com', '2026-06-15', 'No'),
('Sneha Iyer', 'AB+', 'Pune', '9800000004', 'donor4@example.com', NULL, 'Yes'),
('Vikram Singh', 'O-', 'Delhi', '9800000005', 'donor5@example.com', '2026-03-20', 'Yes'),
('Anjali Desai', 'A-', 'Delhi', '9800000006', 'donor6@example.com', '2026-05-25', 'No'),
('Karan Mehta', 'B-', 'Bangalore', '9800000007', 'donor7@example.com', NULL, 'Yes'),
('Neha Joshi', 'AB-', 'Bangalore', '9800000008', 'donor8@example.com', '2026-02-14', 'Yes'),
('Rohan Kapoor', 'O+', 'Chennai', '9800000009', 'donor9@example.com', '2026-06-01', 'Yes'),
('Divya Nair', 'A+', 'Chennai', '9800000010', 'donor10@example.com', NULL, 'Yes'),
('Sanjay Gupta', 'O+', 'Mumbai', '9800000011', 'donor11@example.com', '2026-01-30', 'Yes'),
('Pooja Reddy', 'B+', 'Hyderabad', '9800000012', 'donor12@example.com', '2026-04-22', 'Yes'),
('Arjun Malhotra', 'AB+', 'Hyderabad', '9800000013', 'donor13@example.com', NULL, 'Yes'),
('Kavita Rao', 'O-', 'Pune', '9800000014', 'donor14@example.com', '2026-05-10', 'No'),
('Manish Kumar', 'A-', 'Delhi', '9800000015', 'donor15@example.com', NULL, 'Yes'),
('Ritu Chawla', 'B-', 'Mumbai', '9800000016', 'donor16@example.com', '2026-03-05', 'Yes'),
('Deepak Yadav', 'O+', 'Bangalore', '9800000017', 'donor17@example.com', '2026-06-20', 'Yes'),
('Simran Kaur', 'A+', 'Chennai', '9800000018', 'donor18@example.com', NULL, 'Yes');

-- ============================================
-- Sample FAKE blood requests (for demo purposes only)
-- ============================================
INSERT INTO requests (patient_name, blood_group, city, contact_phone, hospital_name, units_needed, status) VALUES
('Suresh Nair', 'O+', 'Mumbai', '9900000001', 'City Care Hospital', 2, 'Pending'),
('Meena Iyer', 'A+', 'Pune', '9900000002', 'Sunrise Hospital', 1, 'Approved'),
('Farhan Ali', 'B+', 'Delhi', '9900000003', 'Metro Medical Center', 3, 'Fulfilled'),
('Geeta Sharma', 'AB+', 'Bangalore', '9900000004', 'St. Mary Hospital', 1, 'Pending'),
('Vivek Rana', 'O-', 'Chennai', '9900000005', 'Apex Hospital', 2, 'Approved'),
('Alka Bhatt', 'A-', 'Mumbai', '9900000006', 'Lifeline Hospital', 1, 'Pending'),
('Rakesh Jain', 'B-', 'Hyderabad', '9900000007', 'Care & Cure Hospital', 2, 'Fulfilled'),
('Tanya Sen', 'AB-', 'Pune', '9900000008', 'Wellness Hospital', 1, 'Pending');
