<?php

namespace PhpSigep\Model;

class TipoColeta extends AbstractModel {

    const TIPO_COLETA = 'C';
    const TIPO_AUTORIZACAO_POSTAGEM = 'A';
    const TIPO_COLETA_AUTORIZACAO_POSTAGEM = 'CA';

    private static $tipo = array(
        self::TIPO_COLETA => array('Coleta', 'C'),
        self::TIPO_AUTORIZACAO_POSTAGEM => array('Autorização Postagem', 'A'),
        self::TIPO_COLETA_AUTORIZACAO_POSTAGEM => array('Coleta ou Autorização de Postagem', 'CA')
    );

    /**
     * Código do serviço adicional Caractere (002) Obrigatório.
     * Uma das constantes {@link TipoColeta}::TIPO_*.
     * @var int
     */
    protected $codigo;

    /**
     * @var string
     */
    protected $nome;

    public function __construct($tipoCode) {
        $tipoCode = (string) $tipoCode;
        if (!isset(self::$tipo[$tipoCode])) {
            throw new Exception('There is no service with the code "' . $tipoCode . '".');
        }

        $service = self::$tipo[$tipoCode];
        parent::__construct(
                array(
                    'codigo' => $tipoCode,
                    'nome' => $service[0],
                )
        );
    }

    public function is($codigo) {
        return $codigo == $this->getCodigoTipoColeta();
    }

    /**
     * @param int $codigo
     */
    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    /**
     * @return int
     */
    public function getCodigo() {
        return $this->codigo;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

}
