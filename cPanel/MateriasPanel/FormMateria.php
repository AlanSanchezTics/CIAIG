<!DOCTYPE html>
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
        <h2 class="wow fadeInDown animated title">Registro de Materia</h2>
    </div>
	<div style="width: 100%; margin-left: 25%; margin-top: 20pt;">
		<form action="nuevo_prod2.php" method="POST" onsubmit="return verifyCombos()">
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
                    <input type="text" name="nombreMat" id="nombreMat" placeholder="Nombre de la Materia" class="form-control" required>
                </div>
            </div>
			<div class="form-row">
				<div class="col-2">
					<label for="nivel">Nivel</label>
					<select name="nivel" id="nivel" class="form-control" onclick="grados()" required onblur="grados()">
						<option value="0">Seleccione...</option>
						<option value="1">Preescolar</option>
						<option value="2">Primaria</option>
					</select>
				</div>
				<div class="col-2">
					<label for="grado">Grado</label>
					<select name="grado" id="grado" class="form-control">
						<option value="0">Seleccione...</option>
					</select>
                </div>
                <div class="col-2">
                    <label for="matTipo">Tipo de materia</label>
                    <select name="matTipo" id="matTipo" class="form-control">
                        <option value="0">Seleccione...</option>
                        <option value="1">Español</option>
                        <option value="2">Ingles</option>
                        <option value="3">Rubro de Formación</option>
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