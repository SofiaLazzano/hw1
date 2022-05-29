
<?php

session_start();
 
if(!isset($_SESSION['email'])){                                   
    header('log_in.php');                            
    exit;               
}

$conn = mysqli_connect('localhost', 'root', '', 'structure');
$img = $_GET['i'];

$query = "INSERT INTO posts(user, img) VALUES ('".$_SESSION['email']."', '".$img."')";
mysqli_query($conn, $query);

?>