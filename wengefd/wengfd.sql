/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : wengfd

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-08-11 09:37:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for chatnum
-- ----------------------------
DROP TABLE IF EXISTS `chatnum`;
CREATE TABLE `chatnum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sendid` int(11) DEFAULT NULL COMMENT '发送方id',
  `receiveid` int(11) DEFAULT NULL COMMENT '接收方id',
  `num` int(11) DEFAULT NULL COMMENT '几条新信息',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of chatnum
-- ----------------------------
INSERT INTO `chatnum` VALUES ('4', '1', '10007', '0');
INSERT INTO `chatnum` VALUES ('3', '10007', '1', '3');
INSERT INTO `chatnum` VALUES ('5', '1', '10001', '1');
INSERT INTO `chatnum` VALUES ('6', '10007', '9', '4');
INSERT INTO `chatnum` VALUES ('7', '9', '10007', '0');
INSERT INTO `chatnum` VALUES ('8', '10007', '6', '5');
INSERT INTO `chatnum` VALUES ('9', '6', '10007', '7');
INSERT INTO `chatnum` VALUES ('10', '10017', '10', '1');
INSERT INTO `chatnum` VALUES ('11', '10017', '12', '0');
INSERT INTO `chatnum` VALUES ('12', '12', '10017', '51');
INSERT INTO `chatnum` VALUES ('13', '10007', '12', '0');
INSERT INTO `chatnum` VALUES ('14', '12', '10007', '0');
INSERT INTO `chatnum` VALUES ('15', '10007', '4', '1');
INSERT INTO `chatnum` VALUES ('16', '10007', '3', '4');

