<?php
namespace PhpClipboard\Contracts;

interface IPhpClipboardEntry {
    public function wrap(String $wrap) : bool;
    public function wrapAll(String $wrap) : bool;
    public function wrapInner(String $wrap) : bool;
    public function setClass(String $class, array $types = []) : IPhpClipboardEntry;
    public function addAttr(String $keyAttr, String $valueAttr) : IPhpClipboardEntry;
    public function show() : void;
    public function label() : void;
}

