<<?php 
include "../../conexion.php";
if(isset($_GET["no"])){
    $sql = "SELECT * FROM tbl_alumnos WHERE ID_ALUMNO = {$_GET['no']}";
    $reg = mysqli_fetch_array(mysqli_query($conexion, $sql));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
        #message, #messagegrupo{
            display: none;
        }
    </style>
    <script>
        window.onload = function () {
            document.getElementById("foto").onchange = function(e) {
                document.getElementById("img").style.display="none";
                let reader = new FileReader();
                reader.readAsDataURL(e.target.files[0]);
                
                reader.onload = function(){
                    let preview = document.getElementById('preview'),
                    
                            image = document.createElement('img');
                            image.style.width = "100px";
                            image.style.height = "142px";
                    image.src = reader.result;
                    
                    preview.innerHTML = '';
                    preview.append(image);
                };
            }
        }
        function grados() {
            console.log("entro");
            var select = document.getElementById("grado");
            var cmbnivel=document.getElementById("nivel");
            select.selectedIndex="0";

            if(cmbnivel.value!="0"){
                while(select.length > 0) {
                    select.remove(select.length-1);
                }
                if (cmbnivel.value=="2"){
                    for (var i=0; i<=6; i++) {
                        var array = ["Seleccionar",1,2,3,4,5,6];
                        var option = document.createElement("option");
                        option.text = array[i];
                        option.value = i;
                        select.add(option,select[i]);
                    }

                }
                if (cmbnivel.value=="1"){
                    for (var i=0; i<=3; i++) {
                        var array = ["Seleccionar",1,2,3];
                        var option = document.createElement("option");
                        option.text = array[i];
                        option.value = i;
                        select.add(option,select[i]);
                    }
                }  
            }
        }
        function verify(){
             fechaE = document.getElementById('fechaF').value;
             fechaI = document.getElementById('fechaI').value;
            if (fechaE < fechaI){
                document.getElementById("message").style.display = "block";
                document.getElementById("message").focus();
                return false;
            }
            if(verifyCombos()==false){
                return false;
            }
            
            document.getElementById("formulario").submit();
            return true;            
        }
        function verifyCombos(){
            nivel = document.getElementById("nivel").value;
            grado = document.getElementById("grado").value;
            grupo = document.getElementById("grupo").value;
                if(nivel == "0"){
                    document.getElementById("messagegrupo").style.display = "block";
                    document.getElementById("messagegrupo").innerText ="Seleccione un nivel valido!!";
                    document.getElementById("nivel").focus();
                    return false;
                }
                if(grado == "0"){
                    document.getElementById("messagegrupo").style.display = "block";
                    document.getElementById("messagegrupo").innerText ="Seleccione un grado valido!!";
                    document.getElementById("grado").focus();
                    return false;
                }
                if(grupo == "0"){
                    document.getElementById("messagegrupo").style.display = "block";
                    document.getElementById("messagegrupo").innerText ="Seleccione un grupo valido!!";
                    document.getElementById("grupo").focus();
                    return false;
                }
            return true;
        }
    </script>
