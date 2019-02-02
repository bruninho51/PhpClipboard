<?php
namespace PhpClipboard\Contracts;

interface IPhpClipboardEntry {
    public function wrap(String $wrap) : bool;
    public function wrapAll(String $wrap) : bool;
    public function wrapInner(String $wrap) : bool;
    public function putClass(String $class, array $types = []) : IPhpClipboardEntry;
    public function attr(String $keyAttr, String $valueAttr) : IPhpClipboardEntry;
    public function show() : void;
    public function label() : void;
    public function options(int $optIdx = 0);
    public function optionsIterator() : \ArrayIterator;
}

