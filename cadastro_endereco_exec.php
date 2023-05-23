<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


require 'conexao.php';
session_start();

$id = $_SESSION['id'];


$sql = "UPDATE inscricoes SET
            nome = ?, nascimento = ?, email = ?, cep = ?, endereco = ?,
            numero = ?, complemento = ?, bairro = ?, cidade = ?, uf = ? 
            WHERE id = {$id}";

/* create a prepared statement */
$stmt = mysqli_prepare($conn, $sql);

/* bind parameters for markers */
mysqli_stmt_bind_param($stmt, "ssssssssss", $_POST['nome'], $_POST['nascimento'], $_POST['email'], $_POST['cep'], $_POST['endereco'], $_POST['numero'], $_POST['complemento'], $_POST['bairro'], $_POST['cidade'], $_POST['uf']);

mysqli_stmt_execute($stmt);

header("Location: selecionar.php");