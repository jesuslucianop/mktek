
<?php
//Aqui llamamos la conexion con la base de datos
include("libreria/conexion.php");
//$con =  mysqli_connect("localhost","root","mysql","trabajo");

/*Aqui Capturamos los datos y lo Enviamos a la base de datos a guardar */
$url = $_POST['url'];
$cdgo=$_POST['codigo'];
$codigo = substr(md5($url),27);
$url_larga_filtro=trim($url_larga,"php");
$url_corta = acortarurl($url);
$sql = "INSERT INTO tarea (url_larga,url_corta,codigo) values('{$url}','{$url_corta}','{$codigo}')";
$cf=acortarurl($url);

$rs = mysqli_query($con,$sql);



function acortarurl($url){
    $longitud = strlen($url);
    if($longitud > 1){
        $longitud = $longitud - 7;
        $parte_inicial = substr($url, -0, -$longitud);
       //$parte_final = substr($url, -5);
       $parte_final = substr(md5($url),27);
        $nueva_url = $parte_inicial."corto/".$parte_final;
        return $nueva_url;
    }else{
        return $url;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript" src="jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-theme.css" />
</head>
<body>
  <div class="container">
    <div class="row">
      <label>Su url corta es : <?php echo"<a href=\"$url\">$url_corta</a>";?></label>
<form method="post" action="">


    </div>
    <div class="form-group input-group-lg">
    <label>Deposite su Codigo</label>
<input type="text" name="codigo"  />
<button type="submit" class="btn btn-secondary" name="enviar">Enviar</button>
  </div>
  </div>
</form>
<table>
  <thead>
    <?php

if(isset($_POST['enviar'])){

  $sql = "SELECT * FROM tarea where codigo = '{$cdgo}'";
  $ds = mysqli_query($con,$sql);
  while ($fila = mysqli_fetch_assoc($ds)){
  echo"

  <tr>
  <td>{$fila['url_larga']}</td>
  </tr>


  ";
}
}
    ?>
  </thead>
</table>
</body>
</html>
