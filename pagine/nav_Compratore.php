<nav class="nav">
    <h1 class="nav__titolo">
        Gun Shop
    </h1>
    <div class="nav__menu">
        <ul>
            <li>
                <div class="navVuoto"></div>
            </li>
            <?php
                if (basename($_SERVER['PHP_SELF']) == "homeCompratore.php") {
                    echo "<li class='nav__attivo'>Home</li>";
                } else {
                    echo "<li class='navlinks'><a href='homeCompratore.php'>Home</a></li>";
                }
                if (basename($_SERVER['PHP_SELF']) == "dati_Compratore.php") {
                    echo "<li class='nav__attivo'>Dati</li>";
                } else {
                    echo "<li class='navlinks'><a href='dati_Compratore.php'>Dati</a></li>";
                }
                if (basename($_SERVER['PHP_SELF']) == "logout.php") {
                    echo "<li class='nav__attivo'>Logout</li>";
                } else {
                    echo "<li class='navlinks'><a href='logout.php'>Logout</a></li>";
                }
            ?>
            <li>
                <div class="navVuoto"></div>
            </li>
        </ul>
    </div>
</nav>