<!DOCTYPE html>
<?php 
    $lucia = "mongodb+srv://luciavm:sscdrsnshsm@cluster0.wnp1l.mongodb.net/test?authSource=admin&replicaSet=atlas-mwie0e-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true";
    require 'vendor/autoload.php';
    use MongoDB\Client as Mongo;
    $mongo = new Mongo($lucia);

    $idDaily = isset($_POST['idDaily']) ? $_POST['idDaily'] : null;


    $collectionDailies = $mongo->ScAid->Dailies;
    $collectionPatients = $mongo->ScAid->Patients;
    
    $seguimiento = $collectionDailies->findOne([
        '_id' => new MongoDB\BSON\ObjectId($idDaily),
    ]);

?>
<html>

<head>
  <meta charset="utf-8">
  <meta name="author" content="LuciaVM">
  <title>Listado de seguimientos</title>
  <link href="styles/estiloPacientes.css" rel="stylesheet">
  <meta name="generator" content="Google Web Designer 10.0.2.0105">
  <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,regular,500,600,700" rel="stylesheet" type="text/css">
</head>

<body class="htmlNoPages">
  <div class="gwd-div-lm07"></div>
  <img src="assets/logo.png" class="gwd-img-fa6j">
  <h4 class = "area" >Área de paciente</h4>
  <nav id="menu-superior">
    <ul>
      <li class="gwd-p-gv4z"><a href="listaConsultasPaciente.php?id=<?php echo $IDPaciente?>">Mis tratamientos</a></li>
      <li class="gwd-p-gv4z gwd-p-1qhn"><a href="hacerConsulta.php?IDPaciente=<?php echo $IDPaciente?>">Mis seguimientos diarios</a></li>
      <li class="gwd-p-gv4z gwd-p-5vs1"><a href="perfilPaciente.php?id=<?php echo $IDPaciente?>"><id="PerfilPaciente">Datos personales</a></li>
      <li class="gwd-p-gv4z salir"><a href="login.php">Salir</a></li> 
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