<?php
   $servidor = "mysql.inf.uct.cl";
   $user     = "miguel_fernandez";
   $password = "cHEYMQNcNi68Ml8nX";
   $basedato = "A2021_miguel_fernandez";
   
   
$db = mysqli_connect($servidor, $user, $password, $basedato);

   if(!$db) {
         echo "Error de conexión a la BD";
         exit();
   }
?>