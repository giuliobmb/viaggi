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
        <h1>Gestione viaggi</h1>
    </div>
    <nav>
    </nav>
    <div class="container">
        <table>
            <tr>
                <th class="td_id">CIG</th>
                <th class="td_titolo">N° lotto</th>
                <th class="td_anno">meta</th>
                <th class="td_docenti">Data</th>
                <th class="td_id">N° di giorni</th>
                <th class="td_id">N° studenti</th>
                <th class="td_id">N° docenti</th>
                <th class="td_id">Presenza invalido</th>
                <th class="td_azione">Azioni</th>
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
                    <td class="td_titolo"><?php echo $row['nLotto']; ?></td>
                    <td class="td_anno"><?php echo $row['meta']; ?></td>
                    <td class="td_docenti"><?php echo $row['giorn']; ?></td>
                    <td class="td_docenti"><?php echo $row['ngiorni']; ?></td>
                    <td class="td_classi"><?php echo $row['nstudenti']; ?></td>
                    <td class="td_utente"><?php echo $row['ndocenti']; ?></td>
                    <td class="td_utente"><?php echo $row['invalido']; ?></td>
                    <td class="gestione td_azione">
                        <div class="form-container-td">
                            <!-- Modifica pulsante -->
                            <form action="inserisci_offerta.php?cig=<?php echo($row["cig"])?>" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['cig']; ?>">
                                <input type="submit" value="Inserisci offerta" class="edit-btn">
                            </form>
                            <br><br>
                            <form action="classifica.php?cig=<?php echo($row["cig"])?>" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['cig']; ?>">
                                <input type="submit" value="visualizza classifica" class="edit-btn">
                            </form>
                        </div>
                        <div class="form-container-td">
                            <!-- Elimina pulsante -->
                            <?php
                            if ($_SESSION["tipologia"] == 1) {
                                echo ('<form action="backend/elimina_viaggio.php?cig='.$row["cig"].'" method="get">
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