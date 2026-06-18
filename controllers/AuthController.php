<?php
// controllers/AuthController.php
require_once 'models/Usuario.php';
require_once 'models/UsuarioDAO.php';

class AuthController {
    private $usuarioDAO;

    public function __construct() {
        $pdo = Database::getInstance()->getConnection();
        $this->usuarioDAO = new UsuarioDAO($pdo);
    }

    public function login() {
        if (isset($_SESSION['user_id'])) {
            header('Location: /dashboard');
            exit;
        }
        require_once 'views/login.php';
    }

    public function authenticate() {
        $username = $_POST['usuario'] ?? '';
        $password = $_POST['senha'] ?? '';

        $usuario = $this->usuarioDAO->findByUsername($username);

        if ($usuario && $usuario->getSenha() === $password) { // Simple check as requested (12345)
            $_SESSION['user_id'] = $usuario->getId();
            $_SESSION['usuario'] = $usuario->getUsuario();
            $_SESSION['perfil'] = $usuario->getPerfil();

            setFlash('success', 'Bem-vindo ao sistema!');
            header('Location: /dashboard');
            exit;
        }

        setFlash('danger', 'Usuário ou senha inválidos.');
        header('Location: /login');
        exit;
    }

    public function logout() {
        session_destroy();
        header('Location: /login');
        exit;
    }
}
