<?php
session_start();
include "../../conexion.php";
$today = date("Y-m-d");
$sql = "SELECT tbl_asignaciongrupos.ID_ALUMNO FROM tbl_asignaciongrupos WHERE ID_GRUPO = ".$_POST["grupo"]." ";
$result = $conexion -> query($sql);
while($row = mysqli_fetch_array($result)){
    $id = "idalumno-".$row[0];
    $entero = $_POST["entero-$row[0]"];
    $decimal = $_POST["decimal-$row[0]"];
    $sql = "SELECT ID_CALIFICACIONES FROM tbl_calificaciones WHERE ID_ALUMNO =$row[0] AND ID_MATERIA=".$_POST['materia'];
    if(mysqli_num_rows($conexion->query($sql))>0){
        $sql = "UPDATE tbl_calificaciones SET p".$_POST["periodo"]."=$entero.$decimal WHERE ID_ALUMNO = $row[0] AND ID_MATERIA = ".$_POST["materia"];
        $conexion -> query($sql);
    }else{
        $sql = "INSERT INTO tbl_calificaciones(ID_ALUMNO,p".$_POST["periodo"].",AÑO,ID_MATERIA,EXISTE) VALUES($row[0],$entero.$decimal,'$today',".$_POST['materia'].",1)";
        $conexion ->query($sql);
        echo $sql;
    }
}
    echo "<script>";
    echo "alert('Calificaciones Registradas con exito');";
    echo "window.location.href='index.php';";
    echo "</script>";
?>