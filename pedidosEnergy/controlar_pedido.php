<?php
// require_once 'gerenciar-pedidos.php';
require_once 'connect.php';
//vai passar o numero como parametro do pedido

$num_pedido = $_GET['numero_pedido'];
showArray($num_pedido);
