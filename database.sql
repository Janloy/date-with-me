CREATE DATABASE IF NOT EXISTS romantic_date;
USE romantic_date;

CREATE TABLE IF NOT EXISTS responses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vibe VARCHAR(50) NOT NULL,
    food VARCHAR(100) NOT NULL,
    date_time DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Default credential payload (User: admin , Pass: password123)
INSERT INTO admins (username, password) 
VALUES ('admin', '$2y$10$ZexS8u9mshwM8R7j6Z0gO.wZ6p38z7KjB7S57C3e3C8E4g2t2yK1S')
ON DUPLICATE KEY UPDATE id=id;