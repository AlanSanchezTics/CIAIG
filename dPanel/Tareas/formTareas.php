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
        #messagemat, #messagetitulo, #message,#messagefechas{
            display: none;
        }
    </style>
    <script>
        function verify() {
            grupo = document.getElementById("grupo").value;
            materia = document.getElementById("materia").value;
            titulo = document.getElementById("titulo").value;
            if(grupo == "0"){
                document.getElementById("message").style.display = "block";
                document.getElementById("grupo").focus();
                return false;
            }else{
                document.getElementById("message").style.display = "none";
            }
            if(materia == "0"){
                document.getElementById("messagemat").style.display = "block";
                document.getElementById("materia").focus();
                return false;
            }else{
                document.getElementById("messagemat").style.display = "none";
            }
            if(titulo == ""){
                document.getElementById("messagetitulo").style.display = "block";
                document.getElementById("messagetitulo").innerText ="Defina un titulo para el aviso!!";
                document.getElementById("titulo").focus();
                return false;
            }
            else{
                document.getElementById("messagetitulo").style.display = "none";
                document.getElementById("messagetitulo").innerText ="";
            }
            fechaE = document.getElementById('fechaF').value;
            fechaI = document.getElementById('fechaI').value;
            if (fechaE < fechaI || fechaE=="" || fechaI == ""){
                document.getElementById("message").style.display = "block";
                document.getElementById("FechaI").focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="section-header">
        <h2 class="wow fadeInDown animated title">Emisión de Tarea</h2>
    </div>
    <div style="width: 100%; margin-left: 25%; margin-top: 20pt;">
        <form method="POST" action="postTarea.php" onsubmit="return verify();">
            <div class="form-row">
                <div class="col-6">
                    <label for="grupo">Grupo</label>
                    <script>
                        function checkmat() {
                            var grupo = document.getElementById("grupo").value;
                                window.location.href='formTareas.php?refgrupo='+grupo;
                        }
                    </script>
                    <select id="grupo" name="grupo" class="form-control" onchange="checkmat()">
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
                    <div class='alert alert-danger' role='alert' id="message" align='center'>Seleccione un grupo!!</div>
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
                    <label for="messagemat"> </label>
                    <div class='alert alert-danger' role='alert' id="messagemat" align='center'>Seleccione una materia!!</div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-6">
                    <label for="titulo" class="h5">Titulo de la tarea</label>
                    <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Titulo">
                </div>
                <div class="col-2">
                    <div class='alert alert-danger' role='alert' id="messagetitulo" align='center'></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-6">
                    <label for="asunto">Contenido</label>
                    <textarea name="asunto" id="asunto" cols="30" rows="10" class="form-control" placeholder="Escriba aqui el contenido de la tarea"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="col-3">
                    <label for="fechaI">Inicio de la tarea</label>
                    <input type="date" name="fechaI" id="fechaI" class="form-control">
                </div>
                <div class="col-3">
                    <label for="fechaI">Fecha de entrega</label>
                    <input type="date" name="fechaF" id="fechaF" class="form-control">
                </div>
                <div class="col-2">
                        <label for="messagefechas"></label>
                        <div class='alert alert-danger' role='alert' id="messagefechas" align='center'>Fechas incorrectas!!</div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-3">
                    <button type="submit" id="submit" name="send" class="btn btn-primary btn-lg btn-block" style="border-radius: 5pt; margin-top: 20px;">Subir tarea</button>
                </div>
                <div class="col-3">
                    <button id="cancel" name="cancel" class="btn btn-danger btn-lg btn-block" type="button" onclick="window.location.href='index.php'" style="border-radius: 5pt; margin-top: 20px;">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>