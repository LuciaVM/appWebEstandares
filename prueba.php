<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Formulario</title>
    </head>
    <body>
        <?php
            $clara = "mongodb+srv://clarajv:zZVQaRtyyRJad99k@cluster0.wnp1l.mongodb.net/test?authSource=admin&replicaSet=atlas-mwie0e-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true";

            require 'vendor/autoload.php'; // incluir lo bueno de Composer

            // $cliente = new MongoDB\Client($clara);
            // $colección = $cliente->demo->beers;

            // $resultado = $colección->insertOne( [ 'name' => 'Hinterland', 'brewery' => 'BrewDog' ] );

            // echo "Inserted with Object ID '{$resultado->getInsertedId()}'";

            // $cliente = new MongoDB\DriverMongoDB\Client("mongodb+srv://clarajv:zZVQaRtyyRJad99k@cluster0.wnp1l.mongodb.net/test?authSource=admin&replicaSet=atlas-mwie0e-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true");\Client("mongodb+srv://clarajv:zZVQaRtyyRJad99k@cluster0.wnp1l.mongodb.net/test?authSource=admin&replicaSet=atlas-mwie0e-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true");
            // $colección = $cliente->demo->beers;

            // $resultado = $colección->find( [ 'name' => 'Hinterland', 'brewery' => 'BrewDog' ] );

            // foreach ($resultado as $entry) {
            //     echo $entry['_id'], ': ', $entry['name'], "\n";
            // }

            use MongoDB\Client as Mongo;

            // determinar donde estamos buscando
            $mongo = new Mongo($clara);
            $collection = $mongo->ScAid->Doctors;

            // hacer un insert
            // $resultado = $collection->insertOne( [ 'Name' => 'Hinterland', 'Surname' => 'Dos' ] );
            // echo "Inserted with Object ID '{$resultado->getInsertedId()}'";

            // hacer select
            // $result = $collection->find()->toArray();
            // foreach ($result as $entry) {
            //     if($entry['Name']=='Carmen'){
            //     }
            // }

            // hacer update
            // $result = $collection->find()->toArray();
            // foreach ($result as $entry) {
            //     if($entry['Name']=='Hinterland'){
            //         $idBusc = $entry['_id'];
            //     }
            // }

            // $updateResult = $collection->updateOne(
            //     [ '_id' => $idBusc ],
            //     [ '$set' => [ 'Name' => 'Otro nombre' ]]
            // );

            // borrar algo
            // $result = $collection->find()->toArray();
            // foreach ($result as $entry) {
            //     if($entry['Name']=='Otro nombre'){
            //         $idBusc = $entry['_id'];
            //     }
            // }
            // $deleteResult = $collection->deleteOne(['_id' => $idBusc]);

            // printf("Deleted %d document(s)\n", $deleteResult->getDeletedCount());
        ?>
    </body>
</html>