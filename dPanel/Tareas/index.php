<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/animate.min.css">
    <style>
        @charset "UTF-8";
        .title{
            text-align: center;
            margin: 15pt 0 15pt 0;
        }
        .nav-item.nav-link.active{
            background-color: gold;
            color: black;
        }
        #contenido{
            width: 450px;
            text-align: justify;
        }
        #titulo{
            width: 100px;
        }
    </style>
    <script>
        
        function eliminar(p1,p2,p3) {
            if(confirm("¿Realmente quieres eliminar la tarea con titulo '"+p2+"'?")===true){
                window.location.href="mod_prod2.php?id="+p1+"&ref=del";
            }
        }
    </script>
</head>
<body>
    <div class="section-header">
        <h2 class="wow fadeInDown animated title">Panel General de Tareas Publicadas</h2>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th id="titulo">Titulo</th>
                <th id="contenido">Contenido</th>
                <th scope="col">Materia</th>
                <th scope="col">Fecha de Entrega</th>
                <th scope="col">Grupo</th>
                <th scope="col"><a href="formTareas.php"><button type="button" class="btn btn-success">Subir Tarea</button></a></th>
            </tr>
        </thead>
        <tbody>
            <?php
                include "../../conexion.php";
                $sql = "SELECT tbl_tareas.ID_TAREA, tbl_tareas.TITULO_TAREA, tbl_tareas.DESCRIPCION_TAREA, tbl_materias.NOMBRE_MATERIA, tbl_tareas.FECHA_CREACION , tbl_tareas.FECHA_ENTREGA, tbl_grupos.GRADO, tbl_grupos.NOMBRE, tbl_grupos.NIVEL FROM tbl_tareas, tbl_materias, tbl_grupos WHERE tbl_tareas.ID_GRUPO = tbl_grupos.ID_GRUPO AND tbl_tareas.ID_MATERIA = tbl_materias.ID_MATERIA AND tbl_tareas.existe = 1";
                $result = $conexion -> query($sql);
                while ($reg = mysqli_fetch_array($result)) {
                    echo '  <tr>
                                <th scope="row">';echo $reg[0];echo '</th>
                                <td>';echo $reg[1]; echo '</td>
                                <td id = "contenido" data-toggle="tooltip" data-html="true" title="Tarea publicada el: '.$reg[4].'">'; echo $reg[2];echo '</td>
                                <td>';echo $reg[3]; echo '</td>
                                <td>';echo date_format(date_create($reg[5]),"d/M/Y"); echo '</td>
                                <td>';echo $reg[6]."°".$reg[7];if($reg[8] == 2){echo " Primaria";}else{echo " Preescolar";}echo'</td>
                                <td><a href="mod_prod2.php?id='.$reg[0].'&ref=resend"><button type="button" class="btn btn-primary btn-sm">Reenviar</button></a> <button type="button" class="btn btn-danger btn-sm" onclick="eliminar(';echo "$reg[0], '{$reg[1]}'";echo ',1)">Eliminar</button></td>
                                    </tr>';
                }
            ?>
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>