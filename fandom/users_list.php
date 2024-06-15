<?php
    $connect = new PDO("mysql:host=localhost; dbname=fandom; charset=utf8",'root',''); 
    $users = $connect->query("SELECT * FROM users");
    session_start();
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
    <div class="main_part user_part">
        <!-- шапка таблицы -->
        <div class="user user_header">
            <div>
                <p class="userID"><b>ID</b></p>
                <p class="user_nickname"><b>Никнейм</b></p>
                <p class="user_mail"><b>Почта</b></p>
                <p class="admin_status"><b>Админ</b></p>
            </div>
        </div>
        <!-- список зарегистрированных на сайте пользователей -->
        <?php foreach ($users as $us) { 
            if ($us[4] == 1) {
                $admin_status = 'Да';
            } else {
                $admin_status = 'Нет'; } ?>
            <div class="user">
                <form action="other_user_page.php" method="POST" class="user_form">
                    <p class="userID"><?= $us[0]; ?></p>
                    <p class="user_nickname"><?= $us[1]; ?></p>
                    <p class="user_mail"><?= $us[2]; ?></p>
                    <p class="admin_status"><?= $admin_status; ?></p>
                    <input type="text" name="oth_userid" value="<?= $us[0]; ?>" style="width: 0px; height:0px; position:absolute; left:-2000px">
                    <input type="submit" value="Пользователь" class="u_f_submit">
                </form>
                <form action="user_delete.php" method="POST" class="delete_user">
                    <input type="text" name="oth_userid" value="<?= $us[0]; ?>" style="width: 0px; height:0px; position:absolute; left:-2000px">
                    <input type="submit" value="Удалить пользователя" class="del_us_sub">
                </form>
            </div>
        <? } ?>
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