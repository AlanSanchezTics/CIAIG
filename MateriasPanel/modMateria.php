<!DOCTYPE html>

<?php
 include "../conexion.php";
 $tildes = $conexion->query("SET NAMES 'utf8'");

 if(isset($_GET["no"])){
     $sql = "SELECT * FROM tbl_materias WHERE ID_MATERIA = '{$_GET['no']}'";
     $reg = mysqli_fetch_array(mysqli_query($conexion, $sql));
 }
?>
<html lang="es">
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
        label{
            margin-top: 10px;
           font-weight: bold; 
        }
        #messagegrupo, #messagedocE,#messagedocI{
            display: none;
        }
    </style>
    <script type="text/javascript">
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
                        var array = ["Seleccione...",1,2,3,4,5,6];
                        var option = document.createElement("option");
                        option.text = array[i];
                        option.value = i;
                        select.add(option,select[i]);
                    }

                }
                if (cmbnivel.value=="1"){
                    for (var i=0; i<=3; i++) {
                        var array = ["Seleccione...",1,2,3];
                        var option = document.createElement("option");
                        option.text = array[i];
                        option.value = i;
                        select.add(option,select[i]);
                    }
                }  
            }
        }
        function verifyCombos(){
            nivel = document.getElementById("nivel").value;
            grado = document.getElementById("grado").value;
            mattipo = document.getElementById("matTipo").value;
                if(nivel == "0"){
                    document.getElementById("messagegrupo").style.display = "block";
                    document.getElementById("messagegrupo").innerText ="Seleccione un nivel valido!!";
                    document.getElementById("nivel").focus();
                    return false;
                }else{
                	document.getElementById("messagegrupo").style.display = "none";
                	document.getElementById("messagegrupo").innerText = "";
                }
                if(grado == "0"){
                    document.getElementById("messagegrupo").style.display = "block";
                    document.getElementById("messagegrupo").innerText ="Seleccione un grado valido!!";
                    document.getElementById("grado").focus();
                    return false;
                }else{
                	document.getElementById("messagegrupo").style.display = "none";
                	document.getElementById("messagegrupo").innerText = "";
                }
                if(mattipo == "0"){
                    document.getElementById("messagegrupo").style.display = "block";
                    document.getElementById("messagegrupo").innerText ="Seleccione un tipo valido!!";
                    document.getElementById("matTipo").focus();
                    return false;
                }else{
                	document.getElementById("messagegrupo").style.display = "none";
                	document.getElementById("messagegrupo").innerText = "";
                }
            return true;
        }
    </script>
</head>
<body>
	<div class="section-header">
        <h2 class="wow fadeInDown animated title">Modificación de datos de Materia</h2>
    </div>
	<div style="width: 100%; margin-left: 25%; margin-top: 20pt;">
		<form action="mod_prod2.php?ref=mod" method="POST" onsubmit="return verifyCombos()">
        <input type="hidden" name="idmat" id="idmat" value="<?php echo $reg[0]; ?>">
			<div class="col-6">
                    <?php 
                        if(isset($_GET['ref'])){
                            if($_GET['ref']==='invalidmateria'){
                                echo "<div class='alert alert-danger' role='alert'  align='center'>Materia ya registrada!!</div>";
                            }
                        }
                    ?>
            </div>
            <div class="form-row">
                <div class="col-6">
                    <label for="nombreMat">Nombre de la Mareria</label>
                    <input type="text" name="nombreMat" value="<?php echo $reg[2]; ?>" id="nombreMat" placeholder="Nombre de la Materia" class="form-control" required>
                </div>
            </div>
			<div class="form-row">
				<div class="col-2">
					<label for="nivel">Nivel</label>
					<select name="nivel" id="nivel" class="form-control" onclick="grados()" required onblur="grados()">
                    <?php 
                            switch ($reg[1]) {
                                case 1:
                                    echo '  <option value="0">Seleccione...</option>
                                            <option value="1" selected>Preescolar</option>
                                            <option value="2">Primaria</option>';
                                    break;
                                case 2:
                                    echo '  <option value="0">Seleccione...</option>
                                            <option value="1">Preescolar</option>
                                            <option value="2" selected>Primaria</option>';
                                    break;
                                default:
                                echo '  <option value="0">Seleccione...</option>';
                                    break;
                            }
                        ?>
					</select>
				</div>
				<div class="col-2">
					<label for="grado">Grado</label>
					<select name="grado" id="grado" class="form-control">
                    <?php
                            if($reg[1]==1){
                                switch ($reg[3]) {
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
                            }elseif ($reg[1]==2) {
                                switch ($reg[3]) {
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
                    <label for="matTipo">Tipo de materia</label>
                    <select name="matTipo" id="matTipo" class="form-control">
                        <?php
                            switch ($reg[4]) {
                                case 1:
                                    echo "  <option value='0'>Seleccione...</option>
                                            <option value='1' selected>Español</option>
                                            <option value='2'>Ingles</option>";
                                    break;
                                case 2:
                                    echo "  <option value='0'>Seleccione...</option>
                                            <option value='1'>Español</option>
                                            <option value='2' selected>Ingles</option>";
                                    break;
                                default:
                                echo "  <option value='0'>Seleccione...</option>";
                                    break;
                            }
                        ?>
                    </select>
                </div>
				<div class="col-2">
                    <label for="messagegrupo"> </label>
                    <div class='alert alert-danger' role='alert' id="messagegrupo" align='center'></div>
                </div>
			</div>
			<div class="form-row">
                <div class="col-3">
                    <button type="submit" id="submit" name="send" class="btn btn-primary btn-lg btn-block" style="border-radius: 5pt; margin-top: 20px;">Registrar Materia</button>
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