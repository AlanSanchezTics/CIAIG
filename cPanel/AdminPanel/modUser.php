<?php
    if(isset($_GET['idref'])){
        include "../../conexion.php";
        $sql = "SELECT LOGIN FROM tbl_usuarios WHERE ID_USUARIO='{$_GET['idref']}'";
        $tildes = $conexion->query("SET NAMES 'utf8'");
        $reg = mysqli_fetch_array(mysqli_query($conexion, $sql));
    }
?>
<!DOCTYPE html>
<html lang="en">
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
            if(document.getElementById('cclave').value == document.getElementById('ccclave').value){
                document.getElementById('formulario').submit();
                return true;
            }else{
                document.getElementById("message").style.display = "block";
                document.getElementById('cclave').focus();
                return false;
            }
        }
    </script>
</head>
<body>
    <div class="section-header">
        <h2 class="wow fadeInDown animated title">Modifcación de Usuario</h2>
    </div>
        <div style="width: 100%; margin-left:20%; margin-top: 20pt;">
    <form action="modif_prod2.php?ref=modu" method="POST" enctype="multipart/form-data" id="formulario"  onsubmit=" return verify();">
    <input type="hidden" name="id_admin" value="<?php echo $_GET['idref'] ?>">
        <div class="col-6">
            <div class="alert alert-danger" role="alert" id="message" align='center'>Las contraseñas no coinciden!!</div>
            <?php 
                if(isset($_GET['ref'])){
                    if($_GET['ref']=='invaliduser'){
                        echo "<div class='alert alert-danger' role='alert'  align='center'>usuario ya registrado!!</div>";
                    }else if($_GET['ref']=='invalidpassword'){
                        echo "<div class='alert alert-danger' role='alert'  align='center'>la contraseña no coincide!!</div>";
                    }
                }
            ?>
        </div>
        <div class="form-row">
            <div class="col-2">
                <label for="user">Usuario</label>
                <?php
                    if(isset($_GET['ref']) & isset($_GET['usuref'])){
                        $user = $_GET['usuref'];
                        echo "<input type='text' value='$user' name='user' required id='user' class='form-control' placeholder='Usuario'>";
                    }else{
                        echo "<input type='text' value='$reg[0]' name='user' required id='user' class='form-control' placeholder='Usuario'>";
                    }
                ?>
            </div>
            <div class="col-2">
                <label for="clave">Contraseña anterior</label>
                <input type="password" name="clave" required id="clave" class="form-control" placeholder="Contraseña">
            </div>
            <div class="col-2">
                <label for="cclave">Nueva Contraseña</label>
                <input type="password" name="cclave" id="cclave" required class="form-control" placeholder="Confirmar Contraseña">
            </div>
            <div class="col-3">
                <label for="ccclave">Confirmar nueva Contraseña</label>
                <input type="password" name="ccclave" id="ccclave" required class="form-control" placeholder="Confirmar Contraseña">
            </div>
        </div>
        <div class="form-row">
                <div class="col-3">
                    <button type="submit" id="submit" name="send" class="btn btn-primary btn-lg btn-block" style="border-radius: 5pt; margin-top: 20px;">Actualizar Usuario</button>
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