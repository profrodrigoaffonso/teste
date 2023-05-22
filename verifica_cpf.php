<?php
require 'conexao.php';


$cpf = $_GET['cpf'];

$sql = "SELECT id FROM inscricoes WHERE cpf = '{$cpf}' LIMIT 1";

// die($sql);

$result = mysqli_query($conn, $sql);

$obj = $result->fetch_object();

if($obj){
    echo 'jacad';
} else {
    echo 'ok';
}