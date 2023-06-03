<?php
	session_start();
    require('../data/dati_connessione_db.php');
    $username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en" style="height: fit-content;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <title>Compratore</title>
</head>
<body style="height: fit-content;">
    <?php require("nav_Compratore.php"); ?>
    <main class="mainHome">
        <div>
                <?php
                    $conn = new mysqli($db_servername,$db_username,$db_password,$db_name);
                    if($conn->connect_error){
                        die("<p>Connessione al server non riuscita: ".$conn->connect_error."</p>");
                    }

                    $sql = "SELECT username, nome, cognome 
                            FROM compratori 
                            WHERE username='$username'";
                    $ris = $conn->query($sql) or die("<p>Query fallita!</p>");
                    foreach($ris as $riga){
                        $nome = $riga["nome"];
                        $cognome = $riga["cognome"];
                        echo "<h1 class='pagtitle'>Benvenuto/a $nome $cognome</h1>";
                    }
                ?>
                <h1 style="text-align: center; margin: 30px;">Acquista armi</h1>
            <div class="home__section">
                <div class="home__col">
                    <h2 class="home__title"><span>Colt M4</span></a></h2>
                    <div>
                        <img class="home__img" src="../immagini/M4A1_ACOG.png">
                    </div>
                    <p>
                    L'M4 (conosciuto anche come Colt M4 dall'azienda statunitense che lo produce, la Colt's Manufacturing Company) è un fucile d'assalto prodotto negli USA a partire dal 1994.</p>
                        <p class="par_bold">Scopri di più su <a href="https://it.wikipedia.org/wiki/M4_(fucile_d%27assalto)">wikipedia</a></p>
                    <p class="par_bold">Prezzo: 1000$</p>
                </div class="home__col">
                <div class="home__col">
                    <h2 class="home__title"><span>AK 47</span></h2>
                    <div>
                        <img class="home__img" src="../immagini/ak47.png">
                    </div>
                    <p>
                    L'AK-47 è un fucile d'assalto ideato e progettato in Unione Sovietica, dotato di selettore di fuoco ed operato a gas, camerato originariamente per il proiettile 7,62 × 39 mm</p>  
                    <p class="par_bold">Scopri di più su <a href="https://it.wikipedia.org/wiki/AK-47">wikipedia</a></p>
                    <p class="par_bold">Prezzo: 600$</p>  
                </div>
                <div class="home__col">
                    <h2 class="home__title"><span>FN Scar H</span></h2>
                    <div>
                        <img class="home__img" src="../immagini/Scar H.png" style="margin-bottom: 15px;">
                    </div>
                    <p>
                    L'FN SCAR (acronimo per Special Operations Forces Combat Assault Rifle) è un fucile d'ordinanza modulare a fuoco selettivo sviluppato dalla Fabrique National d'Herstal (FN) e prodotto a partire dal 2009.</p>
                    <p class="par_bold">Scopri di più su <a href="https://it.wikipedia.org/wiki/FN_SCAR">wikipedia</a></p>
                    <p class="par_bold">Prezzo: 2500$</p>  
                </div>
                <div class="home__col">
                    <h2 class="home__title"><span>HK G36</span></h2>
                    <div>
                        <img class="home__img" src="../immagini/g36.png">
                    </div>
                    <p>
                    L'Heckler & Koch G36 è un fucile d'assalto tedesco calibro 5,56 × 45 mm NATO, progettato negli anni novanta dalla Heckler & Koch ed entrato in servizio nel 1997. È un'arma a fuoco selettivo alimentata tramite caricatori da 30 o 100 colpi.</p>
                    <p class="par_bold">Scopri di più su <a href="https://it.wikipedia.org/wiki/Heckler_%26_Koch_G36">wikipedia</a></p>
                    <p class="par_bold">Prezzo: 2000$</p>  
                </div>
                <div class="home__col">
                    <h2 class="home__title"><span>Bomba TSAR</span></a></h2>
                    <div>
                        <img class="home__img" src="../immagini/Tsar-Bomba.png">
                    </div>
                    <p>
                    La Bomba Zar (Tsar Bomba o RDS-220) è stato il più potente ordigno all'idrogeno mai sperimentato. La bomba, il cui nome in codice era Big Ivan, fu progettata in Unione Sovietica da un gruppo di fisici coordinati da Andrej Sacharov tra luglio e fine ottobre del 1961. L'energia che avrebbe dovuto liberare, stando alla fase progettuale, doveva essere di 100 Mt.</p>
                    <p class="par_bold">Scopri di più su <a href="https://it.wikipedia.org/wiki/Bomba_Zar">wikipedia</a></p>
                    <p class="par_bold">Prezzo: 10M $</p>  
                    </div class="home__col">
                <div class="home__col">
                    <h2 class="home__title">Beretta ARX 160</h2>
                    <div>
                        <img class="home__img" src="../immagini/arx160.png">
                    </div>
                    <p>
                    L'ARX 160 è un fucile d'assalto italiano camerato per il calibro 5,56 × 45 mm NATO, sviluppato e prodotto dalla Beretta.</p>
                    <p class="par_bold">Scopri di più su <a href="https://it.wikipedia.org/wiki/Beretta_ARX_160">wikipedia</a></p>
                    <p class="par_bold">Prezzo: 1500$</p>  
                </div>
                <div class="home__col">
                    <h2 class="home__title">Beretta 92FS</h2>
                    <div>
                        <img class="home__img" src="../immagini/92FS.png">
                    </div>
                    <p>
                    La Beretta 92 è una pistola semi-automatica a chiusura geometrica con blocco oscillante, progettata e costruita dalla azienda Beretta.</p>
                    <p class="par_bold">Scopri di più su <a href="https://it.wikipedia.org/wiki/Beretta_92">wikipedia</a></p>
                    <p class="par_bold">Prezzo: 600$</p>  
                </div>
                <div class="home__col">
                    <h2 class="home__title">Barrett M82A1</h2>
                    <div>
                        <img class="home__img" src="../immagini/Barrett-M82.png">
                    </div>
                    <p>
                    Il fucile M82 Barrett è un fucile semiautomatico a corto rinculo, prodotto dalla Barrett Firearms Company.
                    Si tratta di un fucile di precisione anti-materiale in calibro .50 BMG (12,7 × 99 mm NATO). Dotato di lunga gittata e munizioni altamente efficaci. Dati peso e dimensioni, non è adatto per impieghi a corto raggio o di ingaggio istintivo. Grazie alla cartuccia di produzione più recente Barrett (il .416), il fucile ha ulteriormente incrementato la sua portata e precisione a discapito del potere d'arresto.</p>
                    <p class="par_bold">Scopri di più su <a href="https://it.wikipedia.org/wiki/Barrett_M82">wikipedia</a></p>
                    <p class="par_bold">Prezzo: 15000$</p>  

                </div>
                <div class="home__col">
                    <h2 class="home__title">CheyTac M200</h2>
                    <div>
                        <img class="home__img" src="../immagini/chaytac m200.png">
                    </div>
                    <p>
                    L'M200 CheyTac Intervention è un fucile di precisione a otturatore girevole-scorrevole prodotto dalla compagnia statunitense Cheyenne Tactical LCC. Impiega munizioni calibro .408 Chey Tac, che garantiscono un'ottima precisione su distanze considerevoli, fino a quasi 3 km.</p>
                    <p class="par_bold">Scopri di più su <a href="https://it.wikipedia.org/wiki/M200_CheyTac">wikipedia</a></p>
                    <p class="par_bold">Prezzo: 12000$</p>  
                </div>
            </div>
            <div class="elencoArmi">
                <h2 style="text-align:center;">Armi acquistate</h2>
                <?php
                    $query = "SELECT armi.nomeArma, armi.tipo
                            FROM compratori JOIN compra ON compratori.username = compra.username 
                                JOIN armi ON armi.nomeArma = compra.nomeArma
                            WHERE compratori.username='$username'";
                    $ris = $conn->query($query) or die("<p>Query fallita!</p>");
                    if ($ris->num_rows == 0) {
                        echo "<p style='text-align: center; font-weight: bold; font-size: x-large;'>Nessuna arma acquistata</p>";
                    } else {
                        echo "<ul class='gunlist'>";
                        foreach($ris as $riga){
                            $arma = $riga['nomeArma'];
                            $tipo = $riga['tipo'];
                            echo "<li>".$arma.", ".$tipo."</li>";
                        }	
                        echo "</ul>";
                    }
                ?>
            </div>
        </div>
    </main>
    <?php 
		include('footer.php')
	?>
</body>
</html>
<?php
	$conn->close();
?>