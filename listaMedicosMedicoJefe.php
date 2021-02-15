<!DOCTYPE html>
<?php 
  $lucia = "mongodb+srv://luciavm:sscdrsnshsm@cluster0.wnp1l.mongodb.net/test?authSource=admin&replicaSet=atlas-mwie0e-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true";
  require 'vendor/autoload.php'; // incluir lo bueno de Composer
  use MongoDB\Client as Mongo;
  $mongo = new Mongo($lucia);

  $dniMed = isset($_POST['medicoDNI']) ? $_POST['medicoDNI'] : null;
?>

<html>

<head>
<meta charset="utf-8">
<meta name="author" content="LuciaVM">
  <title>Medico</title>
  <link href="styles/estiloMedicoJefe.css" rel="stylesheet">
  <meta name="generator" content="Google Web Designer 10.0.2.0105">
  <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,regular,500,600,700" rel="stylesheet" type="text/css">
  <style type="text/css">
    .gwd-li-13d3 {
      left: 72px;
      top: 16px;
    }
  </style>
  <script>
      function ocultarMostrarBorrar(elementoBorrar, elementoAsignar){
        var x = elementoBorrar;
        tipoDisplay = getComputedStyle(x, null).display;
        var y = elementoAsignar;
        tipoDisplayAsignar = getComputedStyle(y, null).display;

        if (tipoDisplay == "none") {
          x.style.display = "table-row";
          if(tipoDisplayAsignar != "none"){
            y.style.display = "none";
          }
         }   
        else {
          x.style.display = "none";
        }   
      }
      
      function ocultarMostrarAsignar(elementoAsignar, elementoBorrar){
        var x = elementoAsignar;
        tipoDisplay = getComputedStyle(x, null).display;
        var y = elementoBorrar;
        tipoDisplayBorrar = getComputedStyle(y, null).display;

        if (tipoDisplay == "none") {
          x.style.display = "table-row";
          if(tipoDisplayBorrar != "none"){
            y.style.display = "none";
          }
         }   
        else {
          x.style.display = "none";
        }   
      }
  </script>
</head>

<body class="htmlNoPages">

  <div class="gwd-div-lm07"></div>
  <img src="assets/logo.png" class="gwd-img-fa6j">
  <h4 class = "area" >Área de médico administrador</h4>
  <nav id="menu-superior">
    <ul>      
                <li class="gwd-p-gv4z areaListaPac">
                    <form action="seleccionarRol.php" method = "post">
                            <input type="hidden" name="medicoDNI" value= <?php echo $dniMed ?>>
                            <input class = "botonListaPacientes" type="submit" value="Seleccionar Rol" >
                    </form>  
                </li>
                <li class="gwd-p-gv4z areaMedicos" >
                    <form action="listaMedicosMedicoJefe.php" method = "post">
                            <input type="hidden" name="medicoDNI" value= <?php echo $dniMed ?>>
                            <input class = "botonMedicos" type="submit" value="Lista de Médicos" >
                    </form>  
                </li>
                <li class="gwd-p-gv4z areaRegistrar">
                    <form action="formularioRegistrarMedico.php" method = "post">
                            <input type="hidden" name="medicoDNI" value= <?php echo $dniMed ?>>
                            <input class = "botonRegistrar" type="submit" value="Registrar Médico" >
                    </form>  
                </li>
                <li class="gwd-p-gv4z areaSalir">
                    <form action="login.php" method = "post">
                            <!-- <input type="hidden" name="medicoDNI" value= <?php $dniMed ?>>
                            <input type="hidden" name="dniPac" value= <?php $seguimiento['Patient_DNI'] ?>> -->
                            <input class = "botonSalir" type="submit" value="Salir" >
                    </form>   
                </li>
    </ul>
  </nav>
</body>
<div class = "Listado_medicos_medicoJefe">

<?php 

      
      $dniPacBorrar = isset($_POST['pacienteBorrar']) ? $_POST['pacienteBorrar'] : null;
      $dniPacCrear = isset($_POST['pacienteCrear']) ? $_POST['pacienteCrear'] : null;
      $idMedico = isset($_POST['medicoDNI']) ? $_POST['medicoDNI'] : null;

      if($dniPacBorrar != null and $dniPacBorrar != "SinPaciente"){
        
        $collection4 = $mongo->ScAid->Patients;
        $updateResult = $collection4->updateOne(
          [ 'DNI' => $dniPacBorrar ],
          [ '$set' => [ 'Doctor_DNI' => '-1' ]]);
      }
      
      elseif($dniPacCrear != null and $idMedico != null and $dniPacCrear != "SinPaciente"){
        $collection5 = $mongo->ScAid->Patients;
        $updateResult = $collection5->updateOne(
          [ 'DNI' => $dniPacCrear ],
          [ '$set' => [ 'Doctor_DNI' => $idMedico]]);
      }
      

      

