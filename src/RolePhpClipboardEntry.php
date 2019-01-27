<?php
/*
* @author Bruno Mendes Pimenta
* @license GPL
* @package RolePhpClipboardEntry
*/
namespace PhpClipboard;

use \ArrayObject;

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
    public function validate() : void
    {
        try {
            $this->role();
        } catch (Exception $ex) {
            $this->errors[] = $ex->getMessage();
        }
    }

    /**
     * Diz se um erro ocorreu ao chamar o método validate.
     * 
     * @return bool
     */
    public function hasErrors() : bool
    {
        if ($this->errors) {
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
     * @return bool
     */
    protected function role() : bool
    {
        return true;
    }
}