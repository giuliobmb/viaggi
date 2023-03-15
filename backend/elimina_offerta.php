<?php
      session_start();
      if (!isset($_SESSION['email'])) { // se l'utente non è loggato viene automaticamente rimandato alla pagina di login.
        header('Location: ../login.php');
        exit;
      }

// Connessione al database
require 'dbconfig.php';

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("Connessione al database fallita: " . mysqli_connect_error());
}

// Recupero il valore del campo "titolo" dalla richiesta POST
$cig = $_POST['id'];

// Costruzione della query SQL per eliminare il progetto
$sql = "DELETE FROM offerta WHERE idofferta='$cig'";


// Esecuzione della query
if (mysqli_query($conn, $sql)) {
    header('Location: ../menu.php');
} else {
    echo "Errore nell'eliminazione del viaggio: " . mysqli_error($conn);
}

// Chiusura della connessione al database
mysqli_close($conn);

?>
