<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Denúncias</title>
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
       <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Cherry+Cream+Soda&family=Luckiest+Guy&family=Titan+One&display=swap" rel="stylesheet">
  <link href="ameaças.css" rel="stylesheet">
      <link href="denuncia.css" rel="stylesheet">
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

    <script>
        function mostrarOpcoes() {
            const tipo = document.getElementById('tipo_denuncia').value;
            document.getElementById('fisico').style.display = tipo === 'fisica' ? 'block' : 'none';
            document.getElementById('online').style.display = tipo === 'online' ? 'block' : 'none';
        }

        function identificarUsuario() {
            const tipo = document.getElementById('anonimo').value;
            document.getElementById('identificar').style.display = tipo === 'identificar' ? 'block' : 'none';
        }
    </script>

    <h1 class="titulo">Formulário de denúncias</h1> 
    <p class="text">Preencha o formulário abaixo com o máximo de detalhes possível.<br>
        Todas as informações são confidenciais.
    </p> <br>
    
    <form action="denuncia.php" id="formDenuncia" method="post" enctype="multipart/form-data">
        <script src="verificaCPF.js"></script>

        <label for="anonimo">Deseja fazer uma denúncia anônima?</label>
        <select id="anonimo" name="anonimo" onchange="identificarUsuario()"><br>
        <option value="">Selecionar</option>
        <option value="identificar">identificar</option>
        <option value="anonimo">anonimo</option>
        </select>

        <div id="identificar">
        <h1 class="identificacao">Identificação</h1> <br>
       
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome"> <br><br>

        <label for="cpf">CPF</label>
        <input type="text" id="cpf" name="cpf" placeholder="Ex: 000.000.000-00"> 
        <script>
            document.getElementById('formDenuncia').addEventListener('submit', function(e) {
            const cpfInput = document.getElementById('cpf').value;
            const verifica = new VerificaCPF(cpfInput);

            if (!verifica.init()) {
                e.preventDefault();
                alert("CPF inválido!");
             }
        });
        </script>

        <br><br>

        <label for="email">E-mail</label>
        <input type="email" id="email" name="email"> <br><br>

        <label for="telefone">Telefone</label>
        <input type="number" id="telefone" name="telefone" placeholder="Ex: (00) 00000-0000"> <br><br>
        </div>
        <hr><br>
        
        <label for="tipo">Tipo de crime</label>
        <input type="text" id="tipo" name="tipo" placeholder="Ex: Tráfico, maus tratos, etc"> <br><br>

       <label for="descricao">Descrição detalhada</label>
        <textarea id="descricao" name="descricao" placeholder="Descreva o que você presenciou ou teve conhecimento. Inclua detalhes como: o que aconteceu, quando, quem estava envolvido, quantos animais, etc."></textarea>
        <br>


        <hr><br>

        <label for="tipo_denuncia">Tipo de denúncia:</label>
        <select id="tipo_denuncia" name="tipo_denuncia" onchange="mostrarOpcoes()"><br>
         <p>Selecione a forma como o crime ocorreu</p>
        <option value="">Selecionar</option>
        <option value="fisica">Física</option>
        <option value="online">Online</option>
        </select>

    <br><br>

    <div id="fisico" style="display:none;">
        <h1>Localidade</h1>
        <p>*Preencha os dados que souber, quanto mais informações, mas ajudará as autoridades a encontrar o crime.</p>
        <label for="bairro">Bairro</label>
        <input type="text" id="bairro" name="bairro" placeholder="Ex: Centro, Jardim América, etc"> <br><br>

        <label for="rua">Rua</label>
        <input type="text" id="rua" name="rua" placeholder="Ex: Av. Paulista, Rua das Flores, etc"> <br><br>

        <label for="numero">Número</label>
        <input type="number" id="numero" name="numero" placeholder="Ex: 100, 2500, etc"> <br><br>
    </div>

    <div id="online" style="display:none;">
        <h1>Crime Online</h1> <br>
        <p>*Preencha os campos abaixo caso crime foi cometido em plataformas digitais (redes sociais, sites, apps) </p> <br>
        <p>*Exemplos para crimes online: <br>
        • "Instagram @usuario123 - vendedor em São Paulo/SP" <br>
        • "Grupo WhatsApp 'Nome do Grupo' - admin (11) 98765-4321" <br>
        • "OLX - anúncio em Campinas/SP"  <br>
        • "Facebook Marketplace - vendedor em BH/MG"</p> <br>
        <label>Plataforma:</label>
        <input type="text" name="plataforma" placeholder="Ex: Instagram @usuario123"><br><br>
    </div> 

  <div class="linha-local">
  <div class="campo">
    <label for="estado">Estado</label>
    <select id="estado" name="estado" required>
      <option value="">Selecione o estado</option>
      <option value="AC">AC</option>
      <option value="AL">AL</option>
      <option value="AP">AP</option>
      <option value="AM">AM</option>
      <option value="BA">BA</option>
      <option value="CE">CE</option>
      <option value="DF">DF</option>
      <option value="ES">ES</option>
      <option value="GO">GO</option>
      <option value="MA">MA</option>
      <option value="MT">MT</option>
      <option value="MS">MS</option>
      <option value="MG">MG</option>
      <option value="PA">PA</option>
      <option value="PB">PB</option>
      <option value="PR">PR</option>
      <option value="PE">PE</option>
      <option value="PI">PI</option>
      <option value="RJ">RJ</option>
      <option value="RN">RN</option>
      <option value="RS">RS</option>
      <option value="RO">RO</option>
      <option value="RR">RR</option>
      <option value="SC">SC</option>
      <option value="SP">SP</option>
      <option value="SE">SE</option>
      <option value="TO">TO</option>
    </select>
  </div>

  <div class="campo">
    <label for="cidade">Cidade</label>
    <input type="text" id="cidade" name="cidade" placeholder="Ex: São Paulo">
  </div>
