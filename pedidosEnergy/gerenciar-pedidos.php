<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        $database = "pedidos_energy";
        $username = "root";
        $password = "";

        //verifica se foi conectado certo
        //usando try catch pra tratar exceções

       try {  //tenta conectar n0 database, caso de erro intorrompe e vai pro bloco catch
        $ligacao = new PDO("mysql:host=localhost;dbname=$database", $username, $password) ;
        $estado = $ligacao->getAttribute(PDO::ATTR_CONNECTION_STATUS);    // essa função retorna um atributo d status da conexão do db, verifica se foi com sucesso
        echo "Database conectado. $estado";   // caso conecte retorna na tela

        //no bloco catch ele captura os erros do try e trata esses erros

       } catch (PDOException $estado) {  //captura uma exceção de $estado 
         echo " Erro de conexão com o database";   
       }
       
       
        
    ?>
</body>
</html>




