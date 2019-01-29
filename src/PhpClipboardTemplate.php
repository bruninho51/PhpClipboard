<?php
/*
* @author Bruno Mendes Pimenta
* @license GPL
* @package FormPhpClipboard
*/

namespace PhpClipboard;

use PhpClipboard\FormPhpClipboard;
use PhpClipboard\PhpClipboardEntry;
use PhpClipboard\Contracts\IPhpClipboardTemplate;

/**
 * Responsável por prover uma interface para 
 * ser usada dentro dos templates.
 */
class PhpClipboardTemplate implements IPhpClipboardTemplate{
    protected $clipboardController;
    protected $form;
    protected $template;
    
    /**
     * @var FormPhpClipboard $form
     * @var String $urlClipboardController URL curta do controlador responsável por encaminhar os dados enviados pelo formulário ao método de processamento em MyProcessPhpClipboard.
     * @var String $template Recebe o nome do template na pasta templates. Se nulo, template padrão será usado.
     */
    public function __construct(FormPhpClipboard $form, String $urlClipboardController, String $template = "")
    {
        $this->form = $form;
        $this->clipboardController = $urlClipboardController;
        if (!$template) {
            $this->template = 'default';
        } else {
            $this->template = $template;
        }
    }
    
    /**
     * Devolve o verbo HTTP do formulário.
     * 
     * @return String
     */
    public function method() : String
    {
       return $this->form->method;
    }
    
    /**
     * Retorna chave primária do formulário.
     * 
     * @return String
     */
    public function id() : String
    {
        return $this->form->id;
    }
    
    /**
     * Retorna o nome do formulário.
     * 
     * @return String
     */
    public function name() : String
    {
        return $this->form->name;
    }
    
    /**
     * Retorna a descrição do formulário.
     * 
     * @return String
     */
    public function description() : String
    {
        $this->form->description;
    }
    
    /**
     * Retorna a url curta do controlador responsável pelo
     * encaminhamento dos dados do formulário para o método
     * responsável pelo processamento, em MyProcessPhpClipboard.
     * 
     * @return String
     */
    public function clipboardController() : String{
        return $this->clipboardController;
    }
    
    /**
     * Retorna uma string com todos os scripts do formulário.
     * 
     * @return String
     */
    public function scripts() : String{
        return $this->form->getScript();
    }
    
    /**
     * Retorna uma string com o CSS do formulário.
     * 
     * @return String
     */
    public function CSS() : String{
        return $this->form->getCSS();
    }
    
    /**
     * Retorna as entradas de formulário. Caso $inputIdx não seja passado,
     * ele retornará um input cada vez que for chamado.
     * 
     * var int $inputIdx
     * 
     * @return mixed
     */
    public function entries(int $inputIdx = 0)
    {
        if ($inputIdx > 0) {
            return $this->form->input($inputIdx);
        }
        return $this->form->allEntries();
    }
    
    public function entriesIterator()
    { 
        $entries = $this->entries();
        $iterator = (new \ArrayObject($entries))->getIterator();
        
        return $iterator;
    }
    
    public function processTemplate()
    {
        ob_start();
        include __DIR__ . "/../templates/" . $this->template . ".php";
        $HTML = ob_get_contents();
        ob_end_clean();
        return $HTML;
    }
}
