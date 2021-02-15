<?php
  $lucia = "mongodb+srv://luciavm:sscdrsnshsm@cluster0.wnp1l.mongodb.net/test?authSource=admin&replicaSet=atlas-mwie0e-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true";
  require 'vendor/autoload.php';
  use MongoDB\Client as Mongo;
  $mongo = new Mongo($lucia);

  $dniPac = isset($_POST['dniPac']) ? $_POST['dniPac'] : null;
  // $dniPac = "10708168-S"; 
?>
<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <meta name="author" content="LuciaVM">
  <title>Listado de seguimientos</title>
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
        <li class="gwd-p-gv4z">
                    <form action="listaTratamientosPaciente.php" method = "post">
                            <input type="hidden" name="dniPac" value= <?php echo $dniPac?>>
                            <input class = "botonListaPacientes" type="submit" value="Mis tratamientos" >
                    </form>  
        </li>
        
        <li class="gwd-p-gv4z gwd-p-1qhn">
                    <form action="listaSeguimientosPaciente.php" method = "post">
                            <input type="hidden" name="dniPac" value= <?php echo $dniPac?>>
                            <input class = "botonMedicos" type="submit" value="Mis seguimientos diarios" >
                    </form>  
        </li>
        <li class="gwd-p-gv4z gwd-p-5vs1">
                    <form action="perfilPacientePaciente.php" method = "post">
                            <input type="hidden" name="dniPac" value= <?php echo $dniPac?>>
                            <input class = "botonRegistrar" type="submit" value="Datos personales" >
                    </form>  
        </li>
        <li class="gwd-p-gv4z salir">
                    <form action="login.php" method = "post">
                            <input type="hidden" name="dniPac" value= <?php echo $dniPac?>>
                            <input class = "botonSalir" type="submit" value="Salir" >
                    </form>   
        </li>
    </ul>
  </nav>
 
  
  <div class = "Listado_tratamientos_paciente">

    <h1>Listado de seguimientos diarios</h1>
    <br> </br>
    <form action="formularioDailies.php" method = "post">
        <input type="hidden" name="dniPac" value= <?php $dniPac?>>
        <input class = "botonCrearSegu" type="submit" value="Nuevo seguimiento" />
    </form>
    <div>
    <table class = "tablaListadoSeguimientosPaciente">
            <tr>
                <th> ID </th>
                <th> Fecha </th>
                <th> Ver perfil del seguimiento </th>
            </tr>
        <?php
             
             $collection = $mongo->ScAid->Dailies;
             $result = $collection->find()->toArray();
             foreach ($result as $daily) {
                 if($daily['Patient_DNI ']){
                    echo '<tr>
                       <td>'.$daily['idDaily_monitoring'].'</td>
                       <td>'.$daily['Date'].'</td>
                       <td>
                         <form action="perfilSeguimientoPaciente.php" method = "post">
                           <input type="hidden" name="dniPac" value= '.$dniPac.'>
                           <input type="hidden" name="idDaily" value= '.$daily['_id'].'>
                           <input class = "botonDetalles" type="submit" value="Detalles" />
                         </form>
                       </td>
                   </tr>';
                 }
               }
               if(count($result) == 0){
                echo '<tr><td colspan = "3">No hay resultados</td></tr>';
               }
               ?>

        </table>
    </div>
  </div>
  
  
</body>

</html>

