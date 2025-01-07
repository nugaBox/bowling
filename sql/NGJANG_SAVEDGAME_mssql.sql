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

-- 테이블 first.NGJANG_SAVEDGAME 구조 내보내기
CREATE TABLE IF NOT EXISTS "NGJANG_SAVEDGAME" (
	"seq" INT(10,0) NOT NULL,
	"gseq" INT(10,0) NULL DEFAULT NULL COMMENT '',
	"playerName" NVARCHAR(50) NULL DEFAULT NULL,
	"ball_1_1" INT(10,0) NULL DEFAULT NULL,
	"ball_1_2" INT(10,0) NULL DEFAULT NULL,
	"ball_2_1" INT(10,0) NULL DEFAULT NULL,
	"ball_2_2" INT(10,0) NULL DEFAULT NULL,
	"ball_3_1" INT(10,0) NULL DEFAULT NULL,
	"ball_3_2" INT(10,0) NULL DEFAULT NULL,
	"ball_4_1" INT(10,0) NULL DEFAULT NULL,
	"ball_4_2" INT(10,0) NULL DEFAULT NULL,
	"ball_5_1" INT(10,0) NULL DEFAULT NULL,
	"ball_5_2" INT(10,0) NULL DEFAULT NULL,
	"ball_6_1" INT(10,0) NULL DEFAULT NULL,
	"ball_6_2" INT(10,0) NULL DEFAULT NULL,
	"ball_7_1" INT(10,0) NULL DEFAULT NULL,
	"ball_7_2" INT(10,0) NULL DEFAULT NULL,
	"ball_8_1" INT(10,0) NULL DEFAULT NULL,
	"ball_8_2" INT(10,0) NULL DEFAULT NULL,
	"ball_9_1" INT(10,0) NULL DEFAULT NULL,
	"ball_9_2" INT(10,0) NULL DEFAULT NULL,
	"ball_10_1" INT(10,0) NULL DEFAULT NULL,
	"ball_10_2" INT(10,0) NULL DEFAULT NULL,
	"ball_10_3" INT(10,0) NULL DEFAULT NULL,
	"score" INT(10,0) NULL DEFAULT NULL COMMENT '',
	"hdp" INT(10,0) NULL DEFAULT ((0)),
	"total" INT(10,0) NULL DEFAULT NULL COMMENT '',
	PRIMARY KEY ("seq")
);

