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

 
$destinatario = new \PhpSigep\Model\Destinatario();
$destinatario->setNome('Fulano');
$destinatario->setLogradouro('Qd 301');
$destinatario->setNumero('10');
$destinatario->setComplemento('Residencial Central');
$destinatario->setBairro('Centro');
$destinatario->setCep('70002900');
$destinatario->setUf('DF');
$destinatario->setCidade('Brasília');

$remetente = new \PhpSigep\Model\Remetente();
$remetente->setNome('Ciclano');
$remetente->setLogradouro('Rua João Negrão');
$remetente->setNumero('1251');
$remetente->setComplemento('Bloco II');
$remetente->setBairro('Centro');
$remetente->setCep('80002900');
$remetente->setUf('PR');
$remetente->setCidade('Curitiba');
$remetente->setSms(false);

$objColeta = array();
$objColeta[] = new \PhpSigep\Model\ObjetoColeta();       

$coleta = new \PhpSigep\Model\Coleta();
$coleta->setCklist(\PhpSigep\Model\Coleta::CHECKLIST_CELULAR);
$coleta->setIdCliente('2544');
$coleta->setValorDeclarado(100.00);
$coleta->setAg(5);
$coleta->setAr(true);
$coleta->setTipo(\PhpSigep\Model\Coleta::TIPO_AUTORIZACAO_POSTAGEM);
$coleta->setRemetente($remetente);
$coleta->setObjetosColeta($objColeta);

$coleta2 = new \PhpSigep\Model\Coleta();
$coleta2->setCklist(\PhpSigep\Model\Coleta::CHECKLIST_CELULAR);
$coleta2->setIdCliente('3030');
$coleta2->setValorDeclarado(100.00);
$coleta2->setAg('05/08/2014');
$coleta2->setAr(false);
$coleta2->setTipo(\PhpSigep\Model\Coleta::TIPO_COLETA);
$coleta2->setRemetente($remetente);
$coleta2->setObjetosColeta($objColeta);

$coletas = array($coleta,$coleta2);

$params = new PhpSigep\Model\SolicitaPostagemReversa();
$params->setAccessData($accessData);
$params->setDestinatario($destinatario);
$params->setServicoDePostagem(new \PhpSigep\Model\ServicoDePostagem(\PhpSigep\Model\ServicoDePostagem::SERVICE_PAC_41068));
$params->setColetas($coletas);

$phpSigep = new PhpSigep\Services\SoapClient\Real();

echo '<pre>';
print_r($phpSigep->solicitaPostagemReversa($params));



     


