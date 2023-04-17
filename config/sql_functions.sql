create database book-library;

-- конфиг
create table config(
	name varchar(30) unique primary key,
	value varchar(255)
);

-- пользователи БД
CREATE TABLE db_users (
  user_login varchar(50) NOT NULL PRIMARY KEY UNIQUE KEY , 
  user_password varchar(255) NOT NULL,
  user_hash varchar(30) NOT NULL DEFAULT ''
);
 insert into db_users(user_login, user_password, user_role_id) values('admin', '$2y$10$pq.PwHCRneqUlRjkkjuuzu6lmjiA3F64elhKJR5eRWO.I.J1qqYAC', 1);

-- пользователи вк
 CREATE TABLE vk_users (
  user_login varchar(15) NOT NULL PRIMARY KEY UNIQUE KEY , 
  user_name varchar(255) NOT NULL
);