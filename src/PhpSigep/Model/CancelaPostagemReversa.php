<?php

namespace PhpSigep\Model;

use PhpSigep\Bootstrap;
use PhpSigep\InvalidArgument;

class CancelaPostagemReversa extends AbstractModel {

    protected $accessData;
    protected $postagemReversa;

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

}
