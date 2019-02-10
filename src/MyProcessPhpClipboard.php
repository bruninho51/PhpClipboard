<?php
/*
* @author Bruno Mendes Pimenta
* @license GPL
* @package MyProcessPhpClipboard
*/
namespace PhpClipboard;

use PhpClipboard\Contracts\IFormPhpClipboard;

/**
 * Classe onde o programador deverá criar os métodos 
 * Que processarão o formulário
 */
class MyProcessPhpClipboard
{
    /**
     * Exemplo de método de processamento de formulário que 
     * o programador deverá criar.
     * 
     * @var Form $form Recebe os dados enviados pelo formulário
     */
    function myProcessFailureExample(IFormPhpClipboard $form)
    {
        echo $form->getHTML('Action.php', 'default');
    }
    
    /**
     * Exemplo de método de processamento de formulário que 
     * o programador deverá criar.
     * 
     * @var Form $form Recebe os dados enviados pelo formulário
     */
    function myProcessSuccessExample(IFormPhpClipboard $form)
    {
        echo 'Form validate success';
    }
}
