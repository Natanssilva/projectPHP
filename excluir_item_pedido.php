<?php
require_once 'connect.php';

$numero_pedido = $_GET['numero_pedido'];
$seq_item = $_GET['seq_item'];

// echo "<br>o Numero do pedido é: " . $numero_pedido;
// echo "<br>Numero de sequencia do item do pedido é: " . $seq_item;

$query_excluir_item = "DELETE FROM item_pedido WHERE num_pedido = $numero_pedido and num_seq_item = $seq_item;";
$resultado_query_excluir_item = $ligacao -> query($query_excluir_item);
$excluir_item = $resultado_query_excluir_item ->fetch();

echo "<h1> Item do pedido excluido</h1>"; 
echo "<a href = 'gerenciar-pedidos.php'>[VOLTAR]</h1>"; 

