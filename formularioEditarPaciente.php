<?php
    // session_start();
    $clara = "mongodb+srv://clarajv:zZVQaRtyyRJad99k@cluster0.wnp1l.mongodb.net/test?authSource=admin&replicaSet=atlas-mwie0e-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true";
    require 'vendor/autoload.php';

    // $dniPac = isset($_POST['dniPac']) ? $_POST['dniPac'] : null;
    // $dniMed = isset($_POST['dniMed']) ? $_POST['dniMed'] : null;
    $dniMed = "39837410-K";
    $dniPac = "10708168-S";
    $dniPac = 77;
    use MongoDB\Client as Mongo;

    // determinar donde estamos buscando
    $mongo = new Mongo($clara);
    $collectionPacientes = $mongo->ScAid->Patients;
    $collectionConsultations = $mongo->ScAid->Consultations;

    $paciente = NULL;
    $result = $collectionPacientes->find()->toArray();
    foreach ($result as $entry) {
        if($entry['DNI']==$dniPac){
            $paciente = $entry;
        }
    }

    if($paciente == NULL){
        $editado=FALSE;

        $nombre = "";
        $apellidos = "";
        $dni = "";
        $nss = "";
        $sexo = "";
        $direccion = "";
        $telefono = "";
        $email = "";
        $lugarNac = "";
        $fechaNac = "";
        $nomEmer = "";
        $relEmer = "";
        $telEmer = "";
        $password = "";
    }else{
        $editado=TRUE;

        $nombre = $paciente['Name'];
        $apellidos = $paciente['Surname'];
        $dni = $paciente['DNI'];
        $nss = $paciente['Health_card_number'];
        $sexo = $paciente['Sex'];
        $direccion = $paciente['Address'];
        $telefono = $paciente['Phone'];
        $email = $paciente['Email'];
        $lugarNac = $paciente['Birthplace'];
        $fechaNac = $paciente['Birthdate'];
        $nomEmer = $paciente['Emergency_contact']['Name'];
        $relEmer = $paciente['Emergency_contact']['Relationship'];
        $telEmer = $paciente['Emergency_contact']['Phone'];
        $password = $paciente['Password'];
    }
    
