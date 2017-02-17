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
<!--[if!IE]><!-->
<html>
<!--<![endif]-->

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
<script type="text/javascript" src="/bitStyle/js/layer.js"></script>
<script src="/cssmmm/jquery.countdown.js"></script>
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
          window.location.href = "/bitStyle/zh-CN/"
        }
      }
    })
  },
  300000);
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
    $('.approve_remaining_time').each(function() {
      var _rid = $(this).attr('id');
      var _seconds = parseInt($(this).attr('rel'));
      if (_seconds > 0) {
        $(this).html(remaining.getString(_seconds, _i18n, false))
      } else {
        $(this).html('剩余0天')
      }
      _allsecs[_rid] = _seconds;
      _allsecs2[_rid] = _seconds
    });
    timer = setInterval(function() {
      var now = new Date();
      true_elapsed = Math.round((now.getTime() - _gNow.getTime()) / 1000);
      $('.approve_remaining_time').each(function() {
        var _rid = $(this).attr('id');
        if (typeof _allsecs[_rid] == 'undefined') {
          _allsecs[_rid] = parseInt($(this).attr('rel'))
        }
        _seconds = _allsecs[_rid];
        if (typeof _allsecs2[_rid] == 'undefined') {
          _allsecs2[_rid] = parseInt($(this).attr('rel'))
        }
        _diff_sec = _allsecs2[_rid] - _seconds;
        if (_diff_sec < true_elapsed) {
          _seconds = _allsecs2[_rid] - true_elapsed
        }
        if (_seconds > 0) {
          $(this).html(remaining.getString(_seconds, _i18n, false));
          _allsecs[_rid] = --_seconds
        } else {
          $("#too_many_user").hide();
          $("#login_btn").removeAttr("disabled");
          $(this).html('剩余0天')
        }
      })
    },
    1000)
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
    $('.roi_distribute_remaining_time').each(function() {
      var _rid = $(this).attr('id');
      var _seconds = parseInt($(this).attr('rel'));
      if (_seconds > 0) {
        $(this).html(remaining.getString(_seconds, _i18n, false))
      } else {
        $(this).html('剩余0天')
      }
      _allsecs[_rid] = _seconds;
      _allsecs2[_rid] = _seconds
    });
    timer = setInterval(function() {
      var now = new Date();
      true_elapsed = Math.round((now.getTime() - _gNow.getTime()) / 1000);
      $('.roi_distribute_remaining_time').each(function() {
        var _rid = $(this).attr('id');
        if (typeof _allsecs[_rid] == 'undefined') {
          _allsecs[_rid] = parseInt($(this).attr('rel'))
        }
        _seconds = _allsecs[_rid];
        if (typeof _allsecs2[_rid] == 'undefined') {
          _allsecs2[_rid] = parseInt($(this).attr('rel'))
        }
        _diff_sec = _allsecs2[_rid] - _seconds;
        if (_diff_sec < true_elapsed) {
          _seconds = _allsecs2[_rid] - true_elapsed
        }
        if (_seconds > 0) {
          $(this).html(remaining.getString(_seconds, _i18n, false));
          _allsecs[_rid] = --_seconds
        } else {
          $("#too_many_user").hide();
          $("#login_btn").removeAttr("disabled");
          $(this).html('剩余0天')
        }
      })
    },
    1000)
  });
