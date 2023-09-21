<?php
// require_once 'gerenciar-pedidos.php';
require_once 'connect.php';



if (isset($_POST['incluir_pedido'])) {
    $query_incluir_pedido = 'INSERT INTO pedido (cod_cliente) VALUES (0);';
    $resultado_incluir_pedido = $ligacao->query($query_incluir_pedido); 
    $dados_inclusao = $ligacao -> lastInsertId();
    
    $numero_pedido_inclusao = $ligacao -> lastInsertId($pedido_nome_cliente['num_pedido']);
    //echo " " . $numero_pedido_inclusao;
    
    // $query_inclusao2 = 'SELECT * FROM pedido;';
    // $result_inclusao2 = $ligacao->query($query_inclusao2);

    // $dados_inclusao = $result_inclusao2->fetch();
    // echo " " . $dados_inclusao;


 } 

//  showArray($pedido_nome_cliente);


?>

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
    <?php if ($num_pedido = $_GET['numero_pedido']) { ?>
        <h1>Modificar Pedido</h1>
    <?php }else{ ?>
        <h1> INCLUIR PEDIDO</h1>
    <?php } ?>
    
    <table class="tabela table table-bordered table-responsive" border="1">
        <thead>
            <tr>
                <th>Pedido: </th>
                <th><?php echo ($numero_pedido_inclusao . $num_pedido)?> </th>
                <?php foreach ($pedido_nome_cliente as $cliente) { ?>
                    <?php if ($cliente['num_pedido'] == $num_pedido) { ?>
                         <th>Cliente:</th>
                         <th><?php echo ($cliente['nom_cliente']) ?></th>
                    <?php }?>
                      
                        <?php  } ?>

               
                

                
                <th colspan="2">
                   
                
                    <a href="gerenciar-pedidos.php" class="btn btn-outline-primary btn-sm">VOLTAR</a>
                    <br>
                    <br>
                    <a href="#">[SALVAR PEDIDO]</a>
                    
                </th>
            </tr>
        </thead>
        <!-- <tr>
            <td>Item:</td>
            <td>Qtd:</td>
            <td>Preço:</td>
            <td>Total:</td>
        </tr>
        <tr>
            <td>Item 1</td>
            <td>5</td>
            <td>R$ </td>
            <td>R$ </td>
        </tr>
        <tr>
            <td>Item 2</td>
            <td>3</td>
            <td>R$ </td>
            <td>R$ </td>
        </tr>
        <tr>
            <td class="" colspan="4">Total do Pedido: </td>
        </tr>  -->
    </table>
</body>

</html>

