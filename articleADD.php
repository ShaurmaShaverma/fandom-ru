<?php
    $connect = new PDO("mysql:host=localhost; dbname=fandom; charset=utf8",'root',''); 
    $fandoms = $connect->query("SELECT * FROM fandoms");
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
    <title>Добавление статьи</title>
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
        <!-- форма добавления разделов и их заголовков -->
        <form action="sys/art_add_sys.php" method="POST" class="articleADD" id="articleADD">
            <input type="text" class="article_nameADD" placeholder="Добавьте название статьи..." name="art_name">
            <div id="input_block">
                <div class="text_block ADD">
                    <input type="text" class="text_block_nameADD" placeholder="Добавьте название раздела..." name="part_name0">
                    <textarea class="article_textADD" placeholder="Добавьте текст раздела..." name="part_text0"></textarea>
                </div>
            </div>
            <!-- форма добавления информации в карточку -->
            <div class="card">
                <div class="card_img_block"><input type="text" class="card_imgADD" placeholder="Вставьте ссылку на изображение..." name="card_img"></div>
                <div class="card_info">
                    <p><b>Lorem ipsum:</b><input type="text" name="char1"></p>
                    <p><b>sit amet:</b><input type="text" name="char2"></p>
                    <p><b>adipiscing elita:</b><input type="text" name="char3"></p>
                </div>
            </div>
            <!-- выпадающий список в котором выбирается фандом, к которому относится статья -->
            <select name="fandom_name" id="fandom_name" class="fandom_list">
                <?php foreach ($fandoms as $fandom) { ?>
                <option value="<?= $fandom['fandom_name'] ?>"><?= $fandom['fandom_name'] ?></option>
                <?php } ?>
            </select>
            <!-- кнопки добавления новых инпутов для добавления разделов -->
            <div class="btn_block">
                <button class="partADD" id="partADD" type="button">+ Добавить раздел</button>
                <input type="text" name="counter" id="counter" value="0">
                <input type="submit" class="articleADD_submit" value="✓ Добавить статью"> 
            </div> 
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


    <!-- js-функция, добавляющая новые инпуты для разделов -->
    <script>
        let menu_btn = document.querySelector('.menu_btn'), 
        menu = document.querySelector('.menu'), 
        rotate = document.querySelector('.menu_btn');
        menu_btn.addEventListener('click', function(e){menu.classList.toggle('active'); 
        rotate.classList.toggle('rotate')});
        let counter = 1;
        let first;
        first = "<div class='text_block ADD'><input type='text' class='text_block_nameADD' placeholder='Добавьте название раздела...' name='part_name" + counter + "'><textarea class='article_textADD' placeholder='Добавьте текст раздела...' name='part_text" + counter + "'></textarea></div>";
        function function1() {
            first = '<div class="text_block ADD"><input type="text" class="text_block_nameADD" placeholder="Добавьте название раздела..." name="part_name' + counter + '"><textarea class="article_textADD" placeholder="Добавьте текст раздела..." name="part_text' + counter + '"></textarea></div>';
            document.getElementById("input_block").insertAdjacentHTML("beforeend", first);
            var myVarInput = document.getElementById('counter');
            myVarInput.value = counter;
            counter++;
        };
        const button = document.querySelector('#partADD');
        button.addEventListener('click', function1);
    </script>
</body>
</html>