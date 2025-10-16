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

CREATE TABLE users (
  id BIGSERIAL PRIMARY KEY,
  firstname VARCHAR(30) NOT NULL,
  lastname VARCHAR(30) NOT NULL,
  mobile_number VARCHAR(20) NOT NULL,
  ide_number VARCHAR(15) UNIQUE,
  address TEXT,
  birthday DATE,
  email VARCHAR(200) UNIQUE NOT NULL,
  password TEXT NOT NULL,
  birth_city_id BIGINT,
  document_city_id BIGINT,
  status BOOLEAN DEFAULT TRUE,
  created_at TIMESTAMPTZ DEFAULT NOW(),
  updated_at TIMESTAMPTZ DEFAULT NOW(),
  deleted_at TIMESTAMPTZ,
  FOREIGN KEY (birth_city_id) REFERENCES cities(id) ON DELETE SET NULL,
  FOREIGN KEY (document_city_id) REFERENCES cities(id) ON DELETE SET NULL
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
  created_at TIMESTAMPTZ DEFAULT NOW(),
  updated_at TIMESTAMPTZ DEFAULT NOW(),
  deleted_at TIMESTAMPTZ
);

CREATE TABLE regions (
    id INT PRIMARY KEY,
    name VARCHAR(255),
    abbrev VARCHAR(10),
    code VARCHAR(10) NUll UNIQUE,
    status BOOLEAN NOT NULL DEFAULT TRUE
    id_country INT,
    created_at TIMESTAMPTZ NOT NULL DEFAULT now(),
	updated_at TIMESTAMPTZ NOT NULL DEFAULT now(),
	delated_at TIMESTAMPTZ NULL,
    FOREIGN KEY (id_country) REFERENCES countries(id)
);
CREATE TABLE cities (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    abbrev VARCHAR(20),
    code VARCHAR(15) NULL UNIQUE,
    status BOOLEAN NOT NULL DEFAULT TRUE,
    id_region BIGINT NOT NULL,
    created_at TIMESTAMPTZ NOT NULL DEFAULT now(),
    updated_at TIMESTAMPTZ NOT NULL DEFAULT now(),
    deleted_at TIMESTAMPTZ NULL,
    FOREIGN KEY (id_region) REFERENCES region(id)
);




