<?php
	session_start();
	//echo session_id();
    
	require("./data/dati_connessione_db.php");
	if (isset($_POST["username"])) {$username = $_POST["username"];} else {$username = "";}
	if (isset($_POST["password"])) {$password = $_POST["password"];} else {$password = "";}
	if (isset($_POST["tipologia"])) {$tipologia = $_POST["tipologia"];} else {$tipologia = "";}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>GunShop</title>
</head>
<body>
    <header class="barraSu">
        <div><img src="" alt=""></div>
        <h1 class="titolo">GunShop</h1>
        <div></div>
    </header>
    <main>
        <div class="login_home">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <h2>
                    Per accedere alle vendite esegui il login
                </h2>
                <table>
                    <tr>
                        <td class="dato">
                            Username:
                        </td>
                        <td class="dato">
                            <input type="text" name="username" class="input" placeholder="Inserisci lo username" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="dato">
                            Password:
                        </td>
                        <td class="dato">
                            <input type="password" name="password" class="input" placeholder="Inserisci la password" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="tipologia">
                            <input type="radio" name="tipologia" value="compratori" checked>Compratore 
                            <input type="radio" name="tipologia" value="venditori">Venditore 
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><p style="text-align: center;"><input type="submit" value="Accedi" class="blottone"></p></td>
                    </tr>
                </table>
                <?php
			if (isset($_POST["username"]) and isset($_POST["password"]) and isset($_POST["tipologia"])) {
				$conn = new mysqli($db_servername,$db_username,$db_password,$db_name);
				if($conn->connect_error){
					die("<h3 class='warning'>Connessione al server non riuscita: ".$conn->connect_error."</h3>");
				}

				$myquery = "SELECT username, password 
							FROM $tipologia 
							WHERE username='$username'
								AND password='$password'";

				$ris = $conn->query($myquery) or die("<h3 class='warning'>Query fallita! ".$conn->error."</h3>");

				if($ris->num_rows == 0){
					echo "<h3 class='warning'>Utente non trovato o password errata</h3>";
					$conn->close();
				} 
				else {
					//echo "<p>Utente trovato</p>";

					$_SESSION["username"] = $username;
					$_SESSION["tipologia"] = $tipologia;
											
					$conn->close();
					header("location: ./pagine/home.php");
			}
			}

		?>
            </form>
            <h2>
                Se non hai ancora effettuato l'accesso, <div class="reg">registrati</div>
            </h2>
            <div class="regTypeClosed">
                <a href="./pagine/regCompratore.php" class="regLinks">Registrati come compratore</a>
                <a href="./pagine/regVenditore.php" class="regLinks">Registrati come venditore</a>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $(".reg").click(function(e){
                    $(".regTypeClosed").toggleClass('regTypeOpen')
                    e.preventDefault();
                })
            });
        </script>
    </main>
    
</body>
</html>