<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>定时器</title>

<script type="text/javascript" src="/Public/Regular/js/jquery.js"></script>
<script type="text/javascript" src="/Public/Regular/js/time_js.js"></script>

<link type="text/css" rel="stylesheet" href="/Public/Regular/css/time_css.css" />

</head>

<body>

<div class="game_time">

	<div class="hold">
		<div class="pie pie1"></div>
	</div>

	<div class="hold">
		<div class="pie pie2"></div>
	</div>

	<div class="bg"> </div>

	<div class="time"></div>

</div>

<script type="text/javascript">
countDown();
</script>

</body>
</html>