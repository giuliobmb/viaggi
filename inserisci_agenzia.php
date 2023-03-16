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


    <div class="header">
        <h1>Gestione agenzie</h1>
    </div>
    <nav>
        <div class="search-container">
            <form method="post" action="backend/inserisci_agenzia.php">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>

                <label for="indirizzo">Indirizzo:</label>
                <input type="text" id="indirizzo" name="indirizzo" required>

                <label for="iso">ISO:</label>
                <input type="text" id="iso" name="iso" required>

                <label for="telefono">Esperienza</label>
                <select name="esperienza">
                    <option value="1">>5 anni</option>
                    <option value="2">tra 4 e 5 anni</option>
                    <option value="3">
                        <4 anni</option>
                </select>

                <label for="Rc">Rc:</label>
                <input type="checkbox" id="Rc" name="rc" value="1">

                <label for="Annullamento">Annullamento:</label>
                <input type="checkbox" id="Annullamento" name="annullamento" value="1">

                <input type="submit" value="Invia">
            </form>
        </div>
        
    </nav>
    <div class="container">
        <table>
            <tr>
                <th>ID Agenzia</th>
                <th>Nome</th>
                <th>Indirizzo</th>
                <th>ISO</th>
                <th>Esperienza</th>
                <th>Rc</th>
                <th>Annullamento</th>
                <th>Elimina</th>
            </tr>
            <?php
            // Connessione al database
            require 'backend/dbconfig.php';

            $conn = mysqli_connect($host, $user, $pass, $dbname);

            // Query per selezionare tutti i progetti
            $sql = "SELECT * FROM agenzia";
            $result = mysqli_query($conn, $sql);

            // Creazione della tabella
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $row['idagenzia']; ?></td>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo $row['indirizzo']; ?></td>
                    <td><?php echo $row['iso']; ?></td>
                    <td><?php echo $row['esperienza']; ?></td>
                    <td><?php if($row['rc']==1){echo "si";}else{echo "no";} ?></td>
                    <td><?php if($row['annullamento']==1){echo "si";}else{echo "no";}  ?></td>
                    <td class="gestione">
                        <div class="form-container-td">
                            <!-- Elimina pulsante -->
                            <form action="backend/elimina_agenzia.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['idagenzia']; ?>">
                                <input type="submit" value="Elimina" class="delete-btn" onclick="return confirm('Sei sicuro di voler eliminare questa agenzia?');">
                            </form>
                            <br>
                            <form action="commento.php" method="get">
                                <input type="hidden" name="id" value="<?php echo $row['idagenzia']; ?>">
                                <input type="submit" value="Commenti" class="edit-btn">
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