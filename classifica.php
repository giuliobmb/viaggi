<?php
session_start();
if (!isset($_SESSION['email'])) { // se l'utente non è loggato viene automaticamente rimandato alla pagina di login.
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Gestione viaggi</title>
    <link rel="stylesheet" href="style/menu.css">
</head>

<body>
    <div class="navbar">
        <div class="menu">
            <?php
            if ($_SESSION["tipologia"] == 1) {
                echo ('<a href="menu.php">Menu</a><a href="inserisci_docente.php">Inserisci Docente</a><a href="inserisci_agenzia.php">Inserisci Agenzia</a><a href="inserisci_viaggio.php">Inserisci Viaggio</a>');
            }

            ?>

        </div>
        <div class="logout">
            <a href="backend/logout.php">Logout</a>
        </div>
    </div>
    <div class="header">
        <h1>Classifica offerta</h1>
    </div>
    <?php


    require 'dbconfig.php';

    $conn = mysqli_connect($host, $user, $pass, $dbname);
    if (!$conn) {
        die("Connessione al database fallita: " . mysqli_connect_error());
    }

    $cig = $_GET['cig'];

    // Costruzione della query SQL per eliminare il progetto
    $sql = "SELECT * FROM offerta WHERE cig='$cig' ORDER BY punti DESC";

    $query = mysqli_query($conn, $sql);



    $punti = 0;
    $punti += $prezzo_min * 30 / $proposte[$i][1];
    //echo 'punti prezzo: '.$punti;
    //echo $prezzo_min;
    if ($proposte[$i][2] == 1) {
        $punti += 13;
    } else if ($proposte[$i][2] == 2) {
        $punti += 10;
    } else if ($proposte[$i][2] == 3) {
        $punti += 8;
    } else if ($proposte[$i][2] == 4) {
        $punti += 5;
    }
    //echo 'punti stelle: '.$punti;

    if ($proposte[$i][3] == 1) {
        $punti += 6;
    } else if ($proposte[$i][3] == 2) {
        $punti += 4;
    } else if ($proposte[$i][3] == 3) {
        $punti += 1;
    }
    //echo 'punti camere: '.$punti;

    if ($proposte[$i][4] == 1) {
        $punti += 20;
        if ($proposte[$i][5] == 1)
            $punti += 2;
    } else if ($proposte[$i][4] == 2) {
        $punti += 15;
    } else if ($proposte[$i][4] == 3) {
        $punti += 12;
    } else if ($proposte[$i][4] == 4) {
        $punti += 2;
    }
    //echo 'punti zona e mezzi: '.$punti;

    if ($proposte[$i][6] == 1) {
        $punti += 9;
    } else if ($proposte[$i][6] == 2) {
        $punti += 6;
    } else if ($proposte[$i][6] == 3) {
        $punti += 0;
    }
    //echo 'punti ristorazione: '.$punti;

    if ($proposte[$i][7] == 1) {
        $punti += 7;
    } else if ($proposte[$i][7] == 2) {
        $punti += 4;
    }
    //echo 'punti servizio: '.$punti;

    if ($proposte[$i][8] == 1) {
        $punti += 10;
    } else if ($proposte[$i][8] == 2) {
        $punti += 5;
    } else if ($proposte[$i][8] == 3) {
        $punti += 4;
    } else if ($proposte[$i][8] == 4) {
        $punti += 2;
    } else if ($proposte[$i][8] == 5) {
        $punti += 0;
    }
    //echo 'punti treno: '.$punti;

    if ($proposte[$i][9] == 1) {
        $punti += 10;
    } else if ($proposte[$i][9] == 2) {
        $punti += 5;
    } else if ($proposte[$i][9] == 3) {
        $punti += 0;
    } else if ($proposte[$i][9] == 4) {
        $punti += 0;
    }
    //echo 'punti bus: '.$punti;

    if ($proposte[$i][10] == 1) {
        $punti += 5;
    } else if ($proposte[$i][10] == 2) {
        $punti += 3;
    } else if ($proposte[$i][10] == 3) {
        $punti += 1;
    }

    ?>



</body>

</html>