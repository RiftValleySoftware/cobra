DROP TABLE IF EXISTS co_security_nodes;
DROP SEQUENCE IF EXISTS element_id_seq;
CREATE SEQUENCE element_id_seq;
CREATE TABLE co_security_nodes (
  id BIGINT NOT NULL DEFAULT nextval('element_id_seq'),
  login_id VARCHAR(255) DEFAULT NULL,
  access_class VARCHAR(255) NOT NULL,
  last_access TIMESTAMP NOT NULL,
  read_security_id BIGINT DEFAULT NULL,
  write_security_id BIGINT DEFAULT NULL,
  object_name VARCHAR(255) DEFAULT NULL,
  access_class_context VARCHAR(4095) DEFAULT NULL,
  ids VARCHAR(4095) DEFAULT NULL
);

INSERT INTO co_security_nodes (login_id, access_class, last_access, read_security_id, write_security_id, object_name, access_class_context, ids) VALUES
(NULL, 'CO_Security_Node', '1970-01-01 00:00:00', -1, -1, NULL, NULL, NULL),
('admin', 'CO_Security_Login', '1970-01-01 00:00:00', 2, 2, 'Default Admin', 'a:1:{s:15:"hashed_password";s:4:"JUNK";}', NULL),
(NULL, 'CO_Security_ID', '1970-01-01 00:00:00', -1, -1, NULL, NULL, NULL),
(NULL, 'CO_Security_ID', '1970-01-01 00:00:00', -1, -1, NULL, NULL, NULL),
(NULL, 'CO_Security_ID', '1970-01-01 00:00:00', -1, -1, NULL, NULL, NULL),
(NULL, 'CO_Security_ID', '1970-01-01 00:00:00', -1, -1, NULL, NULL, NULL),
('MDAdmin', 'CO_Security_Login', '1970-01-01 00:00:00', 7, 7, 'Maryland Login', 'a:1:{s:15:"hashed_password";s:13:"CodYOzPtwxb4A";}', NULL),
('VAAdmin', 'CO_Security_Login', '1970-01-01 00:00:00', 8, 8, 'Virginia Login', 'a:1:{s:15:"hashed_password";s:13:"CodYOzPtwxb4A";}', NULL),
('DCAdmin', 'CO_Security_Login', '1970-01-01 00:00:00', 9, 9, 'Washington DC Login', 'a:1:{s:15:"hashed_password";s:13:"CodYOzPtwxb4A";}', NULL),
('WVAdmin', 'CO_Security_Login', '1970-01-01 00:00:00', 10, 10, 'West Virginia Login', 'a:1:{s:15:"hashed_password";s:13:"CodYOzPtwxb4A";}', NULL),
('DEAdmin', 'CO_Security_Login', '1970-01-01 00:00:00', 11, 11, 'Delaware Login', 'a:1:{s:15:"hashed_password";s:13:"CodYOzPtwxb4A";}', NULL),
('DEEAdmin', 'CO_Security_Login', '1970-01-01 00:00:00', 12, 12, 'Dees Place Login', 'a:1:{s:15:"hashed_password";s:13:"CodYOzPtwxb4A";}', NULL),
('AllAdmin', 'CO_Security_Login', '1970-01-01 00:00:00', 13, 13, 'All Admin Login', 'a:1:{s:15:"hashed_password";s:13:"CodYOzPtwxb4A";}', '2,3,4,5,6,7,8,9,10,11,12,14,15');