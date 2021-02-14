<!-- mongodb+srv://clarajv:zZVQaRtyyRJad99k@cluster0.wnp1l.mongodb.net/test?authSource=admin&replicaSet=atlas-mwie0e-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true -->
<?php
    require 'vendor/autoload.php'; // incluir lo bueno de Composer

    $cliente = new MongoDB\Client("mongodb+srv://clarajv:zZVQaRtyyRJad99k@cluster0.wnp1l.mongodb.net/test?authSource=admin&replicaSet=atlas-mwie0e-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true");
    $colección = $cliente->demo->beers;

    $resultado = $colección->insertOne( [ 'name' => 'Hinterland', 'brewery' => 'BrewDog' ] );

    echo "Inserted with Object ID '{$resultado->getInsertedId()}'";
?>