CREATE TABLE bulletin (
  id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(32) NOT NULL,
  message VARCHAR(200) NOT NULL,
  post_date DATETIME NOT NULL,
  password VARCHAR(4) DEFAULT NULL,
  is_deleted TINYINT(1) NOT NULL DEFAULT '0'
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO bulletin(id, title, message, post_date) VALUES (1, 'ᕕ╏ ◕ ₒ ◕ ╏ᓄ', 'ᕕ╏ ◕ ₒ ◕ ╏ᓄ', NOW());
INSERT INTO bulletin(id, title, message, post_date) VALUES (2, 'This Title', 'Please insert comment here', NOW());
