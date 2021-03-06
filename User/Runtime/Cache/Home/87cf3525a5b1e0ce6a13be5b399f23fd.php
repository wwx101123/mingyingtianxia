<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if lt IE 7]>
  <html class="ie lt-ie9 lt-ie8 lt-ie7 fluid top-full sidebar sidebar-full sticky-sidebar">
  <![endif]-->
  <!--[if IE 7]>
    <html class="ie lt-ie9 lt-ie8 fluid top-full sticky-top sidebar sidebar-full sticky-sidebar">
    <![endif]-->
    <!--[if IE 8]>
      <html class="ie lt-ie9 fluid top-full sticky-top sidebar sidebar-full sticky-sidebar">
      <![endif]-->
      <!--[if gt IE 8]>
        <html class="ie gt-ie8 fluid top-full sticky-top sidebar sidebar-full sticky-sidebar">
        <![endif]-->
        <!--[if !IE]><!-->
          <html>
            <!-- <![endif]-->

            <head>
              <script type="text/javascript" src="/bitStyle/js/jquery.js">
              </script>
              <script type="text/javascript" src="/bitStyle/js/bootstrap.min.js">
              </script>
              <script type="text/javascript" src="/bitStyle/js/modernizr.js">
              </script>
              <script type="text/javascript" src="/bitStyle/js/selectivizr.js">
              </script>
              <script type="text/javascript" src="/bitStyle//js/jquery.cookie.js">
              </script>
              <script type="text/javascript" src="/bitStyle/js/scripts.js">
              </script>
              <script type="text/javascript" src="/bitStyle/js/remaining.js">
              </script>
              <script type="text/javascript" src="/bitStyle/js/fn_number_format.js">
              </script>
              <script type="text/javascript" src="/bitStyle/js/9acba5c0d35076a1ccd574dfc21b8b2b.js">
              </script>
              <script type="text/javascript">
                var _gNow = new Date();

                setInterval(function() {
                  $.ajax({
                    url: '?aj=1&type=check_login',
                    data: {
                      'uid': 82662186
                    },
                    dataType: 'json',
                    error: function() {},
                    success: function(data) {
                      if (data.loggedout == '1') {
                        window.location.href = "/bitStyle/zh-CN/";
                      }
                    }
                  })
                },
                300000); //5min

              </script>
              <script type="text/javascript">
                jQuery(document).ready(function($) {
                  // prompt user a box to pd after completed a gd
                  if (0) {
                    // $('#prompt-repd').modal('show');
                  }
                  $('#prompt-repd').on('click', '#click-pd',
                  function(e) {
                    e.preventDefault();
                    $("#pdBtn").trigger("click");
                    $('#prompt-repd').modal('hide');
                  });

                  $("#load_expected_bonus").click(function() {
                    $("#expected_bonus_list").html('<img src="/bitStyle/images/loader2.gif"/>');
                    $("#expected_bonus_list").load("?uid=" + 82662186);
                  });
                });
              </script>
              <script type="text/javascript">
                jQuery(document).ready(function($) {
                 // alert($(window).width());
                  if($(window).width()<768){
                 $('#qdBtn').css('margin-top','15px');

                  }
                  var gdBtn = $('#gdBtn');
                  var pdBtn = $('#pdBtn');
                  var qdBtn = $('#qdBtn');


                  pdBtn.click(function() {

                    $(this).toggleClass('active');
                    gdBtn.removeClass('active');

                    qdBtn.removeClass('active');
                    $('#pdWrap').stop(true, false).slideToggle('fast');
                    $('#gdWrap').stop(true, false).slideUp('fast').removeClass('open');
                    return false;
                    });


                  // if user status is freeze or just unblock and not yet do the maintain
                  gdBtn.click(function() {
                    $(this).toggleClass('active');
                    pdBtn.removeClass('active');
                    gdBtn.removeClass('active');

                    $('#gdWrap').stop(true, false).slideToggle('fast');
                    $('#qdWrap').stop(true, false).slideUp('fast').removeClass('open');
                    return false;
                    });

                   qdBtn.click(function() {
                    $(this).toggleClass('active');
                    gdBtn.removeClass('active');


                    pdBtn.removeClass('active');

                    $('#qdWrap').stop(true, false).slideToggle('fast');
                    $('#pdWrap').stop(true, false).slideUp('fast').removeClass('open');

                    return false;
                    });




                  // Tooltips
                  $('.tip').tooltip({
                    placement: 'top'
                  });
                  $('.tipr').tooltip({
                    placement: 'right'
                  });
                  $('.tipb').tooltip({
                    placement: 'bottom'
                  });
                  $('.tipl').tooltip({
                    placement: 'left'
                  });

                  $("a[href='#top']").click(function() {
                    $("html, body").animate({
                      scrollTop: 0
                    },
                    "slow");
                    return false;
                  });

                  var _server_time = new Date(),
        _server_time2 = new Date(),
        _local_time = new Date(),
        _local_time2 = new Date();
                  _server_time2 = new Date(),
                  _local_time = new Date(),
                  _local_time2 = new Date();

                  _timer = setInterval(function() {
                    var now = new Date();
                    true_elapsed = Math.round((now.getTime() - _gNow.getTime()) / 1000); //synchronize & increment 1 second
                    second = _local_time.getTime() + 1000;
                    elapsed = Math.round((second - _local_time2.getTime()) / 1000);
                    if (elapsed < true_elapsed) {
                      diff = true_elapsed - elapsed;
                      second += (diff * 1000);
                    }
                    _local_time.setTime(second);
                    second = _server_time.getTime() + 1000;
                    elapsed = Math.round((second - _server_time2.getTime()) / 1000);
                    if (elapsed < true_elapsed) {
                      diff = true_elapsed - elapsed;
                      second += (diff * 1000);
                    }
                    _server_time.setTime(second);

                    //update server time
                    date_text = padNumber(_server_time.getHours()) + ':' + padNumber(_server_time.getMinutes()) + ':' + padNumber(_server_time.getSeconds());
                    date_text += ' ' + _server_time.getDate() + '/' + (_server_time.getMonth() + 1) + '/' + _server_time.getFullYear();
                    $('#server_time_text').html(date_text);
                    //update local time
                    date_text = padNumber(_local_time.getHours()) + ':' + padNumber(_local_time.getMinutes()) + ':' + padNumber(_local_time.getSeconds());
                    date_text += ' ' + _local_time.getDate() + '/' + (_local_time.getMonth() + 1) + '/' + _local_time.getFullYear();
                    $('#local_time_text').html(date_text);
                  },
                  1000);

                  /**
    * @param number An integer
    * @return Integer padded with a 0 if necessary
    */
                  function padNumber(number) {
                    return (number >= 0 && number < 10) ? '0' + number: number;
                  }
                });
              </script>
              <script type="text/javascript">
                jQuery(document).ready(function($) {
                  var _allsecs = new Array();
                  var _allsecs2 = new Array();
                  var _i18n = {
                    weeks: ['星期', '星期'],
                    days: ['天', '天'],
                    hours: ['小时', '小时'],
                    minutes: ['分', '分'],
                    seconds: ['秒', '秒']
                  };
                  $('.maintain_remain_time').each(function() {
                    var _rid = $(this).attr('id');
                    var _seconds = parseInt($(this).attr('rel'));
                    if (_seconds > 0) {
                      $(this).html(remaining.getString(_seconds, _i18n, false));
                    } else {
                      $(this).html('剩余0天');
                    }
                    _allsecs[_rid] = _seconds;
                    _allsecs2[_rid] = _seconds;
                  });
                  timer = setInterval(function() {
                    var now = new Date();
                    true_elapsed = Math.round((now.getTime() - _gNow.getTime()) / 1000);
                    $('.maintain_remain_time').each(function() {
                      var _rid = $(this).attr('id');
                      if (typeof _allsecs[_rid] == 'undefined') {
                        _allsecs[_rid] = parseInt($(this).attr('rel'));
                      }
                      _seconds = _allsecs[_rid];
                      if (typeof _allsecs2[_rid] == 'undefined') {
                        _allsecs2[_rid] = parseInt($(this).attr('rel'));
                      }
                      //synchronize
                      _diff_sec = _allsecs2[_rid] - _seconds;
                      if (_diff_sec < true_elapsed) {
                        _seconds = _allsecs2[_rid] - true_elapsed;
                      }
                      if (_seconds > 0) {
                        $(this).html(remaining.getString(_seconds, _i18n, false));
                        _allsecs[_rid] = --_seconds;
                      } else {
                        $("#too_many_user").hide();
                        $("#login_btn").removeAttr("disabled");
                        $(this).html('剩余0天');
                      }
                    });
                  },
                  1000);
                });
              </script>
              <script type="text/javascript">
              </script>
              <script type="text/javascript">
                jQuery(document).ready(function($) {
                  var pin_message = "此次执行需要{quantity}PIN。";
                  $('#maintain_back_btn, #pd_back_btn, #gd_back_btn').click(function() {
                    $('input[name=__req]').val('start'); //back to starting step
                  });

                  if ("0") {
                    $("#pd_pin").text(pin_message.replace("{quantity}", parseInt(0 / 0.5)));
                  } else {
                    $("#pd_pin").text(pin_message.replace("{quantity}", 1));
                  }

                  $("input[name=from_wallet]").change(function() {
                    if ($(this).val() == 'cwallet') {
                      $("#minimum_amount").text("BTC0.50000000");
                    } else {
                      $("#minimum_amount").text("BTC0.50000000");
                    }
                  });

                  $("#show_pd_amount").html(format_monetary_value(0));
                  $("#show_gd_amount").html(format_monetary_value(0));

                  $("#pd_amount").keyup(function() {
                    $("#show_pd_amount").html(format_monetary_value($(this).val()));
                    if ($(this).val() > 0.5 && $(this).val() % 0.5 == 0) {
                      $("#pd_pin").text(pin_message.replace("{quantity}", $(this).val() / 0.5));
                    } else {
                      $("#pd_pin").text(pin_message.replace("{quantity}", 1));
                    }
                  });
                  $("#gd_amount").keyup(function() {
                    $("#show_gd_amount").html(format_monetary_value($(this).val()));
                  });

                  if (false) {
                    $("#recalc-ep-message").text("您的额外回酬已计算。请稍候片刻再尝试。");
                    $("#recalc-ep-button").attr("disabled", "disabled");
                    setTimeout(function() {
                      $("#recalc-ep-button").removeAttr("disabled");
                      $("#recalc-ep-message").text("");
                    },
                    0);
                  }

                  $("#recalc-ep-button").on("click",
                  function(e) {
                    e.preventDefault();
                    $("#recalc-ep-message").text("您的额外回酬已计算成功。如果想再计算，请稍候片刻再尝试。");
                    $(this).attr("disabled", "disabled");
                    $.ajax({
                      url: '?aj=1&type=recalc_user_ep',
                      data: {
                        'uid': 82662186
                      },
                      type: 'post',
                      dataType: 'json',
                      error: function(data) {
                        console.log(data);
                      },
                      success: function(data) {
                        if (data.percent > 0) {
                          $("#current_ep").html(data.percent);
                        }
                      }
                    });


                    setTimeout(function() {
                      $("#recalc-ep-button").removeAttr("disabled");
                      $("#recalc-ep-message").text("");
                    },
                    1800000);
                  });
                });
              </script>
              <script>
              </script>
              <link rel="stylesheet" href="/bitStyle/css/bootstrap.min.css" type="text/css"
              />
              <link rel="stylesheet" href="/bitStyle/css/font-awesome.min.css" type="text/css"
              />
              <link rel="stylesheet" href="/bitStyle/css/main.v001.css" type="text/css"
              />
              <link rel="stylesheet" href="/bitStyle/css/zh-CN.css" type="text/css"
              />
              <link rel="stylesheet" href="/bitStyle/css/fileupload.css" type="text/css"
              />
              <link rel="stylesheet" href="/bitStyle/css/style.css" type="text/css"
              />

              <style>

              body{
                font-size: 14px;
              }
              </style>
              <title>
                2016人均财富系统首页
              </title>
              <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
              <meta name="apple-mobile-web-app-capable" content="yes">
              <meta name="apple-mobile-web-app-status-bar-style" content="black">
              <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE"
              />
              <!-- Favicons -->
              <link rel="shortcut icon" href="/bitStyle/favicon.ico" type="image/x-icon">

            </head>

            <body class="zh-CN " id="">

              <header class="header" id="top" role="header">
	<div class="head_top">
    	<div class="top_content">
            <div class="left_text">欢迎来到2016人均财富！专业理财值得信赖。</div>
            <div class="right_text"><a href="<?php echo U('Index/reg');?>">注册会员</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void(0);"   id="opengg" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">查看公告</a>&nbsp;&nbsp;|&nbsp;&nbsp;<!--<a href="javascript:void(0);">关于我们</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">帮助中心</a>&nbsp;&nbsp;|&nbsp;&nbsp;--><a href="<?php echo U('Index/messageInbox');?>">问题提交</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo U('Reg/logout');?>">退出平台</a></div>
    	</div>
    </div>
    <div class="head_content">
    	<div class="logo"> <a href="<?php echo U('Index/index');?>" class="navbar-brand">
          <img src="/bitStyle/images/logo_white.png" alt="" >
        </a></div>
        <div class="tglj">
        	 <label class="control-label" style="padding-top:5px; color:">推广链接:</label>
             <input id="copy-num" class="form-control" type="text" value="<?php echo ($tgurl); ?>" style="max-width:300px;display:inline-block;color: #999;">
             <button onclick="jsCopy()" type="button" class="btn btn-sm">复制</button>
        </div>
    </div>
    <div class="head_nav">
    	<div class="head_navbar">
        	<ul id="MenuUl">
            	<li class="MenuItem"><a href="/" style="color:#fff"><span class="glyphicon glyphicon-home"></span><span class="hidden-xs">网站首页</span></a></li>
                <li class="MenuItem"><a href="<?php echo U('Info/index');?>" style="color:#fff"><span class="glyphicon glyphicon-pencil"></span><span class="hidden-xs">管理档案</span></a></li>
                <li class="MenuItem" style="z-index:9999;"><a href="#" class="dropdown-toggle" style="color:#fff"><span class="glyphicon glyphicon-th-list"></span><span class="hidden-xs">帐户管理</span> <span class="caret"></span></a>

            		<ul id="MenuItemChild">

					  <li class="MenuItemChildItem" ><a href="<?php echo U('Info/pin');?>">排单币管理</a></li>
					  <li class="MenuItemChildItem" ><a href="<?php echo U('Info/pintopin');?>">排单币转账</a></li>
                      <li class="MenuItemChildItem" ><a href="<?php echo U('Info/pai');?>">激活码管理</a></li>
                      <li class="MenuItemChildItem" ><a href="<?php echo U('Info/paitopin');?>">激活码转账</a></li>
                      <li class="MenuItemChildItem" ><a href="<?php echo U('Myuser/index');?>">我的团队</a></li>
                      <li class="MenuItemChildItem" ><a href="<?php echo U('Myuser/xzzh');?>">提供与得到记录</a></li>
                      </ul>
                   </li>
            	</li>
                <li class="MenuItem"><a href="#" class="dropdown-toggle" style="color:#fff"><span class="glyphicon glyphicon-list-alt"></span><span class="hidden-xs">交易记录</span> <span class="caret"></span></a>

            		<ul id="MenuItemChild">
                      <li  class="MenuItemChildItem"><a href="<?php echo U('Info/pdhistory');?>">提供帮助记录</a></li>
                      <li  class="MenuItemChildItem"><a href="<?php echo U('Info/gdhistory');?>">接受帮助记录</a></li>
                      <li  class="MenuItemChildItem"><a href="<?php echo U('Info/rwhistory');?>">提供帮助交易记录</a></li>
                      <li class="MenuItemChildItem" ><a href="<?php echo U('Info/cwhistory');?>">推荐奖钱包记录</a></li>
                      <li  class="MenuItemChildItem"><a href="<?php echo U('Info/nwhistory');?>">互助钱包记录</a></li>
                    </ul>
            	</li>
                <li class="MenuItem"> <a href="<?php echo U('Index/news');?>" style="color:#fff"><span class="glyphicon glyphicon-file"></span><span class="hidden-xs">新闻中心</span><span class="badge"></span></a></li>
                <li class="MenuItem"><a href="#" class=""  style="color:#fff"><span class="glyphicon glyphicon-usd"></span><span class="hidden-xs">我的钱包</span></a>
                    <ul  id="MenuItemChild">
                        <li class="MenuItemChildItem"><a href="javascript:void(0);">静态钱包&nbsp;&nbsp;<strong class="wallet-color"> <?php echo ((isset($log_money) && ($log_money !== ""))?($log_money):0); ?>RMB</strong></a></li>
                        <li class="MenuItemChildItem"><a href="javascript:void(0);">领导奖钱包&nbsp;&nbsp;<strong class="wallet-color"><?php echo ((isset($log_ldx) && ($log_ldx !== ""))?($log_ldx):0); ?>RMB</strong></a></li>
                        <li class="MenuItemChildItem"><a href="javascript:void(0);">推荐奖钱包&nbsp;&nbsp;<strong class="wallet-color"><?php echo ((isset($log_tjx) && ($log_tjx !== ""))?($log_tjx):0); ?>RMB</strong></a></li>
                        <!-- <li class="MenuItemChildItem"><a href="javascript:void(0);">冻结钱包&nbsp;&nbsp;<strong class="wallet-color"><?php echo ($userData["dongjie"]); ?>RMB</strong></a></li> -->

                  	</ul>
               	</li>
                <li class="MenuItem"><a href="javascript:void(0);" class="top-button"" style="color:#fff"><span class="glyphicon glyphicon-user top-button"></span><span class="hidden-xs">我的资料</span></a>
                  <ul   id="MenuItemChild" >
                    <li class="MenuItemChildItem"><a href="javascript:void(0);">编号&nbsp;&nbsp;<span class="count"><?php echo (substr(md5($userData['ue_id']),0,10)); ?> </span></a></li>
                    <li class="MenuItemChildItem"><a href="javascript:void(0);">账号&nbsp;&nbsp;<span class="count"><?php echo ($userData['ue_account']); ?></span></a></li>
                    <li class="MenuItemChildItem"><a href="javascript:void(0);">手机号<span class="count"><?php echo ($userData['ue_phone']); ?></span></a></li>
                    <li class="MenuItemChildItem"><a href="javascript:void(0);">钱包<span class="count"><?php echo ($userData['ue_money']); ?></span></a></li>
                   	</ul>
                </li>
             </ul>
        </div>
    </div>
