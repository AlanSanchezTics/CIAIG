<?php 
    session_start();
    include "../../conexion.php";
    
    $sql1="SELECT tbl_alumnos.ID_ALUMNO,tbl_alumnos.NOMBRE, tbl_alumnos.A_PATERNO, tbl_alumnos.A_MATERNO, tbl_alumnos.TEL, tbl_alumnos.EMAIL, tbl_usuarios.LOGIN, tbl_usuarios.ID_USUARIO FROM `tbl_asignaciongrupos`,tbl_alumnos,tbl_grupos, tbl_usuarios WHERE tbl_alumnos.ID_USUARIO=tbl_usuarios.ID_USUARIO AND tbl_asignaciongrupos.ID_GRUPO = tbl_grupos.ID_GRUPO AND tbl_asignaciongrupos.ID_ALUMNO = tbl_alumnos.ID_ALUMNO AND tbl_grupos.NIVEL=2 AND tbl_grupos.GRADO = 1 AND tbl_grupos.NOMBRE='A' AND tbl_alumnos.EXISTE =1 ORDER BY tbl_alumnos.A_PATERNO";
    $sql2="SELECT tbl_alumnos.ID_ALUMNO,tbl_alumnos.NOMBRE, tbl_alumnos.A_PATERNO, tbl_alumnos.A_MATERNO, tbl_alumnos.TEL, tbl_alumnos.EMAIL, tbl_usuarios.LOGIN, tbl_usuarios.ID_USUARIO FROM `tbl_asignaciongrupos`,tbl_alumnos,tbl_grupos, tbl_usuarios WHERE tbl_alumnos.ID_USUARIO=tbl_usuarios.ID_USUARIO AND tbl_asignaciongrupos.ID_GRUPO = tbl_grupos.ID_GRUPO AND tbl_asignaciongrupos.ID_ALUMNO = tbl_alumnos.ID_ALUMNO AND tbl_grupos.NIVEL=2 AND tbl_grupos.GRADO = 2 AND tbl_grupos.NOMBRE='A' AND tbl_alumnos.EXISTE =1 ORDER BY tbl_alumnos.A_PATERNO";
    $sql3="SELECT tbl_alumnos.ID_ALUMNO,tbl_alumnos.NOMBRE, tbl_alumnos.A_PATERNO, tbl_alumnos.A_MATERNO, tbl_alumnos.TEL, tbl_alumnos.EMAIL, tbl_usuarios.LOGIN, tbl_usuarios.ID_USUARIO FROM `tbl_asignaciongrupos`,tbl_alumnos,tbl_grupos, tbl_usuarios WHERE tbl_alumnos.ID_USUARIO=tbl_usuarios.ID_USUARIO AND tbl_asignaciongrupos.ID_GRUPO = tbl_grupos.ID_GRUPO AND tbl_asignaciongrupos.ID_ALUMNO = tbl_alumnos.ID_ALUMNO AND tbl_grupos.NIVEL=2 AND tbl_grupos.GRADO = 3 AND tbl_grupos.NOMBRE='A' AND tbl_alumnos.EXISTE =1 ORDER BY tbl_alumnos.A_PATERNO";
    $sql4="SELECT tbl_alumnos.ID_ALUMNO,tbl_alumnos.NOMBRE, tbl_alumnos.A_PATERNO, tbl_alumnos.A_MATERNO, tbl_alumnos.TEL, tbl_alumnos.EMAIL, tbl_usuarios.LOGIN, tbl_usuarios.ID_USUARIO FROM `tbl_asignaciongrupos`,tbl_alumnos,tbl_grupos, tbl_usuarios WHERE tbl_alumnos.ID_USUARIO=tbl_usuarios.ID_USUARIO AND tbl_asignaciongrupos.ID_GRUPO = tbl_grupos.ID_GRUPO AND tbl_asignaciongrupos.ID_ALUMNO = tbl_alumnos.ID_ALUMNO AND tbl_grupos.NIVEL=2 AND tbl_grupos.GRADO = 4 AND tbl_grupos.NOMBRE='A' AND tbl_alumnos.EXISTE =1 ORDER BY tbl_alumnos.A_PATERNO";
    $sql5="SELECT tbl_alumnos.ID_ALUMNO,tbl_alumnos.NOMBRE, tbl_alumnos.A_PATERNO, tbl_alumnos.A_MATERNO, tbl_alumnos.TEL, tbl_alumnos.EMAIL, tbl_usuarios.LOGIN, tbl_usuarios.ID_USUARIO FROM `tbl_asignaciongrupos`,tbl_alumnos,tbl_grupos, tbl_usuarios WHERE tbl_alumnos.ID_USUARIO=tbl_usuarios.ID_USUARIO AND tbl_asignaciongrupos.ID_GRUPO = tbl_grupos.ID_GRUPO AND tbl_asignaciongrupos.ID_ALUMNO = tbl_alumnos.ID_ALUMNO AND tbl_grupos.NIVEL=2 AND tbl_grupos.GRADO = 5 AND tbl_grupos.NOMBRE='A' AND tbl_alumnos.EXISTE =1 ORDER BY tbl_alumnos.A_PATERNO";
    $sql6="SELECT tbl_alumnos.ID_ALUMNO,tbl_alumnos.NOMBRE, tbl_alumnos.A_PATERNO, tbl_alumnos.A_MATERNO, tbl_alumnos.TEL, tbl_alumnos.EMAIL, tbl_usuarios.LOGIN, tbl_usuarios.ID_USUARIO FROM `tbl_asignaciongrupos`,tbl_alumnos,tbl_grupos, tbl_usuarios WHERE tbl_alumnos.ID_USUARIO=tbl_usuarios.ID_USUARIO AND tbl_asignaciongrupos.ID_GRUPO = tbl_grupos.ID_GRUPO AND tbl_asignaciongrupos.ID_ALUMNO = tbl_alumnos.ID_ALUMNO AND tbl_grupos.NIVEL=2 AND tbl_grupos.GRADO = 6 AND tbl_grupos.NOMBRE='A' AND tbl_alumnos.EXISTE =1 ORDER BY tbl_alumnos.A_PATERNO";
    $tildes = $conexion->query("SET NAMES 'utf8'");
    $result1 = mysqli_query($conexion,$sql1);
    $result2 = mysqli_query($conexion,$sql2);
    $result3 = mysqli_query($conexion,$sql3);
    $result4 = mysqli_query($conexion,$sql4);
    $result5 = mysqli_query($conexion,$sql5);
    $result6 = mysqli_query($conexion,$sql6);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/animate.min.css">
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
    <script>
        function eliminar(p1,p2,p3,p4) {
            if(confirm("¿Realmente quieres eliminar los datos del Alumno "+p3+"?")===true){
                window.location.href="modif_prod2.php?no="+p1+"&id="+p2+"&ref=del&nivel="+p4;
            }
        }
    </script>
