use sistema;

CREATE TABLE tarefas (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(30) NOT NULL,
descricao VARCHAR(255) NOT NULL
);

CREATE TABLE perfil (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nivel_acesso VARCHAR(30) NOT NULL
);

CREATE TABLE usuario (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(30) NOT NULL,
password VARCHAR(30) NOT NULL,
perfil_id INT(6) UNSIGNED,
FOREIGN KEY (perfil_id) REFERENCES perfil(id)
);

USE sistema;

-- Insira os níveis de acesso na tabela perfil
INSERT INTO perfil (nivel_acesso) VALUES ('Administrador');
INSERT INTO perfil (nivel_acesso) VALUES ('Cliente');
