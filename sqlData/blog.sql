/*
MySQL Data Transfer
Source Host: localhost
Source Database: blog
Target Host: localhost
Target Database: blog
Date: 2015/1/27 1:25:04
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
INSERT INTO `article` VALUES ('7', '个别不守规矩的家伙', '“老公，你说这个世界上有没有一种男人，酒吧找女人不是为了上她，而是想单纯聊天的呢”“肯定有！”看着老婆赞许的目光，我接着说：“世上男人千千万，总有极个别不守规矩的家伙这么操蛋！”', 'Administrator', '2015-01-26 20:53:31', '2015-01-26 20:53:31', '2');
INSERT INTO `article` VALUES ('8', '妹纸看病', '有一妹纸感觉胸部不适，找医院检查，医生说：只是小的问题。\r\n妹纸听了伤心大哭，医生安慰她说：别哭了没什么大不了的。\r\n妹纸听了开心的笑了。。。', 'Administrator', '2015-01-26 20:54:26', '2015-01-26 20:54:26', '2');
INSERT INTO `article` VALUES ('9', '第一次当人', '女：“你怎么长成这个样子，丑死了？！”\r\n男：“这不是第一次当人，没经验嘛！”', 'Administrator', '2015-01-26 20:55:15', '2015-01-26 20:55:15', '2');
INSERT INTO `article` VALUES ('10', '火候太大了', '下班回家看见女友失落的坐在餐桌前，于是问她怎么了，她说：“本来想尝试给你做顿饭，结果火候太大了。”\r\n“菜烧坏了？”\r\n“厨房烧坏了。”', 'Administrator', '2015-01-26 20:56:45', '2015-01-26 20:56:45', '2');
INSERT INTO `article` VALUES ('11', '我命硬', '昨晚和老公看电视，老公说电视里的女演员一脸克夫相，我贱贱的凑过脸问他：“那我呢？我是不是天生旺夫相？”\r\n老公瞟了瞟，说：“遇到你之后，只能说我命硬，，，”', 'Administrator', '2015-01-27 01:14:02', '2015-01-27 01:14:02', '2');
INSERT INTO `user` VALUES ('2', 'Administrator', 'e10adc3949ba59abbe56e057f20f883e', 'lxd19850415@aliyun.com');