</script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    var mdid, pdid, gdid, amount, status;
    var img_field = $("#upload_clone").clone();
    $("button[name^=load_pdgd_matching_]").click(function() {
      var pdid = $(this).val();
      $("#pd_matching_list_" + pdid).html('<img src="/bitStyle/images/loader2.gif"/>');
       $("#pd_matching_list_" + pdid).load("?pdid=" + pdid,
      function() {
        $('.transactionWrap').hide();
      });
    });
    $('[data-toggle="tooltip"]').tooltip({
      container: 'body',
    });
    $('.hireTable').live("click",
    function() {
      $('.' + $(this).attr('value') + '.donate-body-' + $(this).attr('rel')).slideToggle('normal')
    });
    $('.btn-details').live("click",
    function() {
      $(this).parents('table').siblings('.transactionWrap').stop(true, false).slideUp('normal');
      $(this).parents('table').next().stop(true, false).slideToggle('normal');
      return false
    });
    $('#show_message_box').live("click",
    function(e) {
      e.preventDefault();
      json = $(this).attr('data');
      data = JSON && JSON.parse(json) || $.parseJSON(json);
      mdid = data.mdid;
      var spUrl = $(this).attr('src');
      $("#message_div").load(spUrl);
      $("input[name=mdid]").val(mdid)
    });
    $('a[id^=show_report_box]').live("click",
    function() {
      json = $(this).attr('data');
      data = JSON && JSON.parse(json) || $.parseJSON(json);
      $("input[name=report_uid]").val(data.uid);
      $("input[name=report_mdid]").val(data.mdid)
    });
    $('a[id^=show_confirm_box]').live("click",
    function() {
      json = $(this).attr('data');
      data = JSON && JSON.parse(json) || $.parseJSON(json);
      $("input[name=confirm_mdid]").val(data.mdid)
    });
    $("a[id^=show_image]").live("click",
    function() {
      $("#image_div").html("<img alt='' class='img-responsive' src='" + $(this).attr('data') + "'>")
    });
    $("a[id^=show_message_image]").live("click",
    function() {
      $("#image_div").html("<img alt='' class='img-responsive' src='" + $(this).attr('data') + "'>")
    });
    $("#pdgd_message_form").on('submit',
    function(events) {
      events.preventDefault();
      if ($("input[name=uid]").val() != 82662186) {
        $('#message_text').html('程序出错，请再试一次。')
      } else {
        $.ajax({
          url: '?aj=1&type=add_pdgd_message',
          type: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          success: function(data) {
            var show_image = '';
            json = data.split('<', 1)[0];
            details = JSON && JSON.parse(json) || $.parseJSON(json);
            if (details.error == "") {
              $('#message_text').html('');
              if (details.upload != "") {
                show_image = '<a href="#dialog-photo" id="show_message_image" data="' + details.upload + '" data-toggle="modal" class=""><img height="100px" width="100px" src="' + details.upload + '"></a>'
              }
              var html = '<div class="innerMessage message-toggle"><div class="fullMessage clearfix"><div class="pull-left"><strong class="blue">' + details.username + '</strong></div><div class="pull-right calendar ml5"><i class="fa fa-calendar mr5"></i><span class="title-date">2016年1月11日 4:18:14PM</span></div><div class="clearfix"></div><div class="mt5"><p class="nm">' + details.message + '</p>' + show_image + '</div></div></div>';
              $('#message_div').append(html);
              $("#upload").html(img_field);
              img_field = $("#upload_clone").clone();
              $("textarea[name=message]").val('')
            } else {
              $('#message_text').html(details.error)
            }
          }
        })
      }
    });
    if (0) {
      $('#prompt-repd').modal('show')
    }
    $('#prompt-repd').on('click', '#click-pd',
    function(e) {
      e.preventDefault();
      $("#pdBtn").trigger("click");
      $('#prompt-repd').modal('hide')
    })
  });
