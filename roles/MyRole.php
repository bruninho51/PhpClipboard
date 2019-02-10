<?php
namespace PhpClipboard\Roles;

use PhpClipboard\RolePhpClipboardEntry;
use PhpClipboard\Contracts\IFormPhpClipboard;

class MyRole extends RolePhpClipboardEntry{
    
    public function role(IFormPhpClipboard $form) : void
    {
        if (true) {
            throw new \Exception("Erro no campo!");
        } 
    }
}
