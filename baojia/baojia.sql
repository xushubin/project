/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : baojia

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-08-11 09:29:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for baojia
-- ----------------------------
DROP TABLE IF EXISTS `baojia`;
CREATE TABLE `baojia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clas` int(11) DEFAULT NULL COMMENT '专业ID',
  `profess` int(11) DEFAULT NULL COMMENT '科目ID',
  `product` int(11) DEFAULT NULL COMMENT '产品类型ID',
  `from` int(11) DEFAULT NULL COMMENT '形式ID',
  `dead` int(11) DEFAULT NULL COMMENT '时区ID',
  `dtime` datetime DEFAULT NULL COMMENT '时间',
  `task` varchar(255) DEFAULT NULL COMMENT '任务名称',
  `percent` int(11) DEFAULT NULL COMMENT '任务占比',
  `grade` int(11) DEFAULT NULL COMMENT '成绩要求',
  `assess` varchar(255) DEFAULT NULL COMMENT '描述评估',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baojia
-- ----------------------------
INSERT INTO `baojia` VALUES ('27', '3', '41', '2', '2', '3', '2017-04-18 13:59:00', '', '0', '2', 'a:9:{s:7:\"assess1\";s:1:\"4\";s:7:\"assess2\";s:2:\"0 \";s:7:\"assess3\";s:2:\"0 \";s:7:\"assess4\";s:2:\"0 \";s:7:\"assess5\";s:2:\"0 \";s:7:\"assess6\";s:2:\"0 \";s:7:\"assess7\";s:2:\"0 \";s:7:\"assess8\";s:2:\"0 \";s:7:\"assess9\";s:2:\"0 \";}');
INSERT INTO `baojia` VALUES ('2', '2', '37', '3', '2', '1', '2017-04-15 11:01:00', '', '0', '2', null);
INSERT INTO `baojia` VALUES ('6', '1', '7', '1', '1', '5', '2017-04-14 11:01:00', 'dd', '30', '1', 'a:9:{s:7:\"assess1\";s:1:\"4\";s:7:\"assess2\";s:2:\"10\";s:7:\"assess3\";s:1:\"0\";s:7:\"assess4\";s:1:\"0\";s:7:\"assess5\";s:1:\"0\";s:7:\"assess6\";s:1:\"0\";s:7:\"assess7\";s:1:\"0\";s:7:\"assess8\";s:1:\"0\";s:7:\"assess9\";s:1:\"0\";}');
INSERT INTO `baojia` VALUES ('8', '3', '39', '1', '3', '5', '2017-04-23 09:09:00', 'yy', '20', '2', 'a:9:{s:7:\"assess1\";s:0:\"\";s:7:\"assess2\";s:1:\"1\";s:7:\"assess3\";s:1:\"0\";s:7:\"assess4\";s:1:\"0\";s:7:\"assess5\";s:1:\"0\";s:7:\"assess6\";s:1:\"0\";s:7:\"assess7\";s:1:\"0\";s:7:\"assess8\";s:1:\"0\";s:7:\"assess9\";s:1:\"0\";}');
INSERT INTO `baojia` VALUES ('9', '3', '40', '2', '2', '3', '2017-04-14 11:11:00', '11', '111', '1', 'a:9:{s:7:\"assess1\";s:2:\"10\";s:7:\"assess2\";s:1:\"0\";s:7:\"assess3\";s:1:\"0\";s:7:\"assess4\";s:1:\"0\";s:7:\"assess5\";s:1:\"0\";s:7:\"assess6\";s:1:\"0\";s:7:\"assess7\";s:1:\"0\";s:7:\"assess8\";s:1:\"0\";s:7:\"assess9\";s:1:\"0\";}');
INSERT INTO `baojia` VALUES ('17', '2', '26', '1', '2', '1', '2017-04-15 11:01:00', 'ff', '0', '2', 'a:9:{s:7:\"assess1\";s:2:\"10\";s:7:\"assess2\";s:1:\"0\";s:7:\"assess3\";s:1:\"0\";s:7:\"assess4\";s:1:\"0\";s:7:\"assess5\";s:1:\"0\";s:7:\"assess6\";s:1:\"0\";s:7:\"assess7\";s:1:\"0\";s:7:\"assess8\";s:1:\"0\";s:7:\"assess9\";s:1:\"0\";}');
INSERT INTO `baojia` VALUES ('18', '1', '5', '1', '3', '2', '2017-04-15 22:02:00', '', '0', '2', null);
INSERT INTO `baojia` VALUES ('19', '1', '42', '1', '3', '3', '2017-04-15 04:44:00', '', '0', '2', 'a:9:{s:7:\"assess1\";s:2:\"10\";s:7:\"assess2\";s:2:\"0 \";s:7:\"assess3\";s:2:\"0 \";s:7:\"assess4\";s:2:\"0 \";s:7:\"assess5\";s:2:\"0 \";s:7:\"assess6\";s:2:\"0 \";s:7:\"assess7\";s:2:\"0 \";s:7:\"assess8\";s:2:\"0 \";s:7:\"assess9\";s:2:\"0 \";}');
INSERT INTO `baojia` VALUES ('20', '3', '41', '2', '4', '2', '2017-04-15 05:05:00', '', '0', '2', 'a:9:{s:7:\"assess1\";s:2:\"10\";s:7:\"assess2\";s:2:\"0 \";s:7:\"assess3\";s:2:\"0 \";s:7:\"assess4\";s:2:\"0 \";s:7:\"assess5\";s:2:\"0 \";s:7:\"assess6\";s:2:\"0 \";s:7:\"assess7\";s:2:\"0 \";s:7:\"assess8\";s:2:\"0 \";s:7:\"assess9\";s:2:\"0 \";}');
INSERT INTO `baojia` VALUES ('22', '3', '40', '3', '2', '3', '2017-04-15 17:07:00', '', '0', '2', null);
INSERT INTO `baojia` VALUES ('23', '2', '26', '3', '3', '3', '2017-04-15 11:01:00', '', '0', '2', 'a:9:{s:7:\"assess1\";s:2:\"10\";s:7:\"assess2\";s:2:\"0 \";s:7:\"assess3\";s:2:\"0 \";s:7:\"assess4\";s:2:\"0 \";s:7:\"assess5\";s:2:\"0 \";s:7:\"assess6\";s:2:\"0 \";s:7:\"assess7\";s:2:\"0 \";s:7:\"assess8\";s:2:\"0 \";s:7:\"assess9\";s:2:\"0 \";}');
INSERT INTO `baojia` VALUES ('24', '2', '27', '1', '2', '3', '2017-04-18 14:30:00', '', '0', '2', 'a:9:{s:7:\"assess1\";s:1:\"4\";s:7:\"assess2\";s:2:\"0 \";s:7:\"assess3\";s:2:\"0 \";s:7:\"assess4\";s:2:\"0 \";s:7:\"assess5\";s:2:\"0 \";s:7:\"assess6\";s:2:\"0 \";s:7:\"assess7\";s:2:\"0 \";s:7:\"assess8\";s:2:\"0 \";s:7:\"assess9\";s:2:\"0 \";}');
INSERT INTO `baojia` VALUES ('25', '2', '27', '1', '4', '1', '2017-04-18 14:40:00', '', '0', '2', 'a:9:{s:7:\"assess1\";s:1:\"4\";s:7:\"assess2\";s:2:\"0 \";s:7:\"assess3\";s:2:\"0 \";s:7:\"assess4\";s:2:\"0 \";s:7:\"assess5\";s:2:\"0 \";s:7:\"assess6\";s:2:\"0 \";s:7:\"assess7\";s:2:\"0 \";s:7:\"assess8\";s:2:\"0 \";s:7:\"assess9\";s:2:\"0 \";}');
INSERT INTO `baojia` VALUES ('26', '1', '1', '1', '1', '1', '2017-04-17 15:00:00', '', '0', '2', 'a:9:{s:7:\"assess1\";s:2:\"0 \";s:7:\"assess2\";s:2:\"10\";s:7:\"assess3\";s:2:\"0 \";s:7:\"assess4\";s:2:\"0 \";s:7:\"assess5\";s:2:\"0 \";s:7:\"assess6\";s:2:\"0 \";s:7:\"assess7\";s:2:\"0 \";s:7:\"assess8\";s:2:\"0 \";s:7:\"assess9\";s:2:\"0 \";}');
INSERT INTO `baojia` VALUES ('28', '3', '39', '1', '1', '1', '2017-04-18 17:00:00', '', '0', '2', 'a:9:{s:7:\"assess1\";s:2:\"10\";s:7:\"assess2\";s:2:\"0 \";s:7:\"assess3\";s:2:\"0 \";s:7:\"assess4\";s:2:\"0 \";s:7:\"assess5\";s:2:\"0 \";s:7:\"assess6\";s:2:\"0 \";s:7:\"assess7\";s:2:\"0 \";s:7:\"assess8\";s:2:\"0 \";s:7:\"assess9\";s:2:\"0 \";}');
INSERT INTO `baojia` VALUES ('29', '3', '39', '1', '1', '2', '2017-05-20 11:01:00', '', '0', '2', 'a:9:{s:7:\"assess1\";s:1:\"1\";s:7:\"assess2\";s:2:\"0 \";s:7:\"assess3\";s:2:\"0 \";s:7:\"assess4\";s:2:\"0 \";s:7:\"assess5\";s:2:\"0 \";s:7:\"assess6\";s:2:\"0 \";s:7:\"assess7\";s:2:\"0 \";s:7:\"assess8\";s:2:\"0 \";s:7:\"assess9\";s:2:\"0 \";}');
INSERT INTO `baojia` VALUES ('30', '2', '31', null, null, null, null, null, null, null, null);
INSERT INTO `baojia` VALUES ('31', '2', '31', null, null, null, null, null, null, null, null);
INSERT INTO `baojia` VALUES ('32', '2', '26', '2', '2', '3', '2017-07-27 11:11:00', '', '0', '2', 'a:9:{s:7:\"assess1\";s:2:\"10\";s:7:\"assess2\";s:2:\"0 \";s:7:\"assess3\";s:2:\"0 \";s:7:\"assess4\";s:2:\"0 \";s:7:\"assess5\";s:2:\"0 \";s:7:\"assess6\";s:2:\"0 \";s:7:\"assess7\";s:2:\"0 \";s:7:\"assess8\";s:2:\"0 \";s:7:\"assess9\";s:2:\"0 \";}');
INSERT INTO `baojia` VALUES ('33', '3', '38', null, null, null, null, null, null, null, null);
INSERT INTO `baojia` VALUES ('34', '3', '38', null, null, null, null, null, null, null, null);
INSERT INTO `baojia` VALUES ('35', '3', '38', null, null, null, null, null, null, null, null);
INSERT INTO `baojia` VALUES ('36', '3', '38', null, null, null, null, null, null, null, null);
INSERT INTO `baojia` VALUES ('37', '3', '38', null, null, null, null, null, null, null, null);
INSERT INTO `baojia` VALUES ('38', '3', '38', null, null, null, null, null, null, null, null);
INSERT INTO `baojia` VALUES ('39', '3', '38', null, null, null, null, null, null, null, null);
INSERT INTO `baojia` VALUES ('40', '3', '38', null, null, null, null, null, null, null, null);
INSERT INTO `baojia` VALUES ('41', '3', '38', '3', '2', '3', '0000-00-00 00:00:00', '', '0', '2', 'a:9:{s:7:\"assess1\";s:1:\"1\";s:7:\"assess2\";s:2:\"0 \";s:7:\"assess3\";s:2:\"0 \";s:7:\"assess4\";s:2:\"0 \";s:7:\"assess5\";s:2:\"0 \";s:7:\"assess6\";s:2:\"0 \";s:7:\"assess7\";s:2:\"0 \";s:7:\"assess8\";s:2:\"0 \";s:7:\"assess9\";s:2:\"0 \";}');
INSERT INTO `baojia` VALUES ('42', '2', '26', '1', '3', '3', '0000-00-00 00:00:00', '', '0', '2', 'a:9:{s:7:\"assess1\";s:1:\"1\";s:7:\"assess2\";s:2:\"0 \";s:7:\"assess3\";s:2:\"0 \";s:7:\"assess4\";s:2:\"0 \";s:7:\"assess5\";s:2:\"0 \";s:7:\"assess6\";s:2:\"0 \";s:7:\"assess7\";s:2:\"0 \";s:7:\"assess8\";s:2:\"0 \";s:7:\"assess9\";s:2:\"0 \";}');
INSERT INTO `baojia` VALUES ('43', '2', '29', null, null, null, null, null, null, null, null);
INSERT INTO `baojia` VALUES ('44', '1', '1', '1', '1', '1', '0000-00-00 00:00:00', '', '0', '2', 'a:9:{s:7:\"assess1\";s:1:\"1\";s:7:\"assess2\";s:2:\"0 \";s:7:\"assess3\";s:2:\"0 \";s:7:\"assess4\";s:2:\"0 \";s:7:\"assess5\";s:2:\"0 \";s:7:\"assess6\";s:2:\"0 \";s:7:\"assess7\";s:2:\"0 \";s:7:\"assess8\";s:2:\"0 \";s:7:\"assess9\";s:2:\"0 \";}');

