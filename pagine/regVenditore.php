<?php 
    require("../data/dati_connessione_db.php");
    if(isset($_POST["nomeNeg"])) $nomeNeg = $_POST["nomeNeg"];  else $nomeNeg = "";
    if(isset($_POST["indirizzo"])) $indirizzo = $_POST["indirizzo"];  else $indirizzo = "";
    if(isset($_POST["username"])) $username = $_POST["username"];  else $username = "";
    if(isset($_POST["password"])) $password = $_POST["password"];  else $password = "";
    if(isset($_POST["conferma"])) $conferma = $_POST["conferma"];  else $conferma = "";
    $tipologia = "venditori";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="../style.css">
    <title>RegVenditore</title>
</head>
    <body>
        <div class="navReg">
            <h1 class="regTitolo">Registrazione</h1>
            <ul>
                <li><a href="../index.php" class="goLogin">Login</a></li>
            </ul>
            </div>
        </div>
        <div class="regContenuto">
        <h1 style="text-align: center; margin: 20px;">Inserisci i tuoi dati da Venditore. Username e password sono obbligatori per la registrazione. Tutti i dati tranne l'userneme saranno modificabili successivamente</h1>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="regForm"> 
                <table>
                    <tr>
                        <td  style="text-align: left;">Username:</td>
                        <td  style="text-align: right;"><input class="input" type="text" name="username" <?php echo "value = '$username'" ?> required></td>
                    </tr>
                    <tr>
                        <td  style="text-align: left;">Password:</td>
                        <td  style="text-align: right;"><input class="input" type="password" name="password" <?php echo "value = '$password'" ?> required></td>
                    </tr>
                    <tr>
                        <td  style="text-align: left;">Conferma psw:</td>
                        <td  style="text-align: right;"><input class="input" type="password" name="conferma" <?php echo "value = '$conferma'" ?> required></td>
                    </tr>
                    <tr>
                        <td  style="text-align: left;">Nome Negozio:</td>
                        <td  style="text-align: right;"><input class="input" type="text" name="nomeNeg" <?php echo "value = '$nomeNeg'" ?> placeholder="Il nome del tuo negozio"></td>
                    </tr>
                    <tr>
                        <td  style="text-align: left;">Indirizzo:</td>
                        <td  style="text-align: right;"><input type="text" class="input" name="indirizzo" <?php echo "value = '$indirizzo'" ?>></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>
                                <input type="submit" value="Invia" class="blottone">
                            </p>
                        </td>
                    </tr>
                </table>
                <p class="regAvvenuta">
            <?php
            if(isset($_POST["username"]) and isset($_POST["password"])) {
                if ($_POST["username"] == "" or $_POST["password"] == "") {
                    echo "username e password non possono essere vuoti!";
                } elseif ($_POST["password"] != $_POST["conferma"]){
                    echo "Le password inserite non corrispondono";
                } else {
                    $conn = new mysqli($db_servername,$db_username,$db_password,$db_name);
                    if($conn->connect_error){
                        die("<p>Connessione al server non riuscita: ".$conn->connect_error."</p>");
                    }

                    $myquery = "SELECT username 
						    FROM venditori 
						    WHERE username='$username'";
                    //echo $myquery;

                    $ris = $conn->query($myquery) or die("<p>Query fallita!</p>");
                    if ($ris->num_rows > 0) {
                        echo "Questo username è già stato usato";
                    } else {

                        $myquery = "INSERT INTO $tipologia (username, password, nomeNeg, indirizzo)
                                    VALUES ('$username', '$password', '$nomeNeg','$indirizzo')";

                        /*
                        // Versione con l'uso dell'hash
                        $password_hash = password_hash($password, PASSWORD_DEFAULT);

                        $myquery = "INSERT INTO utenti (username, password, nome, cognome, email, telefono, comune, indirizzo)
                                    VALUES ('$username', '$password_hash', '$nome', '$cognome','$email','$telefono','$comune','$indirizzo')";
                        */

                        if ($conn->query($myquery) === true) {
                            session_start();
                            $_SESSION["username"]=$username;
                            $_SESSION["tipologia"]=$tipologia;
                            
						    $conn->close();

                            echo "Registrazione effettuata con successo!<br>sarai ridirezionato alla home tra 5 secondi.";
                            header('Refresh: 5; URL=home.php');

                        } else {
                            echo "Non è stato possibile effettuare la registrazione per il seguente motivo: " . $conn->error;
                        }
                    }
                }
            }
            ?>
        </p>
            </form>
           
    </div>
    <?php 
        error_reporting(E_ALL ^ E_WARNING); // metodo globale ^ significa tranne e funziona da qui in poi
		include('footer.php');
		// @include('footerrr.php');  // con @ evito la generazione di warnings o errors da parte della funzione
	?>
    </body>
</html>