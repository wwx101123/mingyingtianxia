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
        <li><a href="#">利息配置</a></li>
    </ul>
</div>

<div class="rightinfo">
    <table class="tablelist">
        <form action="<?php echo U('Home/Index/lixi');?>" method="post">
            <thead>
            <tr>
                <th width="15%">日利息</th>
                <th width="85%"><input name="lixi" value="<?php echo C('lixi');?>" type="text"/>%</th>
            </tr>
            <tr>
                <th width="15%">分期几天</th>
                <th width="85%"><input name="fenqiday" value="<?php echo C('fenqiday');?>" type="text"/>天</th>
            </tr>
            <tr>
                <th width="15%">每天，提取本息</th>
                <th width="85%"><input name="daybenxi" value="<?php echo C('daybenxi');?>" type="text"/>次</th>
            </tr>
            <tr>
                <th width="15%">每月，提取本息</th>
                <th width="85%"><input name="monthbenxi" value="<?php echo C('monthbenxi');?>" type="text"/>次</th>
            </tr>
            <tr>
                <th width="15%">复投不得低于上次排金额的</th>
                <th width="85%"><input name="futou" value="<?php echo C('futou');?>" type="text"/>%</th>
            </tr>
            <tr>
                <th>提前打款多少小时</th>
                <th><input name="tiqian_time" value="<?php echo ($tiqian_time); ?>" type="number"/>小时</th>
            </tr>
            <tr>
                <th>提前打款多少小时奖励本金的%</th>
                <th><input name="tiqian_lx" value="<?php echo ($tiqian_lx); ?>" type="number"/>%</th>
            </tr>
            <tr>
                <th></th>
                <th><input name="submit" value="提交" type="submit"/></th>
            </tr>
            </thead>
        </form>
    </table>

</div>
</body>
</html>