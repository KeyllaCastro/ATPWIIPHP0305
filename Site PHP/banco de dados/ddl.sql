CREATE DATABASE IF NOT EXISTS db_pw2;
USE db_pw2;

CREATE TABLE login (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(80) NOT NULL,
    email VARCHAR(100) NOT NULL,
    idade VARCHAR(40),
    id_login INT NOT NULL,
    FOREIGN KEY (id_login) REFERENCES login(id) ON DELETE CASCADE
);
-- TABELA DE PRODUTO
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    marca VARCHAR(100),
    preco DECIMAL(10,2) NOT NULL,
    descricao TEXT,
    quantidade INT NOT NULL DEFAULT 0,
    categoria VARCHAR(50),
    caminho_do_produto VARCHAR(255),
    data_cadastro DATE,
    ativo BOOLEAN DEFAULT TRUE
);