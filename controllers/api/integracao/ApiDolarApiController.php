<?php
// controllers/api/integracao/ApiDolarApiController.php

class ApiDolarApiController {
    public function index() {
        $url = 'https://br.dolarapi.com/v1/cotacoes/usd';

        try {
            $response = @file_get_contents($url);

            if ($response === false) {
                throw new Exception('Não foi possível conectar com a API de cotações.');
            }

            $data = json_decode($response, true);

            if (!$data || !isset($data['venda'])) {
                throw new Exception('Dados de cotação inválidos recebidos da API.');
            }

            header('Content-Type: application/json');
            echo json_encode([
                'valor' => $data['venda'],
                'moeda' => $data['moeda'],
                'data' => $data['dataAtualizacao']
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
