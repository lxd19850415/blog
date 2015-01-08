/*
MySQL Data Transfer
Source Host: localhost
Source Database: blog
Target Host: localhost
Target Database: blog
Date: 2015/1/8 23:29:24
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` tinyint(4) NOT NULL,
  `title` varchar(256) NOT NULL,
  `content` longtext NOT NULL,
  `author` varchar(256) NOT NULL,
  `createtime` datetime NOT NULL,
  `updatetime` datetime NOT NULL,
  `type` char(32) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` tinyint(4) NOT NULL auto_increment,
  `account` char(32) NOT NULL,
  `password` char(32) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `article` VALUES ('1', '计算机技术', '计算机技术的内容非常广泛，可粗分为计算机系统技术、计算机器件技术、计算机部件技术和计算机组装技术等几个方面。计算机技术包括：运算方法的基本原理与运算器设计、指令系统、中央处理器(CPU)设计、流水线原理及其在CPU设计中的应用、存储体系、总线与输入输出。', 'liuxuandi', '2015-01-06 23:29:43', '2015-01-06 23:29:48', '');
