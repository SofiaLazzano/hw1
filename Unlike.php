<?php

session_start();


if(!isset($_SESSION['email'])){                               
    header('log_in.php');                            
        exit;                                  
}


$postid = urlencode($_GET['postid']);
$conn = mysqli_connect('localhost', 'root', '', 'structure') or die(mysqli_error($conn));
$query = "DELETE FROM likes WHERE user = '".$_SESSION['email']."' AND  post = ".$postid;

mysqli_query($conn, $query);


$query = "SELECT id, nlikes FROM posts WHERE id = " .$postid;
$res = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($res);
echo json_encode($row);
?>