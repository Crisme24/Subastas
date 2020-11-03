CREATE DATABASE IF NOT EXISTS subasta;
USE subasta;


CREATE TABLE users(
    id          int(255) auto_increment not null,
    name        varchar(100) not null,
    surname     varchar(255) not null,
    email       varchar(255) not null,
    password    varchar(255) not null,
    role        varchar(50),
    created_at  datetime DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT  pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE subastas(
    id              int(11) auto_increment not null,
    user_id         int(11) not null,
    name            varchar(255) not null,
    description     text,
    image           varchar(255),
    min_price       float(20,2) not null,
    max_price       float(20,2) not null,
    start_date      datetime DEFAULT CURRENT_TIMESTAMP,
    end_date        datetime DEFAULT CURRENT_TIMESTAMP,
    status          varchar(20),
    CONSTRAINT pk_subastas PRIMARY KEY(id),
    CONSTRAINT fk_subastas_users FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;

CREATE TABLE pujas(
    id              int(11) auto_increment not null,
    user_id         int(11) not null,
    subasta_id      int(11) not null,
    price           decimal(20,2) not null,
    created_at      datetime DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pk_pujas PRIMARY KEY(id),
    CONSTRAINT fk_pujas_users FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_pujas_subastas FOREIGN KEY(subasta_id) REFERENCES subastas(id)
)ENGINE=InnoDb;
