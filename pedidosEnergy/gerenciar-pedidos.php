
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos Energy</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Lista de pedidos</h1>
    <?php require 'connect.php'; ?>
        <?php foreach ($pedido_nome_cliente as $key => $pedido_cliente) { ?>
            <table class="tabela" border="1">
                <thead>
                    <tr>
                        
                        <th>Pedido: </th> <th><?php echo $pedido_cliente['num_pedido'] ?></th> <th>Cliente:</th> <th><?php echo $pedido_cliente['nom_cliente'] ?></th>
                            <th colspan="2"><a href="#">[Incluir Pedido]</a><br><a href="#">[Excluir Pedido]</a></th>
                        
                    </tr>
                </thead>
                
                <tr>
                    <td>Item</td>
                    <td>Qtd</td>
                    <td>Preço</td>
                    <td>Total</td>
                    <td width = "15px">
                        Modificação
                    </td>
                    <td> 
                        Exclusão
                    </td>
                </tr>
                
            </table>



    <?php } ?>

</body>

</html>