<?php

require_once("../class/Conn.class.php");


$stmt = $conn->prepare("SELECT * FROM products");

if(!$stmt->execute()){
    echo '<pre>';
    print_r($stmt->errorInfo());
}

$resultado = $stmt->fetch(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>

    <!-- --------- Products --------- -->

    <div class="prod">

        <h1>Olhe os produtos que estao em <span> destaque. </span> </h1>
        <p>Se interessou por algum produto, voce pode comprar direto pelo Discord.</p>



        <div class="container-products">

        <?php 

                
        while ($product = $stmt->fetch(PDO::FETCH_ASSOC)) {
            
        ?>

            <div class="product-card">

                <!--   <div class="badge">Destaque</div> -->

            

                <div class="product-details">
                    <div class="product-tumb">
                        <img src="https://i.imgur.com/xdbHo4E.png" alt="">
                    </div>
                    <span class="product-catagory">Elojob</span>
                    <h4> <?php echo $product['name']; ?> </h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, possimus nostrum!</p>
                    <div class="product-bottom-details">
                        <div class="product-price"><small>R$200</small><?php echo $product['value']; ?>
                    <a href="products.php?id=<?php echo $product['id']; ?>">Comprar</a>
                    </div>
                        <div class="product-links">
                            <a href=""><i class="fa fa-heart"></i></a>
                            <a href=""><i class="fa fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <?php }   ?>
               

        </div>
    </div>
    
</body>
</html>