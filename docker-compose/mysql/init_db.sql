/*USE pastryshop;

CREATE TABLE IF NOT EXISTS client (
	client_id integer not null auto_increment primary key,
	name varchar(40) not null,
	email varchar(20) not null,
	date_birth char(10) not null,
	address varchar(100) not null,
	complement varchar(100) not null,
	neighborhood varchar(40) not null,
	cep char(9) not null,
	date_entry date not null
);

CREATE TABLE IF NOT EXISTS product (
	product_id integer not null auto_increment primary key,
	name varchar(40) not null,
	price  decimal(12.2) not null,
	photo varchar(50) not null
);
CREATE TABLE IF NOT EXISTS purchase (
	purchase_id integer not null auto_increment primary key,
	client_id integer,
	product_id integer,
	foreign key (client_id) references  client (client_id),
	foreign key (product_id) references  product (product_id)
);

INSERT INTO client
  SET name = 'teste',
      email = 'teste@gmail.com',
      date_birth = '1990-01-10',
      address = 'endereco',
      complement = 'complemento',
      neighborhood = 'bairro',
      cep = '00000-000',
      date_entry = '2023-07-06';

INSERT INTO product
  SET name = 'mesa',
      price = '1000.00',
      photo = 'foto_mesa.png';

INSERT INTO purchase
  SET client_id = 1,
      product_id = 1;*/
