<?php
// controllers/ClienteController.php

class ClienteController {
    private $dao;

    public function __construct() {
        $db = Database::getInstance()->getConnection();
        $this->dao = new ClienteDAO($db);
    }

    public function index() {
        $clientes = $this->dao->findAll();
        include "views/cabecalho.php";
        include "views/clientes/lista.php";
        include "views/rodape.php";
    }

    public function create() {
        $id = $_GET['id'] ?? null;
        $cliente = $id ? $this->dao->findById((int)$id) : null;
        include "views/cabecalho.php";
        include "views/clientes/form.php";
        include "views/rodape.php";
    }

    public function store() {
        $id = $_POST['id'] ?? null;
        $cliente = new Cliente($id, $_POST['nome'] ?? '', $_POST['cpf'] ?? '', $_POST['email'] ?? '', $_POST['telefone'] ?? '', $_POST['endereco'] ?? '');
        
        if ($cliente->getNome() && $cliente->getCpf() && strlen($cliente->getCpf()) === 14) {
            try {
                $this->dao->save($cliente);
                setFlash('success', 'Cliente salvo com sucesso!');
                header('Location: /clientes/lista');
            } catch (Exception $e) {
                $erro = $e->getMessage();
                include "views/cabecalho.php";
                include "views/clientes/form.php";
                include "views/rodape.php";
            }
        } else {
            $erro = "Nome, CPF (14 caracteres) e e-mail são obrigatórios.";
            include "views/cabecalho.php";
            include "views/clientes/form.php";
            include "views/rodape.php";
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            try {
                $this->dao->delete((int)$id);
                setFlash('success', 'Cliente excluído com sucesso!');
            } catch (Exception $e) {
                setFlash('error', $e->getMessage());
            }
        }
        header('Location: /clientes/lista');
    }
}
