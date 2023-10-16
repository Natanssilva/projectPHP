<?php

if ($_POST['salvar_pedido']) {
    $query_incluir_pedido = 'INSERT INTO pedido (cod_cliente) VALUES (0);';
    $resultado_incluir_pedido = $ligacao->query($query_incluir_pedido); 
    $dados_inclusao = $ligacao -> lastInsertId();
    
    $numero_pedido_inclusao = $ligacao -> lastInsertId($pedido_nome_cliente['num_pedido']);

    
}





