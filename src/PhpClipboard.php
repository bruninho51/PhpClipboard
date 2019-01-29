<?php
/*
* @author Bruno Mendes Pimenta
* @license GPL
* @package PhpClipboard
*/
namespace PhpClipboard;

use PhpClipboard\ProcessPhpClipboard;
use PhpClipboard\FormPhpClipboard;
use PhpClipboard\Contracts\IPhpClipboardDBAdapter;

/**
 * Núcleo da biblioteca.
 */
class PhpClipboard{

    /**
     * Recebe um adapter que se comunica com o banco de dados e passa 
     * as devidas informações para a biblioteca.
     * 
     * @var IPhpClipboardDBAdapter $dbAdapter
     */
    private $dbAdapter;

    public function __construct(IPhpClipboardDBAdapter $adapter)
    {
        $this->dbAdapter = $adapter;
    }

    /**
     * Usa o adaptador para pegar as informações do formulário.
     * 
     * @var int $formIdx Chave primária do formulário.
     * @var IPhpClipboardDBAdapter $adapter Objeto que implemente a interface requerida pela biblioteca.
     * 
     * @return array
     */
    private function getFormData(int $formIdx, IPhpClipboardDBAdapter $adapter) : array
    {
        $formData = $adapter->getForm($formIdx, $this->dbAdapter);

        return $formData;
    }

    /**
     * Usa o adaptador para pegar as informações dos campos de determinado formulário.
     * 
     * @var int $formIdx Chave primária do formulário cujos campos devem ser pegos.
     * @var IPhpClipboardDBAdapter $adapter Objeto que implemente a interface requerida pela biblioteca.
     */
    private function getFormEntriesData(int $formIdx, IPhpClipboardDBAdapter $adapter) : array
    {
        $formEntries = $adapter->getFormEntries($formIdx, $this->dbAdapter);
        
        foreach ($formEntries as &$entry) {
            $roles = $adapter->getEntryRoles($entry['idCampo']);
            $entry['roles'] = $roles;
        }

        return $formEntries;
    }

    /**
     * Método que cria e devolve o formulário com base na chave primária.
     * 
     * @var int $formIdx Chave primária do formulário.
     * 
     * @return FormPhpClipboard
     */
    public function getForm(int $formIdx) : FormPhpClipboard
    {
        $formData = $this->getFormData($formIdx, $this->dbAdapter);
        $in = $this->getFormEntriesData($formIdx, $this->dbAdapter);

        $form = new FormPhpClipboard($this->dbAdapter);
        $form->putInfo($formData);

        $iterator = (new \ArrayObject($in))->getIterator();

        while ($iterator->valid()) {
            if (isset($iterator->current()['component'])) {
                $form->putInputComponent($iterator->current());
            } else {
                $form->putInput($iterator->current());
            }
            $iterator->next();
        }
        return $form;
    }

    /**
     * Essa função deve ser chamada pelo controlador de formulários.
     * É ela que encaminha os dados para o método que processará o formulário.
     * 
     * @var array $post
     * 
     * @return void
     */
    public static function process(array $post) : void 
    {
        $process = "";
        if (isset($post['process'])) {
            $process = $post['process'];
            unset($post['process']);
        }
        
        $data = $post;
        ProcessPhpClipboard::processClipboard($process, $data);
    }   
}