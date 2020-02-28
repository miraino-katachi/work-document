CREATE DATABASE `php_work`;

USE `php_work`;

CREATE TABLE `users` (
	`id` INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL,
	`email` VARCHAR(256) NOT NULL,
	`password` VARCHAR(256) NOT NULL,
	`is_admin` TINYINT NOT NULL DEFAULT 0,
	`gender` TINYINT NOT NULL DEFAULT 9,
	`pref` VARCHAR(10) NOT NULL,
	`tel` VARCHAR(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`,`name`,`email`,`password`,`is_admin`,`gender`,`pref`,`tel`) VALUES (1,'ちえみ','chiemi@sample.jp','password',1,2,'大阪','000-123-4567'),
 (2,'花子','hanako@sample.jp','password',0,2,'京都','000-000-0000'),
 (3,'次郎','jiro@sample.co.jp','password',0,1,'奈良','000-000-0000'),
 (4,'順子','junko@sample.co.jp','password',0,2,'兵庫','000-000-0000'),
 (5,'桃子','momoko@sample.co.jp','password',0,2,'和歌山','000-000-0000'),
 (6,'司','tsukasa@sample.co.jp','password',0,1,'京都','000-000-0000'),
 (7,'涼子','ryoko@sample.co.jp','password',0,2,'兵庫','000-000-0000'),
 (8,'小百合','sayuri@sample.co.jp','password',0,2,'大阪','06-0000-0000'),
 (9,'典子','noriko@sample.co.jp','password',0,2,'大阪','06-0000-0000'),
 (10,'武蔵','musashi@sample.jp','password',0,2,'奈良','000-000-0000'),
 (11,'小次郎','kojiro@sample.jp','password',0,1,'和歌山','03-0000-0000'),
 (12,'ニャース','nyasu@sample.jp','password',0,1,'京都','000-000-0000'),
 (13,'今日子','kyoko@sample.jp','password',0,2,'兵庫','000-000-0000'),
 (14,'はるか','haruka@sample.jp','password',0,2,'和歌山','03-0000-0000'),
 (15,'千里','chisato@sample.jp','password',0,2,'奈良','000-123-4567');
