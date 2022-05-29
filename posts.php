<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'structure') or die(mysqli_error($conn));
$query = "SELECT * FROM (posts p join utente u on u.email = p.user) left join likes l on l.post = p.id  WHERE email = '".$_SESSION['email']."'";
$res = mysqli_query($conn, $query);
$results = array();
while($row = mysqli_fetch_assoc($res)){
    $results[] = $row;
}
echo json_encode($results);
?>