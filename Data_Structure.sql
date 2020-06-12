/*create users, products, cart, history table in mysql*/
/*admin user is marked with "isadmin" attribute, and only admin is allowed to edit/insert product item*/

CREATE TABLE Users(
  username varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  email varchar(100) NOT NULL,
  isadmin tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (username)
);

CREATE TABLE Products(
  title varchar(255) NOT NULL,
  price varchar(255) NOT NULL,
  category varchar(255) NOT NULL,
  inventory int(255) NOT NULL,
  image varchar(255) NOT NULL,
  description varchar(255),
  PRIMARY KEY (title)
);

CREATE TABLE Cart(
  id int(8) NOT NULL AUTO_INCREMENT,
  username varchar(255) NOT NULL,
  title varchar(255) NOT NULL,
  quantity int(255) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (username) REFERENCES Users (username),
  FOREIGN KEY (title) REFERENCES Products (title)
);


CREATE TABLE History(
  id int(8) NOT NULL AUTO_INCREMENT,
  username varchar(255) NOT NULL,
  title varchar(255) NOT NULL,
  quantity int(255) NOT NULL,
  purchase_date datetime default CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  FOREIGN KEY (username) REFERENCES Users (username),
  FOREIGN KEY (title) REFERENCES Products (title)
);

/*
INSERT INTO Products (title, price, category, image, inventory) VALUES ('Glock 17', '$500', 'pistol', 'img/products/glock_17.jpg', 100);
INSERT INTO Products (title, price, category, image, inventory) VALUES ('Glock 19', '$510', 'pistol', 'img/products/glock_19.jpg', 100);
INSERT INTO Products (title, price, category, image, inventory) VALUES ('Glock 26', '$400', 'pistol', 'img/products/glock_26.jpg', 100);
INSERT INTO Products (title, price, category, image, inventory) VALUES ('AK47', '$500', 'machine gun', 'img/products/ak47.jpg', 100);
INSERT INTO Products (title, price, category, image, inventory) VALUES ('M4', '$510', 'machine gun', 'img/products/m4.jpg', 100);
INSERT INTO Products (title, price, category, image, inventory) VALUES ('AR15', '$400', 'machine gun', 'img/products/ar15.jpg', 100);
INSERT INTO Products (title, price, category, image, inventory) VALUES ('1911', '$500', 'pistol', 'img/products/1911.jpg', 100);
INSERT INTO Products (title, price, category, image, inventory) VALUES ('MP5', '$510', 'machine gun', 'img/products/mp5.jpg', 100);
*/
