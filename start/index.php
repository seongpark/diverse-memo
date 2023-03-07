<?php
    include_once "../db.php";

    //비로그인 차단
     if(isset($_SESSION['userid'])){
    }else{
        echo "<script>location.href='../login';</script>";
    } 

    //중복방지
    $sql = mq("select * from member where id='{$_SESSION['userid']}'");
    while($member = $sql->fetch_array()){
        
    $name = $member['name'];
    $member_check = mq("select * from memo_member where id='$name'");

    $member_check = $member_check->fetch_array();
    if($member_check >= 1){
        echo "<script>location.href='../';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>한시 메모</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <div class="div1 mt-5">
        <h1>한시 메모</h1>
        <p>오늘의 일정을 간단하게 메모하기</p>
        <a type="button" class="btn btn-light btn-lg" href="update.php">시작하기</a>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>
</html>