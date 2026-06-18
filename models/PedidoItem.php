<?php
// models/PedidoItem.php

class PedidoItem {
    private $id;
    private $pedidoId;
    private $produtoId;
    private $quantidade;
    private $precoUnitario;

    public function __construct($id = null, $pedidoId = null, $produtoId = null, $quantidade = 1, $precoUnitario = 0.0) {
        $this->id = $id;
        $this->pedidoId = $pedidoId;
        $this->produtoId = $produtoId;
        $this->quantidade = $quantidade;
        $this->precoUnitario = $precoUnitario;
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getPedidoId() { return $this->pedidoId; }
    public function setPedidoId($id) { $this->pedidoId = $id; }

    public function getProdutoId() { return $this->produtoId; }
    public function setProdutoId($id) { $this->produtoId = $id; }

    public function getQuantidade() { return $this->quantidade; }
    public function setQuantidade($qtd) { $this->quantidade = $qtd; }

    public function getPrecoUnitario() { return $this->precoUnitario; }
    public function setPrecoUnitario($preco) { $this->precoUnitario = $preco; }
}
