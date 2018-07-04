<?php
session_start();
include "../../conexion.php";
$sql = "SELECT tbl_alumnos.ID_ALUMNO,tbl_alumnos.NOMBRE, tbl_alumnos.A_PATERNO, tbl_alumnos.A_MATERNO FROM `tbl_asignaciongrupos`,tbl_alumnos,tbl_grupos WHERE tbl_asignaciongrupos.ID_GRUPO = tbl_grupos.ID_GRUPO AND tbl_asignaciongrupos.ID_ALUMNO = tbl_alumnos.ID_ALUMNO AND tbl_alumnos.EXISTE =1 AND tbl_asignaciongrupos.ID_GRUPO=".$_GET["grupo"]." ORDER BY tbl_alumnos.A_PATERNO";
$result = $conexion ->query($sql);
$sql ="SELECT NOMBRE_MATERIA FROM tbl_materias WHERE ID_MATERIA = {$_GET['materia']}";
$materia = mysqli_fetch_array($conexion -> query($sql));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/animate.min.css">
    <style>
        .title{
            text-align: center;
            margin: 15pt 0 15pt 0;
        }
        .nav-item.nav-link.active{
            background-color: gold;
            color: black;
        }
        #nombre{
            width: 600px;
        }
        #numero{
            width: 100px;
        }
    </style>
    <script>
        function verify() {
            if(confirm("¿Desea continuar la operación?")==true){
                return true;
            }else{
                return false;
            }
        }
    </script>
</head>
<body>
<div class="section-header">
        <h2 class="wow fadeInDown animated title">Lista de Alumnos</h2>
    </div>
    <form method="POST" action="subirCalificaciones.php" onsubmit="return verify()">
        <input type="hidden" name="periodo" value="<?php echo $_GET["periodo"]; ?>">
        <input type="hidden" name="grupo" value="<?php echo $_GET["grupo"]; ?>">
        <input type="hidden" name="materia" value="<?php echo $_GET["materia"]; ?>">
    <table class="table"><thead>
        <tr>
            <th>Materia: <?php echo $materia[0]; ?> </th>
            <th>Periodo: <?php echo $_GET["periodo"]; ?> </th>
        </tr>
    </thead></table>
    <table class="table table-striped">
        <thead>
            <tr>
                <th id="numero" scope="col">#</th>
                <th id="nombre" scope="col">Nombre</th>
                <th scope="col">Calificación</th>
            </tr>
        </thead>
        <tbody>
        <?php 
                            while($reg = mysqli_fetch_array($result)){
                                echo '  <tr>
                                <th scope="row">';echo $reg[0]; echo '<input type="hidden" value="'.$reg[0].'" name="idalumno-'.$reg[0].'"></th>
                                <td>';echo "$reg[1] $reg[2] $reg[3]";echo '</td>
                                <td>
                                    <div class="form-row">';
                                        $sql = "SELECT p".$_GET["periodo"]." FROM tbl_calificaciones WHERE ID_ALUMNO = $reg[0] AND ID_MATERIA = ".$_GET["materia"]." ";
                                        $result2 = $conexion -> query($sql);
                                        if(mysqli_num_rows($result2) > 0){
                                            $calif = mysqli_fetch_array($result2);
                                            if($calif[0] == 0){
                                                echo '<div class="col-3">
                                                    <input type="number"  maxlength="2" id="entero-'.$reg[0].'" name="entero-'.$reg[0].'" max="10" min="5"  class="form-control" value=5>
                                                </div>
                                                <label>.</label>
                                                <div class="col-3">
                                                    <input type="number"  maxlength="1" id="decimal-'.$reg[0].'" name="decimal-'.$reg[0].'" max="9" min="0"  class="form-control" value=0>
                                                </div>';
                                            }else{
                                                if(strlen($calif[0]) > 2 ){
                                                    echo '<div class="col-3">
                                                    <input type="number"  maxlength="2" id="entero-'.$reg[0].'" name="entero-'.$reg[0].'" max="10" min="5"  class="form-control" value=';echo substr($calif[0],0,1);echo '>
                                                </div>
                                                <label>.</label>
                                                <div class="col-3">
                                                    <input type="number"  maxlength="1" id="decimal-'.$reg[0].'" name="decimal-'.$reg[0].'" max="9" min="0"  class="form-control" value='; echo substr($calif[0],2); echo'>
                                                </div>';
                                                }elseif(strlen($calif[0])  < 3){
                                                    echo '<div class="col-3">
                                                    <input type="number"  maxlength="2" id="entero-'.$reg[0].'" name="entero-'.$reg[0].'" max="10" min="5"  class="form-control" value='.$calif[0].'>
                                                </div>
                                                <label>.</label>
                                                <div class="col-3">
                                                    <input type="number"  maxlength="1" id="decimal-'.$reg[0].'" name="decimal-'.$reg[0].'" max="9" min="0"  class="form-control" value=0>
                                                </div>';
                                                }
                                            }
                                        }else{
                                            echo '<div class="col-3">
                                                    <input type="number"  maxlength="2" id="entero-'.$reg[0].'" name="entero-'.$reg[0].'" max="10" min="5"  class="form-control" value=5>
                                                </div>
                                                <label>.</label>
                                                <div class="col-3">
                                                    <input type="number"  maxlength="1" id="decimal-'.$reg[0].'" name="decimal-'.$reg[0].'" max="9" min="0"  class="form-control" value=0>
                                                </div>';
                                        }
                                    echo '</div>
                                </td>
                                </tr>';
                            }
                        ?>
        </tbody>
    </table>
    <div class="form-row">
                <div class="col">
                    <button type="submit" id="submit" name="send" class="btn btn-primary btn-lg btn-block" style="border-radius: 5pt; margin-top: 20px;">Guardar Calificaciones</button>
                </div>
                <div class="col">
                    <button id="cancel" name="cancel" class="btn btn-danger btn-lg btn-block" type="button" onclick="window.location.href='index.php';" style="border-radius: 5pt; margin-top: 20px;">Cancelar</button>
                </div>
            </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>  
</body>
</html>