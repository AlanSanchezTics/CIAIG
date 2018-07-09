<?php
nuevoGrupo($_POST["nivel"], $_POST["grado"], $_POST["grupo"],$_POST["cmbdocente_e"],$_POST["cmbdocente_i"]);

function nuevoGrupo($nivel,$grado,$grupo,$doce,$doci){
	include "../../conexion.php";

	$sql = "SELECT ID_GRUPO FROM tbl_grupos WHERE NIVEL = {$nivel} AND GRADO = {$grado} AND NOMBRE = '{$grupo}'";
	$grupos = mysqli_num_rows(mysqli_query($conexion, $sql));
	if ($grupos > 0) {
		echo "<script language='javascript'>"; 
        echo "window.location.href='formGrupos.php?ref=invalidgrupo';";
        echo "</script>";
        return;   
	}

	$sql = "INSERT INTO tbl_grupos(NIVEL,GRADO,ID_DOCENTE_E,ID_DOCENTE_I,NOMBRE,EXISTE) VALUES({$nivel}, {$grado}, {$doce}, {$doci}, '{$grupo}', 1)";
	if($conexion -> query($sql) === TRUE){
		echo "<script language='javascript'>";
		echo "alert('Grupo registrado correctamente');";
        echo "window.location.href='index.php';";
        echo "</script>";
	}else{
		var_dump($nivel,$grado,$grupo,$doce,$doci);
	}
}

?>