</header>
<script data-cfhash='f9e31' type="text/javascript">
function jsCopy(){
	var e=document.getElementById("copy-num");//对象是copy-num1
	e.select(); //选择对象
	document.execCommand("Copy"); //执行浏览器复制命令
	alert("复制成功");
}
/* <![CDATA[ */
!
function() {
try {
  var t = "currentScript" in document ? document.currentScript: function() {
	for (var t = document.getElementsByTagName("script"), e = t.length; e--;) if (t[e].getAttribute("data-cfhash")) return t[e]
  } ();
  if (t && t.previousSibling) {
	var e, r, n, i, c = t.previousSibling,
	a = c.getAttribute("data-cfemail");
	if (a) {
	  for (e = "", r = parseInt(a.substr(0, 2), 16), n = 2; a.length - n; n += 2) i = parseInt(a.substr(n, 2), 16) ^ r,
	  e += String.fromCharCode(i);
	  e = document.createTextNode(e),
	  c.parentNode.replaceChild(e, c)
	}
	t.parentNode.removeChild(t);
  }
} catch(u) {}
} ()
/* ]]> */
</script>
<script src="/cssmmm/jquery.countdown.js"></script>
<script>
$(function(){
  var isLook = '<?php echo session('islook'); ?>';
  if(!isLook){
    $("#opengg").click();
  }
});
</script>
<?php if(!session('islook')) session('islook',true); ?>
  <!-- 公告 -->
  <!-- Large modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">站点公告</h4>
      </div>
      <div class="modal-body">
        <?php echo C('gonggao');?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

              <script type="text/javascript">
                $(document).ready(function() {

                  //$(".top-button").click(function (e) {
                  //    e.stopPropagation();
                  //    $(".dropdown-menu").hide();
                  //    $(this).next().show();
                  //});
                  //$(".navbar-collapse").on('click', function(e){
                  //e.stopPropagation();
                  //})
                  //$("body").on('click', function(e){
                  //if ($(".navbar-collapse").hasClass("in")) {
                  //$(".navbar-collapse").collapse('hide');
                  //}
                  //})

                  //$(document).click(function (e) {
                  //    $(".dropdown-menu").hide();
                  //});

                });
              </script>
              <div id="wrapper">
                <div class="blue-bg" style="min-height:1000px;">
