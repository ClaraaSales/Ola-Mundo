<?php
include "../conexao.php";

session_start();
if (!isset($_SESSION['id_usuario']) || ($_SESSION['tipo'] ?? '') !== 'admin') {
    echo "<script>alert('Acesso negado.');window.location.href='../login/login.html';</script>";
    exit;
}

$id = $_POST['id_denuncia'] ?? 0;
$acao = $_POST['acao'] ?? '';

if ($id <= 0) {
    echo "<script>alert('ID inválido');history.go(-1);</script>";
    exit;
}

if ($acao === 'aprovar') {
    $novoStatus = 'aprovada';
} elseif ($acao === 'rejeitar') {
    $novoStatus = 'rejeitada';
} else {
    echo "<script>alert('Ação inválida');history.go(-1);</script>";
    exit;
}


$status = $conn->prepare("UPDATE denuncias SET status = :status WHERE id_denuncia = :id");
$status->execute([
    ':status' => $novoStatus, 
    ':id' => $id]);


header("Location: aprovar_denuncias.php");
exit;
