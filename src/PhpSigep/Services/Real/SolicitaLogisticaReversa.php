<?php
namespace PhpSigep\Services\Real;

use PhpSigep\Model\AbstractModel;
use PhpSigep\Model\Etiqueta;
use PhpSigep\Services\Exception;
use PhpSigep\Services\Result;


class SolicitaLogisticaReversa implements RealServiceInterface
{

    /**SoapClient
     * @param \PhpSigep\Model\AbstractModel|\PhpSigep\Model\SolicitaLogisticaReversa $params
     *
     * @throws \PhpSigep\Services\Exception
     * @throws InvalidArgument
     * @return Result<LogisticaReversa[]>
     */
    public function execute(AbstractModel $params)
    {
        if (!$params instanceof \PhpSigep\Model\SolicitaLogisticaReversa) {
            throw new InvalidArgument();
        }
        
        $soapArgs = array(
            'usuario'          => $params->getAccessData()->getUsuario(),
            'senha'            => $params->getAccessData()->getSenha(),
            'codAdministrativo'=> $params->getAccessData()->getCodAdministrativo(),
            'contrato'         => $params->getAccessData()->getNumeroContrato(),
            'cartao  '         => $params->getAccessData()->getCartaoPostagem(),
            'codigo_servico'   => $params->getServicoDePostagem()->getCodigo()
        );

        $result = new Result();
        
        try {
            if (!$params->getAccessData() || !$params->getAccessData()->getUsuario()
                || !$params->getAccessData()->getSenha()
            ) {
                throw new Exception('Para usar este serviço você precisa setar o nome de usuário e senha.');
            }
            
            $result = SoapClientFactory::getSoapLogisticaReversa()->solicitarPostagemReversa($soapArgs);
            
           
            
         
        } catch (\Exception $e) {
            if ($e instanceof \SoapFault) {
                $result->setIsSoapFault(true);
                $result->setErrorCode($e->getCode());
                $result->setErrorMsg("Resposta do Correios: " . SoapClientFactory::convertEncoding($e->getMessage()));
            } else {
                $result->setErrorCode($e->getCode());
                $result->setErrorMsg($e->getMessage());
            }
        }

        return $result;
    }
}
