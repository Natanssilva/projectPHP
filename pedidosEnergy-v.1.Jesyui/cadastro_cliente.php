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
        $nome_cliente_novo = ucfirst($_POST['nome_cliente']); //todo nome_cliente cadastrado no banco vai vir com a 1ºletra maiusc

        if (empty($nome_cliente_novo)) {
            echo "<p class='text-warning'>Nenhum cliente cadastrado, digite um nome!</p>";
        } elseif($nome_cliente_novo) {
            $query_novo_cliente_nome ="INSERT INTO cliente (cod_cliente, nom_cliente)
            VALUES ($novo_cod, '$nome_cliente_novo');" ; 

            $resultado_novo_cliente = $ligacao ->query($query_novo_cliente_nome);
            echo "<p class='text-success'>cliente cadastrado!</p>";                     
            
        }
     }

     //

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="container">

        <div class="d-flex justify-content-center">
                <div>
                    <div>
                        <h3 class="card-title text-center">Cadastro novo cliente</h3>
                        <form action="cadastro_cliente.php" method="post">
                            <div class="form-group">
                                <label for="nome">Nome do cliente:</label>
                                <input type="text" name="nome_cliente" class="form-control" id="nome" placeholder="Digite seu nome">
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-4">
                                    <input type="submit" name="salvar_novo_cliente" class="btn btn-primary btn-block" value="SALVAR">
                                </div>
                                <div class="col-md-6 mt-4">
                                    <a class="btn btn-secondary btn-block" href="index.php">VOLTAR</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
  
</body>
</html>
