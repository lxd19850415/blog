/*
MySQL Data Transfer
Source Host: localhost
Source Database: blog
Target Host: localhost
Target Database: blog
Date: 2015/1/26 20:31:42
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` tinyint(4) NOT NULL auto_increment,
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
  `email` char(32) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `article` VALUES ('1', '计算机技术', '计算机技术的内容非常广泛，可粗分为计算机系统技术、计算机器件技术、计算机部件技术和计算机组装技术等几个方面。计算机技术包括：运算方法的基本原理与运算器设计、指令系统、中央处理器(CPU)设计、流水线原理及其在CPU设计中的应用、存储体系、总线与输入输出。', 'liuxuandi', '2015-01-06 23:29:43', '2015-01-06 23:29:48', '1');
INSERT INTO `article` VALUES ('5', '1111', '2222', 'none', '2015-01-11 18:43:49', '2015-01-11 18:43:49', '0');
INSERT INTO `article` VALUES ('6', '33333', '44444', 'Administrator', '2015-01-12 23:19:36', '2015-01-12 23:19:36', '2');
INSERT INTO `user` VALUES ('2', 'Administrator', 'e10adc3949ba59abbe56e057f20f883e', 'lxd19850415@aliyun.com');
