<?php 
    session_start();
    include "../conexion.php";
    $sqlgenerales="SELECT ID_AVISO, TITULO_AVISO, DESCRIPCION_AVISO, FECHA_INICIAL, FECHA_FINAL, tbl_administradores.NOMBRE FROM tbl_avisosgenerales,tbl_administradores WHERE tbl_avisosgenerales.ID_ADMIN = tbl_administradores.ID_ADMIN AND tbl_avisosgenerales.EXISTE=1 ORDER BY FECHA_INICIAL DESC";
    $sqlnivel ="SELECT ID_AVISO, TITULO_AVISO, DESCRIPCION_AVISO, FECHA_INICIAL, FECHA_FINAL,tbl_administradores.NOMBRE, NIVEL FROM tbl_avisos_nivel, tbl_administradores WHERE tbl_avisos_nivel.ID_ADMIN = tbl_administradores.ID_ADMIN AND tbl_avisos_nivel.EXISTE=1 ORDER BY FECHA_INICIAL DESC";
    $sqlgrupo="SELECT ID_AVISO, TITULO_AVISO, DESCRIPCION_AVISO, FECHA_INICIAL, FECHA_FINAL,tbl_administradores.NOMBRE, tbl_grupos.GRADO, tbl_grupos.NOMBRE, tbl_grupos.NIVEL FROM tbl_avisos_grupo, tbl_administradores,tbl_grupos WHERE tbl_avisos_grupo.ID_ADMIN = tbl_administradores.ID_ADMIN AND tbl_avisos_grupo.ID_GRUPO = tbl_grupos.ID_GRUPO AND tbl_avisos_grupo.EXISTE=1 ORDER BY FECHA_INICIAL DESC";
    $sqlalumno="SELECT ID_AVISO, TITULO_AVISO, DESCRIPCION_AVISO, FECHA_INICIAL, FECHA_FINAL,tbl_administradores.NOMBRE, tbl_alumnos.NOMBRE,tbl_alumnos.A_PATERNO FROM tbl_avisos_alumno, tbl_administradores,tbl_alumnos WHERE tbl_avisos_alumno.ID_ADMIN = tbl_administradores.ID_ADMIN AND tbl_avisos_alumno.ID_ALUMNO= tbl_alumnos.ID_ALUMNO AND tbl_avisos_alumno.EXISTE=1 ORDER BY FECHA_INICIAL DESC";
    $tildes = $conexion->query("SET NAMES 'utf8'");
    $resultg = mysqli_query($conexion,$sqlgenerales);
    $resultn = mysqli_query($conexion,$sqlnivel);
    $resultgr = mysqli_query($conexion,$sqlgrupo);
    $resultal = mysqli_query($conexion,$sqlalumno);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/animate.min.css">
    <style>
        @charset "UTF-8";
        .title{
            text-align: center;
            margin: 15pt 0 0 0;
        }
        .nav-item.nav-link.active{
            background-color: gold;
            color: black;
        }
        #contenido{
            width: 700px;
            text-align: justify;
        }
        #titulo{
            width: 100px;
        }
    </style>
    <script>
        function eliminar(p1,p2,p3) {
            if(confirm("¿Realmente quieres eliminar el aviso con titulo '"+p2+"'?")===true){
                window.location.href="mod_prod2.php?id="+p1+"&ref=del&tipo="+p3;
            }
        }
    </script>
