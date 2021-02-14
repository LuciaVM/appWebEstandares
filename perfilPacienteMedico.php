<!DOCTYPE html>
<?php 
  $lucia = "mongodb+srv://luciavm:sscdrsnshsm@cluster0.wnp1l.mongodb.net/test?authSource=admin&replicaSet=atlas-mwie0e-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true";
  require 'vendor/autoload.php';
  use MongoDB\Client as Mongo;
  $mongo = new Mongo($lucia);

  $dniMedico = "42745921-f";
  $dniPac = "54564359-w";
?>

<html>

<head>
  <meta charset="utf-8">
  <meta name="author" content="LuciaVM">
  <title>Detalles paciente</title>
  <meta name="generator" content="Google Web Designer 10.0.2.0105">
  <link href="styles/estiloMedicos.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,regular,500,600,700" rel="stylesheet" type="text/css">
  <script>
      function ocultarMostrarPaciente(){
        tablaPaciente = document.getElementById("tablaPerfilPaciente");
        
        tipoDisplay = getComputedStyle(tablaPaciente, null).display;
        if (tipoDisplay == "none") {
          tablaPaciente.style.display = "table";

         }   
        else {
            tablaPaciente.style.display = "none";
        }   
      }
  </script>
</head>
<body class="htmlNoPages">
  <div class="gwd-div-lm07"></div>
  <img src="assets/logo.png" class="gwd-img-fa6j">
  <h4 class = "area" >Área de médico</h4>
  <nav id="menu-superior">
    <ul>
        <li li class="gwd-p-gv4z"><a href="listaConsultasMedico.php?idMed=<?php echo $idMed?>">Consultas Activas</h3></a></li>
        <li class="gwd-p-gv4z gwd-li-yj6f"><a href="listaPacientesMedico.php?idMed=<?php echo $idMed?>">Pacientes</a></li>
        <li class="gwd-p-gv4z gwd-p-5vs1"><a href="login.php">Salir</a></li>
    </ul>
  </nav>

  <div>
  <div class = "Perfil_paciente">
      <button id = "botonDesplegablePaciente" type="button" onclick="ocultarMostrarPaciente()"> Desplegar datos del paciente </button>
      <table class = "tablaPerfilPaciente" id="noTocar">
        <tr>
            <th id = "filaTitulo" colspan = "2">Datos del paciente</th>
        </tr>
      </table>

      <table class = "tablaPerfilPaciente2" id ="tablaPerfilPaciente">
        <?php 
        $collection1 = $mongo->ScAid->Patients;
        $patient = $collection1->find(['DNI' => $dniPac]) ->toArray();
        echo'
        <tr id = "filaPaciente">
            <th> Nombre </th>
            <td>'.$patient[0]['Name'].' </td>
        </tr>
        <tr id = "filaPaciente">
            <th> Apellidos </th>
            <td> '.$patient[0]['Surname'].' </td>
        </tr>
        <tr id = "filaPaciente">
            <th> DNI </th>
            <td> '.$patient[0]['DNI'].'</td>
        </tr>
        <tr id = "filaPaciente">
            <th> Número de la seguridad social </th>
            <td> '.$patient[0]['Health_card_number'].'</td>
        </tr>
        <tr id = "filaPaciente">
            <th> Sexo </th>
            <td> '.$patient[0]['Sex'].' </td>
        </tr>
        <tr id = "filaPaciente">
            <th> Dirección </th>
            <td> '.$patient[0]['Address'].' </td>
        </tr>
        <tr id = "filaPaciente">
            <th> Teléfono </th>
            <td> '.$patient[0]['Phone'].' </td>
        </tr>
        <tr id = "filaPaciente">
            <th> Email </th>
            <td>'.$patient[0]['Email'].' </td>
        </tr>
        <tr id = "filaPaciente">
            <th> Luegar de nacimiento </th>
            <td> '.$patient[0]['Birthplace'].' </td>
        </tr>
        <tr id = "filaPaciente">
            <th> Fecha de nacimiento </th>
            <td> '.$patient[0]['Birthdate'].' </td>
        </tr>
        <tr id = "filaPaciente">
            <th> Contacto de emergencia </th>
            <td>
                <ul>
                    <li> Nombre: '.$patient[0]['Emergency_contact']['Name'].'</li>
                    <li> Relación: '.$patient[0]['Emergency_contact']['Relationship'].'</li>
                    <li> Teléfono: '.$patient[0]['Emergency_contact']['Phone'].'</li>
                <ul>
            </td>
        </tr>';
         ?>
        </table>
    </div>
    <div class = "listado_consultas_med">
        <br> </br>
        <button id = "botonDesplegableConsulta" type="button" onclick="ocultarMostrarConsultas()"> Desplegar listado de consultas </button>
        <table class = "tablaPerfilPaciente" id="noTocar">
        <tr>
            <th id = "filaTitulo" colspan = "2">Listado de las consultas</th>
        </tr>
        </table>
        <table class = "tablaPerfilPaciente2" id ="tablaPerfilPaciente">
            <tr>
                <th> Fecha </th>
                <th> Hora </th>
                <th> Sala </th>
                <th> Ver perfil de la consulta </th>
            </tr>
        <?php
             
             $collection2 = $mongo->ScAid->Consultations;
             $result = $collection2->find(['Patient_DNI' => $dniPac])->toArray();

             foreach ($result as $consultation) {
                 echo '
                   <tr>
                       <td>'.$consultation['Date'].'</td>
                       <td>'.$consultation['Hour'].'</td>
                       <td>'.$consultation['Room'].'</td>
                       <td>
                         <form action="formularioRegistrarMedico.php" method = "post">
                           <input type="hidden" name="medicoDNI" value= '.$dniMedico.'>
                           <input type="hidden" name="idConsultation" value= '.$consultation['idConsultation'].'>
                           <input class = "botonDetalles" type="submit" value="Detalles" />
                         </form>
                       </td>
                   </tr>';
               }
               ?>

        </table>


    </div>
    </div>

  
  

</body>

</html>