</script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    var gdBtn = $('#gdBtn');
    var pdBtn = $('#pdBtn');
    pdBtn.click(function() {
      $(this).toggleClass('active');
      gdBtn.removeClass('active');
      $('#pdWrap').stop(true, false).slideToggle('fast');
      $('#gdWrap').stop(true, false).slideUp('fast').removeClass('open');
      return false
    });
    gdBtn.click(function() {
      $(this).toggleClass('active');
      pdBtn.removeClass('active');
      $('#gdWrap').stop(true, false).slideToggle('fast');
      $('#pdWrap').stop(true, false).slideUp('fast').removeClass('open');
      return false
    });
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
      return false
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
      true_elapsed = Math.round((now.getTime() - _gNow.getTime()) / 1000);
      second = _local_time.getTime() + 1000;
      elapsed = Math.round((second - _local_time2.getTime()) / 1000);
      if (elapsed < true_elapsed) {
        diff = true_elapsed - elapsed;
        second += (diff * 1000)
      }
      _local_time.setTime(second);
      second = _server_time.getTime() + 1000;
      elapsed = Math.round((second - _server_time2.getTime()) / 1000);
      if (elapsed < true_elapsed) {
        diff = true_elapsed - elapsed;
        second += (diff * 1000)
      }
      _server_time.setTime(second);
      date_text = padNumber(_server_time.getHours()) + ':' + padNumber(_server_time.getMinutes()) + ':' + padNumber(_server_time.getSeconds());
      date_text += ' ' + _server_time.getDate() + '/' + (_server_time.getMonth() + 1) + '/' + _server_time.getFullYear();
      $('#server_time_text').html(date_text);
      date_text = padNumber(_local_time.getHours()) + ':' + padNumber(_local_time.getMinutes()) + ':' + padNumber(_local_time.getSeconds());
      date_text += ' ' + _local_time.getDate() + '/' + (_local_time.getMonth() + 1) + '/' + _local_time.getFullYear();
      $('#local_time_text').html(date_text)
    },
    1000);
    function padNumber(number) {
      return (number >= 0 && number < 10) ? '0' + number: number
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
        $(this).html(remaining.getString(_seconds, _i18n, false))
      } else {
        $(this).html('剩余0天')
      }
      _allsecs[_rid] = _seconds;
      _allsecs2[_rid] = _seconds
    });
    timer = setInterval(function() {
      var now = new Date();
      true_elapsed = Math.round((now.getTime() - _gNow.getTime()) / 1000);
      $('.maintain_remain_time').each(function() {
        var _rid = $(this).attr('id');
        if (typeof _allsecs[_rid] == 'undefined') {
          _allsecs[_rid] = parseInt($(this).attr('rel'))
        }
        _seconds = _allsecs[_rid];
        if (typeof _allsecs2[_rid] == 'undefined') {
          _allsecs2[_rid] = parseInt($(this).attr('rel'))
        }
        _diff_sec = _allsecs2[_rid] - _seconds;
        if (_diff_sec < true_elapsed) {
          _seconds = _allsecs2[_rid] - true_elapsed
        }
        if (_seconds > 0) {
          $(this).html(remaining.getString(_seconds, _i18n, false));
          _allsecs[_rid] = --_seconds
        } else {
          $("#too_many_user").hide();
          $("#login_btn").removeAttr("disabled");
          $(this).html('剩余0天')
        }
      })
    },
    1000)
  });
</script>
<script type="text/javascript">
</script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    var pin_message = "此次执行需要{quantity}PIN。";
    $('#maintain_back_btn, #pd_back_btn, #gd_back_btn').click(function() {
      $('input[name=__req]').val('start')
    });
    if ("0") {
      $("#pd_pin").text(pin_message.replace("{quantity}", parseInt(0 / 0.5)))
    } else {
      $("#pd_pin").text(pin_message.replace("{quantity}", 1))
    }
    $("input[name=from_wallet]").change(function() {
      if ($(this).val() == 'cwallet') {
        $("#minimum_amount").text("BTC0.50000000")
      } else {
        $("#minimum_amount").text("BTC0.50000000")
      }
    });
    $("#show_pd_amount").html(format_monetary_value(0));
    $("#show_gd_amount").html(format_monetary_value(0));
    $("#pd_amount").keyup(function() {
      $("#show_pd_amount").html(format_monetary_value($(this).val()));
      if ($(this).val() > 0.5 && $(this).val() % 0.5 == 0) {
        $("#pd_pin").text(pin_message.replace("{quantity}", $(this).val() / 0.5))
      } else {
        $("#pd_pin").text(pin_message.replace("{quantity}", 1))
      }
    });
    $("#gd_amount").keyup(function() {
      $("#show_gd_amount").html(format_monetary_value($(this).val()))
    });
    if (false) {
      $("#recalc-ep-message").text("您的额外回酬已计算。请稍候片刻再尝试。");
      $("#recalc-ep-button").attr("disabled", "disabled");
      setTimeout(function() {
        $("#recalc-ep-button").removeAttr("disabled");
        $("#recalc-ep-message").text("")
      },
      0)
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
          console.log(data)
        },
        success: function(data) {
          if (data.percent > 0) {
            $("#current_ep").html(data.percent)
          }
        }
      });
      setTimeout(function() {
        $("#recalc-ep-button").removeAttr("disabled");
        $("#recalc-ep-message").text("")
      },
      1800000)
    })
  });
</script>
<script type="text/javascript">
  jQuery(document).ready(function() {
    $("#btn_cancel_donation").live("click",
    function(e) {
      if ($("select[name=report_reason]").val() == "") {
        e.preventDefault();
        $("#report_reason_err_text").text("请选择一个选项。")
      } else {
        $("#report_reason_err_text").text("")
      }
    })
  });
