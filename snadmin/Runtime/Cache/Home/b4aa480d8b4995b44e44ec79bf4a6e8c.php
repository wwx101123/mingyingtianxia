<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="/sncss/css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="/sncss/js/jquery.js"></script>

<script type="text/javascript">
$(function(){	
	//导航切换
	$(".menuson li").click(function(){
		$(".menuson li.active").removeClass("active")
		$(this).addClass("active");
	});
	
	$('.title').click(function(){
		var $ul = $(this).next('ul');
		$('dd').find('ul').slideUp();
		if($ul.is(':visible')){
			$(this).next('ul').slideUp();
		}else{
			$(this).next('ul').slideDown();
		}
	});
})	
</script>


</head>

<body style="background:#f0f9fd;">
	<div class="lefttop"><span></span>功能栏</div>
    
    <dl class="leftmenu">
        
    <dd>
    <div class="title">
    <span><img src="/sncss/images/leftico01.png" /></span>会员管理
    </div>
    	<ul class="menuson">
        <li><cite></cite><a href="/shi.php/Home/Index/userlist" target="rightFrame">所有會員</a><i></i></li>
       
        <li><cite></cite><a href="/shi.php/Home/Index/jbzs" target="rightFrame">金币赠送</a><i></i></li>
        <!-- <li><cite></cite><a href="/shi.php/Home/Index/dongjie" target="rightFrame">冻结钱包赠送</a><i></i></li> -->
        <li><cite></cite><a href="/shi.php/Home/Index/team" target="rightFrame">会员关系网</a><i></i></li>
		<li><cite></cite><a href="/shi.php/Home/Index/txlist" target="rightFrame">提现管理</a><i></i></li>
        </ul>    
    </dd>
        
    
   <!-- <dd>
    <div class="title">
    <span><img src="/sncss/images/leftico02.png" /></span>奖金管理
    </div>
    <ul class="menuson">
        <li><cite></cite><a href="#">統計昨日奖金</a><i></i></li>
        <li><cite></cite><a href="#">日分紅和领导奖明细</a><i></i></li>
		<li><cite></cite><a href="#">所有金币明細</a><i></i></li>
		<li><cite></cite><a href="#">所有银币明細</a><i></i></li>
		<li><cite></cite><a href="#">所有钻石币明細</a><i></i></li>
        </ul>     
    </dd> -->
    
    
    <dd><div class="title"><span><img src="/sncss/images/leftico03.png" /></span>文章管理</div>
    <ul class="menuson">

		<li><cite></cite><a href="/shi.php/Home/Shop/zsbyg_list" target="rightFrame">新闻公告</a><i></i></li>
		<li><cite></cite><a href="/shi.php/Home/Shop/zsbyg_list_xg" target="rightFrame">添加内容</a><i></i></li>
		<li><cite></cite><a href="/shi.php/Home/Index/yuanzhugg" target="rightFrame">援助公告</a><i></i></li>
    </ul>    
    </dd>  
    
	
	<dd><div class="title"><span><img src="/sncss/images/leftico03.png" /></span>问题提交</div>
    <ul class="menuson">

		<li><cite></cite><a href="/shi.php/Home/Shop/ly_list/type/0/" target="rightFrame">未处理留言</a><i></i></li>
		<li><cite></cite><a href="/shi.php/Home/Shop/ly_list/type/1/" target="rightFrame">已处理留言</a><i></i></li>
    </ul>    
    </dd>
    <dd><div class="title"><span><img src="/sncss/images/leftico03.png" /></span>任务中心</div>
    <ul class="menuson">
        <li><cite></cite><a href="/shi.php/Home/Index/task" target="rightFrame">任务设置</a><i></i></li>
        <li><cite></cite><a href="/shi.php/Home/Task/ly_list/type/0/" target="rightFrame">未处理任务</a><i></i></li>
        <li><cite></cite><a href="/shi.php/Home/Task/ly_list/type/1/" target="rightFrame">已处理任务</a><i></i></li>
    </ul>    
    </dd>
    
  <dd>
  <div class="title"><span><img src="/sncss/images/leftico04.png" /></span>排单币生成</div>
    <ul class="menuson">
        <li><cite></cite><a href="/shi.php/Home/Index/pin_add" target="rightFrame">生成排单币</a><i></i></li>
		<li><cite></cite><a href="/shi.php/Home/Index/pin_list" target="rightFrame">排单币查看</a><i></i></li>
    </ul>
    
    </dd>   
	 <dd>
	   <div class="title"><span><img src="/sncss/images/leftico04.png" /></span>激活码管理</div>
       <ul class="menuson">
        <li><cite></cite><a href="/shi.php/Home/Index/pai_add" target="rightFrame">生成激活码</a><i></i></li>
		<li><cite></cite><a href="/shi.php/Home/Index/pai_list" target="rightFrame">PIN管理</a><i></i></li>
    </ul>
    
    </dd>   
	
	  <dd><div class="title"><span><img src="/sncss/images/leftico04.png" /></span>系统配置</div>
    <ul class="menuson">
        <li><cite></cite><a href="/shi.php/Home/Index/jjset" target="rightFrame">常规设置</a><i></i></li>
		<li><cite></cite><a href="/shi.php/Home/Index/txset" target="rightFrame">提现设置</a><i></i></li>
        <li><cite></cite><a href="/shi.php/Home/Index/lixi" target="rightFrame">利息配置</a><i></i></li>
        <li><cite></cite><a href="/shi.php/Home/Index/conf" target="rightFrame">新增配置</a><i></i></li>
    </ul>
    
    </dd>   
	
	
	
	  <dd><div class="title"><span><img src="/sncss/images/leftico04.png" /></span>匹配系统</div>
    <ul class="menuson">
        <li><cite></cite><a href="/shi.php/Home/Index/tgbz_list" target="rightFrame">提供帮助</a><i></i></li>
		<li><cite></cite><a href="/shi.php/Home/Index/jsbz_list" target="rightFrame">接受帮助</a><i></i></li>
		<li><cite></cite><a href="/shi.php/Home/Index/ppdd_list" target="rightFrame">交易中的订单</a><i></i></li>
		<li><cite></cite><a href="/shi.php/Home/Index/ppdd_list/cz/1/" target="rightFrame">成功交易订单</a><i></i></li>
		<li><cite></cite><a href="/shi.php/Home/Index/ts1_list" target="rightFrame">到期未打款</a><i></i></li>
		<li><cite></cite><a href="/shi.php/Home/Index/ts3_list" target="rightFrame">未收到款</a><i></i></li>
			 <li><cite></cite><a href="/shi.php/Home/Index/tgbz_list_cf" target="rightFrame">提供拆分</a><i></i></li>
		<li><cite></cite><a href="/shi.php/Home/Index/jsbz_list_cf" target="rightFrame">接受拆分</a><i></i></li>
		
		<!--<li><cite></cite><a href="/shi.php/Home/Index/pin_list" target="rightFrame">PIN管理</a><i></i></li>-->
		<!--<li><cite></cite><a href="/shi.php/Home/Shop/zsbyg_list" target="rightFrame">钻石币云购管理</a><i></i></li>
        <li><cite></cite><a href="#">正能量文章</a><i></i></li>
        <li><cite></cite><a href="#">首页公告</a><i></i></li>-->
    </ul>
    
    </dd>   

	
	
	
	
	  
	<dd><div class="title"><span><img src="/sncss/images/leftico04.png" /></span>数据库管理</div>
    <ul class="menuson">
       <!--<li><cite></cite><a  onClick="javascript:if(!confirm('确认要清理数据表吗？'))  return  false; "  href="/shi.php/Home/Index/clearalldo" target="rightFrame">清理数据表</a><i></i></li>-->
		<li><cite></cite><a href="/shi.php/Home/Baksql/backall" target="rightFrame">备份数据库</a><i></i></li>
    </ul>
    
    </dd>  
	
    
    </dl>
    
</body>
</html>