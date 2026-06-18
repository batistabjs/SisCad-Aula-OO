<?php
// models/Usuario.php

class Usuario {
    private $id;
    private $usuario;
    private $senha;
    private $perfil;

    public function __construct($id = null, $usuario = null, $senha = null, $perfil = null) {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->senha = $senha;
        $this->perfil = $perfil;
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getUsuario() { return $this->usuario; }
    public function setUsuario($usuario) { $this->usuario = $usuario; }

    public function getSenha() { return $this->senha; }
    public function setSenha($senha) { $this->senha = $senha; }

    public function getPerfil() { return $this->perfil; }
    public function setPerfil($perfil) { $this->perfil = $perfil; }
}