-- ----------------------------
-- Table structure for payment
-- ----------------------------
DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` float(10,2) DEFAULT NULL COMMENT '单价',
  `discomsg` varchar(255) DEFAULT NULL COMMENT '优惠名称',
  `discmoney` float(10,2) DEFAULT NULL COMMENT '优惠价格',
  `addmsg` varchar(255) DEFAULT NULL COMMENT '附加费名称',
  `addmoney` float(10,2) DEFAULT NULL COMMENT '附加费价格',
  `total` float(10,2) DEFAULT NULL COMMENT '实收总价',
  `tid` int(11) DEFAULT NULL COMMENT '任务·id',
  `num` float(11,1) DEFAULT NULL COMMENT '数量',
  `calctotal` float(10,2) DEFAULT NULL COMMENT '计算总价',
  `paystatus` tinyint(4) DEFAULT '0' COMMENT '0未付  1 已付',
  `payth` tinyint(255) DEFAULT NULL COMMENT '1支付宝  2paypel',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of payment
-- ----------------------------
INSERT INTO `payment` VALUES ('1', '10.00', '', '0.00', '', '0.00', '30.00', '24', '3.0', '30.00', '1', '1');
INSERT INTO `payment` VALUES ('2', '11.00', '', '11.00', '', '22.00', '70.00', '29', '6.0', '77.00', '1', '2');
INSERT INTO `payment` VALUES ('3', '10.00', '', '0.00', '', '0.00', '95.00', '28', '10.0', '95.00', '1', '2');
INSERT INTO `payment` VALUES ('4', '10.00', '', '0.00', '', '0.00', '400.00', '25', '42.0', '415.00', '1', '2');
INSERT INTO `payment` VALUES ('5', '1.00', '', '0.00', '', '0.00', '8.00', '21', '8.5', '8.50', '0', null);
INSERT INTO `payment` VALUES ('6', '11.00', '', '0.00', '', '0.00', '110.00', '17', '10.5', '115.50', '1', '2');
INSERT INTO `payment` VALUES ('7', '22.00', '', '0.00', '', '0.00', '30.00', '27', '1.5', '33.00', '1', '2');
INSERT INTO `payment` VALUES ('8', '21.00', '', '0.00', '', '0.00', '120.00', '38', '6.0', '126.00', '1', '2');
INSERT INTO `payment` VALUES ('9', '11111.00', '', '0.00', '', '0.00', '2.00', '50', '2.5', '27777.50', '1', '2');

-- ----------------------------
-- Table structure for record
-- ----------------------------
DROP TABLE IF EXISTS `record`;
CREATE TABLE `record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sendid` int(11) DEFAULT NULL COMMENT '发送方id',
  `sendname` varchar(255) DEFAULT NULL COMMENT '方法方姓名',
  `receiveid` int(11) DEFAULT NULL COMMENT '接收方id',
  `receivename` varchar(255) DEFAULT NULL COMMENT '接收方姓名',
  `text` text COMMENT '聊天记录',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of record
-- ----------------------------
INSERT INTO `record` VALUES ('1', '12', '123456', '10007', 'ming', 'hello world！');
INSERT INTO `record` VALUES ('2', '10007', 'ming', '12', '123456', '你好，世界');
INSERT INTO `record` VALUES ('3', '12', '123456', '10007', 'ming', 'qq下线、');
INSERT INTO `record` VALUES ('4', '12', '123456', '10007', 'ming', '111');
INSERT INTO `record` VALUES ('5', '12', '123456', '10007', 'ming', 'feewtw');
INSERT INTO `record` VALUES ('6', '10017', 'sss', '12', '123456', '11111');
INSERT INTO `record` VALUES ('7', '10017', 'sss', '12', '123456', '让爷爷又、、');
INSERT INTO `record` VALUES ('8', '10017', 'sss', '12', '123456', '8');
INSERT INTO `record` VALUES ('9', '10017', 'sss', '12', '123456', '4、');
INSERT INTO `record` VALUES ('10', '10017', 'sss', '12', '123456', 'hh');
INSERT INTO `record` VALUES ('11', '3', '22', '12', '123456', '444');
INSERT INTO `record` VALUES ('12', '10007', 'ming', '12', '123456', 'lh');
INSERT INTO `record` VALUES ('13', '10007', 'ming', '12', '123456', 'hshshjs');
INSERT INTO `record` VALUES ('14', '10017', 'sss', '12', '123456', 'hsaha');
INSERT INTO `record` VALUES ('15', '4', '111', '10007', 'ming', '好几年款，l\'/');
INSERT INTO `record` VALUES ('16', '4', '111', '10007', 'ming', 'ghjkl');
INSERT INTO `record` VALUES ('17', '10007', 'ming', '12', '123456', 'aaa');
INSERT INTO `record` VALUES ('18', '10007', 'ming', '12', '123456', '你vsifafajbff');
INSERT INTO `record` VALUES ('19', '10007', 'ming', '12', '123456', '是否合适爽肤水是否');
INSERT INTO `record` VALUES ('20', '10007', 'ming', '12', '123456', '我确认群若群若群');
INSERT INTO `record` VALUES ('21', '10007', 'ming', '12', '123456', '尴尬地干');
INSERT INTO `record` VALUES ('22', '10007', 'ming', '12', '123456', '啊啊啊噶的噶');
INSERT INTO `record` VALUES ('23', '10007', 'ming', '12', '123456', '大嘎达嘎嘎嘎');
INSERT INTO `record` VALUES ('24', '12', '123456', '10007', 'ming', '大嘎嘎嘎');
INSERT INTO `record` VALUES ('25', '12', '123456', '10007', 'ming', '徐啊啊噶啊哈');
INSERT INTO `record` VALUES ('26', '12', '123456', '10007', 'ming', '法人和生活费上世纪');
INSERT INTO `record` VALUES ('27', '10007', 'ming', '12', '123456', '办法在囊肿呢');
INSERT INTO `record` VALUES ('28', '10007', 'ming', '9', '777', 'dgadgag');
INSERT INTO `record` VALUES ('29', '10007', 'ming', '6', '333', '冻干蛇毒谁敢说');
INSERT INTO `record` VALUES ('30', '12', '123456', '10007', 'ming', 'tqqyqy');
INSERT INTO `record` VALUES ('31', '12', '123456', '10007', 'ming', 'qyqeqyqq');
INSERT INTO `record` VALUES ('32', '12', '123456', '10007', 'ming', 'yqe');
INSERT INTO `record` VALUES ('33', '12', '123456', '10007', 'ming', 'qe');
INSERT INTO `record` VALUES ('34', '12', '123456', '10007', 'ming', 'qy');
INSERT INTO `record` VALUES ('35', '12', '123456', '10007', 'ming', 'q请输入文字...');
INSERT INTO `record` VALUES ('36', '12', '123456', '10007', 'ming', 'yq请输入文字...');
INSERT INTO `record` VALUES ('37', '12', '123456', '10007', 'ming', 'yq');
INSERT INTO `record` VALUES ('38', '12', '123456', '10007', 'ming', 'yq请输入文字...');
INSERT INTO `record` VALUES ('39', '12', '123456', '10007', 'ming', 'yq');
INSERT INTO `record` VALUES ('40', '12', '123456', '10007', 'ming', 'yq');
INSERT INTO `record` VALUES ('41', '12', '123456', '10007', 'ming', 'y请输入文字...');
INSERT INTO `record` VALUES ('42', '12', '123456', '10007', 'ming', 'y请输入文字...');
INSERT INTO `record` VALUES ('43', '12', '123456', '10007', 'ming', 'qy');
INSERT INTO `record` VALUES ('44', '12', '123456', '10007', 'ming', 'qy');
INSERT INTO `record` VALUES ('45', '12', '123456', '10007', 'ming', 'qy');
INSERT INTO `record` VALUES ('46', '12', '123456', '10007', 'ming', 'qyq');
INSERT INTO `record` VALUES ('47', '12', '123456', '10007', 'ming', 'yq');
INSERT INTO `record` VALUES ('48', '12', '123456', '10007', 'ming', 'yq');
INSERT INTO `record` VALUES ('49', '12', '123456', '10007', 'ming', 'yq');
INSERT INTO `record` VALUES ('50', '12', '123456', '10007', 'ming', 'y');
INSERT INTO `record` VALUES ('51', '12', '123456', '10007', 'ming', 'qyq');
INSERT INTO `record` VALUES ('52', '12', '123456', '10007', 'ming', 'yqyq');
INSERT INTO `record` VALUES ('53', '10007', 'ming', '12', '123456', ' 2');
INSERT INTO `record` VALUES ('54', '10007', 'ming', '12', '123456', '感受到工商');
INSERT INTO `record` VALUES ('55', '10007', 'ming', '12', '123456', '时光隧道改');
INSERT INTO `record` VALUES ('56', '10007', 'ming', '3', '22', '11');
INSERT INTO `record` VALUES ('57', '10007', 'ming', '3', '22', '11111111111111111');
INSERT INTO `record` VALUES ('58', '10007', 'ming', '3', '22', '1');
INSERT INTO `record` VALUES ('59', '10007', 'ming', '3', '22', '1111111111');
INSERT INTO `record` VALUES ('60', '10007', 'ming', '3', '22', '1111111');
INSERT INTO `record` VALUES ('61', '10007', 'ming', '3', '22', '1111111111');
INSERT INTO `record` VALUES ('62', '10007', 'ming', '3', '22', '11111111111');
INSERT INTO `record` VALUES ('63', '10007', 'ming', '3', '22', '111111111111111');
INSERT INTO `record` VALUES ('64', '10007', 'ming', '3', '22', '1111111');
INSERT INTO `record` VALUES ('65', '10007', 'ming', '3', '22', '11111');
INSERT INTO `record` VALUES ('66', '10007', 'ming', '3', '22', '11111111');
INSERT INTO `record` VALUES ('67', '10007', 'ming', '3', '22', '1111111');
INSERT INTO `record` VALUES ('68', '10007', 'ming', '3', '22', '1111');
INSERT INTO `record` VALUES ('69', '10007', 'ming', '3', '22', '111');
INSERT INTO `record` VALUES ('70', '10007', 'ming', '3', '22', '111');
INSERT INTO `record` VALUES ('71', '10007', 'ming', '3', '22', '1111');
INSERT INTO `record` VALUES ('72', '10007', 'ming', '3', '22', '11111');
INSERT INTO `record` VALUES ('73', '10007', 'ming', '3', '22', '1');
INSERT INTO `record` VALUES ('74', '10007', 'ming', '9', '777', '7777777777777777');
INSERT INTO `record` VALUES ('75', '10007', 'ming', '3', '22', '身法份趣分期');
INSERT INTO `record` VALUES ('76', '10007', 'ming', '1', 'tedfs', '飞吻发文');
INSERT INTO `record` VALUES ('77', '10007', 'ming', '12', '123456', '千万人群若群若群');
INSERT INTO `record` VALUES ('78', '10007', 'ming', '1', 'tedfs', 'dfsg');

-- ----------------------------
-- Table structure for schedu
-- ----------------------------
DROP TABLE IF EXISTS `schedu`;
CREATE TABLE `schedu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL COMMENT '任务id',
  `sid` int(11) NOT NULL COMMENT '学员id',
  `teid` int(11) NOT NULL COMMENT '老师id',
  `file` varchar(255) DEFAULT NULL COMMENT '上传的文件',
  `number` int(11) DEFAULT NULL COMMENT '第几次上传',
  `check` tinyint(4) DEFAULT '0' COMMENT '1满意  2修改',
  `time` date DEFAULT NULL COMMENT '上传时间',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注 修改意见',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of schedu
