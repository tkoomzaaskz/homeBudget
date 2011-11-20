CREATE database `ad9bis_finances`;
CREATE USER 'ad9bis_financer'@'localhost' IDENTIFIED BY '3CWSrOVLweG0';
GRANT ALL ON `ad9bis_finances`.* TO 'ad9bis_financer'@'localhost';
