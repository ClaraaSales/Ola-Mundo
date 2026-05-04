<?php
include "../conexao.php";

$email=$_POST['email'];
$senhadigitada=$_POST['senha'];

if (($email=="") || ($senhadigitada=="")){
    echo "<script>alert('A campos vazios, Preencha-os');history.go(-1);</script>";
}else{
    try{
        $usuario = $conn->prepare('SELECT * FROM usuarios WHERE email=:email');
        $usuario->execute(array(
            ':email' => $email
        ));
        
        if ($usuario->rowCount()==1){
            foreach($usuario as $conns){
                if(password_verify($senhadigitada,$conns["senha"])){
                    session_start();
                    $_SESSION['id_usuario']=$conns['id_usuario'];
                    $_SESSION['nome']=$conns['nome'];
                    $_SESSION['email']=$conns['email'];
                    $_SESSION['tipo'] = $conns['tipo'] ?? 'usuario'; ///

                    if($_SESSION['tipo'] === 'admin'){ ///
                    header ('Location: ../adm/aprovar.php');
                    exit;
                    }
                    else{
                        header ('Location: ../denuncias/minhas_denuncias.php');
                        exit;
                    } ///
                    echo"<script>alert('Login Efetuado com sucesso');history.go(-1);</script>";
                }else{
                    echo"<script>alert('A senha digitada esta incorreta, por favor verifique mais uma vez');history.go(-1);</script>";
                }
            }
        }else{
            echo "<script>alert('Você não esta cadastrado, por favor cadastre-se');history.go(-1);</script>";
        }
    }catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    } 
}
?>
