<?php
/*
* @author Bruno Mendes Pimenta
* @license GPL
* @package IFormPhpClipboard
*/
namespace PhpClipboard\Contracts;

use PhpClipboard\PhpClipboardEntry;

interface IFormPhpClipboard
{
    public function getHTML() : String;
    public function input(int $idx) : PhpClipboardEntry;
    public function getCss() : String;
    public function getScript() : String;
    public function putInfo(array $data) : void;
    public function putInput(array $data) : void;
}