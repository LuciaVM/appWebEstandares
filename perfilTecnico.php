<!DOCTYPE html>
<?php 
    $clara = "mongodb+srv://clarajv:zZVQaRtyyRJad99k@cluster0.wnp1l.mongodb.net/test?authSource=admin&replicaSet=atlas-mwie0e-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true";
    
    require 'vendor/autoload.php';
    use MongoDB\Client as Mongo;
    $mongo = new Mongo($clara);

    $dniTec = isset($_POST['dniTec']) ? $_POST['dniTec'] : null;

    
    $collectionTecnicians = $mongo->ScAid->Tecnicians;
    $tecnico = $collectionTecnicians->find(['DNI' => $dniTec])->toArray();
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Perfil de Técnico</title>
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
                <li class="gwd-p-gv4z">
                    <form action="perfilTecnico.php" method = "post">
                            <input type="hidden" name="dniTec" value= <?php echo $dniTec ?>>
                            <input class = "botonListaPacientes" type="submit" value="Mi Perfil" >
                    </form>  
                </li>
                <li class="gwd-p-gv4z gwd-li-yj6f">
                    <form action="listaCorsetsPendientes.php" method = "post">
                            <input type="hidden" name="dniTec" value= <?php echo $dniTec ?>>
                            <input class = "botonRegistrar" type="submit" value="Corsets Pendientes" >
                    </form>  
                </li>
                <li class="gwd-p-gv4z salir">
                    <form action="login.php" method = "post">
                            <input type="hidden" name="dniTec" value= <?php $dniTec ?>>
                            <input class = "botonSalir" type="submit" value="Salir" >
                    </form>  
                </li>
            </ul>
        </nav>

        <div class="div_medico">
            <h1> Perfil del Técnico </h1>
            <br>  </br>
            <table class = "tablaPerfilSeguimiento">
                <tbody>
                    <?php
                            echo "<tr><th>Nombre</th><td>" . $tecnico[0]['Name'] ."</td></tr>";
                            echo "<tr><th>Apellidos</th><td>" . $tecnico[0]['Surname'] ."</td></tr>";
                            echo "<tr><th>DNI</th><td>" . $tecnico[0]['DNI'] ."</td></tr>";
                            echo "<tr><th>NSS</th><td>" . $tecnico[0]['NSS'] ."</td></tr>";
                            echo "<tr><th>Dirección</th><td>" . $tecnico[0]['Address'] ."</td></tr>";
                            echo "<tr><th>Telefono</th><td><a href = tlf:'" . $tecnico[0]['Phone'] . "'>" . $tecnico[0]['Phone'] . "</a></td></tr>";
                            echo "<tr><th>Email</th><td><a href = tlf:'" . $tecnico[0]['Email'] . "'>" . $tecnico[0]['Email'] . "</a></td></tr>";
                            echo "<tr><th>Fecha de Nacimiento</th><td>" . $tecnico[0]['Birthdate'] ."</td></tr>";
                            echo "<tr><th>Lugar de Nacimiento</th><td>" . $tecnico[0]['Birthplace'] ."</td></tr>";
                            echo "<tr><th>Fecha de inicio del contrato</th><td>" . $tecnico[0]['Date_start_contract'] ."</td></tr>";                            
                        ?>
                </body>
            </table>
        </div>
    </body>
</html>