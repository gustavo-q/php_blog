/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 50728
 Source Host           : localhost:3306
 Source Schema         : tp_blog

 Target Server Type    : MySQL
 Target Server Version : 50728
 File Encoding         : 65001

 Date: 10/01/2020 22:26:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tp_admin
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin`;
CREATE TABLE `tp_admin`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nickname` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` enum('1','0') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `is_super` enum('1','0') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) NULL DEFAULT NULL COMMENT '软连接',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 32 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tp_article
-- ----------------------------
DROP TABLE IF EXISTS `tp_article`;
CREATE TABLE `tp_article`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `desc` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '概要',
  `tags` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_top` enum('1','0') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '0是未推荐，1是推荐',
  `cate_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) NULL DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tp_cate
-- ----------------------------
DROP TABLE IF EXISTS `tp_cate`;
CREATE TABLE `tp_cate`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `catename` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sort` int(255) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tp_comment
-- ----------------------------
DROP TABLE IF EXISTS `tp_comment`;
CREATE TABLE `tp_comment`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `article_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tp_member
-- ----------------------------
DROP TABLE IF EXISTS `tp_member`;
CREATE TABLE `tp_member`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nickname` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tp_system
-- ----------------------------
DROP TABLE IF EXISTS `tp_system`;
CREATE TABLE `tp_system`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `webname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `copyright` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
