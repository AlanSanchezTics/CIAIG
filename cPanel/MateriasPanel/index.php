<?php header('Content-Type: text/html; charset=UTF-8'); ?>
<?php
    include "../../conexion.php";
    session_start();
$sqlPree = "SELECT ID_MATERIA, NOMBRE_MATERIA, GRADO, MAT_TIPO FROM tbl_materias WHERE EXISTE=1 AND NIVEL=1 order by GRADO";
    $sqlpri = "SELECT ID_MATERIA, NOMBRE_MATERIA, GRADO, MAT_TIPO FROM tbl_materias WHERE EXISTE=1 AND NIVEL=2 order by GRADO";
    $tildes = $conexion->query("SET NAMES 'utf8'");
    $resultpree = mysqli_query($conexion, $sqlPree);
    $resultpri = mysqli_query($conexion, $sqlpri);
?>
<html lang="es">
<head>
    <meta charset="utf-8"> 
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
        .table{
            text-align: center;
        }
    </style>
    <script>
        function eliminar(p1,p2) {
            if(confirm("¿Realmente quieres eliminar los datos de la Materia "+p2+"?")===true){
                window.location.href="mod_prod2.php?id="+p1+"&ref=del";
            }
        }
    </script>
</head>
<body>
    <div class="section-header">
        <h2 class="wow fadeInDown animated title">Panel General de Materias</h2>
    </div>
    <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-preescolar-tab" data-toggle="tab" href="#nav-preescolar" role="tab" aria-controls="nav-preescolar" aria-selected="true">Preescolar</a>
        <a class="nav-item nav-link" id="nav-primaria-tab" data-toggle="tab" href="#nav-primaria" role="tab" aria-controls="nav-primaria" aria-selected="false">Primaria</a>
    </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-preescolar" role="tabpanel" aria-labelledby="nav-preescolar-tab">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Grado</th>
                        <th scope="col">Idioma</th>
                        <th scope="col"><a href="FormMateria.php"><button type="button" class="btn btn-success">Registrar Materia</button></a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        while($reg = mysqli_fetch_array($resultpree)){
                            echo '  <tr>
                                        <th>'; echo $reg[0]; echo '</th>
                                        <td>'; echo $reg[1]; echo '</td>
                                        <td>'; echo $reg[2]; echo '°</td>
                                        <td>';if($reg[3]==1){echo "Español";}else{echo "Ingles";} echo '</td>
                                        <td><a href="modMateria.php?no=';echo $reg[0]; echo '"><button type="button" class="btn btn-primary btn-sm">Modificar</button></a>
                                        <button type="button" class="btn btn-danger btn-sm" onclick = "eliminar('; echo "$reg[0],'{$reg[1]}'";echo ')">Eliminar</button></td>
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
                        <th scope="col">Nombre</th>
                        <th scope="col">Grado</th>
                        <th scope="col">Idioma</th>
                        <th scope="col"><a href="FormMateria.php"><button type="button" class="btn btn-success">Registrar Materia</button></a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        while($reg = mysqli_fetch_array($resultpri)){
                            echo '  <tr>
                                        <th>'; echo $reg[0]; echo '</th>
                                        <td>'; echo $reg[1]; echo '</td>
                                        <td>'; echo $reg[2]; echo '°</td>
                                        <td>';if($reg[3]==1){echo "Español";}else{echo "Ingles";} echo '</td>
                                        <td><a href="modMateria.php?no=';echo $reg[0]; echo '"><button type="button" class="btn btn-primary btn-sm">Modificar</button></a>
                                        <button type="button" class="btn btn-danger btn-sm" onclick = "eliminar('; echo "$reg[0],'{$reg[1]}'";echo ')">Eliminar</button></td>
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