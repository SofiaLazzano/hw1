
<?php

session_start();

if(!isset($_SESSION['email'])){                            
    header('log_in.php');                            
    exit;                                  
}



$conn = mysqli_connect('localhost', 'root', '', 'structure');
$query = "SELECT * FROM utente WHERE email = '".$_SESSION['email']."'";
$res = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($res); 
$query2 = "SELECT count(*) as nposts FROM posts WHERE user = '".$user['email']."'";
$res2 = mysqli_query($conn, $query2);
$posts = mysqli_fetch_assoc($res2);





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "homepage.css?v=<?php echo time(); ?>"/>
    <link rel="icon" type="image/png" href="immagini/icona.png">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <script src="home.js?v=<?php echo time(); ?>" defer></script>
    <title>WeSocial</title>
</head>
<body>
    
<header>
<nav>
   <img src = 'immagini/icona.png'> 
    <div class = 'rightblock'>
    <a href = 'homepage.php'>Home</a>
    <a href = 'logout.php'>Logout</a>
</div>
</nav>

</header>
    </body>
    <main>
      <section class = 'striscia'>
       <section class = 'background'>
       
        <section id ='utente'>    

           <div class = 'utente'> <img src = 'immagini/thor.png'  class = 'image'></div>
            <div class = 'username'>
                @<?php echo $user['username'];
                 ?>
            </div>
            <div class="stats">
                    <div>
                        <span class="conta"><?php echo $posts['nposts'] ?></span><br>Posts
                    </div>
                
        </section>

        </section>
</section>

        <section class = 'central'>
        </section>
<section class = 'striscia2'>
        <section class = 'side'>
            <div class = 'container'>
            <a class = 'tasto' href = 'crea.php'>Crea un post</a>
                
            </div>

        </section>
</section>
    </main>
</body>
</html>