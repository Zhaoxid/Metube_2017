create table account (username varchar(30) NOT NULL PRIMARY KEY, password varchar (30));

create table media (filename varchar(40), username varchar(40), type varchar(30), mediaid int NOT NULL AUTO_INCREMENT PRIMARY KEY, path varchar(100));

create table message (message varchar (3000), subj varchar(500), sdusername varchar(40), rcvusername varchar(40), msgid int NOT NULL AUTO_INCREMENT PRIMARY KEY, ts timestamp NOT NULL);


