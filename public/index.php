<?php

include 'vendor/autoload.php';

$api = new \BackTo95\Fields\Api();
$storage = new \BackTo95\Fields\Storage\FileStorage('data/entities');
$api->setStorage($storage);

//$track_configuration = new \BackTo95\Fields\Entity\EntityConfiguration(include 'config/track.php');
//$api->storeEntityConfiguration($track_configuration);

$entity_configuration = $api->getEntityConfiguration('track');

echo "Hello world2<pre>";

print_r($entity_configuration);

foreach ($entity_configuration->getFields() as $fields) {
    echo 1;
}