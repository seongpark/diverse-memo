<?php 
    include "db.php";

    if(isset($_SESSION['userid'])){
    }else{
        echo "<script>location.href='login';</script>";
    } 

    $sql = mq("select * from member where id='{$_SESSION['userid']}'");
    while($member = $sql->fetch_array()){

    $name = $member['name'];

    $member_check = mq("select * from memo_member where id='$name'");
    $member_check = $member_check->fetch_array();
    if($member_check >= 1){
       
    }else {
        echo "<script>location.href='start';</script>";
    }

?>
<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Diverse 메모</title>
        <meta name="description" content="간단하고 빠른 메모장 사이트!">
        <link rel="stylesheet" href="style.css?ver=2">
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
            crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>

        <nav class="navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Diverse 메모</a>

                <form class="d-flex" role="search">

        <button class="btn btn-link" type="submit">
            <a href="logout.php"><?php echo $member['name'];?></a>
        </button>
      </form>
            </div>
        </nav>
        <div style="height:1px; background-color: rgb(0,0,0,0.1);"></div>
        <div class="container">
            <form method="get" action="http://www.google.co.kr/search" target="_blank">
                <center>
                    <form method="get" action="http://www.google.co.kr/search" target="_blank">
                        <input
                            type="text"
                            name="q"
                            size="25"
                            maxlength="255"
                            class="search-form mt-5 mb-5"
                            placeholder="Google 검색"/>
                    </form>
                </center>
            </form>

            <div class="row row-cols-1 row-cols-md-5 g-4" data-masonry='{"percentPosition": true }'>
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form action="" method="post">
                                <input
                                    type="text"
                                    class="card-form-title" 
                                    name="title"
                                    placeholder="여기를 눌러 제목 입력...">
                                <div style="height:4px;"></div>
                                <textarea
                                    name="content"
                                    id=""
                                    cols="30"
                                    rows="10"
                                    class="card-form"
                                    placeholder="여기를 눌러 내용 입력..."></textarea>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-dark" type="submit">확인</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                    $sql4 = mq("select * from {$member['name']} order by idx desc");
                    while($memo = $sql4->fetch_array()){
                ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $memo['title']; ?></h5>
                            <div style="height:4px;"></div>
                            <?php echo nl2br($memo['memo']);?>
                            <p class="card-text">
                                <small class="text-muted"><?php echo $memo['dat'];?></small>
                            </p>
                            <div class="d-flex flex-row-reverse">
                                <div class="p-2"><a href="delete.php?idx=<?php echo $memo['idx'];?>"><i class="fa-regular fa-trash-can"></i></a></div>
                                <div class="p-2"><a href="edit.php?idx=<?php echo $memo['idx'];?>"><i class="fa-regular fa-pen-to-square"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

        

    <?php 
            if (@$_POST['title'] == "") {
            
            }else {
                $title = $_POST['title'];
                $content = $_POST['content'];
                $date = date("Y-m-d");

                $sql5 = mq("insert into $name (title,memo,dat) values('".$title."','".$content."','".$date."')");
                echo "<script>window.location.replace('index.php');</script>";
            }
        ?>
        <div class="mt-5"></div>
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
            crossorigin="anonymous"></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
            integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD"
            crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>

    </body>
</html>
<?php } ?>