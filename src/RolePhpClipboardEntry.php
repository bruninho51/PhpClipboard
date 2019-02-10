<?php
/*
* @author Bruno Mendes Pimenta
* @license GPL
* @package RolePhpClipboardEntry
*/
namespace PhpClipboard;

use \ArrayObject;
use PhpClipboard\Contracts\IRolePhpClipboardEntry;
use PhpClipboard\Contracts\IFormPhpClipboard;

/**
 * Representa uma regra de validação de um campo de formulário.
 */
class RolePhpClipboardEntry implements IRolePhpClipboardEntry
{
    /**
     * @var bool $errors
     */
    private $errors;

    public function __construct()
    {
        $this->errors = new ArrayObject();
    }

    /**
     * Testa a regra.
     * 
     * @return void
     */
    public function validate(IFormPhpClipboard $form) : void
    {
        try {
            $this->role($form);
        } catch (\Exception $ex) {
            $this->errors->append($ex->getMessage());
        }
    }

    /**
     * Diz se um erro ocorreu ao chamar o método validate.
     * 
     * @return bool
     */
    public function hasErrors() : bool
    {
        if ($this->errors->count() > 0) {
            return true;
        }
        return false;
    }

    /**
     * Retorna os errros ocorridos.
     * 
     * @return ArrayObject
     */
    public function getErrors() : ArrayObject
    {
        return $this->errors;
    }

    /**
     * Regra de validação do campo de formulário.
     * Em caso de erro, deve emitir uma exceção.
     * 
     * @param array $data dados enviados pelo usuário via POST
     * 
     * @return void
     */
    protected function role(IFormPhpClipboard $form) : void
    {
        
    }
}