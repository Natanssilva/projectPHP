<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    
        $database = "";
        $username = "";
        $password = "";
    
        $ligacao = new PDO("mysql:host=localhost;dbname=$database", $username,$password);
    
        //verifica se foi conectado certo
    
        $estado = $ligacao ->getAttribute(PDO::ATTR_CONNECTION_STATUS);
        echo $estado;

    ?>
</body>
</html>