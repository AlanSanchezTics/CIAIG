<?php
include 'conexion.php';
if(isset($_POST['user']) && isset($_POST['password'])){
$user = $_POST['user'];
$clave = $_POST['password'];
$sql="SELECT tbl_administradores.ID_ADMIN, tbl_administradores.NOMBRE FROM tbl_administradores,tbl_usuarios WHERE tbl_usuarios.LOGIN = '{$user}' AND tbl_usuarios.CLAVE = AES_ENCRYPT('{$clave}','INDIRAGANDHI2017') AND tbl_administradores.ID_USUARIO = tbl_usuarios.ID_USUARIO";
$result = mysqli_query($conexion,$sql);
if(mysqli_num_rows($result)>0){
    if($reg = mysqli_fetch_array($result)){
        session_start();
        $_SESSION['IDUSER'] = $reg['ID_ADMIN'];
        $_SESSION['USER'] = $reg['NOMBRE'];
        echo "<script language='javascript'>"; 
        echo "window.location.href='./cPanel/'";
        echo "</script>";
    }
}else{
    $sql1="SELECT tbl_docentes.ID_DOCENTE, tbl_docentes.NOMBRE, tbl_docentes.A_PATERNO FROM tbl_docentes,tbl_usuarios WHERE tbl_usuarios.LOGIN = '{$user}' AND tbl_usuarios.CLAVE = AES_ENCRYPT('{$clave}','INDIRAGANDHI2017') AND tbl_docentes.ID_USUARIO = tbl_usuarios.ID_USUARIO";
    $result = mysqli_query($conexion,$sql1);
    if(mysqli_num_rows($result)>0){
        if($reg = mysqli_fetch_array($result)){
            session_start();
            $_SESSION['IDUSER'] = $reg[0];
            $_SESSION['USER'] = "{$reg[1]}"." "."{$reg[2]}";
            echo "<script language='javascript'>";
            echo "window.location.href='./dPanel/'";
            echo "</script>";
        }
}else{
    echo "<script language='javascript'>";
    echo "window.location.href='index.php?ref=0'";
    echo "</script>";
}
}
}
?>