<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <!-- <script
        src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script> -->
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
                                <p class="text-danger"></p>
                            </div>
                            <div class="d-flex justify-content-around">
                                    <a href="index.php" class="btn btn-primary btn-block">VOLTAR </a>
                                    <input id="salvarBotao" type="submit" name="salvar_novo_cliente" class="btn btn-primary btn-block" value="SALVAR">
                            </div>
                        </form>
                    </div>
                </div>
        </div>
  
        <script>
           let submit_cadastro_cliente = document.querySelector('#form_cadastro_cliente').addEventListener('submit', function submitForm(event){
            event.preventDefault();
                let erro = document.querySelector('.text-danger') ;
                let input_nome = document.querySelector('#campo_nome');
                let nome = input_nome.value;
               
                if (nome.trim() == "" || nome.length <= 3) { //se após tirar os espaços e for igual a vazio
                    event.preventDefault(); //parando o evento de submit do formulario
                    input_nome.style.border = '1px solid red';
                    erro.innerHTML = 'ERRO! Nome inválido.';
                }else{
                    input_nome.style.border = '';
                    erro.innerHTML = '';
                }
                
                
           })


        </script>
</body>
</html>