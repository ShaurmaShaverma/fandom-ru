<?php
    $connect = new PDO("mysql:host=localhost; dbname=fandom; charset=utf8",'root',''); 
    $fandoms = $connect->query("SELECT * FROM fandoms");
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
        <div class="user user_header fandom_header">
            <div>
                <p class="userID"><b>ID</b></p>
                <p class="user_nickname"><b>Фандом</b></p>
            </div>
        </div>
        <!-- таблица со списком фандомов -->
        <?php foreach ($fandoms as $fan) { ?>
            <div class="user fandoms_list">
                <form action="articles.php" method="POST" class="user_form fandom_form">
                    <p class="userID"><?= $fan[0]; ?></p>
                    <p class="user_nickname"><?= $fan[1]; ?></p>
                    <input type="text" name="fandom_id" value="<?= $fan[0]; ?>" style="width: 0px; height:0px; position:absolute; left:-2000px">
                    <input type="text" name="fandom_name" value="<?= $fan[1]; ?>" style="width: 0px; height:0px; position:absolute; left:-2000px">
                    <input type="submit" value="Статьи фандома" class="u_f_submit f_f_submit">
                </form>
                <form action="fandom_delete.php" method="POST" class="delete_user delete_fandom">
                    <input type="text" name="fandomID" value="<?= $fan[0]; ?>" style="width: 0px; height:0px; position:absolute; left:-2000px">
                    <input type="submit" value="Удалить фандом" class="del_us_sub">
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