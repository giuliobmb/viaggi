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
    <title>Inserisci agenzia</title>
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


    