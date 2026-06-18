<?php
// controllers/UsuarioController.php
require_once 'models/Usuario.php';
require_once 'models/UsuarioDAO.php';

class UsuarioController {
    private $usuarioDAO;

    public function __construct() {
        $pdo = Database::getInstance()->getConnection();
        $this->usuarioDAO = new UsuarioDAO($pdo);
    }

    public function index() {
        $usuarios = $this->usuarioDAO->findAll();
        require_once 'views/usuarios/lista.php';
    }

    public function create() {
        $id = $_GET['id'] ?? null;
        $usuario = $id ? $this->usuarioDAO->findById((int)$id) : null;
        require_once 'views/usuarios/form.php';
    }

    public function store() {
        $id = $_POST['id'] ?? null;
        $usuario = new Usuario();
        if ($id) {
            $usuario->setId($id);
        }
        $usuario->setUsuario($_POST['usuario'] ?? '');
        $usuario->setSenha($_POST['senha'] ?? '');
        $usuario->setPerfil($_POST['perfil'] ?? 'Usuario_Comum');

        try {
            if ($this->usuarioDAO->save($usuario)) {
                setFlash('success', 'Usuário salvo com sucesso!');
                header('Location: /usuarios/lista');
                exit;
            }
        } catch (Exception $e) {
            $erro = $e->getMessage();
            require_once 'views/usuarios/form.php';
            return;
        }

        header('Location: /usuarios/lista');
        exit;
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            try {
                if ($this->usuarioDAO->delete((int)$id)) {
                    setFlash('success', 'Usuário excluído com sucesso!');
                }
            } catch (Exception $e) {
                setFlash('danger', $e->getMessage());
            }
        }
        header('Location: /usuarios/lista');
        exit;
    }
}
