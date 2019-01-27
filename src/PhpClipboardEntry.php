<?php
/*
* @author Bruno Mendes Pimenta
* @license GPL
* @package PhpClipboardEntry
*/
namespace PhpClipboard;

use PhpClipboard\Contracts\IPhpClipboardDBAdapter;

/**
 * Representa uma entrada de dados de formulário.
 */
class PhpClipboardEntry
{
    /**
     * Chave primária de uma entrada de dados.
     * 
     * @var int $idCampo
     */
    private $idCampo;
    /**
     * Propriedade id que deverá ser colocada no HTML 
     * quando o campo for criado.
     * 
     * @var String $idHTML
     */
    private $idHTML;
    /**
     * Recebe a label da entrada de formulário.
     * 
     * @var String $label
     */
    private $label;
    /**
     * Recebe o tipo de entrada(input, select, textarea...).
     * 
     * @var String $tipo
     */
    private $tipo;
    /**
     * Recebe as opções em formato se um SELECT SQL
     * caso a entrada seja do tipo select.
     * 
     * @var String $opt
     */
    private $opt;
    /**
     * Recebe uma descrição do que o formulário faz.
     * 
     * @var String $descricao
     */
    private $descricao;
    /**
     * Recebe o nome do formulário.
     * 
     * @var String $name
     */
    private $name;
    /**
     * Recebe o container do campo, se houver.
     * @example 
     * $wrap['start'] = '<div class="container">';
     * $wrap['end'] = '</div>';
     * @var array $wrap
     */
    private $wrap;
    /**
     * Recebe um container que engloba todos os options,
     * caso o campo seja do tipo select.
     * @example 
     * $wrapAll['start'] = '<div class="container">';
     * $wrapAll['end'] = '</div>';
     * @var array $wrap
     */
    private $wrapAll;
    /**
     * Recebe um container que englobará cada option,
     * caso o campo seja do tipo select.
     * @example 
     * $wrapAll['start'] = '<div class="container">';
     * $wrapAll['end'] = '</div>';
     * @var array $wrap
     */
    private $wrapInner;
    /**
     * Recebe as classes que deverão ser colocadas
     * no atributo class da entrada de formulário.
     * 
     * @var array $class
     */
    private $class;
    /**
     * Recebe atributos personalizados que serão colocados
     * no HTML da entrada de formulário.
     * 
     * @var array $attrPerson
     */
    private $attrPerson;
    /**
     * Recebe os scripts do formulário.
     * 
     * @var array $js
     */
    private $js;
    
    /**
     * Recebe o nome das regras de validação do campo, que são representadas
     * por classes que herdam de RolePhpClipboardEntry.
     * 
     * @var array $roles
     */
    private $roles;
    
    /**
     * Recebe um adapter que se comunica com o banco de dados e passa 
     * as devidas informações para a biblioteca.
     * 
     * @var IPhpClipboardDBAdapter $dbAdapter
     */
    private $dbAdapter;

    public function __construct(IPhpClipboardDBAdapter $adapter, array $campo = [])
    {
        if ($campo) {
            if ($this->checkIfParametersExistAndInject($campo)) {
                $nonNullPropertiesChecked = $this->verifyNotNullProperties();
            } else {
                throw new PhpClipboardException("2");
            }

            if (!$nonNullPropertiesChecked) {
                throw new PhpClipboardException("3");
            }
        }

        $this->dbAdapter = $adapter;
        $this->wrap      = array('start' => '', 'end' => '');
        $this->wrapAll   = array('start' => '', 'end' => '');
        $this->wrapInner = array('start' => '', 'end' => '');
        $this->js = array();
        $this->attrPerson = array();
        $this->roles = array();

        foreach ($this->getTypeEntries() as $entry) {
            $this->class[$entry] = array();
        }

        return true;

    }

    /**
     * Atribui uma regra de formulário. As regras são representadas
     * por classes que herdam de RolePhpClipboardEntry e geralmente
     * ficam na pasta roles, na raiz da bilioteca.
     * 
     * @var String $roleName Recebe o nome da classe que carrega a regra.
     * 
     * @return void
     */
    public function setRole(String $roleName) : void
    {
        $this->roles[] = $roleName;
    }

