<?php
    include_once "../db.php";

    $sql = mq("select * from member where id='{$_SESSION['userid']}'");
    while($member = $sql->fetch_array()){

    if(isset($_SESSION['userid'])){
        
        $name = $member['name'];

        $sql2 = "CREATE TABLE $name(idx INT AUTO_INCREMENT,title TEXT, memo TEXT,dat DATE, PRIMARY KEY (`idx`)) ";

        if (mysqli_query($db,$sql2)) {
            echo "<script>alert('한시 메모 사용 설정이 완료되었습니다.');</script>";

            $title = "훌륭한 웹메모 한시 메모!";
            $content = "훌륭한 웹메모인 한시 메모로 여러분의 삶이 더 편리하지길 응원합니다!";
            $date = date("Y-m-d");
            $sql5 = mq("insert into $name (title,memo,dat) values('".$title."','".$content."','".$date."')");

            $sql3 = mq("insert into memo_member (id) values('".$name."')");
            echo "<script>location.href='../';</script>";
        }   
    }else{
        echo "<script>location.href='../login';</script>";
    } 

}
?>