<style type="text/css">
<!--
.STYLE1 {color: #FF0000}
.STYLE2 {color: #FF0000; font-size: large; }
-->
header .head_nav_log{
	height: 100px;
}
header .head_nav_log .head_navbar_log{
	width:100%;
}
header .head_nav_log .head_navbar_log .MenuItem_log{
	width: 90px;
}
header .head_nav_log .head_navbar_log .MenuItem_log>a, header .head_nav_log .head_navbar_log .MenuItemChildItem_log>a{
	width: 90px;
}
header .head_nav_log .head_navbar_log .MenuItem_log a.aslog{
	width: 145px;
}
header .head_top_log{
	height: 80px;
}
header .head_top_log .top_content_log{
	width: 100%;
}
header .head_top_log .top_content_log .left_text_log{
	width: 100%;
}
header .head_content_log{
    width: 100%;
    height: 150px;
}
header .head_content_log .tglj_log{
    width: 100%;
}
header .head_top_log .top_content_log .right_text_log{
	width: 100%;
}
</style>


                  <div class="clockWrap">
                    <div class="container clearfix">
                      <div class="pull-left" id="userRank">
                        <span class="glyphicon glyphicon-user">
                        </span>
                        级别 : <?php echo ($userData['levelname']); ?>
                      </div>
                      <!-- <div class="clock-location">
                        <strong class="mr5">
                          服务器时间
                        </strong>
                        <span id="server_time_text">
                           <?php echo date('Y-m-d H:i:s'); ?>
                        </span>
                      </div>
                      <div class="clock-location">
                        <strong class="mr5">
                          您当地时间
                        </strong>
                        <span id="local_time_text">

                        </span>
                      </div> -->
                    </div>
                  </div>
                  <div class="clockWrap">
                    <div class="container clearfix">
                      <div class="pull-left" id="userRank">
                        <div style="text-align:left;">钱包统计：静态余额<b class="red"><?php echo ((isset($log_money) && ($log_money !== ""))?($log_money):0); ?></b>(元) </div>
                        <div>当日盈利：推荐奖[<?php echo ((isset($log_tjx) && ($log_tjx !== ""))?($log_tjx):0); ?>]&nbsp;&nbsp;领导奖[<?php echo ((isset($log_ldx) && ($log_ldx !== ""))?($log_ldx):0); ?>]&nbsp;&nbsp;排单币[<?php echo ((isset($log_code) && ($log_code !== ""))?($log_code):0); ?>]&nbsp;&nbsp;激活码[<?php echo ((isset($log_pai) && ($log_pai !== ""))?($log_pai):0); ?>]</div>
                        <div style="text-align:left;">
                          额度统计：
                          派单额度<b class="red"><?php echo ((isset($pai_zong_edu) && ($pai_zong_edu !== ""))?($pai_zong_edu):0); ?></b>(元)
                          可用额度<b class="red"><?php echo ((isset($pai_keyong_edu) && ($pai_keyong_edu !== ""))?($pai_keyong_edu):0); ?></b>(元)
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="container">
                    <div class="innerContent">
                      <div id="donationWrap">


                        <div class="row">

                          <div class="col-sm-4">
                            <a class="btn btn-block " id="pdBtn">
                              <span class="p-donation">
                                提供帮助
                              </span>
                            </a>
                          </div>
                          <div class="col-sm-4">
                            <a class="btn btn-block " id="gdBtn">
                              <span class="g-donation">
                                得到帮助
                              </span>
                            </a>
                          </div>

                        <!-- <div class="col-sm-4">
                            <a class="btn btn-block " id="qdBtn">
                              <span class="q-donation">
                                抢单大厅
                              </span>
                            </a>
                        </div> -->
                        </div>
                        <div class="row">


                          <div class="col-md-12" id="pdWrap" style=" display:none;">
                            <div class="widget widget-body-white">
                              <form method="post" action="/Home/Index/tgbzcl" name="buy_share_form"
                              class="form-horizontal margin-none" id="provide_help">
                                <div class="widget-head widget-head-blue">
                                  <h4 class="heading">
                                    提供帮助
                                  </h4>
                                </div>
                                <div class="widget-body">
                                  <div class="form-group">
                                    <p style=" color:#FF0000; text-align:center; font-size:14px; " >
                                      申请完成后，请等待系统分配受善需求
                                    </p>
                                    <label class="col-md-3 control-label">
                                      支付方式
                                    </label>
                                    <div class="col-md-9">
                                      <label>
                                        <input type="checkbox" value="1" class="ckbox" name="zffs1" checked="">
                                        银行支付
                                      </label>
                                      <label>
                                        <input type="checkbox" value="1" class="ckbox" name="zffs2" checked="">
                                        支付宝支付
                                      </label>
                                      <label>
                                        <input type="checkbox" value="1" class="ckbox" name="zffs3" checked="">
                                        微信支付
                                      </label>

                                    </div>
                                  </div>
								                <?php if(C('ispdb')): ?><div class="form-group">
                                      <label class="col-md-3 control-label">输入排单币</label>
                                      <div class="col-md-9">
                                          <input type="text"  style="height:32px; width:250px;" placeholder="输入排单币" name="pin" value="<?php echo ((isset($code) && ($code !== ""))?($code):'没有可用排单币，请联系平台客服购买'); ?>" >
                                      </div>
                                  </div><?php endif; ?>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">
                                      提供帮助金额
                                    </label>
                                    <div class="col-md-9">
                                  <?php
 $tgxz = explode(",",C('tgxz')); foreach($tgxz as $k=>$v): ?>
                                  <label><input type="radio" value="<?php echo ($v); ?>" name="amount" required><?php echo ($v); ?></label>
                                 <!-- <input type="text" class="form-control get_amount amount" placeholder="输入<?php echo C('jj01s');?>-<?php echo C('jj01m');?>并且是<?php echo C('jj01');?>的倍数" name="amount" id="amount" autocomplete="off" required > -->
                                 <?php endforeach; ?>

                                      <p class="help-block" id="pdtips">
                                        警告，我已完全了解所有风险。我决定参与2016人均财富。                                      </p>
                                    </div>
                                  </div>
                                </div>
                                <footer class="data-footer innerAll half text-right clearfix">
                                  <!-- <button type="button" class="btn btn-default" data-dismiss="modal">
                                    取消
                                  </button> -->
                                  <!-- <button type="button" class="btn_next btn-warning btn-sm" data-dismiss="modal"
                                  data-toggle="modal" data-target="#myModal2">提供帮助</button>-->
                                  <input name="jhwjjc" id="jhwjjc" type="submit" class="btn_next btn-warning btn-sm btn btn-primary "
                                  value="提供帮助">
                                </footer>
                              </form>
                            </div>
                          </div>


                          <div class="col-md-12" id="gdWrap" style=" display:none;">
                            <div class="widget widget-body-white">
                              <script>
                                $(function(){
                                  var ht = '您最低出售数量 <?php echo C('txthemin');?>RMB - <?php echo C('txthemax');?>RMB';
                                  var ht2 = '输入RMB<?php echo ($txthemin); ?>起,至<?php echo ($txthemax); ?>,且为<?php echo ($txthebeishu); ?>的倍数';
                                  $("input[name='qb']").click(function(){
                                    var val = $(this).val();
                                    if(val=='jsbzcl'){
                                      ht = '您最低出售数量 <?php echo C('txthemin');?>RMB - <?php echo C('txthemax');?>RMB';
                                      ht2 = '输入RMB<?php echo ($txthemin); ?>起,至<?php echo ($txthemax); ?>,且为<?php echo ($txthebeishu); ?>的倍数';
                                    }else if(val=='jsbzcl1'){
                                      ht = '您最低出售数量 <?php echo C('jl_start');?>RMB - <?php echo C('jl_e');?>RMB';
                                      ht2 = '输入RMB<?php echo C('jl_start');?>起,至<?php echo C('jl_e');?>,且为<?php echo C('jl_beishu');?>的倍数';
                                    }else if(val=='jsbzcl2'){
                                      ht = '您最低出售数量 <?php echo C('tj_start');?>RMB - <?php echo C('tj_e');?>RMB';
                                      ht2 = '输入RMB<?php echo C('tj_start');?>起,至<?php echo C('tj_e');?>,且为<?php echo C('tj_beishu');?>的倍数';
                                    }
                                    $("#get_help").attr('action','/Home/Index/'+val);
                                    $("#txtips").html(ht);
                                    $("#txtips2").attr('placeholder',ht2);
                                  });
                                });
                              </script>
                              <form action="/Home/Index/jsbzcl" method="post" name="wallet_transfer_form" class="form-horizontal margin-none" id="get_help">
                                <input type="hidden" value="" id="wallet_type" name="wallet_type">
                                <fieldset>
                                  <div class="widget-head widget-head-blue"  >
                                    <h4 class="heading">
                                      接受帮助
                                    </h4>
                                  </div>
                                  <div class="widget-body">
                                    <div class="form-group">
                                      <label class="col-md-3 control-label">
                                        支付方式
                                      </label>
                                      <div class="col-md-9">
                                        <label>
                                          <input type="checkbox" value="1" class="ckbox2" name="zffs1" checked="">
                                          银行支付
                                        </label>
                                        <label>
                                          <input type="checkbox" value="1" class="ckbox2" name="zffs2" checked="">
                                          支付宝支付
                                        </label>
                                        <label>
                                          <input type="checkbox" value="1" class="ckbox2" name="zffs3" checked="">
                                          微信支付
                                        </label>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-md-3 control-label">
                                        选择钱包
                                      </label>
                                      <div class="col-md-9">
                                        <label>
                                          <input type="radio" value="jsbzcl" class="ckbox2" name="qb" checked>
                                          总钱包：<?php echo ($userData['ue_money']); ?>RMB
                                        </label>
                                        <label>
                                          <input type="radio" value="jsbzcl1" class="ckbox2" name="qb" >
                                          经理奖钱包：<?php echo ((isset($log_ldx) && ($log_ldx !== ""))?($log_ldx):0); ?>RMB
                                        </label>
                                        <label>
                                          <input type="radio" value="jsbzcl2" class="ckbox2" name="qb" >
                                          推荐奖钱包：<?php echo ((isset($log_tjx) && ($log_tjx !== ""))?($log_tjx):0); ?>RMB
                                        </label>
                                      </div>
                                    </div>
                                    <div class="form-group" >
                                      <label class="col-md-3 control-label">
                                        接受帮助总额:
                                        <span class="ast">
                                          *
                                        </span>
                                      </label>
                                      <div class="col-md-9">
                                        <input type="text" class="form-control get_amount" placeholder="输入RMB<?php echo ($txthemin); ?>起,至<?php echo ($txthemax); ?>,且为<?php echo ($txthebeishu); ?>的倍数" name="get_amount" autocomplete="off" required id="txtips2">
                                        <p class="help-block" id="txtips">
                                          您最低出售数量 <?php echo C('txthemin');?>RMB - <?php echo C('txthemax');?>
                                        </p>
                                        <p class="help-block">
                                          警告，我已完全了解所有风险。我决定参与2016人均财富。                                        </p>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="data-footer innerAll half text-right clearfix">
                                    <button value="继续" id="withdraw_btn" type="submit" class="btn btn-primary btn-sm">
                                      接受帮助
                                    </button>
                                  </div>
                                </fieldset>
                              </form>
                            </div>
                          </div>


                          <div class="col-md-12" id="qdWrap" style=" display:none;">
                            <div class="widget widget-body-white">

                                  <div class="widget-head widget-head-blue"  >
                                    <h4 class="heading">
                                      抢单大厅
                                    </h4>
                                  </div>

                              <div class="widget-body innerAll overthrow">
                                <table class="table table-bordered table-primary">
                                  <thead>
                                  <tr class="tac">
                                  <th>
                                  编号
                                  </th>
                                  <th>
                                  金额
                                  </th>
                                  <th>
                                  提交时间
                                  </th>

                                  <th>
                                  抢单开启/关闭
                                  </th>
                                  <th>
                                  操作
                                  </th>
                                  </tr>
                                  </thead>

                                  <tbody>

                                  <?php if(is_array($jsbzss)): $i = 0; $__LIST__ = $jsbzss;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><form action="/Home/Index/qdid" method="post" class="form-horizontal margin-none">
                                  <tr class="odd">
                                  <td style="text-align:center;">
                                  <input type="hidden"  name="id" value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["id"]); ?>
                                  </td>

                                  <td style="text-align:center;">
                                  <?php echo ($vo["jb"]); ?>
                                  </td>


                                  <td style="text-align:center;">
                                  <?php echo ($vo["date"]); ?>
                                  </td>

                                  <td style="text-align:center;">
                                  <?php echo ($qiang); ?>
                                  </td>

                                  <td style="text-align:center;">
                                  <button type="submit" >立刻抢单</button>
                                  </td>
                                  </tr>
                                  </form><?php endforeach; endif; else: echo "" ;endif; ?>
                                </table>
                              </div>

                            </div>
                          </div>
                      </div>
					</div>
<script type="text/javascript">
try {
var urlhash = window.location.hash;
if (!urlhash.match("fromapp"))
{
if ((navigator.userAgent.match(/(iPhone|iPod|Android|ios|iPad)/i)))
{
$('.head_nav').addClass("head_nav_log");
$('.head_navbar').addClass("head_navbar_log");
$('.MenuItem').addClass("MenuItem_log");
$('.MenuItemChildItem').addClass("MenuItemChildItem_log");
$('.head_top').addClass("head_top_log");
$('.top_content').addClass("top_content_log");
$('.left_text').addClass("left_text_log");
$('.head_content').addClass("head_content_log");
$('.tglj').addClass("tglj_log");
$('.right_text').addClass("right_text_log");
$("#copy-num").css("max-width","50%");
$(".glyphicon,.caret").hide();
$('.hidden-xs').removeClass();
$('.MenuItemChildItem').find('a').addClass("aslog");;
}
}
}
catch(err)
{
}
</script>
                   <div class="row">
      <div class="col-md-9">


          <div class="widget">
            <div class="widget-head clearfix">
              <h4 class="heading"><i class="fa fa-usd">
                </i> 提供帮助</h4>
            </div>
            <div class="widget-body innerAll overthrow">
              <table class="table table-bordered table-primary">
                <thead>
                  <tr class="tac">
                    <th> 编号 </th>
                    <th> 交易进度 </th>
                    <th> 交易时间 </th>
                    <th> 接受会员 </th>
                    <th> 付款方式 </th>
                    <th> 付款金额 </th>
                    <th> 接受会员 </th>
                    <th> 操作 </th>
                  </tr>
                </thead>

                  <?php if(is_array($plist)): $i = 0; $__LIST__ = $plist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$o): $mod = ($i % 2 );++$i;?><tr class="odd">
                      <td>
                        <i>
                          <?php if($o["zt"] == 0): ?><img src="/cssmmm/zt0.jpg"><?php endif; ?>
                          <?php if($o["zt"] == 1): ?><img src="/cssmmm/zt1.jpg"><?php endif; ?>
                          <?php if($o["zt"] == 2): ?><img src="/cssmmm/zt2.jpg"><?php endif; ?>
                        </i>
                        <br>
                        <p class="text-center">R<?php echo ($o["id"]); ?></p>
                      </td>
                      <td><?php echo (check_tgbz_status($o["id"])); ?>

                      </td>
                      </td>
                      <td>
                        <small>
                          配对时间<?php echo ($a1=$o["date"]); ?>
                          <div style="display: none">
                            <?php echo ($aab=$o["g_user"]); ?>
                          </div>
                        </small>
                        <br>
                        <?php if($o["zt"] == 0): ?><small style="font-size:14px;font-weight:bold;color:#ff0000;">
                            剩余打款时间：
                            <span data="<?php echo (datedqsj($a1,$aa1)); ?>" class="countdownbox">
                            </span>
                            <div style="display: none">
                              <?php echo ($aab=$v3["p_user"]); ?>
                            </div>
                          </small><?php endif; ?>
                        <?php if($o["zt"] == 1): ?><small style="font-size:14px;font-weight:bold;color:#ff0000;">
                            剩余确认时间：
                            <span data="<?php echo (datedqsj($aa1,$aaa1)); ?>" class="countdownbox">
                            </span>
                            <div style="display: none">
                              <?php echo ($aab=$o["p_user"]); ?>
                            </div>
                          </small><?php endif; ?>
                        <?php if($o["zt"] == 2): ?><small>
                            汇款时间<?php echo ($aa1=$o["date_hk"]); ?>
                            <div style="display: none">
                              <?php echo ($aab=$o["p_user"]); ?>
                            </div>
                          </small><?php endif; ?>
                      </td>
                      <td>
                        <?php echo ($o["g_user"]); ?>
                      </td>
                      <td>
                        <?php if($o["zffs1"] == 1): ?>银行<?php endif; ?>
                        <?php if($o["zffs2"] == 1): ?>支付宝<?php endif; ?>
                        <?php if($o["zffs3"] == 1): ?>微信<?php endif; ?>
                      </td>
                      <td>
                        <?php echo ($o["jb"]); ?>元
                        <br>
                        <br>
                        <?php if($o["pic"] != '0'): ?><a href="<?php echo ($o["pic"]); ?>" target="_blank">
                            <i style="font-size: 14px;wallet-colorr:#ff0000;display: inline-block;font: normal normal normal 14px/1 FontAwesome;">
                              付款凭证
                            </i>
                          </a><?php endif; ?>
                      </td>
                      <td>
                        <?php echo (cx_user($o["g_user"])); ?>
                      </td>
                      <td>
                        <input style="width:80px;margin-bottom:3px;background:#4CBDEB" name="btn2"
                        id="btn2<?php echo ($o["id"]); ?>" type="button" value="留　言" class="btn btn-info btn-xs addmsg"
                        data-toggle="modal" data-id="8802104" data-target="#myModal7">
                        <br>
                        <input style="width:80px;background:#34495E " name="btn" id="btn<?php echo ($o["id"]); ?>"
                        type="button" value="详细资料" class="btn_detail btn-primary btn-xs" data-toggle="modal"
                        data-target="#myModal5">
                        <br>
                        <?php if($o["zt"] == '0'): if($o["ts_zt"] == '1'): ?>48小时未汇款
                            <br>
                            请联系对方取
                            <br>
                            消投诉!
                            <?php else: ?>
                            <input style="width:80px;" name="btn3" id="btn33<?php echo ($o["id"]); ?>" type="button"
                            value="确认已付款" class="btn_detail btn-primary btn-xs" data-toggle="modal"
                            data-target="#myModa24">
                            <script>
                              $(function() {
                                $('#btn33<?php echo ($o["id"]); ?>').click(function() {
                                  $("#mainframe13", parent.document.body).attr("src", "/Home/Index/home_ddxx_pcz/id/<?php echo ($o["id"]); ?>/"); $("#mainframe13").reload()
                                })
                              })
                            </script><?php endif; endif; ?>
                        <?php if($o["zt"] == 1): if($o["ts_zt"] == '2'): ?>你已被对方投诉请与
                            <br>
                            对方取得联系!
                            <?php else: ?>
                            <span <?php echo (datedqsj2($o["date"])); ?>>
                              <input style="width:120px;" name="btn3" id="btn33<?php echo ($o["id"]); ?>" type="button"
                              value="<?php echo ($jjdktime); ?>小时未确认投诉" class="btn_detail btn-primary btn-xs" data-toggle="modal"
                              data-target="#myModa24">
                              </span>
                              <script>
                                $(function() {
                                  $('#btn33<?php echo ($o["id"]); ?>').click(function() {
                                    $("#mainframe13", parent.document.body).attr("src", "/Home/Index/home_ddxx_g_wqr/id/<?php echo ($o["id"]); ?>/"); $("#mainframe13").reload()
                                  })
                                })
                              </script><?php endif; endif; ?>
                      </td>
                    </tr>
                    <script>
                      $(function() {
                        $('#btn<?php echo ($o["id"]); ?>').click(function() {
                          $("#mainframe11", parent.document.body).attr("src", "/Home/Index/home_ddxx/id/<?php echo ($o["id"]); ?>/"); $("#mainframe11").reload();
                        });
                        $('#btn2<?php echo ($o["id"]); ?>').click(function() {
                          $("#mainframe12", parent.document.body).attr("src", "/Home/Index/home_ddxx_ly/id/<?php echo ($o["id"]); ?>/"); $("#mainframe12").reload();
                        });
                      });
                    </script><?php endforeach; endif; else: echo "" ;endif; ?>
              </table>
            </div>
          </div>


          <div class="widget">
            <div class="widget-head clearfix">
              <h4 class="heading"><i class="fa fa-usd">
                </i>
                  接受帮助</h4>
            </div>
            <div class="widget-body innerAll overthrow">
              <table class="table table-bordered table-primary">
                <thead>
                  <tr class="tac">
                    <th>
                      编号
                    </th>
                    <th>
                      交易进度
                    </th>
                    <th>
                      交易时间
                    </th>
                    <th>
                      提供会员
                    </th>
                    <th>
                      付款方式
                    </th>
                    <th>
                      付款金额
                    </th>
                    <th>
                      接受会员
                    </th>
                    <th>
                      操作
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(is_array($glist)): $i = 0; $__LIST__ = $glist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$o): $mod = ($i % 2 );++$i;?><tr class="odd" role="row">
                      <td>
                        <i>
                          <?php if($o["zt"] == 0): ?><img src="/cssmmm/zt0.jpg"><?php endif; ?>
                          <?php if($o["zt"] == 1): ?><img src="/cssmmm/zt1.jpg"><?php endif; ?>
                          <?php if($o["zt"] == 2): ?><img src="/cssmmm/zt2.jpg"><?php endif; ?>
                        </i>
                        <p class="text-center">S<?php echo ($o["id"]); ?></p>
                      </td>
                      <td>
                        <?php if($o["zt"] == 0): ?>待付款<?php endif; ?>
                        <?php if($o["zt"] == 1): ?>已付款<?php endif; ?>
                        <?php if($o["zt"] == 2): ?><font color="#017F01">
                            交易成功
                          </font><?php endif; ?>
                      </td>
                      </td>
                      <td>
                        <small>
                          配对时间<?php echo ($a1=$o["date"]); ?>
                          <div style="display: none">
                            <?php echo ($aab=$o["g_user"]); ?>
                          </div>
                        </small>
                        <br>
                        <?php if($o["zt"] == 0): ?><small style="font-size:14px;font-weight:bold;color:#ff0000;">
                            剩余打款时间：
                            <span data="<?php echo (datedqsj($a1,$aa1)); ?>" class="countdownbox">
                            </span>
                            <div style="display: none">
                              <?php echo ($aab=$v3["p_user"]); ?>
                            </div>
                          </small><?php endif; ?>
                        <?php if($o["zt"] == 1): ?><small style="font-size:14px;font-weight:bold;color:#ff0000;">
                            剩余确认时间：
                            <span data="<?php echo (datedqsj($o["date"])); ?>" class="countdownbox">
                            </span>
                            <div style="display: none">
                              <?php echo ($aab=$o["p_user"]); ?>
                            </div>
                          </small><?php endif; ?>
                        <?php if($o["zt"] == 2): ?><small>
                            汇款时间<?php echo ($aa1=$o["date_hk"]); ?>
                            <div style="display: none">
                              <?php echo ($aab=$o["p_user"]); ?>
                            </div>
                          </small><?php endif; ?>
                      </td>
                      <td>
                        <?php echo ($o["p_user"]); ?>
                      </td>
                      <td>
                        <?php if($o["zffs1"] == 1): ?>银行<?php endif; ?>
                        <?php if($o["zffs2"] == 1): ?>支付宝<?php endif; ?>
                        <?php if($o["zffs3"] == 1): ?>微信<?php endif; ?>
                      </td>
                      <td>
                        <?php echo ($o["jb"]); ?>元
                        <br>
                        <?php if($o["pic"] != '0'): ?><a href="<?php echo ($o["pic"]); ?>" target="_blank">
                            <i style="font-size: 14px;wallet-colorr:#ff0000;display: inline-block;font: normal normal normal 14px/1 FontAwesome;">
                              付款凭证
                            </i>
                          </a><?php endif; ?>
                      </td>
                      <td>
                        自己
                      </td>
                      <td>
                        <input style="width:80px;margin-bottom:3px;background:#4CBDEB" name="btn2"
                        id="btn2<?php echo ($o["id"]); ?>" type="button" value="留　言" class="btn btn-info btn-xs addmsg"
                        data-toggle="modal" data-id="8802104" data-target="#myModal7">
                        <br>
                        <input style="width:80px;background:#34495E " name="btn" id="btn<?php echo ($o["id"]); ?>"
                        type="button" value="详细资料" class="btn_detail btn-primary btn-xs" data-toggle="modal"
                        data-target="#myModal5">
                        <br>

                      <?php if($o["zt"] == 1): if($o["ts_zt"] == '3'): ?>48小时未确认收款,<br>
                            已被投诉,请联系对<br>
                            方取消投诉!

                            <?php else: ?>
                            <input style="width:80px;" name="btn23" id="btn23<?php echo ($o["id"]); ?>" type="button" value="确认收款" class="btn_detail btn-primary btn-xs" data-toggle="modal"  data-target="#myModa23"><?php endif; ?>
                            <script>
                            $(function(){
                            $('#btn23<?php echo ($o["id"]); ?>').click(function(){
                            $("#mainframe188",parent.document.body).attr("src","/Home/Index/home_ddxx_gcz/id/<?php echo ($o["id"]); ?>/")
                            $("#mainframe188").reload();
                            })
                            })
                            </script><?php endif; ?>


                        <?php if($o["zt"] == 0): if($o["ts_zt"] == '2'): ?>你已被对方投诉请与
                            <br>
                            对方取得联系!
                            <?php else: ?>
                              <span <?php echo (datedqsj2($a1,$aa2)); ?>>
                              <input style="width:120px;" name="btn23" id="btn23<?php echo ($v3["id"]); ?>" type="button" value="<?php echo ($jjdktime); ?>小时未打款投诉" class="btn_detail btn-primary btn-xs" data-toggle="modal"  data-target="#myModa23"></span>
                             <script>
                              $(function(){
                                $('#btn23<?php echo ($v3["id"]); ?>').click(function(){
                                $("#mainframe188",parent.document.body).attr("src","/Home/Index/home_ddxx_g_wdk/id/<?php echo ($vo["id"]); ?>/")
                                $("#mainframe188").reload();
                                });
                              });
                              </script><?php endif; endif; ?>
                      </td>
                    </tr>
                    <script>
                      $(function() {
                        $('#btn<?php echo ($o["id"]); ?>').click(function() {
                          $("#mainframe11", parent.document.body).attr("src", "/Home/Index/home_ddxx/id/<?php echo ($o["id"]); ?>/"); $("#mainframe11").reload();
                        });
                        $('#btn2<?php echo ($o["id"]); ?>').click(function() {
                          $("#mainframe12", parent.document.body).attr("src", "/Home/Index/home_ddxx_ly/id/<?php echo ($o["id"]); ?>/"); $("#mainframe12").reload();
                        });
                      });
                    </script><?php endforeach; endif; else: echo "" ;endif; ?>
              </table>
            </div>
          </div>

        </div>




        <div class="col-md-3">
          <?php if(is_array($tlist)): $i = 0; $__LIST__ = $tlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="widget donate-sidebar pdContainer-pending ">
              <div class="widget-body">
                <div class="donateHead clearfix">
                  <span class="fa fa-arrow-right glyphicon-circle glyphicon-left">
                  </span>
                  <div class="title">
                    舍:提供帮助:
                    <span>
                      P<?php echo (strtolower(substr(md5($v["id"]),0,6))); ?>
                    </span>
                  </div>
                </div>
                <b>
                  参加者
                </b>
                :<?php echo ($v["user_nc"]); ?>
                <br/>
                <b>
                  数额
                </b>
                :<?php echo (hk($v["jb"])); ?>
                <br/>
                <b>
                  日期
                </b>
                :<?php echo ($v["date"]); ?>
                <br/>
                <b>
                  状况:
                  <?php if($v["zt"] == 0): ?><span class="pending">
                      等待中
                    </span><?php endif; ?>
                  <?php if($v["zt"] == 1): ?><span class="pending">
                      匹配成功
                    </span><?php endif; ?>
                  </fb>
                  <br>
                </b>
                <b>
                  <?php if($v["zt"] == 0): ?><div style="">
                                               <!--<form method="post" id="wait" action="/tu/cancel_provide_request">


                        <a href="javascript:if(confirm(' 确定要取消此定单吗?'))location='/Home/Index/tgbz_del/id/<?php echo ($v["id"]); ?>/'"  class="btn btn-danger btn-xs">取消</a>
                        <button type="button" class="btn btn-info btn-xs" style="float:right">详细资料>></button> -->
                                            <!--</form>-->
                        </div><?php endif; ?>

               </b>
              </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>


          <?php if(is_array($jlist)): $i = 0; $__LIST__ = $jlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="widget donate-sidebar gdContainer-pending ">
              <div class="widget-body">
                <div class="donateHead clearfix">
                  <span class="fa fa-arrow-right glyphicon-circle glyphicon-left">
                  </span>
                  <div class="title">
                    得:获得利益:
                    <span>
                      G<?php echo (strtolower(substr(md5($v["id"]),0,6))); ?>
                    </span>
                  </div>
                </div>
                <b>
                  参加者
                </b>
                :<?php echo ($v["user_nc"]); ?>
                <br/>
                <b>
                  数额
                </b>
                :<?php echo (hk($v["jb"])); ?>
                <br/>
                <b>
                  日期
                </b>
                :<?php echo ($v["date"]); ?>
                <br/>
                <b>
                  状况:
                  <?php if($v["zt"] == 0): ?><span class="pending">
                      等待中
                    </span><?php endif; ?>
                  <?php if($v["zt"] == 1): ?><span class="pending">
                      匹配成功
                    </span><?php endif; ?>
                  </b>
                  <br>

                <?php if($v["zt"] == 0): ?><div style="">
                         <!--<form method="post" id="wait" action="/tu/cancel_provide_request">

                         <a href="javascript:if(confirm(' 确定要取消此定单吗?'))location='/Home/Index/jsbz_del/id/<?php echo ($v["id"]); ?>/'"  class="btn btn-danger btn-xs">取消</a>                                               <button type="button" class="btn btn-info btn-xs" style="float:right">详细资料>></button> -->
                      <!--</form>-->
                      </div><?php endif; ?>
              </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="color-line">
      </div>
      <div class="modal-header">
        <h5 class="modal-title" id="title">
          详细的订单信息
        </h5>
        <small class="font-bold">
        </small>
      </div>
      <div class="modal-body" style="height:400px; overflow:auto">
        <iframe src='' id="mainframe11" width="100%;" height="350px;">
        </iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-default" data-dismiss="modal">
          Close
        </button>
      </div>
    </div>
  </div>
