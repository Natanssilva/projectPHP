<?php
// require_once 'gerenciar-pedidos.php';
require_once 'connect.php';

//vai passar o numero como parametro do pedido

//modificar pedido
$num_pedido = $_GET['numero_pedido'];
//showArray($num_pedido);


//INCLUIR PEDIDO


if (isset($_POST['incluir_pedido'])) {
    $query_incluir_pedido = 'INSERT INTO pedido (cod_cliente) VALUES (0);';
    $resultado_incluir_pedido = $ligacao->query($query_incluir_pedido); 
    // echo ($query_incluir_pedido);
    
 } ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela de Exemplo</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="container">
    <h1>Minha Tabela</h1>
    <table class="tabela table table-bordered table-responsive" border="1">
        <thead>
            <tr>
                <th>Pedido:</th>
                <th>123</th>
                <th>Cliente:</th>
                <th>Nome do Cliente</th>
                <th colspan="2">
                    <form action="controlar_item_pedido.php" method="post">
                        <input type="hidden" name="num_pedido" value="123">
                        <input type="submit" class="btn btn-outline-primary btn-sm" value="INCLUIR ITEM">
                    </form>
                    <br>
                    <a href="controlar_pedido.php?numero_pedido=123">[Modificar Pedido]</a>
                    <br>
                    <a href="excluir_pedido.php?numero_pedido=123">[Excluir Pedido]</a>
                </th>
            </tr>
        </thead>
        <tr>
            <td>Item:</td>
            <td>Qtd:</td>
            <td>Preço:</td>
            <td>Total:</td>
        </tr>
        <tr>
            <td>Item 1</td>
            <td>5</td>
            <td>R$ 10.00</td>
            <td>R$ 50.00</td>
        </tr>
        <tr>
            <td>Item 2</td>
            <td>3</td>
            <td>R$ 8.00</td>
            <td>R$ 24.00</td>
        </tr>
        <tr>
            <td class="" colspan="4">Total do Pedido: R$ 74.00</td>
        </tr>
    </table>
</body>

</html>

