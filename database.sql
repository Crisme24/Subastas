CREATE DATABASE IF NOT EXISTS sales_symfony4;
USE sales_symfony4;


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

CREATE TABLE categories(
    id              int(11) auto_increment not null,
    name            varchar(100) not null,
    created_at      datetime DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pk_categories PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE products(
    id              int(11) auto_increment not null,
    category_id     int(11) not null,
    name            varchar(100) not null,
    description     text,
    price           decimal(20,2) not null,
    image           varchar(255) not null,
    created_at  datetime DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pk_products PRIMARY KEY(id),
    CONSTRAINT fk_products_categories FOREIGN KEY(category_id) REFERENCES categories(id)
)ENGINE=InnoDb;

CREATE TABLE sales(
    id              int(11) auto_increment not null,
    user_id         int(11) not null,
    product_id      int(11) not null,
    min_price       decimal(20,2) not null,
    max_price       decimal(20,2) not null,
    start_date      datetime DEFAULT CURRENT_TIMESTAMP,
    end_date        datetime DEFAULT CURRENT_TIMESTAMP,
    status          varchar(20),
    CONSTRAINT pk_sales PRIMARY KEY(id),
    CONSTRAINT fk_sales_users FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_sales_products FOREIGN KEY(product_id) REFERENCES products(id)
)ENGINE=InnoDb;

CREATE TABLE biddings(
    id              int(11) auto_increment not null,
    sale_id         int(11) not null,
    user_id         int(11) not null,
    bid             decimal(20,2) not null,
    descripcion     text,
    created_at  datetime DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pk_biddings PRIMARY KEY(id),
    CONSTRAINT fk_biddings_sales FOREIGN KEY(sale_id) REFERENCES sales(id),
    CONSTRAINT fk_biddings_users FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;
