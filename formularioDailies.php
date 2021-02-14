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
    $collectionDailies = $mongo->ScAid->Dailies;
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

            roce = document.formSeguimiento.roce.value;
                if (roce == ""){
                    alert("Debes completar la escala de roce");
                    return false;
                } else if (roce < 0 || 10< roce || NAN(roce)){
                    alert("La escala de roce debe ser un número del 0 al 10");
                    return false;
                }

            dolor = document.formSeguimiento.dolor.value;
                if (dolor == ""){
                    alert("Debes completar la escala de dolor");
                    return false;
                } else if (dolor < 0 || 10< dolor || NAN(dolor)){
                    alert("La escala de dolor debe ser un número del 0 al 10");
                    return false;
                }

            sint = document.formSeguimiento.sint.value;
                if (sint == ""){
                    alert("Debes completar los síntomas");
                    return false;
                }
            
            return true;
        }
    </script>
    <head>
        <meta charset="utf-8">
        <title>Registro de Seguimiento Diario</title>
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
                    <tr>
                        <td colspan="2">
                            <pre><b>Formulario para Introducir los Datos de Seguimiento Diario   </b></pre>
                        </td>
                    </tr>
                    <tr><td><pre><b>Fecha   </b></pre></td>
                        <td><input type="date" name="fecha"></td>
                    </tr>
                    <tr><td><pre><b>Escala de roce (0 al 10)   </b></pre></td>
                        <td><input type="number" name="roce"></td>
                    </tr>
                    <tr><td><pre><b>Escala de dolor (0 al 10)   </b></pre></td>
                        <td><input type="number" name="dolor"></td>
                    </tr>
                    <tr> 
                        <td colspan="2">
                            <input type="checkbox" name="escuela">Me he ausentado en la escuela.
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="checkbox" name="social">Me he ausentado en alguna actividad social.
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="checkbox" name="dormir">He tenido problemas para dormir.
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="checkbox" name="product">He tenido menos productividad.
                        </td>
                    </tr>
                    <tr><td><pre><b>Toma de medicamento   </b></pre></td>
                        <td><input type="text" name="medicamento"></td>
                    </tr>
                    <tr><td><pre><b>Tipo de deporte realizado   </b></pre></td>
                        <td><input type="text" name="deporte"></td>
                    </tr>
                    <tr><td><pre><b>Duración del deporte (en minutos)   </b></pre></td>
                        <td><input type="number" name="durDep"></td>
                    </tr>
                    <tr><td><pre><b>Síntomas sufridos (dolor, roces, punzadas, u otros)  </b></pre></td>
                        <td><input type="text" name="sint"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="enviarSeguimiento" onclick = "return validaSeguimiento();"> 
                            <input type="reset" name="borrar">
                        </td>
                    </tr>
                </table>
                <?php
                    if(isset($_REQUEST['enviarSeguimiento'])){
              

                        $numDailies = count($collectionDailies->find()->toArray());
                        $idDaily_monitoring=$numDailies + 1;
                        $date = isset($_POST['fecha']) ? $_POST['fecha'] : null;
                        $roce = isset($_POST['roce']) ? $_POST['roce'] : null;
                        $dolor = isset($_POST['dolor']) ? $_POST['dolor'] : null;

                        if(isset($_POST['escuela'])){
                            $escuela = "True";
                        } else {
                            $escuela = "False";
                        }

                        if(isset($_POST['social'])){
                            $social = "True";
                        } else {
                            $social = "False";
                        }

                        if(isset($_POST['dormir'])){
                            $dormir = "True";
                        } else {
                            $dormir = "False";
                        }
                        
                        if(isset($_POST['product'])){
                            $product = "True";
                        } else {
                            $product = "False";
                        }

                        $medicamento = isset($_POST['medicamento']) ? $_POST['medicamento'] : null;
                        $deporte = isset($_POST['deporte']) ? $_POST['deporte'] : null;
                        $durDep = isset($_POST['durDep']) ? $_POST['durDep'] : null;
                        $sint = isset($_POST['sint']) ? $_POST['sint'] : null;

                        $resultado = $collectionDailies->insertOne( [ 
                            'idDaily_monitoring' => $idDaily_monitoring,
                            'Date' => $date,
                            'Erosion_scale' => $roce,
                            'General_pain_scale' => $dolor,
                            'Daily_life_impediment' => array(
                                "School_absence" => $escuela,
                                "Social_activity_absence" => $social,
                                "Difficulty_sleeping" => $dormir,
                                "Productivity_slowdown" => $product
                            ),
                            'Occasional_medication' => $medicamento,
                            'Sport' => array(
                                "Name" => $deporte,
                                "Number_minutes" => $durDep
                            ),
                            'Symptoms' => $sint,
                            'Patient_DNI' => $dniPac
                            ] );
                        ?> <script> alert("Se ha creado la entrada de seguimiento diario") </script> <?php
                        echo "Inserted with Object ID '{$resultado->getInsertedId()}'"; //quitar cuando se termine
                    }
                ?>
            </form>
        </div>
    </body>
</html>