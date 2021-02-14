<!DOCTYPE html>
<?php 
    $clara = "mongodb+srv://clarajv:zZVQaRtyyRJad99k@cluster0.wnp1l.mongodb.net/test?authSource=admin&replicaSet=atlas-mwie0e-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true";
    
    require 'vendor/autoload.php';
    use MongoDB\Client as Mongo;
    $mongo = new Mongo($clara);

    $idDaily = isset($_POST['idDaily']) ? $_POST['idDaily'] : null;
    $dniMed = isset($_POST['dniMed']) ? $_POST['dniMed'] : null;

    //$idDaily = "5fc96ed1b681852b5c611d7a";
    
    // $item = $collection->findOne(array(
    //     '_id' => new MongoId('4e49fd8269fd873c0a000000')));

    $collectionDailies = $mongo->ScAid->Dailies;
    $collectionPatients = $mongo->ScAid->Patients;
    
    // $seguimiento = $collectionSeguimientos->findOne(array('_id' => new MongoId($idSeg)));
    // $seguimiento = $collectionSeguimientos->findById("602828fa842c0000e0002101");
    $seguimiento = $collectionDailies->findOne([
        '_id' => new MongoDB\BSON\ObjectId($idDaily),
    ]);

    
    // $restaurant = $database->restaurants->findOne([
    //     '_id' => new MongoDB\BSON\ObjectId('594d5ef280a846852a4b3f70'),
    // ]);

?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Perfil de Informe de Seguimiento Diario</title>
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
                            if($seguimiento['Daily_life_impediment']['School_absence'] == "True"){
                                $school = "Sí";
                            }else{
                                $school= "No";
                            }

                            if($seguimiento['Daily_life_impediment']['Social_activity_absence'] == "True"){
                                $social = "Sí";
                            }else{
                                $social= "No";
                            }
                            
                            if($seguimiento['Daily_life_impediment']['Difficulty_sleeping'] == "True"){
                                $sleep = "Sí";
                            }else{
                                $sleep= "No";
                            }
                            
                            if($seguimiento['Daily_life_impediment']['Productivity_slowdown'] == "True"){
                                $product = "Sí";
                            }else{
                                $product= "No";
                            }
                            echo "<tr><th>Fecha</th><td>" . $seguimiento['Date'] ."</td></tr>";
                            echo "<tr><th>Escala de roce</th><td>" . $seguimiento['Erosion_scale'] ."</td></tr>";
                            echo "<tr><th>Escala de dolor</th><td>" . $seguimiento['General_pain_scale'] ."</td></tr>";
                            echo "<tr><th>Ausencia en la escuela</th><td>" . $school ."</td></tr>";
                            echo "<tr><th>Ausencia en actividad social</th><td>" . $social ."</td></tr>";
                            echo "<tr><th>Dificultad para dormir</th><td>" . $sleep."</td></tr>";
                            echo "<tr><th>Descenso de productividad</th><td>" . $product ."</td></tr>";
                            echo "<tr><th>Medicación</th><td>" . $seguimiento['Occasional_medication'] ."</td></tr>";
                            echo "<tr><th>Deporte practicado</th><td>" . $seguimiento['Sport']['Name'] ."</td></tr>";
                            echo "<tr><th>Duración del deporte practicado</th><td>" . $seguimiento['Sport']['Number_minutes'] ." minutos</td></tr>";
                            echo "<tr><th>Síntomas sufridos</th><td>" . $seguimiento['Symptoms'] ."</td></tr>";
                        ?>
                        
                        
                </body>
            </table>
        </div>
    </body>
</html>