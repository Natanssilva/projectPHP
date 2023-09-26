 <?php
    require_once 'connect.php';
   


error_reporting(0);
$numero_pedido_incluir = $_POST['num_pedido'];
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
    $item_selecionado = $_POST['itens'];
    $qtd_solicitada = $_POST['QtdSelecionada'];
    $cod_item_recebido_pelo_selector = $_POST['itens'];

   

   // $cod_item = $_POST['cod_item'];

 
   

}

$query_inclusao_item = "INSERT INTO item_pedido
(num_pedido, num_seq_item, cod_item, qtd_solicitada, pre_unitario)
VALUES ('$numero_pedido_incluir', (SELECT num_seq_item + 1 AS increment_num_seq_item
                            FROM item_pedido 
                            WHERE num_pedido
                            ORDER BY num_seq_item DESC
                            LIMIT 1), '$cod_item_recebido_pelo_selector',
                            ' $qtd_solicitada',
                             (SELECT valor
                            FROM item 
                            WHERE cod_item = '$cod_item_recebido_pelo_selector'))";

// $resultado_inclusao_item = $ligacao ->query($query_inclusao_item);
// $inclusao_item_finalizado = $resultado_inclusao_item -> fetchAll(); 

    echo "<br>numero pedido:$numero_pedido_incluir";
    echo "<br>nome item: $item_selecionado";
    echo "<br>qtd selecionado? $qtd_solicitada";
    echo "<br> codigo item:  $cod_item_recebido_pelo_selector";

    //echo " <br> codigo item: $cod_item";


    // $query_increment_seq = " 
    // SELECT num_seq_item + 1 AS increment_num_seq_item
    // FROM item_pedido 
    // WHERE num_pedido = $num_pedido_incluir
    // ORDER BY num_seq_item DESC
    // LIMIT 1;
    // ";

   
    
 
// $query_codigo_item = 'SELECT den_item, cod_item FROM item ;';
// $resultado_codigo_item = $ligacao -> query($query_codigo_item);
// $num_codigo_item = $resultado_codigo_item -> fetchAll();


 //showArray($num_codigo_item);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incluir Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">  
</head>
<body class="container">
    <h1>Incluir item</h1>

    <form action="controlar_item_pedido.php" method="post">
        <table class="tabela table table-bordered table-responsive" border="1">
            <thead>
                <tr>
                    <th>Pedido: <?php echo ($numero_pedido_incluir)?> </th>
                    <th> <a href="gerenciar-pedidos.php" class="btn btn-outline-primary btn-sm">VOLTAR</a> </th>
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
                <input type="hidden" name="cod_item" value="<?php echo $itens_disponiveis['cod_item']; ?>">
                    <input  class="btn btn-primary" type="submit" value="enviar">
                </td>
            </tr>
        </table>
    </form>

    
</body>
</html>