?>
    <h1>Listado de médicos </h1>

    <form action="formularioRegistrarMedico.php" method = "post">
      <input type="hidden" name="medicoDNI" value= <?php echo $dniMed?>>
      <input class = "botonCrearMed" type="submit" value="Nuevo médico" />
    </form>
    
      
    <div>
      
          <table class = "tablaListadoMedicos">
              <tr>
                <th> ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th> Editar relación médico-paciente</th>
              </tr>
              
              
              <?php

                $collection = $mongo->ScAid->Doctors;
                $result = $collection->find()->toArray();
                
                $cnt = 0;
                foreach($result as $medico){
                    $cnt = $cnt +1;
                  echo '
                    <tr>
                        <td>'.$medico['DNI'].'</td>
                        <td>'.$medico['Name'].'</td>
                        <td>'.$medico['Surname'].'</td>
                        <td> 
                        <button id = "botonDesplegableBorrar'.$cnt.'"  class = "botonDesplegableBorrar" type="button" onclick="ocultarMostrarBorrar(filaBorrar'.$cnt.', filaAsignar'.$cnt.')"> Borrar asignación </button>
                        <button id = "botonDesplegableAsignar'.$cnt.'"  class = "botonDesplegableAsignar" type="button" onclick="ocultarMostrarAsignar(filaAsignar'.$cnt.', filaBorrar'.$cnt.')"> Crear asignación </button>
                        </td>
                    </tr>
                    
                  <form name= "borrarAsignacion'.$cnt.'" action = "listaMedicosMedicoJefe.php" method = "post" enctype = "multipart/form-data">
                    <tr id = "filaBorrar'.$cnt.'" class = "borrarOcultoInicio">
                      <td colspan= 2>
                        Seleccione el paciente del médico '.$medico['Name']." ".$medico['Surname'].' que quiere desasignar
                      </td>
                      <td>
                        <select name="pacienteBorrar" class = "selectorPacientes">';
                          $collection2 = $mongo->ScAid->Patients;
                          $result = $collection2->find()->toArray();
                          $numPacientesCon = 0;
                          foreach($result as $pacienteCon){
                            if($pacienteCon['Doctor_DNI'] == $medico['DNI']){
                              echo 
                              '<option value="'.$pacienteCon['DNI'].'">'.$pacienteCon['DNI']." - ".$pacienteCon['Name']." ".$pacienteCon['Surname'].'</option>';
                              $numPacientesCon = $numPacientesCon +1;
                            }
                          }
                          if($numPacientesCon == 0){
                            echo '<option value="SinPaciente">'."El doctor no tiene pacientes asignados".'</option>';
                          }
                        echo 
                        '</select>
                      </td>
                      <td>
                        <input type="submit" class = "botonEnviar" name="enviar" value="Enviar">
                      </td>
                    </tr>
                   </form> 
                   <form name= "crearAsignacion'.$cnt.'" action = "listaMedicosMedicoJefe.php" method = "post" enctype = "multipart/form-data">
                    <tr id = "filaAsignar'.$cnt.'" class = "asignarOcultoInicio"> 
                      <td colspan= 2>
                        Seleccione el paciente que quiere asignar
                      </td>
                      <td>
                        <select name="pacienteCrear" class = "selectorPacientes">';
                        $collection3 = $mongo->ScAid->Patients;
                        $result = $collection3->find()->toArray();
                        
                        $numPacientesSin = 0;
                        foreach($result as $pacienteSin){
                          if($pacienteSin['Doctor_DNI'] == '-1'){
                            echo '<option value="'.$pacienteSin['DNI'].'">'.$pacienteSin['DNI']." - ".$pacienteSin['Name']." ".$pacienteSin['Surname'].'</option>';
                            $numPacientesSin = $numPacientesSin +1;
                          }
                        }

                        if($numPacientesSin == 0){
                          
                          echo '<option value="SinPaciente">'."No hay pacientes sin doctor asignado".'</option>';
                        }
                        
                        echo 
                        '</select>
                      </td>
                      <td>
                        <input type="hidden" name="medicoDNI" value="'.$medico['DNI'].'">
                        <input type="submit" class = "botonEnviar" name="enviar" value="Enviar">
                      </td>
                    </tr>
                  </form>';
                }

                ?>
              
          </table>
        
    </div>
    
  </div>

</html>