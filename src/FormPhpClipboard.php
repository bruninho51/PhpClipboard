<?php
/*
* @author Bruno Mendes Pimenta
* @license GPL
* @package FormPhpClipboard
*/
namespace PhpClipboard;

use PhpClipboard\PhpClipboardEntry;
use PhpClipboard\PhpClipboardTemplate;
use PhpClipboard\Contracts\IFormPhpClipboard;
use PhpClipboard\Contracts\IPhpClipboardDBAdapter;

/**
 * Classe que representa um formulário
 */
class FormPhpClipboard implements IFormPhpClipboard
{
    /**
     * Recebe as entradas de formulário.
     * 
     * @var PhpClipboardEntry $in
     */
    private $in;
    /**
     * Recebe o caminho do template.
     * 
     * @var String $template
     */
    private $template;

    /**
     * Chave primária do formulário.
     * 
     * @var int $id
     */
    private $id;
    /**
     * Descrição do formulário.
     * 
     * @var String $description
     */
    private $description;

    /**
     * Nome do formulário.
     * 
     * @var String $name
     */
    private $name;
    /**
     * Verbo HTTP que o formulário deverá ser enviado.
     * 
     * @var String $method
     */
    private $method;
    /**
     * Método do MyProcessPhpClipboard que deverá ser chamado
     * Quando o formulário passar em todas as regras de validação.
     * 
     * @var String $processValidateSuccess
     */
    private $processValidateSuccess;
    /**
     * Método do MyProcessPhpClipboard que deverá ser chamado
     * Quando o formulário não passar em todas as regras de validação.
     * 
     * @var String $processValidateFailure
     */
    private $processValidadeFailure;
    /**
     * Recebe o caminho dos scripts do formulário.
     * 
     * @var ArrayObject $scripts
     */
    private $scripts;
    /**
     * Recebe o caminho das folhas de estilo do formulário.
     * 
     * @var ArrayObject $css
     */
    private $css;

    public function __get($property)
    {
        if ($property === 'id') {
            return $this->id;
        }
        if ($property === 'name') {
            return $this->name;
        }
        if ($property === 'description') {
            return $this->description;
        }
        if ($property === 'method') {
            return $this->method;
        }

        throw new Exception('Propriedade Inexistente!');
    }

    public function __construct()
    {
        $this->in = new \ArrayObject();
        $this->scripts = new \ArrayObject();
        $this->css = new \ArrayObject();
    }

    /**
     * Devolve o HTML do formulário
     * 
     * @return String
     */
    public function getHTML() : String
    {
        $template = new PhpClipboardTemplate($this, '/Form.php');
        return $template->processTemplate();
    }

    /**
     * Popula o formulário
     * 
     * @var array $data
     * @return void
     */
    public function putInfo(array $data) : void
    {
        $keys = array_keys($data);
        if (in_array('idFormulario', $keys)) {
            $this->id = $data['idFormulario'];
        }
        if (in_array('titulo', $keys)) {
            $this->name = $data['titulo'];
        }
        if (in_array('descricao', $keys)) {
            $this->description = $data['descricao'];
        }
        if (in_array('method', $keys)) {
            $this->method = $data['method'];
        }
        if (in_array('processValidateSuccess', $keys)) {
            $this->processValidateSuccess = $data['processValidateSuccess'];
        }
        if (in_array('processValidateFailure', $keys)) {
            $this->processValidateFailure = $data['processValidateFailure'];
        }
    }

    /**
     * Devolve uma entrada de formulário
     * 
     * @var int $idx
     * @return PhpClipboardEntry
     */
    public function input(int $idx) : PhpClipboardEntry
    {
        return $this->in->offsetGet($idx);
    }
    
    /**
     * Retorna um array com todas as entradas do formulário.
     * 
     * @return \ArrayObject
     */
    public function allEntries() : \ArrayObject
    {
        return $this->in;
    }

    /**
     * Devolve o CSS como string
     * 
     * @return String
     */
    public function getCSS() : String
    {
        $string = "";
        $iterator = $this->css->getIterator();
        while ($iterator->valid()) {
            $string .= $iterator->current() . "\n";
            $iterator->next();
        }
        return $string;
    }

    /**
     * Devolve o script como string
     * 
     * @return String
     */
    public function getScript() : String
    {
        $string = "";
        $iterator = $this->scripts->getIterator();
        while ($iterator->valid()) {
            $string .= $iterator->current() . "\n";
            $iterator->next();
        }
        return $string;
    }

    /**
     * Atribui um CSS ao formulário
     * 
     * @var String $css
     * @return void
     */
    public function setCSS(String $css) : void
    {
        $this->css->append($css);
    }

    /**
     * Atribui um script ao formulário
     * 
     * @var String $script
     * @return void
     */
    public function setScript(String $script) : void
    {
        $this->scripts->append($script);
    }

    /**
     * Cria uma entrada por composição.
     * 
     * @var ArrayObject $data Contém os dados do campo.
     * @return void
     */
    public function putInput(array $data, IPhpClipboardDBAdapter $adapter) : void
    {
        $this->in->append(new PhpClipboardEntry($data, $adapter));
    }
}