    public function __get($property)
    {
        $propertyOfClass = get_class_vars('/lib/PhpClipboardEntry');

        $propertyRestrict = array_search($property, $this->getRestrictProperties());
        $propertyExists = array_search($property, $propertyOfClass);

        if (!$propertyRestrict && $propertyExists) {
            return $this->$property;
        } else {
            throw new PhpClipboardException("4");
        }
    }

    /**
     * Usado por wrap, wrapAll e wrapInner para popular as propriedades
     * de container HTML.
     * 
     * @var String $wrap Recebe o abrir e fechar da tag de container.
     * @var String $propertyWrap Recebe o nome da propriedade de container que deverá ser populada.
     * 
     * @return bool
     */
    private function wrapInsert(array $wrap, String $propertyWrap) : bool
    {
        if (!empty($wrap)) {
            $wrapArray = explode('><', $wrap);

            $this->$propertyWrap['start'] = $wrapArray[0].'>'.PHP_EOL;
            $this->$propertyWrap['end'] = '<'.$wrapArray[1].PHP_EOL;
        } else {
            throw new PhpClipboardException("5");
        }

        return true;
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
        return $this->wrapInsert($wrap, 'wrap');
    }

    /**
     * Adicionar um envólucro para os options, caso entrada seja 
     * do tipo select.
     * 
     * @var String $wrap Abrir e fechar da tag de envólucro.
     * 
     * @return bool
     */
    public function wrapAll(String $wrap)
    {
        return $this->wrapInsert($wrap, 'wrapAll');
    }

    /**
     * Adicionar um envólucro para cada option, caso entrada
     * seja do tipo select.
     * 
     * @var String $wrap Abrir e fechar da tag de envólucro.
     * 
     * @return bool
     */
    public function wrapInner(String $wrap)
    {
        return $this->wrapInsert($wrap, 'wrapInner');
    }
    