</div>



        <hr><br>

        <label for="data_ocorrencia">Data da ocorrência</label>
        <input type="date" id="data_ocorrencia" name="data_ocorrencia"> <br><br>
        
        <label for="autoridade">Autoridade responsável</label> <br>
            <p>*Se não souber qual autoridade escolher, consulte <a href="../paginas/guia.html"> nosso guia.</a></p> <br>
        <?php
            include "../conexao.php";

            try{
                $aut = $conn->prepare('SELECT * FROM autoridades');
                $aut->execute(array(
                ));
                
                if ($aut->rowCount()>=1){
                    echo "<select name='autoridade'>";
                    foreach ($aut as $linha){
                        echo "<option value='".$linha['id_autoridade']."'>".$linha['nome_autoridade']."</option>";


                    }
                    echo "</select>";
                }else{
                    echo "<script>alert('autoridades não cadastradas');history.go(-1);</script>";
                }
            }catch(PDOException $e) {
                echo 'ERROR: ' . $e->getMessage();
            } 

        ?>

        <br>


        <label class="img" for="evidencia">Evidências (Fotos/Vídeos) </label> <br>
        <p>*Adicione fotos ou vídeos que comprovem a denúncia. Quanto mais evidências, melhor.</p> <br>
        <input type="file" name='evidencias[]' multiple id="imagens">  
        <div id="lista"></div>

        <script>

           document.getElementById('imagens').addEventListener('change', function() {
            const arquivos = this.files;
            const lista = document.getElementById('lista');

            if (arquivos.length > 0) {
               lista.innerHTML  += '</ul>';
                for (let i = 0; i < arquivos.length; i++) {
               lista.innerHTML += '<li>' + arquivos[i].name + '</li>';
                }
            lista.innerHTML  += '</ul>';
            } 
            else {
                lista.innerHTML = '<p>Nenhum arquivo enviado</p>';
            }
        });

        </script>

        <br>
   
        <div class="mensagem">
        <p class="caixa">*Suas informações estão protegidas<br>
        Todas as denúncias são tratadas com confidencialidade. Seus dados serão compartilhados apenas com as autoridades responsáveis.</p> <br>
      </div>

        <hr>

        <div class="mensagem">
        <p class="caixa">Importante Saber: <br>
        • Denúncias falsas constituem crime e podem resultar em processo judicial <br>
        • Quanto mais detalhes e provas você fornecer, mais rápida será a ação das autoridades <br>
        • Sua identidade será protegida durante todo o processo <br>
        • Você pode acompanhar o andamento através do número de protocolo <br>
        • Em casos de emergência ou flagrante, ligue imediatamente para 190</p> <br>
        </div>

        <input type="submit" value="Enviar Denúncia">

    </form>

    
    <footer class="custom-footer">
  <div class="footer-content">

    <div class="footer-box footer-col1">
      <div class="footer-logo-title">
        <img src="../paginas/imgs/logo_pagina.png" alt="Logo" class="footer-logo">
        <h2 style="margin-left: -20px;">TecFauna</h2>
      </div>
      <p class="footer_p">Unindo pessoas e tecnologia para proteger
      quem não pode pedir ajuda.</p>
    </div>

    <div class="footer-box">
      <h3>Contate-nos</h3>
      <p class="footer_p">(+55) 119999999</p>
      <p class="footer_p">E-mail: <a href="tecfauna@gmail.com">tecfauna@gmail.com</a></p>
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
        <li><a href="../../guia.html">Como denunciar</a></li>
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




  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
