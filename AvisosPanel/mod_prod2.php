<?php 
Session_start();
if(isset($_GET["ref"])){
    if($_GET["ref"]=="del"){
        eliminarAviso($_GET["id"],$_GET["tipo"]);
    }elseif ($_GET["ref"]=="resend") {
        reenviarAviso($_GET["id"],$_GET["type"]);
    }elseif($_GET["ref"] == "mod"){
        if($_POST["tipoAviso"]=="general"){avisos_generales($_POST["idAviso"],$_POST["titulo"],$_POST["asunto"],$_POST["fechaI"],$_POST["fechaF"], $_SESSION['IDUSER']);}
        elseif ($_POST["tipoAviso"]=="grupo") {avisos_grupo($_POST["idAviso"],$_POST["titulo"],$_POST["asunto"],$_POST["fechaI"],$_POST["fechaF"], $_SESSION['IDUSER'],$_POST["grupo"]);}
        elseif($_POST["tipoAviso"]=="nivel"){avisos_nivel($_POST["idAviso"],$_POST["titulo"],$_POST["asunto"],$_POST["fechaI"],$_POST["fechaF"],$_SESSION['IDUSER'],$_POST["nivel"]);}
        elseif($_POST["tipoAviso"]=="alumno"){avisos_alumno($_POST["idAviso"],$_POST["titulo"],$_POST["asunto"],$_POST["fechaI"],$_POST["fechaF"],$_SESSION['IDUSER'],$_POST["alumno"]);}
    }
}

function eliminarAviso($idaviso,$tipo){
    include "../conexion.php";
    switch ($tipo) {
        case 1:
            $sql = "UPDATE tbl_avisosgenerales SET EXISTE = 0 WHERE ID_AVISO = {$idaviso}";
            if($conexion -> query($sql) === TRUE){
                echo "<script language='javascript'>";
                echo "alert('Aviso eliminado correctamente');";
                echo "window.location.href='index.php';";
                echo "</script>";
            }
            break;
        case 2:
            $sql = "UPDATE tbl_avisos_nivel SET EXISTE = 0 WHERE ID_AVISO = {$idaviso}";
            if($conexion -> query($sql) === TRUE){
                echo "<script language='javascript'>";
                echo "alert('Aviso eliminado correctamente');";
                echo "window.location.href='index.php';";
                echo "</script>";
            }
            break;
        case 3:
            $sql = "UPDATE tbl_avisos_grupo SET EXISTE = 0 WHERE ID_AVISO = {$idaviso}";
            if($conexion -> query($sql) === TRUE){
                echo "<script language='javascript'>";
                echo "alert('Aviso eliminado correctamente');";
                echo "window.location.href='index.php';";
                echo "</script>";
            }
            break;
        case 4:
            $sql = "UPDATE tbl_avisos_alumno SET EXISTE = 0 WHERE ID_AVISO = {$idaviso}";
            if($conexion -> query($sql) === TRUE){
                echo "<script language='javascript'>";
                echo "alert('Aviso eliminado correctamente');";
                echo "window.location.href='index.php';";
                echo "</script>";
            }
            break;
    }
}

