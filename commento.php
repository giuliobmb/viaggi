<?php
session_start();
if (!isset($_SESSION['email'])) { // se l'utente non è loggato viene automaticamente rimandato alla pagina di login.
    header('Location: login.php');
    exit;
}

if(!isset($_GET["id"])){
    header("Location: menu.php");
}
$idagenzia = $_GET["id"];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Inserisci docente</title>
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
        <h1>Gestione Commenti</h1>
    </div>
    <nav>
        <div class="search-container">
            <form method="post" action="backend/inserisci_commento.php">
            <input type="hidden" name="idagenzia" value="<?php echo($idagenzia); ?>">
            <label for="commento">Nuovo commento:</label>
			<input type="text" id="commento" name="commento" required>
	  		
			<input type="submit" value="Invia">
            </form>
        </div>
        <div class="add-user">
            <a href="inserisciUtente.php">Inserisci Utente</a>
        </div>
    </nav>
    <div class="container">
        <table>
            <tr>
                <th>ID commento</th>
                <th>Testo</th>
                <th>Timestamp</th>
                <th>Elimina</th>
            </tr>
            <?php
            

            // Connessione al database
            require 'backend/dbconfig.php';

            $conn = mysqli_connect($host, $user, $pass, $dbname);

            // Query per selezionare tutti i progetti
            $sql = "SELECT * FROM commenti WHERE idagenzia='$idagenzia'";
            $result = mysqli_query($conn, $sql);

            // Creazione della tabella
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $row['idcommento']; ?></td>
                    <td><?php echo $row['testo']; ?></td>
                    <td><?php echo $row['timestamp']; ?></td>
                    <td class="gestione">
                        <div class="form-container-td">
                            <!-- Elimina pulsante -->
                            <form action="backend/elimina_commento.php" method="post">
                                <input type="hidden" name="idagenzia" value="<?php echo $row['idagenzia']; ?>">
                                <input type="hidden" name="id" value="<?php echo $row['idcommento']; ?>">
                                <input type="submit" value="Elimina" class="delete-btn" onclick="return confirm('Sei sicuro di voler eliminare questo commento?');">
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