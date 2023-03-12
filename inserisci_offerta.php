<?php
// Connessione al database
require 'backend/dbconfig.php';

// Connessione al database
$conn = new mysqli($host, $user, $pass, $dbname);

// Verifica della connessione
if (!$conn) {
    die("Connessione fallita: " . mysqli_connect_error());
}

// Controllo se il form è stato sottomesso
if (isset($_POST["nBusta"])) {
    // Prendo i valori dai campi del form
    $nBusta = $_POST["nBusta"];
    $nome = $_POST["nome"];
    $tourOperator = $_POST["tourOperator"];
    $prezzo = $_POST["prezzo"];
    $stelle = $_POST["stelle"];
    $nAlunni = $_POST["nAlunni"];
    $posizione = $_POST["posizione"];
    $mezzi = $_POST["mezzi"];
    $ristorante = $_POST["ristorante"];
    $servizioRistorante = $_POST["servizioRistorante"];
    $treno = $_POST["treno"];
    $bus = $_POST["bus"];
    //$punti = $_POST["punti"];
    $cig = $_POST["cig"];

    $punti += $prezzo_min * 30 / $proposte[$i][1];
    //echo 'punti prezzo: '.$punti;
    //echo $prezzo_min;
    if ($proposte[$i][2] == 1) {
        $punti += 13;
    } else if ($proposte[$i][2] == 2) {
        $punti += 10;
    } else if ($proposte[$i][2] == 3) {
        $punti += 8;
    } else if ($proposte[$i][2] == 4) {
        $punti += 5;
    }
    //echo 'punti stelle: '.$punti;

    if ($proposte[$i][3] == 1) {
        $punti += 6;
    } else if ($proposte[$i][3] == 2) {
        $punti += 4;
    } else if ($proposte[$i][3] == 3) {
        $punti += 1;
    }
    //echo 'punti camere: '.$punti;

    if ($proposte[$i][4] == 1) {
        $punti += 20;
        if ($proposte[$i][5] == 1)
            $punti += 2;
    } else if ($proposte[$i][4] == 2) {
        $punti += 15;
    } else if ($proposte[$i][4] == 3) {
        $punti += 12;
    } else if ($proposte[$i][4] == 4) {
        $punti += 2;
    }
    //echo 'punti zona e mezzi: '.$punti;

    if ($proposte[$i][6] == 1) {
        $punti += 9;
    } else if ($proposte[$i][6] == 2) {
        $punti += 6;
    } else if ($proposte[$i][6] == 3) {
        $punti += 0;
    }
    //echo 'punti ristorazione: '.$punti;

    if ($proposte[$i][7] == 1) {
        $punti += 7;
    } else if ($proposte[$i][7] == 2) {
        $punti += 4;
    }
    //echo 'punti servizio: '.$punti;

    if ($proposte[$i][8] == 1) {
        $punti += 10;
    } else if ($proposte[$i][8] == 2) {
        $punti += 5;
    } else if ($proposte[$i][8] == 3) {
        $punti += 4;
    } else if ($proposte[$i][8] == 4) {
        $punti += 2;
    } else if ($proposte[$i][8] == 5) {
        $punti += 0;
    }
    //echo 'punti treno: '.$punti;

    if ($proposte[$i][9] == 1) {
        $punti += 10;
    } else if ($proposte[$i][9] == 2) {
        $punti += 5;
    } else if ($proposte[$i][9] == 3) {
        $punti += 0;
    } else if ($proposte[$i][9] == 4) {
        $punti += 0;
    }
    //echo 'punti bus: '.$punti;

    if ($proposte[$i][10] == 1) {
        $punti += 5;
    } else if ($proposte[$i][10] == 2) {
        $punti += 3;
    } else if ($proposte[$i][10] == 3) {
        $punti += 1;
    }






    // Preparo la query SQL per l'inserimento dei dati
    $sql = "INSERT INTO Offerta (nBusta, nome, tourOperator, prezzo, stelle, nAlunni, posizione, mezzi, ristorante, servizioRistorante, treno, bus, cig) VALUES ('$nBusta', '$nome', '$tourOperator', $prezzo, $stelle, $nAlunni, '$posizione', '$mezzi', '$ristorante', '$servizioRistorante', '$treno', '$bus', $cig)";

    // Eseguo la query e controllo se l'operazione è andata a buon fine
    if (mysqli_query($conn, $sql)) {
        echo "Offerta inserita con successo!";
        header("Location: menu.php");
    } else {
        echo "Errore nell'inserimento dell'offerta: " . mysqli_error($conn);
    }
    // Chiudo la connessione al database
    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Inserimento offerta viaggio</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: auto;
            max-width: 800px;
            padding: 20px;
        }

        form {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        h1 {
            margin-top: 0;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        select {
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            padding: 5px;
            width: 100%;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
            padding: 10px;
            margin-top: 10px;
            width: 100%;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #3e8e41;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Inserimento offerta viaggio</h1>
        <form method="POST" action="">
            <br>
            Numero busta<input name="nBusta" id="nome" type="text">
            <br>
            <br>
            Tour Operator<input name="tourOperator" id="tourOperator" type="text">
            <br>
            <br>
            Nome agenzia<input name="nome" id="nome" type="text" onchange="checkNome()">
            <br>
            <br>
            Prezzo<input name="prezzo" id="prezzo" type="text" onchange="checkPrezzo()">
            <br>
            <br>
            <p id="err"></p>

            Stelle
            <select name="stelle">
                <option value="1">4</option>
                <option value="2">3sup</option>
                <option value="3">3</option>
                <option value="4">inf</option>
            </select>
            <br>
            <br>
            Camere alunni
            <select name="nAlunni">
                <option value="1">3</option>
                <option value="2">4</option>
                <option value="3">oltre</option>
            </select>
            <br>
            <br>
            Zona
            <select name="posizione">
                <option value="1">centrale</option>
                <option value="2">limitrofa</option>
                <option value="3">semicentrale</option>
                <option value="4">periferica</option>
            </select>
            <br>
            <br>
            Mezzi
            <select name="mezzi">
                <option value="1">si</option>
                <option value="2">no</option>
            </select>
            <br>
            <br>
            Ristorazione
            <select name="ristorante">
                <option value="1">in hotel</option>
                <option value="2">ristorante</option>
                <option value="3">altro ristorante</option>
            </select>
            <br>
            <br>
            Servizio
            <select name="servizioRistorante">
                <option value="1">buffet/self-service</option>
                <option value="2">servito</option>
            </select>
            <br>
            <br>
            Treno
            <select name="treno">
                <option value="5">no</option>
                <option value="1">alta velocità</option>
                <option value="2">intercity</option>
                <option value="3">cuccette4</option>
                <option value="4">cuccette6</option>
            </select>
            <br>
            <br>
            Bus
            <select name="bus">
                <option value="4">no</option>
                <option value="1">2 autisti</option>
                <option value="2">1 autista</option>
                <option value="3">viaggio a/r</option>
            </select>
            <input type="hidden" name="cig" value="<?php if(isset($_GET["cig"])){echo($_GET["cig"]);}else{header("Location: menu.php");} ?>">
            <br>
            <br>
            <input type="submit" name="submit" value="Inserisci offerta">
            <br>
        </form>

</body>

</html>