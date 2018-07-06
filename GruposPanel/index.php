<?php 
    session_start();
    include "../conexion.php";
    $sqlpree = "SELECT tbl_grupos.id_grupo,tbl_grupos.nombre,tbl_grupos.grado,dce.a_paterno,dce.nombre,dci.a_paterno,dci.nombre FROM tbl_grupos
    INNER JOIN tbl_docentes dce on tbl_grupos.id_docente_E=dce.id_docente
    INNER JOIN tbl_docentes dci on tbl_grupos.id_docente_i=dci.id_docente AND tbl_grupos.existe=1 AND tbl_grupos.nivel=1 order by tbl_grupos.grado";

    $sqlpri = "SELECT tbl_grupos.id_grupo,tbl_grupos.nombre,tbl_grupos.grado,dce.a_paterno,dce.nombre,dci.a_paterno,dci.nombre FROM tbl_grupos
    INNER JOIN tbl_docentes dce on tbl_grupos.id_docente_E=dce.id_docente
    INNER JOIN tbl_docentes dci on tbl_grupos.id_docente_i=dci.id_docente AND tbl_grupos.existe=1 AND tbl_grupos.nivel=2 order by tbl_grupos.grado";
    $tildes = $conexion->query("SET NAMES 'utf8'");
    $resultpree = mysqli_query($conexion,$sqlpree);    
    $resultpri = mysqli_query($conexion,$sqlpri);
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
        function eliminar(p1,p2,p3) {
            if(confirm("¿Realmente quieres eliminar los datos del grupo "+p2+"°"+p3+"?")===true){
                window.location.href="mod_prod2.php?id="+p1+"&ref=del";
            }
        }
    </script>
</head>
<body>
    <div class="section-header">
        <h2 class="wow fadeInDown animated title">Panel General de Grupos</h2>
    </div>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-preescolar-tab" data-toggle="tab" href="#nav-preescolar" role="tab" aria-controls="nav-preescolar" aria-selected="true">Preescolar</a>
            <a class="nav-item nav-link" id="nav-primaria-tab" data-toggle="tab" href="#nav-primaria" role="tab" aria-controls="nav-primaria" aria-selected="false">Primaria</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-preescolar" role="tabpanel" aria-labelledby="nav-preescolar-tab">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Grupo</th>
                        <th scope="col">Maestro</th>
                        <th scope="col">Teacher</th>
                        <th scope="col"><button type="button" onclick="window.location.href='formGrupos.php'" class="btn btn-success">Registrar Grupo</button></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        while($reg = mysqli_fetch_array($resultpree)){
                            echo '  <tr>
                                        <th scope ="row">'; echo $reg[0]; echo '</th>
                                        <td>'; echo $reg[2];echo "°";echo $reg[1];echo '</td>
                                        <td>'; echo $reg[4];echo " ";echo $reg[3];echo '</td>
                                        <td>'; echo $reg[6];echo " ";echo $reg[5];echo '</td>
                                        <td><a href="modGrupo.php?no=';echo $reg[0];echo '"><button width=20px height=20px type="button" class="btn btn-primary btn-sm">Modificar</button></a>
                                        <button type="button" class="btn btn-danger btn-sm" onclick = "eliminar('; echo "$reg[0],{$reg[2]},'{$reg[1]}'";echo ')">Eliminar</button></td>
                                    </tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="nav-primaria" role="tabpanel" aria-labelledby="nav-primaria-tab">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Grupo</th>
                        <th scope="col">Maestro</th>
                        <th scope="col">Teacher</th>
                        <th scope="col"><button type="button" onclick="window.location.href='formGrupos.php'" class="btn btn-success">Registrar Grupo</button></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        while($reg = mysqli_fetch_array($resultpri)){
                            echo "  <tr>
                                        <th>$reg[0]</th>
                                        <td>$reg[2]°$reg[1]</td>
                                        <td>$reg[4] $reg[3]</td>
                                        <td>$reg[6] $reg[5]</td>
                                        <td><button type='button' class='btn btn-primary btn-sm'>Modificar</button>
                                        <button type='button' class='btn btn-danger btn-sm'>Eliminar</button></td>
                                    </tr>";
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