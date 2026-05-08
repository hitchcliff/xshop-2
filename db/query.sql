DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id int AUTO_INCREMENT PRIMARY KEY,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    password TEXT,
    email VARCHAR(255) NOT NULL,
    photo TEXT NULL,
    token VARCHAR(80) NULL,
    role VARCHAR(255) NOT NULL,
    status VARCHAR(8)
);

INSERT INTO users (first_name, last_name, password, email, token, role, status) 
VALUES ("john", "doe", "$2y$10$BvQ1nd/URcwoViDFQ1qKVecZKAlpamFhoOnoVXf2uXmmZgdx4W1JW", "admin@email.com", "176955093", "admin", 1)

DROP TABLE IF EXISTS customers;

CREATE TABLE customers (
    id int AUTO_INCREMENT PRIMARY KEY,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    password TEXT,
    email VARCHAR(255) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    photo TEXT NULL,
    token VARCHAR(80) NULL,
    role VARCHAR(255) NOT NULL,
    status VARCHAR(8)
)

DROP TABLE IF EXISTS product_categories;

CREATE TABLE product_categories (
    id int AUTO_INCREMENT PRIMARY KEY,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    name VARCHAR(255) NOT NULL,
    photo TEXT NULL
)