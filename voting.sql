-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 09 月 17 日 20:35
-- 服务器版本: 5.0.90-community-nt
-- PHP 版本: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `voting`
--

-- --------------------------------------------------------

--
-- 表的结构 `count_voting`
--

DROP TABLE IF EXISTS `count_voting`;
CREATE TABLE IF NOT EXISTS `count_voting` (
  `SelectName` varchar(40) NOT NULL,
  `LabelName` varchar(40) NOT NULL,
  `CountVotes` bigint(20) unsigned NOT NULL,
  UNIQUE KEY `SelectName` (`SelectName`),
  KEY `CountVotes` (`CountVotes`),
  KEY `CountVotes_2` (`CountVotes`),
  KEY `CountVotes_3` (`CountVotes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='投票统计表';

-- --------------------------------------------------------

--
-- 表的结构 `ip_votes`
--

DROP TABLE IF EXISTS `ip_votes`;
CREATE TABLE IF NOT EXISTS `ip_votes` (
  `ID` bigint(20) unsigned NOT NULL auto_increment COMMENT '投票人序号：自增',
  `IP` varchar(15) NOT NULL COMMENT '投票人IP',
  `Location` varchar(40) NOT NULL COMMENT '投票人位置',
  `VoteTime` datetime NOT NULL,
  `SelectName` varchar(40) NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `ID` (`ID`),
  KEY `SelectName` (`SelectName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 触发器 `ip_votes`
--
DROP TRIGGER IF EXISTS `vote_count_after_insert_tr`;
DELIMITER //
CREATE TRIGGER `vote_count_after_insert_tr` AFTER INSERT ON `ip_votes`
 FOR EACH ROW UPDATE count_voting SET CountVotes = CountVotes + 1 WHERE SelectName = NEW.SelectName
//
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `name` varchar(10) NOT NULL COMMENT '管理员用户名',
  `passwd` char(32) NOT NULL COMMENT '登录密码MD5值'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';


--
-- 表的结构 `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(500) DEFAULT NULL,
  `images` varchar(500) DEFAULT NULL,
  `content` text,
  `num` varchar(100) DEFAULT '0',
  `name` varchar(100) DEFAULT NULL,
  `insidepages` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `content`
--

INSERT INTO `content` (`id`, `type`, `images`, `content`, `num`, `name`, `insidepages`) VALUES
(1, 'aaa', '/volunteers/', '这个是描述', '30', '<span style="color:#ff9900;">辛丹华</span><br />', '<p><span style="color:#ff0000;">这里是内页的内容</span></p><p>可以换行，<strong>字体可以随意改变</strong>，<em><span style="color:#cc33cc;">字体颜色也可以</span></em></p><p>放个图片都没问题，就类似文章系统</p><p><img src="upload/day_150319/201503191613348278.jpg" alt="" style="width: 100%;" /><br /></p><p><strong><span style="font-size:24px;">图片需要全屏的填写宽度为100%</span></strong></p>'),
(7, 'bbb', '/volunteers/', '测试下下', '234', '测试下下', ''),
(3, 'ccc', '/volunteers/', '国内外知名', '16', '叶知秋<br />', ''),
(6, 'ddd', '/volunteers/', '测试下下', '327', '测试下下', ''),
(4, 'eee', '/volunteers/', '这里是描述', '50', '张三', '这是内页的内容'),
(5, 'fff', '/volunteers/', '这是李四的描述', '17', '李四', '这是内页');

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`name`, `passwd`) VALUES
('root', '2d56df9a08100634d51940309237855d');

--
-- 限制导出的表
--

--
-- 限制表 `ip_votes`
--
ALTER TABLE `ip_votes`
  ADD CONSTRAINT `ip_votes_ibfk_1` FOREIGN KEY (`SelectName`) REFERENCES `count_voting` (`SelectName`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
