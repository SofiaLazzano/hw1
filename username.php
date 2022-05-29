<?php

session_start();
$user = $_GET['q'];
$conn = mysqli_connect("localhost", "root", "", "structure") or die(mysqli_error($conn));
$query = "SELECT * FROM utente WHERE username = '".$user."'";
$res = mysqli_query($conn, $query);
echo json_encode(mysqli_fetch_assoc($res));

?>