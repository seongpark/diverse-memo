<?php   

    ini_set('display_errors', 0);

    include "../db.php"; 
	include "password.php";
?>
<?php
	if(isset($_SESSION['userid'])){
        echo "<script>alert('이미 로그인중입니다.'); history.back();</script>";}else{}
	?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
    <title>Diverse 계정으로 로그인</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="common.css"/>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
        crossorigin="anonymous">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"/>
    <link
        rel="stylesheet"
        type="text/css"
        href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.min.css">
    <style>
        @media only screen and (max-width: 500px) {
            .g-recaptcha {
                transform: scale(0.77);
                transform-origin: 0 0;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-body">
                <center>
                    <h2 >

                        <b>Diverse 계정으로 로그인</b>

                    </h2>

                </center>
                <form method="post">
                    <div class="mb-3 mt-3">
                        <label class="form-label">이메일</label>
                        <input
                            type="email"
                            name="userid"
                            class="form"
                            placeholder="example@example.com">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">비밀번호</label>
                        <input type="password" name="userpw" class="form">
                    </div>
                    <div
                        class="g-recaptcha mb-4"
                        data-sitekey="6Lea36cjAAAAALeUvohVXOy-N3J6Koks7ho_JTNA"
                        data-callback="recaptcha"
                        style=""></div>
                    <div class="d-grid gap-2 mb-4">
                        <button
                            class="btn btn-dark btn-lg"
                            type="submit"
                            onclick='return check_recaptcha();'>로그인</button>
                    </div>
                    <center>
                        <a href="https://diverse.today/login/member/member_fir.php" style="margin-bottom:0;">회원가입</a>
                    </center>
                </form>
            </div>
        </div>
    </div>
<?php 
    if($_POST["userid"] == "") {
        
    }else {
    if($_POST["userid"] == "" || $_POST["userpw"] == ""){
		echo "<script>alert('로그인 실패 | 아이디 혹은 비밀번호가 입력되지 않았습니다.');</script>";
	}else{

	$password = $_POST['userpw'];

	$sql = mq("select * from member where id='".$_POST['userid']."'");
	$member = $sql->fetch_array();
	$hash_pw = $member['pw'];

	if(password_verify($password, $hash_pw)) 
	{
		$_SESSION['userid'] = $member["id"];
		$_SESSION['userpw'] = $member["pw"];

		echo "<script>location.href='../';</script>";
	}else{
		echo "<script>alert('로그인 실패 | 아이디 혹은 비밀번호가 정확하지 않습니다.');</script>";
    }
}
    }
    ?>
    <script>
        function check_recaptcha() {
            var v = grecaptcha.getResponse();
            if (v.length == 0) {
                captcha();
                return false;
            } else {
                location.reload();
                return true;
            }
        }
    </script>
    <script
        src="https://www.google.com/recaptcha/api.js"
        async="async"
        defer="defer"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
   

        Toastify({
            text: "Diverse 메모에서 로그인을 요청했습니다.",
            duration: 3000,
            newWindow: true,
            close: false,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, #1C1C1C, #2E2E2E)"
            },
            onClick: function () {} // Callback after click
        }).showToast();

        function captcha() {
            Toastify({
            text: '"로봇이 아닙니다."를 체크해주세요.',
            duration: 3000,
            newWindow: true,
            close: false,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, #FFBF00, #FF8000)"
            },
            onClick: function () {} // Callback after click
        }).showToast();
        }

    </script>
    
</body>
</html>