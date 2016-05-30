<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 위 3개의 메타 태그는 *반드시* head 태그의 처음에 와야합니다; 어떤 다른 콘텐츠들은 반드시 이 태그들 *다음에* 와야 합니다 -->
    <title>Sign In</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/wordForYou/static/css/bootstrap-social.css">
    <link rel="stylesheet" href="/wordForYou/static/css/signin.css">

    <script src="/wordForYou/static/js/jquery.js"></script>
    <script src="/wordForYou/static/js/bootstrap.js"></script>

    <!-- IE8 에서 HTML5 요소와 미디어 쿼리를 위한 HTML5 shim 와 Respond.js -->
    <!-- WARNING: Respond.js 는 당신이 file:// 을 통해 페이지를 볼 때는 동작하지 않습니다. -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>

        #error_wrap {
            margin-bottom: 15px;
        }

        #error_wrap * {
            color: red;
            font-size: 16px;
        }

        /*#error_wrap {*/
        /*counter-reset: my-badass-counter;*/
        /*}*/
        #error_wrap p {
            margin-bottom: 5px;
        }

    </style>
</head>
<body>
<div style="" id="fb-root"></div>
<div class="form-wrapper" style="box-shadow: 10px 10px 10px #ccc;">
    <div class="form-wrapper">
        <h1><a style="text-decoration: none; color:black;" href="/wordForYou/main">Word For You</a></h1>
        <div id="error_wrap">
            <?php echo validation_errors()?>
            <?php echo isset($this->error) ? "<p>The username or password you entered is incorrect, please try again.</p>": ""?>
        </div>
        <form action="<? echo ROOT_URL?>/auth/signin" method="post" accept-charset="utf-8">
        <div class="form-item">
                <label for="email"></label>
                <input type="email" name="email" required="required" placeholder="Email Address">
            </div>
            <div class="form-item">
                <label for="password"></label>
                <input type="password" name="password" required="required" placeholder="Password">
            </div>
            <div class="button-panel">
                <button type="submit" class="button btn-social btn-lg">
                    <div class="fa fa-check"></div>
                    Sign in
                </button>
                <button type="button" class="button btn-social btn-lg" style="background-color: #3b5998;margin-top: 10px;" onclick="fb_login();">
                    <div class="fa fa-facebook"></div>
                    Sign in
                </button>
            </div>
        </form>
        <div class="form-footer">
            <p><a href="/wordForYou/auth/signuppage">Create an account</a></p>

            <p><a href="#">Forgot password?</a></p>
        </div>
    </div>
    <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
    <script src="/wordForYou/static/js/bootstrap.min.js"></script>
	<script src="/wordForYou/static/js/fb-sdk.js"></script>
</body>
</html>