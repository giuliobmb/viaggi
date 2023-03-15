<?php
session_start();
if (!isset($_SESSION['email'])) { // se l'utente non è loggato viene automaticamente rimandato alla pagina di login.
    header('Location: ../login.php');
    exit;
}

// Connessione al database
require 'dbconfig.php';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$nome = $_POST['nome'];
$indirizzo = $_POST['indirizzo'];
$iso = $_POST['iso'];
$esperienza = $_POST['esperienza'];

if (isset($_POST['rc'])) {
    $rc = $_POST['rc'];
} else {
    $rc = 0;
}

if (isset($_POST['annullamento'])) {
    $annullamento = $_POST['annullamento'];
} else {
    $annullamento = 0;
}

// Prepare and execute SQL query to insert new record
$sql = "INSERT INTO `agenzia` (`nome`, `indirizzo`, `iso`, `esperienza`, `rc`, `annullamento`) 
VALUES ('$nome', '$indirizzo', '$iso', '$esperienza', '$rc', '$annullamento')";

//echo $sql;

if ($conn->query($sql) === TRUE) {
    header('Location: ../inserisci_agenzia.php');
    echo "Record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
