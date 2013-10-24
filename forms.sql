create table forms
(
  name varchar(255) UNIQUE PRIMARY KEY,
  form varchar(1024)
);


create table forms_data
(
  id int,
  form_name varchar(255),
  name varchar(255),
  value varchar(1024)
);


--create table process
--(
--  name,
--);

--create table process_data
--(
--);
