<?php

require_once('connect.php');

//query pra trazer os itens dos pedidos
$query_item_pedido = "SELECT ip.num_pedido,ip.num_seq_item, ip.cod_item, ip.qtd_solicitada,it.den_item,it.valor
                        FROM item_pedido AS ip
                        INNER JOIN item AS it on it.cod_item = ip.cod_item
                        Where ip.num_pedido = '{$_POST['cod_pedido']}'";

$resultado_item_pedido = $ligacao->query($query_item_pedido);
$item_pedido = $resultado_item_pedido->fetchAll();

$total_pedido = 0;

foreach ($item_pedido as $it_pedido) {
    $total_item = $it_pedido['valor'] * $it_pedido['qtd_solicitada'];

    $data[] = [
        "nome_item" => $it_pedido['den_item'],
        "qtd_solicitada" =>  number_format($it_pedido['qtd_solicitada']),
        "valor" => "R$" . " " . $it_pedido['valor'],
        "total_item" =>"R$" . " " . $total_item
    ];
   $total_pedido += $total_item;
}

$data[] = [
    "total_pedido" => "R$" . " " . $total_pedido
];




// showArray(($data));
// showArray(json_encode(['rows'=> $data]));
echo json_encode($data);

// showArray($item_pedido);

// "productid" => "",
// "productname" => "",
// "unitcost" => "",
// "status" => "",
// "listprice" => "",
// "attr1" => "",
// "itemid" => ''
