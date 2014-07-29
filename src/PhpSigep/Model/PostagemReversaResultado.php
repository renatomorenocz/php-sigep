<?php

namespace PhpSigep\Model;

use PhpSigep\Bootstrap;
use PhpSigep\InvalidArgument;

class PostagemReversaResultado extends AbstractModel {

    /**
     *
     * @var PostagemReversa[]
     */
    protected $postagenReversas;

    /**
     * @return PostagemReversa[]
     */
    public function getPostagenReversas() {
        return $this->postagenReversas;
    }

    /**
     * @param PostagemReversa[] $postagenReversas
     */
    public function setPostagenReversas(array $postagenReversas) {
        $this->postagenReversas = $postagenReversas;
    }

}