-- ----------------------------
-- Table structure for clas
-- ----------------------------
DROP TABLE IF EXISTS `clas`;
CREATE TABLE `clas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='专业信息';

-- ----------------------------
-- Records of clas
-- ----------------------------
INSERT INTO `clas` VALUES ('1', '数学');
INSERT INTO `clas` VALUES ('3', '物理');
INSERT INTO `clas` VALUES ('2', '化学');
INSERT INTO `clas` VALUES ('7', '英语');

-- ----------------------------
-- Table structure for ductpri
-- ----------------------------
DROP TABLE IF EXISTS `ductpri`;
CREATE TABLE `ductpri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `key` float(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ductpri
-- ----------------------------
INSERT INTO `ductpri` VALUES ('1', '选择填空', '4.00');
INSERT INTO `ductpri` VALUES ('2', '计算题1-2\r\n', '10.00');
INSERT INTO `ductpri` VALUES ('3', '计算题3-4\r\n', '15.00');
INSERT INTO `ductpri` VALUES ('4', '计算题5\r\n', '20.00');
INSERT INTO `ductpri` VALUES ('5', '文字题\r\n', '10.00');
INSERT INTO `ductpri` VALUES ('6', '理科报告/页\r\n', '40.00');
INSERT INTO `ductpri` VALUES ('7', '经金会报告/页\r\n', '50.00');
INSERT INTO `ductpri` VALUES ('8', '分析填空\r\n', '10.00');
INSERT INTO `ductpri` VALUES ('9', 'project/页\r\n', '60.00');

-- ----------------------------
-- Table structure for from
-- ----------------------------
DROP TABLE IF EXISTS `from`;
CREATE TABLE `from` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `key` float(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='形式';

-- ----------------------------
-- Records of from
-- ----------------------------
INSERT INTO `from` VALUES ('1', '线下', '1.00');
INSERT INTO `from` VALUES ('2', '在线不计时', '1.00');
INSERT INTO `from` VALUES ('3', '在线计时\r\n', '1.80');
INSERT INTO `from` VALUES ('4', '实体计时', '2.00');

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `key` float(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='产品类型';

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('1', 'homework', '1.00');
INSERT INTO `product` VALUES ('2', 'quiz', '1.50');
INSERT INTO `product` VALUES ('3', 'exam', '1.80');
INSERT INTO `product` VALUES ('4', 'final exam', '2.00');
INSERT INTO `product` VALUES ('5', 'report', '1.00');
INSERT INTO `product` VALUES ('6', 'project', '1.00');

-- ----------------------------
-- Table structure for profess
-- ----------------------------
DROP TABLE IF EXISTS `profess`;
CREATE TABLE `profess` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numid` int(11) NOT NULL COMMENT '课程编号',
  `profe` int(11) DEFAULT NULL COMMENT '专业',
  `subject` varchar(255) DEFAULT NULL COMMENT '课程名称',
  `key` float(11,2) DEFAULT NULL COMMENT '课程基数',
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`numid`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `numid` (`numid`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COMMENT='专业课程信息';

-- ----------------------------
-- Records of profess
-- ----------------------------
INSERT INTO `profess` VALUES ('1', '101', '1', '微积分1或2', '1.00', '2000');
INSERT INTO `profess` VALUES ('2', '102', '1', '商科微积分/数学\r\n', '1.00', '2000');
INSERT INTO `profess` VALUES ('5', '105', '1', '线性代数', '1.00', '2000');
INSERT INTO `profess` VALUES ('3', '103', '1', '基础几何', '1.00', '2000');
INSERT INTO `profess` VALUES ('4', '104', '1', '解析几何\r\n', '1.00', '2000');
INSERT INTO `profess` VALUES ('6', '106', '1', '概率统计', '1.00', '2000');
INSERT INTO `profess` VALUES ('7', '107', '1', '商科统计', '1.00', '2000');
INSERT INTO `profess` VALUES ('8', '108', '1', '常微分方程', '1.50', '2500');
INSERT INTO `profess` VALUES ('9', '109', '1', '其他1，2，3学期数学课程', '1.00', '2000');
INSERT INTO `profess` VALUES ('10', '110', '1', '商科统计2', '1.25', '2300');
INSERT INTO `profess` VALUES ('11', '111', '1', '微积分3', '1.50', '2500');
INSERT INTO `profess` VALUES ('12', '112', '1', '抽象代数', '1.50', '2500');
INSERT INTO `profess` VALUES ('13', '113', '1', '离散数学', '1.50', '2500');
INSERT INTO `profess` VALUES ('14', '114', '1', '其他4学期数学课程', '1.50', '2500');
INSERT INTO `profess` VALUES ('15', '115', '1', '拓扑学', '1.50', '2500');
INSERT INTO `profess` VALUES ('16', '116', '1', '复变函数', '1.50', '2500');
INSERT INTO `profess` VALUES ('17', '117', '1', '泛函分析', '1.75', '2500');
INSERT INTO `profess` VALUES ('18', '118', '1', '数理统计', '1.75', '2500');
INSERT INTO `profess` VALUES ('19', '119', '1', '偏微分方程', '2.00', '2800');
INSERT INTO `profess` VALUES ('20', '120', '1', '其他5，6学期数学课程', '2.00', '2800');
INSERT INTO `profess` VALUES ('21', '121', '1', '实变函数', '2.25', '2800');
INSERT INTO `profess` VALUES ('22', '122', '1', '微分几何', '2.50', '2800');
INSERT INTO `profess` VALUES ('23', '123', '1', '代数几何', '2.50', '2800');
INSERT INTO `profess` VALUES ('24', '124', '1', '其他7，8学期数学课程', '2.50', '2800');
INSERT INTO `profess` VALUES ('25', '201', '2', '基础化学1', '1.00', '2000');
INSERT INTO `profess` VALUES ('26', '202', '2', '有机化学1', '1.25', '2300');
INSERT INTO `profess` VALUES ('27', '203', '2', '分析测量', '1.25', '2300');
INSERT INTO `profess` VALUES ('28', '204', '2', '有机化学2', '1.50', '2500');
INSERT INTO `profess` VALUES ('29', '205', '2', '基础化学2', '1.25', '2300');
INSERT INTO `profess` VALUES ('30', '206', '2', '分析化学1', '1.75', '2500');
INSERT INTO `profess` VALUES ('31', '207', '2', '分析化学2', '1.75', '2500');
INSERT INTO `profess` VALUES ('32', '208', '2', '物理化学1', '2.00', '2800');
INSERT INTO `profess` VALUES ('33', '209', '2', '物理化学2', '2.00', '2800');
INSERT INTO `profess` VALUES ('34', '210', '2', '生物化学1', '1.25', '2300');
INSERT INTO `profess` VALUES ('35', '211', '2', '生物化学2', '1.25', '2300');
INSERT INTO `profess` VALUES ('36', '212', '2', '无机化学', '1.25', '2300');
INSERT INTO `profess` VALUES ('37', '213', '2', '高等无机', '1.75', '2500');
INSERT INTO `profess` VALUES ('38', '301', '3', '物理第1学期', '1.00', '2000');
INSERT INTO `profess` VALUES ('39', '302', '3', '物理第2学期', '1.00', '2000');
INSERT INTO `profess` VALUES ('40', '303', '3', '其他1，2 学期物理课程', '1.00', '2000');
INSERT INTO `profess` VALUES ('41', '304', '3', '物理第3学期', '1.50', '2500');
INSERT INTO `profess` VALUES ('42', '305', '3', '物理第4学期', '1.50', '2500');
INSERT INTO `profess` VALUES ('43', '306', '3', '物理第5学期', '1.50', '2500');
INSERT INTO `profess` VALUES ('44', '307', '3', '电磁学', '1.50', '2500');
INSERT INTO `profess` VALUES ('45', '308', '3', '量子力学', '2.00', '2800');
INSERT INTO `profess` VALUES ('46', '309', '3', '电子学', '1.50', '2500');
INSERT INTO `profess` VALUES ('47', '310', '3', '其他3-6学期物理课程', '1.50', '2500');
INSERT INTO `profess` VALUES ('48', '311', '3', '统计物理', '2.00', '2800');
INSERT INTO `profess` VALUES ('49', '312', '3', '其他7，8学期物理课程', '2.50', '2800');
