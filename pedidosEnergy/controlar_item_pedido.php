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

$query_itens_disponiveis =  'SELECT den_item FROM item;';
$resultado_itens_disponiveis = $ligacao->query($query_itens_disponiveis);

$itens_disponiveis = $resultado_itens_disponiveis ->fetchAll();

// showArray($itens_disponiveis);


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
<table class="tabela table table-bordered table-responsive" border="1">
    <form action="" method="post">
        <thead>
            <tr>
                <th>Pedido: <?php echo ($numero_pedido_incluir)?> </th>
                <th> <a href="gerenciar-pedidos.php" class="btn btn-outline-primary btn-sm">VOLTAR</a> </th>
            </tr>
        </thead>
        <tr>
            <td>Item:</td>
            <td colspan="2">
                    <select name=" " id="" required>
                            <option value=""></option>
                            <?php  foreach ($itens_disponiveis as $value) { ?>
                                <option value=""><?php echo ($value['den_item']) ?></option>
                            <?php } ?>
                    </select>
            </td>
                
        </tr>
        <tr>
            <td>Qtd:</td>
        <td>
        <select name="seu_nome" id="seu_id">
            <option value=""></option>
                <?php for ($i = 1; $i <= 10; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
        </select>

        </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="enviar">
            </td>
        </tr>
    </form>
</table>
    
</body>
</html>





