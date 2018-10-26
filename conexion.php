<?php
  $conexion = new mysqli('localhost', 'root', '', 'u720362080_ciaig');
  date_default_timezone_set("America/Mexico_city");
  //$conexion = new mysqli('localhost', 'u720362080_root', 'HNROPO2QtMlR', 'u720362080_ciaig');
  $tildes = $conexion->query("SET NAMES 'utf8'");
  ?>