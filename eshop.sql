/*
 Navicat Premium Data Transfer

 Source Server         : Java Institute
 Source Server Type    : MySQL
 Source Server Version : 80028
 Source Host           : localhost:3306
 Source Schema         : eshop

 Target Server Type    : MySQL
 Target Server Version : 80028
 File Encoding         : 65001

 Date: 27/08/2022 21:27:51
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `email` varchar(100) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of admin
-- ----------------------------
BEGIN;
INSERT INTO `admin` (`email`, `fname`, `lname`, `verification_code`) VALUES ('poojithairosha9311@gmail.com', 'Poojitha', 'Irosha', '6303100cd7522');
COMMIT;

-- ----------------------------
-- Table structure for brand
-- ----------------------------
DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of brand
-- ----------------------------
BEGIN;
INSERT INTO `brand` (`id`, `name`) VALUES (1, 'Apple');
INSERT INTO `brand` (`id`, `name`) VALUES (2, 'Samsung');
INSERT INTO `brand` (`id`, `name`) VALUES (3, 'Sony');
INSERT INTO `brand` (`id`, `name`) VALUES (4, 'Vivo');
INSERT INTO `brand` (`id`, `name`) VALUES (5, 'Oppo');
INSERT INTO `brand` (`id`, `name`) VALUES (6, 'MSI');
INSERT INTO `brand` (`id`, `name`) VALUES (7, 'Dell');
INSERT INTO `brand` (`id`, `name`) VALUES (8, 'Asus');
INSERT INTO `brand` (`id`, `name`) VALUES (9, 'Acer');
INSERT INTO `brand` (`id`, `name`) VALUES (10, 'DJI');
COMMIT;

-- ----------------------------
-- Table structure for cart
-- ----------------------------
DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `qty` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_user_email` (`user_email`),
  KEY `cart_product_id` (`product_id`),
  CONSTRAINT `cart_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `cart_user_email` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of cart
-- ----------------------------
BEGIN;
INSERT INTO `cart` (`id`, `product_id`, `user_email`, `qty`) VALUES (13, 13, 'poojithairosha9311@gmail.com', 3);
INSERT INTO `cart` (`id`, `product_id`, `user_email`, `qty`) VALUES (15, 17, 'poojithairosha9311@gmail.com', 1);
INSERT INTO `cart` (`id`, `product_id`, `user_email`, `qty`) VALUES (16, 6, 'poojithairosha9311@gmail.com', 1);
INSERT INTO `cart` (`id`, `product_id`, `user_email`, `qty`) VALUES (19, 4, 'poojithairosha9311@gmail.com', 4);
COMMIT;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of category
-- ----------------------------
BEGIN;
INSERT INTO `category` (`id`, `name`) VALUES (1, 'Cell Phones & Accessories');
INSERT INTO `category` (`id`, `name`) VALUES (2, 'Computers & Tablets');
INSERT INTO `category` (`id`, `name`) VALUES (3, 'Laptops & Accessories');
INSERT INTO `category` (`id`, `name`) VALUES (4, 'Drones & Cameras');
INSERT INTO `category` (`id`, `name`) VALUES (5, 'Video Game Consoles');
INSERT INTO `category` (`id`, `name`) VALUES (6, 'Earphones & Headset');
INSERT INTO `category` (`id`, `name`) VALUES (7, 'Iphones');
COMMIT;

-- ----------------------------
-- Table structure for city
-- ----------------------------
DROP TABLE IF EXISTS `city`;
CREATE TABLE `city` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `postal_code` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `district_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_city_district` (`district_id`),
  CONSTRAINT `FK_city_district` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of city
-- ----------------------------
BEGIN;
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (1, 'Colombo', NULL, 5);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (2, 'Dehiwala-Mount Lavinia', NULL, 5);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (3, 'Moratuwa', NULL, 5);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (4, 'Sri Jayawardenapura Kotte', NULL, 5);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (5, 'Negombo', NULL, 7);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (6, 'Kandy', '20810', 11);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (7, 'Kalmunai', NULL, 1);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (8, 'Vavuniya', NULL, 25);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (9, 'Galle', NULL, 6);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (10, 'Trincomalee', NULL, 24);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (11, 'Batticaloa', NULL, 4);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (12, 'Jaffna', NULL, 9);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (13, 'Katunayake', NULL, 7);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (14, 'Dambulla', NULL, 16);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (15, 'Kolonnawa', NULL, 5);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (16, 'Anuradhapura', NULL, 2);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (17, 'Ratnapura', NULL, 23);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (18, 'Badulla', NULL, 3);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (19, 'Matara', NULL, 17);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (20, 'Puttalam', NULL, 22);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (21, 'Chavakacheri', NULL, 9);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (22, 'Kattankudy', NULL, 4);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (23, 'Matale', NULL, 16);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (24, 'Kalutara', NULL, 10);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (25, 'Mannar', NULL, 15);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (26, 'Panadura', NULL, 10);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (27, 'Beruwala', NULL, 10);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (28, 'Ja-Ela', NULL, 7);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (29, 'Point Pedro', NULL, 9);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (30, 'Kelaniya', NULL, 7);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (31, 'Peliyagoda', NULL, 7);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (32, 'Kurunegala', NULL, 14);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (33, 'Wattala', NULL, 7);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (34, 'Gampola', NULL, 11);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (35, 'Nuwara Eliya', NULL, 20);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (36, 'Valvettithurai', NULL, 9);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (37, 'Chilaw', NULL, 22);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (38, 'Eravur', NULL, 4);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (39, 'Avissawella', NULL, 5);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (40, 'Weligama', NULL, 17);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (41, 'Ambalangoda', NULL, 6);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (42, 'Ampara', NULL, 1);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (43, 'Kegalle', NULL, 12);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (44, 'Hatton', NULL, 20);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (45, 'Nawalapitiya', NULL, 11);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (46, 'Balangoda', NULL, 23);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (47, 'Hambantota', NULL, 8);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (48, 'Tangalle', NULL, 8);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (49, 'Moneragala', NULL, 18);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (50, 'Gampaha', NULL, 7);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (51, 'Horana', NULL, 10);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (52, 'Wattegama', '20810', 18);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (53, 'Minuwangoda', NULL, 7);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (54, 'Bandarawela', NULL, 3);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (55, 'Kuliyapitiya', NULL, 14);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (56, 'Haputale', NULL, 3);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (57, 'Talawakele', NULL, 20);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (58, 'Harispattuwa', NULL, 11);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (59, 'Kadugannawa', NULL, 11);
INSERT INTO `city` (`id`, `name`, `postal_code`, `district_id`) VALUES (60, 'Embilipitiya', NULL, 23);
COMMIT;

-- ----------------------------
-- Table structure for colour
-- ----------------------------
DROP TABLE IF EXISTS `colour`;
CREATE TABLE `colour` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of colour
-- ----------------------------
BEGIN;
INSERT INTO `colour` (`id`, `name`) VALUES (1, 'Black');
INSERT INTO `colour` (`id`, `name`) VALUES (2, 'Blue');
INSERT INTO `colour` (`id`, `name`) VALUES (3, 'White');
INSERT INTO `colour` (`id`, `name`) VALUES (4, 'Gold');
INSERT INTO `colour` (`id`, `name`) VALUES (5, 'Space Gray');
INSERT INTO `colour` (`id`, `name`) VALUES (6, 'Red');
INSERT INTO `colour` (`id`, `name`) VALUES (10, 'Used');
COMMIT;

-- ----------------------------
-- Table structure for condition
-- ----------------------------
DROP TABLE IF EXISTS `condition`;
CREATE TABLE `condition` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of condition
-- ----------------------------
BEGIN;
INSERT INTO `condition` (`id`, `name`) VALUES (1, 'Brand New');
INSERT INTO `condition` (`id`, `name`) VALUES (2, 'Used');
COMMIT;

-- ----------------------------
-- Table structure for district
-- ----------------------------
DROP TABLE IF EXISTS `district`;
CREATE TABLE `district` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `province_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_district_province` (`province_id`),
  CONSTRAINT `FK_district_province` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of district
-- ----------------------------
BEGIN;
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES (1, 'Ampara', 2);
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES (2, 'Anuradhapura', 3);
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES (3, 'Badulla', 8);
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES (4, 'Batticaloa', 2);
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES (5, 'Colombo', 8);
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES (6, 'Galle', 7);
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES (7, 'Gampaha', 9);
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES (8, 'Hambantota', 7);
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES (9, 'Jaffna', 4);
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES (10, 'Kalutara', 9);
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES (11, 'Kandy', 1);
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES (12, 'Kegalle', 6);
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES (13, 'Kilinochchi', 4);
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES (14, 'Kurunegala', 5);
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES (15, 'Mannar', 4);
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES (16, 'Matale', 1);
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES (17, 'Matara', 7);
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES (18, 'Moneragala', 8);
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES (19, 'Mullaitivu', 4);
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES (20, 'Nuwara Eliya', 1);
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES (21, 'Polonnaruwa', 3);
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES (22, 'Puttalam', 5);
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES (23, 'Ratnapura', 6);
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES (24, 'Trincomalee', 2);
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES (25, 'Vavuniya', 4);
COMMIT;

-- ----------------------------
-- Table structure for feedback
-- ----------------------------
DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  `feed` text NOT NULL,
  `date` datetime NOT NULL,
  `type` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_id_idx` (`product_id`),
  KEY `fk_user_email` (`user_email`),
  CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_user_email` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of feedback
-- ----------------------------
BEGIN;
INSERT INTO `feedback` (`id`, `user_email`, `product_id`, `feed`, `date`, `type`) VALUES (1, 'poojithairosha9311@gmail.com', 19, 'abc', '2022-07-13 08:59:46', 2);
INSERT INTO `feedback` (`id`, `user_email`, `product_id`, `feed`, `date`, `type`) VALUES (2, 'poojithairosha9311@gmail.com', 19, 'Hello World', '2022-07-13 09:30:56', 1);
INSERT INTO `feedback` (`id`, `user_email`, `product_id`, `feed`, `date`, `type`) VALUES (3, 'poojithairosha9311@gmail.com', 19, 'Very Bad', '2022-07-13 09:34:09', 3);
INSERT INTO `feedback` (`id`, `user_email`, `product_id`, `feed`, `date`, `type`) VALUES (4, 'poojithairosha9311@gmail.com', 19, 'Ahasdad', '2022-07-13 09:38:35', 1);
COMMIT;

-- ----------------------------
-- Table structure for gender
-- ----------------------------
DROP TABLE IF EXISTS `gender`;
CREATE TABLE `gender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of gender
-- ----------------------------
BEGIN;
INSERT INTO `gender` (`id`, `name`) VALUES (1, 'Male');
INSERT INTO `gender` (`id`, `name`) VALUES (2, 'Female');
COMMIT;

-- ----------------------------
-- Table structure for images
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `product_id` int DEFAULT NULL,
  PRIMARY KEY (`code`),
  KEY `FK_images_product` (`product_id`),
  CONSTRAINT `FK_images_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of images
-- ----------------------------
BEGIN;
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//6229de63c7c59132.jpeg', 1);
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//6229de63d3fa413mini1.png', 1);
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//6229aa9321bbf13promax4.jpeg', 2);
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//6229aa933456e13poromax.png', 2);
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//6229abc66cbdas21ultra1.jpg', 3);
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//6229ad03adff1sonyxperiaproi1.png', 4);
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//6229addf6f627ipadpro2021.jfif', 5);
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//6229ae5bf2b59ipadmini2021.jfif', 6);
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//6229aef03ab9fsamsung tab s7+ 5G.jpg', 7);
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//6229dad652ef0galaxy tab 27 fe.png', 8);
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//6229dbcb6b222msi prestige 15 2.png', 9);
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//6229dbcb8de4fmsi prestige 15.png', 9);
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//6229dc6bcd0dbdell xps 15 1.png', 10);
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//6229ddfd72bab81Cm1VMdxrL._AC_SS450_.jpg', 11);
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//6229ddfd93ca4asus rog strix 15.png', 11);
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//6229df0e799ffasus tug gaming f15.png', 12);
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//6229df89b181dmacbook pro m1 2.png', 13);
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//6229df89bdb56macbook pro m1 1.jpeg', 13);
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//6229e149b99c1air.jpg', 14);
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//6229e2deb9761predator.jpg', 16);
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//6229e3bc24a91mavic3.jpg', 17);
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//6229e3bc63aadmavic1.jpg', 17);
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//6229e3bc6bd9bmavic2.jpg', 17);
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//6229e441699deair 2s 3.jpg', 18);
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//6229e44171c1fair 2s 2.jpg', 18);
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//6229e44179e57air 2s1.jpg', 18);
INSERT INTO `images` (`code`, `product_id`) VALUES ('resources//products//622fe3bb0334b61D64DKlhUL.jpg', 19);
COMMIT;

-- ----------------------------
-- Table structure for invoice
-- ----------------------------
DROP TABLE IF EXISTS `invoice`;
CREATE TABLE `invoice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `total` double DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_email` (`user_email`),
  CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of invoice
-- ----------------------------
BEGIN;
INSERT INTO `invoice` (`id`, `order_id`, `product_id`, `user_email`, `date`, `total`, `qty`, `status`) VALUES (1, '001', 1, 'poojithairosha9311@gmail.com', '2022-05-01 10:10:00', 3000, 2, 2);
INSERT INTO `invoice` (`id`, `order_id`, `product_id`, `user_email`, `date`, `total`, `qty`, `status`) VALUES (2, '002', 4, 'inuka@gmail.com', '2022-06-05 13:50:00', 25000, 5, 4);
INSERT INTO `invoice` (`id`, `order_id`, `product_id`, `user_email`, `date`, `total`, `qty`, `status`) VALUES (3, '003', 5, 'amal@gmail.com', '2022-06-11 13:50:00', 25000, 3, 4);
INSERT INTO `invoice` (`id`, `order_id`, `product_id`, `user_email`, `date`, `total`, `qty`, `status`) VALUES (4, '004', 1, 'inuka@gmail.com', '2022-06-09 08:30:00', 50000, 1, 4);
INSERT INTO `invoice` (`id`, `order_id`, `product_id`, `user_email`, `date`, `total`, `qty`, `status`) VALUES (5, '62d576c01ae69', 19, 'poojithairosha9311@gmail.com', '2022-07-18 20:35:36', 250000, 1, 0);
INSERT INTO `invoice` (`id`, `order_id`, `product_id`, `user_email`, `date`, `total`, `qty`, `status`) VALUES (6, '62d5813e6dab2', 4, 'poojithairosha9311@gmail.com', '2022-07-18 21:20:22', 377100, 1, 0);
COMMIT;

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `from` varchar(100) DEFAULT NULL,
  `to` varchar(100) DEFAULT NULL,
  `content` text,
  `date_time` datetime DEFAULT NULL,
  `status` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_message_user` (`from`),
  KEY `fk_message_user_2` (`to`),
  CONSTRAINT `fk_message_user` FOREIGN KEY (`from`) REFERENCES `user` (`email`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_message_user_2` FOREIGN KEY (`to`) REFERENCES `user` (`email`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of message
-- ----------------------------
BEGIN;
INSERT INTO `message` (`id`, `from`, `to`, `content`, `date_time`, `status`) VALUES (1, 'inuka@gmail.com', 'poojithairosha9311@gmail.com', 'Hello! How are you ?', '2022-05-01 19:58:50', 1);
INSERT INTO `message` (`id`, `from`, `to`, `content`, `date_time`, `status`) VALUES (2, 'poojithairosha9311@gmail.com', 'inuka@gmail.com', 'Hello', '2022-07-09 09:04:32', 1);
INSERT INTO `message` (`id`, `from`, `to`, `content`, `date_time`, `status`) VALUES (6, 'poojithairosha9311@gmail.com', 'inuka@gmail.com', 'abc', '2022-07-09 09:29:29', 0);
INSERT INTO `message` (`id`, `from`, `to`, `content`, `date_time`, `status`) VALUES (7, 'poojithairosha9311@gmail.com', 'inuka@gmail.com', 'Hi', '2022-07-09 09:36:18', 0);
INSERT INTO `message` (`id`, `from`, `to`, `content`, `date_time`, `status`) VALUES (8, 'poojithairosha9311@gmail.com', 'inuka@gmail.com', 'I will inform you ', '2022-07-09 09:38:48', 0);
COMMIT;

-- ----------------------------
-- Table structure for model
-- ----------------------------
DROP TABLE IF EXISTS `model`;
CREATE TABLE `model` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of model
-- ----------------------------
BEGIN;
INSERT INTO `model` (`id`, `name`) VALUES (1, 'Iphone 13 Mini');
INSERT INTO `model` (`id`, `name`) VALUES (2, 'Iphone 13');
INSERT INTO `model` (`id`, `name`) VALUES (3, 'Iphone 13 Pro');
INSERT INTO `model` (`id`, `name`) VALUES (4, 'Iphone 13 Pro Max');
INSERT INTO `model` (`id`, `name`) VALUES (5, 'Iphone 12 Mini');
INSERT INTO `model` (`id`, `name`) VALUES (6, 'Iphone 12');
INSERT INTO `model` (`id`, `name`) VALUES (7, 'Iphone 12 Pro');
INSERT INTO `model` (`id`, `name`) VALUES (8, 'Iphone 12 Pro Max');
INSERT INTO `model` (`id`, `name`) VALUES (9, 'Iphone 11');
INSERT INTO `model` (`id`, `name`) VALUES (10, 'Iphone 11 Pro');
INSERT INTO `model` (`id`, `name`) VALUES (11, 'Iphone 11 Pro Max');
INSERT INTO `model` (`id`, `name`) VALUES (12, 'S20');
INSERT INTO `model` (`id`, `name`) VALUES (13, 'S20+');
INSERT INTO `model` (`id`, `name`) VALUES (14, 'S20 Ultra 5G');
INSERT INTO `model` (`id`, `name`) VALUES (15, 'S21');
INSERT INTO `model` (`id`, `name`) VALUES (16, 'S21+');
INSERT INTO `model` (`id`, `name`) VALUES (17, 'S21 Ultra 5G');
INSERT INTO `model` (`id`, `name`) VALUES (18, 'Xperia Pro-I');
INSERT INTO `model` (`id`, `name`) VALUES (19, 'Ipad Pro 2021');
INSERT INTO `model` (`id`, `name`) VALUES (20, 'Ipad Mini 2021');
INSERT INTO `model` (`id`, `name`) VALUES (21, 'Galaxy Tab S7+');
INSERT INTO `model` (`id`, `name`) VALUES (22, 'Galaxy Tab S7 FE');
INSERT INTO `model` (`id`, `name`) VALUES (23, 'Prestige 15');
INSERT INTO `model` (`id`, `name`) VALUES (24, 'XPS 15');
INSERT INTO `model` (`id`, `name`) VALUES (25, 'Rog Strix G15');
INSERT INTO `model` (`id`, `name`) VALUES (26, 'Tuf Gaming F15');
INSERT INTO `model` (`id`, `name`) VALUES (27, 'MacBiook Pro M1');
INSERT INTO `model` (`id`, `name`) VALUES (28, 'MacBook Pro 16\' M1 Pro');
INSERT INTO `model` (`id`, `name`) VALUES (29, 'MacBook Air M1');
INSERT INTO `model` (`id`, `name`) VALUES (30, 'Predator Helios 300');
INSERT INTO `model` (`id`, `name`) VALUES (31, 'Mavic 3');
INSERT INTO `model` (`id`, `name`) VALUES (32, 'Air S2');
INSERT INTO `model` (`id`, `name`) VALUES (33, 'Inspire 2');
COMMIT;

-- ----------------------------
-- Table structure for model_has_brand
-- ----------------------------
DROP TABLE IF EXISTS `model_has_brand`;
CREATE TABLE `model_has_brand` (
  `id` int NOT NULL AUTO_INCREMENT,
  `brand_id` int NOT NULL DEFAULT '0',
  `model_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_model_has_brand_brand` (`brand_id`),
  KEY `FK_model_has_brand_model` (`model_id`),
  CONSTRAINT `FK_model_has_brand_brand` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  CONSTRAINT `FK_model_has_brand_model` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of model_has_brand
-- ----------------------------
BEGIN;
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (1, 1, 1);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (2, 1, 2);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (3, 1, 3);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (4, 1, 4);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (5, 1, 5);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (6, 1, 6);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (7, 1, 7);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (8, 1, 8);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (9, 1, 9);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (10, 1, 10);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (11, 1, 11);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (12, 2, 12);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (13, 2, 13);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (14, 2, 14);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (15, 2, 15);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (16, 2, 16);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (17, 2, 17);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (18, 3, 18);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (19, 1, 19);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (20, 1, 20);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (21, 2, 21);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (22, 2, 22);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (23, 6, 23);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (24, 7, 24);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (25, 8, 25);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (26, 8, 26);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (27, 1, 27);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (28, 1, 28);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (29, 1, 29);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (30, 9, 30);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (31, 10, 31);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (32, 10, 32);
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES (33, 10, 33);
COMMIT;

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` int NOT NULL,
  `model_has_brand` int NOT NULL,
  `colour_id` int NOT NULL,
  `price` double NOT NULL,
  `qty` int NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `condition_id` int NOT NULL,
  `status_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `date_time_added` datetime NOT NULL,
  `delivery_fee_colombo` double NOT NULL,
  `delivery_fee_other` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_product_category` (`category`),
  KEY `FK_product_model_has_brand` (`model_has_brand`),
  KEY `FK_product_colour` (`colour_id`) USING BTREE,
  KEY `FK_product_condition` (`condition_id`),
  KEY `FK_product_status` (`status_id`),
  KEY `FK_product_user` (`user_email`),
  CONSTRAINT `FK_product_category` FOREIGN KEY (`category`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_product_colour` FOREIGN KEY (`colour_id`) REFERENCES `colour` (`id`),
  CONSTRAINT `FK_product_condition` FOREIGN KEY (`condition_id`) REFERENCES `condition` (`id`),
  CONSTRAINT `FK_product_model_has_brand` FOREIGN KEY (`model_has_brand`) REFERENCES `model_has_brand` (`id`),
  CONSTRAINT `FK_product_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `FK_product_user` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of product
-- ----------------------------
BEGIN;
INSERT INTO `product` (`id`, `category`, `model_has_brand`, `colour_id`, `price`, `qty`, `description`, `title`, `condition_id`, `status_id`, `user_email`, `date_time_added`, `delivery_fee_colombo`, `delivery_fee_other`) VALUES (1, 1, 1, 1, 450000, 5, 'Apple Iphone 13 Mini - 128GB Midnight Black', 'Apple Iphone 13 Mini', 1, 1, 'poojithairosha9311@gmail.com', '2022-03-10 11:58:09', 250, 450);
INSERT INTO `product` (`id`, `category`, `model_has_brand`, `colour_id`, `price`, `qty`, `description`, `title`, `condition_id`, `status_id`, `user_email`, `date_time_added`, `delivery_fee_colombo`, `delivery_fee_other`) VALUES (2, 1, 4, 1, 450000, 25, 'Apple Iphone 13 Pro Max - 512GB Blue', 'Apple Iphone 13 Pro Max', 1, 2, 'poojithairosha9311@gmail.com', '2022-03-10 12:56:04', 250, 450);
INSERT INTO `product` (`id`, `category`, `model_has_brand`, `colour_id`, `price`, `qty`, `description`, `title`, `condition_id`, `status_id`, `user_email`, `date_time_added`, `delivery_fee_colombo`, `delivery_fee_other`) VALUES (3, 1, 17, 1, 275000, 10, 'Samsung S21 Ultra 5G - 128GB - White', 'Samsung S21 Ultra 5G', 1, 1, 'poojithairosha9311@gmail.com', '2022-03-10 13:09:59', 250, 450);
INSERT INTO `product` (`id`, `category`, `model_has_brand`, `colour_id`, `price`, `qty`, `description`, `title`, `condition_id`, `status_id`, `user_email`, `date_time_added`, `delivery_fee_colombo`, `delivery_fee_other`) VALUES (4, 1, 18, 1, 377100, 5, 'Sony Xperia Pro-I', 'Sony Xperia Pro-I', 1, 1, 'poojithairosha9311@gmail.com', '2022-03-10 13:17:15', 250, 450);
INSERT INTO `product` (`id`, `category`, `model_has_brand`, `colour_id`, `price`, `qty`, `description`, `title`, `condition_id`, `status_id`, `user_email`, `date_time_added`, `delivery_fee_colombo`, `delivery_fee_other`) VALUES (5, 2, 19, 1, 275000, 5, 'Apple Ipad Pro 2021', 'Apple Ipad Pro 2021', 1, 1, 'poojithairosha9311@gmail.com', '2022-03-10 13:20:55', 250, 450);
INSERT INTO `product` (`id`, `category`, `model_has_brand`, `colour_id`, `price`, `qty`, `description`, `title`, `condition_id`, `status_id`, `user_email`, `date_time_added`, `delivery_fee_colombo`, `delivery_fee_other`) VALUES (6, 2, 20, 1, 235000, 10, 'Apple Ipad Mini 2021', 'Apple Ipad Mini 2021', 1, 1, 'poojithairosha9311@gmail.com', '2022-03-10 13:22:59', 250, 450);
INSERT INTO `product` (`id`, `category`, `model_has_brand`, `colour_id`, `price`, `qty`, `description`, `title`, `condition_id`, `status_id`, `user_email`, `date_time_added`, `delivery_fee_colombo`, `delivery_fee_other`) VALUES (7, 2, 21, 1, 194900, 3, 'Samsung Galaxy Tab S7+ 5G', 'Samsung Galaxy Tab S7+ 5G', 1, 1, 'poojithairosha9311@gmail.com', '2022-03-10 13:25:28', 250, 450);
INSERT INTO `product` (`id`, `category`, `model_has_brand`, `colour_id`, `price`, `qty`, `description`, `title`, `condition_id`, `status_id`, `user_email`, `date_time_added`, `delivery_fee_colombo`, `delivery_fee_other`) VALUES (8, 2, 22, 1, 122900, 15, 'Samsung Galaxy Tab S7 FE', 'Samsung Galaxy Tab S7 FE', 1, 1, 'poojithairosha9311@gmail.com', '2022-03-10 16:32:46', 250, 450);
INSERT INTO `product` (`id`, `category`, `model_has_brand`, `colour_id`, `price`, `qty`, `description`, `title`, `condition_id`, `status_id`, `user_email`, `date_time_added`, `delivery_fee_colombo`, `delivery_fee_other`) VALUES (9, 3, 23, 1, 350000, 20, 'MSI Prestige 15 8GB 1TB', 'MSI Prestige 15', 1, 1, 'poojithairosha9311@gmail.com', '2022-03-10 16:36:51', 250, 450);
INSERT INTO `product` (`id`, `category`, `model_has_brand`, `colour_id`, `price`, `qty`, `description`, `title`, `condition_id`, `status_id`, `user_email`, `date_time_added`, `delivery_fee_colombo`, `delivery_fee_other`) VALUES (10, 3, 24, 1, 365000, 50, 'Dell XPS 15', 'Dell XPS 15', 1, 1, 'poojithairosha9311@gmail.com', '2022-03-10 16:39:31', 250, 450);
INSERT INTO `product` (`id`, `category`, `model_has_brand`, `colour_id`, `price`, `qty`, `description`, `title`, `condition_id`, `status_id`, `user_email`, `date_time_added`, `delivery_fee_colombo`, `delivery_fee_other`) VALUES (11, 3, 25, 1, 375000, 5, 'Asus Rog Strix G15', 'Asus Rog Strix G15', 1, 1, 'poojithairosha9311@gmail.com', '2022-03-10 16:42:14', 250, 450);
INSERT INTO `product` (`id`, `category`, `model_has_brand`, `colour_id`, `price`, `qty`, `description`, `title`, `condition_id`, `status_id`, `user_email`, `date_time_added`, `delivery_fee_colombo`, `delivery_fee_other`) VALUES (12, 3, 26, 1, 205000, 3, 'Aus Tuf Gaming F15', 'Aus Tuf Gaming F15', 1, 1, 'poojithairosha9311@gmail.com', '2022-03-10 16:50:46', 250, 450);
INSERT INTO `product` (`id`, `category`, `model_has_brand`, `colour_id`, `price`, `qty`, `description`, `title`, `condition_id`, `status_id`, `user_email`, `date_time_added`, `delivery_fee_colombo`, `delivery_fee_other`) VALUES (13, 3, 27, 1, 310000, 35, 'Apple MacBook Pro M1', 'Apple MacBook Pro M1', 1, 2, 'poojithairosha9311@gmail.com', '2022-03-10 16:52:49', 250, 450);
INSERT INTO `product` (`id`, `category`, `model_has_brand`, `colour_id`, `price`, `qty`, `description`, `title`, `condition_id`, `status_id`, `user_email`, `date_time_added`, `delivery_fee_colombo`, `delivery_fee_other`) VALUES (14, 3, 29, 1, 275000, 5, 'Apple MacBook Air M1', 'MacBook Air M1', 1, 1, 'poojithairosha9311@gmail.com', '2022-03-10 17:00:17', 250, 450);
INSERT INTO `product` (`id`, `category`, `model_has_brand`, `colour_id`, `price`, `qty`, `description`, `title`, `condition_id`, `status_id`, `user_email`, `date_time_added`, `delivery_fee_colombo`, `delivery_fee_other`) VALUES (16, 3, 30, 1, 289000, 10, 'Predator Helios 300', 'Predator Helios 300', 1, 1, 'poojithairosha9311@gmail.com', '2022-03-10 17:07:02', 250, 450);
INSERT INTO `product` (`id`, `category`, `model_has_brand`, `colour_id`, `price`, `qty`, `description`, `title`, `condition_id`, `status_id`, `user_email`, `date_time_added`, `delivery_fee_colombo`, `delivery_fee_other`) VALUES (17, 4, 31, 1, 484900, 5, 'DJI Mavic 3\r\n4/3 CMOS Hasselblad Camera\r\n46 Minutes of Flight Time \r\nOmnidirectional Obstacle Sensing\r\n15km Max Transmission Range\r\nAdvanced Return to Home', 'DJI Mavic 3', 1, 1, 'poojithairosha9311@gmail.com', '2022-03-10 17:10:44', 250, 450);
INSERT INTO `product` (`id`, `category`, `model_has_brand`, `colour_id`, `price`, `qty`, `description`, `title`, `condition_id`, `status_id`, `user_email`, `date_time_added`, `delivery_fee_colombo`, `delivery_fee_other`) VALUES (18, 4, 32, 1, 225000, 3, 'DJI Air S23\r\n1-Inch CMOS Sensor\r\n5.4K Video\r\nMasterShots\r\n12km 1080p Transmission \r\nObstacle Sensing in 4 Directions', 'DJI Air S2', 1, 1, 'poojithairosha9311@gmail.com', '2022-03-10 17:12:57', 250, 450);
INSERT INTO `product` (`id`, `category`, `model_has_brand`, `colour_id`, `price`, `qty`, `description`, `title`, `condition_id`, `status_id`, `user_email`, `date_time_added`, `delivery_fee_colombo`, `delivery_fee_other`) VALUES (19, 1, 1, 3, 250000, 25, 'Apple IPhone 13 Mini - White - 128GB', 'Apple Iphone 13 mini', 1, 1, 'poojithairosha9311@gmail.com', '2022-03-15 06:21:47', 250, 450);
COMMIT;

-- ----------------------------
-- Table structure for profile_img
-- ----------------------------
DROP TABLE IF EXISTS `profile_img`;
CREATE TABLE `profile_img` (
  `code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`code`),
  KEY `FK_profile_img_user` (`user_email`),
  CONSTRAINT `FK_profile_img_user` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of profile_img
-- ----------------------------
BEGIN;
INSERT INTO `profile_img` (`code`, `user_email`) VALUES ('resources/profiles/62b321d021b9e.jpeg', 'amal@gmail.com');
INSERT INTO `profile_img` (`code`, `user_email`) VALUES ('resources/profiles/6229da2a06f41.png', 'poojithairosha9311@gmail.com');
COMMIT;

-- ----------------------------
-- Table structure for province
-- ----------------------------
DROP TABLE IF EXISTS `province`;
CREATE TABLE `province` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of province
-- ----------------------------
BEGIN;
INSERT INTO `province` (`id`, `name`) VALUES (1, 'Central');
INSERT INTO `province` (`id`, `name`) VALUES (2, 'Eastern');
INSERT INTO `province` (`id`, `name`) VALUES (3, 'North Central');
INSERT INTO `province` (`id`, `name`) VALUES (4, 'Northern');
INSERT INTO `province` (`id`, `name`) VALUES (5, 'North Western');
INSERT INTO `province` (`id`, `name`) VALUES (6, 'Sabaragamuwa');
INSERT INTO `province` (`id`, `name`) VALUES (7, 'Southern');
INSERT INTO `province` (`id`, `name`) VALUES (8, 'Uva');
INSERT INTO `province` (`id`, `name`) VALUES (9, 'Western');
COMMIT;

-- ----------------------------
-- Table structure for recent
-- ----------------------------
DROP TABLE IF EXISTS `recent`;
CREATE TABLE `recent` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_email` (`user_email`),
  CONSTRAINT `recent_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `recent_ibfk_2` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of recent
-- ----------------------------
BEGIN;
INSERT INTO `recent` (`id`, `product_id`, `user_email`) VALUES (1, 8, 'poojithairosha9311@gmail.com');
INSERT INTO `recent` (`id`, `product_id`, `user_email`) VALUES (3, 2, 'poojithairosha9311@gmail.com');
INSERT INTO `recent` (`id`, `product_id`, `user_email`) VALUES (4, 19, 'poojithairosha9311@gmail.com');
INSERT INTO `recent` (`id`, `product_id`, `user_email`) VALUES (5, 6, 'poojithairosha9311@gmail.com');
INSERT INTO `recent` (`id`, `product_id`, `user_email`) VALUES (6, 13, 'poojithairosha9311@gmail.com');
COMMIT;

-- ----------------------------
-- Table structure for status
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of status
-- ----------------------------
BEGIN;
INSERT INTO `status` (`id`, `name`) VALUES (1, 'active');
INSERT INTO `status` (`id`, `name`) VALUES (2, 'deactive');
COMMIT;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `gender` int NOT NULL,
  `register_date` datetime NOT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  `status_id` int DEFAULT NULL,
  PRIMARY KEY (`email`),
  KEY `FK_user_gender` (`gender`),
  KEY `FK_user_status_id` (`status_id`),
  CONSTRAINT `FK_user_gender` FOREIGN KEY (`gender`) REFERENCES `gender` (`id`),
  CONSTRAINT `FK_user_status_id` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
BEGIN;
INSERT INTO `user` (`email`, `fname`, `lname`, `password`, `mobile`, `gender`, `register_date`, `verification_code`, `status_id`) VALUES ('amal@gmail.com', 'Amal', 'Silva', 'amal123', '0752347890', 1, '2022-06-01 20:13:42', NULL, 2);
INSERT INTO `user` (`email`, `fname`, `lname`, `password`, `mobile`, `gender`, `register_date`, `verification_code`, `status_id`) VALUES ('inuka@gmail.com', 'Inuka', 'Shashen', 'Inu123', '0705054520', 1, '2022-06-01 19:57:35', NULL, 2);
INSERT INTO `user` (`email`, `fname`, `lname`, `password`, `mobile`, `gender`, `register_date`, `verification_code`, `status_id`) VALUES ('poojithairosha9311@gmail.com', 'Poojitha', 'Irosha', '123', '0762873649', 1, '2021-12-06 23:38:05', '62979debe6a70', 1);
COMMIT;

-- ----------------------------
-- Table structure for user_has_address
-- ----------------------------
DROP TABLE IF EXISTS `user_has_address`;
CREATE TABLE `user_has_address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `line1` text NOT NULL,
  `line2` text NOT NULL,
  `city_id` int NOT NULL,
  `user_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user_has_address_city` (`city_id`),
  KEY `FK_user_has_address_user` (`user_email`),
  CONSTRAINT `FK_user_has_address_city` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  CONSTRAINT `FK_user_has_address_user` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of user_has_address
-- ----------------------------
BEGIN;
INSERT INTO `user_has_address` (`id`, `line1`, `line2`, `city_id`, `user_email`) VALUES (1, 'No 108, Panvila road', 'Wattegama', 6, 'poojithairosha9311@gmail.com');
COMMIT;

-- ----------------------------
-- Table structure for watchlist
-- ----------------------------
DROP TABLE IF EXISTS `watchlist`;
CREATE TABLE `watchlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_email` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id_idx` (`product_id`),
  KEY `user_email_idx` (`user_email`),
  CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `user_email` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of watchlist
-- ----------------------------
BEGIN;
INSERT INTO `watchlist` (`id`, `product_id`, `user_email`) VALUES (4, 17, 'poojithairosha9311@gmail.com');
INSERT INTO `watchlist` (`id`, `product_id`, `user_email`) VALUES (8, 14, 'poojithairosha9311@gmail.com');
INSERT INTO `watchlist` (`id`, `product_id`, `user_email`) VALUES (13, 19, 'poojithairosha9311@gmail.com');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
