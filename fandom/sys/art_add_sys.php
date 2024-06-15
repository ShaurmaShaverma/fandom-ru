<?php
    session_start();
    // подключение к базе данных
    $conn = new PDO("mysql:host=localhost; dbname=fandom; charset=utf8",'root',''); 
    // данные о названии статьи и id пользователя-автора
    $art_name = $_POST['art_name'];
    $user_num = $_SESSION['userid'];
    // название фандома, к которому относится данная статья
    $fandom_name = $_POST['fandom_name'];
    $fandom_num = $conn->query("SELECT * FROM fandoms WHERE `fandom_name` = '$fandom_name'");
    $fandom_num = $fandom_num->fetch();
    $fandom_num = $fandom_num[0];
    // внесение данных в таблицу article
    $conn->query("INSERT INTO article (id, article_name, user_num, fandom_num) VALUES (NULL, '$art_name', '$user_num', '$fandom_num')");
    $art_id = $conn->query("SELECT * FROM article where `article_name` = '$art_name'");
    $art_id = $art_id->fetch();
    // счетчик дла правильной работы цикла for, считает сколько раз пользователь добавлял новые поля инпут на страницу с добавлением новой статьи
    $counter = $_POST['counter'];
    // текст и заголовок самого первого раздела
    $p_name = $_POST['part_name0'];
    $p_text = $_POST['part_text0'];
    // внесение текста и заголовков разделов в большую переменную с разделительным знаком | через цикл for
    for ($i = 1; $i < $counter+1; $i++) {
        $p_name_per = "part_name".$i;
        $$p_name_per = $_POST['part_name'.$i];
        $p_name = $p_name."|".$$p_name_per;
        $p_text_per = "part_text".$i;
        $$p_text_per = $_POST['part_text'.$i];
        $p_text = $p_text."|".$$p_text_per;
    };
    // разбитие большой переменной на массив
    $p_name_mass = explode("|", $p_name);
    $p_text_mass = explode("|", $p_text);
    // занесение данных в базу данных через цикл for
    for ($i = 0; $i < $counter+1; $i++) {
        $p_name_vvod = $p_name_mass[$i];
        $p_text_vvod = $p_text_mass[$i];
        $conn->query("INSERT INTO article_part (id, part_name, part_text, article_num) VALUES (NULL, '$p_name_vvod', '$p_text_vvod', '$art_id[0]')");
    };
    // данные из карточки
    $card_img = $_POST['card_img'];
    $char1 = $_POST['char1'];
    $char2 = $_POST['char2'];
    $char3 = $_POST['char3'];
    // занесение этих данных в базу данных
    $conn->query("INSERT INTO article_card (id, char1, char2, char3, img_link, article_num) VALUES (NULL, '$char1', '$char2', '$char3', '$card_img', '$art_id[0]')");
    unset($arrayname);
    // перенос обратно на страницу с инпутами для добавления статьи
    header('Location: ../articleADD.php');
?>