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




    </div>
    <br><br>
    <?php if($pipeits == 0 ): else: ?>


<div class="tg">
   <div style="float:left; width:5%;font-size:30px;padding-top:10px;text-align:center;">&nbsp;</div>
<div style="float:left;width:45%;">
            <div style="padding:0 10px; text-align:center;font-size:24px;">
            	提供帮助

                <table class="tablelist">
    	<thead>
    	<tr>
        <th>编号</th>
        <th>提供会员</th>
        <th>提供金额</th>
        <th>提供昵称</th>
		<th>提供时间</th>
        </tr>
        </thead></table>
            </div>
            </div>
             <div style="float:left; width:5%;font-size:30px;padding-top:10px;text-align:center;">&nbsp;</div>
            <div style="float:left;width:45%;">
            <div style="padding: 0 10px; text-align:center;font-size:24px;">
            	接受帮助

                 <table class="tablelist">
    	<thead>
    	<tr>
        <th>编号</th>
        <th>提现会员</th>
        <th>提现金额</th>
        <th>提现昵称</th>
		<th>提现时间</th>
        </tr>
        </thead>
        </table>
            </div>
            </div>
</div>


    <?php if(is_array($list)): foreach($list as $key=>$v): ?><div class="tg">

        <div style="float:left; width:5%;font-size:30px;padding-top:10px;text-align:center;"><?php echo ($v["index"]); ?>组</div>
        	<div style="float:left;width:45%;">
            <div style="padding:10px;">
            <table class="tablelist">

        <tbody>
		<?php if(is_array($v["tgbz"])): foreach($v["tgbz"] as $key=>$b): ?><tr>
		 <td><?php echo ($b["id"]); ?></td>
		 <td><?php echo ($b["user"]); ?> - <?php echo ($b["jb5"]); ?></td>
		   <td><?php echo ($b["jb"]); ?>  <?php if($b["jb2"] == 0 ): else: ?>剩余 <?php echo ($b["jb2"]); endif; ?></td>

        <td><?php echo ($b["user_nc"]); ?></td>
        <td><?php echo ($b["date"]); ?></td>
        </tr><?php endforeach; endif; ?>


        </tbody>
    </table>
    </div></div>

    <div style="float:left; width:5%;font-size:40px;padding-top:10px;">=></div>
            <div style="float:left; width:45%;">
                <div style="padding:10px;">
            <table class="tablelist">
        <tbody>
		<?php if(is_array($v["jsbz"])): foreach($v["jsbz"] as $key=>$b): ?><tr>
		 <td><?php echo ($b["id"]); ?></td>
		 <td><?php echo ($b["user"]); ?> - <?php echo ($b["jb5"]); ?></td>
		   <td><?php echo ($b["jb"]); ?> <?php if($b["jb2"] == 0 ): else: ?> 剩余 <?php echo ($b["jb2"]); endif; ?></td>

        <td><?php echo ($b["user_nc"]); ?></td>
        <td><?php echo ($b["date"]); ?></td>
        </tr><?php endforeach; endif; ?>
        </tbody>
    </table>
    </div></div>

            <div style="clear:both;"></div>
        </div>

        <hr style="border-bottom:3px solid #ddd;"><?php endforeach; endif; endif; ?>

           <div class="rightinfo" style="text-align:center;line-height:50px;">
    <?php if($pipeits == 0 ): ?><b style="font-size:16px;">现在没有可匹配的 </b>
     <?php else: ?>
    	<b style="font-size:16px;">可匹配 <?php echo ($pipeits); ?> 条  	<input name="" onclick="location.href='/shi.php/Home/Index/zdpp_cl/all/all'" type="submit" class="btn" value="确认匹配"/></b><?php endif; ?>

    <div>
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