-- create "users" table
CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
  `name` VARCHAR(64) NOT NULL , 
  `email` VARCHAR(191) NOT NULL UNIQUE,
  `password` VARCHAR(191) NOT NULL UNIQUE
) ENGINE = InnoDB;