DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id int AUTO_INCREMENT PRIMARY KEY,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    password TEXT,
    email VARCHAR(255),
    token VARCHAR(80) NULL,
    role VARCHAR(255),
    status VARCHAR(8)
);

INSERT INTO users (first_name, last_name, password, email, token, role, status) 
VALUES ("john", "doe", "$2y$10$BvQ1nd/URcwoViDFQ1qKVecZKAlpamFhoOnoVXf2uXmmZgdx4W1JW", "admin@email.com", null, "admin", 1)