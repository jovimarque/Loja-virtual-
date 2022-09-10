<?php


require_once("../class/Conn.class.php");
require_once("../pages/verificador.php");
	$sql = $conn->prepare("SELECT * FROM users");
	$sql->execute();
	$row = $sql->fetch();
	echo $row['id'];

if(isset($_POST['idseller']) && isset($_POST['name']) && isset($_POST['value'])) {




  $idsaller = $_POST['idseller'];
  $name = $_POST['name'];
  $value = $_POST['value'];
  $query = $conn->prepare("INSERT INTO `products` (idseller, name, value) VALUES (:idseller, :name, :value)");
  $query->bindValue(':idseller', $idsaller);
  $query->bindValue(':name', $name);
  $query->bindValue(':value', $value);
  $execute = $query->execute();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/panelSeller.css">
</head>
<body>


<div class="aaaaaa">
<div class="header">

  <a href="#default" class="logo">777Store</a>


  <div class="header-right">
    <a class="active" href="#home">Inicio</a>
    <a href="#contact">Adicionar produtos</a>
    <a href="#contact">Produtos</a>
    <a href="#contact">Historico de vendas</a>
    <a href="#about">Sair</a>
  </div>
  </div>
</div>

<!-- Menu historico de compras

    <div class="menu-itens-client">
    <div class="menu-client">
    <div class="header-right">

    <a class="active" href="#home">Historico de compras</a>

    </div>
    </div>
    </div>

-->

    <div class="bem-vindo">
        <h1>Seja bem vindo ao painel do vendedor <span style="color: #8000FF;"><?php echo $_SESSION['usuario'];?></span></h1>
    </div>

    <div class="historico-compras">
        <div class="historico-compras-textos">
            <h1>Adicione produtos</h1>
            <p>Lorem ipsum dolor sit amet. Sed dolor deserunt ut nihil voluptatibus non molestias minimas</p>
        </div>

        <div class="historico-compras-card">
        <div class="container">

        <form action="panelSeller.php" method="POST">

        <div class="right">

        <input type="hidden" name="idseller" value="<?php echo $row['id']; ?>">
        <input type="text" name="name" placeholder="Nome">
        <input type="text" name="value" placeholder="Valor">
        <input type="text" name="img" placeholder="Imagem">
        <input type="submit" placeholder="Adicionar">
        </div>

        </form>
  
    </div>
        </div>
    </div>
    
    
</body>
</html>