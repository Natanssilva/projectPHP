<?php
require_once 'connect.php';

//RECUPERAR O ULTIMO COD_CLIENTE
//CODIGO AQUOI
   

    if (isset($_POST['salvar_novo_cliente'])) {
        $nome_cliente_novo = $_POST['nome_cliente'];
        echo $nome_cliente_novo;

        $query_novo_cliente ="INSERT INTO cliente (cod_cliente, nom_cliente)
        VALUES (, $nome_cliente_novo);" ; 

        $resultado_novo_cliente = $ligacao ->query($query_novo_cliente);

        if ($resultado_novo_cliente) {
            showArray($resultado_novo_cliente);
            echo "Cliente cadastrado";
        }else{
            echo "erro";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Bootstrap</title>
    <!-- Inclua os arquivos CSS e JS do Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                                <input type="text" name="nome_cliente" class="form-control" id="nome" placeholder="Digite seu nome" required>
                            </div>
                            <input type="submit" name="salvar_novo_cliente" class="btn btn-outline-primary btn-block" value="SALVAR">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
