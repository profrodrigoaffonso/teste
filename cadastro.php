<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


require 'conexao.php';

$cpf = $_POST['cpf'];
$tipo_inscricao_id = $_POST['tipo_inscricao_id'];

$sql = "INSERT INTO inscricoes (cpf, tipo_inscricao_id) 
                        VALUE (?, ?)";

/* create a prepared statement */
$stmt = mysqli_prepare($conn, $sql);

/* bind parameters for markers */
mysqli_stmt_bind_param($stmt, "ss", $cpf, $tipo_inscricao_id);

mysqli_stmt_execute($stmt);

$sql = "SELECT id, tipo_inscricao_id FROM inscricoes WHERE cpf = '{$cpf}' LIMIT 1";

$result = mysqli_query($conn, $sql);

$obj = $result->fetch_object();

$id = $obj->id;
$tipo_inscricao_id = $obj->tipo_inscricao_id;

// die($id);

session_start();

$_SESSION['id'] = $id;
$_SESSION['tipo_inscricao_id'] = $tipo_inscricao_id;

header("Location: cadastro_endereco.php");