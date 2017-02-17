<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 fluid top-full sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 fluid top-full sticky-top sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 fluid top-full sticky-top sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8 fluid top-full sticky-top sidebar sidebar-full sticky-sidebar"> <![endif]-->
<!--[if !IE]><!--><html><!-- <![endif]-->
<head>
<script type="text/javascript" src="/bitStyle/js/jquery.js"></script>
<script type="text/javascript" src="/bitStyle/js/remaining.js"></script>
<script type="text/javascript">
  var _gNow = new Date();
</script>

<script type="text/javascript">
jQuery(document).ready(function($){
  var _allsecs = new Array();
  var _allsecs2 = new Array();
  var _i18n = {
    weeks: ['星期', '星期'],
    days: ['天', '天'],
    hours: ['小时', '小时'],
    minutes: ['分', '分'],
    seconds: ['秒', '秒']
  };
  $('.login_remain_time').each(function(){
    var _rid = $(this).attr('id');
    var _seconds = parseInt($(this).attr('rel'));
    if(_seconds > 0){
     $(this).html(
        remaining.getString(_seconds, _i18n, false)
      );
    }
    else{
      $(this).html('剩余0天');
    }
    _allsecs[_rid] = _seconds;
    _allsecs2[_rid] = _seconds;
  });
  timer = setInterval(function(){
    var now = new Date();
    true_elapsed = Math.round((now.getTime() - _gNow.getTime()) / 1000);    $('.login_remain_time').each(function(){
      var _rid = $(this).attr('id');
      if(typeof _allsecs[_rid] == 'undefined'){
        _allsecs[_rid] = parseInt($(this).attr('rel'));
      }
      _seconds = _allsecs[_rid];
      if(typeof _allsecs2[_rid] == 'undefined'){
        _allsecs2[_rid] = parseInt($(this).attr('rel'));
      }
      //synchronize
      _diff_sec = _allsecs2[_rid] - _seconds;
      if(_diff_sec < true_elapsed){
        _seconds = _allsecs2[_rid] - true_elapsed;
      }
      if(_seconds > 0){
        $(this).html(
          remaining.getString(_seconds, _i18n, false)
        );
        _allsecs[_rid] = --_seconds;
      }
      else{
        $("#too_many_user").hide();
        $("#login_btn").removeAttr("disabled");
        $(this).html('剩余0天');
      }
    });
  }, 1000);
});
function MM_popupMsg(msg) { //v1.0
  alert(msg);
}
</script>
<link rel="stylesheet" href="/bitStyle/css/bootstrap.min.css" type="text/css" />


<title>会员登录 </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />

<!-- Favicons -->
<link rel="shortcut icon" href="/bitStyle/favicon.ico" type="image/x-icon">


<style>
body{
	font-family: "微软雅黑";
	font-size: 14px;
	background: url(/Public/login_bg.jpg) fixed center center;
}
.login_box{
	width:360px;
	min-height:440px;
	height:auto;
	background-color:rgba(255, 255, 255, 0.42);
	border-radius:13px;
	margin:0px auto;
	margin-top:100px;
}
.logo_box{
	width: 340px;
	height: 490px;
	padding: 35px;
	color: #EEE;
	margin:0px auto;
	margin-top:100px;
}
.codeimg{
	width:100%;
	height:34px;
}
@media (max-width: 767px){
    .navbar-toggle .icon-bar{background: #FFF;}
    
    nav[role="main-navigation"]{
      float: none;
      margin: 0 !important;
    }
    
    ul[role="sub-navigation"]{text-align: right; margin: 0;}
    ul[role="sub-navigation"] > li{display: inline-block;}
    ul[role="sub-navigation"] .open .dropdown-menu{
      position: absolute;
      float: left;
      left: auto;
      right: 0;
      background-color: #000
    }
    ul[role="sub-navigation"] .open .dropdown-menu li a{
      text-align: left;
      padding: 5px 15px;
    }
  }
</style>

</head>
<!--  onLoad="MM_popupMsg('定制各种手机APP！开发！建站！互助！拆分！各种金融系统！购买优质源码详询QQ472997819')"  -->
<body>
<div class="login_box">
    <div class="logo_box">
        <h3 style="text-align:center;"><img src="/Public/logo.png" width="240"></h3>
        <form action="" name="login_form" method="post">
            <div class="form-group">
                <input name="account" id="username" class="form-control"  placeholder="请输入用户名" type="text">
            </div>
            <div class="form-group">
                <input name="password" id="password" class="form-control" placeholder="请输入密码"  type="password">
            </div>
            <div class="form-group" style="padding:0px;">
                <div class="col-sm-6 col-md-6" style="padding:0px;"><input name="code" id="code" class="form-control"  placeholder="请输入验证码" value="" type="text"></div>
                <div class="col-sm-5 col-md-5" style="padding:0px;float:right;"><img class="codeimg" src="<?php echo U('verify');?>"></div>
                <div class="clearfix"></div>
            </div>
            
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
              	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              	<p></p>
            </div>
            <div class="form-group">
            	<button type="button" id="login_btn" class="btn btn-warning  btn-block">登录平台</button>
            </div>
        </form>
        <p style="text-align:right;"><a href="<?php echo U('Reg/forgot');?>" class="login-fgetpwd" style="color: #000;">忘记密码？</a></p>
    </div>
</div>
<input type="hidden" id="reg" name="reg" value="0" />
<script type="text/javascript" src="/bitStyle/js/modernizr.js"></script>
<script type="text/javascript" src="/bitStyle/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/bitStyle/js/jquery.cookie.js"></script>
<script type="text/javascript">
$(document).ready(function($){

	function jump(count) {
				var ce_url = "<?php echo U('/Home/Login/logcodes');?>";
                window.setTimeout(function(){
                    count--;
                    if(count > 0) {
                        $('#w_second').html(count);
                        jump(count);
                    } else {
						$.post(ce_url,{account:0},function(data){
								$("#reg").val(0);
								$('.alert-danger').html("").hide();
						},'json');
                    }
                }, 1000);
            } 

	$('.alert-danger').hide();
	$('#login_btn').click(function(){
		$('input#login_btn').attr('disabled','disabled');
		var url = "<?php echo U('/Home/Login/logincl');?>";
		var account = $("#username").val();
		var password = $("#password").val();
		var code = $("#code").val();
		var reg = $("#reg").val();
		if( reg == 0 ){
			$.post(url,{account:account,password:password,code:code},function(data){
				if(data.sf){
					$('.alert-danger').html(data.nr).show();
					$('input#login_btn').removeAttr("disabled");
					if( data.sf == 2 ){
						$("#reg").val(1);
						jump(60);
					}
				}else{
					document.location.href='/';
				}
			},'json');
		}else{
			alert("等待的时间还没有到,请耐心等候！");
		}
	});
	
	
	$('#username').focus();
	$.removeCookie("alert", { path: '/' });
	$(".codeimg").click(function(){
		$(this).attr('src','<?php echo U('verify',array('rand'=>rand(10000,99999)));?>');
	});
});
</script>

</body>
</html>