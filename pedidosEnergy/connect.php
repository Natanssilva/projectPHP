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
    error_reporting(0);

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

//cria uma variavel com resultado da query e dps cria uma variavel pra armazenar o 
//pra acessar o método fetchALL do objeto $resultado.
//fetchAll() é um método  para recuperar TODOS os resultados de uma consulta ao banco de dados como um conjunto de registros. 
//Isso significa que ele irá buscar todos os registros retornados pela consulta e armazená-los

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

$query_incluir_pedidos = "INSERT INTO item_pedido";

// var_dump($query_item);
//showArray($item_pedido);

//  var_dump($item_pedido);


