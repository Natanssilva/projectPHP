<?php
    require_once('connect.php');

//query pra trazer os pedidos realizados

$query_busca_pedido = 'SELECT p.num_pedido, p.cod_cliente,c.nom_cliente
                        FROM pedido AS p
                        left JOIN cliente AS c ON p.cod_cliente = c.cod_cliente;';

$resultado_busca_pedido = $ligacao -> query($query_busca_pedido);

$busca_pedido = $resultado_busca_pedido -> fetchAll();

// showArray($busca_pedido);

foreach ($busca_pedido as $value) {

    $data[] = [
        "nome_cliente" => $value['nom_cliente'],
        "idpedido" => $value['num_pedido']
    ];
}

// showArray($data);
// showArray(json_encode($busca_pedido));
echo json_encode($data);
//showArray($value);



