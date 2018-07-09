<?php
NuevoProducto( $_POST['nombre'], $_POST['apaterno'], $_POST['amaterno'],$_POST['telefono'],$_POST['email'],$_POST['user'],$_POST['clave'],$_POST['cclave']);
function NuevoProducto($nombre, $a_paterno, $a_materno,$telefono,$email,$usuario,$contraseña,$contraseña2){
    include "../../conexion.php";
    $sentencia="SELECT ID_DOCENTE FROM tbl_docentes WHERE nombre='".$nombre."' and a_paterno = '".$a_paterno."' and a_materno='".$a_materno."'";
    $total = mysqli_num_rows(mysqli_query($conexion,$sentencia));
    if ($total > 0){
        echo "<script language='javascript'>"; 
        echo "window.location.href='formDoc.php?ref=invaliddoc';";
        echo "</script>"; return;
    }else{
        $sentencia="SELECT ID_USUARIO FROM tbl_usuarios WHERE login='".$usuario."'";
        $user = mysqli_num_rows(mysqli_query($conexion,$sentencia));
        if ($user>0)
        {
            echo "<script language='javascript'>"; 
            echo "window.location.href='formDoc.php?ref=invaliduser';";
            echo "</script>"; return;
        }else{
            if ($contraseña==$contraseña2) {
                    $sentencia="INSERT INTO tbl_usuarios(login,clave,usutipo,existe) VALUES ('".$usuario."',AES_ENCRYPT('".$contraseña."','INDIRAGANDHI2017'),'D',1)";
                    if ($conexion->query($sentencia) === TRUE) {
                        $sentencia="SELECT ID_USUARIO FROM tbl_usuarios WHERE login='".$usuario."'";
                        $resultado = $conexion -> query($sentencia);
                        $filas = $resultado -> fetch_array();
                        $sentencia="INSERT INTO tbl_docentes(nombre,a_paterno,a_materno,tel,email,id_usuario,existe) VALUES ('".$nombre."','".$a_paterno."','".$a_materno."','".$telefono."','".$email."',".$filas[0].",1)";
                        if ($conexion->query($sentencia) === TRUE ) {
                            echo "<script language='javascript'>"; 
                            echo "window.location.href='formDoc.php?ref=successdoc';";
                            echo "</script>"; return; 
                        } else {
                            $sentencia="DELETE from tbl_usuarios where login='{$usuario}'";
                            mysqli_query($conexion,$sentencia);
                            echo "<script language='javascript'>"; 
                            echo "alert('Error: No Se Ha Podido Ingresar El Docente');";
                            echo "window.location.href='formDoc.php';";
                            echo "</script>"; return;
                        }
                    }else{
                       echo "<script language='javascript'>"; 
                       echo "alert('conexion no hecha, contacte al administrador');";
                       echo "window.location.href='index.php';";
                       echo "</script>"; return; 
                   }
         }else{
            echo "<script language='javascript'>"; 
            echo "alert('La contraseña No Coincide');";
            echo "window.location.href='nuevo_prod1.php';";
            echo "</script>"; return;
        }
    }        
}
}
?>