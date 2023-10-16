<?php

require_once 'connect.php';

//query pra mostrar os nomes e cod_clientes dos clientes

$query_inclusao_pedidos = 'SELECT cod_cliente,nom_cliente 
 FROM cliente;';

$resultado_inclusao_pedidos = $ligacao->query($query_inclusao_pedidos);
$inclusao_pedidos_cliente = $resultado_inclusao_pedidos->fetchAll();


if (isset($_POST['pedidoSelecionado'])) {
    $PedidoSelecionado = $_POST['pedidoSelecionado'];
    $ClientePedido = $_POST['clientePedido'];
 



    //verificando se o form foi enviado
    if (isset($_POST['salvar_modificar_pedido'])) {
        $nome_alterar_clientes = $_POST['alterar_clientes'];
        // $numero_pedido_modificar = $_GET['numero_pedido'];
    
        echo "nome_alterar_clientes : $nome_alterar_clientes";
        $query_modificar_pedido = "UPDATE pedido SET cod_cliente = '$nome_alterar_clientes'  WHERE num_pedido = '$PedidoSelecionado';";
        $resultado_modificar_pedido = $ligacao->query($query_modificar_pedido);
        
        if ($resultado_modificar_pedido) {
           
            // Recarregar os dados e nao atrasar na hora de mostrar o nom_cliente
            $query = "SELECT p.num_pedido, c.nom_cliente
            FROM pedido AS p
            LEFT JOIN cliente AS c ON (p.cod_cliente = c.cod_cliente);";
            $resultado = $ligacao->query($query);
            $pedido_nome_cliente = $resultado->fetchAll();
        }else{
            echo "Erro na query " ;
        }

    }
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
<form method="post" action="modificar_pedido.php">
            <table class="tabela table table-bordered table-responsive" border="1">
                <thead>
                    <tr>
                        <th>Pedido: </th>
                        <th><?= $PedidoSelecionado ?></th>
                        <th>Cliente atual: </th>
                        <th>
                          <?= $ClientePedido ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Alteração de cliente :</td>
                        <td colspan="3">

                            <select class="form-select" name="alterar_clientes" id="">
                                <option value=""></option>
                                <?php foreach ($inclusao_pedidos_cliente as $alterar_cliente) { ?>
                                    <option value="<?php echo $alterar_cliente['cod_cliente']  ?>"><?php echo $alterar_cliente['nom_cliente'] ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            <div class="d-flex justify-content-around">
                                <input id="SalvarModificarPedido" class="btn btn-primary" name="salvar_modificar_pedido" type="submit" value="SALVAR">

                                <div>
                                    <?php
                                    //Validando modificar pedido
                                    if ($pedido_nome_cliente && $resultado_modificar_pedido) {
                                        echo "<p class='text-success'>Pedido modificado com sucesso!</p>";
                                    } elseif ($_POST['salvar_modificar_pedido'] && !$resultado_modificar_pedido) {
                                        echo "<p class='text-danger'>Erro ao modificar o pedido.</p>";
                                    } else {
                                        echo "erro inexplicavel";
                                    }
                                    ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <a class="btn btn-outline-primary  btn-sm" href="index.php">VOLTAR</a>
        </form>
</body>
</html>