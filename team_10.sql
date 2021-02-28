drop database if exists Team_10;

create database Team_10;

use Team_10;

CREATE TABLE users(user_id int auto_increment key, user_email varchar(30) not null, user_password varchar(265) not null);
 
CREATE TABLE Restaurants(restaurant_id int auto_increment primary key, admin_email varchar(30) not null, admin_password varchar(265) not null, restaurant_location varchar(120) default null, restaurant_name varchar(60) default null, 
restaurant_telephone varchar(13) default null, restaurant_opening_time time, restaurant_closing_time time);

CREATE TABLE menu(menu_id int auto_increment primary key, restaurant_id int, meal_name varchar(30) not null, meal_price int not null, meal_image varchar(120), 
foreign key (restaurant_id) references Restaurants(restaurant_id) on update cascade);

CREATE TABLE orders(order_id int auto_increment primary key, restaurant_id int not null, menu_id int, 
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, user_id int not null , 
foreign key (restaurant_id) references Restaurants(restaurant_id) on update cascade, foreign key (menu_id) references menu(menu_id), 
foreign key (user_id) references users(user_id));

INSERT INTO users(user_email,user_password) VALUES ('user@gmail.com', 'user123');

INSERT INTO Restaurants(admin_email, admin_password) VALUES
("admin@gmail.com","$2y$10$3th3i5qQ1uKlNOsad5kuFOdQ5zgl.ez/4ojVOdBRlxSsqvDH0jz4m");