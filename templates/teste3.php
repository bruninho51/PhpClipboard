<style>
    .black {
        background-color: black;
    }
    .yellow {
        background-color: yellow;
    }
</style>
<form action="<?= $this->clipboardRoute()?>" method="<?= $this->method()?>">
    
    <?php //Imprime as entradas do formulário 
    $entries = $this->entriesIterator();
    while ($entries->valid()) { ?>
        <?php $entries->current()->label();?>
        <br>
        <?php $entries->current()->putClass('yellow')->show();?>
        <br>
        <?php $entries->next();?>
    <?php } ?>
    
    <button type="submit">Enviar</button>
</form>