/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : order

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-08-11 09:31:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL COMMENT '1销售    2 任务管理    3 财务     4  TA',
  `renark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin` (`id`,`name`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', 'd6047daf94ef8027abb48272e2423739', '0', null);
INSERT INTO `admin` VALUES ('2', 'user', 'd41d8cd98f00b204e9800998ecf8427e', '1', null);
INSERT INTO `admin` VALUES ('3', 'renwu', 'e10adc3949ba59abbe56e057f20f883e', '2', null);
INSERT INTO `admin` VALUES ('4', 'caiwu', 'd41d8cd98f00b204e9800998ecf8427e', '3', null);
INSERT INTO `admin` VALUES ('8', '111', '827ccb0eea8a706c4c34a16891f84e7b', '4', null);
INSERT INTO `admin` VALUES ('6', '1234', 'c4ca4238a0b923820dcc509a6f75849b', '4', null);
INSERT INTO `admin` VALUES ('11', 'zhang', '61585ed9c0328d1fad8475be9e8ecd5b', '4', null);

-- ----------------------------
-- Table structure for chaike
-- ----------------------------
DROP TABLE IF EXISTS `chaike`;
CREATE TABLE `chaike` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT NULL COMMENT '课程id',
  `taskid` varchar(255) NOT NULL,
  `tasktitle` varchar(255) DEFAULT NULL,
  `percent` int(255) DEFAULT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` datetime DEFAULT NULL,
  `ta` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `taskid` (`taskid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of chaike
-- ----------------------------
INSERT INTO `chaike` VALUES ('1', '1', 'C20001', '1111', '2', null, '2017-08-01 23:59:59', '111');
INSERT INTO `chaike` VALUES ('2', '1', 'C20002', '11111', '2', null, '2017-08-01 23:59:59', '111');
INSERT INTO `chaike` VALUES ('3', '1', 'C20003', '11111', '2', null, '2017-08-01 23:59:59', '111');
INSERT INTO `chaike` VALUES ('4', '1', 'C20004', '11111', '3', null, '2017-08-01 23:59:59', '111');
INSERT INTO `chaike` VALUES ('5', '1', 'C20005', '111111', '3', null, '2017-08-01 23:59:59', '111');
INSERT INTO `chaike` VALUES ('6', '1', 'C20006', '1111', '3', null, '2017-08-02 17:42:25', '7');
INSERT INTO `chaike` VALUES ('7', '1', 'C20007', '11111', '2', null, '2017-08-02 17:42:25', '7');
INSERT INTO `chaike` VALUES ('8', '1', 'C20008', '1111', '3', null, '2017-08-02 17:42:25', '7');
INSERT INTO `chaike` VALUES ('9', '1', 'C20009', '111111', '2', null, '2017-08-02 17:42:25', '7');
INSERT INTO `chaike` VALUES ('10', '1', 'C20010', '111', '2', null, '2017-08-02 17:42:25', '7');
INSERT INTO `chaike` VALUES ('11', '1', 'C20011', '11111', '2', null, '2017-08-02 17:42:25', '7');
INSERT INTO `chaike` VALUES ('12', '1', 'C20012', '11111', '2', null, '2017-08-02 17:42:25', '7');
INSERT INTO `chaike` VALUES ('13', '1', 'C20013', '11111', '2', null, '2017-08-02 17:42:25', '7');
INSERT INTO `chaike` VALUES ('14', '1', 'C20014', '1111', '2', null, '2017-08-02 17:42:25', '7');
INSERT INTO `chaike` VALUES ('15', '1', 'C20015', '33333', '4', null, '2017-08-02 17:42:25', '7');
INSERT INTO `chaike` VALUES ('16', '1', 'C20016', '22222', '3', null, '2017-08-02 17:42:25', '7');
INSERT INTO `chaike` VALUES ('17', '1', 'C20017', '22', '4', null, '2017-08-02 17:42:25', '7');
INSERT INTO `chaike` VALUES ('18', '1', 'C20018', '111', '3', null, '2017-08-02 17:42:25', '7');

-- ----------------------------
-- Table structure for check
-- ----------------------------
DROP TABLE IF EXISTS `check`;
CREATE TABLE `check` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orid` int(11) DEFAULT NULL COMMENT '订单id',
  `voucher` varchar(255) DEFAULT NULL COMMENT '凭证',
  `chfile1` varchar(255) DEFAULT NULL COMMENT '文件1',
  `chfile2` varchar(255) DEFAULT NULL,
  `chfile3` varchar(255) DEFAULT NULL,
  `chstatus` int(255) DEFAULT '0' COMMENT '审核状态 0 首次提交 1 第二次',
  `time` varchar(255) DEFAULT NULL COMMENT '审核时间',
  `chscore` int(255) DEFAULT NULL COMMENT '审核分数',
  `check` int(255) DEFAULT '0' COMMENT '是否通过     1 通过  2 不通过',
  `remark` varchar(255) DEFAULT NULL COMMENT '审核备注',
  `chectime` varchar(20) DEFAULT NULL COMMENT '审核时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of check
-- ----------------------------
INSERT INTO `check` VALUES ('1', '1', '20170801\\a1f10.pdf', null, null, null, '0', '1501570279', '20', '1', '', '1501638501');
INSERT INTO `check` VALUES ('2', '2', '20170802\\6d471.pdf', null, null, null, '0', '1501638089', '20', '1', '', '1501638501');
INSERT INTO `check` VALUES ('3', '5', '20170802\\bd812.pdf', null, null, null, '0', '1501639816', '20', '1', '', '1501639936');

-- ----------------------------
-- Table structure for course
-- ----------------------------
DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course` varchar(255) DEFAULT NULL COMMENT '课号',
  `url` varchar(255) DEFAULT NULL COMMENT '网址',
  `uruser` varchar(255) DEFAULT NULL COMMENT '用户名',
  `urpass` varchar(255) DEFAULT NULL COMMENT '密码',
  `userid` int(11) DEFAULT NULL COMMENT '用户ID',
  `saleper` varchar(255) DEFAULT NULL COMMENT '销售人员',
  `tasktitle` varchar(255) DEFAULT NULL COMMENT '任务标题',
  `quotgr` int(11) DEFAULT NULL COMMENT '报价组',
  `addmark` varchar(255) DEFAULT NULL COMMENT '附加备注',
  `addmoney` float(11,2) DEFAULT NULL COMMENT '附加费',
  `discomar` varchar(255) DEFAULT NULL COMMENT '优惠备注',
  `discount` float(11,2) DEFAULT NULL COMMENT '优惠金额',
  `tasklevel` int(11) DEFAULT NULL COMMENT '任务级别',
  `remark` varchar(255) DEFAULT NULL COMMENT '销售备注',
  `startdate` date DEFAULT NULL COMMENT '开始时间',
  `enddate` date DEFAULT NULL COMMENT '结束时间',
  `length` int(11) DEFAULT NULL COMMENT '时长',
  `ta` int(255) DEFAULT '0',
  `couid` varchar(11) DEFAULT NULL COMMENT '内部编号',
  `file` varchar(255) DEFAULT NULL,
  `coustatus` int(11) DEFAULT '1' COMMENT '课程状态   1 新接入  2 拆课表未完成  3  拆课表已完成',
  `jidian` float(255,2) DEFAULT '0.00' COMMENT '课程绩点',
  `final` float(255,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of course
-- ----------------------------
INSERT INTO `course` VALUES ('1', '111', '11', '11', '11', '83001', 'S04', '111', '3', '1', '1.00', '1', '1.00', '4', '', '2017-08-01', '2017-09-12', '6', '7', 'C200', 'a:0:{}', '3', '6.67', '6.67');

-- ----------------------------
-- Table structure for cpoint
-- ----------------------------
DROP TABLE IF EXISTS `cpoint`;
CREATE TABLE `cpoint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT NULL COMMENT '学期所属课程',
  `ta` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL COMMENT '日期',
  `jidian` varchar(255) NOT NULL,
  `lata` int(255) DEFAULT NULL,
  `laji` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cpoint
-- ----------------------------
INSERT INTO `cpoint` VALUES ('1', '1', '7', '2017-08-31', '4', '0', '');
INSERT INTO `cpoint` VALUES ('2', '1', '7', '2017-09-30', '3', '2', '3');

-- ----------------------------
-- Table structure for log
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '操作人id',
  `tid` int(11) DEFAULT NULL COMMENT '操作任务id',
  `class` varchar(255) DEFAULT NULL COMMENT '操作类别',
  `remark` varchar(255) DEFAULT NULL COMMENT '操作备注',
  `logtime` varchar(255) DEFAULT NULL COMMENT '操作时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log
-- ----------------------------
INSERT INTO `log` VALUES ('1', '1', '1', '销售接单：E02200', '', '1501570158');
INSERT INTO `log` VALUES ('2', '1', '1', '任务分配给TA：111', '', '1501570259');
INSERT INTO `log` VALUES ('3', '1', '1', '该任务符合必检条件，自动设置该任务为抽检', '', '1501570263');
INSERT INTO `log` VALUES ('4', '1', '1', 'TA上传资料第1次', '', '1501570279');
INSERT INTO `log` VALUES ('5', '1', '1', '审核资料为通过', '', '1501570286');
INSERT INTO `log` VALUES ('6', '1', '1', '修改任务状态为：已完成', '', '1501570423');
INSERT INTO `log` VALUES ('7', '1', '1', '修改任务状态为：已完成', '', '1501570591');
INSERT INTO `log` VALUES ('8', '1', '1', '新课程接入', '', '1501570694');
INSERT INTO `log` VALUES ('9', '1', '1', '任管添加课程信息', '分配课程给TA：111', '1501570727');
INSERT INTO `log` VALUES ('10', '1', '1', '2017-08-31记录等级', '等级为：A，备注为：', '1501570977');
INSERT INTO `log` VALUES ('11', '1', '1', '2017-09-30记录等级', '等级为：A，备注为：', '1501571002');
INSERT INTO `log` VALUES ('12', '1', '1', '最终等级记录，任务结束', '等级为：A+，备注为：', '1501571017');
INSERT INTO `log` VALUES ('13', '1', '20', '销售接单：P02200', '', '1501571113');
INSERT INTO `log` VALUES ('14', '1', '20', '任务分配给TA：1234', '', '1501571168');
INSERT INTO `log` VALUES ('15', '1', '20', '修改任务状态为：已完成', '', '1501571190');
INSERT INTO `log` VALUES ('16', '1', '20', '修改任务状态为：已完成', '', '1501571323');
INSERT INTO `log` VALUES ('17', '1', '20', '该任务符合必检条件，自动设置该任务为抽检', '', '1501577272');
INSERT INTO `log` VALUES ('18', '1', '2', '该任务符合必检条件，自动设置该任务为抽检', '', '1501637825');
INSERT INTO `log` VALUES ('19', '1', '5', '该任务符合必检条件，自动设置该任务为抽检', '', '1501637989');
INSERT INTO `log` VALUES ('20', '1', '2', 'TA上传资料第1次', '', '1501638089');
INSERT INTO `log` VALUES ('21', '1', '2', '审核资料为通过', '', '1501638501');
INSERT INTO `log` VALUES ('22', '1', '5', 'TA上传资料第1次', '', '1501639816');
INSERT INTO `log` VALUES ('23', '1', '5', '审核资料为通过', '', '1501639936');
INSERT INTO `log` VALUES ('24', '1', '1', 'C类任务换TA', 'TA：111,比重：12更换成：zhang,比重：34', '1501667041');
INSERT INTO `log` VALUES ('41', '1', '1', 'TA绩点结算', 'zhang,获得5绩点。', '1501750131');
INSERT INTO `log` VALUES ('42', '1', '1', 'TA绩点结算（有TA更换情况）', 'zhang,获得3绩点，111获得3绩点。', '1501750151');
INSERT INTO `log` VALUES ('43', '1', '1', 'TA绩点结算', 'zhang,获得4绩点。', '1501752497');
INSERT INTO `log` VALUES ('44', '1', '1', 'TA绩点结算（有TA更换情况）', 'zhang,获得3绩点，111获得3绩点。', '1501752557');
INSERT INTO `log` VALUES ('45', '1', '1', '2017-08-31记录等级', '等级为：B+，备注为：', '1501752613');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `userid` int(11) DEFAULT NULL COMMENT '用户ID',
  `orderid` varchar(255) NOT NULL COMMENT '任务ID',
  `saleper` varchar(255) DEFAULT NULL COMMENT '销售人员',
  `tasktitle` varchar(255) DEFAULT NULL COMMENT '任务标题',
  `deadline` varchar(255) DEFAULT NULL COMMENT '截止时间/开始时间',
  `quotgr` int(11) DEFAULT NULL COMMENT '报价组',
  `ductnum` varchar(11) DEFAULT NULL COMMENT '产品数量',
  `addmark` varchar(255) DEFAULT NULL COMMENT '附加备注',
  `addmoney` float(11,2) DEFAULT NULL COMMENT '附加费',
  `discomar` varchar(255) DEFAULT NULL COMMENT '优惠备注',
  `discount` float(11,2) DEFAULT NULL COMMENT '优惠金额',
  `tasklevel` int(11) DEFAULT NULL COMMENT '任务级别',
  `remark` varchar(255) DEFAULT NULL COMMENT '销售备注',
  `zone` int(11) DEFAULT NULL COMMENT '时区',
  `taskstatus` int(255) DEFAULT '1' COMMENT '任务状态  1未分配  2 已分配 4已完成 5修改 6争议 ',
  `taskmark` varchar(255) DEFAULT NULL COMMENT '任务备注',
  `ta` int(255) DEFAULT '0' COMMENT 'ta',
  `zontotal` float(11,2) DEFAULT NULL,
  `shitotal` float(11,2) DEFAULT '0.00',
  `ordertime` int(11) DEFAULT NULL,
  `paystatus` varchar(255) DEFAULT NULL,
  `misslic` varchar(255) DEFAULT '批准',
  `remain` float(255,2) DEFAULT '0.00',
  `taskid` tinyint(4) DEFAULT NULL COMMENT '类别 ',
  `tasklength` varchar(255) DEFAULT NULL COMMENT '时长',
  `closdate` varchar(255) DEFAULT '' COMMENT '结束截止日期',
  `baoji` float(255,2) DEFAULT NULL COMMENT '报价绩点',
  `finalji` float(255,2) DEFAULT NULL COMMENT '最终绩点',
  `jiremark` varchar(255) DEFAULT NULL,
  `check` int(255) DEFAULT '0' COMMENT '审核状态 0 未知  1 审核  2  不审核',
  `chresult` int(255) DEFAULT '0' COMMENT '审核结果 0 未知  1通过  2  不通过',
  `chectime` varchar(20) DEFAULT NULL COMMENT '最后一次审核时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE,
  UNIQUE KEY `orderid` (`orderid`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('1', '83001', 'E02200', 'S03', '1111111', '1501570101', '3', '9', '1', '1.00', '1', '1.00', '3', '', '2', '4', '', '2', '45.00', '40.00', '1501571114', '尾款未付', '批准', '20.00', '3', '6', '1501570101', '20.00', '20.00', '', '1', '1', '1501638501');
INSERT INTO `order` VALUES ('2', '83001', 'C20001', 'S04', '1111', '1501603199', '3', '20', '1', '1.00', '1', '1.00', '4', '', '5', '1', null, '2', null, '0.00', '1501571114', null, '批准', '0.00', '1', '6', '', null, null, null, '1', '1', '1501638501');
INSERT INTO `order` VALUES ('3', '83001', 'C20002', 'S04', '11111', '1501603199', '3', '2', '1', '1.00', '1', '1.00', '4', '', '5', '1', null, '2', null, '0.00', '1501571114', null, '批准', '0.00', '1', '6', '', null, null, null, '0', '0', null);
INSERT INTO `order` VALUES ('4', '83001', 'C20003', 'S04', '11111', '1501603199', '3', '2', '1', '1.00', '1', '1.00', '4', '', '5', '1', null, '2', null, '0.00', '1501571114', null, '批准', '0.00', '1', '6', '', null, null, null, '0', '0', null);
INSERT INTO `order` VALUES ('5', '83001', 'C20004', 'S04', '11111', '1501603199', '3', '13', '1', '1.00', '1', '1.00', '4', '', '5', '1', null, '2', null, '0.00', '1501571114', null, '批准', '0.00', '1', '6', '', null, null, null, '1', '1', '1501639936');
INSERT INTO `order` VALUES ('6', '83001', 'C20005', 'S04', '111111', '1501603199', '3', '3', '1', '1.00', '1', '1.00', '4', '', '5', '1', null, '2', null, '0.00', '1501571114', null, '批准', '0.00', '1', '6', '', null, null, null, '0', '0', null);
INSERT INTO `order` VALUES ('7', '83001', 'C20006', 'S04', '1111', '1501666945', '3', '3', '1', '1.00', '1', '1.00', '4', '', '5', '1', null, '7', null, '0.00', '1501571114', null, '批准', '0.00', '1', '6', '', null, null, null, '0', '0', null);
INSERT INTO `order` VALUES ('8', '83001', 'C20007', 'S04', '11111', '1501666945', '3', '2', '1', '1.00', '1', '1.00', '4', '', '5', '1', null, '7', null, '0.00', '1501571114', null, '批准', '0.00', '1', '6', '', null, null, null, '0', '0', null);
INSERT INTO `order` VALUES ('9', '83001', 'C20008', 'S04', '1111', '1501666945', '3', '3', '1', '1.00', '1', '1.00', '4', '', '5', '1', null, '7', null, '0.00', '1501571114', null, '批准', '0.00', '1', '6', '', null, null, null, '0', '0', null);
INSERT INTO `order` VALUES ('10', '83001', 'C20009', 'S04', '111111', '1501666945', '3', '2', '1', '1.00', '1', '1.00', '4', '', '5', '1', null, '7', null, '0.00', '1501571114', null, '批准', '0.00', '1', '6', '', null, null, null, '0', '0', null);
INSERT INTO `order` VALUES ('11', '83001', 'C20010', 'S04', '111', '1501666945', '3', '2', '1', '1.00', '1', '1.00', '4', '', '5', '1', null, '7', null, '0.00', '1501571114', null, '批准', '0.00', '1', '6', '', null, null, null, '0', '0', null);
INSERT INTO `order` VALUES ('12', '83001', 'C20011', 'S04', '11111', '1501666945', '3', '2', '1', '1.00', '1', '1.00', '4', '', '5', '1', null, '7', null, '0.00', '1501571114', null, '批准', '0.00', '1', '6', '', null, null, null, '0', '0', null);
INSERT INTO `order` VALUES ('13', '83001', 'C20012', 'S04', '11111', '1501666945', '3', '2', '1', '1.00', '1', '1.00', '4', '', '5', '1', null, '7', null, '0.00', '1501571114', null, '批准', '0.00', '1', '6', '', null, null, null, '0', '0', null);
INSERT INTO `order` VALUES ('14', '83001', 'C20013', 'S04', '11111', '1501666945', '3', '2', '1', '1.00', '1', '1.00', '4', '', '5', '1', null, '7', null, '0.00', '1501571114', null, '批准', '0.00', '1', '6', '', null, null, null, '0', '0', null);
INSERT INTO `order` VALUES ('15', '83001', 'C20014', 'S04', '1111', '1501666945', '3', '2', '1', '1.00', '1', '1.00', '4', '', '5', '1', null, '7', null, '0.00', '1501571114', null, '批准', '0.00', '1', '6', '', null, null, null, '0', '0', null);
INSERT INTO `order` VALUES ('16', '83001', 'C20015', 'S04', '33333', '1501666945', '3', '4', '1', '1.00', '1', '1.00', '4', '', '5', '1', null, '7', null, '0.00', '1501571114', null, '批准', '0.00', '1', '6', '', null, null, null, '0', '0', null);
INSERT INTO `order` VALUES ('17', '83001', 'C20016', 'S04', '22222', '1501666945', '3', '3', '1', '1.00', '1', '1.00', '4', '', '5', '1', null, '7', null, '0.00', '1501571114', null, '批准', '0.00', '1', '6', '', null, null, null, '0', '0', null);
INSERT INTO `order` VALUES ('18', '83001', 'C20017', 'S04', '22', '1501666945', '3', '4', '1', '1.00', '1', '1.00', '4', '', '5', '1', null, '7', null, '0.00', '1501571114', null, '批准', '0.00', '1', '6', '', null, null, null, '0', '0', null);
INSERT INTO `order` VALUES ('19', '83001', 'C20018', 'S04', '111', '1501666945', '3', '3', '1', '1.00', '1', '1.00', '4', '', '5', '1', null, '7', null, '0.00', '1501571114', null, '批准', '0.00', '1', '6', '', null, null, null, '0', '0', null);
INSERT INTO `order` VALUES ('20', '50001', 'P02200', 'S02', '1111', '1501571099', '1', '9.5', '1', '111.00', '1', '1.00', '2', '', '3', '4', '', '3', '157.50', '0.00', '1501571114', null, '批准', '0.00', '2', null, '', '20.00', '10.00', '', '1', '0', null);

-- ----------------------------
-- Table structure for pay
-- ----------------------------
DROP TABLE IF EXISTS `pay`;
CREATE TABLE `pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` varchar(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `paytype` varchar(255) DEFAULT NULL,
  `payacc` varchar(255) DEFAULT NULL,
  `paymoney` float(255,2) DEFAULT NULL,
  `paymark` varchar(255) DEFAULT NULL,
  `paytime` int(11) DEFAULT NULL,
  `payimg1` varchar(255) DEFAULT NULL,
  `payimg0` varchar(255) DEFAULT NULL,
  `paystatus` varchar(255) DEFAULT NULL,
  `lastdate` date DEFAULT NULL,
  `payentry` int(255) DEFAULT '1',
  `payid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay
-- ----------------------------
INSERT INTO `pay` VALUES ('1', 'E02200', '83001', '首款', '支付宝-l', '20.00', '', '1501570236', null, '20170801\\a9d23.jpg', '尾款未付', '2017-08-01', '1', 'E022001');

-- ----------------------------
-- Table structure for perpoint
-- ----------------------------
DROP TABLE IF EXISTS `perpoint`;
CREATE TABLE `perpoint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ta` varchar(255) DEFAULT NULL COMMENT 'ta  id',
  `tid` varchar(255) DEFAULT NULL COMMENT '任务/课程',
  `time` varchar(255) DEFAULT NULL COMMENT '时间',
  `jidian` float(255,2) DEFAULT '0.00' COMMENT '当前任务绩点\\数量',
  `final` float(255,2) DEFAULT '0.00' COMMENT '当前已得到的任务课程绩点\\兼职ta的单价',
  `taskji` float(255,2) DEFAULT '0.00' COMMENT '当前任务课程绩点\\兼职ta的薪酬',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of perpoint
-- ----------------------------
INSERT INTO `perpoint` VALUES ('1', '2', 'E02200', '1501570592', '20.00', '20.00', '20.00');
INSERT INTO `perpoint` VALUES ('2', '2', 'C200', '1501570976', '2.00', '2.00', '6.67');
INSERT INTO `perpoint` VALUES ('3', '2', 'C200', '1501571002', '2.00', '4.00', '6.67');
INSERT INTO `perpoint` VALUES ('4', '2', 'C200', '1501571017', '2.67', '6.67', '6.67');
INSERT INTO `perpoint` VALUES ('6', '3', 'P02200', '1501571324', '10.00', '2.30', '23.00');
INSERT INTO `perpoint` VALUES ('7', '7', 'C200', '1501748738', '5.00', '5.00', '6.67');
INSERT INTO `perpoint` VALUES ('10', '7', 'C200', '1501749787', '6.00', '6.00', '6.67');
INSERT INTO `perpoint` VALUES ('15', '7', 'C200', '1501750131', '5.00', '5.00', '6.67');
INSERT INTO `perpoint` VALUES ('16', '7', 'C200', '1501750151', '3.00', '3.00', '6.67');
INSERT INTO `perpoint` VALUES ('17', '2', 'C200', '1501750151', '3.00', '3.00', '6.67');
INSERT INTO `perpoint` VALUES ('18', '7', 'C200', '1501752497', '4.00', '4.00', '6.67');
INSERT INTO `perpoint` VALUES ('19', '7', 'C200', '1501752526', '3.00', '3.00', '6.67');
INSERT INTO `perpoint` VALUES ('20', '2', 'C200', '1501752526', '3.00', '3.00', '6.67');
INSERT INTO `perpoint` VALUES ('21', '7', 'C200', '1501752557', '3.00', '3.00', '6.67');
INSERT INTO `perpoint` VALUES ('22', '2', 'C200', '1501752557', '3.00', '3.00', '6.67');

-- ----------------------------
-- Table structure for regulate
-- ----------------------------
DROP TABLE IF EXISTS `regulate`;
CREATE TABLE `regulate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jichu` varchar(255) DEFAULT NULL,
  `jidian` varchar(255) DEFAULT NULL,
  `final` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `ta` int(255) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of regulate
-- ----------------------------

-- ----------------------------
-- Table structure for source
-- ----------------------------
DROP TABLE IF EXISTS `source`;
CREATE TABLE `source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `lastid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of source
-- ----------------------------
INSERT INTO `source` VALUES ('1', '固有用户', '40000');
INSERT INTO `source` VALUES ('2', '市场组', '83001');
INSERT INTO `source` VALUES ('3', 'QQ添加', '90000');
INSERT INTO `source` VALUES ('4', '微信添加', '50001');
INSERT INTO `source` VALUES ('5', '朋友介绍', '10000');

-- ----------------------------
-- Table structure for ta
-- ----------------------------
DROP TABLE IF EXISTS `ta`;
CREATE TABLE `ta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '姓名',
  `class` int(255) DEFAULT NULL COMMENT '类别   1 全职   2兼职',
  `course` varchar(255) DEFAULT NULL COMMENT '科目',
  `college` varchar(255) DEFAULT NULL COMMENT '院校',
  `profess` varchar(255) DEFAULT NULL COMMENT '专业',
  `tel1` int(255) DEFAULT NULL COMMENT '联系方式1',
  `tel2` int(255) DEFAULT NULL COMMENT '联系方式2',
  `adminid` int(11) DEFAULT NULL,
  `jidian` float(255,2) DEFAULT '0.00' COMMENT '总绩点/薪酬',
  `monji` float(255,2) DEFAULT '0.00' COMMENT '本月绩点',
  `cpop` float(255,2) DEFAULT '0.00' COMMENT 'C类绩点/薪酬',
  `phpop` float(255,2) DEFAULT '0.00' COMMENT 'P\\H类绩点/数量',
  `epop` float(255,2) DEFAULT '0.00' COMMENT 'E类绩点\\数量',
  `phper` float(255,2) DEFAULT '0.00' COMMENT 'PH类单位价格',
  `eper` float(255,2) DEFAULT '0.00' COMMENT 'E类单位价格',
  `lastmon` int(11) DEFAULT '0' COMMENT '上次更改绩点的月份',
  `epay` float(255,2) DEFAULT '0.00' COMMENT 'E类薪酬',
  `phpay` float(255,2) DEFAULT '0.00' COMMENT 'PH类薪酬',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ta
-- ----------------------------
INSERT INTO `ta` VALUES ('2', '111', '1', '1', '1', '1', '1', '1', '6', '0.00', '29.67', '9.67', '0.00', '20.00', '0.00', '0.00', '8', '0.00', '0.00');
INSERT INTO `ta` VALUES ('3', '1234', '2', '', '', '', '0', '0', '8', '0.00', '23.00', '0.00', '10.00', '0.00', '2.30', '55.30', '8', '0.00', '23.00');
INSERT INTO `ta` VALUES ('7', 'zhang', '1', 'aaa', 'aaaaa', 'aaaaa', '0', '0', '11', '0.00', '10.00', '10.00', '0.00', '0.00', '0.00', '0.00', '8', '0.00', '0.00');

-- ----------------------------
-- Table structure for taskid
-- ----------------------------
DROP TABLE IF EXISTS `taskid`;
CREATE TABLE `taskid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `lastid` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of taskid
-- ----------------------------
INSERT INTO `taskid` VALUES ('1', '整课', 'C200');
INSERT INTO `taskid` VALUES ('2', 'paper', 'P02200');
INSERT INTO `taskid` VALUES ('3', 'exam', 'E02200');
INSERT INTO `taskid` VALUES ('4', 'homework', 'H02199');
INSERT INTO `taskid` VALUES ('5', 'other', 'F02199');
INSERT INTO `taskid` VALUES ('7', 'percentc', '10');
INSERT INTO `taskid` VALUES ('8', 'num', '6');
INSERT INTO `taskid` VALUES ('9', 'sampl', '40');
INSERT INTO `taskid` VALUES ('10', 'standard', '135');
INSERT INTO `taskid` VALUES ('11', 'alevel', '42');
INSERT INTO `taskid` VALUES ('12', 'blevel', '35');
INSERT INTO `taskid` VALUES ('13', 'clevel', '27');
INSERT INTO `taskid` VALUES ('14', 'dlevel', '10');

-- ----------------------------
-- Table structure for term
-- ----------------------------
DROP TABLE IF EXISTS `term`;
CREATE TABLE `term` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT NULL COMMENT '学期所属课程',
  `date` date DEFAULT NULL COMMENT '日期',
  `level` varchar(255) DEFAULT '0' COMMENT '等级',
  `remark` varchar(255) DEFAULT NULL,
  `ta` varchar(255) DEFAULT NULL,
  `jine` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of term
-- ----------------------------
INSERT INTO `term` VALUES ('1', '1', '2017-08-31', 'B+', '', '2', '2');
INSERT INTO `term` VALUES ('2', '1', '2017-09-30', 'A', '', '2', '2');
INSERT INTO `term` VALUES ('3', '1', '0000-00-00', 'A+', '', '2', '3');

-- ----------------------------
-- Table structure for unitpr
-- ----------------------------
DROP TABLE IF EXISTS `unitpr`;
CREATE TABLE `unitpr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dayu48` int(11) DEFAULT NULL,
  `48to24` int(11) DEFAULT NULL,
  `24to12` int(11) DEFAULT NULL,
  `12to6` int(11) DEFAULT NULL,
  `6to0` int(11) DEFAULT NULL,
  `task` varchar(255) DEFAULT NULL,
  `quotgr` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of unitpr
-- ----------------------------
INSERT INTO `unitpr` VALUES ('1', '35', '24', '12', '6', '5', '1', '1');
INSERT INTO `unitpr` VALUES ('2', '35', '24', '12', '6', '5', '1', '3');
INSERT INTO `unitpr` VALUES ('3', '35', '24', '12', '6', '5', '1', '2');
INSERT INTO `unitpr` VALUES ('5', '35', '24', '12', '6', '5', '3', '2');
INSERT INTO `unitpr` VALUES ('6', '35', '24', '12', '6', '5', '4', '1');
INSERT INTO `unitpr` VALUES ('7', '35', '24', '12', '6', '5', '1', '4');
INSERT INTO `unitpr` VALUES ('8', '35', '24', '12', '6', '5', '2', '4');
INSERT INTO `unitpr` VALUES ('9', '35', '24', '12', '6', '5', '3', '1');
INSERT INTO `unitpr` VALUES ('10', '35', '24', '12', '6', '5', '4', '2');
INSERT INTO `unitpr` VALUES ('13', '35', '24', '12', '6', '5', '3', '3');
INSERT INTO `unitpr` VALUES ('14', '35', '24', '12', '6', '5', '4', '3');
INSERT INTO `unitpr` VALUES ('16', '35', '24', '12', '6', '5', '2', '5');
INSERT INTO `unitpr` VALUES ('17', '35', '24', '12', '6', '5', '3', '4');
INSERT INTO `unitpr` VALUES ('18', '35', '24', '12', '6', '5', '4', '5');
INSERT INTO `unitpr` VALUES ('21', '35', '24', '12', '6', '5', '3', '5');
INSERT INTO `unitpr` VALUES ('22', '35', '24', '12', '6', '5', '4', '4');
INSERT INTO `unitpr` VALUES ('25', '35', '24', '12', '6', '5', '3', '6');
INSERT INTO `unitpr` VALUES ('26', '35', '24', '12', '6', '5', '4', '6');
INSERT INTO `unitpr` VALUES ('29', '35', '24', '12', '6', '5', '3', '7');
INSERT INTO `unitpr` VALUES ('33', '35', '24', '12', '6', '5', '3', '8');
INSERT INTO `unitpr` VALUES ('37', '35', '24', '12', '6', '5', '3', '9');
INSERT INTO `unitpr` VALUES ('40', '35', '24', '12', '6', '5', '2', '3');
INSERT INTO `unitpr` VALUES ('44', '35', '24', '12', '6', '5', '2', '2');
INSERT INTO `unitpr` VALUES ('48', '35', '24', '12', '6', '5', '2', '1');
INSERT INTO `unitpr` VALUES ('51', '35', '24', '12', '6', '5', '5', '1');
INSERT INTO `unitpr` VALUES ('52', '35', '24', '12', '6', '5', '5', '2');
INSERT INTO `unitpr` VALUES ('53', '35', '24', '12', '6', '5', '5', '3');
INSERT INTO `unitpr` VALUES ('54', '35', '24', '12', '6', '5', '5', '4');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `qqid` int(11) DEFAULT NULL,
  `wechatid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`userid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '83001', '0', '');
INSERT INTO `user` VALUES ('2', '50001', '0', '');
