<?php
// controllers/PedidoController.php
require_once 'models/Pedido.php';
require_once 'models/PedidoItem.php';
require_once 'models/PedidoDAO.php';
require_once 'models/ClienteDAO.php';
require_once 'models/ProdutoDAO.php';

class PedidoController {
    private $pedidoDAO;
    private $clienteDAO;
    private $produtoDAO;

    public function __construct() {
        $pdo = Database::getInstance()->getConnection();
        $this->pedidoDAO = new PedidoDAO($pdo);
        $this->clienteDAO = new ClienteDAO($pdo);
        $this->produtoDAO = new ProdutoDAO($pdo);
    }

    public function index() {
        $pedidos = $this->pedidoDAO->findAll();
        require_once 'views/pedidos/lista.php';
    }

    public function details() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            setFlash('danger', 'ID do pedido não fornecido.');
            header('Location: /pedidos/lista');
            exit;
        }

        $pedido = $this->pedidoDAO->findById((int)$id);
        if (!$pedido) {
            setFlash('danger', 'Pedido não encontrado.');
            header('Location: /pedidos/lista');
            exit;
        }
        require_once 'views/pedidos/detalhes.php';
    }

    public function create() {
        $clientes = $this->clienteDAO->findAll();
        $produtos = $this->produtoDAO->findAll();
        require_once 'views/pedidos/form.php';
    }

    public function store() {
        $clienteId = $_POST['cliente_id'] ?? null;
        $produtos = $_POST['produtos'] ?? []; // Array de produto_ids
        $quantidades = $_POST['quantidades'] ?? [];
        $precos = $_POST['precos'] ?? [];

        if (!$clienteId || empty($produtos)) {
            setFlash('danger', 'Cliente e ao menos um produto são obrigatórios.');
            header('Location: /pedidos/lista');
            exit;
        }

        $valorTotal = 0;
        $pedido = new Pedido();
        $pedido->setClienteId($clienteId);

        foreach ($produtos as $index => $produtoId) {
            $qtd = (int)($quantidades[$index] ?? 1);
            $preco = (float)($precos[$index] ?? 0);

            $item = new PedidoItem();
            $item->setProdutoId($produtoId);
            $item->setQuantidade($qtd);
            $item->setPrecoUnitario($preco);

            $pedido->addItem($item);
            $valorTotal += ($qtd * $preco);
        }
        $pedido->setValorTotal($valorTotal);

        try {
            if ($this->pedidoDAO->save($pedido)) {
                setFlash('success', 'Pedido realizado com sucesso!');
                header('Location: /pedidos/lista');
                exit;
            }
        } catch (Exception $e) {
            setFlash('danger', $e->getMessage());
        }

        header('Location: /pedidos/lista');
        exit;
    }

    public function cancel() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            setFlash('danger', 'ID do pedido não fornecido.');
            header('Location: /pedidos/lista');
            exit;
        }

        try {
            if ($this->pedidoDAO->cancelPedido((int)$id, $this->produtoDAO)) {
                setFlash('success', 'Pedido cancelado com sucesso e estoque restaurado!');
            }
        } catch (Exception $e) {
            setFlash('danger', $e->getMessage());
        }

        header('Location: /pedidos/lista');
        exit;
    }
}
