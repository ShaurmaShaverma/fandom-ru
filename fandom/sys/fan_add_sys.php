<?php
    session_start();
    $connect = mysqli_connect('localhost','root','', 'fandom'); 
    $conn = new PDO("mysql:host=localhost; dbname=fandom; charset=utf8",'root',''); 
    $fan_name = $_POST['fandom_name'];
    $fan_sub = $_POST['fandom_sub'];
    $fan_icon = $_POST['fandom_icon'];
    $conn->query("INSERT INTO fandoms (id, fandom_name, fandom_sub, fandom_bg) VALUES (NULL, '$fan_name', '$fan_sub', '$fan_icon')");
    header('Location: ../index.php');
?>