?>
<!DOCTYPE html>
<html>
    <script>
        function validaForm(){
        nombreMed = document.formSeguimiento.nombre.value;
        if (nombreMed == ""){
            alert("Debes completar el nombre");
            return false;
        }
        apellidos = document.formSeguimiento.apellidos.value;
        if (apellidos == ""){
            alert("Debes completar los apellidos");
            return false;
        }
        dni = document.formSeguimiento.dni.value;
        if (dni == ""){
            alert("Debes completar el DNI");
            return false;
        }
        nss = document.formSeguimiento.nss.value;
        if (nss == ""){
            alert("Debes completar el número de la seguridad social");
            return false;
        }
        direccion = document.formSeguimiento.direccion.value;
        if (direccion == ""){
            alert("Debes completar la dirección");
            return false;
        }
        telefono = document.formSeguimiento.telefono.value;
        if (!/^\d+$/.test(telefono)) {
                alert("El teléfono no es adecuado");
                return false;
            }
        email = document.formSeguimiento.email.value;
        if (!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email)) {
            alert("El email es incorrecto");
            return (false);
        }
        lugarNac = document.formSeguimiento.lugarNac.value;
        if (lugarNac == ""){
            alert("Debes completar el lugar de nacimiento");
            return false;
        }
        fechaNac = document.formSeguimiento.fechaNac.value;
        if (fechaNac == ""){
            alert("Debes completar la fecha de nacimiento");
            return false;
        }

        sexo = document.formSeguimiento.sexo.value;
        if (sexo == ""){
            alert("Debes completar el sexo");
            return false;
        }
        nomEmer = document.formSeguimiento.nomEmer.value;
        if (nomEmer == ""){
            alert("Debes completar el nombre del contacto de emergencia");
            return false;
        }
        relEmer = document.formSeguimiento.relEmer.value;
        if (relEmer == ""){
            alert("Debes completar la relación con el contacto de emergencia");
            return false;
        }
        telEmer = document.formSeguimiento.telEmer.value;
        if (telEmer == ""){
            alert("Debes completar el teléfono del contacto de emergencia");
            return false;
        }
        
        contraseña = document.formSeguimiento.password.value;
        confirmacion = document.formSeguimiento.passwordConf.value;

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
    <head>
        <meta charset="utf-8">
        <title>Registro o Edición de Paciente</title> 
        <!-- cambiar con un if  -->
        <meta name="generator" content="Google Web Designer 10.0.2.0105">
        <link href="styles/estiloPacientes.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,regular,500,600,700" rel="stylesheet" type="text/css"> 
    </head>
    <body>
        <div class="gwd-div-lm07"></div>
        <!-- <img src="assets/logo.png" class="gwd-img-fa6j"> -->
        <!-- <nav id="menu-superior">
            <ul>
                <li><a href="listaConsultasPaciente.php?id=<?php echo $dniPac?>"><h3 class="gwd-p-gv4z" id="listaConsultasPaciente">Consultas</h3></a></li>
                <li><a href="hacerConsulta.php?dniPac=<?php echo $dniPac?>"><h3 class="gwd-p-gv4z gwd-p-1qhn" id="hacerConsulta">Hacer consulta</h3></a></li>
                <li class="gwd-li-2971"><a href="perfilPaciente.php?id=<?php echo $dniPac?>"><"><h3 class="gwd-p-gv4z gwd-p-5vs1" id="PerfilPaciente">Datos Personales</h3></a></li>
                <li class="gwd-li-1xiy"><a href="login.php"><h3 class="gwd-p-gv4z destacado" id="salir">Salir</h3></a></li> 
            </ul>
        </nav> -->

        <div class="form">

            <form method="POST" name = "formSeguimiento">
                <table>
                    <tr><td><pre><b> Nombre </b></pre></td>
                        <td><input type = "text" name = "nombre" size="50" value=<?php echo $nombre ?>></td>
                    </tr>
                    
                    <tr><td><pre><b> Apellidos </b></pre></td>
                        <td><input type = "text" name = "apellidos" size="50" value="<?php echo $apellidos ?>"></td>
                    </tr>
                    <tr><td><pre><b> DNI </b></pre></td>
                        <td><input type = "text" name = "dni" size="50" value=<?php echo $dni ?>></td>
                    </tr>
                    <tr><td><pre><b> Número de la seguridad social </b></pre></td>
                        <td><input type = "text" name = "nss" size="50" value=<?php echo $nss ?>></td>
                    </tr>
                    <tr><td><pre><b>Sexo   </b></pre></td>
                        <td>
                            <input type="radio" name="sexo" value="Hombre"
                                <?php if($sexo == "Hombre"){
                                    ?> checked <?php
                                } ?>
                            >Hombre
                            <input type="radio" name="sexo" value="Mujer"
                                <?php if($sexo == "Mujer"){
                                    ?> checked <?php
                                } ?>
                            >Mujer
                        </td> 
                        <!-- poner el seleccionado -->
                    </tr>
                    <tr><td><pre><b> Dirección</b></pre></td>
                        <td><input type = "text" name = "direccion" size="50" value="<?php echo $direccion ?>"></td>
                    </tr>
                    <tr><td><pre><b> Teléfono </b></pre></td>
                        <td><input type = "text" name = "telefono" size="50" value=<?php echo $telefono ?>></td>
                    </tr>
                    <tr><td><pre><b> Email </b></pre></td>
                        <td><input type = "email" name = "email" size="50" value=<?php echo $email ?>></td>
                    </tr>
                    <tr><td><pre><b> Lugar de nacimiento </b></pre></td>
                        <td><input type = "text" name = "lugarNac" size="50" value=<?php echo $lugarNac ?>></td>
                    </tr>
                    <tr><td><pre><b> Fecha de nacimiento </b></pre></td>
                        <td><input type = "date" name = "fechaNac" value=<?php echo $fechaNac ?>></td>
                    </tr>
                    <tr><td><pre><b> Nombre del contacto de emergencia </b></pre></td>
                        <td><input type = "text" name = "nomEmer" size="50" value=<?php echo $nomEmer ?>></td>
                    </tr>
                    <tr><td><pre><b> Relación con el contacto de emergencia </b></pre></td>
                        <td><input type = "text" name = "relEmer" size="50" value=<?php echo $relEmer ?>></td>
                    </tr>
                    <tr><td><pre><b> Teléfono del contacto de emergencia </b></pre></td>
                        <td><input type = "text" name = "telEmer" size="50" value=<?php echo $telEmer ?>></td>
                    </tr>
                    <tr><td><pre><b> Contraseña del paciente </b></pre></td>
                        <td><input type = "password" name = "password" size="50" value=<?php echo $password ?>></td>
                    </tr>
                    <tr><td><pre><b> Confirmación contraseña del paciente </b></pre></td>
                        <td><input type = "password" name = "passwordConf" size="50"
                                <?php
                                    if($editado){
                                        ?> value = <?php echo $password ?> <?php
                                    }
                                ?>
                        ></td>
                    </tr>
                    <tr>
                        <td id = "filaBotonesRespuesta" colspan="2">
                            <input class = "botonEscribirRespuesta" type="submit" name="enviarPaciente" onclick = "return validaForm();">
                            <input type="reset" class = "botonEscribirRespuesta" name="borrar">
                        </td>
                    </tr>
                </table>
                
                <?php
                    if(isset($_REQUEST['enviarPaciente'])){

                        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
                        $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : null;
                        $dni = isset($_POST['dni']) ? $_POST['dni'] : null;
                        $nss = isset($_POST['nss']) ? $_POST['nss'] : null;
                        $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : null;
                        $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;
                        $email = isset($_POST['email']) ? $_POST['email'] : null;
                        $lugarNac = isset($_POST['lugarNac']) ? $_POST['lugarNac'] : null;
                        $fechaNac = isset($_POST['fechaNac']) ? $_POST['fechaNac'] : null;
                        $password = isset($_POST['password']) ? $_POST['password'] : null;
                        $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : null;
                        $nomEmer = isset($_POST['nomEmer']) ? $_POST['nomEmer'] : null;
                        $relEmer = isset($_POST['relEmer']) ? $_POST['relEmer'] : null;
                        $telEmer = isset($_POST['telEmer']) ? $_POST['telEmer'] : null;

                        if(!$editado){   
                            $resultado = $collectionPacientes->insertOne([ 'Name' => $nombre, 
                                                           'Surname' => $apellidos,
                                                           'DNI' => $dni,
                                                           'Health_card_number' => $nss,
                                                           'Sex' => $sexo, 
                                                           'Address' => $direccion,
                                                           'Phone' => $telefono,
                                                           'Email' => $email,
                                                           'Birthplace' => $lugarNac,
                                                           'Birthdate' => $fechaNac,
                                                           'Emergency_contact' => array(
                                                                "Name" => $nomEmer,
                                                                "Relationship" => $relEmer,
                                                                "Phone" => $telEmer
                                                            ),
                                                           'Password' => $password,
                                                           //Cambiar!!!!!!!!!!!!!!!!!
                                                           'Doctor_DNI' => $dniMed
                                                           ] );
                            ?> <script> alert("Se ha creado el nuevo paciente"); </script> <?php 
                            echo "Inserted with Object ID '{$resultado->getInsertedId()}'"; //quitar cuando se termine
                        }else{
                            
                            $updateResult = $collectionPacientes->updateOne(
                                [ '_id' => $paciente['_id'] ],
                                [ '$set' => ['Name' => $nombre, 
                                    'Surname' => $apellidos,
                                    'Health_card_number' => $nss,
                                    'Sex' => $sexo, 
                                    'Address' => $direccion,
                                    'Phone' => $telefono,
                                    'Email' => $email,
                                    'Birthplace' => $lugarNac,
                                    'Birthdate' => $fechaNac,
                                    'Emergency_contact' => array(
                                        "Name" => $nomEmer,
                                        "Relationship" => $relEmer,
                                        "Phone" => $telEmer
                                    ),
                                    'Password' => $password, 
                                ]]
                            );
                            ?> <script> alert("Se han modificado los datos del paciente"); </script> <?php 
                        }
                    }
                ?>
            </form>
        </div>
    </body>
</html>