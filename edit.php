<?php 
    include_once "db.php";
    $idx = $_GET['idx'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>한시 메모</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
            crossorigin="anonymous">
    </head>
    <body>
        <div class="container mt-5">
            <?php
                $sql = mq("select * from member where id='{$_SESSION['userid']}'");
                while($member = $sql->fetch_array()){
            
                $name = $member['name'];

                $sql4 = mq("select * from {$member['name']} where idx='$idx'");
                while($memo = $sql4->fetch_array()){

                ?>
                <form method="post">
                <input type="text" name="title" class="form-control" aria-describedby="basic-addon1" value="<?php echo $memo['title']; ?>" placeholder="제목">
                <br>
                <textarea class="form-control" name="content"><?php echo $memo['memo']; ?></textarea>
<br>
                <div class="d-grid gap-2">
  <button class="btn btn-dark" type="submit">확인</button>
</div>
                    </form>
                    <?php } }?>
            </div>
        </div>

        <?php 
            if (@$_POST['title'] == "" ){
                
            }else{
                $title = $_POST['title'];
                $content = $_POST['content'];
                
                $sql3 = mq("insert into $name (title,memo) values('".$title."','".$content."')");

                echo "<script>window.location.replace('index.php');</script>";
            }
        ?>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
    </body>
</html>