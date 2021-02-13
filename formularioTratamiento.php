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
    $collectionBraces = $mongo->ScAid->Braces;
    $collectionTecnicians = $mongo->ScAid->Tecnicians;
?>
<!DOCTYPE html>
<html>
    <script>
        function validaTratamiento(){
            date = document.formSeguimiento.fechaIni.value;
                if (date == ""){
                    alert("Debes completar la fecha de inicio");
                    return false;
                }
            desc = document.formSeguimiento.desc.value;
                if (desc == ""){
                    alert("Debes completar la descripción");
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
                        
                        
                        if($tratamiento=="Corsé"){
                            $numCorses = count($collectionBraces->find()->toArray());
                            $idCorse=$numCorses + 1;

                            $tecnicos = $collectionTecnicians->find()->toArray();
                            $numTec = count($tecnicos) - 1;
                            
                            $eleg = rand(1, $numTec);
                            $dniTec = $tecnicos[$eleg]['DNI'];

                            $collectionBraces -> insertOne( [ 
                                'idCorset' => $idCorse,
                                'Technician_DNI' => $dniTec,
                                'Patient_DNI' => $dniPac,
                                'Type' => "",
                                'Material' => "",
                                'Description' => "",
                                'Measures' => array(
                                    "Hip_measure" => "",
                                    "Waist_measure" => "",
                                    "Thorax_measure" => ""
                                )
                                ] );
                        }
                        echo "Inserted with Object ID '{$resultado->getInsertedId()}'"; //quitar cuando se termine
                    }
                ?>
        </div>
    </body>
</html>