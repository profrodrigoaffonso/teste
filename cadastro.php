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

//mysqli_stmt_execute($stmt);

echo $cpf;

$city = "Amersfoort";

/* create a prepared statement */
$stmt = mysqli_prepare($conn, "SELECT id FROM inscricoes WHERE cpf=? LIMIT 1");

/* bind parameters for markers */
mysqli_stmt_bind_param($stmt, "s", $cpf);

/* execute query */
mysqli_stmt_execute($stmt);

mysqli_stmt_fetch($stmt);

/* bind result variables */
mysqli_stmt_bind_result($stmt, $id);
die($id);
session_start();
$_SESSION['id'] = $id;

die($_SESSION['id']);

/* fetch value */
mysqli_stmt_fetch($stmt);

// printf("%s is in district %s\n", $city, $district);
// die;

// $id = $obj->id;

header("Location: cadastro_endereco.php");