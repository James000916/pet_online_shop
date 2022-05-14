create table users (
	user_id int(11) AUTO_INCREMENT,
	user_email varchar(50) NOT NULL,
	user_name varchar(50) NOT NULL,
	user_pwd varchar(255) NOT NULL,
	PRIMARY KEY (user_id)
);