</div>
    <div class="modal fade" id="myModal7" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="color-line">
          </div>
          <div class="modal-header">
            <h5 class="modal-title" id="title2">
              留言信息
            </h5>
            <small class="font-bold">
            </small>
          </div>
          <div class="modal-body" style="height:300px; overflow:auto">
            <iframe src='' id="mainframe12" width="830px;" height="350px;">
            </iframe>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn-default" data-dismiss="modal">
              关闭
            </button>
          </div>
        </div>
      </div>
    </div>
<div class="modal fade" id="dialog-msg">
  <div class="modal-dialog">
    <fieldset>
      <form id="pdgd_message_form" method="post">
        <input type="hidden" name="uid" value="82662186">
        <input type="hidden" name="mdid">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="hierarchy_title">
              信息
            </h3>
          </div>
          <div class="modal-body np">
            <div id="message_div" class="messageWrap">
            </div>
            <div id="message_foot">
              <div id="upload">
                <div class="btn-group btn-group-sm" id="upload_clone">
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="input-group">
                      <div class="form-control col-md-3">
                        <i class="fa fa-file fileupload-exists">
                        </i>
                        <span class="fileupload-preview">
                        </span>
                      </div>
                      <span class="input-group-btn">
                        <span class="btn btn-default btn-sm btn-file">
                          <span class="fileupload-new">
                            选择文件
                          </span>
                          <span class="fileupload-exists">
                            替换文件
                          </span>
                          <input type="file" class="btn btn-inverse" name="upload">
                        </span>
                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">
                          清除
                        </a>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <textarea class="form-control form-control-text-area" placeholder="回复"
              name="message" id="message" rows="4">
              </textarea>
              <p class="error" id="message_text">
              </p>
            </div>
          </div>
          <footer class="modal-footer clearfix">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal"
            value="取消" />
            <input type="submit" class="btn btn-primary btn-sm" id="btn_add_message"
            value="回复信息" />
          </footer>
        </div>
      </form>
    </fieldset>
  </div>
