CREATE TABLE `admins` (
	`admin_id` INT(10) NOT NULL AUTO_INCREMENT,
	`pseudo_admin` varchar(50),
	`pass_admin` TEXT,
	PRIMARY KEY (`admin_id`)
);

CREATE TABLE `users` (
	`user_id` INT(10) NOT NULL AUTO_INCREMENT,
	`pseudo` varchar(50),
	`mail` TEXT,
	`password` TEXT,
	PRIMARY KEY (`user_id`)
);

CREATE TABLE `articles` (
	`art_id` INT(10) NOT NULL AUTO_INCREMENT,
	`category` TEXT,
	`title` TEXT,
	`content` TEXT,
	`dateEdit` TIMESTAMP,
	`idImg` INT(10),
	PRIMARY KEY (`art_id`)
);

CREATE TABLE `comments` (
	`comment_id` INT(10) NOT NULL AUTO_INCREMENT,
	`contentComment` TEXT(10),
	`idUser` INT(10),
	`idArticle` INT(10),
	`dateComment` TIMESTAMP,
	PRIMARY KEY (`comment_id`)
);

CREATE TABLE `images` (
	`img_id` INT(10) NOT NULL AUTO_INCREMENT,
	`titleImg` TEXT,
	`img` TEXT,
	PRIMARY KEY (`img_id`)
);

CREATE TABLE `details` (
	`detail_id` INT(10) NOT NULL AUTO_INCREMENT,
	`subtitle` TEXT,
	`subcontent` TEXT,
	`idBlogArt` INT(10),
	PRIMARY KEY (`detail_id`)
);

ALTER TABLE `articles` ADD CONSTRAINT `articles_fk0` FOREIGN KEY (`idImg`) REFERENCES `images`(`img_id`);

ALTER TABLE `comments` ADD CONSTRAINT `comments_fk0` FOREIGN KEY (`idUser`) REFERENCES `users`(`user_id`);

ALTER TABLE `comments` ADD CONSTRAINT `comments_fk1` FOREIGN KEY (`idArticle`) REFERENCES `articles`(`art_id`);

ALTER TABLE `details` ADD CONSTRAINT `details_fk0` FOREIGN KEY (`idBlogArt`) REFERENCES `articles`(`art_id`);

