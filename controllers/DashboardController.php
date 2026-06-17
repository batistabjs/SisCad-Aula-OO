<?php
// controllers/DashboardController.php

class DashboardController {
    private $contatoDao;
    private $clienteDao;
    private $produtoDao;

    public function __construct() {
        $db = Database::getInstance()->getConnection();
        $this->contatoDao = new ContatoDAO($db);
        $this->clienteDao = new ClienteDAO($db);
        $this->produtoDao = new ProdutoDAO($db);
    }

    public function index() {
        // Coleta estatísticas básicas para o dashboard
        $stats = [
            'contatos' => $this->contatoDao->findAll(),
            'clientes' => $this->clienteDao->findAll(),
            'produtos' => $this->produtoDao->findAll(),
        ];

        include "views/cabecalho.php";
        include "views/dashboard/dashboard.php";
        include "views/rodape.php";
    }
}
