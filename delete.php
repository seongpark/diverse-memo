<?php 
    include_once "db.php";
    $idx = $_GET['idx'];

    $sql = mq("select * from member where id='{$_SESSION['userid']}'");
    while($member = $sql->fetch_array()){

    $name = $member['name'];

    }

    
    $sql = mq("delete from $name where idx='$idx';");

    echo "<script>window.location.replace('index.php');</script>";
?>