USE agenda;

-- Sementes para a tabela de contatos
INSERT INTO contatos (nome, email, telefone) VALUES
('Ana Silva', 'ana.silva@email.com', '(11) 98888-7777'),
('Bruno Costa', 'bruno.costa@email.com', '(21) 97777-6666'),
('Carla Souza', 'carla.souza@email.com', '(31) 96666-5555');

-- Sementes para a tabela de clientes
INSERT INTO clientes (nome, cpf, email, telefone, endereco) VALUES
('João Pereira', '123.456.789-00', 'joao.pereira@cliente.com', '(11) 91111-2222', 'Rua das Flores, 123, SP'),
('Maria Oliveira', '987.654.321-11', 'maria.oliveira@cliente.com', '(21) 92222-3333', 'Av. Central, 456, RJ'),
('Ricardo Santos', '456.789.123-22', 'ricardo.santos@cliente.com', '(31) 93333-4444', 'Travessa do Sol, 789, MG');

-- Sementes para a tabela de produtos
INSERT INTO produtos (nome, descricao, preco, estoque) VALUES
('Teclado Mecânico', 'Teclado RGB Switch Blue', 250.00, 15),
('Mouse Gamer', 'Mouse 16000 DPI Óptico', 120.50, 30),
('Monitor 24 Pol', 'Monitor Full HD 75Hz', 899.90, 10);