</head>
<body>
    <div class="section-header">
        <h2 class="wow fadeInDown animated title">Panel General de Avisos Publicados</h2>
    </div>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-general-tab" data-toggle="tab" href="#nav-general" role="tab" aria-controls="nav-general" aria-selected="true">Generales</a>
            <a class="nav-item nav-link" id="nav-nivel-tab" data-toggle="tab" href="#nav-nivel" role="tab" aria-controls="nav-nivel" aria-selected="false">De Nivel</a>
            <a class="nav-item nav-link" id="nav-grupo-tab" data-toggle="tab" href="#nav-grupo" role="tab" aria-controls="nav-grupo" aria-selected="false">Para Grupo</a>
            <a class="nav-item nav-link" id="nav-alumno-tab" data-toggle="tab" href="#nav-alumno" role="tab" aria-controls="nav-alumno" aria-selected="false">Para Alumno</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th id="titulo">Titulo</th>
                        <th id="contenido">Contenido</th>
                        <th scope="col">Emitido por</th>
                        <th scope="col">Fecha de suceso</th>
                        <th scope="col"><a href="formAviso.php"><button type="button" class="btn btn-success">Nuevo Aviso</button></a></th>

                    </tr>
                </thead>
                <tbody>
                    <?php 
                        while ($reg = mysqli_fetch_array($resultg)){
                            echo '  <tr>
                                        <th scope="row">';echo $reg[0];echo '</th>
                                        <td>';echo $reg[1]; echo '</td>
                                        <td id = "contenido" data-toggle="tooltip" title="Aviso publicado el: '.$reg[3].'">'; echo nl2br($reg[2]);echo '</td>
                                        <td>';echo $reg[5]; echo '</td>
                                        <td>';echo date_format(date_create($reg[4]),"d/M/Y"); echo '</td>
                                        <td><a href="mod_prod2.php?id='.$reg[0].'&ref=resend&type=1"><button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Reenviar Aviso"><img src="./icons/resend.png" width="16px" heigth="16px"></button></a> <a href="modAviso.php?id='.$reg[0].'&type=1"><button type="button" class="btn btn-warning btn-sm" data-toggle="tooltip"  title="Modificar Aviso"><img src="./icons/edit.ico" width="16px" heigth="16px"></button></a> <button type="button" class="btn btn-danger btn-sm" onclick="eliminar(';echo "$reg[0], '{$reg[1]}'";echo ',1)" data-toggle="tooltip"  title="Eliminar Aviso"><img src="./icons/delete.png" width="16px" heigth="16px"></button></td>
                                    </tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="nav-nivel" role="tabpanel" aria-labelledby="nav-nivel-tab">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th id="titulo">Titulo</th>
                        <th id = 'contenido'>Contenido</th>
                        <th scope="col">Emitido por</th>
                        <th scope="col">Dirigido a</th>
                        <th scope="col">Fecha de suceso</th>
                        <th scope="col"><a href="formAviso.php"><button type="button" class="btn btn-success">Nuevo Aviso</button></a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        while ($reg = mysqli_fetch_array($resultn)){
                            echo '  <tr>
                                        <th scope="row">'.$reg[0].'</th>
                                        <td>'.$reg[1].'</td>
                                        <td data-toggle="tooltip"  title="Aviso publicado el: '.$reg[3].'" id = "contenido">'.nl2br($reg[2]).'</td>
                                        <td>'.$reg[5].'</td>
                                        <td>'; if($reg[6]==1){echo "Preescolar";}else{echo "Primaria";} echo '</td>
                                        <td>'.date_format(date_create($reg[4]),"d/M/Y").'</td>
                                        <td><a href="mod_prod2.php?id='.$reg[0].'&ref=resend&type=2"><button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Reenviar Aviso"><img src="./icons/resend.png" width="16px" heigth="16px"></button></a> <a href="modAviso.php?id='.$reg[0].'&type=2" ><button type="button" class="btn btn-warning btn-sm" data-toggle="tooltip"  title="Modificar Aviso"><img src="./icons/edit.ico" width="16px" heigth="16px"></button></a> <button type="button" class="btn btn-danger btn-sm" onclick="eliminar(';echo "$reg[0], '{$reg[1]}'";echo ',2)" data-toggle="tooltip"  title="Eliminar Aviso"><img src="./icons/delete.png" width="16px" heigth="16px"></button></td>
                                    </tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="nav-grupo" role="tabpanel" aria-labelledby="nav-grupo-tab">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th id="titulo">Titulo</th>
                        <th id = 'contenido'>Contenido</th>
                        <th scope="col">Emitido por</th>
                        <th scope="col">Dirigido a</th>
                        <th scope="col">Fecha de suceso</th>
                        <th scope="col"><a href="formAviso.php"><button type="button" class="btn btn-success">Nuevo Aviso</button></a></th>

                    </tr>
                </thead>
                <tbody>
                    <?php 
                        while($reg = mysqli_fetch_array($resultgr)){
                            echo '  <tr>
                                        <th scope="row">'.$reg[0].'</th>
                                        <td>'.$reg[1].'</td>
                                        <td data-toggle="tooltip"  title="Aviso publicado el: '.$reg[3].'" id = "contenido">'.nl2br($reg[2]).'</td>
                                        <td>'.$reg[5].'</td>
                                        <td>'.$reg[6].'°'.$reg[7].' "';if($reg[8]==1){echo "Preescolar";}else{echo "Primaria";} echo '</td>
                                        <td>'.date_format(date_create($reg[4]),"d/M/Y").'</td>
                                        <td><a href="mod_prod2.php?id='.$reg[0].'&ref=resend&type=3"><button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Reenviar Aviso"><img src="./icons/resend.png" width="16px" heigth="16px"></button></a> <a href="modAviso.php?id='.$reg[0].'&type=3" ><button type="button" class="btn btn-warning btn-sm" data-toggle="tooltip"  title="Modificar Aviso"><img src="./icons/edit.ico" width="16px" heigth="16px"></button></a> <button type="button" class="btn btn-danger btn-sm" onclick="eliminar(';echo "$reg[0], '{$reg[1]}'";echo ',3)" data-toggle="tooltip"  title="Eliminar Aviso"><img src="./icons/delete.png" width="16px" heigth="16px"></button></td>
                                    </tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="nav-alumno" role="tabpanel" aria-labelledby="nav-alumno-tab">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th id="titulo">Titulo</th>
                        <th id = 'contenido'>Contenido</th>
                        <th scope="col">Emitido por</th>
                        <th scope="col">Dirigido a</th>
                        <th scope="col">Fecha de suceso</th>
                        <th scope="col"><a href="formAviso.php"><button type="button" class="btn btn-success">Nuevo Aviso</button></a></th>

                    </tr>
                </thead>
                <tbody>
                    <?php 
                        while ($reg = mysqli_fetch_array($resultal)){
                            echo '  <tr>
                                        <th scope="row">'.$reg[0].'</th>
                                        <td>'.$reg[1].'</td>
                                        <td data-toggle="tooltip"  title="Aviso publicado el: '.$reg[3].'" id = "contenido">'.nl2br($reg[2]).'</td>
                                        <td>'.$reg[5].'</td>
                                        <td>'.$reg[6].' '.$reg[7].'</td>
                                        <td>'.date_format(date_create($reg[4]),"d/M/Y").'</td>
                                        <td><a href="mod_prod2.php?id='.$reg[0].'&ref=resend&type=4"><button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Reenviar Aviso"><img src="./icons/resend.png" width="16px" heigth="16px"></button></a> <a href="modAviso.php?id='.$reg[0].'&type=4" ><button type="button" class="btn btn-warning btn-sm" data-toggle="tooltip"  title="Modificar Aviso"><img src="./icons/edit.ico" width="16px" heigth="16px"></button></a> <button type="button" class="btn btn-danger btn-sm" onclick="eliminar(';echo "$reg[0], '{$reg[1]}'";echo ',4)" data-toggle="tooltip"  title="Eliminar Aviso"><img src="./icons/delete.png" width="16px" heigth="16px"></button>   
                                        </td>
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