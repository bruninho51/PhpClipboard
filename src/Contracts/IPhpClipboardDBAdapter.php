<?php
/*
* @author Bruno Mendes Pimenta
* @license GPL
* @package IPhpClipboardDBAdapter
*/
namespace PhpClipboard\Contracts;

interface IPhpClipboardDBAdapter
{
    public function getForm(int $formIdx) : array;
    public function getFormEntries(int $formIdx) : array;
    public function getEntryRoles(int $inputIdx) : array;
    public function getEntryOpt(int $inputIdx) : array;
}