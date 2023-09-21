<?php
require_once 'connect.php';


$numero_pedido_exclusao = $_GET['numero_pedido'];
//showArray($numero_pedido_exclusao);

$query_exclusao_pedido = "DELETE FROM pedido WHERE num_pedido = $numero_pedido_exclusao;";
$resultado_exclusao = $ligacao->query($query_exclusao_pedido);
$excluir_pedidos = $resultado_exclusao -> fetch();

echo "<h1> PEDIDO EXCLUIDO</h1>"; 
echo "<a href = 'gerenciar-pedidos.php'>[VOLTAR]</h1>"; 
