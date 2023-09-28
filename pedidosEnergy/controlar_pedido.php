<?php
// require_once 'gerenciar-pedidos.php';
require_once 'connect.php';



if (isset($_POST['submit_incluir_item'])) {

    $query_incluir_pedido = 'INSERT INTO pedido (cod_cliente) VALUES (0);';
    $resultado_incluir_pedido = $ligacao->query($query_incluir_pedido); 
    $dados_inclusao = $ligacao -> lastInsertId();
    
    $numero_pedido_inclusao = $ligacao -> lastInsertId($pedido_nome_cliente['num_pedido']);
    
 } 

 $query_inclusao_pedidos = 'SELECT cod_cliente,nom_cliente 
 FROM cliente;';

$resultado_inclusao_pedidos = $ligacao -> query($query_inclusao_pedidos) ;
$inclusao_pedidos_cliente = $resultado_inclusao_pedidos ->fetchAll();


//$query_cliente_existente = "INSERT INTO pedido (cod_cliente)";

//showArray($inclusao_pedidos_cliente);

if (isset($_POST['salvar_pedido'])) {
    $clientes_existentes = $_POST['clientes_existentes'];
    echo "o cod_cliente $clientes_existentes foi enviado.";

    // $query_cliente_inclusao_pedido = "INSERT INTO pedido (num_pedido, cod_cliente) VALUES ( , $clientes_existentes)";
    // showArray($query_cliente_inclusao_pedido);

    $query_cliente_inclusao_pedido = "INSERT INTO pedido (cod_cliente) VALUES ($clientes_existentes)";
    $resultado_inclusao = $ligacao->query($query_cliente_inclusao_pedido);

    if (!empty($resultado_inclusao)) {
        // numero do pedido pela inclusao de pedido
        $numero_pedido_inclusao = $ligacao->lastInsertId();
        echo "<br>Pedido criado com sucesso! Número do pedido: " . $numero_pedido_inclusao;
    } else {
        error_log("Erro ao incluir pedido");
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
    <?php if ($num_pedido = $_GET['numero_pedido']) { ?>
        <h1>Modificar Pedido</h1>
    <?php }else{ ?>
        <h1> INCLUIR PEDIDO</h1>
    <?php } ?>
  <form action="controlar_pedido.php" method="post">
        <table class="tabela table table-bordered table-responsive" border="1">
            <thead>
                <tr>
                    <th >Pedido: </th>
                    <th><?php echo ($numero_pedido_inclusao . $num_pedido)?> </th>
                    <?php foreach ($pedido_nome_cliente as $cliente) { ?>
                        <?php if ($cliente['num_pedido'] == $num_pedido) { ?>
                            <th>Cliente:</th>
                            <th><?php echo ($cliente['nom_cliente']) ?></th>
                            
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
                    <input   class="btn btn-primary" name="salvar_pedido" type="submit" value="SALVAR">
                </div>
            </th>
           
        </table>
    </form>  
</body>

</html>

