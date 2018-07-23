<?php
    $json =file_get_contents("php://input");
    $obj = json_decode($json,true);
    $alumno= $obj['idAlumno'];
    $nivel = $obj['nivel'];
    include "../../conexion.php";
    if($nivel == "Primaria"){
        $sql="SELECT tbl_materias.NOMBRE_MATERIA,P1,P2,P3,P4,P5 FROM tbl_materias, tbl_calificaciones WHERE ID_ALUMNO='{$alumno}' AND tbl_calificaciones.ID_MATERIA = tbl_materias.ID_MATERIA AND tbl_calificaciones.EXISTE=1 ORDER BY tbl_materias.MAT_TIPO";
    }else{
        $sql="SELECT tbl_materias.NOMBRE_MATERIA,Septiembre,Octubre,Noviembre,Diciembre,Enero,Febrero,Marzo,Abril,Mayo,Junio FROM tbl_materias, tbl_calificacionesk WHERE ID_ALUMNO='{$alumno}' AND tbl_calificacionesk.ID_MATERIA = tbl_materias.ID_MATERIA AND tbl_calificacionesk.EXISTE=1";
    }
    $result= mysqli_query($conexion,$sql);

    if($sql){
        while($reg = mysqli_fetch_array($result)){
            if($nivel=="Primaria"){
                $arreglo[] = array('name' => $reg['NOMBRE_MATERIA'], 'p1' =>$reg["P1"], 'p2' =>$reg["P2"], 'p3' =>$reg["P3"], 'p4' =>$reg["P4"], 'p5' =>$reg["P5"]);
            }else if($nivel == "Preescolar"){
                $arreglo[] = array('name' => $reg[0], 'Sep'=> $reg[1], 'Oct' => $reg[2], 'Nov' => $reg[3], 'Dic' => $reg[4], 'Ene' => $reg[5], 'Feb' => $reg[6], 'Mar' => $reg[7], 'Abr' => $reg[8], 'May' => $reg[9], 'Jun' => $reg[10]);
            }
        }
        $materias = json_encode($arreglo);
    }
    echo($materias);
?>