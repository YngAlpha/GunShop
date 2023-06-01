<?php 
    require("../data/dati_connessione_db.php");
    if(isset($_POST["nome"])) $nome = $_POST["nome"];  else $nome = "";
    if(isset($_POST["cognome"])) $cognome = $_POST["cognome"];  else $cognome = "";
    if(isset($_POST["username"])) $username = $_POST["username"];  else $username = "";
    if(isset($_POST["password"])) $password = $_POST["password"];  else $password = "";
    if(isset($_POST["email"])) $email = $_POST["email"];  else $email = "";
    if(isset($_POST["conferma"])) $conferma = $_POST["conferma"];  else $conferma = "";
    $tipologia = "compratori";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="../style.css">
    <title>RegCompratore</title>
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
        <h1 style="text-align: center; margin: 20px;">Inserisci i tuoi dati da Compratore. Username e password sono obbligatori per la registrazione. Tutti i dati tranne l'userneme saranno modificabili successivamente</h1>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="regForm"> 
                <table>
                    <tr>
                        <td style="text-align: left;">Username:</td>
                        <td style="text-align: right;"><input class="input" type="text" name="username" <?php echo "value = '$username'" ?> required></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">Password:</td>
                        <td style="text-align: right;"><input class="input" type="password" name="password" <?php echo "value = '$password'" ?> required></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">Conferma psw:</td>
                        <td style="text-align: right;"><input class="input" type="password" name="conferma" <?php echo "value = '$conferma'" ?> required></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">Nome:</td>
                        <td style="text-align: right;"><input class="input" type="text" name="nome" <?php echo "value = '$nome'" ?> placeholder="Il tuo nome"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">Cognome:</td>
                        <td style="text-align: right;"><input class="input" type="text" class="input_dati_personali" name="cognome" <?php echo "value = '$cognome'" ?>></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">email:</td>
                        <td style="text-align: right;"><input class="input" type="text" class="input_dati_personali" name="email" <?php echo "value = '$email'" ?>></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>
                                <input type="submit" value="Invia" class="blottone">
                            </p>
                        </td>
                    </tr>
                </table>
            <h3 class="regAvvenuta">
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
						    FROM compratori 
						    WHERE username='$username'";

                    $ris = $conn->query($myquery) or die("<p>Query fallita!</p>");
                    if ($ris->num_rows > 0) {
                        echo "Questo username è già stato usato";
                    } else {

                        $myquery = "INSERT INTO $tipologia (username, password, nome, cognome, email)
                                    VALUES ('$username', '$password', '$nome', '$cognome','$email')";


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
        </h3>
        </form>
    </div>
    <?php 
        error_reporting(E_ALL ^ E_WARNING);
		include('footer.php');
	?>
    </body>
</html>