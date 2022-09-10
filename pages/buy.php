<?php

require_once('../class/Conn.class.php');
require_once('verificador.php');

// -------------- Product --------------

   
 	$id = $_GET['id'];
    echo $id;

    $query = $conn->prepare("SELECT * FROM `products` WHERE id= :id");
    $query->bindValue(":id", $id);
    $query->execute();

    $row = $query->fetchAll();

      foreach ($row as $product): 

    $nome = $product['name'];
    $valor = $product['value'];


    endforeach;
    
 // -------------- Buyer --------------
$data = array(
    'apiKey' =>'sua apiKey',
    'order_id' => rand(),
    'payer_cpf_cnpj'=>$_POST['payer_cpf_cnpj'],
    'payer_email' => $_POST['payer_email'],
    'payer_name' => $_POST['payer_name'], // nome completo ou razao social
    'payer_phone' => $_POST['payer_phone'], // fixou ou móvel
    'notification_url' => 'https://mysite.com/notification/paghiper/',
    
    'fixed_description' => true,
    'days_due_date' => '5', // dias para vencimento do Pix
    'items' => array(
        array ('description' => $nome,
        'quantity' => '1',
        'item_id' => $id,
        'price_cents' =>  $valor), // em centavos
  ),
  );
  $data_post = json_encode( $data );
  $url = "https://pix.paghiper.com/invoice/create/";
  $mediaType = "application/json"; // formato da requisição
  $charSet = "UTF-8";
  $headers = array();
  $headers[] = "Accept: ".$mediaType;
  $headers[] = "Accept-Charset: ".$charSet;
  $headers[] = "Accept-Encoding: ".$mediaType;
  $headers[] = "Content-Type: ".$mediaType.";charset=".$charSet;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data_post);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $result = curl_exec($ch);
  $json = json_decode($result, true);
  // captura o http code
  $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
 	echo '<pre>';	
	print_r($data);
	echo '</pre>';

	echo $data['items'][0]['description'].'<br>';
  if($httpCode == 201):
  // CÓDIGO 201 SIGNIFICA QUE O PIX FOI GERADO COM SUCESSO
  $result = json_decode($result);

 
     echo $data['items'][0]['description'];

 		 if(isset($_POST['enviar'])){

 		 $result = $result->pix_create_request->status;
 		 $products = $data['items'][0]['description'];
 		
      	$sql = $conn->prepare("INSERT INTO  orders (status, product) VALUES(:result,:product)");
      	$sql->bindValueI(":product", $products);
      	$sql->bindValue(":result", $result);
      	$sql->execute();
      	echo 'Sucesso';
  			}else{
  				echo 'Erro';
  		}
  else:
  echo $result;
  
  //pagina para comprar

endif;
?>
    	 
    








      	
      	
      	


 
  

  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php 

    $email = $_SESSION['usuario'];
 	$query = $conn->prepare("SELECT * FROM `users` WHERE email= :email");
    $query->bindValue(":email", $email);
    $query->execute();



foreach ($query as $user): 
?> 

    <div class="container">
     <form  method="post">
     
     <br>   	
    <input type="text" name=" payer_name" value="<?php echo $user['name']; ?>">   		
    <br>
    <input type="text" name="payer_phone" value="432423342">
    <br>
    <input type="text" name="payer_cpf_cnpj" value="698.001.300-98">
    <br>
    <input type="text" name="payer_email" value="<?php echo $user['email']; ?>">
    <input type="submit" name="enviar">
    </form>
    


<?php endforeach; ?>

<img src="<?php echo $qrcode ?>" alt="">

    </div>
</body>
</html>

