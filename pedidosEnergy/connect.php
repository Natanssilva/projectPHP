<?php

$database = "pedidos_energy";
$username = "root";
$password = "natanporto2003";

//verifica se foi conectado certo
//usando try catch pra tratar exceções

try {  //tenta conectar n0 database, caso de erro intorrompe e vai pro bloco catch
    $ligacao = new PDO("mysql:host=localhost;dbname=$database", $username, $password);
    $estado = $ligacao->getAttribute(PDO::ATTR_CONNECTION_STATUS);    // essa função retorna um atributo d status da conexão do db, verifica se foi com sucesso
    echo "Database conectado. $estado";   // caso conecte retorna na tela

    //no bloco catch ele captura os erros do try e trata esses erros

} catch (PDOException $estado) {  //captura uma exceção de $estado 
    echo " Erro de conexão com o database";
}


$query = "SELECT p.num_pedido, c.nom_cliente
    FROM pedido AS p
    LEFT JOIN cliente AS c ON (p.cod_cliente = c.cod_cliente);";
    
    $resultado = $ligacao->query($query);
    $pedido_nome_cliente  = $resultado->fetchAll();

    
// echo('<pre>');
// var_dump($pedido_nome_cliente);
// echo('</pre>');

