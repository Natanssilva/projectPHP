<?php
require_once 'connect.php';

//showArray($_POST);
if (isset($_POST['rowData'])) {
    $pedidoSelecionado = $_POST['pedidoSelecionado'];
    $rowData = $_POST['rowData'];

    // $pedidosEscolhidosRow =  "'" . implode("','", $rowData) . "'";
    // echo $pedidosEscolhidosRow;
  
    if ($pedidoSelecionado && $rowData) {
        $query_excluir_item = "DELETE FROM item_pedido WHERE num_pedido = $pedidoSelecionado and num_seq_item = $rowData;";
        $resultado_query_excluir_item = $ligacao -> query($query_excluir_item);
        
        showArray($query_excluir_item);

        $response = [
            'status' => 'true',
            'value' => 'item Deletado'
    
        ];

     

    }else{
        $response = [
            'status' => 'fake',
            'value' => 'Sem sucesso ao excluir item'
    
        ];
    }

   
} else {
    $response = [
        'status' => 'false',
        'value' => 'Erro: Dados não recebidos corretamente.'
    ];
}

echo json_encode($response);

exit();




// $query_excluir_item = "DELETE FROM item_pedido WHERE num_pedido = $numero_pedido and num_seq_item = $seq_item;";
// $resultado_query_excluir_item = $ligacao -> query($query_excluir_item);


// echo "<h1> Item do pedido excluido</h1>"; 
// echo "<a href = 'gerenciar-pedidos.php'>[VOLTAR]</h1>"; 
