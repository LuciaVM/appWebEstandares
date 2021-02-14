<?php

?>
<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta name="author" content="ClaraJV">
  <title>Selección de Rol</title>
  <link href="styles/estiloMedicoJefe.css" rel="stylesheet">
  <meta name="generator" content="Google Web Designer 10.0.2.0105">
  <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,regular,500,600,700" rel="stylesheet" type="text/css">
  <script type="text/javascript">
    function rolSeleccionado(){
      rol = document.formulario.rol.value;
      if (rol == "MedicoJefe"){
        window.location.href='listaMedicosMedicoJefe.php?idMed=<?php echo $idMed?>';
      } else if (rol == "Medico"){
        window.location.href='listaConsultasMedico.php?idMed=<?php echo $idMed?>';
      }
    }
  </script>
</head>

<body class="htmlNoPages">
<div class="gwd-div-lm07"></div>
  <img src="assets/logo.png" class="gwd-img-fa6j">
  <h4 class = "area" >Área de médico administrador</h4>
  <nav id="menu-superior">
    <ul>      
                <li class="gwd-p-gv4z areaListaPac">
                    <form action="seleccionarRol.php" method = "post">
                            <input type="hidden" name="medicoDNI" value= <?php $dniMed ?>>
                            <input class = "botonListaPacientes" type="submit" value="Seleccionar Rol" >
                    </form>  
                </li>
                <li class="gwd-p-gv4z areaMedicos" >
                    <form action="listaMedicosMedicoJefe.php" method = "post">
                            <input type="hidden" name="medicoDNI" value= <?php $dniMed ?>>
                            <input class = "botonMedicos" type="submit" value="Lista de Médicos" >
                    </form>  
                </li>
                <li class="gwd-p-gv4z areaRegistrar">
                    <form action="formularioRegistrarMedico.php" method = "post">
                            <input type="hidden" name="medicoDNI" value= <?php $dniMed ?>>
                            <input class = "botonRegistrar" type="submit" value="Registrar Médico" >
                    </form>  
                </li>
                <li class="gwd-p-gv4z areaSalir">
                    <form action="login.php" method = "post">
                            <!-- <input type="hidden" name="medicoDNI" value= <?php $dniMed ?>>
                            <input type="hidden" name="dniPac" value= <?php $seguimiento['Patient_DNI'] ?>> -->
                            <input class = "botonSalir" type="submit" value="Salir" >
                    </form>   
                </li>
    </ul>
  </nav>
  <div id = 'tituloSeccionRol'>
    <h1> Rol del usuario </h1>
  </div>
  <div class="form">
    <form name="formulario" method="POST">
      <table id="tablaRol">
        <tbody>
          <tr>
            <td><pre><b>Seleccione el rol que quiere usar:   </b></pre></td>
            <td colspan>
              <input type="radio" name="rol" value="Medico">Médico
              <input type="radio" name="rol" value="MedicoJefe">Médico Jefe
            </td>
          </tr>
          <tr>
            <td id = 'filaBoton' colspan="2">
              <input type="button" id = "botonRol" name="enviar" value="Seleccionar" onclick="return rolSeleccionado();">
              <!-- meter login para volver -->
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
</body>

</html>
