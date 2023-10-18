<?php

require_once 'connect.php';



    if ($_POST['salvar_novo_cliente']) {

        //RECUPERAR O ULTIMO COD_CLIENTE + 1
    
        $query_novo_cod_cliente = 'SELECT MAX(cod_cliente) + 1 AS proximo_cod_cliente FROM cliente;';
        $resultado_novo_cod_cliente = $ligacao->query($query_novo_cod_cliente);
        $novo_cod_cliente = $resultado_novo_cod_cliente->fetch();
        //showArray($novo_cod_cliente);
    
        //variavel que contem o novo codigo do cliente que vai ser cadastrado
        $novo_cod = $novo_cod_cliente['proximo_cod_cliente'];
    
    
    
        $nome_cliente_novo = ucfirst($_POST['nome_cliente']); //todo nome_cliente cadastrado no banco vai vir com a 1ºletra maiusc
    
        if (empty($nome_cliente_novo)) {
           echo "erro";
        
        } else {
            $query_novo_cliente_nome = "INSERT INTO cliente (cod_cliente, nom_cliente)
                VALUES ($novo_cod, '$nome_cliente_novo');";
    
            $resultado_novo_cliente = $ligacao->query($query_novo_cliente_nome);
    
            // pegando o ultimo cliente após o insert
            $query_ultimo_cliente = "SELECT cod_cliente, nom_cliente FROM cliente WHERE cod_cliente = {$novo_cod}";
    
            $resultado_ultimo_cliente = $ligacao->query($query_ultimo_cliente);
            $ult_cliente = $resultado_ultimo_cliente->fetchAll();
            header("Location: index.php");
        }
    }
    

