<?php

 session_start();
 
if(!isset($_SESSION['email'])){                                   
    header('log_in.php');                            
    exit;               
}

$conn = mysqli_connect('localhost', 'root', '', 'structure');
$img = $_GET['i'];
$description = $_GET['d'];

echo $img;

$query = "INSERT INTO posts(user, img, description) VALUES ('".$_SESSION['email']."', '".$img."', '".$description."')";
mysqli_query($conn, $query);

?>