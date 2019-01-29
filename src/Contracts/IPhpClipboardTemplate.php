<?php
/*
* @author Bruno Mendes Pimenta
* @license GPL
* @package FormPhpClipboard
*/

namespace PhpClipboard\Contracts;

use PhpClipboard\PhpClipboardEntry;

interface IPhpClipboardTemplate{
    public function id() : String;
    public function name() : String;
    public function description() : String;
    public function entries(int $inputIdx);
    public function method() : String;
    public function clipboardController() : String;
    public function scripts() : String;
    public function CSS() : String;
}
