<?php

include 'vendor/autoload.php';

$api = new \BackTo95\Fields\Api();
$storage = new \BackTo95\Fields\Storage\FileStorage('data/entities');
$api->setStorage($storage);

//$track_configuration = new \BackTo95\Fields\Entity\EntityConfiguration(include 'config/track.php');
//$api->storeEntityConfiguration($track_configuration);

$entity_configuration = $api->getEntityConfiguration('track');

include 'src/form.php';

if (isset($_POST) && !empty($_POST)) {
    $post = $_POST;
}

$form->prepare();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Fields API example</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="jumbotron">

    <div class="container">

        <h1><?= $entity_configuration->getName() ?></h1>

        <p><?= $entity_configuration->getDescription() ?></p>

    </div>

</div>

<div class="container">

    <div class="row">
        <div class="col-md-12">

        <?php if (isset($post)): ?>
            <div class="panel panel-default">
                <div class="panel-body">
        <pre>
        <?php var_dump($post); ?>
        </pre>
                    </div></div>
        <?php endif; ?>

        <?= $this->form()->openTag($form) ?>
        <?= $this->form()->closeTag() ?>

        <form name="<?= $entity_configuration->getName() ?>" method="post" enctype="multipart/form-data">
        <?php foreach ($entity_configuration->getFields() as $fname => $field): if (isset($field->form)): ?>

            <div class="form-group">

                <label><?= $field->name ?></label>

                <?php if ($field->form->widget === 'text'): ?>

                <input name="<?= $fname ?>" type="text" class="form-control" placeholder="Text input">

                <?php elseif ($field->form->widget === 'editor'): ?>

                <textarea name="<?= $fname ?>" class="form-control editor" rows="3"></textarea>

                <?php elseif ($field->form->widget === 'image'): ?>

                <input name="<?= $fname ?>" type="file">

                <?php elseif ($field->form->widget === 'tags'): ?>

                <input name="<?= $fname ?>" type="text">

                <?php endif; ?>

            </div>

        <?php endif; endforeach; ?>

        <button type="submit" class="btn btn-default">Submit</button>

        </form>

        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
<script src="//cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>

<script>

CKEDITOR.replaceAll('editor', function(textarea, config) {
    config.toolbar = 'Basic';
});

</script>

</body>
</html>
