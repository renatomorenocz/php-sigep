<?php

namespace PhpSigep\Model;

use PhpSigep\Bootstrap;
use PhpSigep\InvalidArgument;

class PostagemReversa extends AbstractModel {

    /**
     * @var string 
     */
    protected $tipo;

    /**
     * @var string 
     */
    protected $idCliente;

    /**
     * @var string 
     */
    protected $numeroColeta;

    /**
     * @var ObjetoPostagemReversa[] 
     */
    protected $objetos;
    protected $prazo;
    protected $dataSolicitacao;
    protected $horaSolicitacao;

    public function getTipo() {
        return $this->tipo;
    }

    public function getIdCliente() {
        return $this->idCliente;
    }

    public function getNumeroColeta() {
        return $this->numeroColeta;
    }

    public function getObjetos() {
        return $this->objetos;
    }

    public function setTipo($tipo) {
        if (is_string($tipo)) {
            $tipo = new \PhpSigep\Model\TipoColeta($tipo);
        }

        if (!($tipo instanceof TipoColeta)) {
            throw new InvalidArgument('tipo deve ser uma string ou uma instância de ' .
            '\PhpSigep\Model\TipoColeta.');
        }

        $this->tipo = $tipo;
    }

    public function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    public function setNumeroColeta($numeroColeta) {
        $this->numeroColeta = $numeroColeta;
    }

    public function setObjetos(array $objetos) {
        $this->objetos = $objetos;
    }

    public function getPrazo() {
        return $this->prazo;
    }

    public function getDataSolicitacao() {
        return $this->dataSolicitacao;
    }

    public function getHoraSolicitacao() {
        return $this->horaSolicitacao;
    }

    public function setPrazo($prazo) {
        $this->prazo = $prazo;
    }

    public function setDataSolicitacao($dataSolicitacao) {
        $this->dataSolicitacao = $dataSolicitacao;
    }

    public function setHoraSolicitacao($horaSolicitacao) {
        $this->horaSolicitacao = $horaSolicitacao;
    }

    public function addObj($obj) {
        $this->objetos[] = $obj;
    }

}
