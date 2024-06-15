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
    <div class="main_part user_part">
        <!-- Никнейм владельца страницы -->
        <h2 class="username"><?php echo $_SESSION['usernick']; ?></h2>
        <div class="user_articles_block">
            <h2 class="user_articles">Статьи от <?php echo $_SESSION['usernick']; ?></h2>
            <!-- статьи за авторством данного пользователя -->
            <div class="user_fandoms">
                <?php foreach($user_articles as $u_art) {
                    $art_id = $u_art[0];
                    $art_img = $connect->query("SELECT * FROM article_card WHERE `article_num` = '$art_id'");
                    $art_img = $art_img->fetch();
                    $art_img = $art_img[4];
                ?>
                <form action="article.php" method="POST" class="article1" style="background: linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)), url(<?= $art_img; ?>);background-size: cover;">
                    <input type="submit" class="h2" value="+">
                    <p><?= $u_art[1]; ?></p>
                    <input type="text" name="article_id" value="<?= $art_id ?>"  style="width: 0px; height:0px; position:absolute; left:-2000px">
                </form>
                <?php }; ?>
            </div>
            <!-- кнопка выхода из аккаунта и ссылка на страницу с добавлением новой статьи -->
            <form action="sys/exit.php" method="post" class="u_page_buttons">
                <input type="submit" value="Выйти">
                <a href="articleADD.php" class="add_article">+ Добавить статью</a>
            </form>
            <!-- уникальные для админа кнопки со списком пользователей, добавления нового фандома и списком фандомов -->
            <?php 
                $admin = $users[4];
                if ($admin == 1) {
                    echo '<div class="admin_buttons">';
                    echo '<a href="users_list.php" class="users_list">Список пользователей</a>';
                    echo '<a href="fandomADD.php" class="users_list">Добавить фандом</a>';
                    echo '<a href="fandom_list.php" class="users_list">Список фандомов</a>';
                    echo '</div>';
                } else {
                    echo '<div class="admin_buttons">';
                    echo '<a href="oth_users_list.php" class="users_list">Список пользователей</a>';
                    echo '</div>';
                }
            ?>    
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