<?php
require 'conexao.php';

$cpf = $_POST['cpf'];
$tipo_inscricao_id = $_POST['tipo_inscricao_id'];

$sql = "INSERT INTO inscricoes (cpf, tipo_inscricao_id) 
                        VALUE ('{$cpf}', {$tipo_inscricao_id})";

$result = mysqli_query($conn, $sql);

$sql = "SELECT id FROM inscricoes WHERE cpf = '{$cpf}' LIMIT 1";

$result = mysqli_query($conn, $sql);

$obj = $result->fetch_object();

$id = $obj->id;

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
                <input type="text" name="id" value="<?php echo $id ?>">
                <button type="submit" id="btnCadastrar" class="btn btn-primary">Cadastrar</button>
            </form>
        </div>
    </body>
</html>
