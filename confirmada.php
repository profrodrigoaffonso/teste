<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


require 'conexao.php';
session_start();

$id = $_SESSION['id'];

$sql = "SELECT id FROM compras WHERE inscricao_id = {$id} LIMIT 1";

// echo $sql; die;

$result = mysqli_query($conn, $sql);

$obj = $result->fetch_object();

$compra_id = $obj->id;

$sql = "SELECT p.nome AS produto, cp.preco FROM compra_produtos AS cp
                INNER JOIN produtos AS p ON cp.produto_id = p.id
                WHERE cp.compra_id = {$compra_id}";

// echo $sql; die;

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
            <h1 class="text-center">Compra confirmada</h1>
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
                    $total = 0;
                    while($obj = $result->fetch_object()){
                        echo "<tr>
                                    <td>{$obj->produto}</td>
                                    <td>R$ " . number_format($obj->preco, 2, ',', '.') . "</td>
                            </tr>";
                        $total += $obj->preco;
                    }
                    ?>
                </tbody>
            </table>
            Total: R$ <?php echo number_format($total, 2, ',', '.')?>
            </form>
        </div>
    </body>
</html>

