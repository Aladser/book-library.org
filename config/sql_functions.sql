-- роли пользователей
create table user_roles(
	role_id int auto_increment primary key,
	role_name varchar(30) unique
);
insert into user_roles(role_name) values('admin');
insert into user_roles(role_name) values('user');
insert into user_roles(role_name) values('uservk');

-- пользователи БД
CREATE TABLE db_users (
  user_login varchar(50) NOT NULL PRIMARY KEY UNIQUE KEY , 
  user_password varchar(255) NOT NULL,
  user_hash varchar(30) NOT NULL DEFAULT '',
  user_role_id int references user_roles(role_id)
);

 insert into db_users(user_login, user_password, user_role_id) values('admin', '$2y$10$pq.PwHCRneqUlRjkkjuuzu6lmjiA3F64elhKJR5eRWO.I.J1qqYAC', 1);