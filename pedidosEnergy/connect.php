<?php


 $database = "pedidos_energy";
 $username = "root";
 $password = "natanporto2003";

 $ligacao = new PDO("mysql:host=localhost;dbname=$database", $username, $password);

 //verifica se foi conectado certo


 $estado = $ligacao->getAttribute(PDO::ATTR_CONNECTION_STATUS);
 echo "rodou fiii $estado";


 
?>

