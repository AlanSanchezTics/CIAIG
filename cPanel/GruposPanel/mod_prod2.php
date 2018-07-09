<?php
    if(isset($_GET["ref"])){
        if ($_GET["ref"] == "mod") {
            modificarGrupo($_POST["id"],$_POST["nivel"],$_POST["grado"],$_POST["grupo"],$_POST["cmbdocente_e"],$_POST["cmbdocente_i"]);
        }elseif ($_GET["ref"] == "del") {
            EliminarGrupo($_GET["id"]);
        }
    }

    function modificarGrupo($idgrupo,$nivel,$grado,$grupo,$doce,$doci){
        include "../../conexion.php";
        
        $sql = "SELECT ID_GRUPO FROM tbl_grupos WHERE NIVEL = {$nivel} AND GRADO = {$grado} AND NOMBRE = '{$grupo}' AND ID_GRUPO <> {$idgrupo}";
        $grupos = mysqli_num_rows(mysqli_query($conexion, $sql));
        if ($grupos > 0) {
            echo "<script language='javascript'>"; 
            echo "window.location.href='modGrupo.php?ref=invalidgrupo&no=$idgrupo';";
            echo "</script>";
        return;   
    }
    
    $sql = "UPDATE tbl_grupos SET NIVEL = {$nivel} , GRADO = {$grado} , ID_DOCENTE_E = {$doce} , ID_DOCENTE_I = {$doci} , NOMBRE = '{$grupo}' WHERE ID_GRUPO = {$idgrupo}";
    if($conexion -> query($sql) === TRUE){
		echo "<script language='javascript'>";
		echo "alert('Grupo Actualizado correctamente');";
        echo "window.location.href='index.php';";
        echo "</script>";
	}
    }

    function EliminarGrupo($idgrupo){
        include "../../conexion.php";

        $sql = "UPDATE tbl_grupos SET EXISTE = 0 WHERE ID_GRUPO = {$idgrupo}";
        if($conexion -> query($sql) === TRUE){
            echo "<script language='javascript'>";
            echo "alert('Grupo eliminado correctamente');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    }
?> 