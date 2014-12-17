CREATE TABLE user(
  id int(11) NOT NULL auto_increment,
  login varchar(100) NOT NULL,
  password varchar(16) NOT NULL,
  mail varchar (100),
  PRIMARY KEY (id)
)

INSERT INTO User (login, password,mail)
    VALUES  ('','lingals','pass','lingals@insset.com');
INSERT INTO User
    VALUES  ('','Quentin','pass','quentin@insset.com');
INSERT INTO User
    VALUES  ('','Pierre','pass','pierre@insset.com');