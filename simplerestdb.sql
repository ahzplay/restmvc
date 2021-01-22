/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100138
 Source Host           : localhost:3306
 Source Schema         : simplerestdb

 Target Server Type    : MySQL
 Target Server Version : 100138
 File Encoding         : 65001

 Date: 23/01/2021 03:16:08
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for jurusan
-- ----------------------------
DROP TABLE IF EXISTS `jurusan`;
CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_jurusan` varchar(10) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jurusan
-- ----------------------------
BEGIN;
INSERT INTO `jurusan` VALUES (1, '11', 'Akuntansi');
INSERT INTO `jurusan` VALUES (2, '12', 'Mekatronika');
INSERT INTO `jurusan` VALUES (3, '13', 'Komputer');
COMMIT;

-- ----------------------------
-- Table structure for mahasiswa
-- ----------------------------
DROP TABLE IF EXISTS `mahasiswa`;
CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(25) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jurusan` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jurusan` (`jurusan`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mahasiswa
-- ----------------------------
BEGIN;
INSERT INTO `mahasiswa` VALUES (1, '1001', 'Ari', '1992-10-10', 12);
INSERT INTO `mahasiswa` VALUES (2, '1002', 'Azhar', '1992-01-12', 11);
INSERT INTO `mahasiswa` VALUES (3, '1003', 'Eden', '1992-04-28', 11);
INSERT INTO `mahasiswa` VALUES (4, '1004', 'Hazard', '1992-12-17', 13);
INSERT INTO `mahasiswa` VALUES (9, '1005', 'eden hazard', '1992-12-01', 12);
COMMIT;

-- ----------------------------
-- Table structure for tugas
-- ----------------------------
DROP TABLE IF EXISTS `tugas`;
CREATE TABLE `tugas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tugas_id` varchar(20) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`tugas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tugas
-- ----------------------------
BEGIN;
INSERT INTO `tugas` VALUES (1, '121001210122001', 'asdfasdf');
INSERT INTO `tugas` VALUES (2, '121001210122002', 'asdfasdf');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
