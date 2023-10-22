 <?php
    require_once 'connect.php';

    error_reporting(0);

    $num_pedido_modificar = $_GET['num_pedido'];

    $seq_item_modificar = $_GET['seq_item'];

    $query_itens_disponiveis =  'SELECT den_item, cod_item FROM item;';
    $resultado_itens_disponiveis = $ligacao->query($query_itens_disponiveis);

    $itens_disponiveis = $resultado_itens_disponiveis->fetchAll();

    if (isset($_POST['pedidoSelecionado'])) {
        $pedidoSelecionado = $_POST['pedidoSelecionado'];
    }

    $num_pedido_new = $pedidoSelecionado;
   

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // showArray($_POST);
        // $pedidoSelecionado = $_POST['pedidoSelecionado'];
        $id_pedido = $_POST['id_pedido']; 
       
        $numero_pedido_incluir = $_POST['num_pedido'];
        $qtd_solicitada = $_POST['QtdSelecionada'];
        $cod_item_recebido_pelo_selector = $_POST['itens'];
     
            
      if ($_POST['salvar_itens']) {
        $query_inclusao_item = "INSERT INTO item_pedido
        (num_pedido, num_seq_item, cod_item, qtd_solicitada, pre_unitario)
        VALUES ($id_pedido, (SELECT ip.num_seq_item + 1 AS increment_num_seq_item
                                FROM item_pedido AS ip
                                WHERE ip.num_pedido
                                ORDER BY ip.num_seq_item DESC
                                LIMIT 1), $cod_item_recebido_pelo_selector,
                                 $qtd_solicitada,
                                 (SELECT valor
                                FROM item 
                                WHERE cod_item = $cod_item_recebido_pelo_selector));";
    
    
        $resultado_inclusao_item = $ligacao->query($query_inclusao_item);
        header('Location: index.php');
        
      }

        
    }
 
   


   


    //MODIFICAR ITEM

    
   

    ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Incluir Item</title>
     <link rel="stylesheet" href="modItem.css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
 </head>

 <body class="container">
    
        <h3> O pedido escolhido foi : <?= $pedidoSelecionado ?></h3>
         <form action="controlar_item_pedido.php" method="post">
            <input type="hidden" name="id_pedido" value="<?= $num_pedido_new ?>">
             <table class="tabela table table-bordered table-responsive" border="1">
                 
                 <tr>
                     <td>Item:</td>
                     <td colspan="2">
                         <select class="form-select form-select-sm" name="itens" id="" required>
                             <option value=""></option>
                             <?php foreach ($itens_disponiveis as $value) { ?>
                                 <option value="<?php echo ($value['cod_item']) ?>"><?php echo ($value['den_item'])  ?></option>
                             <?php } ?>
                         </select>
                     </td>

                 </tr>
                 <tr>
                     <td>Qtd:</td>
                     <td>
                         <input class="form-control" type="number" name="QtdSelecionada" id="" required min="1" max="10">
                     </td>
                 </tr>
                 <tr>
                     <td colspan="2">
                         <input type="hidden" name="num_pedido" value="<?php echo $numero_pedido_incluir; ?>">
                         <input class="btn btn-primary" name="salvar_itens" type="submit" value="SALVAR">

                         <a href="index.php" class="btn btn-outline-primary">VOLTAR</a>
                      
                     </td>
                 </tr>
             </table>
         </form>
  

 </body>

 </html>