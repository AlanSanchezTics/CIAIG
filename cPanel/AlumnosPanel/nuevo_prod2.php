<?php
nuevoAlumno($_POST["idalumn"],$_POST["nombre"], $_POST['apaterno'], $_POST['amaterno'],$_POST['telefono'],$_POST['email'], $_POST["nivel"], $_POST["grado"], $_POST["grupo"], $_POST["fechaI"], $_POST["fechaF"], $_FILES["foto"]);

function nuevoAlumno($no_control,$nombre, $a_paterno, $a_materno,$telefono, $email, $nivel, $grado, $grupo, $fechaI, $fechaf, $foto){
    #var_dump($no_control,$nombre, $a_paterno, $a_materno,$telefono, $email, $nivel, $grado, $grupo, $fechaI, $fechaf, $foto);
    include "../../conexion.php";
    $sql = "SELECT ID_ALUMNO FROM tbl_alumnos WHERE ID_ALUMNO = {$no_control}";
    $alumns = mysqli_num_rows($conexion -> query($sql));
    if($alumns >0){
        echo "<script language='javascript'>"; 
        echo "window.location.href='formAlumno.php?ref=invalidAlumn';";
        echo "</script>";
        return;
    }
    $sql = "SELECT ID_ALUMNO FROM tbl_alumnos WHERE NOMBRE = '{$nombre}' AND A_PATERNO = '${a_paterno}' AND A_MATERNO = '${a_materno}' ";
    $alumns = mysqli_num_rows($conexion -> query($sql));
    if($alumns >0){
        echo "<script language='javascript'>"; 
        echo "window.location.href='formAlumno.php?ref=invalidAlumn';";
        echo "</script>";
        return;
    }
    $sql = "SELECT ID_GRUPO FROM tbl_grupos WHERE NIVEL = {$nivel} AND GRADO = {$grado} AND NOMBRE = '{$grupo}'";
    $result = $conexion -> query($sql);
    if(mysqli_num_rows($result) == 0 ){
        echo "<script language='javascript'>"; 
        echo "window.location.href='formAlumno.php?ref=invalidgrupo';";
        echo "</script>";
        return;
    }
    $idgrupo = mysqli_fetch_array($result);
    $usuario = date("Y").$no_control;
    $contraseña=$usuario;
    if($foto["name"]==""){
        $nombreimagen = "https://www.ciaigandhi.com/AlumnosPanel/imagenes_alumnos/default.png";
    }else{
		$imagen=$foto['name'];
		$tipoarchivo=$foto['type'];
		$rest = substr($tipoarchivo,6);                            
		$ruta="imagenes_alumnos/".$no_control.".".$rest;
		$nombreimagen="https://www.ciaigandhi.com/AlumnosPanel/".$ruta;                            
		#move_uploaded_file($foto['tmp_name'],$ruta);
	}
    $sql = "INSERT INTO tbl_usuarios(login,clave,usutipo,existe) VALUES ('".$usuario."',AES_ENCRYPT('".$contraseña."','INDIRAGANDHI2017'),'A',1)";
    if($conexion -> query($sql) === TRUE){
        $sql = "SELECT ID_USUARIO FROM tbl_usuarios WHERE LOGIN = '{$usuario}'";
        $result = $conexion -> query($sql);
        $idusu = $result -> fetch_array();
        
        $sql = "INSERT INTO tbl_alumnos(id_alumno,nombre,a_paterno,a_materno,grado,tel,email,nivel,fecha_ingreso,fecha_egreso,id_usuario,imagen,existe) VALUES('{$no_control}', '{$nombre}', '{$a_paterno}', '{$a_materno}', {$grado}, '{$telefono}', '{$email}',{$nivel}, '{$fechaI}', '{$fechaf}', {$idusu[0]}, '{$nombreimagen}',1)";
        if($conexion -> query($sql) === TRUE){
            $sql = "INSERT INTO tbl_asignaciongrupos(id_grupo,id_alumno,existe) VALUES (".$idgrupo[0].",".$no_control.",1)";
            if($conexion -> query($sql) === TRUE){
                move_uploaded_file($foto['tmp_name'],$ruta);
                echo "<script language='javascript'>"; 
                echo "window.location.href='formAlumno.php?ref=successAlumn';";
                echo "</script>"; return;
            }else{
                $sentencia="DELETE from tbl_usuarios where login='{$usuario}'";
                mysqli_query($conexion,$sentencia);            
                echo "<script language='javascript'>"; 
                echo "alert('Error: No Se Ha Podido Ingresar El Alumno: from asignacion');";
                echo "window.location.href='formAlumno.php';";
                echo "</script>"; return;
            }
        }else{
            $sentencia="DELETE from tbl_usuarios where login='{$usuario}'";
            mysqli_query($conexion,$sentencia);            
            echo "<script language='javascript'>"; 
            echo "alert('Error: No Se Ha Podido Ingresar El Alumno: from alumno');";
            echo "window.location.href='formAlumno.php';";
            echo "</script>"; return; 
        }
    }else{
        echo "<script language='javascript'>"; 
        echo "alert('Error: No Se Ha Podido Ingresar El Alumno: from user');";
        echo "window.location.href='formAlumno.php';";
        echo "</script>"; return;
    }
}
?>