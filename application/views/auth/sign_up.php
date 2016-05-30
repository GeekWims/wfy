<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : Stratagem 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20130707

-->
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 위 3개의 메타 태그는 *반드시* head 태그의 처음에 와야합니다; 어떤 다른 콘텐츠들은 반드시 이 태그들 *다음에* 와야 합니다 -->
    <title>Sign Up</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('static/css')?>/bootstrap-social.css">
    <link rel="stylesheet" href="<?php echo base_url('static/css')?>/signin.css">
    <link rel="stylesheet" href="<?php echo base_url('static/css')?>/loading-style.css">


    <script src="<?php echo base_url('static/js')?>/jquery.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script src="<?php echo base_url('static/js')?>/bootstrap.js"></script>

    <!-- IE8 에서 HTML5 요소와 미디어 쿼리를 위한 HTML5 shim 와 Respond.js -->
    <!-- WARNING: Respond.js 는 당신이 file:// 을 통해 페이지를 볼 때는 동작하지 않습니다. -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        #form-notice {
            margin-bottom: 10px;
            border: 1px solid gray;
            padding: 5px 3px 5px 3px;
        }
        #form-notice li {
            padding-left: 5px;
            list-style: none;
        }

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

        label {
            color: gray;
        }

        .row {
        }

        .row:after {
            display: block;
            content: '';
            clear: both;
        }
        .col-md-4 {
            width: 33.33333%;
            float: left;
        }

        .col-md-8 {
            width: 66.66666%;
            float: left;
        }

        .col-md-2 {
            width: 16.66666%;
            float: left;
        }

        .col-md-10 {
            width: 83.33333%;
            float: left;
        }

        #preview_img {
            margin: auto;
        }
    </style>
</head>
<body>
<div class="loading" style="display: none">
    <div>
        <div class="c1"></div>
        <div class="c2"></div>
        <div class="c3"></div>
        <div class="c4"></div>
    </div>
    <span>loading</span>
</div>
<div id="fb-root"></div>
<script src="/wordForYou/static/js/fb-sdk.js"></script>
<div class="form-wrapper" style="box-shadow: 10px 10px 10px #ccc;">
    <div class="form-wrapper">
        <h1>Sign up</h1>
        <div id="error_wrap">
            <?php echo validation_errors()?>
        </div>
        <div id="form-notice" style="">
            <ul>
                <li><span class="fa fa-exclamation-circle "></span>  If not fill nickname, nickname will be 'unknown'</li>
                <li><span class="fa fa-exclamation-circle "></span>  If not upload profile image, image will be set with default image </li>
            </ul>
        </div>
        <?php echo form_open_multipart('auth/signup');?>
        <div class="form-item">
            <label for="email"></label>
            <div class="row">
                <input type="email" name="email" required="required" placeholder="Email Address" value="<?php echo set_value('email')?>">
            </div>
            </div>
            <div class="form-item">
                <label for="password"></label>
                <input type="password" name="password" required="required" placeholder="Password(8~16)">
            </div>
            <div class="form-item">
                <label for="re-password"></label>
                <input type="password" name="re-password" required="required" placeholder="Repeat Password">
            </div>
            <div class="form-item">
                <label for="nickname"></label>
                <input type="text" name="nickname" required="" maxlength="10" placeholder="nickname(0~10)" value="<?php echo set_value('nickname')?>">
            </div>
            <div class="form-item">
                <label for="profile_img">Profile Image ( ~ 100MB)</label>
                <br>
                <div class="row" style="height: 50px;">
                    <div class="col-md-4" style="height: 50px;"><img id="preview_img" src="<?php echo set_value('profile_img', base_url('static/img') . '/unknown.png')?>" width="50px" height="50px;" alt=""></div>
                    <div class="col-md-8">
                        <div class="button-panel" style="margin: 0;padding: 0;">
                            <button type="button" id="btn-chooseImg" class="button" style="background-color: #31516A;">Choose image</button>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="profile_img" name="profile_img" value="<?php echo set_value('profile_img', base_url('static/img') . '/unknown.png')?>">
<!--                <input type="file" name="profile_img" required="" placeholder="profile_img" value="--><?php //echo set_value('profile_img')?><!--">-->
            </div>
            <div class="button-panel">
                <button type="submit" class="button btn-social btn-lg" style="background-color: #17C317">
                    <div class="fa fa-pencil"></div>
                    Sign up
                </button>
            </div>
        <?php echo form_close() ?>
        <?php echo form_open_multipart('upload/tmp_upload', array('id' => 'ajaxImgForm', 'style' => 'display:none;'));?>
            <?php echo form_upload(array('name' => 'userfile', 'id' => 'real_upload_input')) ?>
        <?php echo form_close() ?>
        <div class="form-footer">
            <p><?php echo anchor('main', 'To Home', '')?></p>
            <p><?php echo anchor('auth/signinpage', 'To sign in', '')?></p>
        </div>
    </div>
    <!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
    <script src="/wordForYou/static/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function ($) {
            $('.loading').hide();
            $('#ajaxImgForm').ajaxForm({
                success: function (responseText, statusText, xhr, $form) {
                    $('#preview_img').attr('src', responseText);
                    $('#profile_img').attr('value', responseText);
                },
                error: function( jqXhr ) {
                    if( jqXhr.status == 400 ) { //Validation error or other reason for Bad Request 400
                        var json = $.parseJSON( jqXhr.responseText );
                        console.log(json);
                        $('#error_wrap').append(json['message']);
                    }
                }
            });
            $(document).ajaxStart(function()
            {
                $('.loading').show();
            });
            $(document).ajaxStop(function()
            {
                $('.loading').hide();
            });
        });
        $('#real_upload_input').change(function() {
            $('#ajaxImgForm').submit();
        });

        $('#btn-chooseImg').click(function() {
            $('#real_upload_input').click();
        });
        $(document).ready(function() {
        });
    </script>
</body>
</html>