-- ----------------------------
INSERT INTO `schedu` VALUES ('1', '29', '10007', '1', '20170612\\91eff.zip', '0', '1', '2017-06-23', null);
INSERT INTO `schedu` VALUES ('5', '28', '10007', '1', '20170612\\14023.zip', '3', '2', '2017-06-12', '1');
INSERT INTO `schedu` VALUES ('2', '28', '10007', '1', '20170612\\36b21.zip', '0', '2', '2017-07-07', '11111');
INSERT INTO `schedu` VALUES ('3', '28', '10007', '1', '20170612\\6ae69.zip', '1', '2', '2017-06-30', '23423562461613562462462462363464');
INSERT INTO `schedu` VALUES ('4', '28', '10007', '1', '20170612\\0f386.zip', '2', '2', '2017-06-12', '45fw6ew4etw4e6w4t4e64w6t4w6et4edvsfghsfshsfsfh');
INSERT INTO `schedu` VALUES ('6', '28', '10007', '1', '20170612\\41928.zip', '4', '2', '2017-06-12', '1111');
INSERT INTO `schedu` VALUES ('7', '17', '10001', '1', '20170616\\db98f.zip', '0', '1', '2017-06-16', null);
INSERT INTO `schedu` VALUES ('8', '25', '10007', '1', '20170619\\0ec85.zip', '0', '1', '2017-06-19', null);
INSERT INTO `schedu` VALUES ('13', '24', '10007', '1', '20170622\\a9f56.zip', '0', '1', '2017-06-22', null);
INSERT INTO `schedu` VALUES ('14', '27', '10007', '3', '20170622\\22208.zip', '0', '1', '2017-06-22', null);
INSERT INTO `schedu` VALUES ('15', '38', '10007', '9', '20170628\\871d7.zip', '0', '2', '2017-06-28', '成本大幅度分公司');
INSERT INTO `schedu` VALUES ('16', '38', '10007', '9', '20170628\\a9d1f.zip', '1', '1', '2017-06-28', null);
INSERT INTO `schedu` VALUES ('17', '50', '10017', '12', '20170701\\cc10b.zip', '0', '2', '2017-07-01', '111111111111');
INSERT INTO `schedu` VALUES ('18', '50', '10017', '12', '20170701\\7059a.zip', '1', '2', '2017-07-01', '什么垃圾玩意');