function reenviarAviso($idaviso,$tipo){
    include "../conexion.php";

    switch ($tipo) {
        case 1:
            $sql = "SELECT * FROM tbl_avisosgenerales WHERE ID_AVISO = $idaviso";
            $reg = mysqli_fetch_array($conexion -> query($sql));
            
            $sql = "SELECT TOKEN FROM tbl_usuarios WHERE USUTIPO = 'A' AND EXISTE = 1 AND TOKEN <> '' AND LENGTH(TOKEN) < 50 ";
            $result = mysqli_query($conexion,$sql);
            $tokens = array();
            $tipo = "Aviso General";
            break;
        case 2:
        $sql = "SELECT * FROM tbl_avisos_nivel WHERE ID_AVISO = $idaviso";
        $reg = mysqli_fetch_array($conexion -> query($sql));

        $sql = "SELECT TOKEN FROM tbl_usuarios, tbl_alumnos WHERE USUTIPO = 'A' AND tbl_usuarios.EXISTE = 1 AND TOKEN <> '' AND tbl_alumnos.NIVEL=$reg[6] AND tbl_alumnos.ID_USUARIO = tbl_usuarios.ID_USUARIO AND LENGTH(TOKEN) < 50";
        $result = mysqli_query($conexion,$sql);
        $tokens = array();
        if($reg[6] == 1){
            $tipo = "Aviso para Preescolar";
        }else{
            $tipo = "Aviso para Primaria";
        }
            break;
        case 3:
        $sql = "SELECT * FROM tbl_avisos_grupo WHERE ID_AVISO = $idaviso";
        $reg = mysqli_fetch_array($conexion -> query($sql));

        $sql = "SELECT TOKEN FROM tbl_usuarios, tbl_alumnos, tbl_asignaciongrupos WHERE USUTIPO = 'A' AND tbl_usuarios.EXISTE = 1 AND TOKEN <> '' AND tbl_alumnos.ID_USUARIO = tbl_usuarios.ID_USUARIO AND tbl_asignaciongrupos.ID_GRUPO = $reg[6] AND tbl_asignaciongrupos.ID_ALUMNO = tbl_alumnos.ID_ALUMNO AND LENGTH(TOKEN) < 50";
        $result = mysqli_query($conexion,$sql);
        $tokens = array();
        $tipo = "Aviso para el Grupo";
            break;
        case 4:
        $sql = "SELECT * FROM tbl_avisos_alumno WHERE ID_AVISO = $idaviso";
        $reg = mysqli_fetch_array($conexion -> query($sql));

        $sql = "SELECT TOKEN FROM tbl_usuarios, tbl_alumnos WHERE USUTIPO = 'A' AND tbl_usuarios.EXISTE = 1 AND TOKEN <> '' AND tbl_alumnos.ID_ALUMNO=$reg[6] AND tbl_alumnos.ID_USUARIO = tbl_usuarios.ID_USUARIO AND LENGTH(TOKEN) < 50";
        $result = mysqli_query($conexion,$sql);
        $tokens = array();
        $tipo = "Aviso Personal";
            break;
    }

    if(mysqli_num_rows($result) > 0 ){
        while ($row = mysqli_fetch_assoc($result)) {
            $tokens[] = $row["TOKEN"];
        }
        $message = array('Message' => " La institucion acaba de publicar un aviso, Veelo ahora!!", 'Title' =>$reg[1], 'body' =>substr($reg[2],0,50), 'FechaI' => $reg[3], 'FechaF' => $reg[4]);
        $response = sendMessage($tokens, $message,$tipo);
        $return["allresponses"] = $response;
        $return = json_encode( $return);
        
        print("\n\nJSON received:\n");
        print($return);
        print("\n");
        echo "<script language='javascript'>"; 
        echo "alert('Aviso Emitido Correctamente');";
        echo "window.location.href='index.php';";
        echo "</script>";
    }else{
        echo "<script language='javascript'>"; 
        echo "alert('Aviso Emitido Correctamente:: No hay usuarios para recibir avisos');";
        echo "window.location.href='index.php';";
        echo "</script>";
    }
}

function sendMessage($tokens, $message, $tipo){
    $content = array(
        "en" => $tipo.': Tienes un nuevo aviso del colegio. Checalo ya! '
        );
    $headings = array(
        "en" =>$message["Title"]
    );
    $fields = array(
        'app_id' => "775aebac-196e-43bd-9a15-19903cf07d9d",
        'include_player_ids' => $tokens,
        'data' => array("foo" => "bar"),
        'contents' => $content,
        'headings' => $headings
    );
    
    $fields = json_encode($fields);
    print("\nJSON sent:\n");
    print($fields);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                               'Authorization: Basic ZTJiMTIwNDgtZjZmOS00ODBhLTkzOWMtZjBiNTM1ODJlNmRm'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;
}

