<!DOCTYPE html>
<?php 
  // $lucia = "mongodb+srv://luciavm:sscdrsnshsm@cluster0.wnp1l.mongodb.net/test?authSource=admin&replicaSet=atlas-mwie0e-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true";
  $clara = "mongodb+srv://clarajv:zZVQaRtyyRJad99k@cluster0.wnp1l.mongodb.net/test?authSource=admin&replicaSet=atlas-mwie0e-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true";
  require 'vendor/autoload.php'; // incluir lo bueno de Composer

    // $dniTec = isset($_POST['dniTec']) ? $_POST['dniTec'] : null;
    
  $dniTec = "08908908-F";
  use MongoDB\Client as Mongo;
  $mongo = new Mongo($clara);
  
  $collectionBraces = $mongo->ScAid->Braces;
  $collectionTecnicians = $mongo->ScAid->Tecnicians;
  $collectionPatients = $mongo->ScAid->Patients;
  
  $braces = $collectionBraces->find(['Technician_DNI' => $dniTec, 'Type' => ""])->toArray();
  $patients = $collectionPatients->find()->toArray();
?>

<html>

<head>
<meta charset="utf-8">
  <title>Listado de Corsets Pendientes</title>
  <link href="styles/estiloMedicoJefe.css" rel="stylesheet">
  <meta name="generator" content="Google Web Designer 10.0.2.0105">
  <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,regular,500,600,700" rel="stylesheet" type="text/css">
  <style type="text/css">
    .gwd-li-13d3 {
      left: 72px;
      top: 16px;
    }
  </style>
</head>

<body class="htmlNoPages">

  <div class="gwd-div-lm07"></div>
  <img src="assets/logo.png" class="gwd-img-fa6j">
  <h4 class = "area" >Área de técnico</h4>
  <!-- <nav id="menu-superior">
    <ul>
      <li class="gwd-p-gv4z"><a href='seleccionarRol.php?idMed=<?php echo $idMed?>'>Seleccionar Rol</a></li>
      <li class="gwd-p-gv4z gwd-p-1qhn "><a href="login.php">Salir</a></li>
    </ul>
  </nav> -->
</body>
<div class = "Listado_medicos_medicoJefe">

    <h1>Listado de Corsets Pendientes </h1>

    <div>
      
          <table class = "tablaListadoMedicos">
              <tr>
                <!-- <th> ID del Corset</th> -->
                <th>Nombre del paciente</th>
                <th>Apellidos del paciente</th>
                <th>Completar</th>
              </tr>
              <?php 
                foreach($braces as $brace){
                  foreach($patients  as $patient){
                    if($brace['Patient_DNI'] == $patient['DNI']){
                      $p=$patient;
                    }
                  }
                
                    ?>
                        <tr>
                            <!-- <td><?php echo $brace['idCorset'] ?></td> -->
                            <td><?php echo $p['Name'] ?></td>
                            <td><?php echo $p['Surname'] ?></td>
                            <td>Completar</td> 
                            <!-- no se como poner el enlace todavia -->
                        </tr>
                    <?php
                }
              ?>
              <tr>

              </tr>
              
              
              
              
          </table>
        
    </div>
    
  </div>

</html>