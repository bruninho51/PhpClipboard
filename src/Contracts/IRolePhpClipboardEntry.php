<?php
/*
* @author Bruno Mendes Pimenta
* @license GPL
* @package IRolePhpClipboardEntry
*/
namespace PhpClipboard\Contracts;

use \ArrayObject;

interface IRolePhpClipboardEntry
{
    public function validate() : void;
    public function hasErrors() : bool;
    public function getErrors() : ArrayObject;
}