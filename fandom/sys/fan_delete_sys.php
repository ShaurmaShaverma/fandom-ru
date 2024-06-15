<?php 
    function cancel() {
        unset($_POST['del_status']);
        header('Location: ../fandom_list.php');
    };
    function accept() {
        $connect = new PDO("mysql:host=localhost; dbname=fandom; charset=utf8",'root',''); 
        unset($_POST['del_status']);
        $fandomID = $_POST['fandomID'];
        $delete = $connect->query("DELETE FROM fandoms WHERE `id` = '$fandomID'");
        header('Location: ../fandom_list.php');
    };
    if ($_POST['del_status']==1) {
        accept();
    } else {
        cancel();
    };
?>