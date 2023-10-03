<?php
 require_once('connect.php');

    //incremento +1 no ultimo valor do cod_item pro novo item

 $query_prox_cod_item = "SELECT (MAX(cod_item) + 1) FROM item;";
 $resultado_prox_cod_item = $ligacao ->query($query_prox_cod_item);
 $proximo_cod_item = $resultado_prox_cod_item ->fetch();



foreach ($proximo_cod_item as $value) {
    $int_proximo_cod_item = intval($value);
    echo $int_proximo_cod_item;
}

showArray($proximo_cod_item);


showArray($resultado_novo_item);

if (isset($_POST['salvar_novo_item'])) {
    $nome_item = $_POST['nome_item'];
    $valor_item = $_POST['valor_item'];

    $query_novo_item = "INSERT INTO item VALUES ($proximo_cod_item,'$nome_item','$valor_item');";
    $resultado_novo_item = $ligacao ->query($query_novo_item);
    echo "Item novo salvo";
    
}

showArray($query_novo_item);

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
                                <input type="number" name="valor_item" class="form-control" id="nome">
                            </div>
                                <div class="d-flex justify-content-around mt-4">
                                    <input type="submit" name="salvar_novo_item" class="btn btn-outline-primary btn-block" value="SALVAR ITEM">
                                    <a class="btn btn-primary btn-sm" href="controlar_item_pedido.php">VOLTAR</a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>