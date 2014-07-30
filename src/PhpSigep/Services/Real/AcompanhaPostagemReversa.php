<?php

namespace PhpSigep\Services\Real;

use PhpSigep\Model\AbstractModel;
use PhpSigep\Services\Exception;
use PhpSigep\Services\Result;

class AcompanhaPostagemReversa implements RealServiceInterface {
    
    public function execute(AbstractModel $params) {
        if (!$params instanceof \PhpSigep\Model\AcompanhaPostagemReversa) {
            throw new InvalidArgument();
        }

        $soapArgs = array(
            'usuario'             => $params->getAccessData()->getUsuario(),
            'senha'               => $params->getAccessData()->getSenha(),
            'codAdministrativo'   => $params->getAccessData()->getCodAdministrativo(),
            'numeroPedido'        => $params->getPostagemReversa()->getNumeroColeta(),
            'tipoBusca'           => $params->getTipoBusca(),
            'tipoSolicitacao'     => $params->getPostagemReversa()->getTipo()->getCodigo()
        );
        
        var_dump($soapArgs);
        

        $result = new Result();

        try {
            if (!$params->getAccessData() || !$params->getAccessData()->getUsuario() || !$params->getAccessData()->getSenha()
            ) {
                throw new Exception('Para usar este serviço você precisa setar o nome de usuário e senha.');
            }

            $result = SoapClientFactory::getSoapLogisticaReversa()->acompanharPedido($soapArgs);
            
         
            
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
