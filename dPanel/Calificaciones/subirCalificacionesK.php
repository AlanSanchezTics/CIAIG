<?php
session_start();
include "../../conexion.php";
$today = date("Y-m-d");
$sql = "SELECT tbl_asignaciongrupos.ID_ALUMNO FROM tbl_asignaciongrupos WHERE ID_GRUPO = ".$_POST["grupo"]." ";
$result = $conexion -> query($sql);
while($row = mysqli_fetch_array($result)){
    $evaluacion = $_POST["evaluacion-$row[0]"];
    $sql = "SELECT ID_CALIFICACIONESK FROM tbl_calificacionesK WHERE ID_ALUMNO =$row[0] AND ID_MATERIA=".$_POST['materia'];
    if(mysqli_num_rows($conexion->query($sql))>0){
        $sql = "UPDATE tbl_calificacionesK SET ".$_POST["periodo"]."=$evaluacion WHERE ID_ALUMNO = $row[0] AND ID_MATERIA = ".$_POST["materia"];
        $conexion -> query($sql);
    }else{
        $sql = "INSERT INTO tbl_calificacionesK(ID_ALUMNO,".$_POST["periodo"].",AÑO,ID_MATERIA,EXISTE) VALUES($row[0],$evaluacion,'$today',".$_POST['materia'].",1)";
        $conexion ->query($sql);
        echo $sql;
    }
}
    echo "<script>";
    echo "alert('Calificaciones Registradas con exito');";
    echo "window.location.href='index.php';";
    echo "</script>";
?>