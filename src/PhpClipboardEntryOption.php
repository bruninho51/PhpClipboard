<?php
namespace PhpClipboard;

class PhpClipboardEntryOption {
    
    /**
     * Recebe o conteúdo que aparecerá como opção.
     * @var String $label
     */
    private $label;
    /**
     * Recebe o dado que será enviado pelo formulário.
     * @var String $value
     */
    private $value;
    
    public function __construct(array $data)
    {
        $this->label = $data['label'];
        $this->value = $data['value'];
    }
    
    /**
     * Devolve o option como uma string.
     * 
     * @return void
     */
    public function option()
    {
        return "<option value='{$this->value}'>{$this->label}</option>";
    }
    
    /**
     * Envia o option para a saída principal.
     * 
     * @return void
     */
    public function show()
    {
        echo $this->option();
    }
}
