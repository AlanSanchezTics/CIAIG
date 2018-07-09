<?php
    if(isset($_GET['ref'])){
        switch ($_GET['ref']) {
            case 'mod':
                modAlumno($_POST["idalumnant"],$_POST["idalumn"],$_POST["nombre"], $_POST['apaterno'], $_POST['amaterno'],$_POST['telefono'],$_POST['email'], $_POST["nivel"], $_POST["grado"], $_POST["grupo"], $_POST["fechaI"], $_POST["fechaF"], $_FILES["foto"]);
                break;
            case 'del':
                borrarAlumno($_GET["no"],$_GET["id"],$_GET["nivel"]);
                break;
            default:
                # code...
                break;
        }
    }

    function modAlumno($idalumnant, $no_control,$nombre, $a_paterno, $a_materno, $telefono, $email, $nivel, $grado, $grupo, $fechaI, $fechaF, $foto){
       #var_dump($idalumnant, $no_control, $a_paterno, $a_materno, $telefono, $email, $nivel, $grado, $grupo, $fechaI, $fechaF, $foto);
       include "../../conexion.php"; 
       if($idalumnant == $no_control){
			$sql = "SELECT ID_ALUMNO FROM tbl_alumnos WHERE NOMBRE = '{$nombre}' AND A_PATERNO = '${a_paterno}' AND A_MATERNO = '${a_materno}' AND ID_ALUMNO <> {$no_control}";
			$alumns = mysqli_num_rows($conexion -> query($sql));
			if($alumns >0){
				echo "<script language='javascript'>"; 
				echo "window.location.href='formAlumno.php?ref=invalidAlumn&no={$idalumnant}';";
				echo "</script>"; return;
			}
			
			$sql = "SELECT ID_GRUPO FROM tbl_grupos WHERE NIVEL = {$nivel} AND GRADO = {$grado} AND NOMBRE = '{$grupo}'";
			$result = $conexion -> query($sql);
			if(mysqli_num_rows($result) == 0 ){
				echo "<script language='javascript'>"; 
				echo "window.location.href='formAlumno.php?ref=invalidgrupo&no={$idalumnant}';";
				echo "</script>"; return;
			}
			$idgrupo = mysqli_fetch_array($result);

			if($foto["name"]==""){
				$sql = "SELECT IMAGEN FROM tbl_alumnos WHERE ID_ALUMNO = {$idalumnant}";
				$reg = mysqli_fetch_array(mysqli_query($conexion, $sql));
				$nombreimagen = $reg[0];
			}else{
				$imagen=$foto['name'];
				$tipoarchivo=$foto['type'];
				$rest = substr($tipoarchivo,6);                            
				$ruta="imagenes_alumnos/".$no_control.".".$rest;
				$nombreimagen="https://www.ciaigandhi.com/AlumnosPanel/".$ruta;                            
				#move_uploaded_file($foto['tmp_name'],$ruta);
			}
			
			$sql = " UPDATE tbl_alumnos SET NOMBRE = '{$nombre}', A_PATERNO = '{$a_paterno}', A_MATERNO = '{$a_materno}', GRADO = {$grado}, TEL = '{$telefono}', EMAIL = '{$email}', NIVEL = {$nivel}, FECHA_INGRESO = '{$fechaI}', FECHA_EGRESO = '{$fechaF}', IMAGEN = '{$nombreimagen}' WHERE ID_ALUMNO = {$no_control}";
			if($conexion -> query($sql) == TRUE){
				$sql="UPDATE tbl_asignaciongrupos SET id_grupo={$idgrupo[0]} where id_alumno={$no_control}";
				if($conexion -> query($sql) == TRUE){
					move_uploaded_file($foto['tmp_name'],$ruta);
					switch ($nivel) {
						case 1:
							echo "<script language='javascript'>"; 
							echo "alert('los datos del alumno {$nombre} se actualizó correctamente!!');";
							echo "window.location.href='indexK.php';";
							echo "</script>"; return;
							break;
						case 2:
							echo "<script language='javascript'>"; 
							echo "alert('los datos del alumno {$nombre} se actualizó correctamente!!');";
							echo "window.location.href='indexP.php';";
							echo "</script>"; return;
							break;
					}
				}
			}else{
				echo "<script language='javascript'>"; 
				echo "alert('Error: No Se Ha Podido Ingresar El Alumno: from Alumno');";
				echo "window.location.href='../adminhome.php';";
				echo "</script>"; return;
			}
        }else{
			$sql = "SELECT ID_ALUMNO FROM tbl_alumnos WHERE ID_ALUMNO = {$no_control}";
            $alumns = mysqli_fetch_array(mysqli_query($conexion, $sql));
			if($alumns >0){
				echo "<script language='javascript'>"; 
				echo "window.location.href='modAlumno.php?ref=invalidAlumn&no={$idalumnant}';";
				echo "</script>"; return;
			}
			$sql = "SELECT ID_GRUPO FROM tbl_grupos WHERE NIVEL = {$nivel} AND GRADO = {$grado} AND NOMBRE = '{$grupo}'";
			$result = $conexion -> query($sql);
			if(mysqli_num_rows($result) == 0 ){
				echo "<script language='javascript'>"; 
				echo "window.location.href='formAlumno.php?ref=invalidgrupo&no={$idalumnant}';";
				echo "</script>"; return;
			}
			$idgrupo = mysqli_fetch_array($result);

			$usuario = date("Y").$no_control;
			$clave = $usuario;
			
			$sql = "SELECT ID_USUARIO FROM tbl_alumnos WHERE ID_ALUMNO = {$idalumnant}";
			$iduser = mysqli_fetch_array(mysqli_query($conexion, $sql));
			
			$sql = "UPDATE tbl_usuarios SET LOGIN = '{$usuario}', CLAVE = AES_ENCRYPT('{$clave}','INDIRAGANDHI2017') WHERE ID_USUARIO = {$iduser[0]}";
			if($conexion -> query($sql)==FALSE){
				echo "<script language='javascript'>"; 
				echo "alert('Error: No Se Ha Podido Ingresar El Alumno: from User');";
				echo "window.location.href='../adminhome.php';";
				echo "</script>"; return;
			}
			$sql = "SELECT ID_USUARIO FROM tbl_usuarios WHERE LOGIN = '{$usuario}'";
			$iduser = mysqli_fetch_array(mysqli_query($conexion, $sql));

			if($foto["name"]==""){
				$sql = "SELECT IMAGEN FROM tbl_alumnos WHERE ID_ALUMNO = {$idalumnant}";
				$reg = mysqli_fetch_array(mysqli_query($conexion, $sql));
				$nombreimagen = $reg[0];
			}else{
				$imagen=$foto['name'];
				$tipoarchivo=$foto['type'];
				$rest = substr($tipoarchivo,6);                            
				$ruta="imagenes_alumnos/".$no_control.".".$rest;
				$nombreimagen="https://www.ciaigandhi.com/AlumnosPanel/".$ruta;                            
				#move_uploaded_file($foto['tmp_name'],$ruta);
			}
			
			$sql = " UPDATE tbl_alumnos SET ID_ALUMNO = {$no_control}, NOMBRE = '{$nombre}', A_PATERNO = '{$a_paterno}', A_MATERNO = '{$a_materno}', GRADO = {$grado}, TEL = '{$telefono}', EMAIL = '{$email}', NIVEL = {$nivel}, FECHA_INGRESO = '{$fechaI}', FECHA_EGRESO = '{$fechaF}', ID_USUARIO = {$iduser[0]} , IMAGEN = '{$nombreimagen}' WHERE ID_ALUMNO = {$idalumnant}";
			if($conexion -> query($sql) == TRUE){
				$sql="UPDATE tbl_asignaciongrupos SET id_grupo={$idgrupo[0]} where id_alumno={$no_control}";
				if($conexion -> query($sql) == TRUE){
					move_uploaded_file($foto['tmp_name'],$ruta);
					switch ($nivel) {
						case 1:
							echo "<script language='javascript'>"; 
							echo "alert('los datos del alumno {$nombre} se actualizó correctamente!!');";
							echo "window.location.href='indexK.php';";
							echo "</script>"; return;
							break;
						case 2:
							echo "<script language='javascript'>"; 
							echo "alert('los datos del alumno {$nombre} se actualizó correctamente!!');";
							echo "window.location.href='indexP.php';";
							echo "</script>"; return;
							break;
					}
				}
			}
		}
	}
	function borrarAlumno($no_control, $iduser, $nivel)
	{
		include "../../conexion.php";
		$sql = "UPDATE tbl_alumnos SET EXISTE = 0 WHERE ID_ALUMNO = {$no_control}";
		if($conexion -> query($sql) == TRUE){
			$sql = "UPDATE tbl_usuarios SET EXISTE = 0 WHERE ID_USUARIO = {$iduser}";
			if($conexion -> query($sql) == TRUE){
				switch ($nivel) {
					case 1:
							echo "<script language='javascript'>"; 
							echo "alert('El alumno fue eliminado correctamente!!');";
							echo "window.location.href='indexK.php';";
							echo "</script>"; return;
							break;
					case 2:
							echo "<script language='javascript'>"; 
							echo "alert('El alumno fue eliminado correctamente!!');";
							echo "window.location.href='indexP.php';";
							echo "</script>"; return;
							break;
				}
			}
		}
	}
?>