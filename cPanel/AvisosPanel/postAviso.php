<?php
session_start();
if ($_POST["tipoAviso"] == "general") {
    avisos_generales($_POST["titulo"], $_POST["asunto"], $_POST["fechaI"], $_POST["fechaF"], $_SESSION['IDUSER']);
} elseif ($_POST["tipoAviso"] == "grupo") {
    avisos_grupo($_POST["titulo"], $_POST["asunto"], $_POST["fechaI"], $_POST["fechaF"], $_SESSION['IDUSER'], $_POST["grupo"]);
} elseif ($_POST["tipoAviso"] == "nivel") {
    avisos_nivel($_POST["titulo"], $_POST["asunto"], $_POST["fechaI"], $_POST["fechaF"], $_SESSION['IDUSER'], $_POST["nivel"]);
} elseif ($_POST["tipoAviso"] == "alumno") {
    avisos_alumno($_POST["titulo"], $_POST["asunto"], $_POST["fechaI"], $_POST["fechaF"], $_SESSION['IDUSER'], $_POST["alumno"]);
}

function avisos_generales($title, $body, $fechai, $fechaf, $idadmin)
{
    include "../../conexion.php";

    $sql1 = "INSERT INTO tbl_avisosgenerales(titulo_aviso,descripcion_aviso,fecha_inicial,fecha_final,id_admin,existe) VALUES('{$title}','{$body}','{$fechai}','{$fechaf}',$idadmin,1)";
    if (mysqli_query($conexion, $sql1) == true) {

        $sql = "SELECT TOKEN FROM tbl_usuarios WHERE USUTIPO = 'A' AND EXISTE = 1 AND TOKEN <> '' AND LENGTH(TOKEN) < 50 ";
        $result = mysqli_query($conexion, $sql);
        $tokens = array();

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $tokens[] = $row["TOKEN"];
            }
            $message = array('Message' => " La institucion acaba de publicar un aviso, Veelo ahora!!", 'Title' => $title, 'content' => $body, 'FechaI' => $fechai, 'FechaF' => $fechaf);
            $tipo = "Aviso General";
            $response = sendMessage($tokens, $message, $tipo);
            $return["allresponses"] = $response;
            $return = json_encode($return);

            print("\n\nJSON received:\n");
            print($return);
            print("\n");
            echo "<script language='javascript'>";
            echo "alert('Aviso Emitido Correctamente');";
            echo "window.location.href='index.php';";
            echo "</script>";
        } else {
            echo "<script language='javascript'>";
            echo "alert('Aviso Emitido Correctamente:: No hay usuarios para recibir avisos');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    }
}
function avisos_nivel($title, $body, $fechai, $fechaf, $idadmin, $nivel)
{
    include "../../conexion.php";
    $sql1 = "INSERT INTO tbl_avisos_nivel(titulo_aviso,descripcion_aviso,fecha_inicial,fecha_final,id_admin,nivel,existe) VALUES('{$title}','{$body}','{$fechai}','{$fechaf}',$idadmin,$nivel,1)";
    if (mysqli_query($conexion, $sql1) == true) {
        $sql = "SELECT TOKEN FROM tbl_usuarios, tbl_alumnos WHERE USUTIPO = 'A' AND tbl_usuarios.EXISTE = 1 AND TOKEN <> '' AND tbl_alumnos.NIVEL=$nivel AND tbl_alumnos.ID_USUARIO = tbl_usuarios.ID_USUARIO AND LENGTH(TOKEN) < 50";
        $result = mysqli_query($conexion, $sql);
        $tokens = array();

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $tokens[] = $row["TOKEN"];
            }
            $message = array('Message' => " La institucion acaba de publicar un aviso, Veelo ahora!!", 'Title' => $title, 'body' => $body, 'FechaI' => $fechai, 'FechaF' => $fechaf);
            if ($nivel == 1) {
                $tipo = "Aviso para Preescolar";
            } else {
                $tipo = "Aviso para Primaria";
            }
            $message_status = sendMessage($tokens, $message, $tipo);
            echo $message_status;
            echo "<script language='javascript'>";
            echo "alert('Aviso Emitido Correctamente');";
            echo "window.location.href='index.php';";
            echo "</script>";
        } else {
            echo "<script language='javascript'>";
            echo "alert('Aviso Emitido Correctamente:: No hay usuarios para recibir avisos');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    }
}
function avisos_grupo($title, $body, $fechai, $fechaf, $idadmin, $grado)
{
    include "../../conexion.php";
    $sql1 = "INSERT INTO tbl_avisos_grupo(titulo_aviso,descripcion_aviso,fecha_inicial,fecha_final,id_admin,id_grupo,existe) VALUES('{$title}','{$body}','{$fechai}','{$fechaf}',$idadmin,$grado,1)";
    if (mysqli_query($conexion, $sql1) == true) {
        $sql = "SELECT TOKEN FROM tbl_usuarios, tbl_alumnos, tbl_asignaciongrupos WHERE USUTIPO = 'A' AND tbl_usuarios.EXISTE = 1 AND TOKEN <> '' AND tbl_alumnos.ID_USUARIO = tbl_usuarios.ID_USUARIO AND tbl_asignaciongrupos.ID_GRUPO = $grado AND tbl_asignaciongrupos.ID_ALUMNO = tbl_alumnos.ID_ALUMNO AND LENGTH(TOKEN) < 50";
        $result = mysqli_query($conexion, $sql);
        $tokens = array();

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $tokens[] = $row["TOKEN"];
            }
            $message = array('Message' => " La institucion acaba de publicar un aviso, Veelo ahora!!", 'Title' => $title, 'body' => $body, 'FechaI' => $fechai, 'FechaF' => $fechaf);
            $tipo = "Aviso para el Grupo";
            $message_status = sendMessage($tokens, $message, $tipo);
            echo $message_status;
            echo "<script language='javascript'>";
            echo "alert('Aviso Emitido Correctamente');";
            echo "window.location.href='index.php';";
            echo "</script>";
        } else {
            echo "<script language='javascript'>";
            echo "alert('Aviso Emitido Correctamente:: No hay usuarios para recibir avisos');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    }
}
function avisos_alumno($title, $body, $fechai, $fechaf, $idadmin, $alumno)
{
    include "../../conexion.php";
    $sql1 = "INSERT INTO tbl_avisos_alumno(titulo_aviso,descripcion_aviso,fecha_inicial,fecha_final,id_admin,id_alumno,existe) VALUES('{$title}','{$body}','{$fechai}','{$fechaf}',$idadmin,$alumno,1)";
    if (mysqli_query($conexion, $sql1) == true) {
        $sql = "SELECT TOKEN FROM tbl_usuarios, tbl_alumnos WHERE USUTIPO = 'A' AND tbl_usuarios.EXISTE = 1 AND TOKEN <> '' AND tbl_alumnos.ID_ALUMNO=$alumno AND tbl_alumnos.ID_USUARIO = tbl_usuarios.ID_USUARIO AND LENGTH(TOKEN) < 50";
        $result = mysqli_query($conexion, $sql);
        $tokens = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $tokens[] = $row["TOKEN"];
            }
            $message = array('Message' => " La institucion acaba de publicar un aviso, Veelo ahora!!", 'Title' => $title, 'body' => $body, 'FechaI' => $fechai, 'FechaF' => $fechaf);
            $tipo = "Aviso Personal";
            $message_status = sendMessage($tokens, $message, $tipo);
            echo $message_status;
            echo "<script language='javascript'>";
            echo "alert('Aviso Emitido Correctamente');";
            echo "window.location.href='index.php';";
            echo "</script>";

        } else {
            echo "<script language='javascript'>";
            echo "alert('Aviso Emitido Correctamente:: No hay usuarios para recibir avisos');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    }
}
function sendMessage($tokens, $message, $tipo)
{
    $content = array(
        "en" => $tipo . ': Tienes un nuevo aviso del colegio. Checalo ya! '
    );
    $headings = array(
        "en" => $message["Title"]
    );
    $fields = array(
        'app_id' => "775aebac-196e-43bd-9a15-19903cf07d9d",
        'include_player_ids' => $tokens,
        'data' => $message,
        'contents' => $content,
        'headings' => $headings,
    );

    $fields = json_encode($fields);
    print("\nJSON sent:\n");
    print($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic ZTJiMTIwNDgtZjZmOS00ODBhLTkzOWMtZjBiNTM1ODJlNmRm'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}


?>