<?php
    $connect = new PDO("mysql:host=localhost; dbname=fandom; charset=utf8",'root',''); 
    $fandoms = $connect->query("SELECT * FROM fandoms");
    session_start();
    if (!isset($_SESSION['newsession'])) {
        $_SESSION['newsession'] = 0;
    };
?>
<!DOCTYPE html>
<html lang="ru">
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
    <!-- навигация с выпадающим меню -->
    <nav>
        <div class="nav_left">
            <a href="index.php" class="a_main">ГЛАВНАЯ</a>
            <button id="menu_btn" class="menu_btn">V</button>
        </div>
        <form action="" method="post" class="search_bar">
            <input type="text" placeholder="🔎 Поиск...">
        </form>
    </nav>
    <!-- выпадающее меню, содержание которого зависит от того, авторизован пользователь или нет. Если авторизован то в меню будет никнейм-ссылка на личную страницу и кнопка выхода из аккаунта, если не авторизован - кнопки регистрации и авторизации -->
    <div id="menu" class="menu">
        <?php
            if ($_SESSION['newsession'] == 0 or $_SESSION['newsession'] == 2 or $_SESSION['newsession'] == 3) { 
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
    <!-- главный блок -->
    <div class="main_part">
        <h1>Фандомы</h1>
        <!-- список фандомов с их описанием, выводящийся через foreach -->
        <div class="fandoms">
            <? foreach($fandoms as $fandom) { ?>
            <form action="articles.php" method="POST" class="big_fandom">
                <p href="articles.php" class="fandom"><img src="<?= $fandom['fandom_bg'] ?>" alt=""></p>
                <div class="right_fandom">
                    <p class="fandom_title"><?= $fandom['fandom_name'] ?></p>
                    <p class="fandom_descr"><?= $fandom['fandom_sub'] ?></p>
                    <input type="text" name="fandom_id" value="<?= $fandom[0] ?>"  style="width: 0px; height:0px; position:absolute; left:-2000px">
                    <input type="text" name="fandom_name" value="<?= $fandom[1] ?>"  style="width: 0px; height:0px; position:absolute; left:-2000px">
                    <input type="submit" class="fandom_link" value="Смотреть статьи...">
                </div>        
            </form>
            <?php } ?>
        </div>
    </div>
    <!-- футер с контактной информацией -->
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