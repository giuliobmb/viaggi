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
        <h1>Gestione Utenti</h1>
    </div>
    <nav>
        <div class="search-container">
            <form method="post" action="backend/inserisci_docente.php">
            <label for="nome">Nome:</label>
			<input type="text" id="nome" name="nome" required>

            <label for="cognome">Cognome:</label>
            <input type="text" id="cognome" name="cognome" required>

			<label for="email">Email:</label>
			<input type="mail" id="email" name="email" required>
            
            <label for="telefono">Telefono</label>
			<input type="text" id="telefono" name="telefono" required>

			<label for="password">Password:</label>
			<input type="text" id="password" name="password" required>
	  		
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
                <th>ID Utente</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>Password</th>
                <th>Azione</th>
            </tr>
            <?php
            // Connessione al database
            require 'backend/dbconfig.php';

            $conn = mysqli_connect($host, $user, $pass, $dbname);

            // Query per selezionare tutti i progetti
            $sql = "SELECT * FROM utente";
            $result = mysqli_query($conn, $sql);

            // Creazione della tabella
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $row['idutente']; ?></td>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo $row['cognome']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['telefono']; ?></td>
                    <td><?php echo $row['password']; ?></td>
                    <td class="gestione">
                        <div class="form-container-td">
                            <!-- Elimina pulsante -->
                            <form action="backend/elimina_docente.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['idutente']; ?>">
                                <input type="submit" value="Elimina" class="delete-btn" onclick="return confirm('Sei sicuro di voler eliminare questo docente?');">
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