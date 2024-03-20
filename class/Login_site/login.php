<?php

include_once '../Conectar.php';

$email = $_POST['email'];
$senha = md5($_POST['senha']);

$sql = "SELECT * FROM usuario WHERE email = ? and senha = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('ss', $email, $senha);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_array();

      if (empty($row)){
        header("location: ../../index.php?p=pages/login&err=101");
        die();
      }else{
        session_start();
            $_SESSION['user'] = [
                'email' => $email
            ];
        
        
        header('location: ../../index.php');
        exit;
      }
?> 