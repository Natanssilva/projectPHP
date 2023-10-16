<?php
require_once 'connect.php';

//query pra mostrar os nomes e cod_clientes dos clientes

$query_inclusao_pedidos = 'SELECT cod_cliente,nom_cliente 
 FROM cliente;';

$resultado_inclusao_pedidos = $ligacao->query($query_inclusao_pedidos);
$inclusao_pedidos_cliente = $resultado_inclusao_pedidos->fetchAll();

//showArray($inclusao_pedidos_cliente);

if (isset($_POST['salvar_pedido'])) {

    //verifica se o form foi enviado, caso true pega o cod_cliente atraves de clientes_existentes e insert na tabela
    $clientes_existentes = $_POST['clientes_existentes'];

    $query_cliente_inclusao_pedido = "INSERT INTO pedido (cod_cliente) VALUES ($clientes_existentes)";
    $resultado_inclusao = $ligacao->query($query_cliente_inclusao_pedido);
    $numero_pedido_inclusao = $ligacao->lastInsertId(); //pegando o numero de inclusao


    // pegando o ultimo pedido após o insert
    $query_ultimo_pedido = "SELECT num_pedido FROM pedido WHERE cod_cliente = {$clientes_existentes} ORDER BY num_pedido DESC LIMIT 1";
  
    $resultado_ultimo_pedido = $ligacao->query($query_ultimo_pedido);
    $num_pedido = $resultado_ultimo_pedido->fetch(); 
 

    $num_pedido =  $num_pedido['num_pedido'];
    header("Location: index.php?num_pedido={$num_pedido}"); //assim que o select for executado, vai voltar pro index.php passando pela url o ultimo pedido
   
    
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
   

        <!--INCLUIR PEDIDO -->
  
        <form action="controlar_pedido.php" method="post">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                       
                        <div class="mb-3">
                            <label for="clientesExistentes" class="form-label">Cliente existente?</label>
                            <select class="form-select" name="clientes_existentes" id="clientesExistentes" required>
                                <option value=""></option>
                                <?php foreach ($inclusao_pedidos_cliente as $cliente_pedido) { ?>
                                    <option value="<?php echo $cliente_pedido['cod_cliente'] ?>"><?php echo $cliente_pedido['nom_cliente'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary" name="salvar_pedido" type="submit">SALVAR</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

</body>

</html>