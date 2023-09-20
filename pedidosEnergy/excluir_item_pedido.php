<?php
require_once 'connect.php';

$numero_pedido = $_GET['numero_pedido'];
$seq_item = $_GET['seq_item'];

echo "<br>o Numero do pedido é: " . $numero_pedido;
echo "<br>Numero de sequencia do item do pedido é: " . $seq_item;
