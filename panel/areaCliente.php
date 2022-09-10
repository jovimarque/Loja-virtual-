<?php

require_once("../class/Conn.class.php");
require_once("../pages/verificador.php");
require_once("../pages/testeComprar.php");




//if(isset($_SESSION['logado']) == 'SIM'){

    //echo '<h1 style="color:white;">Seja bem vindo usuario: '.$_SESSION['usuario'].' </h1><br>';
//}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/areaCliente.css">
</head>
<body>

<div class="aaaaaa">
<div class="header">

  <a href="#default" class="logo">777Store</a>


  <div class="header-right">
    <a class="active" href="#home">Inicio</a>
    <a href="#contact">Historico</a>
    <a href="#about">Sair</a>
  </div>
  </div>
</div>


<?php

$sql = $conn->prepare("SELECT * FROM users WHERE  nivel = :NIVEL");
    $sql->bindValue(":NIVEL", $_SESSION['acesso']);
    $sql->execute();
    $stmt = $sql->fetchAll();

foreach ($stmt as $usuario) {
    
    if ($usuario['nivel'] == 2){
       
    
 echo "<h1>Como deseja pagar?</h1><p>Escolha sua forma de pagamento abaixo.</p> <div class='me-container'><div class='me'><div class='pagamento'><h1>Como deseja pagar?</h1><div class='meth-buy'><img src='https://img.icons8.com/ios-glyphs/30/000000/us-dollar-circled--v1.png'/><a href='#'></a></a></div></div></div></div>";

    }else{


          echo "<h1 style='color:white;'>Olá administrador ".$_SESSION['usuario'].'</h1>';
    }
}




?>

<!-- Menu historico de compras

    <div class="menu-itens-client">
    <div class="menu-client">
    <div class="header-right">

    <a class="active" href="#home">Historico de compras</a>

    </div>
    </div>
    </div>

-->








<?php

if(isset($_SESSION['logado']) == 'SIM'){ ?>

 ?> 

<div class="bem-vindo">
        <h1>Seja bem vindo a area de cliente <span style="color: #8000FF;"><?php echo $_SESSION['usuario']; ?>!</span></h1>
    </div>
<?php
}else{
  header("Location:../pages/login.php");
}
?>

    <div class="historico-compras">
        <div class="historico-compras-textos">
            <h1>Historico de compras</h1>
            <p>Lorem ipsum dolor sit amet. Sed dolor deserunt ut nihil voluptatibus non molestias minimas</p>
        </div>

        <div class="historico-compras-card">
        <div class="container">
  <ul class="responsive-table">
    <li class="table-header">
      <div class="col col-1">Produto</div>
      <div class="col col-2">Data</div>
      <div class="col col-3">Valor</div>
      <div class="col col-4">Status</div>
      <div class="col col-5">Prazo</div>
    </li>
    <li class="table-row">
      <div class="col col-1" data-label="Job Id">Nitro anual</div>
      <div class="col col-2" data-label="Customer Name">28/08</div>
      <div class="col col-3" data-label="Amount">R$50,00</div>
      <div class="col col-4" data-label="Payment Status">Pendente</div>
      <div class="col col-5" data-label="Payment Status">2 Dias</div>
    </li>
    <li class="table-row">
      <div class="col col-1" data-label="Job Id">Conta Steam</div>
      <div class="col col-2" data-label="Customer Name">08/09</div>
      <div class="col col-3" data-label="Amount">R$350,00</div>
      <div class="col col-4" data-label="Payment Status">Entregue</div>
      <div class="col col-5" data-label="Payment Status">2 Dias</div>
    </li>
    <li class="table-row">
      <div class="col col-1" data-label="Job Id">Conta Netflix</div>
      <div class="col col-2" data-label="Customer Name">11/08</div>
      <div class="col col-3" data-label="Amount">R$20,00</div>
      <div class="col col-4" data-label="Payment Status">Pendente</div>
      <div class="col col-5" data-label="Payment Status">2 Dias</div>
    </li>
  </ul>
</div>
        </div>
    </div>
    
</body>
</html>






















