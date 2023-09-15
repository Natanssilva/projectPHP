   <?php

    $database = "testephp";
    $username = "root";
    $password = "";

    //verifica se foi conectado certo
    //usando try catch pra tratar exceções

    try {  //tenta conectar n0 database, caso de erro intorrompe e vai pro bloco catch
        $ligacao = new PDO("mysql:host=localhost;dbname=$database", $username, $password);
        $estado = $ligacao->getAttribute(PDO::ATTR_CONNECTION_STATUS);    // essa função retorna um atributo d status da conexão do db, verifica se foi com sucesso
        echo "Database conectado. $estado";   // caso conecte retorna na tela

        //no bloco catch ele captura os erros do try e trata esses erros

    } catch (PDOException $estado) {  //captura uma exceção de $estado 
        echo " Erro de conexão com o database";
    }

    $query = "SELECT p.num_pedido, c.nom_cliente
    FROM pedido AS p
    LEFT JOIN cliente AS c ON (p.cod_cliente = c.cod_cliente);";
    $resultado = $ligacao->query($query);
    $pedidos_clientes = $resultado->fetchAll(PDO::FETCH_ASSOC);
    /*echo ('<pre>');
     var_dump($pedidos);
    echo ('</pre>');
    */


    ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Pedidos</title>
</head>
<body>
    <?php foreach ($pedidos_clientes as $pedido) { ?>
        <table border="1">
                <th colspan="6">
                    
                Pedido: <?php echo $pedido['num_pedido']; ?> Cliente: <?php echo $pedido['nom_cliente']; ?> <td> <a href="#">[Incluir Pedido] <br><a href="#">[Excluir Pedido]</a></a></td>
                
                </th>
            <tr>
                <th>Item</th>
                <th>Qtde</th>
                <th>Preço</th>
                <th>Total</th>
            </tr>

            <tr>
                <td colspan="3"></td>
                <td>TOTAL: R$</td>
                
            </tr>
        </table>
        <br>
    <?php } ?>
    
</body>
</html>