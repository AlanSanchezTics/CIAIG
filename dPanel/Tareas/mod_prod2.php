<?php
    session_start();
    if($_GET["ref"]=="del"){
        eliminar($_GET["id"]);
    }elseif ($_GET["ref"]=="resend") {
        reenviarTarea($_GET["id"]);
    }

    function eliminar($id)
    {
        include "../../conexion.php";

        $sql = "UPDATE tbl_tareas SET existe = 0 WHERE ID_TAREA = $id";
        if($conexion -> query($sql) == TRUE){
            echo "<script language='javascript'>";
            echo "alert('Tarea eliminada correctamente');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    }

    function reenviarTarea($idTarea)
    {
        include "../../conexion.php";

        $sql = "SELECT * FROM tbl_tareas WHERE ID_TAREA = $idTarea";
        $reg = mysqli_fetch_array($conexion -> query($sql));

        $sql = "SELECT TOKEN FROM tbl_usuarios, tbl_alumnos, tbl_asignaciongrupos WHERE USUTIPO = 'A' AND tbl_usuarios.EXISTE = 1 AND TOKEN <> '' AND tbl_alumnos.ID_USUARIO = tbl_usuarios.ID_USUARIO AND tbl_asignaciongrupos.ID_GRUPO = $reg[5] AND tbl_asignaciongrupos.ID_ALUMNO = tbl_alumnos.ID_ALUMNO AND LENGTH(TOKEN) < 50";
            $result = mysqli_query($conexion,$sql);
            $tokens = array();

            if(mysqli_num_rows($result) > 0 ){
                while ($row = mysqli_fetch_assoc($result)) {
                    $tokens[] = $row["TOKEN"];
                }
            }
            $message = array('Message' => "Tu docente acaba de subir una tarea, rivisala ahora!!", 'Title' =>$reg[1], 'body' =>$reg[2], 'FechaI' => $reg[3], 'FechaF' => $reg[4]);
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
			'data' => $message,
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