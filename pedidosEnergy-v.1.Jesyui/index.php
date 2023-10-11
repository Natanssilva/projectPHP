

<html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/icon.css">
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php 
        require_once('connect.php');
    ?>
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
    <div style="margin:20px 0;">
        <a id="btn" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-add'" onclick="$('#w').window('open')">Incluir Pedido</a>
        <a id="btn-opcoes" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-help'" onclick="$('#dlg').window('open')">Opções</a>
    </div>
    <div id="w" class="easyui-window" title="Incluir pedido" data-options="modal:true,closed:true,iconCls:'icon-save'" style="width:525px;height:320px;padding:10px;">
        <div id="content-modal">
           
        </div>

        <div style="margin:20px 0;">
            <a id="btn_cadastro" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-help'" onclick="$('#cadastro_cliente').window('open')">Cadastrar novo cliente</a>
        </div>
        
    </div>


    <!-- complex dialog -->
    <div id="dlg" class="easyui-dialog" title="Complex Toolbar on Dialog" style="width:750px;height:450px;padding:10px;" data-options="
                iconCls: 'icon-save',
                toolbar: '#dlg-toolbar',
                buttons: '#dlg-buttons',
                closed: true
            ">
        <div class="easyui-panel" title="Nested Panel" style="width:700px;height:200px;padding:10px;">
            <div class="easyui-layout" data-options="fit:true">
                <div data-options="region:'west',split:true" style="width:100px;padding:10px">
                    Left Content
                </div>
                <div data-options="region:'east'" style="width:100px;padding:10px">
                    Right Content
                </div>
                <div data-options="region:'center'" style="padding:10px">
                    Center Content
                </div>
            </div>
        </div>
        The dialog content.
    </div>
    <div id="dlg-toolbar" style="padding:2px 0">
        <table cellpadding="0" cellspacing="0" style="width:100%">
            <tr>
                <td style="padding-left:2px">
                    <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true">Edit</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-help',plain:true">Help</a>
                </td>
                <td style="text-align:right;padding-right:2px">
                    <input class="easyui-searchbox" data-options="prompt:'Please input somthing'" style="width:150px"></input>
                </td>
            </tr>
        </table>
    </div>


    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" onclick="javascript:alert('save')">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" onclick="javascript:$('#dlg').dialog('close')">Close</a>
    </div>

  

    <!-- <a class="easyui-linkbutton" onclick="myFunction()">Click me</a> -->
    <script>
        $(function() {
            var num_pedido = "<?= $val_get ?>";
            $('#dg').datagrid({
                url: 'buscar_item_pedido.php',
            });
            $('#cc').combobox('setValue', num_pedido);
        });

        $(document).ready(function() {
            $('#btn').click(function() {
                //fetch retorna promise / promise retorna obj response com server info, pra pegar com json só usar a função json
                fetch('controlar_pedido.php', {
                        method: 'POST'
                    })

                    .then(response => response.text()) //text() método de response como string e HTML nesse caso
                    .then(data => {         //data armazena valores da response do servidor e manipula ajax
                        $('#content-modal').html(data);
                        $('#w').window('open');
                    })
                    .catch(error => {
                        console.error('Ocorreu um erro: ', error);
                    })
            });

            $('#btn_cadastro').click(function(){
                fetch('form_cadastro.php',{
                    method: 'POST'
                })
                .then(response => response.text()) //text() método de response como string e HTML nesse caso
                
                .then(data => {
                        $('#content-modal').html(data);
                        $('#w').window('open');
                        $('#btn_cadastro').hide();

                        return fetch('cadastro_cliente.php', {
                            method: 'POST'
                        });
                 })
                 //resposta segunda requisicao
                 .then(response => console.log(response.json())) //resposta como json

                 .then(data => {
                    //acesso aos dados do php como json

                    if (data.status == 'erro1') {
                        alert(data.mensagem);
                    }
                 })
            })

        });
    </script>
</body>

</html>