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
    $agenzia = $_POST["agenzia"];
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

    //////////////////////////////////////////////
    $sqlp = "SELECT MIN(prezzo) FROM offerta GROUP BY(idofferta)";

    

    $queryp = mysqli_query($conn, $sqlp);

    $prezzo_min = mysqli_fetch_array($queryp)["MIN(prezzo)"];

    

    $sqlaa = "SELECT esperienza FROM agenzia WHERE idagenzia='".$agenzia."'";

    $queryaa = mysqli_query($conn, $sqlp);

    $esperienza = mysqli_fetch_array($queryp)["esperienza"];


    $punti += $prezzo_min * 30 / $prezzo;
    //echo 'punti prezzo: '.$punti;

    if ($stelle == 1) {
        $punti += 13;
    } else if ($stelle == 2) {
        $punti += 10;
    } else if ($stelle == 3) {
        $punti += 8;
    } else if ($stelle == 4) {
        $punti += 5;
    }
    //echo 'punti stelle: '.$punti;

    if ($nAlunni == 1) {
        $punti += 6;
    } else if ($nAlunni == 2) {
        $punti += 4;
    } else if ($nAlunni == 3) {
        $punti += 1;
    }
    //echo 'punti camere: '.$punti;

    if ($posizione == 1) {
        $punti += 20;
        if ($mezzi == 1)
            $punti += 2;
    } else if ($posizione  == 2) {
        $punti += 15;
    } else if ($posizione  == 3) {
        $punti += 12;
    } else if ($posizione  == 4) {
        $punti += 2;
    }
    //echo 'punti zona e mezzi: '.$punti;

    if ($ristorante == 1) {
        $punti += 9;
    } else if ($ristorante == 2) {
        $punti += 6;
    } else if ($ristorante == 3) {
        $punti += 0;
    }
    //echo 'punti ristorazione: '.$punti;

    if ($servizioRistorante == 1) {
        $punti += 7;
    } else if ($servizioRistorante == 2) {
        $punti += 4;
    }
    //echo 'punti servizio: '.$punti;

    if ($treno == 1) {
        $punti += 10;
    } else if ($treno == 2) {
        $punti += 5;
    } else if ($treno == 3) {
        $punti += 4;
    } else if ($treno == 4) {
        $punti += 2;
    } else if ($treno == 5) {
        $punti += 0;
    }
    //echo 'punti treno: '.$punti;

    if ($bus == 1) {
        $punti += 10;
    } else if ($bus == 2) {
        $punti += 5;
    } else if ($bus == 3) {
        $punti += 0;
    } else if ($bus == 4) {
        $punti += 0;
    }
    //echo 'punti bus: '.$punti;

    if ($esperienza == 1) {
        $punti += 5;
    } else if ($esperienza == 2) {
        $punti += 3;
    } else if ($esperienza == 3) {
        $punti += 1;
    }




    $punti = intval($punti, 10);

    if($punti > 100){
        $punti = 100;
    }

    // Preparo la query SQL per l'inserimento dei dati
    $sql = "INSERT INTO Offerta (nBusta, idagenzia, prezzo, stelle, nAlunni, posizione, mezzi, ristorante, servizioRistorante, treno, bus, cig, punti) VALUES ('$nBusta', '$agenzia', $prezzo, $stelle, $nAlunni, '$posizione', '$mezzi', '$ristorante', '$servizioRistorante', '$treno', '$bus', '$cig', '$punti')";

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
            agenzia
            <select name="agenzia">
            <?php

            $sqla = "SELECT nome, idagenzia FROM agenzia";

            $querya = mysqli_query($conn, $sqla);

            while ($row = mysqli_fetch_array($querya)){
                $nome = $row["nome"];
                $id = $row["idagenzia"];

                echo '<option value="'.$id.'">'.$nome.'</option>';
            }

            ?>
            </select>
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
            <input type="hidden" name="cig" value="<?php if (isset($_GET["cig"])) {
                                                    echo ($_GET["cig"]);
                                                } else {
                                                    header("Location: menu.php");
                                                } ?>">
            <br>
            <br>
            <input type="submit" name="submit" value="Inserisci offerta">
            <br>
        </form>

</body>

</html>