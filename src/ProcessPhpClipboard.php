<?php
/*
* @author Bruno Mendes Pimenta
* @license GPL
* @package ProcessPhpClipboard
*/
namespace PhpClipboard;

use PhpClipboard\MyProcessPhpClipboard;
use PhpClipboard\Contracts\IFormPhpClipboard;

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
     * @var array $form formulário com os dados enviados pelo usuário.
     */
    public static function processClipboard(String $process, IFormPhpClipboard $form) : void
    {
        $issetProcessOnClass = !(array_search($process, get_class_methods(MyProcessPhpClipboard::class)) === false);
        $noProcessNullOrEmpty = !(empty($process) || is_null($process));

        if ($noProcessNullOrEmpty && $issetProcessOnClass) {

            parent::$process($form);
        } else {
            throw new PhpClipboardException("1");
        }
    }
}