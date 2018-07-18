<?php
    session_start();
    postTarea($_POST["titulo"],$_POST["asunto"],$_POST["fechaI"],$_POST["fechaF"],$_POST["grupo"],$_POST["materia"]);
    function postTarea($titulo,$contenido,$fechaI,$fechaF,$grupo,$materia)
    {
        include "../../conexion.php";
        $sql ="INSERT INTO tbl_tareas(titulo_tarea,descripcion_tarea,fecha_creacion,fecha_entrega,id_grupo,tipo_tarea,id_docente,existe) VALUES('{$titulo}','{$contenido}','{$fechaI}','{$fechaF}',$grupo,'{$materia}',".$_SESSION['IDUSER'].",1)";
        if ($conexion->query($sql) === TRUE) 
        {
            $sql = "SELECT TOKEN FROM tbl_usuarios, tbl_alumnos, tbl_asignaciongrupos WHERE USUTIPO = 'A' AND tbl_usuarios.EXISTE = 1 AND TOKEN <> '' AND tbl_alumnos.ID_USUARIO = tbl_usuarios.ID_USUARIO AND tbl_asignaciongrupos.ID_GRUPO = $grupo AND tbl_asignaciongrupos.ID_ALUMNO = tbl_alumnos.ID_ALUMNO AND LENGTH(TOKEN) < 50";
            $result = mysqli_query($conexion,$sql);
            $tokens = array();

            if(mysqli_num_rows($result) > 0 ){
                while ($row = mysqli_fetch_assoc($result)) {
                    $tokens[] = $row["TOKEN"];
                }
            }
            $message = array('Message' => "Tu docente acaba de subir una tarea, rivisala ahora!!", 'Title' =>$titulo, 'body' =>$contenido, 'FechaI' => $fechaI, 'FechaF' => $fechaF);
                $response = sendMessage($tokens, $message);
                $return["allresponses"] = $response;
                $return = json_encode( $return);
                
                print("\n\nJSON received:\n");
                print($return);
                print("\n");
                echo "<script language='javascript'>"; 
        echo "alert('Tarea Emitida Correctamente');";
        echo "window.location.href='index.php';";
        echo "</script>";
        }else{
        var_dump($sql);
        } 
    }
    function sendMessage($tokens, $message){
		$content = array(
			"en" => 'Tu docente acaba de subir una tarea, rivisala ahora!!'
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
    
    
?>