<?php
// controllers/ProdutoController.php

class ProdutoController {
    private $dao;

    public function __construct() {
        $db = Database::getInstance()->getConnection();
        $this->dao = new ProdutoDAO($db);
    }

    public function index() {
        $produtos = $this->dao->findAll();
        require_once "views/produtos/lista.php";
    }

    public function create() {
        $id = $_GET['id'] ?? null;
        $produto = $id ? $this->dao->findById((int)$id) : null;
        require_once "views/produtos/form.php";
    }

    public function store() {
        $id = $_POST['id'] ?? null;
        $preco = filter_input(INPUT_POST, 'preco', FILTER_VALIDATE_FLOAT);
        $estoque = filter_input(INPUT_POST, 'estoque', FILTER_VALIDATE_INT);

        if (!$preco || $preco <= 0 || $estoque === false || $estoque < 0) {
            $erro = "Preço e estoque inválidos.";
            require_once "views/produtos/form.php";
            return;
        }

        $nomeArquivo = null;
        if (!empty($_FILES['imagem']['name'])) {
            $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
            if (in_array(strtolower($extensao), ['jpg', 'jpeg', 'png', 'webp'])) {
                $nomeArquivo = uniqid('prod_') . '.' . $extensao;
                move_uploaded_file($_FILES['imagem']['tmp_name'], 'uploads/' . $nomeArquivo);
            } else {
                $erro = "Extensão de imagem não permitida.";
                require_once "views/produtos/form.php";
                return;
            }
        }

        $produto = new Produto($id, $_POST['nome'] ?? '', $_POST['descricao'] ?? '', $preco, $estoque, $nomeArquivo ?? ($_POST['old_image'] ?? null));

        try {
            $this->dao->save($produto);
            setFlash('success', 'Produto salvo com sucesso!');
            header('Location: /produtos/lista');
            exit;
        } catch (Exception $e) {
            $erro = $e->getMessage();
            require_once "views/produtos/form.php";
            return;
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            try {
                $this->dao->delete((int)$id);
                setFlash('success', 'Produto excluído com sucesso!');
            } catch (Exception $e) {
                setFlash('error', $e->getMessage());
            }
        }
        header('Location: /produtos/lista');
        exit;
    }
}
