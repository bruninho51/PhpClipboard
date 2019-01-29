<html>
    <head>
        <meta charset="utf-8">
        <title>Template</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <form>
                
                <?php $iterator = $this->entriesIterator() ?>
                <div class="form-group">
                    <?php while ($iterator->valid()) : ?>
                    <div class="row">
                      <div class="col">
                          <?php $iterator->current()
                                  ->setClass('custom-select',['select'])
                                  ->setClass('form-control')
                                  ->setClass('mb-3')
                                  ->show()?>
                      </div>
                      <div class="col">
                          <?php $iterator->next()?>
                          <?php if ($iterator->valid()) : ?>
                          <?php $iterator->current()
                                  ->setClass('custom-select',['select'])
                                  ->setClass('form-control')
                                  ->setClass('mb-3')
                                  ->show()?>
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