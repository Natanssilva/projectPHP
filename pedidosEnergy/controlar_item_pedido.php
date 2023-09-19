<?php
require_once 'connect.php';

$numero_pedido = $_GET['num_pedido'];
echo "<br>numero pedido: " . $numero_pedido;

$seq_item = $_GET['seq_item'];
echo "<br>numero de sequencia de item é: " . $seq_item;