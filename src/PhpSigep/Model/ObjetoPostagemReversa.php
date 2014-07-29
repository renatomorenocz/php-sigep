<?php

namespace PhpSigep\Model;

use PhpSigep\Bootstrap;
use PhpSigep\InvalidArgument;

class ObjetoPostagemReversa extends AbstractModel {

    protected $id;
    protected $status;
    protected $etiqueta;

    public function getId() {
        return $this->id;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getEtiqueta() {
        return $this->etiqueta;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setEtiqueta($etiqueta) {
        $this->etiqueta = $etiqueta;
    }

}
