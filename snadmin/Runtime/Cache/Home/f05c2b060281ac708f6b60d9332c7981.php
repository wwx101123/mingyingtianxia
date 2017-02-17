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
        <li><a href="#">任务设置</a></li>
    </ul>
</div>
<div class="rightinfo">
    <table class="tablelist">
        <form action="<?php echo U('Home/Index/task');?>" method="post">
            <thead>
            <tr>
                <th width="15%">任务中心</th>
                <th width="85%">
                    <label><input type="radio" name="taskOn" value="1" <?php if(($taskOn) == "1"): ?>checked<?php endif; ?>/>开启</label>
                    <label><input type="radio" name="taskOn" value="0" <?php if(($taskOn) == "0"): ?>checked<?php endif; ?>/>关闭</label>
                </th>
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