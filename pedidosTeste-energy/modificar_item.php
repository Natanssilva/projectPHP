<?php
require_once 'connect.php';

if (isset($_POST['pedidoSelecionado']) && isset($_POST['rowData'])) {
    error_reporting(0);
    $pedidoSelecionado = $_POST['pedidoSelecionado'];
    
    $rowData = $_POST['rowData'];
    

        
    $query_itens_disponiveis =  'SELECT den_item, cod_item FROM item;';
    $resultado_itens_disponiveis = $ligacao->query($query_itens_disponiveis);

    $itens_disponiveis = $resultado_itens_disponiveis->fetchAll();

    $query_modificar_item_pedido = 'SELECT it.num_pedido, it.num_seq_item,it.cod_item, it.qtd_solicitada,i.den_item 
    FROM item_pedido AS it
    LEFT JOIN item AS i
    ON it.cod_item = i.cod_item
    ;';
    $resultado_modificar_item = $ligacao->query($query_modificar_item_pedido);

    $modificar_item_pedido = $resultado_modificar_item->fetchAll();
    //showArray($modificar_item_pedido);

    if (isset($_POST['salvar_modificar_item'])) {
    $novo_item_selecionado = $_POST['novo-item-modificado'];
    $qtd_selecionada_item_modificado = $_POST['qtd_select_item_modificado'];

    //update do item modificado
    

    $query_item_modificado = "UPDATE item_pedido
    SET cod_item = $novo_item_selecionado, qtd_solicitada = $qtd_selecionada_item_modificado
    WHERE num_seq_item = $rowData;";
    $resultado_update_item_modificado = $ligacao->query($query_item_modificado);

    //update no valor do item modificado

    $query_valor_item_modificado = " UPDATE item_pedido AS ip
    JOIN item AS i ON ip.cod_item = i.cod_item
    SET ip.pre_unitario = i.valor
    WHERE i.cod_item = $novo_item_selecionado      
    AND ip.num_seq_item = $rowData;";

    $resultado_valor_item_modificado = $ligacao->query($query_valor_item_modificado);
}
    
}else{
    echo "<h1> Nenhum item da tabela foi selecionado </h1>";
    die();
}





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

         <h1>Modificar item</h1>
         <form action="" method="post">
             <table class="tabela table table-bordered table-responsive" border="1">
                 <thead>
                     <tr>
                         <th>Pedido: </th>
                         <th colspan="4"><?= $pedidoSelecionado ?></th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr>
                         <th>ITENS JÁ SELECIONADOS:</th>
                         <td>Itens disponiveis para selecionar:</td>
                         <td>Quantidade pré selecionada</td>
                         <td>Nova quantidade:</td>
                     </tr>


                     <?php foreach ($modificar_item_pedido as $modificar_it_pedido) { ?>
                         <tr>
                             <?php if ($modificar_it_pedido['num_pedido'] == $pedidoSelecionado) { ?>

                                 <td class="d-flex justify-content-between">
                                     <?php echo $modificar_it_pedido['den_item'] ?>
                                 </td>
                                 <td>
                                     <select class="form-control form-control-sm" name="novo-item-modificado" id="select-modItem" >
                                         <option value=""></option>
                                         <?php foreach ($itens_disponiveis as $item_disponivel) { ?>
                                             <option value="<?php echo $item_disponivel['cod_item'] ?>"><?php echo $item_disponivel['den_item'] ?></option>
                                         <?php }  ?>
                                     </select>
                                 </td>
                                 <td><?php echo number_format($modificar_it_pedido['qtd_solicitada']) ?></td>
                                 <td>
                                   <input class="form-control" type="number" name="qtd_select_item_modificado" id="" min="1" max="10">
                                 </td>
                             <?php } ?>

                         </tr>
                     <?php  } ?>
                 </tbody>
             </table>
             <div class="d-flex justify-content-around">
                 <input class="btn btn-primary" name="salvar_modificar_item" type="submit" value="SALVAR">
                 <a class="btn btn-outline-primary btn-sm" href="gerenciar-pedidos.php">VOLTAR</a>
                 <?php if ($resultado_update_item_modificado && $resultado_valor_item_modificado) {
                        echo " <p class = 'text-success'> Item modificado com sucesso ! </p>";
                    } ?>
             </div>
         </form>

    
</body>
</html>