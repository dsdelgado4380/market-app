--create table users(
--id BIGSERIAL PRIMARY KEY,
--firstname varchar(30) NOT NULL,
--lastname varchar(30) NOT NULL,
--mobile_number varchar(20) NOT NULL,
--ide_number varchar(15) NULL UNIQUE,
---address TEXT NULL,
--birthday DATE NULL,
--email varchar(200) NOT NULL UNIQUE,
--password TEXT NOT NULL,
--status BOOLEAN NOT NULL DEFAULT TRUE,
--created_at TIMESTAMPTZ NOT NULL DEFAULT now(),
--update_at TIMESTAMPTZ NOT NULL DEFAULT now(),
--deleted_at TIMESTAMPTZ NULL);

CREATE TABLE users(
	id BIGSERIAL PRIMARY KEY,
	firstname VARCHAR(30) NOT NULL,
	lastname VARCHAR(30) NOT NULL,
	mobile_number VARCHAR(20) NOT NULL,
	ide_number VARCHAR(15) NULL UNIQUE,
	adress TEXT NULL,
	birthdate DATE NULL,
	email VARCHAR(200) NOT NULL UNIQUE,
	password TEXT NOT NULL,
    id_city_birthday BIGINT REFERENCES cities(id),
    id_city_document BIGINT REFERENCES cities(id),
	status BOOLEAN NOT NULL DEFAULT TRUE,
	created_at TIMESTAMPTZ NOT NULL DEFAULT now(),
	updated_at TIMESTAMPTZ NOT NULL DEFAULT now(),
	delete_at TIMESTAMPTZ NULL
);
INSERT INTO users(
    firstname,
    lastname,
    mobile_number,
    email,password) 
VALUES (
    'Daniel','Delgado','3000456782','dsdelgado@gmail.com','1234');

select 
    u.ide_number,
    u.firstname || ' ' || u.lastname,
    u.email,
    u."password",
    case when u.status = true then 'Active' else 'Inactive' end
from 
    users u 
where 
	u.status = true;

CREATE TABLE countries (
  	id BIGSERIAL PRIMARY KEY,
  	name VARCHAR(100) NOT NULL,
  	abbrev VARCHAR(10),
  	code VARCHAR(10),
  	status BOOLEAN NOT NULL DEFAULT TRUE,
	created_at TIMESTAMPTZ NOT NULL DEFAULT now(),
	updated_at TIMESTAMPTZ NOT NULL DEFAULT now(),
	delete_at TIMESTAMPTZ NULL
);

CREATE TABLE regions (
  	id BIGSERIAL PRIMARY KEY,
  	name VARCHAR(100) NOT NULL,
	abbrev VARCHAR(10),
	code VARCHAR(10),
  	country_id INT NOT NULL,
  	status BOOLEAN NOT NULL DEFAULT TRUE,
	created_at TIMESTAMPTZ NOT NULL DEFAULT now(),
	updated_at TIMESTAMPTZ NOT NULL DEFAULT now(),
	delete_at TIMESTAMPTZ NULL,
  	FOREIGN KEY (country_id) REFERENCES countries(id)
);

CREATE TABLE cities (
  	id BIGSERIAL PRIMARY KEY,
  	name VARCHAR(100) NOT NULL,
	abbrev VARCHAR(10),
	code VARCHAR(10),
  	region_id INT NOT NULL,
  	status BOOLEAN NOT NULL DEFAULT TRUE,
	created_at TIMESTAMPTZ NOT NULL DEFAULT now(),
	updated_at TIMESTAMPTZ NOT NULL DEFAULT now(),
	delete_at TIMESTAMPTZ NULL,
  	FOREIGN KEY (region_id) REFERENCES regions(id)
);




