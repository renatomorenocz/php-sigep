<?php

namespace PhpSigep\Model;

/**
 * @author: Stavarengo
 */
class Coleta extends AbstractModel {

    const CHECKLIST_CELULAR = 2;
    const CHECKLIST_ELETRONICO = 4;

    /**
     * Descrição/Instruções para coleta
     * @var string 
     */
    protected $descricao;

    /**
     * Indica que serão impressas vias de checklist.
     * Apenas clientes previamente habilitados
     * podem utilizar essa opção. Código fornecido
     * pela ECT
     * @var int
     */
    protected $cklist;

    /**
     * Campo para preenchimento livre. É um valor para identificação da 
     * solicitação junto ao cliente. Este valor é enviado no arquivo de retorno 
     * gerado após o processamento.
     * @var string 
     */
    protected $idCliente;

    /**
     * Indica se a solicitação é de coleta domiciliária 
     * ou uma autorização de postagem.
     * @var string 
     */
    protected $tipo;

    /**
     * Somatório de todos os valores declarados dos 
     * objetos da coleta. Exemplo: 1020.70
     * @var float 
     */
    protected $valorDeclarado;

    /**
     * Indica se é para solicitar Aviso de Recebimento para as encomendas 
     * cadastradas. Usado apenas para pedidos de Autorização de Postagem.
     * @var bool 
     */
    protected $ar;

    /**
     * Coleta domiciliar: Data para agendamento da coleta. Se informado o pedido
     * fica retido no sistema e a primeira tentativa de coleta é feita apenas na
     * data informada. O sistema aceita apenas datas com mais de cinco dias 
     * corridos a partir da data de processamento do pedido. Ex.:30/11/2014
     * 
     * Autorização de Postagem: Indica a quantidade de dias de validade da 
     * autorização. A validade deve ser de no mínimo 5 e no máximo 60 dias. Se 
     * não for informada, a validade da autorização será de 10 (dez) dias 
     * corridos a partir da data do processamento do pedido. Ex.: 15
     * @var string
     */
    protected $ag;

    /**
     * Número da Autorização de Postagem. Usado quando o cliente já possui uma 
     * faixa numérica desse tipo de solicitação. Esse número será encaminhado no
     * arquivo de retorno.
     * @var int 
     */
    protected $numero;

    /**
     * Lista de Objetos 
     * @var ObjetoColeta[]
     */
    protected $objCol;

    /**
     * Lista de serviços adicionais usados nesta encomenda.
     * @var ServicoAdicional[]
     */
    protected $servicosAdicionais;

    /**
     * Dados da pessoa que vai enviar a encomenda.
     * @var Remetente
     */
    protected $remetente;

    /**
     * @return string
     */
    public function getDescricao() {
        return $this->descricao;
    }

    public function getCklist() {
        return $this->cklist;
    }

    public function getIdCliente() {
        return $this->idCliente;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getValorDeclarado() {
        return $this->valorDeclarado;
    }

    public function getAr() {
        return $this->ar;
    }

    public function getAg() {
        return $this->ag;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setCklist($cklist) {
        $this->cklist = $cklist;
    }

    public function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    public function setTipo($tipo) {
         if (is_string($tipo)) {
            $tipo= new \PhpSigep\Model\TipoColeta($tipo);
        }
        
        if (!($tipo instanceof TipoColeta)) {
            throw new InvalidArgument('tipo deve ser uma string ou uma instância de ' .
                '\PhpSigep\Model\TipoColeta.');
        }
        
        $this->tipo = $tipo;
    }

    public function setValorDeclarado($valorDeclarado) {
        $this->valorDeclarado = $valorDeclarado;
    }

    public function setAr($ar) {
        $this->ar = $ar;
    }

    public function setAg($ag) {
        $this->ag = $ag;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    /**
     * @param \PhpSigep\Model\ObjetoColeta[] $objCol
     */
    public function setObjetosColeta($objCol) {
        $this->objCol = $objCol;
    }

    /**
     * @return \PhpSigep\Model\ObjetoColeta[]
     */
    public function getObjetosColeta() {
        return (array) $this->objCol;
    }

    /**
     * @param \PhpSigep\Model\Remetente $remetente
     */
    public function setRemetente($remetente) {
        $this->remetente = $remetente;
    }

    /**
     * @return \PhpSigep\Model\Remetente
     */
    public function getRemetente() {
        return $this->remetente;
    }

    /**
     * @param \PhpSigep\Model\ServicoAdicional[] $servicosAdicionais
     */
    public function setServicosAdicionais($servicosAdicionais) {
        $this->servicosAdicionais = $servicosAdicionais;
    }

    /**
     * @return \PhpSigep\Model\ServicoAdicional[]
     */
    public function getServicosAdicionais() {
        return (array) $this->servicosAdicionais;
    }

}
