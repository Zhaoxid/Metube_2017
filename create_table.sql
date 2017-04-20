create table account (username varchar(30) NOT NULL PRIMARY KEY, password varchar (30));

create table media (
	filename varchar(40),
	username varchar(30),
	type varchar(30),
	mediaid int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	path varchar(100),
	description varchar(1000),
	title varchar(50),
	views int NOT NULL,
	FOREIGN KEY(username) REFERENCES account(username)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

create table tags(
	mediaid int NOT NULL,
	tag varchar(30),
	tagid int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	FOREIGN KEY(mediaid) REFERENCES media(mediaid)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

create table message (
	message varchar (3000),
	subj varchar(500),
	sdusername varchar(30),
	rcvusername varchar(30),
	msgid int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	ts timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY(sdusername) REFERENCES account(username)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY(rcvusername) REFERENCES account(username)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

create table contacts (
	username1 varchar(30),
	relation varchar (10),
	username2 varchar(30),
	FOREIGN KEY(username1) REFERENCES account(username)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY(username2) REFERENCES account(username)
		ON DELETE CASCADE
		ON UPDATE CASCADE		
);

create table comments (
	cmt varchar (3000),
	username varchar(30),
	mediaid int NOT NULL,
	ts timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY(username) REFERENCES account(username)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY(mediaid) REFERENCES media(mediaid)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

create table playlist_user (
	playlistname varchar(50),
	username varchar (30),
	playlistid int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	FOREIGN KEY(username) REFERENCES account(username)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

create table playlist_media (
	playlistid int NOT NULL,
	mediaid int NOT NULL,
	FOREIGN KEY(playlistid) REFERENCES playlist_user(playlistid)
		ON DELETE CASCADE
    ON UPDATE CASCADE,
	FOREIGN KEY(mediaid) REFERENCES media(mediaid)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);