<!DOCTYPE html>
<?php 
    $clara = "mongodb+srv://clarajv:zZVQaRtyyRJad99k@cluster0.wnp1l.mongodb.net/test?authSource=admin&replicaSet=atlas-mwie0e-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true";
    
    require 'vendor/autoload.php';
    use MongoDB\Client as Mongo;
    $mongo = new Mongo($clara);

    // $idSeg = isset($_POST['idSeg']) ? $_POST['idSeg'] : null;
    $idSeg = "5fc96e60b681852b5c6118c5";

    // $dniMed = isset($_POST['dniMed']) ? $_POST['dniMed'] : null;

    
    // $item = $collection->findOne(array(
    //     '_id' => new MongoId('4e49fd8269fd873c0a000000')));

    $collectionSeguimientos = $mongo->ScAid->Consultations;
    $collectionPatients = $mongo->ScAid->Patients;
    
    // $seguimiento = $collectionSeguimientos->findOne(array('_id' => new MongoId($idSeg)));
    // $seguimiento = $collectionSeguimientos->findById("602828fa842c0000e0002101");
    $seguimiento = $collectionSeguimientos->findOne([
        '_id' => new MongoDB\BSON\ObjectId($idSeg),
    ]);

    $pacienteAsign = $collectionPatients->find(['DNI' => $seguimiento['Patient_DNI']])->toArray();

    // $restaurant = $database->restaurants->findOne([
    //     '_id' => new MongoDB\BSON\ObjectId('594d5ef280a846852a4b3f70'),
    // ]);

?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Perfil de Informe de seguimiento</title>
        <meta name="generator" content="Google Web Designer 10.0.2.0105">
        <link href="styles/estiloMedicos.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,regular,500,600,700" rel="stylesheet" type="text/css"> 
    </head>
    <body>
        <div class="gwd-div-lm07"></div>
        <img src="assets/logo.png" class="gwd-img-fa6j">
        <h4 class = "area" >Área de médico </h4>
        <nav id="menu-superior">
            <ul>
                <li class="gwd-p-gv4z">
                    <form action="listaPacientesMedico.php" method = "post">
                            <input type="hidden" name="medicoDNI" value= <?php $dniMed ?>>
                            <input class = "botonListaPacientes" type="submit" value="Lista de Pacientes" >
                    </form>  
                </li>
                <li class="gwd-p-gv4z gwd-p-5vs1">
                    <form action="login.php" method = "post">
                            <!-- <input type="hidden" name="medicoDNI" value= <?php $dniMed ?>>
                            <input type="hidden" name="dniPac" value= <?php $seguimiento['Patient_DNI'] ?>> -->
                            <input class = "botonSalir" type="submit" value="Salir" >
                    </form>   
                </li>
            </ul>
        </nav>

        <div class="div_medico">
            <h1> Perfil del Seguimiento</h1>
            <br>  </br>
            <table class = "tablaPerfilSeguimiento">
                <tbody>
                    <?php
                            echo "<tr><th>Paciente</th><td>" . $pacienteAsign[0]['Name'].' '. $pacienteAsign[0]['Surname'] ."</td></tr>";
                            echo "<tr><th>Fecha</th><td>" . $seguimiento['Date'] ."</td></tr>";
                            echo "<tr><th>Sala</th><td>" . $seguimiento['Room'] ."</td></tr>";
                            echo "<tr><th>Hora</th><td>" . $seguimiento['Hour'] ."</td></tr>";
                            echo "<tr><th>Grado de desviación</th><td>" . $seguimiento['Fixed_attributes']['Desviation_degree'] ."</td></tr>";
                            echo "<tr><th>Patrón de curvatura</th><td>" . $seguimiento['Fixed_attributes']['Curvature_pattern'] ."</td></tr>";
                            echo "<tr><th>Localización de la curvatura</th><td>" . $seguimiento['Fixed_attributes']['Curvature_location'] ."</td></tr>";
                            echo "<tr><th>Observaciones</th><td>" . $seguimiento['Observations'] ."</td></tr>";
                            echo "<tr><th>Altura</th><td>" . $seguimiento['Height'] ."</td></tr>";
                            echo "<tr><th>Peso</th><td>" . $seguimiento['Weight'] ."</td></tr>";
                            echo "<tr><th>Test neurológico</th><td>" . $seguimiento['Neurological_test'] ."</td></tr>";
                            echo "<tr><th>Tensión</th><td>" . $seguimiento['Blood_pressure'] ."</td></tr>";
                            echo "<tr><th>Paciente</th><td>" . $pacienteAsign[0]['Name'].' '. $pacienteAsign[0]['Surname'] ."</td></tr>";
                        ?>
                </body>
            </table>
        </div>
    </body>
</html>