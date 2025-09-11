create table users(
id BIGSERIAL PRIMARY KEY,
firstname varchar(30) NOT NULL,
lastname varchar(30) NOT NULL,
mobile_number varchar(20) NOT NULL,
ide_number varchar(15) NULL UNIQUE,
address TEXT NULL,
birthday DATE NULL,
email varchar(200) NOT NULL UNIQUE,
password TEXT NOT NULL,
status BOOLEAN NOT NULL DEFAULT TRUE,
created_at TIMESTAMPTZ NOT NULL DEFAULT now(),
update_at TIMESTAMPTZ NOT NULL DEFAULT now(),
deleted_at TIMESTAMPTZ NULL);

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