<?php
/*
* @author Bruno Mendes Pimenta
* @license GPL
* @package MyProcessPhpClipboard
*/
namespace PhpClipboard;

use PhpClipboard\FormPhpClipboard;

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
     * @var array $data Recebe os dados enviados pelo formulário
     */
    function myProcessExample(FormPhpClipboard $form)
    {

    }
    
    function naoCadastrarTrabalho(FormPhpClipboard $form)
    {
        echo 'não cadastrou';
    }
    
    function cadastrarTrabalho(FormPhpClipboard $form)
    {
        echo 'cadastrou, só que não';
    }

}