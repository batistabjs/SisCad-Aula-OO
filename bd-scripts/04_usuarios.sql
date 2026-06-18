-- 04_usuarios.sql
-- Criação da tabela de usuários para o sistema de login

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    perfil ENUM('Administrador', 'Moderador', 'Usuario_Comum') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
