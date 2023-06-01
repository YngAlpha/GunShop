<?php
		session_start();
	
		require('../data/dati_connessione_db.php');
		if(!isset($_SESSION['username'])){
			header('location: ../index.php');
		}
		if( $_SESSION["tipologia"]!="compratori"){
			header('location: logout.php');
		}
		
		$username = $_SESSION["username"];
	$strabilita = "Modifica";
	$strblocca = "Invia";

	$conn = new mysqli($db_servername,$db_username,$db_password,$db_name);
	$modifica = false;
    $val_pulsante = $strabilita;
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pulsante_modifica"])) {
		if($_POST["pulsante_modifica"] == $strabilita){
			$modifica = true;
			$val_pulsante = $strblocca;
		} else {
			$modifica = false;
			$val_pulsante = $strabilita;
		}

		if ($modifica == false){
			$sql = "UPDATE compratori
					SET password = '".$_POST["password"]."', 
						nome = '".$_POST["nome"]."', 
						cognome = '".$_POST["cognome"]."', 
						email = '".$_POST["email"]."'
					WHERE username = '".$username."'";
			if($conn->query($sql) === true) {
				//echo "Record updated successfully";
			} else {
				echo "Error updating record: " . $conn->error;
			}
		}
		}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dati Compratore</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
	<link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php require("nav_Compratore.php"); ?>
	<div class="contenuto">
		<h1 class="pagtitle">
			Questi sono i tuoi dati
		</h1>
		<?php
			$sql = "SELECT username, password, nome, cognome, email
				FROM compratori 
				WHERE username='".$username."'";
			$ris = $conn->query($sql) or die("<p>Query fallita!</p>");
			$row = $ris->fetch_assoc();
		?>
		<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="formDati">
			<table>
				<tr>
					<td style="text-align: left;">Username:</td> 
					<td style="text-align: right;"><input class="input" type="text" name="username" value="<?php echo $row["username"]; ?>" disabled="disabled"></td>
				</tr>
				<tr>
					<td style="text-align: left;">Password:</td> 
					<td style="text-align: right;"><input class="input" type="text" name="password" value="<?php echo $row["password"]; ?>" <?php if(!$modifica) echo "disabled='disabled'"?>></td>
				</tr>
				<tr>
					<td style="text-align: left;">Nome:</td> 
					<td style="text-align: right;"><input class="input" type="text" name="nome" value="<?php echo $row["nome"]; ?>" <?php if(!$modifica) echo "disabled='disabled'"?>></td>
				</tr>
				<tr>
					<td style="text-align: left;">Cognome:</td> 
					<td style="text-align: right;"><input type="text" class="input" name="cognome" value="<?php echo $row["cognome"]; ?>" <?php if(!$modifica) echo "disabled='disabled'"?>></td>
				</tr>
				<tr>
					<td style="text-align: left;">email:</td> 
					<td style="text-align: right;"><input type="text" class="input" name="email" value="<?php echo $row["email"]; ?>" <?php if(!$modifica) echo "disabled='disabled'"?>></td>
				</tr>
			</table>
			<p>
				<input type="submit" name="pulsante_modifica" value="<?php echo $val_pulsante; ?>" class="blottone">
			</p>
		</form>	
	</div>	
	<?php 
		include('footer.php');
	?>
</body>
</html>