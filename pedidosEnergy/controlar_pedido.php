<?php
require_once 'gerenciar-pedidos.php';
//vai passar o numero como parametro do pedido

foreach ($pedido_nome_cliente as $pedido) {
    $numero_pedido = $pedido['num_pedido'];
    $parametros = ['order_pedido' => $numero_pedido];
    $query_string = http_build_query($parametros);
    
    // Criar o link com o número do pedido como parâmetro
    $url_completa = 'controlar_pedido.php?' . $query_string;
   
}
