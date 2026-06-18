<?php
// controllers/DashboardController.php
require_once 'models/ContatoDAO.php';
require_once 'models/ClienteDAO.php';
require_once 'models/ProdutoDAO.php';
require_once 'models/PedidoDAO.php';

class DashboardController {
    private $contatoDao;
    private $clienteDao;
    private $produtoDao;
    private $pedidoDao;

    public function __construct() {
        $db = Database::getInstance()->getConnection();
        $this->contatoDao = new ContatoDAO($db);
        $this->clienteDao = new ClienteDAO($db);
        $this->produtoDao = new ProdutoDAO($db);
        $this->pedidoDao = new PedidoDAO($db);
    }

    public function index() {
        // Coleta contagens para os cards do dashboard
        $stats = [
            'contatos_count' => count($this->contatoDao->findAll()),
            'clientes_count' => count($this->clienteDao->findAll()),
            'produtos_count' => count($this->produtoDao->findAll()),
            'pedidos_count'  => $this->pedidoDao->countAll(),
        ];

        require_once "views/cabecalho.php";
        require_once "views/dashboard/dashboard.php";
        require_once "views/rodape.php";
    }
}
