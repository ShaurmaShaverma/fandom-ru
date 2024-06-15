<?php
    $connect = new PDO("mysql:host=localhost; dbname=fandom; charset=utf8",'root',''); 
    session_start();
    $_SESSION['session'] = 0;
    $userID = $_SESSION['userid'];
    $user_articles = $connect->query("SELECT * FROM article where `user_num` = '$userID'");
    $users = $connect->query("SELECT * FROM users where `id` = '$userID'");
    $users = $users->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;700&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <nav>
        <div class="nav_left">
            <a href="index.php" class="a_main">ГЛАВНАЯ</a>
            <button id="menu_btn" class="menu_btn">V</button>
        </div>
        <form action="" method="post" class="search_bar">
            <input type="text" placeholder="🔎 Поиск...">
        </form>
    </nav>
    <div id="menu" class="menu">
        <?php
            if ($_SESSION['newsession'] == 2) { 
                echo '<a href="aut.php" class="aut">ВОЙТИ</a>';
                echo '<a href="reg.php" class="reg">РЕГИСТРАЦИЯ</a>';
            } else {
                echo '<a href="user_page.php" class="usernick">'.$_SESSION['usernick'].'</a>';
                echo '<form action="sys/exit.php" method="post">
                        <input type="submit" value="Выйти" class="exit_btn">
                      </form>';
            };
        ?>
    </div>
    <div class="main_part fandomADD">
            <!-- форма с инпутами для добавления нового фандома -->
            <h1>Добавление нового фандома</h1>
            <form action="sys/fan_add_sys.php" method="POST" class="fandom_add_form">
                <input type="text" name="fandom_name" class="fandom_name" placeholder="Название фандома...">
                <textarea name="fandom_sub" class="fandom_sub" placeholder="Описание фандома..."></textarea>
                <input type="text" name="fandom_icon" class="fandom_icon" placeholder="Ссылка на изображение иконки...">
                <input type="submit" value="✓ Добавить фандом" class="fandomADD_sub">
            </form>
    </div>
    <footer>
        <p class="copyright">©Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
        <div class="footer_right">
            <a href="#"><img src="img/vk.png" alt=""></a>
            <a href="#"><img src="img/tg.png" alt=""></a>
            <a href="#"><img src="img/ds.png" alt=""></a>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>