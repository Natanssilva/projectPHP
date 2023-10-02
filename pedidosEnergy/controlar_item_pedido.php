 <?php
    require_once 'connect.php';
   


error_reporting(0);

//echo "<br>numero pedido: " . $numero_pedido_incluir;


$num_pedido_modificar = $_GET['num_pedido'];
//echo "<br>numero pedido: " . $num_pedido_modificar;

$seq_item_modificar = $_GET['seq_item'];
//echo "<br>numero de sequencia de item é: " . $seq_item_modificar;

//showArray($item_incluir_item);

$query_itens_disponiveis =  'SELECT den_item, cod_item FROM item;';
$resultado_itens_disponiveis = $ligacao->query($query_itens_disponiveis);

$itens_disponiveis = $resultado_itens_disponiveis ->fetchAll();

// showArray($itens_disponiveis);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero_pedido_incluir = $_POST['num_pedido'];
    // $item_selecionado = $_POST['itens'];
    $qtd_solicitada = $_POST['QtdSelecionada'];
    $cod_item_recebido_pelo_selector = $_POST['itens'];
   // showArray($_POST);


}

$query_inclusao_item = "INSERT INTO item_pedido
(num_pedido, num_seq_item, cod_item, qtd_solicitada, pre_unitario)
VALUES ($numero_pedido_incluir, (SELECT ip.num_seq_item + 1 AS increment_num_seq_item
                            FROM item_pedido AS ip
                            WHERE ip.num_pedido
                            ORDER BY ip.num_seq_item DESC
                            LIMIT 1), $cod_item_recebido_pelo_selector,
                             $qtd_solicitada,
                             (SELECT valor
                            FROM item 
                            WHERE cod_item = $cod_item_recebido_pelo_selector))";

//showArray($query_inclusao_item);

  $resultado_inclusao_item = $ligacao ->query($query_inclusao_item);


        //MODIFICAR ITEM

    $query_modificar_item_pedido = 'SELECT it.num_pedido, it.num_seq_item,it.cod_item, it.qtd_solicitada,i.den_item 
                                    FROM item_pedido AS it
                                    LEFT JOIN item AS i
                                    ON it.cod_item = i.cod_item
                                    ;';
    $resultado_modificar_item = $ligacao ->query($query_modificar_item_pedido);

    $modificar_item_pedido = $resultado_modificar_item ->fetchAll();
    //showArray($modificar_item_pedido);

    if (isset($_POST['salvar_modificar_item'])) {
        $novo_item_selecionado = $_POST['novo-item-modificado'];
        $qtd_selecionada_item_modificado = $_POST['qtd_select_item_modificado'];
        // echo $qtd_selecionada_item_modificado;
        // echo "<br>".  $novo_item_selecionado;   //retornando o cod_item

        //update no valor do item
        
        $query_valor_item_modificado = " UPDATE item_pedido AS ip
        JOIN item AS i ON ip.cod_item = i.cod_item
        SET ip.pre_unitario = i.valor
        WHERE ip.num_seq_item = $seq_item_modificar;";

        $resultado_valor_item_modificado = $ligacao->query($query_valor_item_modificado);
       

        $query_item_modificado = "UPDATE item_pedido
        SET cod_item = '$novo_item_selecionado', qtd_solicitada = '$qtd_selecionada_item_modificado'
        WHERE num_seq_item = '$seq_item_modificar' ";
        $resultado_update_item_modificado = $ligacao -> query($query_item_modificado);
    }

   

    // showArray($query_item_modificado);
    // showArray($resultado_valor_item_modificado);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incluir Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">  
    <link rel="stylesheet" href="modItem.css">
</head>
<body class="container">
    <?php if ($num_pedido_modificar || $seq_item_modificar) { ?>
        <h1>Modificar item</h1>
        <form action="" method="post">
            <table class="tabela table table-bordered table-responsive" border="1">
                <thead>
                    <tr>
                        <th>Pedido: </th>
                        <th colspan="4"><?php echo $num_pedido_modificar ?></th>
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
                            <?php if ($modificar_it_pedido['num_pedido'] == $num_pedido_modificar && $modificar_it_pedido['num_seq_item'] == $seq_item_modificar) { ?>
                                
                              
                                
                                <td class="d-flex justify-content-between">
                                     <?php echo $modificar_it_pedido['den_item'] ?>
                                </td>
                                <td>
                                    <select class="form-control form-control-sm" name="novo-item-modificado" id="select-modItem" required>
                                        <option value=""></option>
                                        <?php foreach ($itens_disponiveis as $item_disponivel) { ?>
                                            <option value="<?php echo $item_disponivel['cod_item']?>"><?php echo $item_disponivel['den_item'] ?></option>
                                        <?php }  ?>
                                    </select>
                                </td>
                                <td><?php echo number_format($modificar_it_pedido['qtd_solicitada']) ?></td>
                                <td>
                                    <select name="qtd_select_item_modificado" id="" required>
                                        <option value=""></option>
                                        <?php for ($i=1; $i <= 10; $i++) { ?> 
                                           <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            <?php } ?>
                            
                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-around">
                <input  class="btn btn-primary" name="salvar_modificar_item" type="submit" value="SALVAR">
                <a class="btn btn-outline-primary btn-sm" href="gerenciar-pedidos.php">VOLTAR</a>
                <?php if ($resultado_update_item_modificado && $resultado_valor_item_modificado) {
                        echo " <p class = 'text-success'> Item modificado com sucesso ! </p>";
                } ?>
            </div>
        </form>

    <?php }else{ ?>
        <h1>Incluir item</h1>

            <form action="controlar_item_pedido.php" method="post">
                <table class="tabela table table-bordered table-responsive" border="1">
                    <thead>
                        <tr>
                            <th>Pedido: <?php echo ($numero_pedido_incluir)?> </th>
                            <!-- <th> <a href="gerenciar-pedidos.php" class="btn btn-outline-primary btn-sm">VOLTAR</a> </th> -->
                        </tr>
                    </thead>
                    <tr>
                        <td>Item:</td>
                        <td colspan="2">
                                <select class="form-select form-select-sm" name="itens" id="" required>
                                        <option value=""></option>
                                        <?php  foreach ($itens_disponiveis as $value) { ?>
                                            <option value="<?php echo($value['cod_item'] ) ?>"><?php echo ($value['den_item'])  ?></option>
                                        <?php } ?>
                                </select>
                        </td>
                            
                    </tr>
                    <tr>
                        <td>Qtd:</td>
                    <td>
                    <select class="form-select form-select-sm" name="QtdSelecionada" id="id" required>
                        <option value=""></option>
                            <?php for ($i = 1; $i <= 10; $i++) { ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>
                    </select>

                    </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                        <input type="hidden" name="num_pedido" value="<?php echo $numero_pedido_incluir; ?>">
                            <input  class="btn btn-primary" name="salvar_itens" type="submit" value="SALVAR">
                    
                            <?php if (isset($_POST['salvar_itens'])) { ?>
                                        <a href="gerenciar-pedidos.php" class="btn btn-outline-primary">VOLTAR</a>
                                            <h3 class="mt-4 text-success">Item incluido com sucesso</h3>
                            <?php  } ?>        
                        </td>
                    </tr>
                </table>
            </form>
    <?php } ?>
   
</body>
</html>





