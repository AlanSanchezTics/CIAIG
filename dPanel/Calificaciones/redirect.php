<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Redirect</title>

</head>
<body>
<label>Un momento porfavor...</label>
<form>
<input type="hidden" name="grupo" value="<?php echo $_POST["grupo"];?>">
<input type="hidden" name="materia" value="<?php echo $_POST["materia"];?>">
<input type="hidden" name="periodo" value="<?php echo $_POST["periodo"];?>">
</form>
<?php
    include "../../conexion.php";
    $sql = "SELECT NIVEL FROM tbl_grupos WHERE ID_GRUPO = ".$_POST["grupo"]."";
    $nivel = mysqli_fetch_array($conexion -> query($sql));
    if($nivel[0] == 2){
        header("Location: listaAlumnos.php?grupo=".$_POST["grupo"]."&materia=".$_POST["materia"]."&periodo=".$_POST["periodo"]."" );
    }elseif($nivel[0] == 1){
        header("Location: listaAlumnosK.php?grupo=".$_POST["grupo"]."&materia=".$_POST["materia"]."&periodo=".$_POST["periodo"]."" );
    }
?>
</html>