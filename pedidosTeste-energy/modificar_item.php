<?php
require_once 'connect.php';

      
$query_itens_disponiveis =  'SELECT den_item, cod_item FROM item;';
$resultado_itens_disponiveis = $ligacao->query($query_itens_disponiveis);
$itens_disponiveis = $resultado_itens_disponiveis->fetchAll();


foreach ($itens_disponiveis as $it_dispo) {
    $data[] = [
        "nome_item" => $it_dispo['den_item'], // Usando "nome_item" em vez de "nome_item[]"
        "cod_item" => $it_dispo['cod_item']
    ];
}
header('Content-Type: application/json');
echo json_encode($data);



if (isset($_POST['row']) && isset($_POST['changes']) && isset($_POST['index']) && isset($_POST['cod_item'])) {
    showArray($_POST);
    $row = $_POST['row'];
    echo "variavel row: $row";  //num_seq_item
    $changes = $_POST['changes']; // ARRAY COM = nome_item e qtd_solicitada /  [nome_item] => Z /  [qtd_solicitada] => y
   showArray($changes);
    $index = $_POST['index'];
    $cod_item = $_POST['cod_item'];
    echo "cod_item: $cod_item";
    
   
   
    error_reporting(0);
    


    foreach ($changes as $change) {

        


            //update do item modificado

            $query_item_modificado = "UPDATE item_pedido
            SET cod_item = $cod_item, qtd_solicitada = $changes[qtd_solicitada]
            WHERE num_seq_item = $row;";
            $resultado_update_item_modificado = $ligacao->query($query_item_modificado);
           showArray($query_item_modificado);

            //update no valor do item modificado

            $query_valor_item_modificado = " UPDATE item_pedido AS ip
                                                JOIN item AS i ON ip.cod_item = i.cod_item
                                                SET ip.pre_unitario = i.valor
                                                WHERE i.cod_item = $novo_item_selecionado      
                                                AND ip.num_seq_item = $row;";

            $resultado_valor_item_modificado = $ligacao->query($query_valor_item_modificado);
           
        
    }

} else {
    echo "<h1> Nenhum item da tabela foi selecionado </h1>";
    die();
}





?>
