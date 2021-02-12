<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>購入履歴画面</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>

	<?php require 'menu.php'; 

	if(!empty($_SESSION["customer"])){
		$pdo;
		require_once("db_connect.php");
		$sql = "SELECT purchase_id , name , price 
		FROM purchase AS P
		INNER JOIN purchase_datail AS D
		ON P.id = D.purchase_id
		AND customer_id = :customer_id
		JOIN product AS PR
		ON PR.id = D.product_id;
		";

		$stm = $pdo->prepare($sql);
		$stm->bindValue(":customer_id ", 
		$_SESSION["customer"]["id"] ,
		PDO::PARAM_INT);

		if($stm->execute()){
			echo "購入履歴がありません";
		}
	}

	?>
	
</body>

</html>