function avisos_generales($id,$title,$body,$fechai,$fechaf,$idadmin){
    include "../conexion.php";
    $sql = "UPDATE tbl_avisosgenerales SET TITULO_AVISO='{$title}', DESCRIPCION_AVISO='{$body}', FECHA_INICIAL='{$fechai}',	FECHA_FINAL='{$fechaf}', ID_ADMIN=$idadmin WHERE ID_AVISO = $id";
    if($conexion -> query($sql) == TRUE){
        if(isset($_POST["notificar"])){
            $sql = "SELECT TOKEN FROM tbl_usuarios WHERE USUTIPO = 'A' AND EXISTE = 1 AND TOKEN <> '' AND LENGTH(TOKEN) < 50 ";
            $result = mysqli_query($conexion,$sql);
            $tokens = array();

            if(mysqli_num_rows($result) > 0 ){
                while ($row = mysqli_fetch_assoc($result)) {
                    $tokens[] = $row["TOKEN"];
                }
                $message = array('Message' => " La institucion acaba de publicar un aviso, Veelo ahora!!", 'Title' =>$title, 'body' =>$body, 'FechaI' => $fechai, 'FechaF' => $fechaf);
                $tipo = "Aviso General";
                $response = sendMessage($tokens, $message, $tipo);
                $return["allresponses"] = $response;
                $return = json_encode( $return);
                
                print("\n\nJSON received:\n");
                print($return);
                print("\n");
                echo "<script language='javascript'>"; 
                echo "alert('Aviso Modificado y Emitido Correctamente');";
                echo "window.location.href='index.php';";
                echo "</script>";
            }else{
                echo "<script language='javascript'>"; 
                echo "alert('Aviso Modificado y Emitido Correctamente:: No hay usuarios para recibir avisos');";
                echo "window.location.href='index.php';";
                echo "</script>";
            }
        }else{
                echo "<script language='javascript'>"; 
                echo "alert('Aviso Modificado Correctamente');";
                echo "window.location.href='index.php';";
                echo "</script>";
        }
    }
}
function avisos_nivel($id,$title,$body,$fechai,$fechaf,$idadmin,$nivel){
    include "../conexion.php";
    $sql = "UPDATE tbl_avisos_nivel SET TITULO_AVISO='{$title}', DESCRIPCION_AVISO='{$body}', FECHA_INICIAL='{$fechai}',	FECHA_FINAL='{$fechaf}', ID_ADMIN=$idadmin, NIVEL=$nivel WHERE ID_AVISO = $id";
    if($conexion -> query($sql) == TRUE){
        if(isset($_POST["notificar"])){
            $sql = "SELECT TOKEN FROM tbl_usuarios, tbl_alumnos WHERE USUTIPO = 'A' AND tbl_usuarios.EXISTE = 1 AND TOKEN <> '' AND tbl_alumnos.NIVEL=$nivel AND tbl_alumnos.ID_USUARIO = tbl_usuarios.ID_USUARIO AND LENGTH(TOKEN) < 50";
            $result = mysqli_query($conexion,$sql);
            $tokens = array();

            if(mysqli_num_rows($result) > 0 ){
                while ($row = mysqli_fetch_assoc($result)) {
                    $tokens[] = $row["TOKEN"];
                }
                $message = array('Message' => " La institucion acaba de publicar un aviso, Veelo ahora!!", 'Title' =>$title, 'body' =>$body, 'FechaI' => $fechai, 'FechaF' => $fechaf);
                if($nivel == 1){
                    $tipo = "Aviso para Preescolar";
                }else{
                    $tipo = "Aviso para Primaria";
                }
                $message_status = sendMessage($tokens, $message, $tipo);
                echo $message_status;
                echo "<script language='javascript'>"; 
                echo "alert('Aviso Modificado y Emitido Correctamente');";
                echo "window.location.href='index.php';";
                echo "</script>";
            }else{
                echo "<script language='javascript'>"; 
                echo "alert('Aviso Modificado y Emitido Correctamente:: No hay usuarios para recibir avisos');";
                echo "window.location.href='index.php';";
                echo "</script>";
            }
        }else{
            echo "<script language='javascript'>"; 
                echo "alert('Aviso Modificado Correctamente');";
                echo "window.location.href='index.php';";
                echo "</script>";
        }
    }
}
function avisos_grupo($id,$title,$body,$fechai,$fechaf,$idadmin,$grado){
    include "../conexion.php";

    $sql = "UPDATE tbl_avisos_grupo SET TITULO_AVISO='{$title}', DESCRIPCION_AVISO='{$body}', FECHA_INICIAL='{$fechai}', FECHA_FINAL='{$fechaf}', ID_ADMIN=$idadmin, ID_GRUPO=$grado WHERE ID_AVISO = $id";
    if($conexion -> query($sql) == TRUE){
        if(isset($_POST["notificar"])){
            $sql = "SELECT TOKEN FROM tbl_usuarios, tbl_alumnos, tbl_asignaciongrupos WHERE USUTIPO = 'A' AND tbl_usuarios.EXISTE = 1 AND TOKEN <> '' AND tbl_alumnos.ID_USUARIO = tbl_usuarios.ID_USUARIO AND tbl_asignaciongrupos.ID_GRUPO = $grado AND tbl_asignaciongrupos.ID_ALUMNO = tbl_alumnos.ID_ALUMNO AND LENGTH(TOKEN) < 50";
            $result = mysqli_query($conexion,$sql);
            $tokens = array();

            if(mysqli_num_rows($result) > 0 ){
                while ($row = mysqli_fetch_assoc($result)) {
                    $tokens[] = $row["TOKEN"];
                }
                $message = array('Message' => " La institucion acaba de publicar un aviso, Veelo ahora!!", 'Title' =>$title, 'body' =>$body, 'FechaI' => $fechai, 'FechaF' => $fechaf);
                $tipo = "Aviso para el Grupo";
                $message_status = sendMessage($tokens, $message, $tipo);
                echo $message_status;
                echo "<script language='javascript'>"; 
                echo "alert('Aviso Modificado y Emitido Correctamente');";
                echo "window.location.href='index.php';";
                echo "</script>";
            }else{
                echo "<script language='javascript'>"; 
                echo "alert('Aviso Modificado y Emitido Correctamente:: No hay usuarios para recibir avisos');";
                echo "window.location.href='index.php';";
                echo "</script>";
            }
        }else{
            echo "<script language='javascript'>"; 
                echo "alert('Aviso Modificado Correctamente');";
                echo "window.location.href='index.php';";
                echo "</script>";
        }
    }
}
function avisos_alumno($id,$title,$body,$fechai,$fechaf,$idadmin,$alumno){
    include "../conexion.php";

    $sql = "UPDATE tbl_avisos_alumno SET TITULO_AVISO='{$title}', DESCRIPCION_AVISO='{$body}', FECHA_INICIAL='{$fechai}', FECHA_FINAL='{$fechaf}', ID_ADMIN=$idadmin, ID_ALUMNO=$alumno WHERE ID_AVISO = $id";
    if($conexion -> query($sql) == TRUE){
        if(isset($_POST["notificar"])){
            $sql = "SELECT TOKEN FROM tbl_usuarios, tbl_alumnos WHERE USUTIPO = 'A' AND tbl_usuarios.EXISTE = 1 AND TOKEN <> '' AND tbl_alumnos.ID_ALUMNO=$alumno AND tbl_alumnos.ID_USUARIO = tbl_usuarios.ID_USUARIO AND LENGTH(TOKEN) < 50";
            $result = mysqli_query($conexion,$sql);
            $tokens = array();
            if(mysqli_num_rows($result) > 0 ){
                while ($row = mysqli_fetch_assoc($result)) {
                    $tokens[] = $row["TOKEN"];
                }
                $message = array('Message' => " La institucion acaba de publicar un aviso, Veelo ahora!!", 'Title' =>$title, 'body' =>$body, 'FechaI' => $fechai, 'FechaF' => $fechaf);
                $tipo = "Aviso Personal";
                $message_status = sendMessage($tokens, $message,$tipo);
                echo $message_status;
                echo "<script language='javascript'>"; 
                echo "alert('Aviso Modificado y Emitido Correctamente');";
                echo "window.location.href='index.php';";
                echo "</script>";
            }else{
                echo "<script language='javascript'>"; 
                echo "alert('Aviso Modificado y Emitido Correctamente:: No hay usuarios para recibir avisos');";
                echo "window.location.href='index.php';";
                echo "</script>";
            }
        }else{
            echo "<script language='javascript'>"; 
                echo "alert('Aviso Modificado Correctamente');";
                echo "window.location.href='index.php';";
                echo "</script>";
        }
    }
}
?>