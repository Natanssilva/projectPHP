<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos Energy</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="container">
    <h1>Lista de pedidos</h1>
    <?php require_once 'connect.php';
   
    
    ?>
    <?php foreach ($pedido_nome_cliente as $pedido_cliente) { ?>
        <table class="tabela table table-bordered table-responsive" border="1">
            <thead>
                <tr>

                    <th>Pedido: </th>
                    <th><?php echo $pedido_cliente['num_pedido'] ?></th>
                    <th>Cliente:</th>
                    <th><?php echo $pedido_cliente['nom_cliente'] ?></th>
                    <th colspan="2">
                        <form action="controlar_item_pedido.php" method="post">
                            <input type="hidden" name="num_pedido" value="<?php echo ($pedido_cliente['num_pedido']); ?>">
                            <input type="submit" class="btn btn-outline-primary btn-sm" value="INCLUIR ITEM">
                        </form>
                        <br>
                        <a href="controlar_pedido.php?numero_pedido=<?php echo ($pedido_cliente['num_pedido']) ?>">[Modificar Pedido]</a>
                        <br>
                        <a href="excluir_pedido.php?numero_pedido=<?php echo $pedido_cliente['num_pedido'] ?>">[Excluir Pedido]</a>

                    </th>

                </tr>
            </thead>

            <tr>
                <td>Item:</td>
                <td>Qtd:</td>
                <td>Preço:</td>
                <td>Total:</td>

        
            </tr>

            <?php
            $total_pedido = 0;
            foreach ($item_pedido[$pedido_cliente['num_pedido']] as $value) {
                //showArray($item_pedido[$pedido_cliente['num_pedido']])
            ?>

                <tr>
                    <td><?php echo $value['den_item']; ?></td>
                    <td><?php echo number_format($value['qtd_solicitada']); ?></td>
                    <td><?php echo "R$ " .  number_format($value['pre_unitario'], 2); ?></td>
                    <td><?php echo "R$ " .  number_format($value['total_itens'], 2);

                        $total_pedido += $value['total_itens'];
                        ?></td>
                    <td>
                        <?php
                          //showArray($value) 
                        ?>
                        <a href="controlar_item_pedido.php?num_pedido=<?php echo ($value['num_pedido']) ?>&seq_item=<?php echo ($value['num_seq_item']) ?> ">[MODIFICAR ITEM]</a>
                    </td>
                    <td>
                        <a href="excluir_item_pedido.php?numero_pedido=<?php echo ($value['num_pedido']) ?>&seq_item=<?php echo ($value['num_seq_item']) ?>">[EXCLUIR]</a>
                    </td>
                </tr>
                <tr>

                </tr>
            <?php } ?>

            <tr>
                <td class="" colspan="4">Total do Pedido: <?php echo "R$ " .  number_format($total_pedido, 2); ?></td>
            </tr>






        </table>

       

    <?php } ?>
    <form class="container mb-4" action="controlar_pedido.php" method="post">
        <input type="submit" class="btn btn-outline-primary btn-sm" name="incluir_pedido" value="INCLUIR PEDIDO">
    </form>
  
   
   
</body>

</html>