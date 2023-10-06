<!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/icon.css">
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>

</head>
 
<body>
    <?php require_once('connect.php')  ?>
    <h1>Lista de Pedidos</h1>
    
    <input id="cc" class="easyui-combobox" name="dept" style="width:200px;" data-options="valueField: 'idpedido',
                                                                                                textField: 'idpedido',
                                                                                               url: 'buscar_pedido.php',
                                                                                            onSelect: function(rec){
                                                                                                $('#dg').datagrid('load', {
                                                                                                        nom_cliente: rec.nome_cliente,
                                                                                                        cod_pedido: rec.idpedido
                                                                                                        
                                                                                                });
                                                                                                let nome_cliente = document.querySelector('#ClienteNome');
                                                                                                nome_cliente.innerHTML = rec.nome_cliente;
                                                                                            }">
    <p>Cliente: <span id="ClienteNome"></span></p>
    <table id="dg" style="width:700px;height:250px" data-options="border: true,
                                                                                striped: true,
                                                                                singleSelect: true,
                                                                                showFooter: true,
                                                                                checkOnSelect: false,
                                                                                selectOnCheck: false,
                                                                                fitColumns: true">
                                                                                
        <thead>
            <tr>
                <th field="nome_item" data-options="width:100">Nome</th>
                <th field="qtd_solicitada" data-options="width:80">Quantidade</th>
                <th field="valor" data-options="width:80">Preço</th>
                <th field="total_item" data-options="width:80">Total por item</th>
                <th field="total_pedido" data-options="width:120">Total do pedido:</th>        
            </tr>
        </thead>
    </table>
    
    
    <!-- <a class="easyui-linkbutton" onclick="myFunction()">Click me</a> -->
    <script type="text/javascript">
        $(function() {
            $('#dg').datagrid({
                url: 'buscar_item_pedido.php',
            });
        });

    </script>
</body>

</html>