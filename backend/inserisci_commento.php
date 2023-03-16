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
$nome = $_POST['commento'];
$idagenzia = $_POST['idagenzia'];

// Prepare and execute SQL query to insert new record
$sql = "INSERT INTO `commenti` (`testo`, `idagenzia`) 
VALUES ('$nome', '$idagenzia')";

if ($conn->query($sql) === TRUE) {
    header("Location: ../commento.php?id=$idagenzia");
    echo "Record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
