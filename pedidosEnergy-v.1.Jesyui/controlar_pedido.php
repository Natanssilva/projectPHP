<?php
require_once 'connect.php';

    //query pra mostrar os nomes e cod_clientes dos clientes

 $query_inclusao_pedidos = 'SELECT cod_cliente,nom_cliente 
 FROM cliente;';

$resultado_inclusao_pedidos = $ligacao -> query($query_inclusao_pedidos) ;
$inclusao_pedidos_cliente = $resultado_inclusao_pedidos ->fetchAll();

//showArray($inclusao_pedidos_cliente);

if (isset($_POST['salvar_pedido'])) {

    //verifica se o form foi enviado, caso true pega o cod_cliente atraves de clientes_existentes e insert na tabela
    $clientes_existentes = $_POST['clientes_existentes'];

    $query_cliente_inclusao_pedido = "INSERT INTO pedido (cod_cliente) VALUES ($clientes_existentes)";
    $resultado_inclusao = $ligacao->query($query_cliente_inclusao_pedido);

}  
  
//MODIFICAR PEDIDO

//verificando se o form foi enviado
if (isset($_POST['salvar_modificar_pedido'])) {
    $nome_alterar_clientes = $_POST['alterar_clientes'];
    $numero_pedido_modificar = $_GET['numero_pedido'];

    $query_modificar_pedido = "UPDATE pedido SET cod_cliente = $nome_alterar_clientes  WHERE num_pedido = $numero_pedido_modificar";
    $resultado_modificar_pedido = $ligacao->query($query_modificar_pedido);

    if ($resultado_modificar_pedido) {

        // Recarregar os dados e nao atrasar na hora de mostrar o nom_cliente
        $query = "SELECT p.num_pedido, c.nom_cliente
        FROM pedido AS p
        LEFT JOIN cliente AS c ON (p.cod_cliente = c.cod_cliente);";
        $resultado = $ligacao->query($query);
        $pedido_nome_cliente = $resultado->fetchAll();

    
    } 
}
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
    <?php if (isset($_GET['numero_pedido']))  { 
        $num_pedido = $_GET['numero_pedido'];
        ?>       
        <h1>Modificar Pedido</h1>
        <form  method="post">
            <table class="tabela table table-bordered table-responsive" border="1">
                <thead>
                    <tr>
                        <th>Pedido: </th>
                        <th><?php echo $num_pedido ?></th>
                        <th>Cliente atual: </th>
                        <th>
                            <?php 
                                foreach ($pedido_nome_cliente as  $value) {
                                    if ($value['num_pedido'] == $num_pedido) {
                                        echo $value['nom_cliente']; 
                                    }
                                } 
                            ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Alteração de cliente :</td>
                        <td colspan="3">
                        
                            <select class="form-select"  name="alterar_clientes" id="" >
                                <option value=""></option>
                                <?php foreach ($inclusao_pedidos_cliente as $alterar_cliente) { ?>
                                    <option value="<?php echo $alterar_cliente['cod_cliente']  ?>"><?php  echo $alterar_cliente['nom_cliente'] ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                   
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            <div class="d-flex justify-content-around">
                                <input class="btn btn-primary" name="salvar_modificar_pedido" type="submit" value="SALVAR">

                                <div>
                                    <?php
                                        //Validando modificar pedido
                                    if ($pedido_nome_cliente && $resultado_modificar_pedido) {
                                        echo "<p class='text-success'>Pedido modificado com sucesso!</p>";
                                    }elseif ($_POST['salvar_modificar_pedido'] && !$resultado_modificar_pedido) {
                                          echo "<p class='text-danger'>Erro ao modificar o pedido.</p>";
                                    }else {
                                        echo "";
                                    }
                                    ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <a class="btn btn-outline-primary  btn-sm" href="gerenciar-pedidos.php">VOLTAR</a>
        </form>

        <!--INCLUIR PEDIDO -->
    <?php }else{ 
        $num_pedido = null;
        ?>
        <h1> INCLUIR PEDIDO</h1>
        <form action="controlar_pedido.php" method="post">
            <table class="tabela table table-bordered table-responsive" border="1">
                <thead>
                    <tr>
                        <th >Inclusão de pedido </th>
                        <!-- <th><?php //echo ($numero_pedido_inclusao . $num_pedido)?> </th> -->
                        <?php foreach ($pedido_nome_cliente as $cliente) { ?>
                            <?php if ($cliente['num_pedido'] == $num_pedido) { ?>
                                <th>Cliente:</th>   
                                <th>
                                    <?php echo ($cliente['nom_cliente']) ?>
                                </th>
                            <?php }?>
                                <?php  } ?>
                        <th colspan="2">
                            <a href="gerenciar-pedidos.php" class="btn btn-outline-primary btn-sm">VOLTAR</a>
                        </th>
                    </tr>
                </thead>
                <th>Cliente existente?</th>
                <th colspan="2">
                    <select class="form-select form-select-sm" name="clientes_existentes" id="" required>
                        <option value=""></option>
                            <?php foreach ($inclusao_pedidos_cliente as $cliente_pedido) {?>
                            <option value="<?php echo $cliente_pedido['cod_cliente'] ?>"><?php  echo $cliente_pedido['nom_cliente']  ?></option>
                            <?php } ?>
                    </select>  
                </th>
                <tr>
                    <th colspan="3">
                        <label for="">Cliente novo?</label>
                        <a href="cadastro_cliente.php">Cadastrar cliente</a>
                    </th>
                </tr>
                <th colspan="3">
                    <div class="d-flex justify-content-center">
                        <input class="btn btn-primary" name="salvar_pedido" type="submit" value="SALVAR">
                    </div>
                    <div class="d-flex justify-content-center">
                            <?php
                                if (!empty($resultado_inclusao)) {
                                // numero do pedido pela inclusao de pedido
                                $numero_pedido_inclusao = $ligacao->lastInsertId();
                                echo "<br><p class ='text-success'>Pedido criado com sucesso! Número do pedido: </p> " . $numero_pedido_inclusao;
                                } else {
                                    error_log("Erro ao incluir pedido");
                                }
                             ?>
                        </div>
                </th>
            </table>
    </form>  
    <?php } ?>
    
</body>

</html>

