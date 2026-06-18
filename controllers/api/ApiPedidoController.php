<?php
// controllers/api/ApiPedidoController.php

class ApiPedidoController {
    private $pedidoDAO;

    public function __construct() {
        $pdo = Database::getInstance()->getConnection();
        $this->pedidoDAO = new PedidoDAO($pdo);
    }

    private function validateApiKey() {
        $headers = getallheaders();
        $apiKey = $headers['chave_nossa_api'] ?? '';
        $config = require 'config/api.php';

        if ($apiKey !== $config['chave_nossa_api']) {
            http_response_code(401);
            echo json_encode(['error' => 'Não autorizado: Chave de API inválida ou ausente.']);
            exit;
        }
    }

    public function index() {
        $this->validateApiKey();
        
        try {
            $pedidos = $this->pedidoDAO->findAll();
            header('Content-Type: application/json');
            echo json_encode($pedidos);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function show($id) {
        $this->validateApiKey();
        
        try {
            $pedido = $this->pedidoDAO->findById((int)$id);
            if (!$pedido) {
                http_response_code(404);
                echo json_encode(['error' => 'Pedido não encontrado.']);
                return;
            }

            header('Content-Type: application/json');
            
            // Converter objeto Pedido para array para facilitar o JSON
            $pedidoData = [
                'id' => $pedido->getId(),
                'cliente_id' => $pedido->getClienteId(),
                'data_pedido' => $pedido->getDataPedido(),
                'valor_total' => $pedido->getValorTotal(),
                'status' => $pedido->getStatus(),
                'itens' => []
            ];

            foreach ($pedido->getItens() as $item) {
                $pedidoData['itens'][] = [
                    'id' => $item->getId(),
                    'produto_id' => $item->getProdutoId(),
                    'quantidade' => $item->getQuantidade(),
                    'preco_unitario' => $item->getPrecoUnitario()
                ];
            }

            echo json_encode($pedidoData);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
