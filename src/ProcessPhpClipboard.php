<?php
/*
* @author Bruno Mendes Pimenta
* @license GPL
* @package ProcessPhpClipboard
*/
namespace PhpClipboard;

/**
 * Responsável por encaminhar os dados dos formulários para o método responsável
 * pelo processamento.
 */
class ProcessPhpClipboard extends MyProcessPhpClipboard
{
    /**
     * Chama o método responsável pelo processamento do formulário, passando
     * os dados enviados pelo cliente. Esse método deverá ser chamado no controlador
     * que recebe os dados dos formulários.
     * 
     * @var String $process Método da classe MyProcessPhpClipboard que processará os dados.
     * @var array $dadosForm Dados enviados pelo cliente no formato de array.
     */
    public static function processClipboard(String $process, array $dadosForm) : void
    {
        $issetProcessOnClass = !(array_search($process, get_class_methods('\lib\MyProcessPhpClipboard')) === false);
        $noProcessNullOrEmpty = !(empty($process) || is_null($process));

        if ($noProcessNullOrEmpty && $issetProcessOnClass) {

            parent::$process($dadosForm);
        } else {
            throw new PhpClipboardException("1");
        }
    }

}