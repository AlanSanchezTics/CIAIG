<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/animate.min.css">
    <style>
        .title{
            text-align: center;
            margin: 15pt 0 0 0;
        }
        .nav-item.nav-link.active{
            background-color: gold;
            color: black;
        }
    </style>
</head>
<body>
    <div class="section-header">
        <h2 class="wow fadeInDown animated title">Panel de grupos</h2>
    </div>
    <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <?php
                session_start();
                include "../../conexion.php";

                $sql = "SELECT ID_GRUPO, GRADO,NOMBRE, NIVEL FROM tbl_grupos WHERE ID_DOCENTE_E =".$_SESSION['IDUSER']."  OR ID_DOCENTE_I = ".$_SESSION['IDUSER']." AND EXISTE = 1";
                $result = $conexion -> query($sql);
                while ($row = mysqli_fetch_array($result)){
                    $grupos[] = $row;
                }
                $max = sizeof($grupos);
                for ($i=0; $i < $max; $i++) { 
                    $array_grupo = $grupos[$i];
                    if($i==0){
                        echo '<a class="nav-item nav-link active" id="nav-'.$array_grupo[0].'-tab" data-toggle="tab" href="#nav-'.$array_grupo[0].'" role="tab" aria-controls="nav-'.$array_grupo[0].'" aria-selected="true">'.$array_grupo[1].'°'.$array_grupo[2].' '; if($array_grupo[3]=="2"){echo "Primaria";}else{echo "Preescolar";} echo '</a>';
                    }else{
                        echo '<a class="nav-item nav-link" id="nav-'.$array_grupo[0].'-tab" data-toggle="tab" href="#nav-'.$array_grupo[0].'" role="tab" aria-controls="nav-'.$array_grupo[0].'" aria-selected="false">'.$array_grupo[1].'°'.$array_grupo[2].' '; if($array_grupo[3]=="2"){echo "Primaria";}else{echo "Preescolar";} echo '</a>';
                    }
                }
            ?>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
          <?php
            for ($i=0; $i < $max; $i++) { 
                $array_grupo = $grupos[$i];
                echo '  <div class="tab-pane fade';if($i==0){echo "show active";} echo'" id="nav-'.$array_grupo[0].'" role="tabpanel" aria-labelledby="nav-'.$array_grupo[0].'-tab">
                            <table class="table table-striped">
                                <thead>
                                    <tr>';
                                    $sqldoce = "SELECT tbl_docentes.NOMBRE, tbl_docentes.A_PATERNO, tbl_docentes.A_MATERNO FROM `tbl_grupos`,tbl_docentes WHERE tbl_grupos.ID_DOCENTE_E = tbl_docentes.ID_DOCENTE AND tbl_grupos.ID_GRUPO = $array_grupo[0]";
                                    $sqldoci = "SELECT tbl_docentes.NOMBRE, tbl_docentes.A_PATERNO, tbl_docentes.A_MATERNO FROM `tbl_grupos`,tbl_docentes WHERE tbl_grupos.ID_DOCENTE_I = tbl_docentes.ID_DOCENTE AND tbl_grupos.ID_GRUPO = $array_grupo[0]";
                                    $resultdoce=mysqli_query($conexion,$sqldoce);
                                    $resultdoci=mysqli_query($conexion,$sqldoci);
                                    if($reg=mysqli_fetch_array($resultdoce)){
                                        echo "<th colspan=4><span>Maestro: $reg[0] $reg[1] $reg[2]</span></th>";
                                    }
                                    if($reg=mysqli_fetch_array($resultdoci)){
                                        echo "<th colspan=4><span>Teacher: $reg[0] $reg[1] $reg[2]</span></th>";
                                    } 
                              echo '</tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="col">No. Control</th>
                                        <th scope="col">Nombre(s)</th>
                                        <th scope="col">Apellido Paterno</th>
                                        <th scope="col">Apellido Materno</th>
                                        <th scope="col">Telefono</th>
                                        <th scope="col">Correro</th>
                                    </tr>';
                                        $sql = "SELECT tbl_alumnos.ID_ALUMNO,tbl_alumnos.NOMBRE, tbl_alumnos.A_PATERNO, tbl_alumnos.A_MATERNO, tbl_alumnos.TEL, tbl_alumnos.EMAIL FROM `tbl_asignaciongrupos`,tbl_alumnos,tbl_grupos WHERE tbl_asignaciongrupos.ID_GRUPO = tbl_grupos.ID_GRUPO AND tbl_asignaciongrupos.ID_ALUMNO = tbl_alumnos.ID_ALUMNO AND tbl_alumnos.EXISTE =1 AND tbl_asignaciongrupos.ID_GRUPO=".$array_grupo[0]." ORDER BY tbl_alumnos.A_PATERNO";
                                        $result = $conexion -> query($sql);
                                        while($reg = mysqli_fetch_array($result)){
                                            echo '  <tr>
                                            <th scope="row">';echo $reg[0]; echo '</th>
                                            <td>';echo $reg[1];echo '</td>
                                            <td>';echo $reg[2];echo '</td>
                                            <td>';echo $reg[3];echo '</td>
                                            <td>';echo $reg[4];echo '</td>
                                            <td>';echo $reg[5];echo '</td>
                                        </tr>';
                                        }
                            echo '</tbody>
                            </table>
                        </div>';
            }
          ?>
          </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>