-- ----------------------------
-- Table structure for student
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '用户名',
  `pass` varchar(255) DEFAULT NULL COMMENT '密码',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `username` varchar(255) DEFAULT NULL COMMENT '姓名',
  `college` varchar(255) DEFAULT NULL COMMENT '院校',
  `tel` varchar(255) DEFAULT NULL COMMENT '电话',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `course` varchar(255) DEFAULT NULL COMMENT '课程领域',
  `msg` varchar(255) DEFAULT NULL COMMENT '课程一      六',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像',
  `regtime` int(11) DEFAULT NULL COMMENT '注册时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=10018 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES ('10001', '11', 'd0970714757783e6cf17b26fb8e2298f', '11@qq.com', '1111', '1111', '111', '1111', '11111', '3', '20170512/b30d6c7eeb984bff12e734a4fcfd8d91.png', null);
INSERT INTO `student` VALUES ('10002', '22', 'd0970714757783e6cf17b26fb8e2298f', '11@qq.com', '', '', '', '', '', '1', null, null);
INSERT INTO `student` VALUES ('10003', '守望', 'd0970714757783e6cf17b26fb8e2298f', '33@qq.com', '', '', '', '', '', '1', null, null);
INSERT INTO `student` VALUES ('10004', '守望1', 'd0970714757783e6cf17b26fb8e2298f', '11@qq.com', '', '', '', '', '', '3', null, null);
INSERT INTO `student` VALUES ('10005', '44', 'd0970714757783e6cf17b26fb8e2298f', '44@qq.com', null, null, null, null, null, null, null, null);
INSERT INTO `student` VALUES ('10006', '123456', 'e10adc3949ba59abbe56e057f20f883e', '420186969@qq.com', '', '', '', '', '', '3', null, null);
INSERT INTO `student` VALUES ('10007', 'ming', 'e10adc3949ba59abbe56e057f20f883e', '123456@qq.com', '', '', '', '', '', '1', '20170512/b30d6c7eeb984bff12e734a4fcfd8d91.png', null);
INSERT INTO `student` VALUES ('10008', '55', 'e10adc3949ba59abbe56e057f20f883e', '55@qq.com', '', '', '', '', '', '1', null, null);
INSERT INTO `student` VALUES ('10009', '66', '2b792dabb4328a140caef066322c49ff', '66@qq.com', null, null, null, null, null, null, null, null);
INSERT INTO `student` VALUES ('10010', '77', '08ef84145b81dcd98554b70c662c41ed', '66@qq.com', null, null, null, null, null, null, null, null);
INSERT INTO `student` VALUES ('10011', '88', '08ef84145b81dcd98554b70c662c41ed', '66@qq.com', null, null, null, null, null, null, null, null);
INSERT INTO `student` VALUES ('10012', '777', 'e10adc3949ba59abbe56e057f20f883e', '11@qq.com', null, null, null, null, null, null, null, null);
INSERT INTO `student` VALUES ('10013', '1111', 'e10adc3949ba59abbe56e057f20f883e', '1111@qq.com', null, null, null, null, null, null, null, null);
INSERT INTO `student` VALUES ('10014', '11111', 'e10adc3949ba59abbe56e057f20f883e', '1111@qq.com', null, null, null, null, null, null, null, null);
INSERT INTO `student` VALUES ('10015', '123', 'e10adc3949ba59abbe56e057f20f883e', '123456@qq.com', '', '', '', '', '', '1', null, null);
INSERT INTO `student` VALUES ('10017', 'sss', 'e10adc3949ba59abbe56e057f20f883e', 'sss@qq.com', '', '', '', '', '', '1', '20170701\\8659f.jpg', null);

