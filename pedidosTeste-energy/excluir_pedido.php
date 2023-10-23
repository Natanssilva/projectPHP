<?php
require_once 'connect.php';

if (isset($_POST['pedidoSelecionado'])) {
    $PedidoSelecionado = $_POST['pedidoSelecionado'];
    
    $query_verificar_itens_pedido = " SELECT * FROM item_pedido WHERE num_pedido = $PedidoSelecionado;";
    $resultado_verificar_itens_pedido = $ligacao -> query($query_verificar_itens_pedido);
    $verificar_itens_pedido = $resultado_verificar_itens_pedido -> fetchAll();
    
    if (!empty($verificar_itens_pedido)) {
          //query excluindo itens do pedido
        $query_exclusao_item_pedido = "DELETE from item_pedido WHERE num_pedido = $PedidoSelecionado;";
        $resultado_exclusao_item_pedido = $ligacao->query($query_exclusao_item_pedido);
        $exclusao_item_pedido = $resultado_exclusao_item_pedido -> fetch();


    //criando query pra excluir pedidos
        $query_exclusao_pedido = "DELETE FROM pedido WHERE num_pedido = $PedidoSelecionado;";  
        $resultado_exclusao = $ligacao->query($query_exclusao_pedido);
        $excluir_pedidos = $resultado_exclusao -> fetch();

        $response = [
            'status' => 'true',
            'message' => 'Pedido Deletado'
        ];
    
    }else{

        // criando query pra excluir pedidos
        $query_exclusao_pedido = "DELETE FROM pedido WHERE num_pedido = $PedidoSelecionado;";  
        $resultado_exclusao = $ligacao->query($query_exclusao_pedido);
        $excluir_pedidos = $resultado_exclusao -> fetch();

        $response = [
            'status' => 'true SI',
            'message' => 'Pedido Sem itens deletado'
        ];
      

    }

}else{
    $response = [
        'status' => 'false',
        'message' => 'Nenhum pedido selecionado'
    ];
}



echo json_encode($response);

//else: se nao existir pedidoSelecionado, da um alert la no JS retornando pelo ajax
// DENTRO DO IF SE PEDIDO SELECIONADO EXISTIR: vai fazer um select nos 
//itens do pedido selecionado, e verificar se existe algum item la
//se existir delete o pedido e os itens
// se nao existir, só deleta o pedido