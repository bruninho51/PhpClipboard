<?php
/*
* @author Bruno Mendes Pimenta
* @license GPL
* @package IRolePhpClipboardEntry
*/
namespace PhpClipboard\Contracts;

use \ArrayObject;
use PhpClipboard\Contracts\IFormPhpClipboard;

interface IRolePhpClipboardEntry
{
    public function validate(IFormPhpClipboard $form) : void;
    public function hasErrors() : bool;
    public function getErrors() : ArrayObject;
}