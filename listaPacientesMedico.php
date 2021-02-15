<!DOCTYPE html>
<?php 
  $lucia = "mongodb+srv://luciavm:sscdrsnshsm@cluster0.wnp1l.mongodb.net/test?authSource=admin&replicaSet=atlas-mwie0e-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true";
  require 'vendor/autoload.php';
  use MongoDB\Client as Mongo;
  $mongo = new Mongo($lucia);
  $medicoDNI = isset($_POST['medicoDNI']) ? $_POST['medicoDNI'] : null;


?>

<html>

<head>
  <meta charset="utf-8">
  <meta name="author" content="LuciaVM">
  <title>Listado pacientes</title>
  <meta name="generator" content="Google Web Designer 10.0.2.0105">
  <link href="styles/estiloMedicos.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,regular,500,600,700" rel="stylesheet" type="text/css">
</head>
</head>
<body class="htmlNoPages">
  <div class="gwd-div-lm07"></div>
  <img src="assets/logo.png" class="gwd-img-fa6j">
  <h4 class = "area" >Área de médico</h4>
  <nav id="menu-superior">
            <ul>
                <li class="gwd-p-gv4z">
                    <form action="listaPacientesMedico.php" method = "post">
                            <input type="hidden" name="medicoDNI" value= <?php $medicoDNI ?>>
                            <input class = "botonListaPacientes" type="submit" value="Lista de Pacientes" >
                    </form>  
                </li>
                <li class="gwd-p-gv4z gwd-p-5vs1">
                    <form action="login.php" method = "post">
                            <!-- <input type="hidden" name="medicoDNI" value= <?php $medicoDNI ?>>
                            <input type="hidden" name="dniPac" value= <?php $seguimiento['Patient_DNI'] ?>> -->
                            <input class = "botonSalir" type="submit" value="Salir" >
                    </form>   
                </li>
            </ul>
        </nav>
  <div class = "Listado_consultas_medico">

    <h1>Listado de pacientes </h1>
    <form action="formularioEditarPaciente.php" method= "post">
      <input type="hidden" name="medicoDNI" value= <?php echo $medicoDNI?>>
      <input class = "botonCrearPac" type="submit" value="Nuevo paciente" />
    </form>
    <div>
          <table class = "tablaListadoConsultasMedico">
          <tr>
              <th> DNI</th>
              <th>Nombre</th>
              <th>Apellidos</th>
              <th> Ver perfil del paciente</th>
              <th id = "tituloBorrarPaciente"> Borrar paciente </th>
          </tr>
              
              <?php
             
              
              $collection1 = $mongo->ScAid->Patients;
              $result = $collection1->find()->toArray();

              foreach ($result as $paciente) {
                if($paciente['Doctor_DNI'] == $medicoDNI){
                  echo '
                    <tr>
                        <td>'.$paciente['DNI'].'</td>
                        <td>'.$paciente['Name'].'</td>
                        <td>'.$paciente['Surname'].'</td>
                        <td>
                          <form action="perfilPacienteMedico.php" method = "post">
                            <input type="hidden" name="medicoDNI" value= '.$medicoDNI.'>
                            <input type="hidden" name="dniPac" value= '.$paciente['DNI'].'>
                            <input class = "botonDetalles" type="submit" value="Detalles" />
                          </form>
                        </td>
                        <td>
                          <form action="listaPacientesMedico.php" method = "post">
                            <input type="hidden" name="medicoDNI" value= '.$medicoDNI.'>
                            <input type="hidden" name="dniPac" value= '.$paciente['DNI'].'>
                            <input class = "botonBorrarPac" name = "borrarPaciente" type="submit" value="Borrar" />
                          </form>
                        </td>
                    </tr>';
                }
              }
              
              if(isset($_REQUEST["borrarPaciente"])){
                $dniPaciente = isset($_POST['dniPac']) ? $_POST['dniPac'] : null;
                $collection2 = $mongo->ScAid->Patients;
                $collection2->deleteOne(['DNI' => $dniPaciente]);
              }

              
              ?>
          </table>
    </div>
  </div>
  
  

</body>

</html>