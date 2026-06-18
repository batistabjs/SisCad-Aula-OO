-- 05_usuarios_seeds.sql
-- Inserts iniciais para testes de login e perfis

INSERT INTO usuarios (usuario, senha, perfil) VALUES 
('admin', '12345', 'Administrador'),
('ana', '12345', 'Moderador'),
('bruno', '12345', 'Usuario_Comum');
