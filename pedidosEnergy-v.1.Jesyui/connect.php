<?php

$database = "pedidos_energy";
$username = "root";
$password = "natanporto2003";

//verifica se foi conectado certo
//usando try catch pra tratar exceções

try {  //tenta conectar no database, caso de erro intorrompe e vai pro bloco catch
    $ligacao = new PDO("mysql:host=localhost;dbname=$database", $username, $password);
    $estado = $ligacao->getAttribute(PDO::ATTR_CONNECTION_STATUS);    // essa função retorna um atributo d status da conexão do db, verifica se foi com sucesso
    //echo "Database conectado. $estado";   // caso conecte retorna na tela
    

    //no bloco catch ele captura os erros do try e trata esses erros

} catch (PDOException $estado) {  //captura uma exceção de $estado 
    echo " Erro de conexão com o database";
    error_reporting(0);
}


$query = "SELECT p.num_pedido, c.nom_cliente
          FROM pedido AS p
          LEFT JOIN cliente AS c ON (p.cod_cliente = c.cod_cliente);";

//seleciona o pedido.num_pedido e cliente.nom_cliente e relaciona as tabelas
//retornando o num_pedido e nome do cliente de acordo com pedido

$resultado = $ligacao->query($query);
$pedido_nome_cliente  = $resultado->fetchAll();


function showArray($array) //Função pra melhorar a visualização de array
{
    echo "<pre>";

    print_r($array);

    echo "</pre>";
}


$query_item = "SELECT p.num_pedido,i.num_seq_item, i.cod_item,it.den_item,i.qtd_solicitada,pre_unitario
                FROM pedido AS p 
                JOIN item_pedido AS i ON (p.num_pedido = i.num_pedido)
                JOIN item AS it ON  (i.cod_item = it.cod_item);";

//pega informações dos itens/pedido

$resultado_item = $ligacao->query($query_item);
//variavel com resultado da query 

//$item_incluir_item = $resultado_item-> fetchAll();


while ($item  = $resultado_item->fetch()) {
    //showArray($item);
    $item['total_itens'] = $item['pre_unitario'] * $item['qtd_solicitada'];
    $item_pedido[$item['num_pedido']][] = $item;


  
}


$val_get = $_GET;
if (count($val_get) > 0) {
    $val_get = $val_get['num_pedido'];
} else {
    $val_get = "";
}