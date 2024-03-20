<?php

include_once '../Conectar.php';

$email = $_POST['email'];
$nome = $_POST['nome'];
$senha = MD5($_POST['senha']);


$sql = "SELECT * FROM usuario WHERE email = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_array();
    if (!empty($row)) {
      header("location: ../../index.php?p=pages/user_config&err=101");
    } else {
        $query = "INSERT INTO usuario (nome,email,senha) VALUES ('$nome','$email','$senha')";
        $insert = $con->prepare($query);
        $insert->execute();

        header("location: ../../index.php?p=pages/user_config");
        exit;
    }