    /**
     * Atribui uma classe HTML à entrada de formulário.
     * 
     * @var String $class Nome da classe
     * @var array $types Recebe os tipos de campo em que a classe deve ser colocada.
     * 
     * @return PhpClipboardEntry
     */
    public function setClass(String $class, array $types) : PhpClipboardEntry
    {
        $idx = array_search($this->tipo, $types);
        if ($idx != -1) {
            $this->class[$this->tipo][] = $class;
        }

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
    public function addAttr(String $keyAttr, String $valueAttr) : PhpClipboardEntry
    {
        $attr = $keyAttr."=\"".$valueAttr."\"";
        $this->attrPerson[] = $attr;
        return $this;
    }

    /**
     * Monta o HTML da entrada de formulário e manda para a saída principal.
     * 
     * @return void
     */
    public function show() : void
    {
        $entry = "";

        switch ($this->tipo) {

            case 'select':
                $entry = $this->select();            
            break;

            default:
                $entry = $this->input();
            break;
        }
        
        echo $entry;
    }

    /**
     * Monta o HTML da label e manda para a saída principal.
     * 
     * @return void
     */
    public function label() : void
    {
        $label = false;
        if ($this->tipo != 'hidden') {
            $label = "<label for='{$this->name}'>{$this->label}:</label>";
        }
       
        echo $label;
    }

    /**
     * Usado pelo método show para montar o HTML, caso entrada seja 
     * do tipo input.
     * 
     * @return String
     */
    private function input() : String
    {
        $class = "";
        if (!empty($this->class)) {
            $class = implode(' ', $this->class[$this->tipo]);
        }
        
        $entry = "<input name='{$this->name}' class='{$class}' id='{$this->idHTML}' type='{$this->tipo}'>";

        return $entry;
    }
    
    /**
     * Usado pelo método show para montar o HTML, caso entrada seja 
     * do tipo select.
     * 
     * @return void
     */
    private function select() : String
    {
        $optString = "";
        
        $opts = $this->dbAdapter->getEntryOpt($this->idCampo);
        if ($opts) {
            while ($opt = $opts->fetch_assoc()) {
                $optString .= <<< HEREDOC
                    {$this->wrapAll['start']}
                        <option value='{$opt['value']}'>{$opt['label'] }</option>
                    {$this->wrapAll['end']}
HEREDOC;
            }
            
        } else {
            throw new PhpClipboardException("6");
        }
        
        $class = "";
        if (!empty($this->class)) {
            $class = implode(' ', $this->class[$this->tipo]);
        }

        if (!empty($this->attrPerson)) {
            $attrPerson = implode(' ', $this->attrPerson);
        }

        if (!empty($this->js)) {
            $js = implode('', $this->js);
        }
        
        $entry = <<< HEREDOC
            {$this->wrap['start']}
                <select name='{$this->name}' id='{$this->idHTML}' class='{$class}' $attrPerson>
                    {$this->wrapInner['start']}
                        {$optString}
                    {$this->wrapInner['end']}
                </select>
                {$js}
            {$this->wrap['end']}
HEREDOC;

        return $entry;
    }

    /**
     * Impede que determinadas propriedades sejam pegas por fora da classe.
     * 
     * @return array
     */
    private function getRestrictProperties() : array
    {
        return
        $restrictProperties = array(
            "wrap",
            "wrapAll",
            "wrapInner"
        );
    }

    /**
     * Valida as propriedades que não podem ser nulas.
     * Caso as propriedades estejam ok, o método retorna verdadeiro,
     * caso contrário, retorna falso.
     * 
     * @return bool
     */
    private function verifyNotNullProperties() : bool
    {
        if (is_null($this->idCampo)) 
            return false;
        if (is_null($this->label))
            return false;
        if (is_null($this->tipo))
            return false;
        if (is_null($this->descricao))
            return false;
        if (is_null($this->name))
            return false;
        return true;
    }   
    
    /**
     * Usa a biblioteca Reflection para pegar os nomes de todos os métodos
     * da classe, idependentemente do identificador de acesso deles.
     * 
     * @var bool $withPrivate Se veradeiro, também retorna os nomes dos atributos privados.
     */
    private function properties(bool $withPrivate = false)
    {
        $propertiesName = array();
        $reflector = new \ReflectionClass(new PhpClipboardEntry);
        $properties = $reflector->getProperties();
        foreach ($properties as $property) {
            if ($property->isPrivate() && !$withPrivate) {
                    continue;
            }
            
            $propertiesName[] = $property->getName();
                
                
        }
        return $propertiesName;
    }
    
    /**
     * Recebe os dados do campo e coloca na respectiva propriedade,
     * caso ela exista.
     * 
     * @var array $campo Dados do campo.
     * 
     * @return bool
     */
    public function checkIfParametersExistAndInject(array $campo) : bool
    {
        $propertyOfClass = $this->properties(true);
        if (in_array("idCampo", $propertyOfClass)) {
            $this->idCampo = $campo['idCampo'];
        }
        if (in_array("label", $propertyOfClass)) {
            $this->label = $campo['label'];
        }
        if (in_array("tipo", $propertyOfClass)) { 
            $this->tipo = $campo['tipo'];
        }
        if (in_array("opt", $propertyOfClass)) {
            $this->opt = $campo['opt'];
        }
        if (in_array("descricao", $propertyOfClass)) {
            $this->descricao = $campo['descricao'];
        }
        if (in_array("name", $propertyOfClass)) {
            $this->name = $campo['name'];
        }
        if (in_array("idHTML", $propertyOfClass)) {
            $this->idHTML = $campo['idHTML'];
        }
        if (in_array("roles", $propertyOfClass)) {
            $this->roles = $campo['roles'];
        }

        return true;
    }

    /**
     * Método que retorna todas as entradas de formulário suportadas
     * pela biblioteca.
     * 
     * @return array
     */
    private function getTypeEntries() : array
    {
        $typeEntries = array(
            "text",            "select",          "password",        "button",
            "checkbox",        "date",            "number",          "radio",
            "email",           "file",            "hidden",          "url",
            "time",            "week",            "color",           "datetime",
            "datetime-local",  "image",           "month",           "range",
            "reset",           "tel",
            "submit",
            "textarea"
        );

        return $typeEntries;
    }
}