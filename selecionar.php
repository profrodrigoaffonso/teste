<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


require 'conexao.php';
session_start();

$id = $_SESSION['id'];
$tipo_inscricao_id = $_SESSION['tipo_inscricao_id'];

$sql = "SELECT p.id, pr.nome produto, p.preco FROM precos AS p 
            INNER JOIN produtos AS pr ON p.produto_id = pr.id
            WHERE p.tipo_inscricao_id = {$tipo_inscricao_id}";

// echo $sql;

$result = mysqli_query($conn, $sql);
?>
<html lang="pt_br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <title>Rodrigo Affonso - desenvolvedor</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            <h1 class="text-center">Produtos</h1>
            <form method="post" action="selecionar_exec.php">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($obj = $result->fetch_object()){
                        echo "<tr>
                                    <td>{$obj->produto}</td>
                                    <td>R$ " . number_format($obj->preco, 2, ',', '.') . "</td>
                                    <td><input type=\"checkbox\" value=\"{$obj->id}\" name=\"produtos[]\"></td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button type="submit" id="btnCadastrar" class="btn btn-primary">Selecionar</button>
            </form>
        </div>
    </body>
</html>

