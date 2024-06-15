<?php 
    session_start();
    $connect = mysqli_connect('localhost','root','', 'fandom'); 
    $conn = new PDO("mysql:host=localhost; dbname=fandom; charset=utf8",'root',''); 
    $nickname = $_POST['nick'];
    $login = $_POST['login'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $admin = 0;
    $db = $connect->query("SELECT * FROM users WHERE login='$login'");
    $db_check = $db->fetch_row();
    if ($db_check[2] == $login) {
        $_SESSION['error'] = 'Пользователь c данной почтой уже зарегистрирован. Пожалуйста, смените почту';
        $_SESSION['newsession'] = 3;
        echo $_SESSION['newsession'];
        echo $db_check[2];
        header('Location: ../reg.php');
    } else {
        $conn->query("INSERT INTO users (id, nickname, login, password, admin) VALUES (NULL, '$nickname', '$login', '$password', '$admin')");
        header('Location: ../aut.php');
    };
?>