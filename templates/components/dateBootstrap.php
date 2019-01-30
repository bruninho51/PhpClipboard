<div class="row mb-3">
    <div class="col-md-12">
        <input type="text" class="form-control" name="<?= $this->name?>" id="<?= $this->idHTML?>" placeholder="<?= $this->label?>">
    </div>
</div>
<script>
    $('#<?= $this->idHTML?>').datepicker();
</script>