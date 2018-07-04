<?php
    if (isset($_GET["ref"])) {
        if ($_GET["ref"] == "mod") {
            modificarMateria($_POST["idmat"],$_POST["nombreMat"], $_POST["nivel"],$_POST["grado"], $_POST["matTipo"]);
        } elseif ($_GET["ref"] == "del") {
            eliminarMateria($_GET["id"]);
        } 
    }

    function modificarMateria($idmat,$nombre,$nivel,$grado,$tipomat){
        include "../conexion.php";
        $tildes = $conexion->query("SET NAMES 'utf8'");

        $sql = "SELECT ID_MATERIA FROM tbl_materias WHERE NIVEL = {$nivel} AND NOMBRE_MATERIA = '{$nombre}' AND GRADO = {$grado} AND MAT_TIPO = {$tipomat} AND ID_MATERIA <> {$idmat}";
        $total = mysqli_num_rows($conexion -> query($sql));
        if ($total > 0) {
            echo "<script language='javascript'>"; 
            echo "window.location.href='FormMateria.php?ref=invalidmateria';";
            echo "</script>";
        return;
        }

        $sql = "UPDATE tbl_materias SET NIVEL = {$nivel}, NOMBRE_MATERIA = '{$nombre}', GRADO = {$grado}, MAT_TIPO = {$tipomat} WHERE ID_MATERIA = {$idmat}";
        if ($conexion -> query($sql)== TRUE) {
            $sql = "SELECT id_grupo from tbl_grupos where grado={$grado} and nivel={$nivel} and existe=1";
            $result = $conexion -> query($sql);
            while ($row = mysqli_fetch_array($result)) {
                $sql = "UPDATE tbl_asignacionmaterias SET ID_GRUPO = $row[0] WHERE ID_MATERIA = $idmat";
                if($conexion -> query($sql) == FALSE){
                    echo "<script language='javascript'>";
                    echo "alert('Ocurrio un error al momento de la actualizacion de datos, contacta al administrador. CODIGO:ASIGNACIONMATERIA');"; 
                    echo "window.location.href='index.php';";
                    echo "</script>";
                    return;
                }
            }
            echo "<script language='javascript'>";
            echo "alert('Materia Actualizada correctamente!!');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
        var_dump("final");
    }

    function eliminarMateria($idmat){
        include "../conexion.php";
        $tildes = $conexion->query("SET NAMES 'utf8'");

        $sql = "UPDATE tbl_materias SET EXISTE = 0 WHERE ID_MATERIA = {$idmat}";
        if ($conexion -> query($sql)) {
            $sql = "UPDATE tbl_asignacionmaterias SET EXISTE = 0 WHERE ID_MATERIA = {$idmat}";
            if ($conexion -> query($sql)) {
                echo "<script language='javascript'>";
                echo "alert('Materia eliminada correctamente!!');";
                echo "window.location.href='index.php';";
                echo "</script>";
            }else{
                echo "<script language='javascript'>";
                echo "alert('Ocurrio un error al momento de la acción, contacta al administrador. CODIGO:DELETEASIGNACIONES');";
                echo "window.location.href='index.php';";
                echo "</script>";
            }
        }else{
            echo "<script language='javascript'>";
            echo "alert('Ocurrio un error al momento de la acción, contacta al administrador. CODIGO:DELETEMATERIA');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    }
?>