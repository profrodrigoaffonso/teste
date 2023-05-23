<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


require 'conexao.php';
session_start();

$id = $_SESSION['id'];

$sql = "INSERT INTO compras (inscricao_id, data_hora) 
                    VALUE ({$id}, '" . date('Y-m-d H:i:s') . "')";

mysqli_query($conn, $sql);

$sql = "SELECT id FROM compras WHERE inscricao_id = {$id} LIMIT 1";

// echo $sql; die;

$result = mysqli_query($conn, $sql);

$obj = $result->fetch_object();

$compra_id = $obj->id;

$produtos = $_POST['produtos'];

print_r($produtos);

foreach ($produtos as $produto) {
    $sql = "SELECT produto_id, preco FROM precos WHERE id = {$produto} LIMIT 1";

    $result = mysqli_query($conn, $sql);

    $obj = $result->fetch_object();

    $sql = "INSERT INTO compra_produtos (compra_id, produto_id, preco) 
                    VALUE ({$compra_id}, {$obj->produto_id}, {$obj->preco})";

    mysqli_query($conn, $sql);

}


/*envio de e-mail *************************/

$sql = "SELECT nome, email FROM inscricoes WHERE id = {$id} LIMIT 1";
$result = mysqli_query($conn, $sql);

$obj = $result->fetch_object();

$msg = "Caro {$obj->nome}, sua inscrição foi confirmada.";

$sql = "SELECT p.nome AS produto, cp.preco FROM compra_produtos AS cp
                INNER JOIN produtos AS p ON cp.produto_id = p.id
                WHERE cp.compra_id = {$compra_id}";

// echo $sql; die;

$result = mysqli_query($conn, $sql);

$msg .= "<table>
            <thead>
            <tr>
                <th>Produto</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>";

$total = 0;
while($obj = $result->fetch_object()){
    $msg .=  "<tr>
                <td>{$obj->produto}</td>
                <td>R$ " . number_format($obj->preco, 2, ',', '.') . "</td>
        </tr>";
    $total += $obj->preco;
}
$msg .= "</tbody>
</table>
Total: R$ " . number_format($total, 2, ',', '.');




header("Location: confirmada.php");