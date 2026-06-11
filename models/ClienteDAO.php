<?php
// models/ClienteDAO.php
require_once "Cliente.php";

class ClienteDAO {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function save(Cliente $cliente) {
        try {
            if ($cliente->getId()) {
                $stmt = $this->pdo->prepare('UPDATE clientes SET nome = ?, cpf = ?, email = ?, telefone = ?, endereco = ? WHERE id = ?');
                $stmt->execute([$cliente->getNome(), $cliente->getCpf(), $cliente->getEmail(), $cliente->getTelefone(), $cliente->getEndereco(), $cliente->getId()]);
            } else {
                $stmt = $this->pdo->prepare('INSERT INTO clientes (nome, cpf, email, telefone, endereco) VALUES (?, ?, ?, ?, ?)');
                $stmt->execute([$cliente->getNome(), $cliente->getCpf(), $cliente->getEmail(), $cliente->getTelefone(), $cliente->getEndereco()]);
                $cliente->setId($this->pdo->lastInsertId());
            }
            return true;
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) throw new Exception("CPF já cadastrado.");
            throw new Exception("Erro ao salvar cliente: " . $e->getMessage());
        }
    }

    public function findById(int $id): ?Cliente {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM clientes WHERE id = ?');
            $stmt->execute([$id]);
            $data = $stmt->fetch();
            return $data ? new Cliente($data['id'], $data['nome'], $data['cpf'], $data['email'], $data['telefone'], $data['endereco']) : null;
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar cliente: " . $e->getMessage());
        }
    }

    public function findAll(): array {
        try {
            $stmt = $this->pdo->query('SELECT * FROM clientes ORDER BY nome');
            $clientes = [];
            while ($row = $stmt->fetch()) {
                $clientes[] = new Cliente($row['id'], $row['nome'], $row['cpf'], $row['email'], $row['telefone'], $row['endereco']);
            }
            return $clientes;
        } catch (PDOException $e) {
            throw new Exception("Erro ao listar clientes: " . $e->getMessage());
        }
    }

    public function delete(int $id): bool {
        try {
            $stmt = $this->pdo->prepare('DELETE FROM clientes WHERE id = ?');
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao excluir cliente: " . $e->getMessage());
        }
    }
}
