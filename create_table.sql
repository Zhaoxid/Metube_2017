create table account (username varchar(30) NOT NULL PRIMARY KEY, password varchar (30));

create table media (filename varchar(40), username varchar(40), type varchar(30), mediaid int NOT NULL AUTO_INCREMENT PRIMARY KEY, path varchar(100), description varchar(1000), title varchar(50));

create table tags(media int NOT NULL, tag varchar(30), tagid int NOT NULL AUTO_INCREMENT PRIMARY KEY);

create table message (message varchar (3000), subj varchar(500), sdusername varchar(40), rcvusername varchar(40),
msgid int NOT NULL AUTO_INCREMENT PRIMARY KEY, ts timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP );

create table contacts (username1 varchar(30), relation varchar (10), username2 varchar(30));

create table comments (cmt varchar (3000), username varchar(30), mediaid int(8), ts timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP );