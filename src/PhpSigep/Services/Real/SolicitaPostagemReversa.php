<?php

namespace PhpSigep\Services\Real;

use PhpSigep\Model\AbstractModel;
use PhpSigep\Services\Exception;
use PhpSigep\Services\Result;

class SolicitaPostagemReversa implements RealServiceInterface {
    /*     * SoapClient
     * @param \PhpSigep\Model\AbstractModel|\PhpSigep\Model\SolicitaLogisticaReversa $params
     *
     * @throws \PhpSigep\Services\Exception
     * @throws InvalidArgument
     * @return Result<LogisticaReversa[]>
     */

    public function execute(AbstractModel $params) {
        if (!$params instanceof \PhpSigep\Model\SolicitaPostagemReversa) {
            throw new InvalidArgument();
        }

        $soapArgs = array(
            'usuario'             => $params->getAccessData()->getUsuario(),
            'senha'               => $params->getAccessData()->getSenha(),
            'codAdministrativo'   => $params->getAccessData()->getCodAdministrativo(),
            'contrato'            => $params->getAccessData()->getNumeroContrato(),
            'cartao  '            => $params->getAccessData()->getCartaoPostagem(),
            'codigo_servico'      => $params->getServicoDePostagem()->getCodigo(),
            'destinatario'        => $this->getDestinatarioArray($params->getDestinatario()),
            'coletas_solicitadas' => $this->getColetasArray($params)
        );

        $result = new Result();

        try {
            if (!$params->getAccessData() || !$params->getAccessData()->getUsuario() || !$params->getAccessData()->getSenha()
            ) {
                throw new Exception('Para usar este serviço você precisa setar o nome de usuário e senha.');
            }

            $r = SoapClientFactory::getSoapLogisticaReversa()->solicitarPostagemReversa($soapArgs);
            
            
            $postagens = array();
            
            foreach ((array)$r->return->resultado_solicitacao as $postagem) {
                if (!key_exists($postagem->numero_coleta, $postagens)){
                    $postagens[$postagem->numero_coleta] = new \PhpSigep\Model\PostagemReversa();
                    
                    $postagens[$postagem->numero_coleta]->setTipo($postagem->tipo);
                    $postagens[$postagem->numero_coleta]->setIdCliente($postagem->id_cliente);
                    $postagens[$postagem->numero_coleta]->setNumeroColeta($postagem->numero_coleta);
                    $postagens[$postagem->numero_coleta]->setPrazo($postagem->prazo);
                    $postagens[$postagem->numero_coleta]->setDataSolicitacao($postagem->data_solicitacao);
                    $postagens[$postagem->numero_coleta]->setHoraSolicitacao($postagem->hora_solicitacao);                    
                } 
                
                $obj = new \PhpSigep\Model\ObjetoPostagemReversa();
                $obj->setEtiqueta($postagem->numero_etiqueta);
                $obj->setId($postagem->id_obj);
                $obj->setStatus($postagem->status_objeto);
                
                $postagens[$postagem->numero_coleta]->addObj($obj);
            }
            
            $postagemReversaResultado = new \PhpSigep\Model\PostagemReversaResultado();
            $postagemReversaResultado->setPostagenReversas(array_values($postagens));
            
            $result->setResult($postagemReversaResultado);
            
            
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
