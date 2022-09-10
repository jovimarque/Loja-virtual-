
<?php
session_start();
require_once("../class/Conn.class.php");

?>

<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/create.css">
</head>
<body>
	<section class="login">
		<div class="login_box">
			<div class="left">
				<div class="top_link"><a href="#"><img src="https://drive.google.com/u/0/uc?id=16U__U5dJdaTfNGobB_OpwAJ73vM50rPV&export=download" alt=""></a></div>
				<div class="contact">
        <form method="POST">
						<h3>Login</h3>
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="pass" placeholder="Senha">
						<input type="submit" name=" entrar" value="entrar">

              <?php


                 try{
                            if(isset($_POST['entrar'])){
                              //pega os dados do usuário no banco de dados
                                $email = $_POST['email'];
                                $pass = $_POST['pass'];
                                $verificar = $_SESSION['logado'];
                                $sql = $conn->prepare("SELECT * FROM users WHERE email = :email AND  pass = :pass");
                                $sql->bindValue(":email",$email);
                                $sql->bindValue(":pass",$pass);
                                $sql->execute();
                                $stmt = $sql->fetch();
                                //verifica se os campos estão vazios 
                              
                                    if($_POST['email'] == NULL && $_POST['pass'] == NULL){
                                      echo ' <br> Por favor, informe login e senhna';
                                      exit();
                                    }
                                   
                                    
                                    
                               //verifica se os dados de login e senha estão corretos
                                  if($stmt['email'] == $_POST['email'] && $stmt['pass'] == $_POST['pass'] ){
                                    echo 'Sucesso';
                                    $verificado = true;
                                    header("Location: ../panel/areaCliente.php");
                                  }else{
                                    echo ' <br> Login ou senha inválidos';
                                  } 
                                
                                   //váriaveis de sessão
                                    if($verificar){
                                      $_SESSION['logado'] = 'SIM';
                                      $_SESSION['usuario'] = $stmt['email'];
                                      $_SESSION['acesso'] = $stmt['nivel'];
                                      



                                    }else{
                                      $_SESSION['logado'] = 'NÃO';
                                      header("Location: login.php");
                                    }
                                
                             }
                          }catch(Exception $e){
                             echo"Erro |".$e->getMessage()." contate o desenvolvedor";
                          }
                      ?>


              

					</form>
				</div>
			</div>
			<div class="right">
				<div class="right-text">
					<h2>777 Store</h2>
					<h5>A melhor loja de produtos digitais.</h5>
				</div>
			</div>
		</div>
	</section>
</body>
</html>