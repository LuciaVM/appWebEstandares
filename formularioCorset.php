<?php
    // session_start();
    $clara = "mongodb+srv://clarajv:zZVQaRtyyRJad99k@cluster0.wnp1l.mongodb.net/test?authSource=admin&replicaSet=atlas-mwie0e-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true";
    require 'vendor/autoload.php';

    // $idCorset = isset($_POST['idCorset']) ? $_POST['idCorset'] : null;
    // $dniTec = isset($_POST['dniTec']) ? $_POST['dniTec'] : null;

    $dniTec = "08908908-F";
    $idCorset = "277";

    use MongoDB\Client as Mongo;

    // determinar donde estamos buscando
    $mongo = new Mongo($clara);
    $collectionBraces = $mongo->ScAid->Braces;
    $collectionTecnicians = $mongo->ScAid->Tecnicians;

    $result = $collectionBraces->find()->toArray();
    foreach ($result as $entry) {
        if($entry['idCorset'] == $idCorset){
            $corse = $entry;
        }
    }

?>
<!DOCTYPE html>
<html>
    <script>
        function validaCorse(){
            tipo = document.formSeguimiento.tipo.value;
                if (tipo == ""){
                    alert("Debes completar el tipo de corset");
                    return false;
                }
            material = document.formSeguimiento.material.value;
                if (material == ""){
                    alert("Debes completar el material del corset");
                    return false;
                } 
            caderas = document.formSeguimiento.caderas.value;
                if (caderas == ""){
                    alert("Debes completar la medida de las caderas");
                    return false;
                } else if (isNaN(caderas)){
                    alert("La medida de las caderas debe ser un número");
                    return false;
                }
            cintura = document.formSeguimiento.cintura.value;
                if (cintura == ""){
                    alert("Debes completar la medida de la cintura");
                    return false;
                }else if (isNaN(cintura)){
                    alert("La medida de la cintura debe ser un número");
                    return false;
                }
            torax = document.formSeguimiento.torax.value;
                if (torax == ""){
                    alert("Debes completar la medida del tórax");
                    return false;
                }else if (isNaN(torax)){
                    alert("La medida del tórax debe ser un número");
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
        <title>Registro de un Corsé</title>
        <meta name="generator" content="Google Web Designer 10.0.2.0105">
        <link href="styles/estiloTecnicos.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,regular,500,600,700" rel="stylesheet" type="text/css"> 
    </head>
    <body>
        <div class="gwd-div-lm07"></div>
        <img src="assets/logo.png" class="gwd-img-fa6j">
        <h4 class = "area" >Área de técnico</h4>
        <nav id="menu-superior">
            <ul>
                <li li class="gwd-p-gv4z"><a href="perfilTecnico.php?idMed=<?php echo $idMed?>">Mi Perfil</h3></a></li>
                <li class="gwd-p-gv4z gwd-li-yj6f"><a href="listaCorsetsPendientes.php?idMed=<?php echo $idMed?>">Corsets Pendientes</a></li>
                <li class="gwd-p-gv4z gwd-p-5vs1"><a href="login.php">Salir</a></li>
            </ul>
        </nav>

        <div class="div_medico">
            <h1> Formulario para Introducir los Datos de un Corset  </h1>
            <br>  </br>
            <form method="POST" name = "formSeguimiento" id = "pruebaForm">
                <table class="tabla_medico"> 
                    <tr><td><pre><b>Tipo   </b></pre></td>
                        <td><input type="text" name="tipo"></td>
                    </tr>
                    <tr><td><pre><b>Material   </b></pre></td>
                        <td><input type="text" name="material"></td>
                    </tr>
                    <tr><td><pre><b>Medida de caderas   </b></pre></td>
                        <td><input type="text" name="caderas"></td>
                    </tr>
                    <tr><td><pre><b>Medida de cintura  </b></pre></td>
                       <td><input type="text" name="cintura"></td>
                    </tr>
                    <tr><td><pre><b>Medida de tórax   </b></pre></td>
                        <td><input type="text" name="torax"></td>
                    </tr>
                    <tr><td><pre><b>Descripción   </b></pre></td>
                        <td>
                            <textarea id="desc" name="desc" rows="4" cols="50" autocapitalize="sentences" placeholder="Escriba la descripción del corsé, si es necesario"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="checkbox" name="datos">Acepto que estos datos se les muestren al paciente.
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" id = "filaBotonesRespuesta">
                            <input type="submit" class = "botonEscribirRespuesta" name="enviarCorse" onclick = "return validaCorse();"> 
                            <input type="reset" class = "botonEscribirRespuesta" name="borrar">
                        </td>
                    </tr>
                </table>
                <?php
                    if(isset($_REQUEST['enviarCorse'])){

                        $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : null;
                        $material = isset($_POST['material']) ? $_POST['material'] : null;
                        $caderas = isset($_POST['caderas']) ? $_POST['caderas'] : null;
                        $cintura = isset($_POST['cintura']) ? $_POST['cintura'] : null;
                        $torax = isset($_POST['torax']) ? $_POST['torax'] : null;
                        $desc = isset($_POST['desc']) ? $_POST['desc'] : null;

                        $updateResult = $collectionBraces->updateOne(
                            [ '_id' => $corse['_id'] ],
                            [ '$set' => [
                                'Type' => $tipo,
                                'Material' => $material,
                                'Description' => $desc,
                                'Measures' => array(
                                    "Hip_measure" => $caderas,
                                    "Waist_measure" => $cintura,
                                    "Thorax_measure" => $torax
                                ),
                            ]]
                        );
                         
                            
                        ?> <script> alert("Se han guardado los datos del corsé") </script> <?php
                    }
                ?>
            </form>
        </div>
    </body>
</html>