</div>
<div class="modal fade" id="dialog-confirm-confirm">
  <div class="modal-dialog">
    <form id="approve_pdgd_form" enctype="multipart/form-data" method="post">
      <input type="hidden" name="__req" value="12">
      <input type="hidden" name="__nonce" value="658026269a5cc1d7205b34c6b6e35efcee9d5c2c51b388305200daabf13efd20">
      <input type="hidden" name="confirm_mdid">
      <fieldset>
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="hierarchy_title">
              确认
            </h3>
          </div>
          <div class="modal-body">
            您确定要肯定此合并舍得吗?
            <br/>
            <br/>
            为了双方资金安全抵达，系统新上了上传汇款交易成功图片，您可以选择直接点上确认，或者上传付款证明以确认此舍得合并，才点上确认都可以。
            <br/>
            <br/>
            在得的会员，对方在能点上批准时，会看到您所上传的打款交易照片！
            <br/>
            <br/>
            <div id="confirm_upload_images_div">
              <div id="confirm_message_div" class="messageWrap">
              </div>
              <div id="confirm_message_foot">
                <div id="confirm_upload">
                  <div class="btn-group btn-group-sm" id="confirm_upload_clone">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="input-group">
                        <div class="form-control col-md-3">
                          <i class="fa fa-file fileupload-exists">
                          </i>
                          <span class="fileupload-preview">
                          </span>
                        </div>
                        <span class="input-group-btn">
                          <span class="btn btn-default btn-sm btn-file">
                            <span class="fileupload-new">
                              选择文件
                            </span>
                            <span class="fileupload-exists">
                              替换文件
                            </span>
                            <input type="file" class="btn btn-inverse" name="confirm_upload[]">
                          </span>
                          <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">
                            清除
                          </a>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div id="confirm_message_div" class="messageWrap">
              </div>
              <div id="confirm_message_foot">
                <div id="confirm_upload">
                  <div class="btn-group btn-group-sm" id="confirm_upload_clone">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="input-group">
                        <div class="form-control col-md-3">
                          <i class="fa fa-file fileupload-exists">
                          </i>
                          <span class="fileupload-preview">
                          </span>
                        </div>
                        <span class="input-group-btn">
                          <span class="btn btn-default btn-sm btn-file">
                            <span class="fileupload-new">
                              选择文件
                            </span>
                            <span class="fileupload-exists">
                              替换文件
                            </span>
                            <input type="file" class="btn btn-inverse" name="confirm_upload[]">
                          </span>
                          <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">
                            清除
                          </a>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div id="confirm_message_div" class="messageWrap">
              </div>
              <div id="confirm_message_foot">
                <div id="confirm_upload">
                  <div class="btn-group btn-group-sm" id="confirm_upload_clone">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="input-group">
                        <div class="form-control col-md-3">
                          <i class="fa fa-file fileupload-exists">
                          </i>
                          <span class="fileupload-preview">
                          </span>
                        </div>
                        <span class="input-group-btn">
                          <span class="btn btn-default btn-sm btn-file">
                            <span class="fileupload-new">
                              选择文件
                            </span>
                            <span class="fileupload-exists">
                              替换文件
                            </span>
                            <input type="file" class="btn btn-inverse" name="confirm_upload[]">
                          </span>
                          <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">
                            清除
                          </a>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div id="confirm_message_div" class="messageWrap">
              </div>
              <div id="confirm_message_foot">
                <div id="confirm_upload">
                  <div class="btn-group btn-group-sm" id="confirm_upload_clone">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="input-group">
                        <div class="form-control col-md-3">
                          <i class="fa fa-file fileupload-exists">
                          </i>
                          <span class="fileupload-preview">
                          </span>
                        </div>
                        <span class="input-group-btn">
                          <span class="btn btn-default btn-sm btn-file">
                            <span class="fileupload-new">
                              选择文件
                            </span>
                            <span class="fileupload-exists">
                              替换文件
                            </span>
                            <input type="file" class="btn btn-inverse" name="confirm_upload[]">
                          </span>
                          <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">
                            清除
                          </a>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div id="confirm_message_div" class="messageWrap">
              </div>
              <div id="confirm_message_foot">
                <div id="confirm_upload">
                  <div class="btn-group btn-group-sm" id="confirm_upload_clone">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="input-group">
                        <div class="form-control col-md-3">
                          <i class="fa fa-file fileupload-exists">
                          </i>
                          <span class="fileupload-preview">
                          </span>
                        </div>
                        <span class="input-group-btn">
                          <span class="btn btn-default btn-sm btn-file">
                            <span class="fileupload-new">
                              选择文件
                            </span>
                            <span class="fileupload-exists">
                              替换文件
                            </span>
                            <input type="file" class="btn btn-inverse" name="confirm_upload[]">
                          </span>
                          <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">
                            清除
                          </a>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer" id="confirm_cancel_btn">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
              取消
            </button>
            <input type="submit" id="btn_approve_donation" class="btn btn-primary btn-sm"
            value="确定" />
          </div>
        </div>
      </fieldset>
    </form>
  </div>
