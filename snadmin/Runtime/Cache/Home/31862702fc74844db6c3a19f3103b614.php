<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>无标题文档</title>
    <link href="/sncss/css/style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="/zTree_v3/css/zTreeStyle/zTreeStyle.css" type="text/css"/>
    <script type=text/javascript src="/zTree_v3/js/jquery.min.js"></script>
    <script type="text/javascript" src="/zTree_v3/js/jquery.ztree.core-3.5.js"></script>

</head>
<style>
    input {
        border: 1px #cccccc solid;
        height: 25px;
        line-height: 25px;
    }
</style>
<body>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
        <li><a href="#">匹配系统</a></li>
        <li><a href="#">新增配置</a></li>
    </ul>
</div>
<style>
.input{border:#ddd solid 1px;margin:5px;width:500px;height:80px;}
</style>
<div class="rightinfo">
    <table class="tablelist">
        <form action="<?php echo U('Home/Index/conf');?>" method="post">
            <tr>
                <th>前台抢单开启关闭</th>
                <th><input name="qiang" value="<?php echo ($qiang); ?>" type="text"/>开启填写开启，关闭填写关闭，填写其他无效。</th>
            </tr>
            <tr>
                <th width="15%">新用户</th>
                <th width="85%">
                必需在<input name="xyhpdtime" value="<?php echo ($xyhpdtime); ?>" type="text"/>小时内排单，否则封号
                </th>
            </tr>
            <tr>
                <th>提现后</th>
                <th><input name="txpdtime" value="<?php echo ($txpdtime); ?>" type="text"/>小时内必需排单，否则封号</th>
            </tr>
             <tr>
                <th>未打款</th>
                <th>扣除推荐人奖金<input name="jine" value="<?php echo ($jine); ?>" type="text"/>元</th>
            </tr>
            <tr>
                <th>系统公告</th>
                <th>
                <textarea name="gonggao" class="input" ><?php echo C('gonggao');?></textarea>
                没有则前台不显示
                </th>
            </tr>
            <tr>
                <th></th>
                <th><input name="submit" value="提交" type="submit"/></th>
            </tr>
        </form>
    </table>

</div>
</body>
</html>