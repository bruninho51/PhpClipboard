<div class="col-sm-3 my-1">
  <label class="sr-only" for="inlineFormInputName">Nome</label>
  <input type="text" class="form-control" id="inlineFormInputName" placeholder="<?= $this->label?>">
</div>
<div class="col-sm-3 my-1">
  <label class="sr-only" for="inlineFormInputGroupUsername">Usuário</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <div class="input-group-text">@</div>
    </div>
      <input type="<?= $this->tipo?>" class="form-control" id="<?= $this->idHTML?>" placeholder="Usuário">
  </div>
</div>