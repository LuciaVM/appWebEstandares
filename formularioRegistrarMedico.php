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
  <title>Registro de un médico</title>
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
      function ocultarMostrarFecha(){
        var x = elementoBorrar;
        tipoDisplay = getComputedStyle(x, null).display;

        if (tipoDisplay == "none") {
          x.style.display = "table-row";
         }   
        else {
          x.style.display = "none";
        }   
      }

    function validaForm(){
        nombreMed = document.formulario.nombreMedico.value;
        if (nombreMed == ""){
            alert("Debes completar el nombre");
            return false;
        }
        apellidosMedico = document.formulario.apellidosMedico.value;
        if (apellidosMedico == ""){
            alert("Debes completar los apellidos");
            return false;
        }
        dniMedico = document.formulario.dniMedico.value;
        if (dniMedico == ""){
            alert("Debes completar el DNI");
            return false;
        }
        nssMedico = document.formulario.nssMedico.value;
        if (nssMedico == ""){
            alert("Debes completar el número de la seguridad social");
            return false;
        }
        direccionMedico = document.formulario.direccionMedico.value;
        if (direccionMedico == ""){
            alert("Debes completar la dirección");
            return false;
        }
        telefonoMedico = document.formulario.telefonoMedico.value;
        if (!/^\d+$/.test(telefonoMedico)) {
                alert("El teléfono no es adecuado");
                return false;
            }
        emailMedico = document.formulario.emailMedico.value;
        if (!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(emailMedico)) {
            alert("El email es incorrecto");
            return (false);
        }
        lugarNacMedico = document.formulario.lugarNacMedico.value;
        if (lugarNacMedico == ""){
            alert("Debes completar el lugar de nacimiento");
            return false;
        }
        fechaNacMedico = document.formulario.fechaNacMedico.value;
        if (fechaNacMedico == "" || fechaNacMedico == null){
            alert("Debes completar la fecha de nacimiento");
            return false;
        }
        fechaInicioContrMedico = document.formulario.fechaInicioContrMedico.value;
        if (fechaInicioContrMedico == "" || fechaInicioContrMedico == null){
            alert("Debes completar la fecha inicio de contrato");
            return false;
        }
        tiene_fecha_fin = document.formulario.tiene_fecha_fin.value;
        if (tiene_fecha_fin == "" ){
            alert("Debes seleccionar si el contrato tiene fecha de fin");
            
            return false;
        }
        
        fechaFinContrMedico = document.formulario.fechaFinContrMedico.value;
        if((tiene_fecha_fin == 0 && fechaFinContrMedico == "") || (tiene_fecha_fin == 0 && fechaFinContrMedico == null)){
            alert("Debes seleccionar la fecha de fin de contrato");
        }
        
        contraseña = document.formulario.passwordMedico.value;
        confirmacion = document.formulario.passwordMedicoConf.value;

        if (contraseña.length == 0 || confirmacion.length == 0) {
                alert("Los campos de la contraseña no pueden quedar vacios");
                return false;
            }
            if (contraseña != confirmacion) {
                alert("Las contraseñas deben coincidir");
                return false;
            } 
        return true;
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

      
    <div class="div_medico">
        <h1> Formulario creación de médico </h1>
            <br>  </br>
            <form id = "pruebaForm" name="formulario" method="POST" enctype="multipart/form-data">
                <table class = "tabla_medico">
                    <tr><td><pre><b> Nombre </b></pre></td>
                        <td><input type = "text" name = "nombreMedico" size="50"></td>
                    </tr>
                    
                    <tr><td><pre><b> Apellidos </b></pre></td>
                        <td><input type = "text" name = "apellidosMedico" size="50"></td>
                    </tr>
                    <tr><td><pre><b> DNI </b></pre></td>
                        <td><input type = "text" name = "dniMedico" size="50"></td>
                    </tr>
                    <tr><td><pre><b> Número de la seguridad social </b></pre></td>
                        <td><input type = "text" name = "nssMedico" size="50"></td>
                    </tr>
                    <tr><td><pre><b> Dirección </b></pre></td>
                        <td><input type = "text" name = "direccionMedico" size="50"></td>
                    </tr>
                    <tr><td><pre><b> Teléfono </b></pre></td>
                        <td><input type = "text" name = "telefonoMedico" size="50"></td>
                    </tr>
                    <tr><td><pre><b> Email </b></pre></td>
                        <td><input type = "email" name = "emailMedico" size="50"></td>
                    </tr>
                    <tr><td><pre><b> Lugar de nacimiento </b></pre></td>
                        <td><input type = "text" name = "lugarNacMedico" size="50"></td>
                    </tr>
                    <tr><td><pre><b> Fecha de nacimiento </b></pre></td>
                        <td><input type = "date" name = "fechaNacMedico" size="50"></td>
                    </tr>
                    <tr><td><pre><b> Fecha de inicio del contrato </b></pre></td>
                        <td><input type = "date" name = "fechaInicioContrMedico"></td>
                    </tr>
                    <tr><td><pre><b> Indica si el contrato tiene fecha de fin  </b></pre></td>
                        <td>
                            <input type = "date" name = "fechaFinContrMedico">
                        </td>
                    </tr>
                    
                    <tr><td><pre><b> Contraseña del médico </b></pre></td>
                        <td><input type = "password" name = "passwordMedico" size="50"></td>
                    </tr>
                    <tr><td><pre><b> Confirmación contraseña del médico </b></pre></td>
                        <td><input type = "password" name = "passwordMedicoConf" size="50"></td>
                    </tr>
                    <tr>
                        <td id = "filaBotonesRespuesta" colspan="2">
                            <input type="hidden" name="medicoDNI" value= <?php echo $dniMed ?>>
                            <input class = "botonEscribirRespuesta" type="submit" name="enviar" onclick = "return validaForm();">
                            <input type="reset" class = "botonEscribirRespuesta" name="borrar">
                        </td>
                    </tr>
                </table>
                <?php
                if(isset($_REQUEST['enviar'])){

                    $nombre = isset($_POST['nombreMedico']) ? $_POST['nombreMedico'] : null;
                    $apellidos = isset($_POST['apellidosMedico']) ? $_POST['apellidosMedico'] : null;
                    $dniMedico = isset($_POST['dniMedico']) ? $_POST['dniMedico'] : null;
                    $nssMedico = isset($_POST['nssMedico']) ? $_POST['nssMedico'] : null;
                    $direccionMedico = isset($_POST['direccionMedico']) ? $_POST['direccionMedico'] : null;
                    $telefonoMedico = isset($_POST['telefonoMedico']) ? $_POST['telefonoMedico'] : null;
                    $emailMedico = isset($_POST['emailMedico']) ? $_POST['emailMedico'] : null;
                    $lugarNacMedico = isset($_POST['lugarNacMedico']) ? $_POST['lugarNacMedico'] : null;
                    $fechaNacMedico = isset($_POST['fechaNacMedico']) ? $_POST['fechaNacMedico'] : null;
                    $fechaInicioContrMedico = isset($_POST['fechaInicioContrMedico']) ? $_POST['fechaInicioContrMedico'] : null;
                    $fechaFinContrMedico = isset($_POST['fechaFinContrMedico']) ? $_POST['fechaFinContrMedico'] : null;
                    $passwordMedico = isset($_POST['passwordMedico']) ? $_POST['passwordMedico'] : null;
                    
                    if($fechaFinContrMedico == NULL){
                        $fechaFinContr = 'Undefined';
                    }

                    $collection = $mongo->ScAid->Doctors;
                    $resultado = $collection->insertOne( [ 'Name' => $nombre, 
                                                           'Surname' => $apellidos,
                                                           'DNI' => $dniMedico,
                                                           'NSS' => $nssMedico, 
                                                           'Address' => $direccionMedico,
                                                           'Phone' => $telefonoMedico,
                                                           'Email' => $emailMedico,
                                                           'Birthplace' => $lugarNacMedico,
                                                           'Birthdate' => $fechaNacMedico,
                                                           'Date_start_contract' => $fechaInicioContrMedico,
                                                           'Date_end_contract' => $fechaFinContr,
                                                           'Password' => $passwordMedico,
                                                           //Cambiar!!!!!!!!!!!!!!!!!
                                                           'Head_department_DNI' => "42745921-f"
                                                           ] );
                ?> <script> alert("Se ha creado el nuevo medico") </script> <?php
                }
                ?>
            </form>
        </div>

</html>