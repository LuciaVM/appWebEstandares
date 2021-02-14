<!DOCTYPE html>
<?php 
    $clara = "mongodb+srv://clarajv:zZVQaRtyyRJad99k@cluster0.wnp1l.mongodb.net/test?authSource=admin&replicaSet=atlas-mwie0e-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true";
    
    require 'vendor/autoload.php';
    use MongoDB\Client as Mongo;
    $mongo = new Mongo($clara);

    // $dniMed = isset($_POST['dniMed']) ? $_POST['dniMed'] : null;

    $dniMed = "28865083-d";
    
    $collectionMedicos = $mongo->ScAid->Doctors;
    $medico = $collectionMedicos->find(['DNI' => $dniMed])->toArray();
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Perfil de Medico</title>
        <meta name="generator" content="Google Web Designer 10.0.2.0105">
        <link href="styles/estiloMedicos.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,regular,500,600,700" rel="stylesheet" type="text/css"> 
    </head>
    <body>
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

        <div class="div_medico">
            <h1> Perfil del Médico </h1>
            <br>  </br>
            <table class = "tablaPerfilSeguimiento">
                <tbody>
                    <?php
                            echo "<tr><th>Nombre</th><td>" . $medico[0]['Name'] ."</td></tr>";
                            echo "<tr><th>Apellidos</th><td>" . $medico[0]['Surname'] ."</td></tr>";
                            echo "<tr><th>DNI</th><td>" . $medico[0]['DNI'] ."</td></tr>";
                            echo "<tr><th>NSS</th><td>" . $medico[0]['NSS'] ."</td></tr>";
                            echo "<tr><th>Dirección</th><td>" . $medico[0]['Address'] ."</td></tr>";
                            echo "<tr><th>Telefono</th><td><a href = tlf:'" . $medico[0]['Phone'] . "'>" . $medico[0]['Phone'] . "</a></td></tr>";
                            echo "<tr><th>Email</th><td><a href = tlf:'" . $medico[0]['Email'] . "'>" . $medico[0]['Email'] . "</a></td></tr>";
                            echo "<tr><th>Fecha de Nacimiento</th><td>" . $medico[0]['Birthdate'] ."</td></tr>";
                            echo "<tr><th>Lugar de Nacimiento</th><td>" . $medico[0]['Birthplace'] ."</td></tr>";
                            echo "<tr><th>Fecha de inicio del contrato</th><td>" . $medico[0]['Date_start_contract'] ."</td></tr>";
                            // echo "<tr><th>Fecha de fin del contrato</th><td>" . $medico[0]['Date_end_contract'] ."</td></tr>";
                            $medicoAsign = $collectionMedicos->find(['DNI' => $medico[0]['Head_department_DNI']])->toArray();
                            echo "<tr><th>DNI</th><td>" . $medicoAsign[0]['Name'].' '. $medicoAsign[0]['Surname'] ."</td></tr>";
                        
                        ?>
                </body>
            </table>
        </div>
    </body>
</html>