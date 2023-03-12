<?php
session_start();
if (!isset($_SESSION['email'])) { // se l'utente non è loggato viene automaticamente rimandato alla pagina di login.
    header('Location: login.php');
    exit;
}

if (isset($_POST["nLotto"])) {
    require 'backend/dbconfig.php';

    // Connessione al database
    $conn = new mysqli($host, $user, $pass, $dbname);

    // Verifica della connessione
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    // Preparazione dei dati per l'inserimento nel database
    $nLotto = $_POST["nLotto"];
    $meta = $_POST["meta"];
    $giorn = $_POST["giorn"];
    $ngiorni = $_POST["ngiorni"];
    $nstudenti = $_POST["nstudenti"];
    $ndocenti = $_POST["ndocenti"];
    $invalido = isset($_POST["invalido"]) ? 1 : 0;

    // Inserimento dei dati nella tabella viaggio
    $sql = "INSERT INTO viaggio (nLotto, meta, giorn, nstudenti, ndocenti, invalido, ngiorni)
VALUES ('$nLotto', '$meta', '$giorn', $nstudenti, $ndocenti, $invalido, $ngiorni)";

    if ($conn->query($sql) === TRUE) {
        echo "Dati inseriti correttamente!";
    } else {
        echo "Errore durante l'inserimento dei dati: " . $conn->error;
    }

    $conn->close();
}
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Inserisci viaggio</title>
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
    <h1>Inserimento dati viaggio</h1>
    <form method="post" action="">
        <label for="nLotto">Numero lotto:</label>
        <input type="text" name="nLotto" id="nLotto"><br><br>

        <label for="meta">Destinazione:</label>
        <input type="text" name="meta" id="meta"><br><br>

        <label for="giorn">Data partenza:</label>
        <input type="date" name="giorn" id="giorn"><br><br>

        <label for="giorn">Numero di giorni:</label>
        <input type="text" name="ngiorni" id="giorn"><br><br>

        <label for="nstudenti">Numero studenti:</label>
        <input type="number" name="nstudenti" id="nstudenti"><br><br>

        <label for="ndocenti">Numero docenti:</label>
        <input type="number" name="ndocenti" id="ndocenti"><br><br>

        <label for="invalido">Presenza di studenti con disabilità</label>
        <input type="checkbox" name="invalido" id="invalido" value="1"><br><br>

        <input type="submit" value="Inserisci">
    </form>
</body>

</html>