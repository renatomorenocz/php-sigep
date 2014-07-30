<?php

namespace PhpSigep\Services\Real;

use PhpSigep\Model\AbstractModel;
use PhpSigep\Services\Exception;
use PhpSigep\Services\Result;

class CancelaPostagemReversa implements RealServiceInterface {
    
    public function execute(AbstractModel $params) {
        if (!$params instanceof \PhpSigep\Model\CancelaPostagemReversa) {
            throw new InvalidArgument();
        }

        $soapArgs = array(
            'usuario'             => $params->getAccessData()->getUsuario(),
            'senha'               => $params->getAccessData()->getSenha(),
            'codAdministrativo'   => $params->getAccessData()->getCodAdministrativo(),
            'numeroPedido'        => $params->getPostagemReversa()->getNumeroColeta(),
            'tipo'                => $params->getPostagemReversa()->getTipo()->getCodigo(),
        );
        
        var_dump($soapArgs);
        

        $result = new Result();

        try {
            if (!$params->getAccessData() || !$params->getAccessData()->getUsuario() || !$params->getAccessData()->getSenha()
            ) {
                throw new Exception('Para usar este serviço você precisa setar o nome de usuário e senha.');
            }

            $result = SoapClientFactory::getSoapLogisticaReversa()->cancelarPedido($soapArgs);
            
         
            
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

    /**
     * @param \PhpSigep\Model\AbstractModel|\PhpSigep\Model\SolicitaPostagemReversa $params
     *
     * @return array
     */
    private function getColetasArray($params) {

        $coletas = $params->getColetas();
        $coletasReturn = array();        

        foreach ($coletas as $coleta) {            
            $coletasReturn[] = array(
                'tipo' => $coleta->getTipo()->getCodigo(),
                'numero' => $coleta->getNumero(),
                'id_cliente' => $coleta->getIdCliente() ,
                'ag' => $coleta->getAg(),
                'valor_declarado' => $coleta->getValorDeclarado(),
                'servico_adicional' => $this->getCodigosServicosAdicionais((array)$coleta->getServicosAdicionais()),
                'ar' => (int) $coleta->getAr(),
                'cklist' => $coleta->getCklist() ,
                'remetente' => $this->getRemetenteArray($coleta->getRemetente()),
                'obj_col'   => $this->getObjetosColetaArray($coleta->getObjetosColeta())                 
            );
        }
        
        return $coletasReturn;
    }
    
    
    private function getCodigosServicosAdicionais ($servicosAdicionais) {
        $codigos = array();
        foreach ($servicosAdicionais as $servicos) {
            $codigos[] = $servicos->getCodigoServicoAdicional();
        }
        
        return implode(',', $codigos);
    }
    
    private function getObjetosColetaArray($objetos) {
        $objetosReturn = array();
        foreach ($objetos as $objeto) {
            $objetosReturn[] = array(
                'item' => $objeto->getItem(),
                'id' => $objeto->getId(),
                'desc' => $objeto->getDescricao(),
                'entrega' => $objeto->getEntrega(),
                'num' => $objeto->getNum()
            );
        }
        
        return $objetosReturn;
    }
    

    private function getDestinatarioArray($destinatario) {
        
        $destinatarioReturn = array(
            'nome' => $destinatario->getNome(),
            'logradouro' => $destinatario->getLogradouro(),
            'numero' => $destinatario->getNumero(),
            'complemento' => $destinatario->getComplemento(),
            'bairro' => $destinatario->getBairro(),
            'cidade' => $destinatario->getCidade(),
            'uf' => $destinatario->getUf(),
            'cep' => $destinatario->getCep(),
            'ddd' => $destinatario->getDdd(),
            'telefone' => $destinatario->getTelefone(),
            'email' => $destinatario->getEmail()
        );
        
        return $destinatarioReturn;
    }

    /**
     * @param \PhpSigep\Model\Remetente $remetente
     * @return array
     */
    private function getRemetenteArray($remetente) {
        $remetenteReturn = array(
            'nome' => $remetente->getNome(),
            'logradouro' => $remetente->getLogradouro(),
            'numero' => $remetente->getNumero(),
            'complemento' => $remetente->getComplemento(),
            'bairro' => $remetente->getBairro(),
            'cidade' => $remetente->getCidade(),
            'uf' => $remetente->getUf(),
            'cep' => $remetente->getCep(),
            'ddd' => $remetente->getDdd(),
            'telefone' => $remetente->getTelefone(),
            'email' => $remetente->getEmail(),
            'celular' => $remetente->getCelular(),
            'ddd_celular' => $remetente->getDddCelular(),
            'sms' => ($remetente->getSms()) ? 'S': 'N',
            'identificacao'=> $remetente->getIdentificacao()
        );

        return $remetenteReturn;
    }

}
