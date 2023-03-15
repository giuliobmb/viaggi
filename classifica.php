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






    ?>

    <div class="container">
        <table>
            <tr>
                <th>Numero busta</th>
                <th>Agenzia</th>
                <th>Punti</th>
                <th>Elimina</th>
            </tr>
            <?php
            // Connessione al database
            require 'backend/dbconfig.php';

            $conn = mysqli_connect($host, $user, $pass, $dbname);
            if (!$conn) {
                die("Connessione al database fallita: " . mysqli_connect_error());
            }

            $cig = $_GET['cig'];

            // Costruzione della query SQL per eliminare il progetto
            $sql = "SELECT * FROM offerta WHERE cig='$cig' ORDER BY cast(punti as int) DESC";

            $query = mysqli_query($conn, $sql);

            // Creazione della tabella
            while ($row = mysqli_fetch_array($query)) {

                $id = $row["idagenzia"];
                $sqlA = "SELECT nome FROM agenzia WHERE idagenzia='$id'";

                $queryA = mysqli_query($conn, $sqlA);
            ?>
                <tr>
                    <td><?php echo $row['nBusta']; ?></td>
                    <td><?php echo mysqli_fetch_array($queryA)["nome"]; ?></td>
                    <td><?php echo $row['punti']; ?></td>
                    <td class="gestione">
                        <div class="form-container-td">
                            <!-- Elimina pulsante -->
                            <form action="backend/elimina_offerta.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['idofferta']; ?>">
                                <input type="submit" value="Elimina" class="delete-btn" onclick="return confirm('Sei sicuro di voler eliminare questa offerta?');">
                            </form>
                        </div>
                    </td>
                </tr>
            <?php
            }

            // Chiusura della connessione
            mysqli_close($conn);
            ?>
        </table>
    </div>

</body>

</html>