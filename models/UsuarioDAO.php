<?php
// models/UsuarioDAO.php
require_once "Usuario.php";

class UsuarioDAO {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function save(Usuario $usuario) {
        try {
            if ($usuario->getId()) {
                $stmt = $this->pdo->prepare('UPDATE usuarios SET usuario = ?, senha = ?, perfil = ? WHERE id = ?');
                $stmt->execute([$usuario->getUsuario(), $usuario->getSenha(), $usuario->getPerfil(), $usuario->getId()]);
            } else {
                $stmt = $this->pdo->prepare('INSERT INTO usuarios (usuario, senha, perfil) VALUES (?, ?, ?)');
                $stmt->execute([$usuario->getUsuario(), $usuario->getSenha(), $usuario->getPerfil()]);
                $usuario->setId($this->pdo->lastInsertId());
            }
            return true;
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) throw new Exception("Usuário já cadastrado.");
            throw new Exception("Erro ao salvar usuário: " . $e->getMessage());
        }
    }

    public function findById(int $id): ?Usuario {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE id = ?');
            $stmt->execute([$id]);
            $data = $stmt->fetch();
            return $data ? new Usuario($data['id'], $data['usuario'], $data['senha'], $data['perfil']) : null;
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar usuário: " . $e->getMessage());
        }
    }

    public function findByUsername(string $username): ?Usuario {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE usuario = ? LIMIT 1');
            $stmt->execute([$username]);
            $data = $stmt->fetch();
            return $data ? new Usuario($data['id'], $data['usuario'], $data['senha'], $data['perfil']) : null;
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar usuário por nome: " . $e->getMessage());
        }
    }

    public function findAll(): array {
        try {
            $stmt = $this->pdo->query('SELECT * FROM usuarios ORDER BY usuario ASC');
            $usuarios = [];
            while ($row = $stmt->fetch()) {
                $usuarios[] = new Usuario($row['id'], $row['usuario'], $row['senha'], $row['perfil']);
            }
            return $usuarios;
        } catch (PDOException $e) {
            throw new Exception("Erro ao listar usuários: " . $e->getMessage());
        }
    }

    public function delete(int $id): bool {
        try {
            $stmt = $this->pdo->prepare('DELETE FROM usuarios WHERE id = ?');
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao excluir usuário: " . $e->getMessage());
        }
    }
}
