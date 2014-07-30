<?php

namespace PhpSigep\Model;

use PhpSigep\Bootstrap;
use PhpSigep\InvalidArgument;

class AcompanhaPostagemReversa extends AbstractModel {

    const TIPO_BUSCA_TODOS = 'H';
    const TIPO_BUSCA_ULTIMO = 'U';

    protected $accessData;
    protected $postagemReversa;
    protected $tipoBusca;

    /**
     * @return \PhpSigep\Model\AccessData
     */
    public function getAccessData() {
        return ($this->accessData ? $this->accessData : Bootstrap::getConfig());
    }

    /**
     * @param AccessData $accessData
     *      Opcional.
     *      Quando null será usado o valor retornado pelo método {@link \PhpSigep\Bootstrap::getConfig() }
     */
    public function setAccessData(AccessData $accessData) {
        $this->accessData = $accessData;
    }

    public function getPostagemReversa() {
        return $this->postagemReversa;
    }

    public function setPostagemReversa($postagemReversa) {
        $this->postagemReversa = $postagemReversa;
    }

    public function getTipoBusca() {
        return $this->tipoBusca;
    }

    public function setTipoBusca($tipoBusca) {
        $this->tipoBusca = $tipoBusca;
    }

}