-- ----------------------------
-- Table structure for task
-- ----------------------------
DROP TABLE IF EXISTS `task`;
CREATE TABLE `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `tutoty` varchar(255) DEFAULT NULL COMMENT '辅导类型',
  `attafile` varchar(255) DEFAULT NULL COMMENT ' 附属文件',
  `deadtime` varchar(255) DEFAULT NULL COMMENT '截止时间',
  `course` varchar(255) DEFAULT NULL COMMENT '科目  /  领域',
  `zone` tinyint(4) DEFAULT NULL COMMENT '时区',
  `sid` int(11) DEFAULT NULL COMMENT '学员id',
  `teid` int(11) DEFAULT '0' COMMENT '老师id',
  `price` float(10,2) DEFAULT NULL COMMENT '单价',
  `editnum` int(11) DEFAULT NULL COMMENT '修改次数',
  `taskstatus` int(10) DEFAULT NULL COMMENT '任务状态',
  `levscor` tinyint(4) DEFAULT NULL COMMENT '辅导质量',
  `timscor` tinyint(4) DEFAULT NULL COMMENT '守时评分',
  `pj` varchar(255) DEFAULT NULL COMMENT '评价内容',
  `time` int(11) DEFAULT NULL COMMENT '任务完成时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of task
-- ----------------------------
INSERT INTO `task` VALUES ('34', '33homework数学辅导', 'homework', null, '2017年06月22日', '2', '2', '10007', '0', '10.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('35', '33homework数学辅导', 'homework', null, '2017年06月22日', '2', '2', '10007', '0', '10.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('36', '33homework数学辅导', 'homework', null, '2017年06月22日', '2', '2', '10007', '0', '10.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('37', '33homework数学辅导', 'homework', null, '2017年06月22日', '2', '2', '10007', '4', '10.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('38', '33exam英语辅导', 'exam', null, '2017年06月22日', '3', '1', '10007', '9', '21.00', '4', '27', '2', '4', '很好', '1498633976');
INSERT INTO `task` VALUES ('8', '11homework语文辅导', 'homework', null, '2017年05月23日 ', '1', '3', '10001', '3', null, null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('9', '11exam语文辅导', 'homework', null, '2017年05月23日 ', '1', '3', '10001', '5', null, null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('10', '11paper英语辅导', 'homework', 'a:2:{i:0;s:46:\"20170523\\eef8cf344aa45d86e1227d28222e6ba5.docx\";i:1;s:45:\"20170523\\813deb9fdf8da643924be8069f7553b7.xls\";}', '2017年05月23日 ', '2', '1', '10001', '3', null, null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('11', '11exam语文辅导', 'homework', 'a:2:{i:0;s:46:\"20170523\\f9602c308ffcd0982dba57dbe7287b2f.docx\";i:1;s:45:\"20170523\\7a9759dab408afa0444315632738e539.xls\";}', '2017年05月23日 ', '2', '1', '10001', '6', null, null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('12', '11exam语文辅导', 'exam', null, '2017年05月23日 ', '1', '2', '10001', '7', null, null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('13', '11homework语文辅导', 'homework', null, '2017年05月24日 ', '1', '3', '10001', '5', null, null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('14', '11paper英语辅导', 'paper', null, '2017年05月24日 ', '3', '2', '10001', '1', '22.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('15', '11paper英语辅导', 'paper', null, '2017年05月24日 ', '3', '2', '10001', '1', '1.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('16', '11paper英语辅导', 'paper', null, '2017年05月24日 ', '3', '2', '10001', '4', '1.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('17', '11exam英语辅导', 'exam', null, '2017年05月24日 ', '3', '1', '10001', '1', '11.00', '4', '25', null, null, null, '1497605599');
INSERT INTO `task` VALUES ('18', '11exam数学辅导', 'exam', null, '2017年05月25日 ', '2', '3', '10001', '5', '1.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('19', '33homework语文辅导', 'homework', null, '2017年06月02日 ', '1', '2', '10007', '1', '11.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('20', '33exam语文辅导', 'exam', null, '2017年06月02日 ', '1', '2', '10007', '9', '22.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('21', '33homework语文辅导', 'homework', null, '2017年06月03日 ', '1', '1', '10007', '1', '1.00', '4', '2', null, null, null, null);
INSERT INTO `task` VALUES ('22', '33homework语文辅导', 'homework', null, '2017年06月03日 ', '1', '1', '10007', '4', '1.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('23', '33homework语文辅导', 'homework', null, '2017年06月03日 ', '1', '1', '10007', '4', '11.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('24', '33homework语文辅导', 'homework', null, '2017年06月03日 ', '1', '1', '10007', '1', '10.00', '4', '25', null, null, null, '1498114249');
INSERT INTO `task` VALUES ('25', '33homework语文辅导', 'homework', null, '2017年06月03日 ', '1', '1', '10007', '1', '10.00', '4', '27', '3', '5', '你hi好好干已分开过了客户群管理局吧极个别及硅谷1Gigi个六谷歌UI给感觉bvGV和vhj11hvh1v1hj1vj11111', '1498187011');
INSERT INTO `task` VALUES ('26', '33exam数学辅导', 'exam', 'a:3:{i:0;s:10:\"系统.txt\";i:1;s:22:\"新建文本文档.txt\";i:2;s:44:\"需求与缺失的页面及其他-回复.doc\";}', '2017年06月06日', '2', '2', '10007', '5', '22.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('27', '33exam语文辅导', 'exam', 'a:1:{i:0;s:22:\"新建文本文档.txt\";}', '2017年06月06日', '1', '2', '10007', '1', '22.00', '4', '27', '5', '3', '1111111111111111111111111111 11111112222222222222222255555555', '1498124571');
INSERT INTO `task` VALUES ('28', '33homework数学辅导', 'homework', 'a:3:{i:0;s:19:\"20170606\\e03bf.pptx\";i:1;s:18:\"20170606\\02300.txt\";i:2;s:18:\"20170606\\096db.txt\";}', '2017年06月06日', '2', '2', '10007', '1', '10.00', '4', '25', null, null, null, null);
INSERT INTO `task` VALUES ('29', '33homework英语辅导', 'homework', null, '2017年06月06日', '3', '2', '10007', '1', '11.00', '5', '27', '4', '4', '55', '1497605599');
INSERT INTO `task` VALUES ('30', '33homework英语辅导', 'homework', null, '2017年06月06日', '3', '2', '10007', '1', '11.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('31', '33homework数学辅导', 'homework', null, '2017年06月07日', '2', '1', '10007', '1', '10.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('32', '33exam语文辅导', 'exam', null, '2017年06月08日', '1', '1', '10007', '9', '22.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('33', '33paper英语辅导', 'paper', 'a:2:{i:0;s:18:\"20170608\\bdf6e.txt\";i:1;s:18:\"20170608\\865e4.doc\";}', '2017年06月08日', '3', '1', '10007', '10', '20.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('39', '33exam语文辅导', 'exam', null, '2017年06月22日', '1', '1', '10007', '0', '22.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('40', '33exam语文辅导', 'exam', null, '2017年06月22日', '1', '1', '10007', '0', '22.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('41', 'mingexam语文辅导', 'exam', null, '2017年07月28日', '1', '2', '10007', '9', '20.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('42', 'minghomework数学辅导', 'homework', 'a:1:{i:0;s:18:\"20170628\\a5d8c.zip\";}', '2017年06月28日', '2', '3', '10007', '0', '10.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('43', 'minghomework数学辅导', 'homework', null, '2017年06月28日', '2', '2', '10007', '6', '11.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('44', 'minghomework数学辅导', 'homework', null, '2017年06月28日', '2', '2', '10007', '6', '11.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('50', 'ssshomework数学辅导', 'homework', 'a:1:{i:0;s:19:\"20170701\\2ae3a.pptx\";}', '2017年07月01日', '2', '2', '10017', '12', '11111.00', '5', '8', null, null, null, null);
INSERT INTO `task` VALUES ('51', 'minghomework数学辅导', 'homework', null, '2017年07月02日', '2', '1', '10007', '12', '11111.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('52', 'minghomework数学辅导', 'homework', null, '2017年07月02日', '2', '1', '10007', '12', '11111.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('53', 'minghomework数学辅导', 'homework', null, '2017年07月02日', '2', '1', '10007', '12', '11111.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('54', 'minghomework数学辅导', 'homework', null, '2017年07月02日', '2', '1', '10007', '12', '11111.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('55', 'minghomework数学辅导', 'homework', null, '2017年07月02日', '2', '1', '10007', '12', '11111.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('56', 'minghomework数学辅导', 'homework', null, '2017年07月02日', '2', '1', '10007', '12', '11111.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('57', 'minghomework数学辅导', 'homework', null, '2017年07月02日', '2', '1', '10007', '12', '11111.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('58', 'minghomework数学辅导', 'homework', null, '2017年07月02日', '2', '1', '10007', '12', '11111.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('59', 'minghomework数学辅导', 'homework', null, '2017年07月02日', '2', '1', '10007', '12', '11111.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('60', 'minghomework数学辅导', 'homework', null, '2017年07月02日', '2', '1', '10007', '12', '11111.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('61', 'minghomework数学辅导', 'homework', null, '2017年07月02日', '2', '1', '10007', '12', '11111.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('62', 'minghomework数学辅导', 'homework', null, '2017年07月02日', '2', '1', '10007', '12', '11111.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('63', 'minghomework数学辅导', 'homework', null, '2017年07月02日', '2', '1', '10007', '12', '11111.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('64', 'minghomework数学辅导', 'homework', null, '2017年07月03日', '2', '2', '10007', '12', '11111.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('65', 'mingexam语文辅导', 'exam', null, '2017年07月03日', '1', '3', '10007', '0', '22.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('66', 'mingexam语文辅导', 'exam', null, '2017年07月03日', '1', '3', '10007', '0', '22.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('67', 'minghomework数学辅导', 'homework', null, '2017年07月03日', '2', '2', '10007', '12', '11111.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('68', 'minghomework数学辅导', 'homework', null, '2017年07月03日', '2', '2', '10007', '12', '11111.00', null, '1', null, null, null, null);
INSERT INTO `task` VALUES ('69', 'mingpaper数学辅导', 'paper', null, '2017年07月03日', '2', '3', '10007', '3', '22.00', null, '1', null, null, null, null);

-- ----------------------------
-- Table structure for taskstatus
-- ----------------------------
DROP TABLE IF EXISTS `taskstatus`;
CREATE TABLE `taskstatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of taskstatus
-- ----------------------------
INSERT INTO `taskstatus` VALUES ('1', '等待确认接单');
INSERT INTO `taskstatus` VALUES ('2', '等待付款');
INSERT INTO `taskstatus` VALUES ('4', '开始订单');
INSERT INTO `taskstatus` VALUES ('5', '验收订单第一次');
INSERT INTO `taskstatus` VALUES ('6', '修改订单第一次');
INSERT INTO `taskstatus` VALUES ('7', '验收订单第二次');
INSERT INTO `taskstatus` VALUES ('8', '修改订单第二次');
INSERT INTO `taskstatus` VALUES ('9', '验收订单第三次');
INSERT INTO `taskstatus` VALUES ('10', '修改订单第三次');
INSERT INTO `taskstatus` VALUES ('11', '验收订单第四次');
INSERT INTO `taskstatus` VALUES ('12', '修改订单第四次');
INSERT INTO `taskstatus` VALUES ('13', '验收订单第五次');
INSERT INTO `taskstatus` VALUES ('14', '修改订单第五次');
INSERT INTO `taskstatus` VALUES ('15', '验收订单第六次');
INSERT INTO `taskstatus` VALUES ('16', '修改订单第六次');
INSERT INTO `taskstatus` VALUES ('17', '验收订单第七次');
INSERT INTO `taskstatus` VALUES ('18', '修改订单第七次');
INSERT INTO `taskstatus` VALUES ('19', '验收订单第八次');
INSERT INTO `taskstatus` VALUES ('20', '修改订单第八次');
INSERT INTO `taskstatus` VALUES ('21', '验收订单第九次');
INSERT INTO `taskstatus` VALUES ('22', '修改订单第九次');
INSERT INTO `taskstatus` VALUES ('23', '验收订单第十次');
INSERT INTO `taskstatus` VALUES ('24', '修改订单第十次');
INSERT INTO `taskstatus` VALUES ('25', '评价订单');
INSERT INTO `taskstatus` VALUES ('26', '平台介入');
INSERT INTO `taskstatus` VALUES ('27', '订单完成');

