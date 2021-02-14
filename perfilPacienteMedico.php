<!DOCTYPE html>
<?php 
  $lucia = "mongodb+srv://luciavm:sscdrsnshsm@cluster0.wnp1l.mongodb.net/test?authSource=admin&replicaSet=atlas-mwie0e-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true";
  require 'vendor/autoload.php';
  use MongoDB\Client as Mongo;
  $mongo = new Mongo($lucia);

  $dniMed = isset($_POST['dniMedico']) ? $_POST['dniMedico'] : null;
  $dniPac =  isset($_POST['dniPac']) ? $_POST['dniPac'] : null;
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

      function ocultarMostrarConsultas(){
        tablaPaciente = document.getElementById("tablaListaConsultas");
        tipoDisplay = getComputedStyle(tablaPaciente, null).display;
        if (tipoDisplay == "none") {
          tablaPaciente.style.display = "table";

         }   
        else {
            tablaPaciente.style.display = "none";
        }   
      }
      
      function ocultarMostrarTratamientos(){
        tablaPaciente = document.getElementById("tablaListaTratamientos");
        
        tablaTitulo = document.getElementById("tablaTituloCorse");
        tablaCorse = document.getElementById("tablaCorse");
        tipoDisplay = getComputedStyle(tablaPaciente, null).display;
        if (tipoDisplay == "none") {
          tablaPaciente.style.display = "table";
          tablaTitulo.style.display = "table";
          tablaCorse.style.display = "table";

         }   
        else {
            tablaPaciente.style.display = "none";
            tablaTitulo.style.display = "none";
            tablaCorse.style.display = "none";
        }   
      }

      function ocultarMostrarSeguimiento(){
        tablaPaciente = document.getElementById("tablaListaSeguimientos");
        
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

<div class = "divPrincipalPerfilPac">
    <div class = "divInteriorPerfilPac">
      <button id = "botonDesplegablePaciente" type="button" onclick="ocultarMostrarPaciente()"> Desplegar/Ocultar datos del paciente </button>
      <table id = "mostrarEstaTabla" class="tablasPerfilPaciente">
        <tr>
            <th id = "filaTitulo" colspan = "2">Datos del paciente</th>
        </tr>
      </table>

      <table class="tablasPerfilPaciente" id ="tablaPerfilPaciente">
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
            <tr> 
                 <td id = "filaBotonesCrearPac" colspan = "2"> 
                     <form action="formularioEditarPaciente.php" method = "post"> 
                         <input type="hidden" name="dniMed" value= <?php $dniMed?> 
                         <input type="hidden" name="idPac" value= <?php $dniPac ?> 
                         <input class = "botonEditarPaciente" type="submit" value="Editar datos del paciente" />
                     </form>
                 </td>
            </tr>
        </tr>';
         ?>
        </table>
    </div>
    <div class = "divInteriorPerfilPac">
        <br> </br>
        <button id = "botonDesplegablePaciente" type="button" onclick="ocultarMostrarConsultas()"> Desplegar/Ocultar consultas </button>
        <table class="tablasPerfilPaciente" id = "mostrarEstaTabla">
        <tr>
            <th id = "filaTitulo" colspan = "4">Listado de las consultas</th>
        </tr>
        </table>
        <table class="tablasPerfilPaciente" id ="tablaListaConsultas">
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
                         <form action="perfilSeguimiento.php" method = "post">
                           <input type="hidden" name="dniMed" value= '.$dniMed.'>
                           <input type="hidden" name="idSeg" value= '.$consultation['_id'].'>
                           <input class = "botonDetalles" type="submit" value="Detalles" />
                         </form>
                       </td>
                   </tr>';
               }
               if(count($result) == 0){
                echo '<tr><td colspan = "4">No hay resultados</td></tr>';
               }
               ?>

        </table>
    </div>
    <div class = "divInteriorPerfilPac">
        <br> </br>
        <button id = "botonDesplegablePaciente" type="button" onclick="ocultarMostrarTratamientos()"> Desplegar/Ocultar tratamientos </button>
        <table class="tablasPerfilPaciente" id = "mostrarEstaTabla">
            <tr>
                <th id = "filaTitulo" colspan = "4">Listado de los tratamientos</th>
            </tr>
        </table>
        <table class="tablasPerfilPaciente" id ="tablaListaTratamientos">
            <tr>
                <th> Fecha de inicio </th>
                <th> Fecha de fin </th>
                <th> Tipo </th>
                <th> Ver perfil del tratamiento </th>
            </tr>
        <?php
             
             $collection3 = $mongo->ScAid->Treatments;
             $result = $collection3->find(['Patient_DNI' => $dniPac])->toArray();

             foreach ($result as $treatment) {
                 echo '
                   <tr>
                       <td>'.$treatment['Date_start'].'</td>
                       <td>'.$treatment['Date_end'].'</td>
                       <td>'.$treatment['Type'].'</td>
                       <td>
                         <form action="perfilTratamientoMedico.php" method = "post">
                           <input type="hidden" name="dniMed" value= '.$dniMed.'>
                           <input type="hidden" name="idTret" value= '.$treatment['_id'].'>
                           <input class = "botonDetalles" type="submit" value="Detalles" />
                         </form>
                       </td>
                   </tr>';
               }
               if(count($result) == 0){
                echo '<tr><td colspan = "4">No hay resultados</td></tr>';
               }
               ?>
        </table>
        <table class="tablasPerfilPaciente" id = "tablaTituloCorse">
            <tr>
                <th id = "filaTitulo" colspan = "4">Listado de corsets</th>
            </tr>
        </table >
        <table class="tablasPerfilPaciente" id = "tablaCorse">
            <tr>
                <th> Tipo </th>
                <th> Material </th>
                <th> Medidas </th>
                <th> Descripción </th>
            </tr>
        <?php
             
             $collection5 = $mongo->ScAid->Braces;
             $result = $collection5->find(['Patient_DNI' => $dniPac])->toArray();
             foreach ($result as $brace) {
                 echo '
                   <tr>
                       <td>'.$brace['Type'].'</td>
                       <td>'.$brace['Material'].'</td>
                       <td>
                       <ul>
                       <li> Cadera: '.$brace['Measures']['Hip_measure'].'</li>
                       <li> Cintura: '.$brace['Measures']['Waist_measure'].'</li>
                       <li> Torax: '.$brace['Measures']['Thorax_measure'].'</li>
                       <ul>
                       </td>
                       <td>'.$brace['Description'].'</td>
                   </tr>';

               }
               if(count($result) == 0){
                echo '<tr><td colspan = "4">No hay resultados</td></tr>';
               }

               ?>

        </table>
    </div>
    <div class = "divInteriorPerfilPac">
        <br> </br>
        <button id = "botonDesplegablePaciente" type="button" onclick="ocultarMostrarSeguimiento()"> Desplegar/Ocultar seguimientos diarios </button>
        <table class="tablasPerfilPaciente" id = "mostrarEstaTabla">
            <tr>
                <th id = "filaTitulo" colspan = "3">Listado de los datos de seguimiento diario</th>
            </tr>
        </table>
        <table class="tablasPerfilPaciente" id ="tablaListaSeguimientos">
            <tr>
                <th> ID </th>
                <th> Fecha </th>
                <th> Ver perfil del seguimiento </th>
            </tr>
        <?php
             
             $collection4 = $mongo->ScAid->Dailies;
             $result = $collection4->find(['Patient_DNI ' => $dniPac])->toArray();

             

             foreach ($result as $daily) {
                 echo '
                   <tr>
                       <td>'.$daily['idDaily_monitoring'].'</td>
                       <td>'.$daily['Date'].'</td>
                       <td>
                         <form action="perfilDailies.php" method = "post">
                           <input type="hidden" name="dniMed" value= '.$dniMed.'>
                           <input type="hidden" name="idDaily" value= '.$daily['_id'].'>
                           <input class = "botonDetalles" type="submit" value="Detalles" />
                         </form>
                       </td>
                   </tr>';
               }
               if(count($result) == 0){
                echo '<tr><td colspan = "3">No hay resultados</td></tr>';
               }
               ?>

        </table>
    </div>
</div>


</body>

</html>