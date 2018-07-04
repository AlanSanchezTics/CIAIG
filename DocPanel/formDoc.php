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
        #message{
            display: none;
        }
    </style>
    <script>
        function verify() {
            if(document.getElementById('clave').value == document.getElementById('cclave').value){
                document.getElementById('formulario').submit();
                return true;
            }else{
                document.getElementById("message").style.display = "block";
                document.getElementById('clave').focus();
                return false;
            }
        }
    </script>
</head>
<body>
    <div class="section-header">
        <h2 class="wow fadeInDown animated title">Registro de Docente</h2>
    </div>
    <div style="width: 100%; margin-left: 25%; margin-top: 20pt;">
            <form action="nuevo_prod2.php" method="POST" enctype="multipart/form-data" id="formulario"  onsubmit=" return verify();">
                <div class="col-6">
                        <div class="alert alert-danger" role="alert" id="message" align='center'>Las contraseñas no coinciden!!</div>
                        <?php 
                            if(isset($_GET['ref'])){
                                if($_GET['ref']==='invaliddoc'){
                                    echo "<div class='alert alert-danger' role='alert'  align='center'>Docente ya registrado!!</div>";
                                }else if($_GET['ref']==='invaliduser'){
                                    echo "<div class='alert alert-danger' role='alert' align='center'>Nombre de usuario ya registrado!!</div>";
                                }else if($_GET['ref']==='successdoc'){
                                    echo "<div class='alert alert-success' role='alert' align='center'>Docente registrado correctamente!!</div>";
                                }
                            }
                        ?>
                    </div>
                    <div class="form-row">
                            <div class="col-2">
                                <label for="nombre">Nombre(s)</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" required placeholder="Nombre(s)">
                            </div>
                            <div class="col-2">
                                <label for="apaterno">Apellido Parerno</label>
                                <input type="text" class="form-control" name="apaterno" required id="apaterno" placeholder="Apellido Paterno">
                            </div>
                            <div class="col-2">
                                <label for="amaterno">Apellido Materno</label>
                                <input type="text" class="form-control" name="amaterno" required id="amaterno" placeholder="Apellido Materno">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-3">
                                <label for="telefono">Telefono</label>
                                <input type="text" name="telefono" id="telefono" class="form-control" placeholder="telefono">
                            </div>
                            <div class="col-3">
                                <label for="email">Correo Electronico</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Correo Electronico">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-2">
                                <label for="user">Usuario</label>
                                <input type="text" name="user" required id="user" class="form-control" placeholder="Usuario">
                            </div>
                            <div class="col-2">
                                <label for="clave">Contraseña</label>
                                <input type="password" name="clave" required id="clave" class="form-control" placeholder="Contraseña">
                            </div>
                            <div class="col-2">
                                <label for="cclave">Confirmar Contraseña</label>
                                <input type="password" name="cclave" id="cclave" required class="form-control" placeholder="Confirmar Contraseña">
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