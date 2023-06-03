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
        <main class="main2">
            <div class="reg_home">
                <h1 style="text-align: center; margin: 20px;">Inserisci i tuoi dati da Compratore. Username e password sono obbligatori per la registrazione. Tutti i dati tranne l'userneme saranno modificabili successivamente</h1>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                    <table>
                        <tr>
                            <td class="dato">
                                Username:
                            </td>
                            <td class="dato">
                                <input type="text" name="username" class="input" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="dato">
                                Password:
                            </td>
                            <td class="dato">
                                <input type="password" name="password" class="input" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="dato">Conferma psw:</td>
                            <td class="dato"><input type="password" name="conferma" class="input" required></td>
                        </tr>
                        <tr>
                            <td class="dato">Nome:</td>
                            <td class="dato"><input type="text" name="nome" class="input"></td>
                        </tr>
                        <tr>
                            <td class="dato">Cognome:</td>
                            <td class="dato"><input type="text" name="cognome" class="input"></td>
                        </tr>
                        <tr>
                            <td class="dato">Email:</td>
                            <td class="dato"><input type="text" name="email" class="input"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><p style="text-align: center;"><input type="submit" value="Registrati" class="blottone"></p></td>
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
    </main>
    <?php 
        error_reporting(E_ALL ^ E_WARNING);
		include('footer.php');
	?>
    </body>
</html>