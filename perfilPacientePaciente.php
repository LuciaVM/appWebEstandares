<?php
  $lucia = "mongodb+srv://luciavm:sscdrsnshsm@cluster0.wnp1l.mongodb.net/test?authSource=admin&replicaSet=atlas-mwie0e-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true";
  require 'vendor/autoload.php';
  use MongoDB\Client as Mongo;
  $mongo = new Mongo($lucia);
  
  $dniPac = isset($_POST['dniPac']) ? $_POST['dniPac'] : null;
  $dniPac = "54564359-w";

?>
<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <meta name="author" content="LuciaVM">
  <title>Perfil paciente</title>
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
 
  
  <div class = "perfil_paciente">

    <h1> Perfil del paciente</h1>
    <br> </br>
    <div>
    <table class = "tablaPerfilPaciente">
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
  </div>
  
  
</body>

</html>