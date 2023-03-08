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
                echo ('<a href="gestione_utenti.php">Inserisci Docente</a><a href="gestione_progetti.php">Inserisci Agenzia</a><a href="gestione_progetti.php">Inserisci Viaggio</a>');
            }

            ?>

        </div>
        <div class="logout">
            <a href="backend/logout.php">Logout</a>
        </div>
    </div>
    <div class="header">
        <h1>Gestione Progetti</h1>
    </div>
    <nav>
    </nav>
    <div class="container">
        <table>
            <tr>
                <th class="td_id">CIG</th>
                <th class="td_titolo">N° lotto</th>
                <th class="td_anno">meta</th>
                <th class="td_docenti">N° giorni</th>
                <th class="td_classi">N° studenti</th>
                <th class="td_utente">N° docenti</th>
                <th class="td_azione">Studente invalido</th>
            </tr>
            <?php
            // Connessione al database
            require 'backend/dbconfig.php';

            $conn = mysqli_connect($host, $user, $pass, $dbname);


            // Query per selezionare tutti i progetti
            $sql = "SELECT * FROM viaggio";

            $result = mysqli_query($conn, $sql);

            // Creazione della tabella
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td class="td_id"><?php echo $row['cig']; ?></td>
                    <td class="td_titolo"><?php echo $row['nlotto']; ?></td>
                    <td class="td_anno"><?php echo $row['meta']; ?></td>
                    <td class="td_docenti"><?php echo $row['nstudenti']; ?></td>
                    <td class="td_classi"><?php echo $row['ndocenti']; ?></td>
                    <td class="td_utente"><?php echo $row['invalido']; ?></td>
                    <td class="gestione td_azione">
                        <div class="form-container-td">
                            <!-- Modifica pulsante -->
                            <form action="modifica_offerta.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['cig']; ?>">
                                <input type="submit" value="Inserisci offerta" class="edit-btn">
                            </form>
                        </div>
                        <div class="form-container-td">
                            <!-- Elimina pulsante -->
                            <?php
                            if ($_SESSION["tipologia"] == 1) {
                                echo ('<form action="backend/elimina_offerta.php" method="post">
                                <input type="hidden" name="id" value="'.$row['cig'].'">
                                <input type="submit" value="Elimina" class="delete-btn" onclick="return confirm("Sei sicuro di voler eliminare questo progetto?");">
                            </form>');
                            }

                            ?>


                            
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