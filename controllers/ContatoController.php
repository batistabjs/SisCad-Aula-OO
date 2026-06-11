<?php
// controllers/ContatoController.php

class ContatoController {
    private $dao;

    public function __construct() {
        $db = Database::getInstance()->getConnection();
        $this->dao = new ContatoDAO($db);
    }

    public function index() {
        $busca = trim($_GET['busca'] ?? '');
        $pagina = (int) ($_GET['pagina'] ?? 1);
        $porPagina = 5;
        if ($pagina < 1) $pagina = 1;

        $contatos = $this->dao->findAll($busca, $pagina, $porPagina);
        $totalRegistros = $this->dao->countAll($busca);
        $totalPaginas = ceil($totalRegistros / $porPagina);

        include "views/cabecalho.php";
        include "views/contatos/lista.php";
    }

    public function create() {
        $id = $_GET['id'] ?? null;
        $contato = $id ? $this->dao->findById((int)$id) : null;
        
        include "views/cabecalho.php";
        include "views/contatos/form.php";
    }

    public function store() {
        $id = $_POST['id'] ?? null;
        $contato = new Contato($id, $_POST['nome'] ?? '', $_POST['email'] ?? '', $_POST['telefone'] ?? '');
        
        if ($contato->getNome() && $contato->getEmail()) {
            try {
                $this->dao->save($contato);
                setFlash('success', 'Contato salvo com sucesso!');
                header('Location: index.php?page=/contatos/lista');
            } catch (Exception $e) {
                $erro = $e->getMessage();
                include "views/cabecalho.php";
                include "views/contatos/form.php";
            }
        } else {
            $erro = "Nome e e-mail são obrigatórios.";
            include "views/cabecalho.php";
            include "views/contatos/form.php";
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            try {
                $this->dao->delete((int)$id);
                setFlash('success', 'Contato excluído com sucesso!');
            } catch (Exception $e) {
                setFlash('error', $e->getMessage());
            }
        }
        header('Location: index.php?page=/contatos/lista');
    }
}
