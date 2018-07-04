<?php
    session_start();
    include "../conexion.php";
    $sql="SELECT ID_DOCENTE, NOMBRE, A_PATERNO, A_MATERNO, TEL, EMAIL, tbl_usuarios.LOGIN,tbl_usuarios.ID_USUARIO FROM tbl_usuarios, tbl_docentes WHERE tbl_docentes.ID_USUARIO = tbl_usuarios.ID_USUARIO AND tbl_docentes.EXISTE=1 ORDER BY ID_DOCENTE";
    $tildes = $conexion->query("SET NAMES 'utf8'");
    $result = mysqli_query($conexion,$sql);
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
            margin: 15pt;
        }
    </style>
    <script>
        function eliminar(p1,p2,p3) {
            if(confirm("¿Realmente quieres eliminar los datos del docente "+p3+"?")===true){
                window.location.href="modif_prod2.php?no="+p1+"&id="+p2+"&ref=del";
            }
        }
    </script>
</head>
<body>
    <div class="section-header">
        <h2 class="wow fadeInDown animated title">Panel General de Docentes</h2>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre(s)</th>
                <th scope="col">Apellido Paterno</th>
                <th scope="col">Apellido Materno</th>
                <th scope="col">Telefono</th>
                <th scope="col">Correo</th>
                <th scope="col">Usuario de Acceso</th>
                <th scope="col" colspan="2"><button onclick="window.location.href='formDoc.php';" type="button" class="btn btn-success">Registrar Docente</button></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                    while($reg = mysqli_fetch_array($result)){
                        echo '  <tr>
                                    <th scope="row">';echo $reg[0]; echo '</th>
                                    <td>';echo $reg[1];echo '</td>
                                    <td>';echo $reg[2];echo '</td>
                                    <td>';echo $reg[3];echo '</td>
                                    <td>';echo $reg[4];echo '</td>
                                    <td>';echo $reg[5];echo '</td>
                                    <td>';echo $reg[6];echo '</td>
                                    <td><a href="modDoc.php?no=';echo $reg[0];echo '&id=';echo $reg[7]; echo '"><button type="button" class="btn btn-primary btn-sm">Modificar</button></a></td>
                                    <td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(';echo "$reg[0],{$reg[7]},'{$reg[1]}'";echo ')">Eliminar</button></td>
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