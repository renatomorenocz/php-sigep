<?php
namespace PhpSigep\Model;
use PhpSigep\Bootstrap;
use PhpSigep\InvalidArgument;


class SolicitaPostagemReversa extends AbstractModel
{

    /**
     * @var int
     */
    protected $servicoDePostagem;
    
    /**
     * Opcional.
     * Quando não informado será usado o valor retornado pelo método {@link \PhpSigep\Bootstrap::getConfig() }
     * @var AccessData
     */
    protected $accessData;
    
    /**
     * Dados da pessoa que vai receber esta encomenda.
     * @var Destinatario
     */
    protected $destinatario;
    
    /**
     * Coletas a serem solicitadas a logistica Reversa
     * @var Coleta[]
     */
    protected $coletas;

    /**
     * @return \PhpSigep\Model\AccessData
     */
    public function getAccessData()
    {
        return ($this->accessData ? $this->accessData : Bootstrap::getConfig());
    }

    /**
     * @param AccessData $accessData
     *      Opcional.
     *      Quando null será usado o valor retornado pelo método {@link \PhpSigep\Bootstrap::getConfig() }
     */
    public function setAccessData(AccessData $accessData)
    {
        $this->accessData = $accessData;
    }

    /**
     * @return ServicoDePostagemhttp://www.webgenium.com.br/
     */
    public function getServicoDePostagem()
    {
        return $this->servicoDePostagem;
    }

    /**
     * @param int|ServicoDePostagem $servicoDePostagem
     * @throws \PhpSigep\InvalidArgument
     */
    public function setServicoDePostagem($servicoDePostagem)
    {
        if (is_int($servicoDePostagem)) {
            $servicoDePostagem = new \PhpSigep\Model\ServicoDePostagem($servicoDePostagem);
        }
        
        if (!($servicoDePostagem instanceof ServicoDePostagem)) {
            throw new InvalidArgument('Serviço de postagem deve ser um integer ou uma instância de ' .
                '\PhpSigep\Model\ServicoDePostagem.');
        }
        
        $this->servicoDePostagem = $servicoDePostagem;
    }
    
    
    /**
     * @param \PhpSigep\Model\Coleta[] $coletas
     */
    public function setColetas($coletas)
    {
        $this->coletas = $coletas;
    }

    /**
     * @return \PhpSigep\Model\Coleta[]
     */
    public function getColetas()
    {
        return (array) $this->coletas;
    }
    
    /**
     * @param \PhpSigep\Model\Destinatario $destinatario
     */
    public function setDestinatario($destinatario)
    {
        $this->destinatario = $destinatario;
    }

    /**
     * @return \PhpSigep\Model\Destinatario
     */
    public function getDestinatario()
    {
        return $this->destinatario;
    }
}