</div>
<div class="modal fade" id="dialog-report-confirm">
  <div class="modal-dialog">
    <form id="report_pdgd_form" enctype="multipart/form-data" method="post">
      <input type="hidden" name="__req" value="8">
      <input type="hidden" name="__nonce" value="db1938e53e777acaafe76bdaa833d43352a4303272baa4541d4dbbf5560859c4">
      <input type="hidden" name="report_uid">
      <input type="hidden" name="report_mdid">
      <fieldset>
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="hierarchy_title">
              确认举报
            </h3>
          </div>
          <div class="modal-body">
            <p>
              请提供您欲举报此合并舍得的原因。
            </p>
            <label>
              选项:
            </label>
            <select class="form-control" name="report_reason">
              <option value="">
                请选择
              </option>
              <option value="6">
                已经打款,对方没有确认
              </option>
              <option value="7">
                对方银行账号错误
              </option>
              <option value="8">
                联系方式有问题
              </option>
              <option value="5">
                其他
              </option>
            </select>
            <span id="report_reason_err_text" class="error">
            </span>
            <br/>
            <label>
              信息:
            </label>
            <textarea class="form-control form-control-text-area" placeholder="Reply here..."
            name="report_message" rows="4">
            </textarea>
            <div id="confirm_upload_images_div">
              <div id="confirm_message_div" class="messageWrap">
              </div>
              <div id="confirm_message_foot">
                <div id="report_upload">
                  <div class="btn-group btn-group-sm" id="confirm_upload_clone">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="input-group">
                        <div class="form-control col-md-3">
                          <i class="fa fa-file fileupload-exists">
                          </i>
                          <span class="fileupload-preview">
                          </span>
                        </div>
                        <span class="input-group-btn">
                          <span class="btn btn-default btn-sm btn-file">
                            <span class="fileupload-new">
                              选择文件
                            </span>
                            <span class="fileupload-exists">
                              替换文件
                            </span>
                            <input type="file" class="btn btn-inverse" name="report_upload">
                          </span>
                          <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">
                            清除
                          </a>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer" id="approve_cancel_btn">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
              取消
            </button>
            <input type="submit" id="btn_cancel_donation" class="btn btn-primary btn-sm"
            value="确定" />
          </div>
        </div>
      </fieldset>
    </form>
  </div>
