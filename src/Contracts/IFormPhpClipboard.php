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
    public function allEntries() : \ArrayObject;
    public function entriesIterator() : \ArrayIterator;
    public function getCss() : String;
    public function getScript() : String;
    public function putInfo(array $data) : void;
    public function putInput(array $data) : IPhpClipboardEntry;
    public function putInputComponent(array $data) : IPhpClipboardEntry;
    public function putData(array $data) : void;
}