-- ----------------------------
-- Table structure for teacher
-- ----------------------------
DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(255) DEFAULT NULL COMMENT '用户名',
  `pass` varchar(255) DEFAULT NULL COMMENT '密码',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `wechat` varchar(255) DEFAULT NULL COMMENT '微信',
  `course` varchar(255) DEFAULT NULL COMMENT '课程领域  科目',
  `levscor` float(255,1) DEFAULT '5.0' COMMENT '水平评分',
  `tiscor` float(255,1) DEFAULT '5.0' COMMENT '守时评分',
  `tutotype` varchar(255) DEFAULT NULL COMMENT '辅导类型序列化',
  `tutoty` varchar(255) DEFAULT NULL COMMENT '辅导类型，用于查询',
  `modifynum` int(11) DEFAULT NULL COMMENT '可接受的修改次数',
  `tasknum` int(11) DEFAULT '0' COMMENT '接单次数',
  `idcard` varchar(255) DEFAULT NULL COMMENT '身份证',
  `degree` varchar(255) DEFAULT NULL COMMENT '学位证或学生卡',
  `monthmon` float(255,2) DEFAULT '0.00' COMMENT '本月收入',
  `allmoney` float(255,2) DEFAULT '0.00' COMMENT '总收入',
  `payaccout` varchar(255) DEFAULT NULL COMMENT '付款账户',
  `is_ok` int(255) DEFAULT '0' COMMENT '是否审核通过 1通过 2 拒绝',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像',
  `college` varchar(255) DEFAULT NULL COMMENT '院校',
  `profess` varchar(255) DEFAULT NULL COMMENT '专业',
  `lasttime` int(255) DEFAULT '0' COMMENT '最后一次收到款项时间',
  `studnum` int(11) DEFAULT '0' COMMENT '辅导过的学生数量',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of teacher