</div>
<div class="modal fade" id="dialog-photo">
  <div class="modal-dialog">
    <form name="cancel_order_form" method="post" action="">
      <input type="hidden" name="" value="">
      <input type="hidden" name="" value="">
      <input type="hidden" name="pboid" value>
      <div class="modal-content">
        <div class="modal-body np" id="image_div">
        </div>
      </div>
    </form>
  </div>
</div>


<div class="modal fade" id="myModa23" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="color-line"></div>
            <div class="modal-header">
                <h5 class="modal-title" id="title23">请选择</h5>
                <small class="font-bold"></small>
            </div>
            <div class="modal-body" style="height:400px; overflow:auto">
              <iframe src='' id="mainframe188" width="830px;" height="350px;" ></iframe>
            </div>
            <div class="modal-footer">

                  <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <!--
                <button type="button" class="btn-primary" data-dismiss="modal" id="select_fanshi">确认</button>-->
            </div>



        </div>
    </div>
</div>

<div class="modal fade" id="myModa24" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="color-line"></div>
            <div class="modal-header">
                <h5 class="modal-title" id="title24">请选择</h5>
                <small class="font-bold"></small>
            </div>
            <div class="modal-body" style="height:400px; overflow:auto">
              <iframe src='' id="mainframe13" width="830px;" height="350px;" ></iframe>
            </div>
            <div class="modal-footer">

                  <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>

                <!--<button type="button" class="btn-primary" data-dismiss="modal" id="select_fanshi2">确认</button> -->
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="prompt-repd">
  <div class="modal-dialog">
    <fieldset>
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="hierarchy_title">
            完成舍与得程序
          </h3>
        </div>
        <div class="modal-body np">
          <div id="message_foot">
            您已经完成了一个舍与得程序。请问您想继续提供帮助吗?
          </div>
        </div>
        <footer class="modal-footer clearfix">
          <input type="continue" class="btn btn-green btn-sm" value="继续" id="click-pd"
          />
          <input type="button" class="btn btn-red btn-sm" data-dismiss="modal" value="迂回"
          />
        </footer>
      </div>
    </fieldset>
  </div>
</div>
            </body>

          </html>