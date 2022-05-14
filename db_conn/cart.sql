create table cart (

	cart_id int(11) AUTO_INCREMENT,

	user_email varchar(50) NOT NULL,

	product_id int(11) NOT NULL,

	product_name varchar(50) NOT NULL,

	quantity int(11) NOT NULL,

	price FLOAT(11) NOT NULL,

	PRIMARY KEY (cart_id)

);