-- 테이블 데이터 first.NGJANG_SAVEDGAME:-1 rows 내보내기
/*!40000 ALTER TABLE "NGJANG_SAVEDGAME" DISABLE KEYS */;
INSERT INTO "NGJANG_SAVEDGAME" ("seq", "gseq", "playerName", "ball_1_1", "ball_1_2", "ball_2_1", "ball_2_2", "ball_3_1", "ball_3_2", "ball_4_1", "ball_4_2", "ball_5_1", "ball_5_2", "ball_6_1", "ball_6_2", "ball_7_1", "ball_7_2", "ball_8_1", "ball_8_2", "ball_9_1", "ball_9_2", "ball_10_1", "ball_10_2", "ball_10_3", "score", "hdp", "total") VALUES
	(570, 1, '장누가', 10, 0, 8, 0, 9, 0, 9, 1, 3, 1, 4, 5, 4, 0, 0, NULL, 2, 1, 1, 1, NULL, 70, 0, 70),
	(571, 2, '오정환', 8, 2, 10, 0, 0, NULL, 10, 0, 3, 2, 0, NULL, 4, 6, 0, NULL, 3, 0, 6, 1, NULL, 70, 0, 70),
	(572, 2, '최원준', 10, 0, 9, 1, 7, 1, 4, 3, 10, 0, 5, 4, 9, 0, 0, NULL, 0, NULL, 10, 9, 1, 109, 50, 159),
	(573, 2, '황윤호', 0, NULL, 6, 3, 4, 0, 7, 0, 1, 4, 8, 2, 0, NULL, 10, 0, 7, 3, 0, 5, NULL, 70, 0, 70),
	(574, 3, '김선빈', 5, 0, 9, 0, 5, 2, 5, 2, 1, 7, 2, 4, 0, NULL, 3, 4, 8, 1, 7, 0, NULL, 65, 0, 65),
	(575, 3, '박찬호', 9, 1, 2, 4, 1, 9, 2, 8, 9, 0, 1, 2, 6, 3, 1, 2, 5, 2, 2, 8, 2, 92, 0, 92),
	(576, 4, '안치홍', 4, 6, 1, 4, 0, NULL, 7, 2, 0, NULL, 5, 1, 8, 2, 9, 0, 8, 1, 6, 0, NULL, 74, 0, 74),
	(577, 4, '홍재호', 4, 4, 6, 1, 10, 0, 8, 1, 0, NULL, 10, 0, 8, 2, 1, 7, 2, 6, 7, 1, NULL, 98, 0, 98),
	(578, 4, '윤해진', 1, 6, 1, 9, 9, 1, 1, 4, 0, NULL, 1, 1, 3, 0, 1, 2, 5, 0, 5, 3, NULL, 63, 0, 63),
	(579, 4, '황대인', 5, 0, 3, 7, 7, 3, 1, 8, 4, 1, 4, 3, 7, 1, 9, 1, 4, 0, 4, 4, NULL, 88, 30, 118),
	(580, 4, '이창진', 2, 0, 10, 0, 4, 1, 7, 0, 5, 1, 9, 0, 6, 2, 4, 6, 8, 0, 10, 6, 1, 95, 30, 125),
	(581, 5, '김주찬', 10, NULL, 10, NULL, 10, NULL, 10, NULL, 10, NULL, 10, NULL, 10, NULL, 10, NULL, 10, NULL, 10, 10, 10, 300, 0, 300),
	(582, 6, '서동욱', 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 150, 0, 150),
	(583, 6, '최정민', 4, 3, 2, 1, 10, NULL, 6, 1, 7, 3, 10, NULL, 2, 1, 10, NULL, 4, 0, 10, 2, 0, 100, 0, 100),
	(584, 7, '최정민', 1, 0, 8, 2, 1, 5, 3, 5, 6, 3, 2, 8, 4, 1, 2, 2, 8, 0, 2, 3, NULL, 71, 50, 121),
	(585, 7, '이범호', 4, 6, 8, 1, 0, NULL, 2, 2, 10, 0, 3, 5, 8, 1, 5, 1, 3, 3, 2, 8, 8, 96, 0, 96),
	(586, 7, '김주형', 10, 0, 5, 5, 6, 2, 6, 1, 4, 1, 2, 4, 7, 2, 8, 2, 0, NULL, 2, 6, NULL, 89, 0, 89),
	(587, 7, '김석환', 0, NULL, 0, NULL, 9, 0, 7, 3, 10, 0, 9, 1, 0, NULL, 6, 3, 10, 0, 8, 2, 2, 100, 0, 100),
	(588, 8, '오선우', 0, NULL, 0, NULL, 1, 1, 5, 3, 0, NULL, 9, 1, 7, 0, 8, 1, 2, 2, 3, 7, 10, 67, 0, 67),
	(589, 9, '류승현', 0, NULL, 7, 0, 7, 3, 10, 0, 1, 4, 7, 0, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 63, 0, 63),
	(590, 9, '문장은', 10, 0, 6, 4, 8, 0, 7, 0, 8, 1, 5, 5, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 79, 0, 79),
	(591, 9, '김창용', 3, 2, 7, 3, 10, 0, 10, 0, 2, 6, 3, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, 30, 108),
	(592, 9, '박진두', 2, 8, 3, 5, 10, 0, 1, 7, 5, 0, 3, 7, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 73, 50, 123),
	(593, 10, '헤즐베이커', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0),
	(594, 11, '유재신', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 0, 5),
	(595, 11, '이인행', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
	(596, 11, '문선재', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
	(597, 12, '나지완', 10, NULL, 10, NULL, 10, NULL, 10, NULL, 10, NULL, 10, NULL, 10, NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL, 210, 0, 210),
	(598, 13, '최형우', 10, 0, 5, 0, 3, 6, 10, 0, 4, 4, 4, 2, 10, 0, 3, 1, 6, 3, 6, 3, NULL, 97, 0, 97),
	(599, 13, '유민상', 9, 0, 0, NULL, 9, 0, 0, NULL, 2, 2, 8, 0, 10, 0, 2, 1, 2, 8, 5, 2, NULL, 68, 0, 68),
	(600, 14, '이명기', 5, 2, 5, 3, 0, NULL, 10, 0, 8, 2, 2, 2, 1, 1, 4, 5, 4, 5, 6, 3, NULL, 80, 0, 80),
	(601, 14, '박준태', 1, 5, 8, 1, 9, 1, 5, 4, 8, 1, 9, 0, 9, 1, 3, 0, 1, 3, 1, 3, NULL, 81, 0, 81),
	(602, 14, '이은총', 10, 0, 6, 3, 2, 5, 1, 1, 1, 0, 3, 6, 0, NULL, 5, 5, 9, 1, 6, 3, NULL, 91, 0, 91),
	(603, 14, '이상호', 5, 2, 4, 0, 4, 4, 1, 4, 8, 1, 7, 3, 7, 1, 6, 2, 10, 0, 4, 0, NULL, 84, 50, 134),
	(604, 14, '이준호', 9, 0, 3, 0, 1, 1, 8, 2, 4, 3, 5, 1, 7, 1, 9, 1, 9, 1, 8, 2, 3, 99, 50, 149),
	(605, 14, '신재왕', 4, 2, 10, 0, 9, 0, 1, 4, 10, 0, 4, 1, 1, 1, 6, 2, 6, 3, 7, 2, NULL, 87, 50, 137),
	(606, 15, '전은석', 0, NULL, 4, 0, 2, 7, 1, 4, 7, 0, 10, 0, 3, 6, 4, 6, 5, 1, 1, 1, NULL, 76, 0, 76),
	(607, 15, '김민수', 9, 0, 2, 6, 7, 3, 10, 0, 5, 4, 7, 0, 10, 0, 3, 7, 3, 3, 9, 1, 1, 122, 0, 122),
	(608, 15, '박수용', 8, 1, 10, 0, 6, 2, 8, 1, 0, NULL, 3, 6, 0, NULL, 0, NULL, 8, 2, 9, 1, 0, 82, 50, 132),
	(609, 16, '백용환', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
	(610, 16, '신범수', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
	(611, 17, '김민식', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1),
	(612, 18, '한승택', 0, NULL, 2, 5, 10, 0, 9, 1, 10, 0, 9, 1, 4, 2, 7, 1, 10, 0, 5, 1, NULL, 117, 0, 117),
	(613, 18, '한준수', 4, 3, 10, 0, 0, NULL, 4, 3, 8, 0, 3, 7, 4, 0, 10, 0, 7, 2, 3, 5, NULL, 86, 0, 86),
	(614, 18, '이진경', 5, 0, 2, 1, 1, 8, 3, 2, 4, 1, 1, 5, 1, 3, 9, 0, 7, 3, 5, 4, NULL, 70, 0, 70),
	(615, 18, '박정우', 1, 9, 1, 1, 8, 0, 2, 6, 4, 0, 0, NULL, 9, 1, 4, 4, 7, 3, NULL, NULL, NULL, 65, 0, 65),
	(616, 19, '양현종', 7, 2, 5, 4, 9, 0, 7, 1, 8, 2, 3, 3, 7, 0, 5, 3, 4, 3, 5, 2, NULL, 83, 0, 83),
	(617, 19, '임기영', 4, 2, 3, 7, 3, 6, 2, 4, 8, 2, 5, 3, 9, 0, 5, 4, 1, 7, 9, 0, NULL, 92, 0, 92),
	(618, 19, '임기준', 4, 5, 7, 3, 9, 0, 0, NULL, 1, 7, 4, 1, 2, 2, 9, 0, 7, 3, 4, 4, NULL, 85, 0, 85),
	(619, 19, '윤석민', 9, 1, 9, 1, 1, 2, 4, 5, 7, 2, 8, 2, 8, 1, 10, 0, 0, NULL, 7, 1, NULL, 96, 0, 96),
	(620, 20, '이종범', 10, NULL, 10, NULL, 10, NULL, 10, NULL, 5, 3, 10, NULL, 10, NULL, 10, NULL, 10, NULL, 10, 10, 10, 261, 50, 300),
	(621, 20, '선동열', 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 150, 0, 150),
	(622, 21, '김기태', 1, 7, 3, 5, 0, NULL, 5, 3, 10, 0, 8, 2, 0, NULL, 2, 5, 0, NULL, 3, NULL, NULL, 64, 0, 64),
	(623, 21, '김상수', 8, 2, 5, 1, 0, NULL, 10, 0, 8, 0, 2, 0, 5, 4, 2, 0, 0, NULL, NULL, NULL, NULL, 60, 0, 60),
	(624, 21, '이대진', 1, 6, 4, 2, 1, 1, 2, 8, 4, 3, 5, 4, 1, 0, 2, 8, 3, 0, NULL, NULL, NULL, 62, 0, 62),
	(625, 22, '서재응', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
	(626, 22, '플레이어2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
	(627, 22, '플레이어3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
	(628, 22, '플레이어4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
	(629, 22, '플레이어5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
	(630, 22, '플레이어6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
	(631, 23, '플레이어1', 10, NULL, 10, NULL, 10, NULL, 10, NULL, 10, NULL, 10, NULL, 10, NULL, 10, NULL, 10, NULL, 10, 5, 5, 285, 0, 285),
	(632, 23, '플레이어2', 4, 6, 3, 2, 3, 0, 5, 5, 4, 2, 6, 3, 5, 5, 10, NULL, 7, 3, 10, 10, 10, 140, 50, 190),
	(633, 23, '플레이어3', 4, 2, 3, 1, 6, 1, 3, 2, 1, 0, 1, 8, 7, 2, 3, 7, 3, 7, 4, 6, 3, 81, 0, 81),
	(634, 24, '장누가', 8, 2, 0, NULL, 4, 4, 2, 0, 3, 4, 5, 3, 4, 6, 3, 4, 5, 3, 7, 1, NULL, 71, 30, 101),
	(635, 24, '플레이어2', 5, 1, 5, 1, 9, 0, 0, NULL, 3, 0, 3, 6, 7, 1, 9, 1, 6, 4, 7, 3, 5, 89, 0, 89);
/*!40000 ALTER TABLE "NGJANG_SAVEDGAME" ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
