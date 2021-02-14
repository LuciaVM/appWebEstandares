<?php
    // session_start();
    $clara = "mongodb+srv://clarajv:zZVQaRtyyRJad99k@cluster0.wnp1l.mongodb.net/test?authSource=admin&replicaSet=atlas-mwie0e-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true";
    require 'vendor/autoload.php';

    // $dniPac = isset($_POST['dniPac']) ? $_POST['dniPac'] : null;
    $dniPac = "10708168-S";
    use MongoDB\Client as Mongo;

    // determinar donde estamos buscando
    $mongo = new Mongo($clara);
    $collectionPacientes = $mongo->ScAid->Patients;
    $collectionConsultations = $mongo->ScAid->Consultations;
?>
<!DOCTYPE html>
<html>
    <script>
        function validaSeguimiento(){
            date = document.formSeguimiento.fecha.value;
                if (date == ""){
                    alert("Debes completar la fecha");
                    return false;
                }
            sala = document.formSeguimiento.sala.value;
                if (sala == ""){
                    alert("Debes completar la sala");
                    return false;
                }
            hora = document.formSeguimiento.hora.value;
                if (hora == ""){
                    alert("Debes completar la hora");
                    return false;
                }
            desv = document.formSeguimiento.desv.value;
                if (desv == ""){
                    alert("Debes completar el grado de desviación");
                    return false;
                }
            curv = document.formSeguimiento.curv.value;
                if (curv == ""){
                    alert("Debes completar el patrón de la curvatura");
                    return false;
                }
            loc = document.formSeguimiento.loc.value;
                if (loc == ""){
                    alert("Debes completar la localización de la curvatura");
                    return false;
                }
            obs = document.formSeguimiento.obs.value;
                if (obs == ""){
                    alert("Debes completar las observaciones");
                    return false;
                }
            alt = document.formSeguimiento.alt.value;
                if (alt == ""){
                    alert("Debes completar la altura");
                    return false;
                }
            peso = document.formSeguimiento.peso.value;
                if (peso == ""){
                    alert("Debes completar el peso");
                    return false;
                }
            neur = document.formSeguimiento.neur.value;
                if (neur == ""){
                    alert("Debes completar los datos sobre los test neurológicos");
                    return false;
                }
            pres = document.formSeguimiento.pres.value;
                if (pres == ""){
                    alert("Debes completar la presión sanguínea");
                    return false;
                }

            if(!document.formSeguimiento.datos.checked){
                alert("Debe aceptar el tratamiento de datos");
                return false;
            }
            return true;
        }
    </script>
    <head>
        <meta charset="utf-8">
        <title>Registro de Seguimiento</title>
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
                <table id="tablaSeguimiento"> 
                <!-- antes eran COVID--> 
                    <tr>
                        <td colspan="2">
                            <pre><b>Formulario para Introducir los Datos de Seguimiento   </b></pre>
                        </td>
                    </tr>
                    <tr><td><pre><b>Fecha   </b></pre></td>
                        <td><input type="date" name="fecha"></td>
                    </tr>
                    <tr><td><pre><b>Sala   </b></pre></td>
                        <td><input type="text" name="sala"></td>
                    </tr>
                    <tr><td><pre><b>Hora   </b></pre></td>
                        <td><input type="time" name="hora"></td>
                    </tr>
                    <tr><td><pre><b>Grado de Desviación   </b></pre></td>
                       <td><input type="text" name="desv"></td>
                    </tr>
                    <tr><td><pre><b>Patrón de Curvatura   </b></pre></td>
                        <td><input type="text" name="curv"></td>
                    </tr>
                    <tr><td><pre><b>Localización de la curvatura   </b></pre></td>
                        <td><input type="text" name="loc"></td>
                    </tr>
                    <tr><td><pre><b>Observaciones   </b></pre></td>
                        <td>
                            <textarea id="obs" name="obs" rows="4" cols="50" autocapitalize="sentences" placeholder="Escriba sus observaciones"></textarea>
                        </td>
                    </tr>
                    <tr><td><pre><b>Altura   </b></pre></td>
                        <td><input type="text" name="alt"></td>
                    </tr>
                    <tr><td><pre><b>Peso   </b></pre></td>
                        <td><input type="text" name="peso"></td>
                    </tr>
                    <tr><td><pre><b>Test Neurológico   </b></pre></td>
                        <td>
                            <textarea id="neur" name="neur" rows="4" cols="50" autocapitalize="sentences" placeholder="Escriba sus observaciones"></textarea>
                        </td>
                    </tr>
                    <tr><td><pre><b>Presión sanguínea   </b></pre></td>
                        <td><input type="text" name="pres"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="checkbox" name="datos">Acepto que estos datos se les muestren al paciente.
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="enviarSeguimiento" onclick = "return validaSeguimiento();"> 
                            <!-- antes era enviarCOVID -->
                            <input type="reset" name="borrar">
                        </td>
                    </tr>
                </table>
                <?php
                    if(isset($_REQUEST['enviarSeguimiento'])){
                        $numConsultas = count($collectionConsultations->find()->toArray());
                        $idConsulta=$numConsultas + 1;
                        $date = isset($_POST['fecha']) ? $_POST['fecha'] : null;
                        $room = isset($_POST['sala']) ? $_POST['sala'] : null;
                        $hour = isset($_POST['hora']) ? $_POST['hora'] : null;
                        $desv = isset($_POST['desv']) ? $_POST['desv'] : null;
                        $curv = isset($_POST['curv']) ? $_POST['curv'] : null;
                        $loc = isset($_POST['loc']) ? $_POST['loc'] : null;
                        $obs = isset($_POST['obs']) ? $_POST['obs'] : null;
                        $alt = isset($_POST['alt']) ? $_POST['alt'] : null;
                        $peso = isset($_POST['peso']) ? $_POST['peso'] : null;
                        $neur = isset($_POST['neur']) ? $_POST['neur'] : null;
                        $pres = isset($_POST['pres']) ? $_POST['pres'] : null;

                        $resultado = $collectionConsultations->insertOne( [ 
                            'idConsultation' => $idConsulta,
                            'Date' => $date,
                            'Room' => $room,
                            'Hour' => $hour,
                            'Fixed_attributes' => array(
                                "Desviation_degree" => $desv,
                                "Curvature_pattern" => $curv,
                                "Curvature_location" => $loc
                            ),
                            'Observations' => $obs,
                            'Height' => $alt,
                            'Weight' => $peso,
                            'Neurological_test' => $neur,
                            'Blood_pressure' => $pres,
                            'Patient_DNI' => $dniPac
                            ] );
                        ?> <script> alert("Se ha creado el informe de seguimiento") </script> <?php
                        echo "Inserted with Object ID '{$resultado->getInsertedId()}'"; //quitar cuando se termine
                    }
                ?>
            </form>
        </div>
    </body>
</html>