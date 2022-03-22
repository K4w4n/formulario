CREATE DATABASE db_sua_empresa;

CREATE TABLE tb_mensagens(
    id INT NOT NULl AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200),
    telefone CHAR(15),
    mensagem VARCHAR(500)
);