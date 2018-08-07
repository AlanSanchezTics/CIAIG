<?php 
	$json =file_get_contents("php://input");
	$obj = json_decode($json,true);
	$grado = $obj["grado"];

	 include "../../conexion.php";
	$sql = "SELECT ID_AVISO, TITULO_AVISO, DESCRIPCION_AVISO, FECHA_INICIAL, FECHA_FINAL FROM tbl_avisos_grupo WHERE ID_GRUPO = {$grado} AND FECHA_FINAL > NOW() AND EXISTE = 1 ORDER BY ID_AVISO DESC";
	$result = mysqli_query($conexion,$sql);
	
	if($sql){
		while($reg = mysqli_fetch_array($result)){
			$arreglo[] = array('idAviso' => $reg["ID_AVISO"],'titulo' => $reg["TITULO_AVISO"],'descripcion' => $reg["DESCRIPCION_AVISO"],'fechaEm' => $reg["FECHA_INICIAL"],'fechaAC' => $reg["FECHA_FINAL"]);
		}
		$datos = json_encode($arreglo);
	}
	echo($datos);
 ?>