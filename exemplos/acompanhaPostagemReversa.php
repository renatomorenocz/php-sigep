<?php

// Altera as configurações do PHP para mostrar todos os erros, já que este é apenas um script de exemplo.
// No seu ambiente de produção, você não vai precisar alterar estas configurações.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', 'E_ALL|E_STRICT');
error_reporting(E_ALL);

header('Content-Type: text/html; charset=utf-8');

// Configura o php-sigep
// Se você não usou o composer é necessário carregar o script Boostrap.php manualmente.
// Caso você tenha usado o composer o Bootstrap PHP será carregado automáticamente pelo autoload (quando necessário).
//require_once __DIR__ . '/../src/PhpSigep/Bootstrap.php';
require_once __DIR__ . '/../vendor/autoload.php';

$accessData= new \PhpSigep\Model\AccessData(array(
    'usuario' => '60618043',
    'senha' => '8o8otn',
    'codAdministrativo' => '08082650',
    'numeroContrato' => '9912208555',
    'cartaoPostagem' => '0057018901',
    'codigoServico' => '0057018901',
    'cnpjEmpresa' => null, // Não consta no manual.
    'anoContrato' => null, // Não consta no manual.
    'diretoria' => new \PhpSigep\Model\Diretoria(\PhpSigep\Model\Diretoria::DIRETORIA_DR_RIO_DE_JANEIRO), // Não consta no manual, mas precisamos setar um valor para conseguir imprimir as etiquetas.
        ));

$config = new \PhpSigep\Config();
$config->setAccessData($accessData);
$config->setEnv(\PhpSigep\Config::ENV_DEVELOPMENT);
$config->setCacheOptions(
        array(
            'storageOptions' => array(
                // Qualquer valor setado neste atributo será mesclado ao atributos das classes 
                // "\PhpSigep\Cache\Storage\Adapter\AdapterOptions" e "\PhpSigep\Cache\Storage\Adapter\FileSystemOptions".
                // Por tanto as chaves devem ser o nome de um dos atributos dessas classes.
                'enabled' => false,
                'ttl' => 10, // "time to live" de 10 segundos
                'cacheDir' => sys_get_temp_dir(), // Opcional. Quando não informado é usado o valor retornado de "sys_get_temp_dir()"
            ),
        )
);

\PhpSigep\Bootstrap::start($config);

$phpSigep = new PhpSigep\Services\SoapClient\Real();

$postagemReversa = new PhpSigep\Model\PostagemReversa();
$postagemReversa->setTipo(PhpSigep\Model\TipoColeta::TIPO_COLETA);
$postagemReversa->setNumeroColeta('010097321');

$params = new PhpSigep\Model\AcompanhaPostagemReversa();
$params->setAccessData($accessData);
$params->setTipoBusca(PhpSigep\Model\AcompanhaPostagemReversa::TIPO_BUSCA_ULTIMO);
$params->setPostagemReversa($postagemReversa);

echo '<pre>';
print_r($phpSigep->acompanhaPostagemReversa($params));