</script>
<script>
</script>
<link rel="stylesheet" href="/bitStyle/css/bootstrap.min.css" type="text/css"
/>
<link rel="stylesheet" href="/bitStyle/css/font-awesome.min.css" type="text/css"
/>
<link rel="stylesheet" href="/bitStyle/css/main.v001.css?v=1.00.0001" type="text/css"
/>
<link rel="stylesheet" href="/bitStyle/css/zh-CN.css?v=1.00.0001" type="text/css"
/>
<link rel="stylesheet" href="/bitStyle/css/fileupload.css" type="text/css"
/>
<title>2016人均财富</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE"
/>
<!--Favicons-->
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

<div class="page-content">
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
</div>
<div id="wrapper">
	<div class="container">
		<div class="innerContent">

       <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <form class="form-horizontal margin-none" name="register_form" action="<?php echo U('Index/regadd');?>" method="post" id="register_form">

                    <div class="widget widget-body-white padding-none">
                        <div class="widget-head">
                            <h4 class="heading">注册新会员</h4>
                        </div>
                        <div class="widget-body">
                          <div class="form-group">
                                <label class="col-md-3 control-label">登录账号<span class="ast">*</span></label>
                                <div class="col-md-9"><input class="form-control" id="realname" name="email" value="" type="text"/></div>
                            </div>
                           <div class="form-group">
                                <label class="col-md-3 control-label">手机号码<span class="ast">*</span></label>
                                <div class="col-md-9">
                                  <input class="form-control" id="mobile" name="phone" value="" type="text"/>
                                  <?php if(C('phonecheck')): ?><input type="button" class="btn btn-primary" onclick="time(this);" value="发送"/><?php endif; ?>
                                </div>

                            </div>
                            <?php if(C('phonecheck')): ?><div class="form-group">
                                <label class="col-md-3 control-label">手机验证码<span class="ast">*</span></label>
                                <div class="col-md-9"><input class="form-control" id="email" name="phone_check" value="" type="text"/></div>
                            </div><?php endif; ?>
                            <div class="form-group">
                                <label class="col-md-3 control-label">姓名<span class="ast">*</span></label>
                                <div class="col-md-9"><input class="form-control" id="realname" name="username" value="" type="text"/></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">身份证<span class="ast">*</span></label>
                                <div class="col-md-9"><input class="form-control" id="UE_sfz" name="UE_sfz" value="" type="text"/></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">支付宝<span class="ast">*</span></label>
                                <div class="col-md-9"><input class="form-control" id="zfb" name="zfb" value="" type="text"/></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">开户行<span class="ast">*</span></label>
                                <div class="col-md-9"><input class="form-control" id="zbzh" name="zbzh" value="" type="text"/></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">银行名称<span class="ast">*</span></label>
                                <div class="col-md-9"><input class="form-control" id="yhmc" name="yhmc" value="" type="text"/></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">银行卡号<span class="ast">*</span></label>
                                <div class="col-md-9"><input class="form-control" id="yhzh" name="yhzh" value="" type="text"/></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">推荐人账号<span class="ast">*</span></label>
                                <div class="col-md-9">

                                        <input type="text" class="form-control auto-ajax " placeholder="" name="pemail" id="recommended" value="<?php echo ($userData['ue_account']); ?>" autocomplete="off"/>



                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">登录密码<span class="ast">*</span></label>
                                <div class="col-md-9"><input class="form-control" id="password" name="password"  type="password"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">确认密码<span class="ast">*</span></label>
                                <div class="col-md-9"><input class="form-control" id="cpassword" name="password2"  type="password"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">二级密码<span class="ast">*</span></label>
                                <div class="col-md-9"><input class="form-control" id="password2" name="secpwd"  type="password"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">确认二级密码<span class="ast">*</span></label>
                                <div class="col-md-9"><input class="form-control" id="cpassword2" name="resecpwd"  type="password"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">安全问题<span class="ast">*</span></label>
                                <div class="col-md-9">
                                <select class="form-control" name="question">
                                    <option value="0">----请选择问题----</option>
                                    <option value="q1">您的生日是什么时间？</option>
                                    <option value="q2">您最喜欢人的叫什么名字？</option>
                                    <option value="q3">您最喜欢的是什么？</option>
                                    <option value="q4">您父亲的名字叫什么？</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">问题答案<span class="ast">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="adsfd form-control" autocomplete="off" id="answer" name="answer">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">激活码<span class="ast">*</span></label>
                                <div class="col-md-9"><input class="form-control" id="password2" name="active" value="<?php echo ((isset($pin) && ($pin !== ""))?($pin):'没有可用激活码'); ?>" type="text"></div>
                            </div>

                                <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-9"><input name="ty" type="checkbox" id="ty" value="ye" checked>
                              我已完全了解所有风险。</div>
                            </div>
                        </div>

                        <div class="data-footer innerAll half text-right clearfix" style="text-align:center; padding:10px;">
                            <button type="button" class="btn btn-block btn-primary" onClick="reg()">注册</button>
                            <input type="hidden" name="MemberId" value="-1" />
                        </div>
                    </div>



                    <div class="widget widget-body-white padding-none">

                    </div>
                </form>
            </div>
        </div>


