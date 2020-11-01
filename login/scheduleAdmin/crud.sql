-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- Database: `crud`
-- Table structure for table `googles`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `1st` varchar(20) NOT NULL,
  `2nd` varchar(20) NOT NULL,
  `3rd` varchar(20) NOT NULL,
  `4th` varchar(20) NOT NULL,
  `5th` varchar(20) NOT NULL
) ENGINE=InnoDB;

ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

-- AUTO_INCREMENT for table `googles`
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
  
