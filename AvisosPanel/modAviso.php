<?php
    session_start();
    include "../conexion.php";
    switch($_GET["type"]){
        case 1:
            $sql = "SELECT * FROM tbl_avisosgenerales WHERE ID_AVISO = ".$_GET["id"]."";
            break;
        case 2:
            $sql = "SELECT * FROM tbl_avisos_nivel WHERE ID_AVISO = ".$_GET["id"]."";
            break;
        case 3:
            $sql = "SELECT * FROM tbl_avisos_grupo WHERE ID_AVISO = ".$_GET["id"]."";
            break;
        case 4:
            $sql = "SELECT * FROM tbl_avisos_alumno WHERE ID_AVISO = ".$_GET["id"]."";
            break;
    }
    $aviso = mysqli_fetch_array($conexion ->query($sql));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/animate.min.css">
    <style>
        .title{
            text-align: center;
            margin: 15pt 0 0 0;
        }
        label{
            margin-top: 10px;
           font-weight: bold; 
        }
        #messagetipo, #messagetitulo, #message, #select, #messagetipoaviso{
            display: none;
        }
        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 22px;
        }
        .switch input {display:none;}
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 19px;
            width: 19px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
        background-color: #00cc00;
        }

        input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
        -webkit-transform: translateX(19px);
        -ms-transform: translateX(19px);
        transform: translateX(19px);
        }
        .slider.round {
            border-radius: 22px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    <script>
        function showcombo() {
            var tipo = document.getElementById("tipoAviso");
            switch (tipo.value) {
                case "general":
                    document.getElementById("divgrupo").style.display="none";
                    document.getElementById("divnivel").style.display="none";  
                    document.getElementById("divalumnos").style.display="none";    
                    document.getElementById("messagetipoaviso").style.display = "none";
                	document.getElementById("messagetipoaviso").innerText = "";
                    document.getElementById("messagetipo").style.display = "none";
                    document.getElementById("messagetipo").innerText = "";
                    break;
                case "grupo":
                    document.getElementById("divgrupo").style.display="block";  
                    document.getElementById("divnivel").style.display="none";  
                    document.getElementById("divalumnos").style.display="none";
                    break;
                case "nivel":
                    document.getElementById("divgrupo").style.display="none";  
                    document.getElementById("divnivel").style.display="block";  
                    document.getElementById("divalumnos").style.display="none";
                    break;
                case "alumno":
                    document.getElementById("divgrupo").style.display="none";
                    document.getElementById("divnivel").style.display="none";  
                    document.getElementById("divalumnos").style.display="block";
                    break;
                case "0":
                    document.getElementById("divgrupo").style.display="none";
                    document.getElementById("divnivel").style.display="none";  
                    document.getElementById("divalumnos").style.display="none";
                    document.getElementById("messagetipoaviso").style.display = "none";
                	document.getElementById("messagetipoaviso").innerText = "";
                    document.getElementById("messagetipo").style.display = "none";
                    document.getElementById("messagetipo").innerText = "";
                    break;
                default:
                    document.getElementById("divgrupo").style.display="none";
                    document.getElementById("divnivel").style.display="none";  
                    document.getElementById("divalumnos").style.display="none";
                    document.getElementById("messagetipoaviso").style.display = "none";
                	document.getElementById("messagetipoaviso").innerText = "";
                    document.getElementById("messagetipo").style.display = "none";
                    document.getElementById("messagetipo").innerText = "";
                    break;
            }
        }
        function verify() {
             tipo = document.getElementById("tipoAviso").value;
             grupo  = document.getElementById("grupo").value;
             nivel = document.getElementById("nivel").value;
             alumno = document.getElementById("alumno").value;
             titulo = document.getElementById("titulo").value;
            
             if (tipo == "0") {
                    document.getElementById("messagetipoaviso").style.display = "block";
                    document.getElementById("messagetipoaviso").innerText ="Seleccione un tipo valido!!";
                    document.getElementById("tipoAviso").focus();
                    return false;
            }else{
                	document.getElementById("messagetipoaviso").style.display = "none";
                	document.getElementById("messagetipoaviso").innerText = "";
            }
            if(grupo == "0" && nivel == "0" && alumno == "0" && tipo != "0" && tipo !="general"){
                document.getElementById("messagetipo").style.display = "block";
                document.getElementById("messagetipo").innerText ="Seleccione un dato valido!!";
                return false;
            }else{
                document.getElementById("messagetipo").style.display = "none";
                document.getElementById("messagetipo").innerText = "";
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
                document.getElementById("message").focus();
                return false;
            }
            return true;
        } 
    </script>
</head>
<body>
    <div class="section-header">
        <h2 class="wow fadeInDown animated title">Modificación de Aviso</h2>
    </div>
    <div style="width: 100%; margin-left: 25%; margin-top: 20pt;">
        <form action="mod_prod2.php?ref=mod" method="POST" onsubmit="return verify()">
        <input type="hidden" name="idAviso" value="<?php echo $aviso[0]; ?>">
            <div class="form-row">
                <div class="col-6">
                    <label for="tipo" class="h5">El aviso va dirigido a </label>
                    <select name="tipoAviso" id="tipoAviso" class="form-control" onclick="showcombo()" onblur="showcombo()" readonly>
                        <option value="0">Seleccione...</option>
                        <?php
                            switch ($_GET["type"]) {
                                case 1:
                                    echo '  <option value="general" selected>A todo alumno inscrito</option>
                                            <option value="grupo">Grupo</option>
                                            <option value="nivel">Nivel</option>
                                            <option value="alumno">Alumno</option>';
                                    break;
                                case 2:
                                    echo '  <option value="general">A todo alumno inscrito</option>
                                            <option value="grupo">Grupo</option>
                                            <option value="nivel" selected>Nivel</option>
                                            <option value="alumno">Alumno</option>';
                                    break;
                                case 3:
                                    echo '  <option value="general">A todo alumno inscrito</option>
                                            <option value="grupo" selected>Grupo</option>
                                            <option value="nivel">Nivel</option>
                                            <option value="alumno">Alumno</option>';
                                    break;
                                case 4:
                                    echo '  <option value="general">A todo alumno inscrito</option>
                                            <option value="grupo">Grupo</option>
                                            <option value="nivel">Nivel</option>
                                            <option value="alumno" selected>Alumno</option>';
                                    break;
                                default:
                                    echo '  <option value="general">A todo alumno inscrito</option>
                                            <option value="grupo">Grupo</option>
                                            <option value="nivel">Nivel</option>
                                            <option value="alumno">Alumno</option>';
                                    break;
                            }
                        ?>
                    </select>
                </div>
                <div class="col-2">
                        <div class='alert alert-danger' role='alert' id="messagetipoaviso" align='center'></div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-6" id="divgrupo" <?php if($_GET["type"]!=3){echo 'style="display: none;"';} ?>>
                    <label for="grupo" class="h5">Grupo</label>
                    <select name="grupo" id="grupo" class="form-control" readonly>
                        <option value="0">Seleccione...</option>
                        <?php 
                        include "../conexion.php";
                        $tildes = $conexion->query("SET NAMES 'utf8'");

                        $sql = "SELECT * FROM tbl_grupos WHERE EXISTE = 1";
                        $result = $conexion -> query($sql);
                        while($row = mysqli_fetch_array($result)){
                            if($row[0]==$aviso[6]){
                                echo "<option value='";echo $row[0]; echo"' selected>"; echo "{$row[2]}°{$row[5]}";
                            }else{
                                echo "<option value='";echo $row[0]; echo"'>"; echo "{$row[2]}°{$row[5]}";
                            }
                            if($row[1]==1){
                                echo " Preescolar";
                            }else{
                                echo " Primaria";
                            }
                            echo "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-6" id="divnivel" <?php if($_GET["type"]!=2){echo 'style="display: none;"';} ?>>
                    <label for="nivel" class="h5">nivel</label>
                    <select name="nivel" id="nivel" class="form-control" readonly>
                        <option value="0">Seleccione...</option>
                        <?php
                            switch ($aviso[6]) {
                                case 1:
                                    echo '  <option value="1" selected>Preescolar</option>
                                            <option value="2">Primaria</option>';
                                    break;
                                
                                case 2:
                                    echo '  <option value="1">Preescolar</option>
                                            <option value="2" selected>Primaria</option>';
                                    break;
                                default:
                                    echo '  <option value="1">Preescolar</option>
                                            <option value="2">Primaria</option>';
                                    break;
                            }
                        ?>
                    </select>
                </div>
                <div class="col-6" id="divalumnos" <?php if($_GET["type"]!=4){echo 'style="display: none;"';} ?>>
                <label for="alumno" class="h5">Alumno</label>
                    <select name="alumno" id="alumno" class="form-control" readonly>
                        <option value="0">Seleccione...</option>
                        <?php 
                            include "../conexion.php";
                            $tildes = $conexion->query("SET NAMES 'utf8'");
                            $sql = "SELECT * FROM tbl_alumnos WHERE EXISTE = 1 ORDER BY ID_ALUMNO";
                            $result = $conexion -> query($sql);
                            while($row = mysqli_fetch_array($result)){
                                if($row[0]==$aviso[6]){
                                    echo "<option value='";echo $row[0]; echo"' selected>"; echo "{$row[0]} {$row[1]} {$row[2]}";
                                    echo "</option>";
                                }else{
                                    echo "<option value='";echo $row[0]; echo"'>"; echo "{$row[0]} {$row[1]} {$row[2]}";
                                    echo "</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col-2">
                    <div class='alert alert-danger' role='alert' id="messagetipo" align='center'></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-6">
                    <label for="titulo" class="h5">Titulo del aviso</label>
                    <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Titulo" value ="<?php echo $aviso[1]; ?>">
                </div>
                <div class="col-2">
                    <div class='alert alert-danger' role='alert' id="messagetitulo" align='center'></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-6">
                    <label for="asunto">Asunto</label>
                    <textarea name="asunto" id="asunto" cols="30" rows="10" class="form-control" placeholder="Escriba aqui el contenido del aviso"><?php echo $aviso[2]; ?></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="col-3">
                    <label for="fechaI">Inicio del aviso</label>
                    <input type="date" name="fechaI" id="fechaI" class="form-control" value ="<?php echo $aviso[3]; ?>">
                </div>
                <div class="col-3">
                    <label for="fechaI">Acontecimiento del aviso</label>
                    <input type="date" name="fechaF" id="fechaF" class="form-control" value ="<?php echo $aviso[4]; ?>">
                </div>
                <div class="col-2">
                        <label for="message"></label>
                        <div class='alert alert-danger' role='alert' id="message" align='center'>Fechas incorrectas!!</div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-check form-check-inline">
                    <label class="switch">
                        <input type="checkbox" name="notificar" value="true">
                        <span class="slider round"></span>
                    </label> <label>Notificar a Usuarios</label>
                </div>
            </div>
            <div class="form-row">
                <div class="col-3">
                    <button type="submit" id="submit" name="send" class="btn btn-primary btn-lg btn-block" style="border-radius: 5pt; margin-top: 20px;">Actualizar Aviso</button>
                </div>
                <div class="col-3">
                    <button id="cancel" name="cancel" class="btn btn-danger btn-lg btn-block" type="button" onclick="window.location.href='index.php'" style="border-radius: 5pt; margin-top: 20px;">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</body>
</html>