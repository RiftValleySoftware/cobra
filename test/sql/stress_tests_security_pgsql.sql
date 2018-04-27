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
('admin', 'CO_Security_Login', '1970-01-01 00:00:00', 2, 2, 'Default Admin', 'a:1:{s:15:\"hashed_password\";s:4:\"JUNK\";}', NULL),
('secondary', 'CO_Security_Login', '1970-01-01 00:00:00', 3, 3, 'Secondary Login', 'a:1:{s:15:\"hashed_password\";s:13:\"CodYOzPtwxb4A\";}', '2,5,6'),
('tertiary', 'CO_Security_Login', '1970-01-01 00:00:00', 4, 4, 'Tertiary Login', 'a:1:{s:15:\"hashed_password\";s:13:\"CodYOzPtwxb4A\";}', '6'),
(NULL, 'CO_Security_ID', '1970-01-01 00:00:00', -1, -1, 'Security ID 5', '', NULL),
(NULL, 'CO_Security_ID', '1970-01-01 00:00:00', -1, -1, 'Security ID 6', '', NULL);
