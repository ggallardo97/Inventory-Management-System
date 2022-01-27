create table Products(
	idProduct serial primary key,
	productname varchar(300) not null,
	description varchar(300) not null,
	image varchar(300),
	price float not null,
	check (price>0),
	stock int not null,
	check(stock>=0),
	deleted date
);

create table Users(
	iduser serial primary key,
	nameus varchar(50) not null,
	username varchar(50) not null,
	userpassword varchar(100) not null,
	email varchar(60) not null,
	deleted date
);

create table Purchases(
	idpurchase serial primary key,
	idprod int not null,
	datepurchase date not null,
	timepurchase time not null,
	amount int not null,
	check (amount>0),
	total float not null,
	check (total>0),
	deleted date,
	constraint IDPRO foreign key (idprod) references PRODUCTS (idproduct)
);

select *
from users;

select *
from products;

select *
from purchases;

insert into PRODUCTS(productname,description,price,stock)values('Pizza','Doble queso',325,10);

