<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="/sncss/css/style.css" rel="stylesheet" type="text/css" />
<script src="/sncss/js/jquery.js"></script>
</head>

<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">表单</a></li>
    </ul>
    </div>

    <div class="formbody">

    <div class="formtitle"><span>基本信息</span></div>
      <form id="form1" name="form1" method="post" action="/shi.php/Home/Index/usercl">
	  <input name="UE_account"  type="hidden" class="dfinput" value="<?php echo ($userdata['ue_account']); ?>" />
    <ul class="forminfo">
	<li><label>会员編号</label><input name="UE_account1" disabled="true " type="text" class="dfinput" value="<?php echo ($userdata['ue_account']); ?>" /><i>不可修改</i></li>
	<li><label>推荐人</label><input name="UE_accName" type="text" class="dfinput" value="<?php echo ($userdata['ue_accname']); ?>"/></li>
	<li><label>报单中心</label><input name="UE_theme" type="text" class="dfinput" value="<?php echo ($userdata['ue_theme']); ?>"/></li>
	<li><label>是否激活</label><?php if($userdata['ue_check'] == 0): ?><cite><input name="UE_check" type="radio" value="1" />是&nbsp;&nbsp;&nbsp;&nbsp;<input name="UE_check" type="radio" value="0" checked="checked" />否</cite><?php else: ?><cite><input name="UE_check" type="radio" value="1" checked="checked" />
	是&nbsp;&nbsp;&nbsp;&nbsp;<input name="UE_check" type="radio" value="0" />
	否</cite><?php endif; ?></li>

    <li><label>用户级别</label>
        <select name="UE_level" class="dfinput">
            <option value="0" <?php if(($userdata["ue_level"]) == "0"): ?>selected<?php endif; ?>>B0</option>
            <option value="1" <?php if(($userdata["ue_level"]) == "1"): ?>selected<?php endif; ?>>B1</option>
            <option value="2" <?php if(($userdata["ue_level"]) == "2"): ?>selected<?php endif; ?>>B2</option>
            <option value="3" <?php if(($userdata["ue_level"]) == "3"): ?>selected<?php endif; ?>>B3</option>
            <option value="4" <?php if(($userdata["ue_level"]) == "4"): ?>selected<?php endif; ?>>B4</option>
            <option value="5" <?php if(($userdata["ue_level"]) == "5"): ?>selected<?php endif; ?>>B5</option>
            <option value="6" <?php if(($userdata["ue_level"]) == "6"): ?>selected<?php endif; ?>>B6</option>
            <option value="7" <?php if(($userdata["ue_level"]) == "7"): ?>selected<?php endif; ?>>经理</option>
        </select>
        <input type="hidden" name="levelname" value="<?php echo ($userdata["levelname"]); ?>" />
    </li>
<script>
$(function(){
    $("select[name='UE_level']").change(function(){
        $("input[name='levelname']").val($(this).find("option:selected").text());
    });
});
</script>

    <li><label>是否封号解封</label><input name="UE_status" type="text" class="dfinput" value="<?php echo ($userdata['ue_status']); ?>" />0 默认，表示系统将根据条件进行封号，1 表示直接封号，2表示永久解封不再系统封号</li>

    <li><label>二級密码</label><input name="UE_secpwd" type="text" class="dfinput" /><i>不修改请留空</i></li>
	<li><label>密码</label><input name="UE_password" type="text" class="dfinput" /><i>不修改请留空</i></li>
    <li><label>姓名</label><input name="UE_truename" type="text" class="dfinput" value="<?php echo ($userdata['ue_truename']); ?>"/><i></i></li>
    <li><label>身份证</label><input name="UE_sfz" type="text" class="dfinput" value="<?php echo ($userdata['ue_sfz']); ?>"/><i></i></li>
    <li><label>支付宝</label><input name="zfb" type="text" class="dfinput" value="<?php echo ($userdata['zfb']); ?>"/><i></i></li>
    <li><label>微信</label><input name="weixin" type="text" class="dfinput" value="<?php echo ($userdata['weixin']); ?>"/><i></i></li>
    <li><label>银行名称</label><input name="yhmc" type="text" class="dfinput" value="<?php echo ($userdata['yhmc']); ?>"/><i></i></li>
	<li><label>银行卡号</label><input name="yhzh" type="text" class="dfinput" value="<?php echo ($userdata['yhzh']); ?>"/><i></i></li>
	<li><label>邮箱</label><input name="email" type="text" class="dfinput" value="<?php echo ($userdata['email']); ?>"/><i></i></li>
	<li><label>QQ</label><input name="UE_qq" type="text" class="dfinput" value="<?php echo ($userdata['ue_qq']); ?>"/><i></i></li>
	<li><label>手機</label><input name="UE_phone" type="text" class="dfinput" value="<?php echo ($userdata['ue_phone']); ?>"/><i></i></li>
    <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="确认保存"/></li>
    </ul>
      </form>

    </div>


</body>

</html>