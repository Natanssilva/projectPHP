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

    <input id="cc" class="easyui-combobox" name="dept" style="width:200px;" data-options="valueField: 'idpedido',
                                                                                                textField: 'idpedido',
                                                                                               url: 'buscar_pedido.php',
                                                                                            onSelect: function(rec){
                                                                                                $('#dg').datagrid('load', {
                                                                                                        cod_pedido: rec.idpedido
                                                                                                });
                                                                                            }">

    <table id="dg" style="width:700px;height:250px" data-options="border: false,
                                                                                striped: true,
                                                                                singleSelect: true,
                                                                                showFooter: true,
                                                                                checkOnSelect: false,
                                                                                selectOnCheck: false,
                                                                                fitColumns: true">
        <thead>
            <tr>
                <th field="nome_item" data-options="width:100">Nome</th>
                <th field="qtd_solicitada" data-options="width:80">qtd_solicitada</th>
                <th field="valor" data-options="width:80">valor</th>
                <th field="total_item" data-options="width:80">total_item</th>
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