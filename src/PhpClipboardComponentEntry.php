<?php
/*
* @author Bruno Mendes Pimenta
* @license GPL
* @package PhpClipboard
*/

namespace PhpClipboard;

use PhpClipboard\PhpClipboardEntry;
use PhpClipboard\Contracts\IPhpClipboardEntry;

/**
 * Classe responsável pela criação de componentes personalizados.
 */
abstract class PhpClipboardComponentEntry implements IPhpClipboardEntry{
    
    /**
     * Recebe o nome do template.
     * @var String
     */
    protected $template;
    
    /**
     * Recebe a entrada de formulário.
     * @var PhpClipboardEntry
     */
    protected $input;


    public function __construct(PhpClipboardEntry $input)
    {
        $this->input = $input;
    }
    
    public function __get($property)
    {
        if ($property === 'idCampo') {
            return $this->input->idCampo;
        }
        if ($property === 'idHTML') {
            return $this->input->idHTML;
        }
        if ($property === 'label') {
            return $this->input->label;
        }
        if ($property === 'tipo') {
            return $this->input->tipo;
        }
        if ($property === 'descricao') {
            return $this->input->descricao;
        }
        if ($property === 'name') {
            return $this->input->name;
        }
        if ($property === 'order') {
            return $this->input->order;
        }
        if ($property === 'size') {
            return $this->input->size;
        }

        throw new \Exception('Propriedade Inexistente!');
    }
    
    /**
     * Exibe o componente.
     * 
     * @return void
     */
    public function show() : void
    {        
        echo $this->processComponent();
    }
    
    /**
     * Adicionar um envólucro para a entrada de formulário.
     * 
     * @var String $wrap Abrir e fechar da tag de envólucro.
     * 
     * @return bool
     */
    public function wrap(String $wrap) : bool
    {
        $this->input->wrap($wrap);
        
        return $this;
    }
    
    /**
     * Adicionar um envólucro para os options, caso entrada seja 
     * do tipo select.
     * 
     * @var String $wrap Abrir e fechar da tag de envólucro.
     * 
     * @return bool
     */
    public function wrapAll(String $wrap) : bool
    {
        $this->input->wrapAll($wrap);
        
        return $this;
    }
    
    /**
     * Adicionar um envólucro para cada option, caso entrada
     * seja do tipo select.
     * 
     * @var String $wrap Abrir e fechar da tag de envólucro.
     * 
     * @return bool
     */
    public function wrapInner(String $wrap) : bool
    {
        $this->input->wrapInner($wrap);
        
        return $this;
    }
    
    /**
     * Atribui uma classe HTML à entrada de formulário.
     * 
     * @var String $class Nome da classe
     * @var array $types Recebe os tipos de campo em que a classe deve ser colocada. Caso não seja passada, todos os tipos de campo receberão a classe.
     * 
     * @return PhpClipboardEntry
     */
    public function setClass(String $class, array $types = []) : IPhpClipboardEntry
    {
        $this->input->setClass($class, $types);
        
        return $this;
    }
    
    /**
     * Serve para adicionar atributos personalizados na entrada de formulário.
     * 
     * @var String $keyAttr Nome do atributo.
     * @var String $valueAttr Valor do atributo.
     * 
     * @return PhpClipboardEntry
     */
    public function addAttr(String $keyAttr, String $valueAttr) : IPhpClipboardEntry
    {
        $this->input->addAttr($keyAttr, $valueAttr);
        
        return $this;
    }
    
    /**
     * Monta o HTML da label e manda para a saída principal.
     * 
     * @return void
     */
    public function label() : void
    {
        $this->input->label();
    }
    
    /**
     * Método responsável por processar o componente.
     * 
     * @return String
     */
    protected function processComponent()
    {
        if ($this->template === null) {
            throw new \Exception("HTML template não definido!");
        }
        
        ob_start();
        require __DIR__ . "/../templates/components/" . $this->template . ".php";
        $HTML = ob_get_contents();
        ob_end_clean();
        
        return $HTML;
    }
}
