<?php
    $connect = new PDO("mysql:host=localhost; dbname=fandom; charset=utf8",'root',''); 
    session_start();
    if (!isset($_SESSION['newsession'])) {
        $_SESSION['newsession'] = 0;
    };
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
            if (($_SESSION['newsession'] == 0) or ($_SESSION['newsession'] == 2) or ($_SESSION['newsession'] == 3)) { 
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
    <div class="main_part reg_section">
        <h2 class="reg_title">РЕГИСТРАЦИЯ</h2>
        <!-- форма регистрации -->
        <form method="post" action="sys/reg_sys.php" class="reg_form forms">
            <input type="text" placeholder="Ваш никнейм..." class="reg_field" name="nick">
            <input type="email" placeholder="Ваша почта..."class="reg_field" name="login">
            <input type="password" placeholder="Ваш пароль..."class="reg_field" name="password">
            <input type="submit" value="Зарегистрироваться" class="reg_sub">
            <!-- текст, который будет появлятся если пользователь с такой почтой уже зарегистрирован -->
            <p>
                <?php
                    if ($_SESSION['newsession'] == 3) {
                        echo $_SESSION['error'];
                    };
                ?>
            </p>
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