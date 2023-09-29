<?php
require_once 'connect.php';

//RECUPERAR O ULTIMO COD_CLIENTE + 1
//CODIGO AQUOI

    $query_novo_cod_cliente = 'SELECT MAX(cod_cliente) + 1 AS proximo_cod_cliente FROM cliente;';
    $resultado_novo_cod_cliente = $ligacao->query($query_novo_cod_cliente);
    $novo_cod_cliente = $resultado_novo_cod_cliente->fetch();
    //showArray($novo_cod_cliente);

    //variavel que contem o novo codigo do cliente que vai ser cadastrado
    $novo_cod = $novo_cod_cliente['proximo_cod_cliente'];

    if (isset($_POST['salvar_novo_cliente'])) {
        $nome_cliente_novo = $_POST['nome_cliente'];
       
     }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro cliente</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">    
</head>
<body>
    <div class="container mt-5 ">
        <div class="row justify-content-center ">
            <div class="col-md-4">
                <div class="card border-primary">
                    <div class="card-body">
                        <h3 class="card-title text-center">Cadastro novo cliente</h3>
                        <form action="cadastro_cliente.php" method="post">
                            <div class="form-group">
                                <label for="nome">Nome do cliente:</label>
                                <input type="text" name="nome_cliente" class="form-control" id="nome" placeholder="Digite seu nome">
                            </div>
                            <input type="submit" name="salvar_novo_cliente" class="btn btn-outline-primary btn-block" value="SALVAR">
                        </form>
                       
                    </div>
                    <div class="d-flex justify-content-center mb-3">
                        <a class="btn btn-primary btn-sm" href="controlar_item_pedido.php">VOLTAR</a>
                    </div>   
                    <div class="d-flex justify-content-center mb-2">
                        <?php
                        if ($_POST['salvar_novo_cliente']) { //verifica se foi enviado o form
                            
                            if (empty($nome_cliente_novo)) {
                                echo "<p class='text-warning'>Nenhum cliente cadastrado, digite um nome!</p>";
                            } elseif($nome_cliente_novo) {
                                $query_novo_cliente_nome ="INSERT INTO cliente (cod_cliente, nom_cliente)
                                VALUES ($novo_cod, '$nome_cliente_novo');" ; 
                
                                $resultado_novo_cliente = $ligacao ->query($query_novo_cliente_nome);
                                echo "<p class='text-success'>cliente cadastrado!</p>";                     
                                
                            }
                        } 
                        
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
