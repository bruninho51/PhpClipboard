<?php
namespace PhpClipboard\Roles;

use PhpClipboard\RolePhpClipboardEntry;
use PhpClipboard\Contracts\IFormPhpClipboard;

class RoleExample extends RolePhpClipboardEntry{
    
    public function role(IFormPhpClipboard $form) : void
    {
        if ($form->data['title'] == '') {
         throw new \Exception('Title is null.');   
        }
    }
}
