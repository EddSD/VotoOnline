<?php
//sesion votante
$usuario=$_POST['user'];
$contraseña=$_POST['pass'];
session_start();
$_SESSION['user']=$usuario;

$conexion=mysqli_connect("localhost","root","","proyectocuatri");

$consulta="SELECT*FROM votantes where usuario='$usuario' AND contraseña='$contraseña'";
$resultado=mysqli_query($conexion,$consulta);


if ($query = mysqli_fetch_array($resultado)) {
    header("location: votos.html");
}


/*$filas=mysqli_fetch_array($resultado);

if($filas['id_cargo']==1){ //administrador
    header("location:admin.php");

}else
if($filas['id_cargo']==2){ //votante
header("location:votos.html");
}
else{
    ?>
    <?php
    include("index.html");
    ?>
    <h1 class="bad">ERROR EN LA AUTENTIFICACION</h1>
    <?php
}
mysqli_free_result($resultado);
mysqli_close($conexion);*/
