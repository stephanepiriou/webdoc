CREATE TABLE documents (
  id             int(10) NOT NULL AUTO_INCREMENT,
  name           varchar(255) NOT NULL,
  typedocumentid int(10) NOT NULL,
  individuid     int(10) NOT NULL,
  filename       varchar(255),
  PRIMARY KEY (id)
);

CREATE TABLE individus (
  id             int(10) NOT NULL AUTO_INCREMENT,
  matricule      varchar(32) NOT NULL UNIQUE,
  firstname      varchar(255) NOT NULL,
  lastname       varchar(255) NOT NULL,
  adress         varchar(255) NOT NULL,
  city           varchar(64) NOT NULL,
  postalcode     char(8) NOT NULL,
  typeindividuid int(10) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE typesindividu (
  id   int(10) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL UNIQUE,
  PRIMARY KEY (id)
);

CREATE TABLE typesdocument (
  id   int(10) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL UNIQUE,
  PRIMARY KEY (id)
);

CREATE TABLE users (
  id            int(10) NOT NULL AUTO_INCREMENT,
  email         varchar(64) NOT NULL UNIQUE,
  name          varchar(255) NOT NULL,
  password_hash varchar(255) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE remembered_logins (
  token_hash varchar(255) NOT NULL,
  users_id   int(10) NOT NULL,
  expires_at datetime NOT NULL,
  PRIMARY KEY (token_hash)
);

ALTER TABLE individus ADD CONSTRAINT FKindividus568889 FOREIGN KEY (typeindividuid) REFERENCES typesindividu (id);

ALTER TABLE documents ADD CONSTRAINT FKdocuments126498 FOREIGN KEY (typedocumentid) REFERENCES typesdocument (id);

ALTER TABLE documents ADD CONSTRAINT FKdocuments24492 FOREIGN KEY (individuid) REFERENCES individus (id);

ALTER TABLE remembered_logins ADD CONSTRAINT FKremembered183786 FOREIGN KEY (users_id) REFERENCES users (id);