<div class="row mb-3">
    <div class="col-md-12">
        <select type="text" class="form-control" name="<?= $this->name?>" id="<?= $this->idHTML?>" placeholder="<?= $this->label?>">
            <?php 
            $options = $this->optionsIterator();
            while ($options->valid()) {
                $options->current()->show();
                $options->next();
            } ?>
        </select>
    </div>
</div>