<?php
$json =file_get_contents("php://input");
$obj = json_decode($json,true);
$idAlumno = "2018"."".$obj["idAlumno"];

if(isset($_POST["idAlumno"])){
    $idAlumno = "2018"."".$_POST["idAlumno"];
}

include "conexion.php";
$sql ="UPDATE tbl_usuarios SET TOKEN = NULL WHERE LOGIN = '{$idAlumno}'";
if(mysqli_query($conexion,$sql)===TRUE){
    echo json_encode(true);
}else{
    echo json_encode(false);
}
?>