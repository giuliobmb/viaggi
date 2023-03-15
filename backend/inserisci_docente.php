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
$cognome = $_POST['cognome'];
$email = $_POST['email'];
$password = $_POST['password'];
$telefono = $_POST['telefono'];

// Prepare and execute SQL query to insert new record
$sql = "INSERT INTO `utente` (`nome`, `cognome`, `email`, `password`, `telefono`) 
VALUES ('$nome', '$cognome', '$email', '$password', '$telefono')";

if ($conn->query($sql) === TRUE) {
    header('Location: ../inserisci_docente.php');
    echo "Record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
