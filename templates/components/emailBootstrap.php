<div class="row mb-2">
    <div class="col-md-6">
        <input type="text" class="form-control mb-2" name="<?= $this->name . '_user'?>" id="inlineFormInputName" placeholder="<?= $this->label?>">
    </div>
    <div class="col-md-6">
      <label class="sr-only" for="inlineFormInputGroupUsername">email</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">@</div>
        </div>
          <input type="<?= $this->tipo?>" class="form-control" name="<?= $this->name . '_domain'?>" id="<?= $this->idHTML?>" placeholder="Domain">
      </div>
    </div>
</div>