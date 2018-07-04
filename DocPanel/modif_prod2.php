<?php 
    if(isset($_GET['ref'])){
        if($_GET['ref'] == 'mod'){
            ModificarDoc($_POST['id_doc'], $_POST['nombre'], $_POST['apaterno'], $_POST['amaterno'],$_POST['telefono'],$_POST['email']);
        }else if($_GET['ref'] == 'del'){
            EliminarDoc($_GET['no'],$_GET['id']);
        }else if($_GET['ref'] == 'modu'){
            ModificarUser($_POST['id_doc'], $_POST['user'], $_POST['clave'], $_POST['cclave']);
        }
    }
    function ModificarDoc($id_doc, $nombre, $a_paterno, $a_materno, $telefono,$email){
        include "../conexion.php";
    
        $sentencia="SELECT ID_DOCENTE FROM tbl_docentes WHERE ID_DOCENTE <> ".$id_doc." and nombre='".$nombre."' and a_paterno = '".$a_paterno."' and a_materno='".$a_materno."'";
        $admins = mysqli_num_rows(mysqli_query($conexion,$sentencia));
        if($admins > 0 ){
            echo "<script language='javascript'>"; 
            echo "window.location.href='modDoc.php?ref=1';";
            echo "</script>"; return;
        }
        $sentencia = "UPDATE tbl_docentes SET nombre= '".$nombre."', a_paterno='".$a_paterno."',a_materno= '".$a_materno."',tel= '".$telefono."',email= '".$email."' WHERE ID_DOCENTE=".$id_doc." ";
        if ($conexion->query($sentencia) === TRUE){
            echo "<script language='javascript'>"; 
            echo "alert('Datos de {$nombre} actualizados');";
            echo "window.location.href='index.php';";
            echo "</script>"; return;
        }
    }
    function ModificarUser($id_user,$user,$pass1, $pass2){
        include "../conexion.php";
       var_dump($id_user,$user, $pass1, $pass2);
       $sql = "SELECT ID_USUARIO FROM tbl_usuarios WHERE ID_USUARIO <> '{$id_user}' AND tbl_usuarios.LOGIN = '{$user}'";
       $users = mysqli_num_rows(mysqli_query($conexion,$sql));
       if($users > 0 ){
        echo "<script language='javascript'>"; 
        echo "window.location.href='modUser.php?ref=invaliduser&idref=$id_user&usuref=$user;";
        echo "</script>"; return;
       }
         $sql = "SELECT AES_DECRYPT(tbl_usuarios.CLAVE,'INDIRAGANDHI2017') FROM tbl_usuarios WHERE ID_USUARIO = {$id_user}";
         $passwords = mysqli_fetch_array(mysqli_query($conexion,$sql));
         if($passwords[0] == $pass1){
         $sql = "UPDATE tbl_usuarios SET CLAVE = AES_ENCRYPT('{$pass2}','INDIRAGANDHI2017') WHERE ID_USUARIO= {$id_user}";
         if(mysqli_query($conexion,$sql) === TRUE){
            echo "<script language='javascript'>";
            echo "alert('Datos de usuario actualizados');"; 
            echo "window.location.href='index.php';";
            echo "</script>"; return;
         }
         }else{
            echo "<script language='javascript'>";
            echo "window.location.href='modUser.php?ref=invalidpassword&idref=$id_user&usuref=$user';";
            echo "</script>"; return;
         }
    }
    function EliminarDoc($id_doc,$id_user){
        include "../conexion.php";
        $sql = "UPDATE tbl_docentes SET existe = 0 WHERE ID_DOCENTE = {$id_doc}";
        if (mysqli_query($conexion,$sql)) {
            $sql = "UPDATE tbl_usuarios SET EXISTE = 0 WHERE ID_USUARIO = {$id_user}";
            if(mysqli_query($conexion,$sql)){
                echo "<script language='javascript'>";
            echo "alert('Docente eliminado correctamente!!');"; 
            echo "window.location.href='index.php';";
            echo "</script>"; return;
            }
        }
    }
?>