<?php
    // начало сессии для корректной работы переменной, ответственной за определение авторизации пользователя 
    session_start();
    $connect = mysqli_connect('localhost','root','', 'fandom'); 
    $conn = new PDO("mysql:host=localhost; dbname=fandom; charset=utf8",'root',''); 
    // логин и пароль принятые со страницы авторизации
    $login = $_POST['login'];
    $password = $_POST['password'];
    // здесь из базы данных берется пароль пользователя с таким же логином, для последующей проверки совпадения
    $num = $connect->query("SELECT * FROM users WHERE login='$login'");
    $row = $num->fetch_row();
    var_dump($row);
    // проверка правильности пароля
    if (password_verify($password, $row[3])) {
        $_SESSION['newsession'] = 1;
        echo $_SESSION['newsession'];
        header('Location: ../index.php');
    } else {
        $_SESSION['newsession'] = 2;
        $_SESSION['message'] = 'Пароль или логин неверные';
        echo $_SESSION['newsession'];
        header('Location: ../aut.php');
    };
    // взятие id пользователя для корректного вывода статей за авторством данно пользователя на личной странице
    $userid = $conn->query("SELECT * FROM users where `login` = '$login'");
    $userid = $userid->fetch();
    // занесение этих данных в массив 
    $_SESSION['userid'] = $userid[0];
    $_SESSION['usernick'] = $userid[1];
?>