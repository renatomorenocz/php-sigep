<?php

namespace PhpSigep\Model;


class ObjetoColeta extends AbstractModel {
    
    protected $descricao;
    
    protected $entrega;
    
    protected $id;
    
    protected $item = 1;
    
    protected $num;
    
    public function getDescricao() {
        return $this->descricao;
    }

    public function getEntrega() {
        return $this->entrega;
    }

    public function getId() {
        return $this->id;
    }

    public function getItem() {
        return $this->item;
    }

    public function getNum() {
        return $this->num;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
        return $this;
    }

    public function setEntrega($entrega) {
        $this->entrega = $entrega;
        return $this;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setItem($item) {
        $this->item = $item;
        return $this;
    }

    public function setNum($num) {
        $this->num = $num;
        return $this;
    }
}
