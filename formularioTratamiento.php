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
    $collectionTreatments = $mongo->ScAid->Treatments;
?>
<!DOCTYPE html>
<html>
    <!-- <script>
        function validaTratamiento(){
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
    </script> -->
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
                            <pre><b>Formulario para Introducir los Datos de un Tratamiento   </b></pre>
                        </td>
                    </tr>
                    <tr><td><pre><b>Fecha de inicio  </b></pre></td>
                        <td><input type="date" name="fechaIni"></td>
                    </tr>
                    <tr><td><pre><b>Fecha de fin  </b></pre></td>
                        <td><input type="date" name="fechaFin"></td>
                    </tr>
                    <tr><td><pre><b>Tipo de tratamiento   </b></pre></td>
                        <td><select name="tratamiento">
                            <option value="Medicación">Medicación</option>
                            <option value="Fisioterapia">Fisioterapia</option>
                            <option value="Cirugía">Cirugía</option>
                            <option value="Corsé">Corsé</option>
                        </select></td>
                    </tr>
                    <tr><td><pre><b>Descripción   </b></pre></td>
                        <td>
                            <textarea id="desc" name="desc" rows="4" cols="50" autocapitalize="sentences" placeholder="Escriba la descripción"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="enviarTratamiento" onclick = "return validaTratamiento();"> 
                            <!-- antes era enviarCOVID -->
                            <input type="reset" name="borrar">
                        </td>
                    </tr>
                </table>
                <?php
                    if(isset($_REQUEST['enviarTratamiento'])){
                        $numTratamientos = count($collectionTreatments->find()->toArray());
                        $idTrataminento=$numTratamientos + 1;
                        $fechaIni = isset($_POST['fechaIni']) ? $_POST['fechaIni'] : null;
                        if($_POST['fechaFin']!=NULL){
                            $fechaFin = $_POST['fechaFin'];
                        } else {
                            $fechaFin = "Indefinido";
                        }
                        $tratamiento = isset($_POST['tratamiento']) ? $_POST['tratamiento'] : null;
                        $desc = isset($_POST['desc']) ? $_POST['desc'] : null;

                        $resultado = $collectionTreatments->insertOne( [ 
                            'idTreatment' => $idTrataminento,
                            'Date_start' => $fechaIni,
                            'Date_end' => $fechaFin,
                            'Type' => $tratamiento,
                            'Description' => $desc,
                            'Patient_DNI' => $dniPac
                            ] );
                        echo $fechaFin;
                        echo "Inserted with Object ID '{$resultado->getInsertedId()}'"; //quitar cuando se termine
                    }
                ?>
        </div>
    </body>
</html>