</head>
<body>
    <div class="section-header">
        <h2 class="wow fadeInDown animated title">Registro de Alumnos</h2>
    </div>
    <div style="width: 100%; margin-left: 25%; margin-top: 20pt;">
        <form action="modif_prod2.php?ref=mod" method="POST" enctype="multipart/form-data" name="form1" id="formulario" onsubmit="return verify();">
        <input type="hidden" name="idalumnant" id="idalumnant" value="<?php echo $reg[0]?>">
            <div class="form-row">
                <div class="col-6" align=center>
                    <label for="preview">Previsualización</label><br>
                    <img src="<?php echo $reg[11]?>" id="img" width="100px" height="142px">
                    <div id="preview"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-6">
                    <label for="foto">Fotografia</label>
                    <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
                </div>
            </div>
            <div class="col-6">
                    <?php 
                        if(isset($_GET['ref'])){
                            if($_GET['ref']==='invalidAlumn'){
                                echo "<div class='alert alert-danger' role='alert'  align='center'>alumno ya registrado!!</div>";
                            }elseif ($_GET['ref']==='invalidgrupo') {
                                echo "<div class='alert alert-danger' role='alert'  align='center'>el grupo que selecciono no existe!!</div>";
                            }
                        }
                    ?>
            </div>
            <div class="form-row">
                <div class="col-6">
                    <label for="idalumn">No. de Control</label>
                    <input type="text" name="idalumn" id="idalumn" value="<?php echo $reg[0]?>" placeholder="No. de control" class="form-control" required>
                </div>
            </div>
            <div class="form-row">
                <div>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre(s)" value="<?php echo $reg[1]?>" class="form-control" required>
                </div>
                <div class="col-2">
                    <label for="apaterno">Apellido Parerno</label>
                    <input type="text" class="form-control" name="apaterno" required id="apaterno" value="<?php echo $reg[2]?>" placeholder="Apellido Paterno">
                </div>
                <div class="col-2">
                    <label for="amaterno">Apellido Materno</label>
                    <input type="text" class="form-control" name="amaterno" value="<?php echo $reg[3]?>"  id="amaterno" placeholder="Apellido Materno">
                </div>
            </div>
            <div class="form-row">
                <div class="col-3">
                    <label for="telefono">Telefono</label>
                    <input type="text" name="telefono" id="telefono" class="form-control" value="<?php echo $reg[5]?>" placeholder="telefono">
                </div>
                <div class="col-3">
                    <label for="email">Correo Electronico</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?php echo $reg[6]?>" placeholder="Correo Electronico">
                </div>
            </div>
            <div class="form-row">
                <div class="col-2">
                    <label for="nivel">Nivel</label>
                    <select name="nivel" id="nivel" class="form-control" onclick="grados()" required onblur="grados()">
                        <?php
                            switch ($reg[7]) {
                                case 1:
                                    echo "  <option value='0'>Seleccione...</option>
                                            <option value='1' selected>Preescolar</option>
                                            <option value='2'>Primaria</option>";
                                    break;
                                case 2:
                                    echo "  <option value='0'>Seleccione...</option>
                                            <option value='1'>Preescolar</option>
                                            <option value='2' selected>Primaria</option>";
                                    break;
                                default:
                                    echo "  <option value='0' selected>Seleccione...</option>
                                            <option value='1'>Preescolar</option>
                                            <option value='2'>Primaria</option>"; 
                                    break;
                            }
                        ?>
                    </select>
                </div>
                <div class="col-2">
                    <label for="grado">Grado</label>
                    <select name="grado" id="grado" required class="form-control">
                        <?php
                            if($reg[7]==1){
                                switch ($reg[4]) {
                                    case 1:
                                        echo "  <option value='0'>Seleccione...</option>
                                                <option value='1' selected>1</option>
                                                <option value='2'>2</option>
                                                <option value='3'>3</option>";
                                        break;
                                    case 2:
                                        echo "  <option value='0'>Seleccione...</option>
                                                <option value='1'>1</option>
                                                <option value='2' selected>2</option>
                                                <option value='3'>3</option>";
                                        break;
                                    case 3:
                                        echo "  <option value='0'>Seleccione...</option>
                                                <option value='1'>1</option>
                                                <option value='2'>2</option>
                                                <option value='3' selected>3</option>";
                                        break;
                                    default:
                                        echo "<option value='0' selected>Seleccione...</option>";
                                        break;
                                }
                            }elseif ($reg[7]==2) {
                                switch ($reg[4]) {
                                    case 1:
                                        echo "  <option value='0'>Seleccione...</option>
                                                <option value='1' selected>1</option>
                                                <option value='2'>2</option>
                                                <option value='3'>3</option>
                                                <option value='4'>4</option>
                                                <option value='5'>5</option>
                                                <option value='6'>6</option>";
                                        break;
                                    case 2:
                                        echo "  <option value='0'>Seleccione...</option>
                                                <option value='1'>1</option>
                                                <option value='2' selected>2</option>
                                                <option value='3'>3</option>
                                                <option value='4'>4</option>
                                                <option value='5'>5</option>
                                                <option value='6'>6</option>";
                                        break;
                                    case 3:
                                        echo "  <option value='0'>Seleccione...</option>
                                                <option value='1'>1</option>
                                                <option value='2'>2</option>
                                                <option value='3' selected>3</option>
                                                <option value='4'>4</option>
                                                <option value='5'>5</option>
                                                <option value='6'>6</option>";
                                        break;
                                    case 4:
                                        echo "  <option value='0'>Seleccione...</option>
                                                <option value='1'>1</option>
                                                <option value='2'>2</option>
                                                <option value='3'>3</option>
                                                <option value='4' selected>4</option>
                                                <option value='5'>5</option>
                                                <option value='6'>6</option>";
                                        break;
                                    case 5:
                                        echo "  <option value='0'>Seleccione...</option>
                                                <option value='1'>1</option>
                                                <option value='2'>2</option>
                                                <option value='3'>3</option>
                                                <option value='4'>4</option>
                                                <option value='5' selected>5</option>
                                                <option value='6'>6</option>";
                                        break;
                                    case 6:
                                        echo "  <option value='0'>Seleccione...</option>
                                                <option value='1'>1</option>
                                                <option value='2'>2</option>
                                                <option value='3'>3</option>
                                                <option value='4'>4</option>
                                                <option value='5'>5</option>
                                                <option value='6' selected>6</option>";
                                        break;
                                    default:
                                        echo "<option value='0' selected>Seleccione...</option>";
                                        break;
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col-2">
                    <label for="grupo">grupo</label>
                    <select name="grupo" id="grupo" required class="form-control">
                        <option value="0">Seleccione...</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                    </select>
                </div>
                <div class="col-2">
                    <label for="messagegrupo"> </label>
                    <div class='alert alert-danger' role='alert' id="messagegrupo" align='center'></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-3">
                    <label for="fechaI">Fecha de Ingreso</label>
                    <input type="date" name="fechaI" id="fechaI" value="<?php echo $reg[8]?>" class="form-control">
                </div>
                <div class="col-3">
                    <label for="fechaI">Fecha de Egreso</label>
                    <input type="date" name="fechaF" id="fechaF" value="<?php echo $reg[9]?>" class="form-control">
                </div>
                <div class="col-2">
                        <label for="message"> </label>
                        <div class='alert alert-danger' role='alert' id="message" align='center'>Fechas incorrectas!!</div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-3">
                    <button type="submit" id="submit" name="send" class="btn btn-primary btn-lg btn-block" style="border-radius: 5pt; margin-top: 20px;">Actualizar Datos</button>
                </div>
                <div class="col-3">
                    <button id="cancel" name="cancel" class="btn btn-danger btn-lg btn-block" type="button" onclick="window.location.href='../inicio.html'" style="border-radius: 5pt; margin-top: 20px;">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>