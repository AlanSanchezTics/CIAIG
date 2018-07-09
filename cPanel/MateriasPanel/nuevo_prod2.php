<?php
    NuevaMateria($_POST["nombreMat"], $_POST["nivel"],$_POST["grado"], $_POST["matTipo"]);
    function NuevaMateria($materia, $nivel, $grado, $mattipo){
        var_dump($materia, $nivel, $grado, $mattipo);
        include "../../conexion.php";

        $sql = "SELECT ID_MATERIA FROM tbl_materias WHERE NIVEL = {$nivel} AND NOMBRE_MATERIA = '{$materia}' AND GRADO = {$grado} AND MAT_TIPO = {$mattipo}";
        $tildes = $conexion->query("SET NAMES 'utf8'");
        $total = mysqli_num_rows($conexion -> query($sql));
        if ($total > 0 ) {
            echo "<script language='javascript'>"; 
            echo "window.location.href='FormMateria.php?ref=invalidmateria';";
            echo "</script>";
        return;
        }
        
        $sql = "INSERT INTO tbl_materias(nivel,nombre_materia,grado,mat_tipo,existe)VALUES ({$nivel},'{$materia}',{$grado},{$mattipo},1)";
        if ($conexion -> query($sql)) {
            $sql = "SELECT ID_MATERIA FROM tbl_materias WHERE NIVEL = {$nivel} AND NOMBRE_MATERIA = '{$materia}' AND GRADO = {$grado} AND MAT_TIPO = {$mattipo}";
            $tildes = $conexion->query("SET NAMES 'utf8'");
            $id = mysqli_fetch_array($conexion -> query($sql));

            $sql = "SELECT id_grupo from tbl_grupos where grado={$grado} and nivel={$nivel} and existe=1";
            $result = mysqli_query($conexion,$sql);
            while ($row = mysqli_fetch_array($result)) {
                $sentencia="INSERT INTO tbl_asignacionmaterias(id_grupo,id_materia,existe) VALUES ({$row[0]},{$id[0]},1)";
                if ($conexion->query($sentencia) === TRUE ) {
                }else{
                    echo "Error";
                    var_dump($sentencia);
                }
            }
            echo "<script language='javascript'>";
            echo "alert('Materia registrada correctamente!!');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }else{
            echo "<script language='javascript'>"; 
            echo "alert(Server Error: Contacte al administrador);";
            echo "window.location.href='index.php';";
            echo "</script>"; 
            return;
        }
    }
?>