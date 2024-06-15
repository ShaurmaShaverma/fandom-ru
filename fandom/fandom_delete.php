<?php
    $connect = new PDO("mysql:host=localhost; dbname=fandom; charset=utf8",'root',''); 
    $fandomID = $_POST['fandomID'];
    $fandoms = $connect->query("SELECT * FROM fandoms WHERE `id` = '$fandomID'");
    $fandoms=$fandoms->fetch();
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
    <div class="main_part del_main_part">
        <!-- Вопрос, в котором название фандома выводится из базы данных -->
        <h1 class="del_user_nick">Вы уверены, что хотите удалить фандом <b><?= $fandoms[1]; ?></b>?</h1>
        <!-- форма выбора, в которой админ подтверждает или нет своей решение по поводу удаления фандома -->
        <div class="choice_forms">
            <form action="sys/fan_delete_sys.php" method="POST" class="choice_form">
                <input type="text" name="fandomID" value="<?= $fandomID ?>" style="width: 0px; height:0px; position:absolute; left:-2000px">
                <input type="text" name="del_status" value="1" style="width: 0px; height:0px; position:absolute; left:-2000px">
                <input type="submit" value="Да">
            </form>
            <form action="sys/fan_delete_sys.php" method="POST" class="choice_form">
                <input type="text" name="fandomID" value="<?= $fandomID ?>" style="width: 0px; height:0px; position:absolute; left:-2000px">
                <input type="text" name="del_status" value="0" style="width: 0px; height:0px; position:absolute; left:-2000px">
                <input type="submit" value="Нет">
            </form>
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