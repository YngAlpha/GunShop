<?php
	session_start();
    require('../data/dati_connessione_db.php');
    $username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="../style.css">
    <title>Venditore</title>
</head>
<body>
    <?php require("nav_Venditore.php"); ?>
    <div class="contenuto">
            <?php
                $conn = new mysqli($db_servername,$db_username,$db_password,$db_name);
                if($conn->connect_error){
                    die("<p>Connessione al server non riuscita: ".$conn->connect_error."</p>");
                }

                $sql = "SELECT username, nomeNeg
                        FROM venditori 
                        WHERE username='$username'";
                $ris = $conn->query($sql) or die("<p>Query fallita!</p>");
                foreach($ris as $riga){
                    $nomeNeg = $riga["nomeNeg"];
                    echo "<h1 class='pagtitle'>$nomeNeg</h1>";
                }
            ?>
        <div class="elencoArmi">
			<h1 style="text-align: center; margin: 30px;">Armi in vendita</h1>
			<?php
				$query = "SELECT armi.nomeArma, armi.tipo, pezzi
                        FROM venditori JOIN vendi ON venditori.username = vendi.username 
                            JOIN armi ON armi.nomeArma = vendi.nomeArma
                        WHERE venditori.username='$username'";
				$ris = $conn->query($query) or die("<p>Query fallita!</p>");
				if ($ris->num_rows == 0) {
					echo "<h2>Nessuna arma acquistata</h2>";
				} else {
                    echo "<ul class='gunlist'>";
                    foreach($ris as $riga){
                        $arma = $riga['nomeArma'];
                        $tipo = $riga['tipo'];
                        $pezzi =  $riga['pezzi'];
                        echo
                            "<li>
                                $arma, $tipo <br>
                                pezzi in magazzino: $pezzi pz
                            </li>";
                    }	
                    echo "</ul>";
                }
			?>
		</div>
    </div>
    <?php 
		include('footer.php')
	?>
</body>
</html>
<?php
	$conn->close();
?>