</head>
<body>
    <div class="section-header">
        <h2 class="wow fadeInDown animated title">Primaria Indira Gandhi</h2>
    </div>
    <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="nav-1-tab" data-toggle="tab" href="#nav-1" role="tab" aria-controls="nav-1" aria-selected="true">1°A</a>
              <a class="nav-item nav-link" id="nav-2-tab" data-toggle="tab" href="#nav-2" role="tab" aria-controls="nav-2" aria-selected="false">2°A</a>
              <a class="nav-item nav-link" id="nav-3-tab" data-toggle="tab" href="#nav-3" role="tab" aria-controls="nav-3" aria-selected="false">3°A</a>
              <a class="nav-item nav-link" id="nav-4-tab" data-toggle="tab" href="#nav-4" role="tab" aria-controls="nav-4" aria-selected="false">4°A</a>
              <a class="nav-item nav-link" id="nav-5-tab" data-toggle="tab" href="#nav-5" role="tab" aria-controls="nav-5" aria-selected="false">5°A</a>
              <a class="nav-item nav-link" id="nav-6-tab" data-toggle="tab" href="#nav-6" role="tab" aria-controls="nav-6" aria-selected="false">6°A</a>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-1" role="tabpanel" aria-labelledby="nav-1-tab">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <?php 
                                $sqldoce = "SELECT tbl_docentes.NOMBRE, tbl_docentes.A_PATERNO, tbl_docentes.A_MATERNO FROM `tbl_grupos`,tbl_docentes WHERE tbl_grupos.ID_DOCENTE_E = tbl_docentes.ID_DOCENTE AND NIVEL=2 AND GRADO= 1 AND tbl_grupos.NOMBRE='A'";
                                $sqldoci = "SELECT tbl_docentes.NOMBRE, tbl_docentes.A_PATERNO, tbl_docentes.A_MATERNO FROM `tbl_grupos`,tbl_docentes WHERE tbl_grupos.ID_DOCENTE_I = tbl_docentes.ID_DOCENTE AND NIVEL=2 AND GRADO= 1 AND tbl_grupos.NOMBRE='A'";
                                $resultdoce=mysqli_query($conexion,$sqldoce);
                                $resultdoci=mysqli_query($conexion,$sqldoci);
                                if($reg=mysqli_fetch_array($resultdoce)){
                                    echo "<th colspan=4><span>Maestro: $reg[0] $reg[1] $reg[2]</span></th>";
                                }
                                if($reg=mysqli_fetch_array($resultdoci)){
                                    echo "<th colspan=4><span>Teacher: $reg[0] $reg[1] $reg[2]</span></th>";
                                }
                            ?>
                        </tr>
                        <tr>
                            <th scope="col">No. Control</th>
                            <th scope="col">Nombre(s)</th>
                            <th scope="col">Apellido Paterno</th>
                            <th scope="col">Apellido Materno</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Correro</th>
                            <th scope="col">Usuario</th>
                            <th colspan="2" scope="col"><button type="button" class="btn btn-success" onclick="window.location.href='formAlumno.php';">Registrar Alumno</button></th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php 
                            while($reg = mysqli_fetch_array($result1)){
                                echo '  <tr>
                                <th scope="row">';echo $reg[0]; echo '</th>
                                <td>';echo $reg[1];echo '</td>
                                <td>';echo $reg[2];echo '</td>
                                <td>';echo $reg[3];echo '</td>
                                <td>';echo $reg[4];echo '</td>
                                <td>';echo $reg[5];echo '</td>
                                <td>';echo $reg[6];echo '</td>
                                <td><button type="button" onclick="window.location.href='."'".'modAlumno.php?no='.$reg[0]."'".'" class="btn btn-primary btn-sm">Modificar</button></td>
                                <td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(';echo "$reg[0],{$reg[7]},'{$reg[1]}', 2";echo ')">Eliminar</button></td>
                            </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-2" role="tabpanel" aria-labelledby="nav-2-tab">
            <table class="table table-striped">
                    <thead>
                        <tr>
                            <?php 
                                $sqldoce = "SELECT tbl_docentes.NOMBRE, tbl_docentes.A_PATERNO, tbl_docentes.A_MATERNO FROM `tbl_grupos`,tbl_docentes WHERE tbl_grupos.ID_DOCENTE_E = tbl_docentes.ID_DOCENTE AND NIVEL=2 AND GRADO=2 AND tbl_grupos.NOMBRE='A'";
                                $sqldoci = "SELECT tbl_docentes.NOMBRE, tbl_docentes.A_PATERNO, tbl_docentes.A_MATERNO FROM `tbl_grupos`,tbl_docentes WHERE tbl_grupos.ID_DOCENTE_I = tbl_docentes.ID_DOCENTE AND NIVEL=2 AND GRADO=2 AND tbl_grupos.NOMBRE='A'";
                                $resultdoce=mysqli_query($conexion,$sqldoce);
                                $resultdoci=mysqli_query($conexion,$sqldoci);
                                if($reg=mysqli_fetch_array($resultdoce)){
                                    echo "<th colspan=4><span>Maestro: $reg[0] $reg[1] $reg[2]</span></th>";
                                }
                                if($reg=mysqli_fetch_array($resultdoci)){
                                    echo "<th colspan=4><span>Teacher: $reg[0] $reg[1] $reg[2]</span></th>";
                                }
                            ?>
                        </tr>
                        <tr>
                            <th scope="col">No. Control</th>
                            <th scope="col">Nombre(s)</th>
                            <th scope="col">Apellido Paterno</th>
                            <th scope="col">Apellido Materno</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Correro</th>
                            <th scope="col">Usuario</th>
                            <th colspan="2"scope="col"><button type="button" class="btn btn-success" onclick="window.location.href='formAlumno.php';">Registrar Alumno</button></th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php 
                            while($reg = mysqli_fetch_array($result2)){
                                echo '  <tr>
                                <th scope="row">';echo $reg[0]; echo '</th>
                                <td>';echo $reg[1];echo '</td>
                                <td>';echo $reg[2];echo '</td>
                                <td>';echo $reg[3];echo '</td>
                                <td>';echo $reg[4];echo '</td>
                                <td>';echo $reg[5];echo '</td>
                                <td>';echo $reg[6];echo '</td>
                                <td><button type="button" onclick="window.location.href='."'".'modAlumno.php?no='.$reg[0]."'".'" class="btn btn-primary btn-sm">Modificar</button></td>
                                <td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(';echo "$reg[0],{$reg[7]},'{$reg[1]}', 2";echo ')">Eliminar</button></td>
                            </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-3" role="tabpanel" aria-labelledby="nav-3-tab">
            <table class="table table-striped">
                    <thead>
                        <tr>
                            <?php 
                                $sqldoce = "SELECT tbl_docentes.NOMBRE, tbl_docentes.A_PATERNO, tbl_docentes.A_MATERNO FROM `tbl_grupos`,tbl_docentes WHERE tbl_grupos.ID_DOCENTE_E = tbl_docentes.ID_DOCENTE AND NIVEL=2 AND GRADO= 3 AND tbl_grupos.NOMBRE='A'";
                                $sqldoci = "SELECT tbl_docentes.NOMBRE, tbl_docentes.A_PATERNO, tbl_docentes.A_MATERNO FROM `tbl_grupos`,tbl_docentes WHERE tbl_grupos.ID_DOCENTE_I = tbl_docentes.ID_DOCENTE AND NIVEL=2 AND GRADO= 3 AND tbl_grupos.NOMBRE='A'";
                                $resultdoce=mysqli_query($conexion,$sqldoce);
                                $resultdoci=mysqli_query($conexion,$sqldoci);
                                if($reg=mysqli_fetch_array($resultdoce)){
                                    echo "<th colspan=4><span>Maestro: $reg[0] $reg[1] $reg[2]</span></th>";
                                }
                                if($reg=mysqli_fetch_array($resultdoci)){
                                    echo "<th colspan=4><span>Teacher: $reg[0] $reg[1] $reg[2]</span></th>";
                                }
                            ?>
                        </tr>
                        <tr>
                            <th scope="col">No. Control</th>
                            <th scope="col">Nombre(s)</th>
                            <th scope="col">Apellido Paterno</th>
                            <th scope="col">Apellido Materno</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Correro</th>
                            <th scope="col">Usuario</th>
                            <th colspan="2"scope="col"><button type="button" class="btn btn-success" onclick="window.location.href='formAlumno.php';">Registrar Alumno</button></th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php 
                            while($reg = mysqli_fetch_array($result3)){
                                echo '  <tr>
                                <th scope="row">';echo $reg[0]; echo '</th>
                                <td>';echo $reg[1];echo '</td>
                                <td>';echo $reg[2];echo '</td>
                                <td>';echo $reg[3];echo '</td>
                                <td>';echo $reg[4];echo '</td>
                                <td>';echo $reg[5];echo '</td>
                                <td>';echo $reg[6];echo '</td>
                                <td><button type="button" onclick="window.location.href='."'".'modAlumno.php?no='.$reg[0]."'".'" class="btn btn-primary btn-sm">Modificar</button></td>
                                <td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(';echo "$reg[0],{$reg[7]},'{$reg[1]}', 2";echo ')">Eliminar</button></td>
                            </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-4" role="tabpanel" aria-labelledby="nav-4-tab">
            <table class="table table-striped">
                    <thead>
                        <tr>
                            <?php 
                                $sqldoce = "SELECT tbl_docentes.NOMBRE, tbl_docentes.A_PATERNO, tbl_docentes.A_MATERNO FROM `tbl_grupos`,tbl_docentes WHERE tbl_grupos.ID_DOCENTE_E = tbl_docentes.ID_DOCENTE AND NIVEL=2 AND GRADO= 4 AND tbl_grupos.NOMBRE='A'";
                                $sqldoci = "SELECT tbl_docentes.NOMBRE, tbl_docentes.A_PATERNO, tbl_docentes.A_MATERNO FROM `tbl_grupos`,tbl_docentes WHERE tbl_grupos.ID_DOCENTE_I = tbl_docentes.ID_DOCENTE AND NIVEL=2 AND GRADO= 4 AND tbl_grupos.NOMBRE='A'";
                                $resultdoce=mysqli_query($conexion,$sqldoce);
                                $resultdoci=mysqli_query($conexion,$sqldoci);
                                if($reg=mysqli_fetch_array($resultdoce)){
                                    echo "<th colspan=4><span>Maestro: $reg[0] $reg[1] $reg[2]</span></th>";
                                }
                                if($reg=mysqli_fetch_array($resultdoci)){
                                    echo "<th colspan=4><span>Teacher: $reg[0] $reg[1] $reg[2]</span></th>";
                                }
                            ?>
                        </tr>
                        <tr>
                            <th scope="col">No. Control</th>
                            <th scope="col">Nombre(s)</th>
                            <th scope="col">Apellido Paterno</th>
                            <th scope="col">Apellido Materno</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Correro</th>
                            <th scope="col">Usuario</th>
                            <th colspan="2"scope="col"><button type="button" class="btn btn-success" onclick="window.location.href='formAlumno.php';">Registrar Alumno</button></th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php 
                            while($reg = mysqli_fetch_array($result4)){
                                echo '  <tr>
                                <th scope="row">';echo $reg[0]; echo '</th>
                                <td>';echo $reg[1];echo '</td>
                                <td>';echo $reg[2];echo '</td>
                                <td>';echo $reg[3];echo '</td>
                                <td>';echo $reg[4];echo '</td>
                                <td>';echo $reg[5];echo '</td>
                                <td>';echo $reg[6];echo '</td>
                                <td><button type="button" onclick="window.location.href='."'".'modAlumno.php?no='.$reg[0]."'".'" class="btn btn-primary btn-sm">Modificar</button></td>
                                <td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(';echo "$reg[0],{$reg[7]},'{$reg[1]}', 2";echo ')">Eliminar</button></td>
                            </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-5" role="tabpanel" aria-labelledby="nav-5-tab">
            <table class="table table-striped">
                    <thead>
                    <tr>
                            <?php 
                                $sqldoce = "SELECT tbl_docentes.NOMBRE, tbl_docentes.A_PATERNO, tbl_docentes.A_MATERNO FROM `tbl_grupos`,tbl_docentes WHERE tbl_grupos.ID_DOCENTE_E = tbl_docentes.ID_DOCENTE AND NIVEL=2 AND GRADO= 5 AND tbl_grupos.NOMBRE='A'";
                                $sqldoci = "SELECT tbl_docentes.NOMBRE, tbl_docentes.A_PATERNO, tbl_docentes.A_MATERNO FROM `tbl_grupos`,tbl_docentes WHERE tbl_grupos.ID_DOCENTE_I = tbl_docentes.ID_DOCENTE AND NIVEL=2 AND GRADO= 5 AND tbl_grupos.NOMBRE='A'";
                                $resultdoce=mysqli_query($conexion,$sqldoce);
                                $resultdoci=mysqli_query($conexion,$sqldoci);
                                if($reg=mysqli_fetch_array($resultdoce)){
                                    echo "<th colspan=4><span>Maestro: $reg[0] $reg[1] $reg[2]</span></th>";
                                }
                                if($reg=mysqli_fetch_array($resultdoci)){
                                    echo "<th colspan=4><span>Teacher: $reg[0] $reg[1] $reg[2]</span></th>";
                                }
                            ?>
                        </tr>
                        <tr>
                            <th scope="col">No. Control</th>
                            <th scope="col">Nombre(s)</th>
                            <th scope="col">Apellido Paterno</th>
                            <th scope="col">Apellido Materno</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Correro</th>
                            <th scope="col">Usuario</th>
                            <th colspan="2"scope="col"><button type="button" class="btn btn-success" onclick="window.location.href='formAlumno.php';">Registrar Alumno</button></th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php 
                            while($reg = mysqli_fetch_array($result5)){
                                echo '  <tr>
                                <th scope="row">';echo $reg[0]; echo '</th>
                                <td>';echo $reg[1];echo '</td>
                                <td>';echo $reg[2];echo '</td>
                                <td>';echo $reg[3];echo '</td>
                                <td>';echo $reg[4];echo '</td>
                                <td>';echo $reg[5];echo '</td>
                                <td>';echo $reg[6];echo '</td>
                                <td><button type="button" onclick="window.location.href='."'".'modAlumno.php?no='.$reg[0]."'".'" class="btn btn-primary btn-sm">Modificar</button></td>
                                <td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(';echo "$reg[0],{$reg[7]},'{$reg[1]}', 2";echo ')">Eliminar</button></td>
                            </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-6" role="tabpanel" aria-labelledby="nav-6-tab">
            <table class="table table-striped">
                    <thead>
                        <tr>
                            <?php 
                                $sqldoce = "SELECT tbl_docentes.NOMBRE, tbl_docentes.A_PATERNO, tbl_docentes.A_MATERNO FROM `tbl_grupos`,tbl_docentes WHERE tbl_grupos.ID_DOCENTE_E = tbl_docentes.ID_DOCENTE AND NIVEL=2 AND GRADO= 6 AND tbl_grupos.NOMBRE='A'";
                                $sqldoci = "SELECT tbl_docentes.NOMBRE, tbl_docentes.A_PATERNO, tbl_docentes.A_MATERNO FROM `tbl_grupos`,tbl_docentes WHERE tbl_grupos.ID_DOCENTE_I = tbl_docentes.ID_DOCENTE AND NIVEL=2 AND GRADO= 6 AND tbl_grupos.NOMBRE='A'";
                                $resultdoce=mysqli_query($conexion,$sqldoce);
                                $resultdoci=mysqli_query($conexion,$sqldoci);
                                if($reg=mysqli_fetch_array($resultdoce)){
                                    echo "<th colspan=4><span>Maestro: $reg[0] $reg[1] $reg[2]</span></th>";
                                }
                                if($reg=mysqli_fetch_array($resultdoci)){
                                    echo "<th colspan=4><span>Teacher: $reg[0] $reg[1] $reg[2]</span></th>";
                                }
                            ?>
                        </tr>
                        <tr>
                            <th scope="col">No. Control</th>
                            <th scope="col">Nombre(s)</th>
                            <th scope="col">Apellido Paterno</th>
                            <th scope="col">Apellido Materno</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Correro</th>
                            <th scope="col">Usuario</th>
                            <th colspan="2"scope="col"><button type="button" class="btn btn-success" onclick="window.location.href='formAlumno.php';">Registrar Alumno</button></th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php 
                            while($reg = mysqli_fetch_array($result6)){
                                echo '  <tr>
                                <th scope="row">';echo $reg[0]; echo '</th>
                                <td>';echo $reg[1];echo '</td>
                                <td>';echo $reg[2];echo '</td>
                                <td>';echo $reg[3];echo '</td>
                                <td>';echo $reg[4];echo '</td>
                                <td>';echo $reg[5];echo '</td>
                                <td>';echo $reg[6];echo '</td>
                                <td><button type="button" onclick="window.location.href='."'".'modAlumno.php?no='.$reg[0]."'".'" class="btn btn-primary btn-sm">Modificar</button></td>
                                <td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(';echo "$reg[0],{$reg[7]},'{$reg[1]}', 2";echo ')">Eliminar</button></td>
                            </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
          </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>