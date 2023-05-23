<?php
require 'conexao.php';

$sql = 'SELECT id, nome FROM tipos_inscricoes ORDER BY id ASC';

$result = mysqli_query($conn, $sql);

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
            <form method="post" action="cadastro.php">
                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input maxlength="11" onblur="verificaCPF()" required type="text" class="form-control" id="cpf" name="cpf">
                    <p id="msg" style="display: none;">CPF já cadastrado</p>
                </div>
                <div class="mb-3">
                    <label for="cpf" class="form-label">Tipo de Inscrição</label>

                    <select class="form-select" required id="tipo_inscricao_id" name="tipo_inscricao_id" aria-label="Default select example">
                        <option value>Selecione</option>
                        <?php
                        while($obj = $result->fetch_object()){
                            echo "<option value=\"{$obj->id}\">{$obj->nome}</option>" ;
                        }
                        ?>
                    </select>
                </div>
                
              
                <button type="submit" id="btnCadastrar" class="btn btn-primary">Cadastrar</button>
            </form>
        </div>
    </body>
    <script>
        function verificaCPF() {
            var xmlhttp = new XMLHttpRequest();

            cpf = document.getElementById('cpf').value;

            //console.log(cpf)

            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == XMLHttpRequest.DONE) { // XMLHttpRequest.DONE == 4
                    if (xmlhttp.status == 200) {
                        resp = xmlhttp.responseText;
                        if(resp == 'jacad'){
                            document.getElementById("btnCadastrar").setAttribute("disabled", "disabled")
                            document.getElementById("msg").innerHTML = 'CPF já cadastrado'
                            document.getElementById("msg").style.display = "block"
                        } else if(resp == 'invalido'){
                            document.getElementById("btnCadastrar").setAttribute("disabled", "disabled")
                            document.getElementById("msg").innerHTML = 'CPF inválido'
                            document.getElementById("msg").style.display = "block"
                        } else {
                            document.getElementById("btnCadastrar").removeAttribute("disabled")
                            document.getElementById("msg").style.display = "none"
                        }
                    }
                    else if (xmlhttp.status == 400) {
                        alert('There was an error 400');
                    }
                    else {
                        alert('something else other than 200 was returned');
                    }
                }
            };

            xmlhttp.open("GET", "verifica_cpf.php?cpf=" + cpf, true);
            xmlhttp.send();
        }
    </script>
</html>