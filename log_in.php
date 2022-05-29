<?php



session_start();                                      

if(isset($_SESSION['email'])){                                                           
  header('Location: homepage.php');                                                               
}

if(isset($_POST['email']) && isset($_POST['password'])){                                 

  $conn = mysqli_connect('localhost', 'root','', 'structure');

  $query = "SELECT * FROM UTENTE WHERE EMAIL = '".$_POST['email']."' AND PASSWORD = '".$_POST['password']."'";
  $res = mysqli_query($conn, $query);

  if(mysqli_num_rows($res) > 0){

   $_SESSION['email'] = $_POST['email'];
                                                                                  
    header('Location: homepage.php');                                                                              
    exit;
  }else {
    $error = true;                                                                     
  }


}
?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Oleo+Script+Swash+Caps&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
<link rel="icon" type="image/png" href="immagini/icona.png">
<link rel = 'stylesheet' href = 'log_in.css'>
<title>WeSocial</title>
</head>

<body>
<?php

if(isset($error)){

  echo '<p class = "error">';
  echo 'Credenziali non valide';
  echo '</p>';
}

?>

    <main class = 'box'>
        <form name = 'log_in' method="post">

            <span class = 'text-center'>Effettua l'accesso</span>
             <div class="input-container">
               <input type="text" name = 'email'>
               <label>E-mail</label>
             </div>
             <div class="input-container">
               <input type="password" name = 'password'>
               <label>Password</label>
             </div>
             <button type="submit" value="submit" class="button">Accedi</button>
             <p>Non sei ancora registrato? Clicca <a href = 'sign_in.php'>qui</a></p>
             
        </form>
    </main>
</body>



</html>