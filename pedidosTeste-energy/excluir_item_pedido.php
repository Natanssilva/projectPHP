<?php
require_once 'connect.php';

//showArray($_POST);
if (isset($_POST['rowData'])) {
    $pedidoSelecionado = $_POST['pedidoSelecionado'];
    $rowData = $_POST['rowData'];
    // showArray(gettype($rowData));  //string

    $itensEscolhidosRow = str_split($rowData,2);   //talvez isso quebre se tiver num_seq_item > 2.lenght


    
    
  
    if ($pedidoSelecionado && $rowData) {

        foreach ($itensEscolhidosRow as $item) {
            $query_excluir_item = "DELETE FROM item_pedido WHERE num_pedido = $pedidoSelecionado and num_seq_item = $item;";
            $resultado_query_excluir_item = $ligacao -> query($query_excluir_item);
            
            
        }
    

        $response = [
            'status' => 'true',
            'value' => 'item deletado'
    
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

