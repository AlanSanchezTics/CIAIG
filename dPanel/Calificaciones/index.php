<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/animate.min.css">
    <style>
        .title{
            text-align: center;
            margin: 15pt 0 0 0;
        }
        label{
            margin-top: 10px;
           font-weight: bold; 
        }
        #message,#messagemat,#messageper{
            display: none;
        }
    </style>
    <script>
        function verify() {
            grupo = document.getElementById("grupo").value;
            materia = document.getElementById("materia").value;
            periodo = document.getElementById("periodo").value;

            if(grupo == 0){
                document.getElementById("message").style.display = "block";
                document.getElementById("message").innerText="seleccione un grupo!!";
                return false;
            }else{
                document.getElementById("message").style.display = "none";
                document.getElementById("message").innerText="";
            }
            if(materia == 0){
                document.getElementById("messagemat").style.display = "block";
                document.getElementById("messagemat").innerText="seleccione una materia!!";
                return false;
            }else{
                document.getElementById("messagemat").style.display = "none";
                document.getElementById("messagemat").innerText="";
            }
            if(periodo == 0){
                document.getElementById("messageper").style.display = "block";
                document.getElementById("messageper").innerText="seleccione un periodo!!";
                return false;
            }else{
                document.getElementById("messageper").style.display = "none";
                document.getElementById("messageper").innerText="";
            }
            return true;
        }
    </script>
</head>
<body>
<div class="section-header">
        <h2 class="wow fadeInDown animated title">Alta de calificaciones</h2>
    </div>
    <div style="width: 100%; margin-left: 25%; margin-top: 20pt;">
        <form onsubmit="return verify()" method="POST" action="redirect.php">
            <div class="form-row">
                <div class="col-6">
                    <label for="grupo">Grupo</label>
                    <script>
                        function checkmat() {
                            var grupo = document.getElementById("grupo").value;
                            window.location.href='index.php?refgrupo='+grupo;
                        }
                    </script>
                    <select name="grupo" id="grupo" class="form-control" onblur="checkmat()" onchange="checkmat()">
                        <option value="0">Seleccione...</option>
                        <?php
                            session_start();
                            include "../../conexion.php";
            
                            $sql = "SELECT ID_GRUPO, GRADO,NOMBRE, NIVEL FROM tbl_grupos WHERE ID_DOCENTE_E =".$_SESSION['IDUSER']."  OR ID_DOCENTE_I = ".$_SESSION['IDUSER']." AND EXISTE = 1";
                            $result = $conexion -> query($sql);
                            while ($row = mysqli_fetch_array($result)){
                                if($row[0]==$_GET["refgrupo"]){
                                    echo '<option value="'.$row[0].'" selected>'.$row[1]."°".$row[2].' ';if($row[3]==1){echo "Preescolar";}else{echo "Primaria";}echo '</option>';
                                }else{
                                    echo '<option value="'.$row[0].'">'.$row[1]."°".$row[2].' ';if($row[3]==1){echo "Preescolar";}else{echo "Primaria";}echo '</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col-2">
                    <label for="message"> </label>
                    <div class='alert alert-danger' role='alert' id="message" align='center'></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-6">
                    <label for="materia">Materia</label>
                    <select id="materia" name="materia" class="form-control">
                        <option value="0">Seleccione...</option>
                        <script>
                            var array_materias = "";
                            <?php
                                if(isset($_GET["refgrupo"])){
                                    $sql = "SELECT NIVEL FROM tbl_grupos WHERE ID_GRUPO = {$_GET['refgrupo']}";
                                    $nivel = mysqli_fetch_array($conexion -> query($sql));
                                    if($nivel[0] == 1){
                                        $tipo = 3;
                                    }else {
                                        $sql = "SELECT ID_DOCENTE_E FROM tbl_grupos WHERE ID_DOCENTE_E ={$_SESSION['IDUSER']} AND ID_GRUPO = {$_GET['refgrupo']}";
                                        if(mysqli_num_rows($conexion -> query($sql))>0){
                                            $tipo = 1;
                                        }else{
                                            $tipo = 2;
                                        }
                                    }
                                    
                                    $sql = "SELECT tbl_asignacionmaterias.ID_MATERIA, tbl_materias.NOMBRE_MATERIA FROM tbl_materias, tbl_asignacionmaterias WHERE tbl_asignacionmaterias.ID_MATERIA = tbl_materias.ID_MATERIA AND tbl_asignacionmaterias.ID_GRUPO ={$_GET['refgrupo']}  AND tbl_materias.MAT_TIPO =$tipo AND NIVEL = {$nivel[0]}";
                                    $result = $conexion -> query($sql);
                                    while ($row = mysqli_fetch_array($result)){
                                        $materias[] = $row;
                                    }
                                    echo "array_materias =".json_encode($materias, JSON_UNESCAPED_UNICODE).";";
                                    
                                }                                 
                            ?>
                            var grupo = document.getElementById("grupo");
                            var materia = document.getElementById("materia");
                            
                            if(grupo.value != 0 && array_materias != ""){
                                while(materia.length > 0){
                                    materia.remove(materia.length-1);
                                }
                                for (let index = 0; index < array_materias.length; index++) {
                                    var array = array_materias[index];
                                    var option = document.createElement("option");
                                    option.value = array[0];
                                    option.text = array[1];
                                    materia.add(option,materia[index]);
                                }
                            }
                        </script>
                    </select>
                </div>
                <div class="col-2">
                    <label for="message"> </label>
                    <div class='alert alert-danger' role='alert' id="messagemat" align='center'></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-6">
                    <label for="periodo">Periodo</label>
                    <select class="form-control" id="periodo" name="periodo">
                        <option value="0">Seleccione...</option>
                        <?php
                            switch ($nivel[0]) {
                                case 1:
                                    echo '  <option>Septiembre</option>
                                            <option>Octubre</option>
                                            <option>Noviembre</option>
                                            <option>Diciembre</option>
                                            <option>Enero</option>
                                            <option>Febrero</option>
                                            <option>Marzo</option>
                                            <option>Abril</option>
                                            <option>Mayo</option>
                                            <option>Junio</option>';
                                    break;
                                case 2:
                                    echo '  <option value="1">Periodo I</option>
                                            <option value="2">Periodo II</option>
                                            <option value="3">Periodo III</option>
                                            <option value="4">Periodo VI</option>
                                            <option value="5">Periodo V</option>';
                                break;
                            }
                        ?>
                    </select>
                </div>
                <div class="col-2">
                    <label for="message"> </label>
                    <div class='alert alert-danger' role='alert' id="messageper" align='center'></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-6">
                <button type="submit" id="submit" name="send" class="btn btn-primary btn-lg btn-block" style="border-radius: 5pt; margin-top: 20px;">Iniciar alta de calificaciones</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>