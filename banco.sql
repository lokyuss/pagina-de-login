-- Cria o banco de dados do projeto.
CREATE DATABASE IF NOT EXISTS login_faculdade
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE login_faculdade;

-- Tabela que armazena os usuários.
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

-- Usuário de teste: aluno@faculdade.com / teste
-- O valor abaixo é um hash bcrypt criado no PHP com:
-- password_hash('teste', PASSWORD_DEFAULT)
INSERT INTO usuarios (email, senha)
VALUES (
    'aluno@faculdade.com',
    '$2y$10$5ixGI4bAKbWI4bdlzbXi9uqaOrysHRuqbBLP4N8HhgPL6c5yIuS2a'
)
ON DUPLICATE KEY UPDATE email = email;
