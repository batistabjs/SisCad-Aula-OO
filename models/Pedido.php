<?php
// models/Pedido.php

class Pedido {
    private $id;
    private $clienteId;
    private $dataPedido;
    private $valorTotal;
    private $itens = [];

    public function __construct($id = null, $clienteId = null, $dataPedido = null, $valorTotal = 0.0) {
        $this->id = $id;
        $this->clienteId = $clienteId;
        $this->dataPedido = $dataPedido;
        $this->valorTotal = $valorTotal;
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getClienteId() { return $this->clienteId; }
    public function setClienteId($id) { $this->clienteId = $id; }

    public function getDataPedido() { return $this->dataPedido; }
    public function setDataPedido($data) { $this->dataPedido = $data; }

    public function getValorTotal() { return $this->valorTotal; }
    public function setValorTotal($valor) { $this->valorTotal = $valor; }

    public function addItem(PedidoItem $item) {
        $this->itens[] = $item;
    }

    public function getItens() { return $this->itens; }
}
