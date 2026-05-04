<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minhas Denúncias</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Cherry+Cream+Soda&family=Luckiest+Guy&family=Titan+One&display=swap" rel="stylesheet">
    <link href="minhas_denuncias.css" rel="stylesheet">
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">

      <a class="navbar-brand logo">
        <img src="../paginas/imgs/logo.png" width="60" height="30" class="d-inline-block align-top">
      </a>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">

          <li class="nav-item"><a class="nav-link" href="../paginas/sobre_nos.html">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="../paginas/ameacas.html">Ameaças</a></li>
          <li class="nav-item"><a class="nav-link" href="../paginas/mitos.html">Mitos e Dúvidas</a></li>
          <li class="nav-item"><a class="nav-link" href="../paginas/legislacao.html">Legislação</a></li>
          <li class="nav-item"><a class="nav-link" href="../paginas/guia.html">Como Denunciar</a></li>
          <li class="nav-item"><a class="nav-link" href="../denuncias/denuncia_html.php">Denuncie</a></li>
          <li class="nav-item"><a class="nav-link" href="../denuncias/minhas_denuncias.php">Minhas Denúncias</a></li>
          <li class="nav-item"><a class="nav-link" href="../paginas/ongs.html">Ong's</a></li>
          
          <li class="nav-item">
            <a class="btn btn-light" href="../login/cadastro.html">Login</a>
          </li>

        </ul>
      </div>
    </nav>
  </header>

 <section class="hero-image">
   <div class="hero-text">
    <h1>MINHAS DENÚNCIAS</h1>
    <p>Verifique suas denúncias nessa página e <br>
  acompanhe os status das mesmas </p>
  </div>
</section>
<hr>

<?php
include "../conexao.php";
session_start();


if (!isset($_SESSION['id_usuario'])) {
    echo "<script>alert('Você precisa estar logado para ver suas denúncias.');history.go(-1);</script>";
}
else{

$id_usuario = $_SESSION['id_usuario'];

 $exibir = $conn->prepare('SELECT * FROM denuncias WHERE id_usuario = :id_usuario');
 $exibir->execute(array(
            ':id_usuario' => $id_usuario
        ));

$denuncias = $exibir->fetchAll(PDO::FETCH_ASSOC);
}
?>

<section class="minhas-denuncias-section">
<h1>Denúncias</h1>

<?php 
    if (!empty($denuncias)): 
        foreach ($denuncias as $denuncia): 
?>
        <div class="denuncia">
            <p><?= htmlspecialchars($denuncia['tipo']) ?></p>
            <p><strong>Descrição: </strong> <?= htmlspecialchars($denuncia['descricao']) ?></p>
            <p><strong>Data da ocorrência: </strong> <?= htmlspecialchars($denuncia['data_ocorrencia']) ?></p>
            <p><strong>Data de envio da denúncia: </strong> <?= htmlspecialchars($denuncia['data_denuncia']) ?></p>
            <p><strong>Status: </strong><?= htmlspecialchars($denuncia['status'] ?? 'pendente') ?></p>
        </div>
<?php 
        endforeach; 
    else: 
?>
    <p class="mensagem">Você ainda não fez nenhuma denúncia.</p>
<?php endif; ?>

</section>

<footer class="custom-footer">
  <div class="footer-content">

    <div class="footer-box footer-col1">
      <div class="footer-logo-title">
        <img src="../paginas/imgs/logo_pagina.png" alt="Logo" class="footer-logo">
        <h2 style="margin-left: -20px;">TecFauna</h2>
      </div>
      <p>Unindo pessoas e tecnologia para proteger
      quem não pode pedir ajuda.</p>
    </div>

    <div class="footer-box">
      <h3>Contate-nos</h3>
      <p>(+55) 119999999</p>
      <p>E-mail: <a href="tecfauna@gmail.com">tecfauna@gmail.com</a></p>
    </div>

    <div class="footer-box">
      <h3>Links rápidos</h3>
      <ul>
        <li><a href="./sobre_nos.html">Sobre nós</a></li>
        <li><a href="./mitos.html">Mitos e dúvidas</a></li>
        <li><a href="./legislacao.html">Legislação</a></li>
      </ul>
    </div>

    <div class="footer-box">
      <ul>
        <li><a href="./guia.html">Como denunciar</a></li>
        <li><a href="../denuncias/denuncia_html.php">Denuncie</a></li>
        <li><a href="../denuncias/minhas_denuncias.php">Minhas denúncias</a></li>
        <li><a href="./ongs.html">ONG's</a></li>
      </ul>
    </div>

  </div>

  <hr class="footer-divider">

  <div class="footer-bottom">
    © 2025 TecFauna. Projeto educacional de conscientização ambiental.
  </div>
</footer>

</body>
</html>
