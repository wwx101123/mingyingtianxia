<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="/sncss/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/sncss/js/jquery.js"></script>
<script type="text/javascript" src="/sncss/date/laydate.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $(".click").click(function(){
  $(".tip").fadeIn(200);
  });
  
  $(".tiptop a").click(function(){
  $(".tip").fadeOut(200);
});

  $(".sure").click(function(){
  $(".tip").fadeOut(100);
});

  $(".cancel").click(function(){
  $(".tip").fadeOut(100);
});

});
</script>


</head>


<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">数据表</a></li>
    <li><a href="#">基本内容</a></li>
    </ul>
    </div>
    
    <div class="rightinfo">
    
    <div>
    
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td> <form id="form1" name="form1" method="post" action="/shi.php/Home/Index/tgbz_list">
	 
   <input name="user" type="text" class="dfinput" id="user" />
   <input placeholder="请输入开始日期" class="laydate-icon" name="start" onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
   <input placeholder="请输入结束日期" class="laydate-icon" name="end" onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
	<input name="" type="submit" class="btn" value="确认搜索"/>
    &nbsp;&nbsp;&nbsp;
    <a href="/shi.php/Home/Index/tgbz_list/export/ok/" target="_blank" />导出CSV</a>
      </form></td>
      
    <td align="right"><a href="/shi.php/Home/Index/tgbz_list/cz/0/" style="padding:2px 5px;background:#00CCFF;">未匹配</a> <a href="/shi.php/Home/Index/tgbz_list/cz/1/" style="padding:2px 5px;background:#00CCFF;">已匹配</a> <a  href="/shi.php/Home/Index/zdpp_cl" style="padding:2px 5px;background:#00CCFF;">所有订单自动匹配</a> </td>
  </tr>
  <tr>
    <td>总金额:<?php echo ($z_jgbz); ?> 交易成功:<?php echo ($z_jgbz2); ?> 交易中:<?php echo ($z_jgbz3); ?> 今天挂单金额:<?php echo ($z_jgbz4); ?></td>
    <td align="right">&nbsp;</td>
  </tr>
</table>

    
    </div>
    
    
    <table class="tablelist">
    	<thead>
    	<tr>
        <th>编号<i class="sort"><img src="/sncss/images/px.gif" /></i></th>
        <th>提供会员</th>
        <th>支付方式</th>
        <th>提供金额</th>
        <th>状态</th>
        <th>确认状态</th>
        <th>提供昵称</th>
		    <th>提供时间</th>
		    <th>提供操作</th>
        </tr>
        </thead>
        <tbody>
		
		<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
		 <td><?php echo ($v["id"]); ?> <a onClick="javascript:if(!confirm('确认要删除吗？'))  return  false; " href="/shi.php/Home/Index/tgbz_list_del/id/<?php echo ($v["id"]); ?>" >删除</a></td>
		 <td><?php echo ($v["user"]); ?></td>
		  <td>
		  <?php if($v["zffs1"] == 1): ?>银行<?php endif; ?>
		  <?php if($v["zffs2"] == 1): ?>支付宝<?php endif; ?>
		  <?php if($v["zffs3"] == 1): ?>微信<?php endif; ?>
		  </td>
		   <td><?php echo ($v["jb"]); ?></td>
		    <td>
            <?php if($v["zt"] == -1): ?>冻结中<?php endif; ?>
            <?php if($v["zt"] == 0): ?>等待中<?php endif; ?>
			<?php if($v["zt"] == 1): ?>匹配成功<?php endif; ?></td>
        
        <td>
		
		<?php if($v["qr_zt"] == 0): ?>未确认<?php endif; ?>
											<?php if($v["qr_zt"] == 1): ?>已确认<?php endif; ?>
		</td>
        <td><?php echo ($v["user_nc"]); ?></td>
        <td><?php echo ($v["date"]); ?></td>
        <td>
          <?php if($v["zt"] == 0): ?><a href="javascript:void(0)" onclick="chaifen(<?php echo ($v["id"]); ?>)">快速拆分</a>
         
            <?php if( $v["pdend"] < time() ): ?><a href="/shi.php/Home/Index/tgbz_list_sd/id/<?php echo ($v["id"]); ?>/">手动匹配</a><?php endif; endif; ?>
        </td>
        </tr><?php endforeach; endif; ?>
        </tbody>
    </table>
<script>
function chaifen(id){
  var str =  window.prompt("输入拆分份数","10");
  if(str && !isNaN(str)){
    location.href="/shi.php/Home/Index/tgchaifen/id/"+id+"/num/"+str;
  }
}
</script>
    <style>.pages a,.pages span {
    display:inline-block;
    padding:2px 5px;
    margin:0 1px;
    border:1px solid #f0f0f0;
    -webkit-border-radius:3px;
    -moz-border-radius:3px;
    border-radius:3px;
}
.pages a,.pages li {
    display:inline-block;
    list-style: none;
    text-decoration:none; color:#58A0D3;
}
.pages a.first,.pages a.prev,.pages a.next,.pages a.end{
    margin:0;
}
.pages a:hover{
    border-color:#50A8E6;
}
.pages span.current{
    background:#50A8E6;
    color:#FFF;
    font-weight:700;
    border-color:#50A8E6;
}</style>
   
   <div class="pages"><br />

                        <div align="right"><?php echo ($page); ?>
                        </div>
   </div>
    
    
    <div class="tip">
    	<div class="tiptop"><span>提示信息</span><a></a></div>
        
      <div class="tipinfo">
        <span><img src="images/ticon.png" /></span>
        <div class="tipright">
        <p>是否确认对信息的修改 ？</p>
        <cite>如果是请点击确定按钮 ，否则请点取消。</cite>
        </div>
      </div>
        
        <div class="tipbtn">
        <input name="" type="button"  class="sure" value="确定" />&nbsp;
        <input name="" type="button"  class="cancel" value="取消" />
        </div>
    
    </div>
    
    
    
    
    </div>
    
    <script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>

</body>

</html>