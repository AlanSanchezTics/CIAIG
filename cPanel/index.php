
<?php
session_start();
if($_SESSION['IDUSER']== NULL){
    header('Location: ../');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/x-icon" href="../icon.ico">
    <title>Menu Principal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <style>
        body { 
            overflow-X:hidden;
            background-color: rgba(211, 211, 211, 0.185); 
        }
        #title{
            font-family: Arial;
            font-size: 16pt;
            font-weight: bold;
            color: ivory;
        }
        #username{
            font-family: Arial;
            font-size: 12pt;
            font-weight: bold;
            color: ivory;
        }
        .iframe-16-9 {
            position: relative;
            padding-bottom: 56.25%;
            padding-top: 35px;
            height: 0;
            overflow: hidden;
        }
        .iframe-16-9  iframe {
            position: absolute;
            top:0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        aside{
            float: left;
            height: 10%;
        }
        .col-2{
            padding-right: 0px;
        }
        .mnualumnos{
            list-style: none;
            display: none;
        }
        #list-alumnos-list.list-group-item-action.active.show ~  .mnualumnos{
            display: block; 
        }
        .niveles{
            margin-left: 10px;
            border-width: 0px;
        }
        .niveles.active{
            background-color: gold;
            color: black;
        }

    </style>
    <script>
        function cerrar(){
            window.location.href='logout.php';

        }
        function padmin() {
            top.frames['framecontenido'].location='../AdminPanel/index.php';
        }
        function pdocs() {
            top.frames['framecontenido'].location='../DocPanel/index.php';
        }
        function pprim() {
            top.frames['framecontenido'].location='../AlumnosPanel/indexP.php';
        }
        function pprees() {
            top.frames['framecontenido'].location='../AlumnosPanel/indexK.php';
        }
        function pposts() {
            top.frames['framecontenido'].location='../AvisosPanel/index.php';
        }
        function pgrupos() {
            top.frames['framecontenido'].location='../GruposPanel/index.php';
        }
        function pmaterias() {
            top.frames['framecontenido'].location='../MateriasPanel/index.php';
        }
        function home() {
            top.frames['framecontenido'].location='../inicio.html';
        }
        function ralumno(){
            top.frames['framecontenido'].location='../AlumnosPanel/formAlumno.php';
        }
    </script>
</head>
<body scrolling="NO">
    <nav class="navbar navbar-dark bg-primary" >
        <div class="form-inline">
            <img src="../logo.png" width="86" height="86" alt="">
            <span id="title">Control Integrlal del Alumno<br>Indira Gandhi</span>
        </div>
        <div class="form-inline">
                <?php echo "<span id='username'>Usuario: "; echo $_SESSION['USER']; echo "</span>"?>
        </div>
    </nav>
            <div class="row">
                <div class="col-2">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a onclick="home()" class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" onrole="tab" aria-controls="home">Inicio</a>
                        <a class="list-group-item list-group-item-action" id="list-admin-list" data-toggle="list" href="#list-admin" role="tab" aria-controls="admin" onclick="padmin()">Control Administradores</a>
                        <a class="list-group-item list-group-item-action" id="list-docentes-list" data-toggle="list" href="#list-docentes" role="tab" aria-controls="docentes" onclick="pdocs()">Control Docentes</a>
                        <a class="list-group-item list-group-item-action" id="list-alumnos-list" data-toggle="list" href="#list-alumnos" role="tab" aria-controls="alumnos">Panel Alumnos</a>
                            <div class="list-group mnualumnos col-10" id="list-tab" role="tablist">   
                                <a class="list-group-item list-group-item-action niveles" id="list-preescolar-list" data-toggle="list" href="#list-preescolar" role="tab" aria-controls="preescolar" onclick="pprees()">Kinder</a>
                                <a class="list-group-item list-group-item-action niveles" id="list-primaria-list" data-toggle="list" href="#list-primaria" role="tab" aria-controls="primaria" onclick="pprim()">Primaria</a>
                                <a class="list-group-item list-group-item-action niveles" id="list-primaria-list" data-toggle="list" href="#list-primaria" role="tab" aria-controls="primaria" onclick="ralumno()">Registrar Alumno</a>
                            </div> 
                        <a onclick="pposts()" class="list-group-item list-group-item-action" id="list-avisos-list" data-toggle="list" href="#list-avisos" role="tab" aria-controls="avisos">Panel Avisos</a>
                        <a onclick="pgrupos()" class="list-group-item list-group-item-action" id="list-grupos-list" data-toggle="list" href="#list-grupos" role="tab" aria-controls="grupos">Control Grupos</a>
                        <a onclick="pmaterias()" class="list-group-item list-group-item-action" id="list-materias-list" data-toggle="list" href="#list-materias" role="tab" aria-controls="materias">Control Materias</a>
                        <a class="list-group-item list-group-item-action" id="list-logout-list" data-toggle="list" href="#list-logout" onclick="cerrar()" role="tab" aria-controls="logout">Cerrar sesión</a>
                    </div>
                </div>
                <div class="iframe-16-9 col">
                        <iframe src="../inicio.html" name="framecontenido" id="framecontenido" frameborder="0" marginwidth="0" marginheight="0"></iframe>
                </div>
            </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>