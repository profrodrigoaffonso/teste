<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


require 'conexao.php';
session_start();

$id = $_SESSION['id'];

?>
<!DOCTYPE html>
<html lang="pt_br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <title>Rodrigo Affonso - desenvolvedor</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            <h1 class="text-center">Cadastro</h1>
            <form method="post" action="cadastro_endereco_exec.php">
                <input type="text" name="id" value="<?php echo $id ?>">
                <div class="mb-3">
                    <label for="cpf" class="form-label">Nome</label>
                    <input required type="text" class="form-control" maxlength="200" id="nome" name="nome">
                </div>
                <div class="mb-3">
                    <label for="cpf" class="form-label">E-mail</label>
                    <input required type="email" class="form-control" maxlength="200" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="cpf" class="form-label">Data de nascimento</label>
                    <input required type="date" class="form-control" id="nascimento" name="nascimento">
                </div>
                <div class="mb-3">
                    <label for="cpf" class="form-label">CEP</label>
                    <input onblur="verificaCEP()" maxlength="8" required type="text" class="form-control" id="cep" name="cep">
                   
                </div>                
                <div class="mb-3">
                    <label for="cpf" class="form-label">Endereço</label>
                    <input required type="text" class="form-control" maxlength="200" id="endereco" name="endereco">
                </div>
                <div class="mb-3">
                    <label for="cpf" class="form-label">Número</label>
                    <input required type="text" class="form-control" maxlength="20" id="numero" name="numero">
                </div>
                <div class="mb-3">
                    <label for="cpf" class="form-label">Complemento</label>
                    <input type="text" class="form-control" id="complemento" maxlength="50" name="complemento">
                </div>
                <div class="mb-3">
                    <label for="cpf" class="form-label">Bairro</label>
                    <input required type="text" class="form-control" id="bairro" maxlength="200" name="bairro">
                </div>
                <div class="mb-3">
                    <label for="cpf" class="form-label">Cidade</label>
                    <input required type="text" class="form-control" id="cidade" maxlength="200" name="cidade">
                </div>
                <div class="mb-3">
                    <label for="cpf" class="form-label">UF</label>
                    <input required type="text" class="form-control" id="uf" maxlength="2" name="uf">
                </div>
                
                <button type="submit" id="btnCadastrar" class="btn btn-primary">Cadastrar</button>
            </form>
        </div>
    </body>
    <script>
        function verificaCEP() {
            var xmlhttp = new XMLHttpRequest();

            cep = document.getElementById('cep').value;

            //console.log(cpf)

            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == XMLHttpRequest.DONE) { // XMLHttpRequest.DONE == 4
                    if (xmlhttp.status == 200) {
                        resp = xmlhttp.responseText;
                        obj = JSON.parse(resp)
                        console.log(obj)
                        document.getElementById('endereco').value = obj.tipo_logradouro + ' ' + obj.logradouro
                        document.getElementById('bairro').value = obj.bairro
                        document.getElementById('cidade').value = obj.cidade
                        document.getElementById('uf').value = obj.uf
                    }
                    else if (xmlhttp.status == 400) {
                        alert('There was an error 400');
                    }
                    else {
                        alert('something else other than 200 was returned');
                    }
                }
            };

            xmlhttp.open("GET", "http://cep.republicavirtual.com.br/web_cep.php?cep=" + cep + "&formato=json", true);
            xmlhttp.send();
        }
    </script>
</html>
