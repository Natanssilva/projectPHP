<?php
require_once('connect.php');

//incremento +1 no ultimo valor do cod_item pro novo item

$query_prox_cod_item = "SELECT (MAX(cod_item) + 1) AS max_cod_item FROM item;";
$resultado_prox_cod_item = $ligacao->query($query_prox_cod_item);
$max_proximo_cod_item = $resultado_prox_cod_item->fetch();

$proximo_codigo = $max_proximo_cod_item['max_cod_item']; //pegando o maior valor do cod_item (o ultimo)

// $proximo_codigo = intval($max_cod_item) + 1; //proximo cod_item disponivel

$msg_envio = ''; // variavel pra tornar a mensagem de erro dinamica

//showArray($_POST);
if (isset($_POST['salvar_novo_item'])) {
    $nome_item = ucfirst($_POST['nome_item']);
    $valor_item = number_format($_POST['valor_item'], 2, '.', '');

    //query pra validar se já existe um item como nome igual
    $query_nome_item_igual = "SELECT cod_item,den_item, valor FROM item WHERE den_item = '$nome_item';";
    //showarray($query_nome_item_igual);
    $resultado_item_igual = $ligacao->query($query_nome_item_igual);
    $item_igual = $resultado_item_igual->fetchAll();

    if (!empty($item_igual)) {   //ponto a melhorar : verificar caracteres especiais pra evitar sql injection
        $msg_envio = "<span class = 'text-danger'> [ERRO] Item já cadastrado! </span>";
    } elseif (strlen($nome_item) <= 3 || empty($valor_item) || $valor_item == "") {
        $msg_envio = "<span class = 'text-danger'> Erro, digite valores válidos </span>";
    } else {
        $query_novo_item = "INSERT INTO item VALUES ($proximo_codigo,'$nome_item','$valor_item');";
        $resultado_novo_item = $ligacao->query($query_novo_item);
        $msg_envio = "<span class ='text-success'>Sucesso ao cadastrar!";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5 ">
        <div class="row justify-content-center ">
            <div class="col-md-4">
                <div class="card border-primary">
                    <div class="card-body">
                        <h3 class="card-title text-center">Cadastro item</h3>
                        <form action="cadastro_item.php" method="post">
                            <div class="form-group">
                                <label for="nome">Nome do item:</label>
                                <input type="text" name="nome_item" class="form-control" id="nome" placeholder="Digite o nome do item">
                                <label for="nome">Valor do item:</label>
                                <input type="number" name="valor_item" class="form-control" id="nome" min="1" step=".01">
                            </div>
                            <div class="d-flex justify-content-around mt-4">
                                <input type="submit" name="salvar_novo_item" class="btn btn-outline-primary btn-block" value="SALVAR ITEM" required>
                                <a class="btn btn-primary btn-sm" href="controlar_item_pedido.php">VOLTAR</a>
                            </div>
                            <?= $msg_envio ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>