<script type="text/javascript">
    $(document).ready(function($){
        $('form[name=login_form]').submit(function(){
            $('input#login_btn').attr('disabled','disabled');
        });
        $('#username').focus();
        $.removeCookie("alert", { path: '/' });
    });

    function reg() {
        if ($("#username").val() == "") {
            layer.msg("请填写用户名");
            return false;
        } else if ($("#recommended").val() == "") {
            layer.msg("请填写推荐人");
            return false;
        }
        else if ($("#password").val() == "") {
            layer.msg("请填写密码");
            return false;
        }
        else if ($("#password").val() != $("#cpassword").val()) {
            layer.msg("两次密码不一致");
            return false;
        }
        else if ($("#cpassword").val() == "") {
            layer.msg("请填写安全密码");
            return false;
        }
        else if ($("#cpassword2").val() != $("#cpassword2").val()) {
            layer.msg("两次安全密码不一致");
            return false;
        }
        else if ($("#realname").val() == "") {
            layer.msg("请填写姓名");
            return false;
        }
        else if ($("#email").val() == "") {
            layer.msg("请填写邮箱");
            return false;
        }
        else if ($("#mobile").val() == "") {
            layer.msg("请填写手机号");
            return false;
        }
        else if ($("#password").val() == "") {
            layer.msg("请填写密码");
            return false;
        }

        if (!isMobile($("#mobile").val())) {
            layer.msg("手机格式不正确");
            return false;
        }
/*
        if (!isEmail($("#email").val())) {
            layer.msg("邮箱格式不正确");
            return false;
        }*/
      /*  $.post("<?php echo U('Index/regadd');?>", $("form").serialize(), function(data) {
            if (data.error) {
                    layer.msg(data.msg);
                location.href = "<?php echo U('Index/tip',array('msg'=>'"+data.msg+"','success'=>0));?>";
            } else { */
                /*layer.msg(data.msg);*/
         /*       location.href = "<?php echo U('Index/tip',array('msg'=>'"+data.msg+"','success'=>1));?>";
            }},'json');


*/
    $("#register_form").submit();

    }

    function isMobile(str) {
        var myreg = /^([0]?)(((13[0-9]{1})|(14[0-9]{1})|(15[0-9]{1})|(16[0-9]{1})|(17[0-9]{1})|(18[0-9]{1})|(19[0-9]{1}))+\d{8})$/;
        return myreg.test(str);
    }

    function isEmail(str) {
        var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
        return reg.test(str);
    }

    var wait = 60;

    function time(o) {

        if ($("#mobile").val() == "") {
            layer.msg("请填写手机号");
            return false;
        }

        if (!isMobile($("#mobile").val())) {
            layer.msg("手机格式不正确");
            return false;
        }

        $.post("<?php echo U('Reg/sendPhone');?>", { phone: $("#mobile").val() }, function(msg) { layer.msg("验证码已经发送，注意查收"); });

        okssss(o);
    }
    var wait = 60;
    function okssss(o) {
        if (wait == 0) {
            $(o).removeAttr("disabled");
            $(o).val("免费获取验证码");
            wait = 120;
        } else {
            $(o).attr("disabled", true);
            $(o).val("重新发送(" + wait + ")");
            wait--;
            setTimeout(function() {
                okssss(o);
            },
            1000);
        }
    }
</script>









    </div>
  </div>
</div>
</body>

</html>