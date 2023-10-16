<?php
require_once 'connect.php';


$numero_pedido_exclusao = $_GET['numero_pedido'];
//showArray($numero_pedido_exclusao);

$query_exclusao_item_pedido = "DELETE from item_pedido WHERE num_pedido = $numero_pedido_exclusao;";
$resultado_exclusao_item_pedido = $ligacao->query($query_exclusao_item_pedido);
$exclusao_item_pedido = $resultado_exclusao_item_pedido -> fetch();

//DELETE FROM `pedidos_energy`.`item_pedido` WHERE  `num_pedido`=420 AND `num_seq_item`=30;

$query_exclusao_pedido = "DELETE FROM pedido WHERE num_pedido = $numero_pedido_exclusao;";  //criando query pra excluir pedidos
$resultado_exclusao = $ligacao->query($query_exclusao_pedido);
$excluir_pedidos = $resultado_exclusao -> fetch();


echo "<h1> Pedido excluido</h1>"; 
echo "<a href = 'gerenciar-pedidos.php'>[VOLTAR]</h1>"; 
