<?php

include "../conexao.php";

$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST["senha"];
$senhaCript=password_hash($senha,PASSWORD_DEFAULT);
$data_nasc = $_POST["data_nasc"];


if (($nome=="") || ($email=="") || ($senha=="") || ($data_nasc=="")){
    echo "<script>alert('Campos nao podem ser vazios!!!');history.go(-1);</script>";
}
 else {

     $usuario = $conn->prepare('SELECT * FROM usuarios WHERE email=:email');
     $usuario->execute(array(
        ':email' => $email
    ));

    if($usuario->rowCount()==1){
        echo "<script>alert('esse email ja existe');history.go(-1);</script>";
    }

    else {

    $usuario = $conn->prepare('INSERT INTO usuarios(nome, email, senha, data_nascimento) VALUES 
    (:nome, :email, :senha, :data_nasc )');

    $usuario->execute(array(
    ':nome' => $nome,
    ':email' => $email,
    ':senha' => $senhaCript,
    ':data_nasc' => $data_nasc

    ));

    if ($usuario->rowCount()==1){
        echo "<script>alert('Incluido com sucesso!!!');history.go(-1);</script>";
        sleep(1);
    } 
    else {
        echo "<script>alert('Erro ao incluir');history.go(-1);</script>";
    }

    } 
}
 
?>