-- ----------------------------
INSERT INTO `teacher` VALUES ('1', 'tedfs', 'e10adc3949ba59abbe56e057f20f883e', '11@qq.com', 'dwewrwr', '3', '3.2', '4.5', 'a:5:{i:1;a:2:{i:0;s:8:\"homework\";i:1;s:2:\"11\";}i:2;a:2:{i:0;s:4:\"exam\";i:1;s:2:\"21\";}i:3;a:2:{i:0;s:2:\"33\";i:1;s:5:\"paper\";}i:4;a:2:{i:0;s:2:\"44\";i:1;s:2:\"44\";}i:5;a:2:{i:0;s:2:\"55\";i:1;s:2:\"55\";}}', ' homework exam 33 44 55', '4', '6', '20170518\\5666faebbd4051bee73487850f968445.jpg', '20170518\\f59baa1013dc4d921d4e514a309d7411.png', '430.00', '540.00', '22222', '1', '20170523/0bd02e9c8c6a84015f8c1f8c20aefbe0.jpg', '北京', '金融', '1497840287', '2');
INSERT INTO `teacher` VALUES ('3', '22', 'e10adc3949ba59abbe56e057f20f883e', '22@qq.com', 'wechat', ' 1 2 3', '5.0', '4.0', 'a:5:{i:1;a:2:{i:0;s:5:\"paper\";i:1;s:2:\"22\";}i:2;a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}i:3;a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}i:4;a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}i:5;a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}}', 'paper', '4', '1', '20170518\\5666faebbd4051bee73487850f968445.jpg', '20170518\\f59baa1013dc4d921d4e514a309d7411.png', '30.00', '30.00', '222222', '1', '20170523/0bd02e9c8c6a84015f8c1f8c20aefbe0.jpg', '清华大学', '经济', '1498124441', '1');
INSERT INTO `teacher` VALUES ('4', '111', 'e10adc3949ba59abbe56e057f20f883e', '11@qq.com', 'dwewrwr', '1 2', '4.9', '5.0', 'a:5:{i:1;a:2:{i:0;s:8:\"homework\";i:1;s:2:\"10\";}i:2;a:2:{i:0;s:4:\"exam\";i:1;s:2:\"22\";}i:3;a:2:{i:0;s:2:\"33\";i:1;s:5:\"paper\";}i:4;a:2:{i:0;s:2:\"44\";i:1;s:2:\"44\";}i:5;a:2:{i:0;s:2:\"55\";i:1;s:2:\"55\";}}', ' homework exam 33 44 55', '4', '0', '20170518\\5666faebbd4051bee73487850f968445.jpg', '20170518\\f59baa1013dc4d921d4e514a309d7411.png', '0.00', '0.00', '22222', '1', '20170523/0bd02e9c8c6a84015f8c1f8c20aefbe0.jpg', '南开', '中学教育', '0', '0');
INSERT INTO `teacher` VALUES ('5', '221', 'e10adc3949ba59abbe56e057f20f883e', '22@qq.com', 'wechat', ' 1 2 3', '4.9', '5.0', 'a:5:{i:1;a:2:{i:0;s:8:\"homework\";i:1;s:2:\"22\";}i:2;a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}i:3;a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}i:4;a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}i:5;a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}}', ' homework', '4', '0', '20170518\\5666faebbd4051bee73487850f968445.jpg', '20170518\\f59baa1013dc4d921d4e514a309d7411.png', '0.00', '0.00', '222222', '1', '20170523/0bd02e9c8c6a84015f8c1f8c20aefbe0.jpg', '长沙理工', '中文', '0', '0');
INSERT INTO `teacher` VALUES ('6', '333', 'e10adc3949ba59abbe56e057f20f883e', '11@qq.com', 'dwewrwr', '1 2', '4.8', '5.0', 'a:5:{i:1;a:2:{i:0;s:8:\"homework\";i:1;s:2:\"11\";}i:2;a:2:{i:0;s:4:\"exam\";i:1;s:2:\"21\";}i:3;a:2:{i:0;s:2:\"33\";i:1;s:5:\"paper\";}i:4;a:2:{i:0;s:2:\"44\";i:1;s:2:\"44\";}i:5;a:2:{i:0;s:2:\"55\";i:1;s:2:\"55\";}}', ' homework exam 33 44 55', '4', '0', '20170518\\5666faebbd4051bee73487850f968445.jpg', '20170518\\f59baa1013dc4d921d4e514a309d7411.png', '0.00', '0.00', '22222', '1', '20170523/0bd02e9c8c6a84015f8c1f8c20aefbe0.jpg', '中南大学', '会计', '0', '0');
INSERT INTO `teacher` VALUES ('7', '444', 'e10adc3949ba59abbe56e057f20f883e', '22@qq.com', 'wechat', ' 1 2 3', '4.8', '5.0', 'a:5:{i:1;a:2:{i:0;s:8:\"homework\";i:1;s:2:\"20\";}i:2;a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}i:3;a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}i:4;a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}i:5;a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}}', ' homework ', '4', '0', '20170518\\5666faebbd4051bee73487850f968445.jpg', '20170518\\f59baa1013dc4d921d4e514a309d7411.png', '0.00', '0.00', '222222', '1', '20170523/0bd02e9c8c6a84015f8c1f8c20aefbe0.jpg', '北大', '金融', '0', '0');
INSERT INTO `teacher` VALUES ('8', '666', 'e10adc3949ba59abbe56e057f20f883e', '11@qq.com', 'dwewrwr', '2', '4.0', '5.0', 'a:5:{i:1;a:2:{i:0;s:8:\"homework\";i:1;s:2:\"11\";}i:2;a:2:{i:0;s:4:\"exam\";i:1;s:2:\"22\";}i:3;a:2:{i:0;s:2:\"33\";i:1;s:5:\"paper\";}i:4;a:2:{i:0;s:2:\"44\";i:1;s:2:\"44\";}i:5;a:2:{i:0;s:2:\"55\";i:1;s:2:\"55\";}}', ' homework exam 33 44 55', '4', '0', '20170518\\5666faebbd4051bee73487850f968445.jpg', '20170518\\f59baa1013dc4d921d4e514a309d7411.png', '0.00', '0.00', '22222', '1', '20170523/0bd02e9c8c6a84015f8c1f8c20aefbe0.jpg', '北京大学', '经济', '0', '0');
INSERT INTO `teacher` VALUES ('9', '777', 'e10adc3949ba59abbe56e057f20f883e', '22@qq.com', 'wechat', ' 1 3', '3.0', '4.5', 'a:5:{i:1;a:2:{i:0;s:4:\"exam\";i:1;s:2:\"20\";}i:2;a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}i:3;a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}i:4;a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}i:5;a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}}', ' exam', '4', '1', '20170518\\5666faebbd4051bee73487850f968445.jpg', '20170518\\f59baa1013dc4d921d4e514a309d7411.png', '120.00', '120.00', '222222', '1', '20170523/0bd02e9c8c6a84015f8c1f8c20aefbe0.jpg', '湖南师范大学', '中学教育', '1498631888', '1');
INSERT INTO `teacher` VALUES ('10', '555555', 'e10adc3949ba59abbe56e057f20f883e', '222@qq.com', '11234', ' 1 2', '1.0', '5.0', 'a:5:{i:1;a:2:{i:0;s:8:\"homework\";i:1;s:2:\"11\";}i:2;a:2:{i:0;s:5:\"paper\";i:1;s:2:\"20\";}i:3;a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}i:4;a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}i:5;a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}}', ' homework paper   ', '4', '0', null, null, '0.00', '0.00', '121123242', '1', '20170523/0bd02e9c8c6a84015f8c1f8c20aefbe0.jpg', '湖师大', '会计', '0', '0');
INSERT INTO `teacher` VALUES ('11', 'qqq', 'e10adc3949ba59abbe56e057f20f883e', '42@qq.com', 'qqqqqq', ' 1 2', '5.0', '5.0', 'a:5:{i:1;a:2:{i:0;s:8:\"homework\";i:1;s:5:\"11111\";}i:2;a:2:{i:0;s:4:\"exam\";i:1;s:4:\"2222\";}i:3;a:2:{i:0;s:5:\"paper\";i:1;s:4:\"3333\";}i:4;a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}i:5;a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}}', ' homework exam paper  ', '4', '0', '20170524\\1ad30151f838ee74768c09990f80a430.jpg', '20170524\\f979de19402c0ac205fbfea0969738a8.jpg', '0.00', '0.00', 'wwww', '0', '20170524/489a59fc534b6fba0041b31c6a8ac263.jpg', '北大', '中文', '0', '0');
INSERT INTO `teacher` VALUES ('12', '123456', 'e10adc3949ba59abbe56e057f20f883e', '123@qq.com', '', '2 3', '5.0', '5.0', 'a:5:{i:1;a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}i:2;a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}i:3;a:2:{i:0;s:8:\"homework\";i:1;s:5:\"11111\";}i:4;a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}i:5;a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}}', ' homework', '7', '0', null, null, '4.00', '4.00', '', '1', '20170621/aaae5.jpg', '', '', '1498912785', '0');
