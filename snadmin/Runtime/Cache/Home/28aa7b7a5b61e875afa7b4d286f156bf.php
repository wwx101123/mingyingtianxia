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
    <script type="text/javascript">
function MM_popupMsg(msg) { //v1.0
  alert(msg);
}
    </script>
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
        <li><a href="#">常规设置</a></li>
    </ul>
</div>
<style>
table{border-bottom:#ddd solid 1px;border-right:#ddd solid 1px;}
table th{border-top:#ddd solid 1px;border-left:#ddd solid 1px;padding:5px;text-align:left;line-height:35px;}
table input{border:#aaa solid 1px;padding:0 3px;}
select{border:#aaa solid 1px;padding:3px;}
</style>
<div class="rightinfo">
    <table width="100%">
        <form action="<?php echo U('Home/Index/jjset');?>" method="post">
            <thead>
            <tr>
              <th>系统网址</th>
              <th><input name="web_url" value="<?php echo ($web_url); ?>" type="text" /></th>
            </tr>
            <tr>
                <th width="15%">排单是否需要排币</th>
                <th width="85%">
                    <select name="ispdb">
                        <option value="1" <?php if(C('ispdb')): ?>selected<?php endif; ?>>启用</option>
                        <option value="0" <?php if(!C('ispdb')): ?>selected<?php endif; ?>>关闭</option>
                    </select>
                </th>
            </tr>
            <tr>
                <th width="15%">是否开启冻结钱包</th>
                <th width="85%">
                    <select name="isdongjie">
                        <option value="1" <?php if(C('isdongjie')): ?>selected<?php endif; ?>>启用</option>
                        <option value="0" <?php if(!C('isdongjie')): ?>selected<?php endif; ?>>关闭</option>
                    </select>

                    释放比例<input name="sfbl" value="<?php echo C('sfbl');?>" type="" />%

                </th>
            </tr>
            <tr>
                <th width="15%">是否开户用户注册</th>
                <th width="85%">
                    <select name="isreg">
                        <option value="1" <?php if(C('isreg')): ?>selected<?php endif; ?>>启用</option>
                        <option value="0" <?php if(!C('isreg')): ?>selected<?php endif; ?>>关闭</option>
                    </select>
                    是否开启手机验证
                    <select name="phonecheck">
                        <option value="1" <?php if(C('phonecheck')): ?>selected<?php endif; ?>>启用</option>
                        <option value="0" <?php if(!C('phonecheck')): ?>selected<?php endif; ?>>关闭</option>
                    </select>
                </th>
            </tr>
            <tr>
                <th width="15%">仅需互助</th>
                <th width="85%"><input name="jj01s" value="<?php echo ($jj01s); ?>" type="" />元 — <input name="jj01m" value="<?php echo ($jj01m); ?>" type="" />元 必须<input name="jj01" value="<?php echo ($jj01); ?>" type="" />元的整倍数</th>
            </tr>
            <tr>
                <th width="15%">提供帮助</th>
                <th width="85%">
                    排单限制 <input name="tgxz" value="<?php echo C('tgxz');?>" type="text" size="50"/>多个以“,”分开 — 自动拆分次数 <input name="tgcf" value="<?php echo C('tgcf');?>" type="text" size="50"/>
                </th>
            </tr>
            <tr>
                <th width="15%">新用户注册奖励</th>
                <th width="85%">
                    <input name="reg_jiangli" value="<?php echo ($reg_jiangli); ?>" type="number" />元
                     冻结<input name="reg_jiangli_dongjie" value="<?php echo C('reg_jiangli_dongjie');?>" type="number" />天
                </th>
            </tr>
            <tr>
                <th width="15%">提现冻结天数</th>
                <th width="85%"><input name="jjdjdays" value="<?php echo ($jjdjdays); ?>" type="number" />天</th>
            </tr>
            <tr>
                <th width="15%">刚注册用户提供帮助冻结天数</th>
                <th width="85%"><input name="reg_days" value="<?php echo ($reg_days); ?>" type="number" />天&nbsp;&nbsp;(0表示不冻结，已注册就可以提供帮助，1表示注册一天后，才可以提供帮助，等其他操作)</th>
            </tr>
            <tr>
                <th width="15%">用户提供帮助最多允许等待匹配单数</th>
                <th width="85%">
                    <input name="oneByone" value="<?php echo ($oneByone); ?>" type="number" />单&nbsp;&nbsp;(用户提供帮助最多允许等待匹配单数，0表示无限制，1表示只能等待1单)
                </th>
            </tr>
            <tr>
                <th width="15%">用户提供帮助配对之后最多允许等待交易单数</th>
                <th width="85%">
                    <input name="peidui" value="<?php echo ($peidui); ?>" type="number" />单&nbsp;&nbsp;(用户提供帮助配对之后最多允许等待交易完成单数，0表示无限制，1表示只能等待1单)
                </th>
            </tr>
            <tr>
                <th width="15%">每天提供帮助排单开始时间</th>
                <th width="85%"><input  name="paidan_time_start"  placeholder="请输入开始时间" value="<?php echo ($paidan_time_start); ?>">(格式：9:59,23:59,9:4不要输9:04)</th>
            </tr>
            <tr>
                <th width="15%">每天提供帮助排单结束时间</th>
                <th width="85%"><input  name="paidan_time_end"  placeholder="请输入结束时间" value="<?php echo ($paidan_time_end); ?>">(格式：9:59,23:59,9:4不要输9:04)</th>
            </tr>
            <tr>
                <th width="15%">是否开启时间限制</th>
                <th width="85%">
                    <select name="time_limit">
                        <option <?php if($time_limit == 1): ?>selected<?php endif; ?> value="1">开启</option>
                        <option <?php if($time_limit == 0): ?>selected<?php endif; ?> value="0">关闭</option>
                    </select>
                </th>
            </tr>
            <tr>
                <th width="15%">定时自动匹配</th>
                <th width="85%"><input  name="zidongpipei"  placeholder="定时自动匹配" value="<?php echo ($zidongpipei); ?>">小时&nbsp;&nbsp;(设置以后，当提供帮助时间超过设置时间时会自动进行匹配)</th>
            </tr>
            <tr>
                <th width="15%">用户每天提供帮助排单数量</th>
                <th width="85%"><input  name="paidan_num"  placeholder="用户每天排单数量" value="<?php echo ($paidan_num); ?>">单</th>
            </tr>
            <tr>
                <th width="15%">每发展一个直推增加额度</th>
                <th width="85%"><input  name="zhiti_tianjia"  placeholder="直推增加额度" value="<?php echo ($zhiti_tianjia); ?>">元</th>
            </tr>
            <tr>
                <th width="15%">每天用户提供帮助排单总额度</th>
                <th width="85%"><input  name="paidan_jbs"  placeholder="用户每天排单总额度" value="<?php echo ($paidan_jbs); ?>">元</th>
            </tr>
            <tr>
                <th width="15%">用户提供帮助月投资额度封顶</th>
                <th width="85%"><input name="month_max" value="<?php echo ($month_max); ?>" type="number" />元</th>
            </tr>
            <tr>
                <th width="15%">直推奖</th>
                <th width="85%">
                    <input name="zhituijiang" value="<?php echo C('zhituijiang');?>" type="number" />
                    冻结<input name="zhituijiang_dongjie" value="<?php echo C('zhituijiang_dongjie');?>" type="number" />天
                </th>
            </tr>
            <tr>
                <th width="15%">等级1515151515与动态奖</th>
                <th width="85%">
                    B0 刚注册会员 <br />

                    B1 打完第一笔款即升级，可拿1代奖<input type="text" size="5" name="lv1_1" value="<?php echo C('lv1_1');?>"/>% <br />

                    B2 培养<input type="text" size="5" name="uplv2" value="<?php echo C( 'uplv2');?>">个B1，可拿1代<input type="text" size="5" name="lv2_1" value="<?php echo C('lv2_1');?>"/>%，2代<input type="text" size="5" name="lv2_2" value="<?php echo C('lv2_2');?>"/>% <br />

                    B3 培养<input type="text" size="5" name="uplv3" value="<?php echo C( 'uplv3');?>"/>个B1，可拿1代<input type="text" size="5" name="lv3_1" value="<?php echo C('lv3_1');?>"/>%，2代<input type="text" size="5" name="lv3_2" value="<?php echo C('lv3_2');?>"/>%，3代<input type="text" size="5" name="lv3_3" value="<?php echo C('lv3_3');?>"/>% <br />

                    B4 培养<input type="text" size="5" name="uplv4" value="<?php echo C( 'uplv4');?>"/>个B3，可拿1代<input type="text" size="5" name="lv4_1" value="<?php echo C('lv4_1');?>"/>%，2代<input type="text" size="5" name="lv4_2" value="<?php echo C('lv4_2');?>"/>%，3代<input type="text" size="5" name="lv4_3" value="<?php echo C('lv4_3');?>"/>%，4代<input type="text" size="5" name="lv4_4" value="<?php echo C('lv4_4');?>"/>% <br />

                    B5 培养<input type="text" size="5" name="uplv5" value="<?php echo C( 'uplv5');?>"/>个B4，可拿1代<input type="text" size="5" name="lv5_1" value="<?php echo C('lv5_1');?>"/>%，2代<input type="text" size="5" name="lv5_2" value="<?php echo C('lv5_2');?>"/>%，3代<input type="text" size="5" name="lv5_3" value="<?php echo C('lv5_3');?>"/>%，4代<input type="text" size="5" name="lv5_4" value="<?php echo C('lv5_4');?>"/>% <br />

                    B6 培养<input type="text" size="5" name="uplv6" value="<?php echo C( 'uplv6');?>"/>个B5，可拿1代<input type="text" size="5" name="lv6_1" value="<?php echo C('lv6_1');?>"/>%，2代<input type="text" size="5" name="lv6_2" value="<?php echo C('lv6_2');?>"/>%，3代<input type="text" size="5" name="lv6_3" value="<?php echo C('lv6_3');?>"/>%，4代<input type="text" size="5" name="lv6_4" value="<?php echo C('lv6_4');?>"/>% <br />

                    经理 培养<input type="text" size="5" name="uplv7" value="<?php echo C( 'uplv7');?>"/>个B1，可拿1代<input type="text" size="5" name="lv7_1" value="<?php echo C('lv7_1');?>"/>%，2代<input type="text" size="5" name="lv7_2" value="<?php echo C('lv7_2');?>"/>%，3代<input type="text" size="5" name="lv7_3" value="<?php echo C('lv7_3');?>"/>%，无限代<input type="text" size="5" name="lv7_4" value="<?php echo C('lv7_4');?>"/>% <br />

                    冻结 <input type="text" name="dtlock" value="<?php echo C('dtlock');?>" size="5"> 天<br />
                </th>
            </tr>
            <tr>
                <th width="15%">团队奖</th>
                <th width="85%">
                    节点 <input type="text" name="tdnode" value="<?php echo C('tdnode');?>" size="100"> 人 多个以“,”隔开<br />
                    奖金 <input type="text" name="tdfee" value="<?php echo C('tdfee');?>" size="100"> 元 多个以“,”隔开<br />
                    冻结 <input type="text" name="tdlock" value="<?php echo C('tdlock');?>" size="5"> 天<br />
                </th>
            </tr>
            <!-- <tr>
                <th width="15%">开启会员级别奖励</th>
                <th width="85%">
					<select name="jjaccountflag">
						<option <?php if($jjaccountflag == 1): ?>selected<?php endif; ?> value="1">开启</option>
						<option <?php if($jjaccountflag == 0): ?>selected<?php endif; ?> value="0">关闭</option>
					</select>
				</th>
            </tr>

            <tr>
                <th width="15%">会员级别奖金比率</th>
                <th width="85%"><input name="jjaccountrate" value="<?php echo ($jjaccountrate); ?>" style="width:300px;" type="" />% 用,号分隔</th>
            </tr> -->
            <tr>
                <th width="15%">打款时间</th>
                <th width="85%"><input name="jjdktime" value="<?php echo ($jjdktime); ?>" type="number" />小时</th>
            </tr>
             <tr>
                <th width="15%">超时未打款冻结提示语</th>
                <th width="85%"><input name="jjhydjmsg" value="<?php echo ($jjhydjmsg); ?>" type="text" size="100"/></th>
            </tr>
             <!-- <tr>
                <th width="15%">超时未打款扣除上级金额</th>
                <th width="85%"><input name="jjhydjkcsjmoeney" value="<?php echo ($jjhydjkcsjmoeney); ?>" type="number" />元</th>
            </tr> -->

             <tr>
                <th width="15%">短信接口账号</th>
                <th width="85%"><input name="mobile_account" value="<?php echo ($mobile_account); ?>" type="text" /></th>
            </tr>

            <tr>
                <th width="15%">短信接口密码</th>
                <th width="85%"><input name="mobile_password" value="<?php echo ($mobile_password); ?>" type="text" /></th>
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