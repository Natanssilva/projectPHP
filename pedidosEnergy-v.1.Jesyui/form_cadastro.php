<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="container">

        <div class="d-flex justify-content-center">
                <div>
                    <div>
                        <h3 class="card-title text-center">Cadastro novo cliente</h3>
                        <form id="form_cadastro_cliente" name="form-cadastro" action="cadastro_cliente.php" method="post">
                            <div class="form-group">
                                <label for="nome">Nome do cliente:</label>
                                <input type="text" name="nome_cliente" class="form-control" id="campo_nome" placeholder="Digite seu nome" >
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-4">
                                    <input type="submit" name="salvar_novo_cliente" class="btn btn-primary btn-block" value="SALVAR">
                                </div>
                                <div class="col-md-6 mt-4">
                                    <a class="btn btn-secondary btn-block" href="index.php">VOLTAR</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
  
        <script>
           let submit_cadastro_cliente = document.querySelector('#form_cadastro_cliente').addEventListener('submit', function submitForm(event){
                
                let input_nome = document.querySelector('#campo_nome').value;

                if (input_nome.trim() == "" || input_nome.length == 0) { //se após tirar os espaços e for igual a vazio
                    event.preventDefault(); //parando o evento de submit do formulario
                    alert('erro campo vazioo');
                }else if( input_nome.length <= 3){
                     event.preventDefault(); 
                    alert('Digite um nome com mais de 3 digitos');
                }
                
           })

        </script>
</body>
</html>