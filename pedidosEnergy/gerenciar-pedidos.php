
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
    <?php require_once 'connect.php'; ?>
        <?php foreach ($pedido_nome_cliente as $pedido_cliente) { ?>
            <table class="tabela table" border="1">
                <thead>
                    <tr>
                        
                        <th>Pedido: </th> <th><?php echo $pedido_cliente['num_pedido'] ?></th> <th>Cliente:</th> <th><?php echo $pedido_cliente['nom_cliente'] ?></th>
                            <th colspan="2"><a href="#">[Incluir Item]</a><br><a href="#">[Excluir Pedido]</a></th>
                        
                    </tr>
                </thead>
                
                <tr>
                    <td>Item</td>
                    <td>Qtd</td>
                    <td>Preço</td>
                   
                    <td>
                       <a href="#">[MODIFICAR]</a>
                    </td>
                    <td> 
                        <a href="#">[EXCLUIR]</a>
                    </td>
                </tr>
            
                <?php
            foreach ($item_pedido[$pedido_cliente['num_pedido']] as $value) {
                    
                ?>
                <tr>
                <td><?php echo $value['den_item']; ?></td>
                    <td><?php echo number_format($value['qtd_solicitada']); ?></td>
                    <td><?php echo "R$ " .  number_format($value['pre_unitario'],2); ?></td>
                </tr>
        <?php } ?>
           
                
            </table>



    <?php } ?>

</body>
</html>