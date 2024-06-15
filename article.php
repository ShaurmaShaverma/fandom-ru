<?php
    $connect = new PDO("mysql:host=localhost; dbname=fandom; charset=utf8",'root',''); 
    $article_id = $_POST['article_id'];
    $article_card = $connect->query("SELECT * FROM article_card WHERE `article_num` = '$article_id'");
    $article_card = $article_card->fetch();
    $article_part = $connect->query("SELECT * FROM article_part WHERE `article_num` = '$article_id'");
    $article = $connect->query("SELECT * FROM article WHERE `id` = '$article_id'");
    $article = $article->fetch();
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
            if ($_SESSION['newsession'] == 0 or $_SESSION['newsession'] == 2 or $_SESSION['newsession'] == 3) { 
                echo '<a href="aut.php" class="aut">ВОЙТИ</a>';
                echo '<a href="reg.php" class="reg">РЕГИСТРАЦИЯ</a>';
            } else {
                echo '<a href="user_page.php" class="usernick">'.$_SESSION['usernick'].'</a>';
                echo '<form action="sys/exit.php" method="post">
                        <input type="submit" value="Выйти" class="exit_btn">
                      </form>';
                
            }
        ?>
    </div>
    <div class="main_part article">
        <!-- Вывод названия статьи -->
        <h2 class="article_name"><?= $article[1] ?></h2>
        <!-- Вывод заголовков и текста разделов -->
        <?php foreach($article_part as $art_p) {?>
        <div class="text_block">
            <h2 class="text_block_name"><?= $art_p[1] ?></h2>
            <p class="article_text"><?= $art_p[2] ?></p>
        </div>    
        <?php } ?>
        <!-- Вывод информации карточки -->
        <div class="card">
            <img src="<?= $article_card[4] ?>" alt="#" class="card_img">
            <h2 class="card_name"><?= $article[1] ?></h2>
            <div class="card_info">
                <p><b>Локация:</b> <?= $article_card[1] ?></p>
                <p><b>Тип:</b> <?= $article_card[2] ?></p>
                <p><b>adipiscing elita:</b> <?= $article_card[3] ?></p>
            </div>
        </div>
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