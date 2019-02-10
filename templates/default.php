<html>
    <head>
        <meta charset="utf-8">
        <title>Template Example</title>
        <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container" style="margin-top: 15px;">
            <form action="<?= $this->clipboardRoute()?>" method="<?= $this->method()?>">
                <input type="hidden" name="clipId" value="<?= $this->id()?>">
                
                <?php $iterator = $this->entriesIterator() ?>
                <div class="form-group">
                    <?php while ($iterator->valid()) : ?>
                    <div class="row">
                      <div class="col-md-6">
                          <?php $iterator->current()->show()?>
                          <?php $roles = $iterator->current()->rolesIterator()?>
                          <?php while ($roles->valid()) : ?>
                              <?php if ($roles->current()->hasErrors()) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= $roles->current()->getErrors()->offsetGet(0) ?>
                                </div>
                              <?php endif; ?>
                              <?php $roles->next()?>
                          <?php endwhile; ?>
                      </div>
                      <div class="col-md-6">
                          <?php $iterator->next()?>
                          <?php if ($iterator->valid()) : ?>
                          <?php $iterator->current()->show()?>
                          <?php endif; ?>
                      </div>
                    </div>
                    <?php $iterator->next()?>
                    <?php endwhile;?>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </body>
</html>