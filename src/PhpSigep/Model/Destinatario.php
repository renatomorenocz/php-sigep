<?php
namespace PhpSigep\Model;

/**
 * @author: Stavarengo
 */
class Destinatario extends AbstractModel
{

    /**
     * Nome do destinatário.
     * Obrigatório.
     * Max length: 50
     * Tag: nome_destinatario
     * @var string
     */
    protected $nome;
    /**
     * Telefone do Destinatário.
     * Não Obrigatório.
     * Max length: 12
     * Tag: telefone_destinatario
     * @var string
     */
    protected $telefone;
    
    /**
     * DDD Destinatário.
     * Não Obrigatório.
     * Max length: 3     
     * @var string
     */
    protected $ddd;
    /**
     * Celular do Destinatário.
     * Não Obrigatório.
     * Max length: 12
     * Tag: celular_destinatario
     * @var string
     */
    protected $celular;
    /**
     * Email do Destinatário.
     * Não obrigatório
     * Max length: 50
     * Tag: email_destinatario
     * @var string
     */
    protected $email;
    /**
     * Logradouro do destinatário.
     * Obrigatório.
     * Max length: 50
     * Tag: logradouro_destinatario
     * @var string
     */
    protected $logradouro;
    /**
     * Complemento do endereço.
     * Não obrigatório.Model
     * Max length: 30
     * Tag: complemento_destinatario
     * @var string
     */
    protected $complemento;
    /**
     * Número da casa, prédio, etc. Parte do endereço.
     * Obrigatório.
     * Max length: 6
     * Tag: numero_end_destinatario
     * @var string
     */
    protected $numero;
    
    protected $bairro;    
    protected $cep;
    protected $uf;
    protected $cidade;




    /**
     * @return string
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * @param string $celular
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
    }

    /**
     * @return string
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * @param string $complemento
     */
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getLogradouro()
    {
        return $this->logradouro;
    }

    /**
     * @param string $logradouro
     */
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param string $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return string
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @param string $telefone
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }
    
    /**
     * @return string
     */
    public function getDdd()
    {
        return $this->ddd;
    }

    /**
     * @param string $ddd
     */
    public function setDdd($ddd)
    {
        $this->ddd = $ddd;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
        return $this;
    }

    public function getCep() {
        return $this->cep;
    }

    public function setCep($cep) {
        $this->cep = $cep;
        return $this;
    }

    public function getUf() {
        return $this->uf;
    }

    public function setUf($uf) {
        $this->uf = $uf;
        return $this;
    }


    public function getCidade() {
        return $this->cidade;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
        return $this;
    }


}