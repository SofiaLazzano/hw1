<?php

session_start();

if(!empty($_POST['nome']) && !empty($_POST['cognome']) && !empty($_POST['username']) && !empty($_POST['email']) && 
    !empty($_POST['password'])){

      $errors = array();
      $conn = mysqli_connect('localhost', 'root', '', 'structure');


      
      if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])){

      $errors[] = 'Username non valido';

    
      } else{
        $username = mysqli_real_escape_string($conn, $_POST['username']);

        $query = "SELECT * FROM UTENTE WHERE USERNAME = '".$_POST['username']."'";

        $res = mysqli_query($conn, $query);
        if(mysqli_num_rows($res) > 0 ){

          $errors[] = 'Username già esistente';
        }
      }

    
      if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors[] = 'Email non valida';
      } else {

        $email = mysqli_real_escape_string($conn, $_POST['email']);

        $query = "SELECT * FROM UTENTE WHERE EMAIL = '".$_POST['email']."'";

        $res = mysqli_query($conn, $query);
        if(mysqli_num_rows($res)> 0 ){

          $errors[] = 'Email già esistente';

        }
      }
         
      if(strlen($_POST['password']) < 8 ){
        $errors[] = 'Password non valida';
      }
    
    if(count($errors) == 0){
      
    $name = mysqli_real_escape_string($conn, $_POST['nome']);
    $surname = mysqli_real_escape_string($conn, $_POST['cognome']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "INSERT INTO UTENTE VALUES('$name', '$surname','$username', '$email','$password')";
    
    if(mysqli_query($conn, $query)){
    
      $_SESSION['email'] = $_POST['email'];
      mysqli_close($conn);
      header('Location: homepage.php');
      exit;
    }else {
      $errors[] = 'Errore di connessione al database';
    }
    mysqli_close($conn);

    }
} else {
  $errors[] = "Riempire tutti i campi";

}
?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Oleo+Script+Swash+Caps&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Arvo:wght@700&display=swap" rel="stylesheet">
<link rel="icon" type="image/png" href="immagini/icona.png">
<link rel = 'stylesheet' href = 'sign_in.css'>
<script src = "checkform.js" defer></script>
<script src="sign_in.js" defer></script>
<title>WeSocial</title>
</head>

<body>

<div class = 'side-container'>
  <a class="side">Benvenuto su<br></a>
  <h>WeSocial</h>
  </div>
    <main class = 'box'>
      
        <form name="sign_in" method="post">
        
                <span class = 'text-center'>Inserisci i tuoi dati</span>
                <div class = 'input-container'>
                    <label id="nome"><input type = 'text' name = 'nome'><div id = 'adv'></div>
                    Nome</label>
                </div>
                <div class = 'input-container'>
                    <label id = 'cognome'><input type = "text" name = 'cognome'> <div id = 'adv2'></div>
                    Cognome
                    </label>
                </div>
                <div class = 'input-container'>
                 <label id = 'username'> <input type = "text" name = 'username' id = 'username'><div id = 'adv3'></div>
                  Username
                 </label>
                </div>
                <div class="input-container">
                  <label id = 'email'><input type="text" name = 'email' id = 'email'><div id = 'adv4'></div>
                  E-mail
                  </label>
                </div>
                <div class="input-container">
                 <label id = 'password'> <input type="password" name = 'password' id = 'password'><div id = 'adv5'></div>
                  Password
                 </label>
                </div>
              <label>
                <input type="submit" value="submit" class="button"></input>
                
              </label>
                  
        </form>
        <p>Sei già registrato? Effettua il  <a href = 'log_in.php'>login</a></p>
    </main>
</body>

</html>