-- SQL dump for library_db (tables + sample data)

CREATE DATABASE IF NOT EXISTS library_db;
USE library_db;

-- Books table
CREATE TABLE IF NOT EXISTS books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(100) NOT NULL,
    year INT NOT NULL
);

-- Members table
CREATE TABLE IF NOT EXISTS members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20),
    joined_date DATE DEFAULT CURRENT_DATE
);

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','member') DEFAULT 'member'
);

-- Sample books
INSERT INTO books (title, author, year) VALUES
('The Alchemist', 'Paulo Coelho', 1988),
('To Kill a Mockingbird', 'Harper Lee', 1960),
('1984', 'George Orwell', 1949),
('The Great Gatsby', 'F. Scott Fitzgerald', 1925),
('Harry Potter and the Sorcerer''s Stone', 'J.K. Rowling', 1997);

-- Sample members
INSERT INTO members (name, email, phone) VALUES
('John Doe', 'john@example.com', '1234567890'),
('Jane Smith', 'jane@example.com', '9876543210'),
('Alice Johnson', 'alice@example.com', '5555555555'),
('Bob Williams', 'bob@example.com', '4444444444'),
('Emma Brown', 'emma@example.com', '3333333333');

-- Sample users (plain-text passwords for demo)
INSERT INTO users (name, email, password, role) VALUES
('Admin', 'admin@example.com', 'admin123', 'admin'),
('John Doe', 'john@example.com', 'member123', 'member'),
('Jane Smith', 'jane@example.com', 'member123', 'member'),
('Alice Johnson', 'alice@example.com', 'member123', 'member'),
('Bob Williams', 'bob@example.com', 'member123', 'member'),
('Emma Brown', 'emma@example.com', 'member123', 'member');
