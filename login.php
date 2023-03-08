<?php
//error_reporting(E_ERROR | E_PARSE);
session_start();

if (isset($_SESSION['email'])) { // se l'utente è già loggato viene automaticamente rimandato alla pagina.
  header('Location: menu.php');
  exit;
}
if (isset($_POST["password"])) {

  $passwd = $_POST['password'];
  $user = $_POST['email'];

  //echo '<h1>'.$passwd.'</>';

  $hostname = "localhost";
  $username = "root";
  $password = "";
  $dbname = "viaggio";
  $conn = mysqli_connect($hostname, $username, $password, $dbname);

  //print_r($conn);
  if ($conn->connect_error) {
    echo 'error';
    die("Connection failed: " . $conn->connect_error);
  }

  $query = "SELECT * FROM utente WHERE email='$user' AND password='$passwd'";
  //echo $query;
  $execute = mysqli_query($conn, $query);
  //print_r($execute);

  if (mysqli_num_rows($execute) > 0) {
    $riga = mysqli_fetch_array($execute, MYSQLI_ASSOC);

    $_SESSION['email'] = $user;
    $_SESSION['password'] = $passwd;
    $_SESSION['tipologia'] = $riga["tipologia"];

    header('Location: menu.php');
  } else {
    echo "Login non valido.";
  }
  mysqli_close($conn);
}


?>
<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style/style.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>

  <div class="login-form">
    <h2>Login portale viaggi</h2>
    <form method="POST" action="">
      <label for="email">Email</label>
      <input type="text" id="username" name="email" required>
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>
      <button type="submit">Accedi</button>
    </form>
  </div>


</body>

</html>