<?php 
    function cancel() {
        unset($_POST['del_status']);
        header('Location: ../users_list.php');
    };
    function accept() {
        $connect = new PDO("mysql:host=localhost; dbname=fandom; charset=utf8",'root',''); 
        unset($_POST['del_status']);
        $userID = $_POST['userid'];
        $delete = $connect->query("DELETE FROM users WHERE `id` = '$userID'");
        header('Location: ../users_list.php');
    };
    if ($_POST['del_status']==1) {
        accept();
    } else {
        cancel();
    };
?>