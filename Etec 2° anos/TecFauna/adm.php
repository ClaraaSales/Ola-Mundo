<?php ///
include "conexao.php";


$nome = 'Administrador';
$email = 'admin@admin123';
$senha = 'SenhaSegura#098';


$hash = password_hash($senha, PASSWORD_DEFAULT);

$usuarios = $conn->prepare("INSERT INTO usuarios (nome, email, senha, tipo) VALUES (:nome, :email, :senha, 'admin')");
$usuarios->execute([':nome'=>$nome, ':email'=>$email, ':senha'=>$hash]);

echo "Admin criado com sucesso."; ///