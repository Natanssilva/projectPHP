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
                                                                                                window.pedidoSelecionado = rec.idpedido;
                                                                                                window.clientePedido = rec.nome_cliente;
                                                                                                console.log(pedidoSelecionado);
                                                                                                console.log(clientePedido);
                                                                                            }">



    <p>Cliente: <span id="ClienteNome"></span></p>
    <table id="dg" class="easyui-datagrid" style="width:950px;height:350px" data-options="border: true,
                                                                                striped: true,
                                                                                singleSelect: true,
                                                                                showFooter: true,
                                                                                checkOnSelect: false,
                                                                                selectOnCheck: false,
                                                                                fitColumns: true,
                                                                                toolbar: '#tf',
                                                                                footer: '#tb'">

        <thead>
            <tr>
                <th data-options="field:'ck', checkbox:true" class="easyui-checkbox"></th>
                <th data-options="field:'nome_item',width:200">Nome</th>
                <th data-options="field: 'qtd_solicitada', width:80">Quantidade</th>
                <th data-options="field: 'valor' ,width:80">Preço</th>
                <th data-options="field: 'total_item', width:80">Total por item</th>
                <th data-options="field: 'total_pedido',width:120">Total do pedido:</th>

            </tr>
        </thead>
    </table>


    <!-- toolbar -->
    <div id="tb" style="padding:2px 5px;">
        <a id="bttnIncluirItem" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-add'" plain="true" onclick="$('#dlg-incluirItem').dialog('open')">Incluir item </a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-cut" plain="true">Modificar item</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="confirm2()">Excluir itens</a>
        <a id="btn" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-add'" plain="true" onclick="$('#w').window('open')">Incluir Pedido</a>
        <a id="bttnModificarPedido" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-edit'" plain="true" onclick="$('#dlg-modificarPedido').dialog('open')">Modificar Pedido</a>
        <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-cancel'" plain="true" onclick="confirm1();">Excluir Pedido</a>
    </div>

    <!-- botoes  FORA DA TABEÇA aqui em baixo -->
    <!-- <div style="margin:20px 0;">
       
    </div> -->



    <div id="w" class="easyui-window" title="Incluir pedido" data-options="modal:true,closed:true,iconCls:'icon-save'" style="width:525px;height:320px;padding:10px;">
        <div id="content-modal">

        </div>

        <div style="margin:20px 0;">
            <a id="btn_cadastro" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-help'" onclick="$('#cadastro_cliente').window('open')">Cadastrar novo cliente</a>
        </div>

    </div>

    <!-- incluir item -->

    <div id="dlg-incluirItem" class="easyui-dialog" title="Incluir item" data-options="iconCls:'icon-save', closed:true" style="width:500px;height:335px;padding:10px">
        <div id="content-incluir-item"></div>

        <div style="margin:20px 0;">
            <a id="btn_cadastrar_item" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-help'" onclick="$('#cadastro_item').window('open')">Cadastrar item</a>
        </div>
    </div>

    <!-- Modificar Pedido -->

    <div id="dlg-modificarPedido" class="easyui-dialog" title="Modificar Pedido" data-options="iconCls:'icon-save', closed:true" style="width:500px;height:335px;padding:10px">
        <div id="content-modificar-pedido"></div>


    </div>


    <!-- excluir Pedido -->

    <div id="dlg-excluirPedido" class="easyui-dialog" title="Excluir Pedido" data-options="iconCls:'icon-cancel', closed:true" style="width:500px;height:335px;padding:10px">
        <div id="content-excluir-pedido"></div>

    </div>

    <!-- excluir item -->

    <div id="dlg-excluirItem" class="easyui-dialog" title="Excluir item" data-options="iconCls:'icon-cancel', closed:true" style="width:500px;height:335px;padding:10px">
        <div id="content-excluir-item"></div>

    </div>




    <!-- <a class="easyui-linkbutton" onclick="myFunction()">Click me</a> -->
    <script>
        $(function carregarCombo() {
            var num_pedido = "<?= $val_get ?>";

            $('#dg').datagrid({
                url: 'buscar_item_pedido.php',

            });
            $('#cc').combobox('setValue', num_pedido);
                return num_pedido;
        });

        //selecionando itens pedido

        let rowData;
        console.log(rowData) //declarando o rowData em um escopo mais amplo pra conseguir acessar na requisicao
        $(function() {
            $('#dg').datagrid({
                rownumbers: true,
                singleSelect: false,
                checkOnSelect: true,
                selectOnCheck: true,
                onCheck: function(rowIndex, rowData) { //pega o indice da linha seleconado e pega os valores da linha com rowData
                    console.log('Linha marcada:', rowData);

                    return rowData;
                }

            });
        });



        // excluir item

        // funções pra mostrar mensagem na tela
        
        function showItem() {
            $.messager.show({
                title: 'Erro ao deletar item!',
                msg: 'Nenhum item foi previamente selecionado',
                showType: 'show'
            });
        }

        function slideItem() {
            $.messager.show({
                title: 'Exclusão de item',
                msg: 'Item(s) excluido com sucesso! ',
                timeout: 3800,
                showType: 'slide'
            });
        }
       

        function confirm2() {
            // console.log(' função de excluir', rowData) //undefined
            var rows = $('#dg').datagrid('getChecked');
            var data = "";
            $.each(rows, function() {
                data += this.num_seq_item ;
            });

            // console.log(data);
            // console.log('Natan está  levemente confuso');
            $.messager.confirm('Excluir item', 'Deseja excluir o(s) item selecionado?', function(r) { //r = OK 
                if (r) {

                    $.ajax({
                        url: 'excluir_item_pedido.php',
                        data: {
                            rowData: data,
                            pedidoSelecionado: window.pedidoSelecionado
                        },
                        method: 'post',
                        dataType: 'json',
                        success: function(response) {
                            if (response.status == 'true') {    //Ta deletando apenas um item, se selecionar +1, nao deleta
                                slideItem();
                            }else{
                                showItem();
                            }
                            
                        },
                        error: function(response) {
                            console.log('ERRO');
                            
                        }
                    });

                } else {
                    return;
                }
            });
        }

        




        $('#btn').click(function() {

            //fetch retorna promise / promise retorna obj response com server info, pra pegar com json só usar a função json
            fetch('controlar_pedido.php', {
                    method: 'POST'
                })

                .then(response => response.text()) //text() método de response como string e HTML nesse caso
                .then(data => { //data armazena valores da response do servidor e manipula ajax
                    $('#content-modal').html(data);
                    $('#w').window('open');
                })
        });

        $('#btn_cadastro').click(function() {
            $.ajax({
                url: 'form_cadastro.php',
                method: 'POST',
                success: function(data) {
                    $('#content-modal').html(data);
                    $('#w').window('open');
                    $('#btn_cadastro').hide();

                },
                error: function() {
                    console.log('Erro ao trazer o formulario ');
                }
            });
        });

        $('#bttnIncluirItem').click(function() {
            $.ajax({
                url: 'controlar_item_pedido.php',
                data: {
                    pedidoSelecionado: window.pedidoSelecionado
                },
                method: 'POST',
                success: function(data) {

                    $('#dlg-incluirItem').dialog('open');
                    $('#content-incluir-item').html(data);


                },
                error: function() {
                    console.log('Erro ao trazer o formulario ');
                }
            });

        });
        $('#btn_cadastrar_item').click(function() {
            $.ajax({
                url: 'cadastro_item.php',
                method: 'POST',
                success: function(data) {
                    $('#content-incluir-item').html(data);
                    $('#dlg-incluirItem').window('open');
                    $('#btn_cadastrar_item').hide();

                },
                error: function() {
                    console.log('Erro ao trazer o formulario ');
                }
            });
        });

        $('#bttnModificarPedido').click(function() {
            $.ajax({
                url: 'modificar_pedido.php',
                data: {
                    pedidoSelecionado: window.pedidoSelecionado,
                    clientePedido: window.clientePedido
                },
                method: 'POST',
                success: function(data) {

                    $('#dlg-modificarPedido').dialog('open');
                    $('#content-modificar-pedido').html(data);


                },
                error: function() {
                    console.log('Erro ao trazer o formulario ');
                }
            });

        });

        //excluir pedido

        function show() {
            $.messager.show({
                title: 'Erro ao deletar pedido!',
                msg: 'Nenhum pedido foi previamente selecionado',
                showType: 'show'
            });
        }

        function slide() {
            $.messager.show({
                title: 'Exclusão de pedido',
                msg: 'Pedido excluido com sucesso! ',
                timeout: 3800,
                showType: 'slide'
            });
        }

        function confirm1() {
            $.messager.confirm('Excluir Pedido', 'Deseja excluir o Pedido?', function(r) { //r = OK 
                if (r) {

                    $.ajax({
                        url: 'excluir_pedido.php',
                        data: {
                            pedidoSelecionado: window.pedidoSelecionado
                        },
                        method: 'post',
                        dataType: 'json',
                        success: function(response) {
                            if (response.status == 'true' || response.status == 'true SI') {
                                console.log(response);
                                slide();

                            } else {
                                console.log(response);
                                show();
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });



                    // alert('deletou')
                } else {
                    return;
                }
            });
        }
    </script>
</body>

</html>