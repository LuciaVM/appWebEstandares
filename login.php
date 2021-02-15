<!DOCTYPE html>

<?php 
$clara = "mongodb+srv://clarajv:zZVQaRtyyRJad99k@cluster0.wnp1l.mongodb.net/test?authSource=admin&replicaSet=atlas-mwie0e-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true";
    
require 'vendor/autoload.php';
use MongoDB\Client as Mongo;
$mongo = new Mongo($clara);
?>

<html>

<head>
  <meta charset="utf-8">
  <meta name="author" content="LuciaVM">
  <title>Login</title>
  <link href="styles/estiloLogin.css" rel="stylesheet">
  <meta name="generator" content="Google Web Designer 10.0.2.0105">
</head>

<body class="htmlNoPages">
  <div class="logo">
    <svg data-gwd-shape="rectangle" class="gwd-rect-rshb"></svg>
    <img src="assets/logo.png" id="IMG_1" class="gwd-img-98vu">
    <span class="gwd-span-6t34">¡Bienvenido!</span>
  </div>
  <div class="login">
      <?php 

        $dni = isset($_POST['dni']) ? $_POST['dni'] : null;
        $contrasenya = isset($_POST['pass']) ? $_POST['pass']: null;
        
        
        if($dni != null){
            $collectionPacientes = $mongo->ScAid->Patients;
            $paciente = $collectionPacientes->find(['DNI' => $dni])->toArray();
            if(count($paciente) == 0){
                $collectionMedicos = $mongo->ScAid->Doctors;
                $medico = $collectionMedicos->find(['DNI' => $dni])->toArray();

                if(count($medico) == 0){
                    $collectionTecnico = $mongo->ScAid->Tecnicians;
                    $tecnico = $collectionTecnico->find(['DNI' => $dni])->toArray();
                    
                    if(count($tecnico) == 0){
                        ?> <script> alert("No se encuentra ese DNI/NIE/Pasaporte") </script> <?php
                    }
                    else{
                        if($tecnico[0]['Password'] == $contrasenya){
                            //Dirigir al área de técnico
                            echo "<form name = 'envia' method = 'POST' action = 'perfilTecnico.php'>
                            <input type = hidden name = dniTec value = ".$dni.">
                            </form>
                            <script language = 'Javascript'>
                            document.envia.submit()
                            </script>";
                        }
                        else{
                            ?> <script> alert("La contraseña no es correcta") </script> <?php
                        }
                    }
                    
                }
                else{
                    if($medico[0]['Password'] == $contrasenya){
                        
                        if($medico[0]['Head_department_DNI'] == $dni){
                            //Dirigir al área de médico-jefe
                            echo "<form name = 'envia2' method = 'POST' action = 'seleccionarRol.php'>
                            <input type = hidden name = dniMed value = ".$dni.">
                            </form>
                            <script language = 'Javascript'>
                            document.envia2.submit()
                            </script>";
                        }
                        else{
                            //Dirigir al área de médico
                            echo "<form name = 'envia3' method = 'POST' action = 'listaPacientesMedico.php'>
                            <input type = hidden name = dniMed value = ".$dni.">
                            </form>
                            <script language = 'Javascript'>
                            document.envia3.submit()
                            </script>";
                        } 
                    }
                    else{
                        ?> <script> alert("La contraseña no es correcta") </script> <?php
                    }
                }
            }
            else{
                
                if($paciente[0]['Password'] == $contrasenya){
                    //Dirigir al área de paciente
                    echo "<form name = 'envia4' method = 'POST' action = 'perfilPacientePaciente.php'>
                            <input type = hidden name = dniPac value = ".$dni.">
                            </form>
                            <script language = 'Javascript'>
                            document.envia4.submit()
                            </script>";
                }
                else{
                    ?> <script> alert("La contraseña no es correcta") </script> <?php
                }
            }
        }

        ?>

    <form name = "login" action = "login.php" method = "post" enctype = "multipart/form-data">
      <span class="gwd-span-l0dx">Inicio de sesión</span>
      <input type="text" id="text_1" name = "dni" class="gwd-input-1nfr">
      <span class="gwd-span-1ogd">DNI/NIE:</span>
      <span class="gwd-span-1anj">Contraseña:</span>
      <input type="password" id="text_2" name = "pass" class="gwd-input-182e">
      <input type = "submit" id="button_1" class="gwd-button-f41u" name = "enviar" value = "Entrar">
    </form>
    
  </div>
</body>

</html>