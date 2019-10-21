-- Table documents
CREATE TABLE documents (
  id             int(10) NOT NULL AUTO_INCREMENT,
  name           varchar(255) NOT NULL,
  typedocumentid int(10) NOT NULL,
  individuid     int(10) NOT NULL,
  filename       varchar(255),
  PRIMARY KEY (id));

-- Table individus
CREATE TABLE individus (
  id             int(10) NOT NULL AUTO_INCREMENT,
  matricule      varchar(32) NOT NULL UNIQUE,
  firstname      varchar(255) NOT NULL,
  lastname       varchar(255) NOT NULL,
  adress         varchar(255),
  city           varchar(64),
  postalcode     char(8),
  typeindividuid int(10) NOT NULL,
  PRIMARY KEY (id));

-- Table typesindividu
CREATE TABLE typesindividu (
  id   int(10) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL UNIQUE,
  PRIMARY KEY (id));

-- Table typesdocument
CREATE TABLE typesdocument (
  id   int(10) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL UNIQUE,
  PRIMARY KEY (id));

-- Table users
CREATE TABLE users (
  id            int(10) NOT NULL AUTO_INCREMENT,
  email         varchar(64) NOT NULL UNIQUE,
  name          varchar(255) NOT NULL,
  password_hash varchar(255) NOT NULL,
  roleid        int(11) NOT NULL,
  PRIMARY KEY (id));

-- Table remembered_logins
CREATE TABLE remembered_logins (
  token_hash varchar(255) NOT NULL,
  user_id   int(10) NOT NULL,
  expires_at datetime NOT NULL,
  PRIMARY KEY (token_hash));

-- Table roles
CREATE TABLE roles (
  id   int(11) NOT NULL AUTO_INCREMENT,
  name varchar(255),
  description varchar(255),
  PRIMARY KEY (id));

-- Table permissions
CREATE TABLE permissions (
  id          int(11) NOT NULL AUTO_INCREMENT,
  description varchar(255),
  PRIMARY KEY (id));

-- Table permissions_roles
CREATE TABLE permissions_roles (
  permissionid int(11) NOT NULL,
  roleid       int(11) NOT NULL,
  PRIMARY KEY (permissionsid,
  rolesid));

-- Constrains
ALTER TABLE individus ADD CONSTRAINT `estdecetypeindividu` FOREIGN KEY (typeindividuid) REFERENCES typesindividu (id);
ALTER TABLE documents ADD CONSTRAINT `estdecetypededocument` FOREIGN KEY (typedocumentid) REFERENCES typesdocument (id);
ALTER TABLE documents ADD CONSTRAINT `concernecetindividu` FOREIGN KEY (individuid) REFERENCES individus (id);
ALTER TABLE remembered_logins ADD CONSTRAINT `sesouvientdesaconnection` FOREIGN KEY (user_id) REFERENCES users (id);
ALTER TABLE users ADD CONSTRAINT `acerole` FOREIGN KEY (roleid) REFERENCES roles (id);
ALTER TABLE permissions_roles ADD CONSTRAINT `faitpartiedecerole` FOREIGN KEY (permissionid) REFERENCES permissions (id);
ALTER TABLE permissions_roles ADD CONSTRAINT `acettepermission` FOREIGN KEY (roleid) REFERENCES roles (id);

-- Insert permissions
INSERT INTO permissions (id, description) VALUES (1, 'consultation');
INSERT INTO permissions (id, description) VALUES (2,'creation');
INSERT INTO permissions (id, description) VALUES (3, 'modification');
INSERT INTO permissions (id, description) VALUES (4, 'user_administration');


-- Insert roles
INSERT INTO roles (id, name, description) VALUES (1, 'utilisateur', 'Un utilisateur peut consulter les données ainsi qu\'afficher, imprimer et téléchargér les document');
INSERT INTO roles (id, name, description) VALUES (2, 'encodeur', 'Un encodeur peut consulter les données, les modifier, les effacer, afficher les documents, les effacer. Il ne peut pas télécharger ces documents, ni les imprimer.');
INSERT INTO roles (id, name, description) VALUES (3, 'administrateur', 'Un administrateur s\'occupe uniquement de la gestion des utilisateur. Il ne peut mi consulter les données, ni les effacer.');

-- Insert permissions for every rôle

-- Permissions for regular user
INSERT INTO permissions_roles (permissionid, roleid) VALUES (1,1);

-- Permissions for encoder
INSERT INTO permissions_roles (permissionid, roleid) VALUES (1,2);
INSERT INTO permissions_roles (permissionid, roleid) VALUES (2,2);
INSERT INTO permissions_roles (permissionid, roleid) VALUES (3,2);

-- Permissions for admin
INSERT INTO permissions_roles (permissionid, roleid) VALUES (4,3);