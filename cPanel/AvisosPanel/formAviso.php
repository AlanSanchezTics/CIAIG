<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            document.getElementById("submit").disabled = true;
            document.getElementById("submit").innerText="Un momento...";
             tipo = document.getElementById("tipoAviso").value;
             grupo  = document.getElementById("grupo").value;
             nivel = document.getElementById("nivel").value;
             alumno = document.getElementById("alumno").value;
             titulo = document.getElementById("titulo").value;
            
             if (tipo == "0") {
                    document.getElementById("messagetipoaviso").style.display = "block";
                    document.getElementById("messagetipoaviso").innerText ="Seleccione un tipo valido!!";
                    document.getElementById("tipoAviso").focus();
                    document.getElementById("submit").disabled = false;
                    document.getElementById("submit").innerText="Publicar Aviso";
                    return false;
            }else{
                	document.getElementById("messagetipoaviso").style.display = "none";
                	document.getElementById("messagetipoaviso").innerText = "";
            }
            if(grupo == "0" && nivel == "0" && alumno == "0" && tipo != "0" && tipo !="general"){
                document.getElementById("messagetipo").style.display = "block";
                document.getElementById("messagetipo").innerText ="Seleccione un dato valido!!";
                document.getElementById("submit").disabled = false;
                document.getElementById("submit").innerText="Publicar Aviso";
                return false;
            }else{
                document.getElementById("messagetipo").style.display = "none";
                document.getElementById("messagetipo").innerText = "";
            }
            if(titulo == ""){
                document.getElementById("messagetitulo").style.display = "block";
                document.getElementById("messagetitulo").innerText ="Defina un titulo para el aviso!!";
                document.getElementById("titulo").focus();
                document.getElementById("submit").disabled = false;
                document.getElementById("submit").innerText="Publicar Aviso";
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
                document.getElementById("submit").disabled = false;
                document.getElementById("submit").innerText="Publicar Aviso";
                return false;
            }
            return true;
        } 
    </script>
</head>
<body>
    <div class="section-header">
        <h2 class="wow fadeInDown animated title">Emisión de Avisos</h2>
    </div>
    <div style="width: 100%; margin-left: 25%; margin-top: 20pt;">
        <form action="postAviso.php" method="POST" onsubmit="return verify()">
            <div class="form-row">
                <div class="col-6">
                    <label for="tipo" class="h5">El aviso va dirigido a </label>
                    <select name="tipoAviso" id="tipoAviso" class="form-control" onclick="showcombo()" onblur="showcombo()">
                        <option value="0">Seleccione...</option>
                        <option value="general">A todo alumno inscrito</option>
                        <option value="grupo">Grupo</option>
                        <option value="nivel">Nivel</option>
                        <option value="alumno">Alumno</option>
                    </select>
                </div>
                <div class="col-2">
                        <div class='alert alert-danger' role='alert' id="messagetipoaviso" align='center'></div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-6" id="divgrupo" style="display: none;">
                    <label for="grupo" class="h5">Grupo</label>
                    <select name="grupo" id="grupo" class="form-control">
                        <option value="0">Seleccione...</option>
                        <?php 
                        include "../../conexion.php";
                        $tildes = $conexion->query("SET NAMES 'utf8'");
                        $sql = "SELECT * FROM tbl_grupos WHERE EXISTE = 1";
                        $result = $conexion -> query($sql);
                        while($row = mysqli_fetch_array($result)){
                            echo "<option value='";echo $row[0]; echo"'>"; echo "{$row[2]}°{$row[5]}";
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
                <div class="col-6" id="divnivel" style="display: none;">
                    <label for="nivel" class="h5">nivel</label>
                    <select name="nivel" id="nivel" class="form-control">
                        <option value="0">Seleccione...</option>
                        <option value="1">Preescolar</option>
                        <option value="2">Primaria</option>
                    </select>
                </div>
                <div class="col-6" id="divalumnos" style="display: none;">
                <label for="alumno" class="h5">Alumno</label>
                    <select name="alumno" id="alumno" class="form-control">
                        <option value="0">Seleccione...</option>
                        <?php 
                            include "../../conexion.php";
                            $tildes = $conexion->query("SET NAMES 'utf8'");
                            $sql = "SELECT * FROM tbl_alumnos WHERE EXISTE = 1 ORDER BY ID_ALUMNO";
                            $result = $conexion -> query($sql);
                            while($row = mysqli_fetch_array($result)){
                                echo "<option value='";echo $row[0]; echo"'>"; echo "{$row[0]} {$row[1]} {$row[2]}";
                                echo "</option>";
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
                    <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Titulo">
                </div>
                <div class="col-2">
                    <div class='alert alert-danger' role='alert' id="messagetitulo" align='center'></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-6">
                    <label for="asunto">Asunto</label>
                    <textarea name="asunto" id="asunto" cols="30" rows="10" class="form-control" placeholder="Escriba aqui el contenido del aviso"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="col-3">
                    <label for="fechaI">Inicio del aviso</label>
                    <input type="date" name="fechaI" id="fechaI" class="form-control" value="<?php echo date("Y-m-d"); ?>">
                </div>
                <div class="col-3">
                    <label for="fechaI">Acontecimiento del aviso</label>
                    <input type="date" name="fechaF" id="fechaF" class="form-control">
                </div>
                <div class="col-2">
                        <label for="message"></label>
                        <div class='alert alert-danger' role='alert' id="message" align='center'>Fechas incorrectas!!</div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-3">
                    <button type="submit" id="submit" name="send" class="btn btn-primary btn-lg btn-block" style="border-radius: 5pt; margin-top: 20px;">Publicar Aviso</button>
                </div>
                <div class="col-3">
                    <button id="cancel" name="cancel" class="btn btn-danger btn-lg btn-block" type="button" onclick="window.location.href='index.php'" style="border-radius: 5pt; margin-top: 20px;">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>