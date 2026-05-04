<?php

include "../conexao.php";

session_start();
$id_usuario=$_SESSION['id_usuario'];

if (!isset($_SESSION['id_usuario'])) {
     echo "<script>alert('usuário não logado');history.go(-1);</script>";
}
else{
$nome = trim($_POST['nome']) ?: null;
$cpf = trim($_POST['cpf']) ?: null;
$email = trim($_POST['email']) ?: null;
$telefone = trim($_POST['telefone']) ?: null;
$tipo = trim($_POST['tipo']) ?: null;
$descricao = trim($_POST['descricao']) ?: null;
$estado = trim($_POST['estado']) ?: null;
$cidade = trim($_POST['cidade']) ?: null;
$data_ocorrencia = trim($_POST['data_ocorrencia']) ?: null;
$nome_autoridade = trim($_POST['autoridade']) ?: null;
$tipo_denuncia = trim($_POST['tipo_denuncia']) ?: null;
$data_denuncia = date('Y-m-d');
$id_autoridade = $_POST['autoridade'] ?? null;

if ($descricao === null || $data_ocorrencia === null) {
    echo "<script>alert('Preencha os campos obrigatórios');history.go(-1);</script>";
    exit;
}


$id_local_fisico = null;
$id_local_online = null;

if ($tipo_denuncia === 'fisica') {
    $bairro = $_POST['bairro'] ?: null;
    $rua = $_POST['rua'] ?: null;
    $numero = $_POST['numero'] ?: null;

    $fisico = $conn->prepare("INSERT INTO local_fisico (bairro, rua, numero) VALUES (:bairro, :rua, :numero)");
    $fisico->execute([
        ':bairro' => $bairro,
        ':rua' => $rua,
        ':numero' => $numero
    ]);
    $id_local_fisico = $conn->lastInsertId();
} 
elseif ($tipo_denuncia === 'online') {
    $plataforma = $_POST['plataforma'] ?: null;

    $online = $conn->prepare("INSERT INTO local_online (plataforma) VALUES (:plataforma)");
    $online->execute([
        ':plataforma' => $plataforma
    ]);
    $id_local_online = $conn->lastInsertId();
}

try {
    $denuncia = $conn->prepare("INSERT INTO denuncias (id_usuario, nome, cpf, email, telefone, tipo, descricao, id_local_fisico, id_local_online, estado, cidade, data_ocorrencia, id_autoridade, nome_autoridade, data_denuncia, status) 
    VALUES (:id_usuario, :nome, :cpf, :email, :telefone, :tipo, :descricao, :id_local_fisico, :id_local_online, :estado, :cidade, :data_ocorrencia, :id_autoridade, :nome_autoridade, :data_denuncia, :status)"); 
    

    $denuncia->execute([
        ':id_usuario' => $id_usuario,
        ':nome' => $nome,
        ':cpf' => $cpf,
        ':email' => $email,
        ':telefone' => $telefone,
        ':tipo' => $tipo,
        ':descricao' => $descricao,
        ':id_local_fisico' => $id_local_fisico,
        ':id_local_online' => $id_local_online,
        ':estado' => $estado,
        ':cidade' => $cidade,
        ':data_ocorrencia' => $data_ocorrencia,
        ':id_autoridade' => $id_autoridade,
        ':nome_autoridade' => $nome_autoridade,
        ':data_denuncia' => $data_denuncia,
        ':status' => 'pendente' 
    ]);

    $id_denuncia = $conn->lastInsertId();

    $localizacaopasta= './img/';
    if (!empty($_FILES['evidencias']['name'][0])) {
    foreach ($_FILES['evidencias']['name'] as $index => $nomeArquivo) {
        $tmp = $_FILES['evidencias']['tmp_name'][$index];
        $caminhoFinal = $localizacaopasta . $nomeArquivo;

        if (move_uploaded_file($tmp, $caminhoFinal)) {
            $imagens = $conn->prepare("INSERT INTO imagens (imagem, id_denuncia) VALUES (:imagem, :id_denuncia)");
            $imagens->execute([
                ':imagem' => $caminhoFinal,
                ':id_denuncia' => $id_denuncia
            ]);
        }
    }
}


    if ($denuncia->rowCount() == 1) {
        echo "<script>alert('Denúncia enviada com sucesso!'); window.location.href='minhas_denuncias.php';</script>";
        exit;
    } else {
        echo "<script>alert('Erro: não foi possível salvar a denúncia.');history.go(-1);</script>";
        exit;
    }

} catch (PDOException $e) {
    echo "Erro no banco: " . $e->getMessage();
    exit;
}

}


?>

