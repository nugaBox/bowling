-- --------------------------------------------------------
-- 호스트:                          192.168.1.6
-- 서버 버전:                        Microsoft SQL Server 2012 (SP1) - 11.0.3156.0
-- 서버 OS:                        Windows NT 6.1 <X64> (Build 7601: Service Pack 1)
-- HeidiSQL 버전:                  10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES  */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- first 데이터베이스 구조 내보내기
CREATE DATABASE IF NOT EXISTS "first";
USE "first";

-- 테이블 first.NGJANG_MASTER 구조 내보내기
CREATE TABLE IF NOT EXISTS "NGJANG_MASTER" (
	"seq" INT(10,0) NOT NULL,
	"firstPlayer" NVARCHAR(50) NULL DEFAULT NULL COMMENT '',
	"pinstatus" NVARCHAR(50) NULL DEFAULT NULL COMMENT '',
	"gameStatus" NVARCHAR(50) NULL DEFAULT NULL,
	"userNumber" INT(10,0) NULL DEFAULT NULL,
	"startDate" DATETIME(3) NULL DEFAULT NULL,
	"endDate" DATETIME(3) NULL DEFAULT NULL
);

-- 테이블 데이터 first.NGJANG_MASTER:-1 rows 내보내기
/*!40000 ALTER TABLE "NGJANG_MASTER" DISABLE KEYS */;
INSERT INTO "NGJANG_MASTER" ("seq", "firstPlayer", "pinstatus", "gameStatus", "userNumber", "startDate", "endDate") VALUES
	(10, '헤즐베이커', '1_11_2', 'Y', 1, '2018-10-10 11:34:38.173', '2018-10-10 11:34:51.960'),
	(11, '유재신', '1_1_2', 'N', 3, '2018-11-05 11:37:53.993', '2018-11-05 11:37:57.283'),
	(21, '김기태', '1_10_2', 'N', 3, '2019-04-19 11:59:01.217', '2019-05-13 11:41:13.760'),
	(1, '장누가', '1_11_3', 'Y', 1, '2018-04-19 11:22:31.173', '2018-04-19 11:22:36.960'),
	(6, '서동욱', '2_11_3', 'Y', 2, '2018-08-21 11:30:37.850', '2018-08-21 11:31:30.377'),
	(7, '최정민', '4_11_3', 'Y', 4, '2018-09-12 11:32:04.177', '2018-09-12 11:32:09.973'),
	(8, '오선우', '1_11_3', 'Y', 1, '2018-09-30 11:32:27.497', '2018-09-30 11:32:34.147'),
	(9, '류승현', '1_8_1', 'N', 4, '2018-10-10 11:33:29.053', '2018-10-10 11:40:32.430'),
	(12, '나지완', '1_9_1', 'N', 1, '2018-11-07 11:41:38.550', '2018-11-07 11:41:45.440'),
	(13, '최형우', '2_11_3', 'Y', 2, '2018-12-25 11:42:04.380', '2018-12-25 11:42:11.553'),
	(14, '이명기', '6_11_3', 'Y', 6, '2019-01-01 02:42:52.520', '2019-01-01 11:45:39.250'),
	(15, '전은석', '3_11_3', 'Y', 3, '2019-01-12 11:46:19.463', '2019-01-12 11:46:34.773'),
	(16, '백용환', '1_1_1', 'N', 2, '2019-02-11 11:51:26.353', '2019-02-11 11:51:26.353'),
	(17, '김민식', '1_1_2', 'N', 1, '2019-02-19 11:51:40.650', '2019-02-19 11:51:48.233'),
	(18, '한승택', '4_10_1', 'N', 4, '2019-03-19 11:52:13.230', '2019-05-13 11:26:23.997'),
	(19, '양현종', '4_11_3', 'Y', 4, '2019-03-20 11:52:49.607', '2019-03-20 11:52:58.250'),
	(20, '이종범', '2_11_3', 'Y', 2, '2019-04-19 11:54:25.430', '2019-04-19 11:55:55.170'),
	(2, '오정환', '3_11_3', 'Y', 3, '2018-06-18 11:27:59.657', '2018-06-18 11:28:03.877'),
	(3, '김선빈', '2_11_3', 'Y', 2, '2018-07-20 11:28:21.937', '2018-07-20 11:28:25.267'),
	(4, '안치홍', '5_11_3', 'Y', 5, '2018-07-31 11:29:33.093', '2018-07-31 11:29:38.037'),
	(5, '김주찬', '1_11_3', 'Y', 1, '2018-08-05 11:30:06.893', '2018-08-05 11:30:10.337'),
	(22, '서재응', '1_1_1', 'N', 6, '2019-05-12 18:26:33.427', '2019-05-12 18:26:33.427'),
	(23, '플레이어1', '3_11_3', 'Y', 3, '2019-05-12 22:23:59.480', '2019-05-12 22:27:56.917'),
	(24, '장누가', '2_11_3', 'Y', 2, '2019-05-13 11:22:46.573', '2019-05-13 15:11:02.733');
/*!40000 ALTER TABLE "NGJANG_MASTER" ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
