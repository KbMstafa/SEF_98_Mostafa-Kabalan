CREATE USER IF NOT EXISTS 'sakilaRental'@'localhost' IDENTIFIED BY 'sakila123';
GRANT ALL PRIVILEGES ON sakila.* TO 'sakilaRental'@'localhost';
FLUSH PRIVILEGES;