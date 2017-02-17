<?php
namespace Home\Controller;

use Think\Controller;

class CommonController extends Controller {

	public function _initialize() {

		header("Content-Type:text/html; charset=utf-8");

		$zt=M('system')->where(array('SYS_ID'=>1))->find();

		if($zt['zt']<>0){
			$this->error('系统升级中,请稍后访问!','/Home/Login/index');die;
		}

		//推广链接
		$tgurl = "http://" . $_SERVER["HTTP_HOST"] . u("Reg/index", array("uname" => $_SESSION['uname']));
		$this->tgurl = $tgurl;

        $czmcsy = CONTROLLER_NAME . ACTION_NAME;

		$czmc = ACTION_NAME;

		//echo $czmcsy;die;

		if($czmcsy<>'Indexindex'){

			if (! isset ( $_SESSION ['uid'] )) {
				$this->redirect ( 'Login/index' );
			}
			$this->checkAdminSession();
		}
		$_SESSION['user_jb'] = 1;

		$userData = M('user')->where(array('UE_ID' => $_SESSION ['uid']))->find();

		if($userData['ue_level']<7){
			AutoUpdate($userData);
		}
		//echo print_r($userData);

		$userData['UE_lastTime'] = date('Y-m-d',strtotime($userData['ue_nowtime']));

		/**团队奖**/
		AutoTeam($userData);

		/**是否新用户，并且未在指定时间排定，冻结帐号**/
		/*
		$times = strtotime($userData['ue_regtime'])+C('xyhpdtime')*3600;

		if($userData['isnew'] && time()>$times){
			M('user')->where(array('UE_ID' => $_SESSION ['uid']))->setField('UE_status',1);
			$userData['ue_status'] = 1;
		}

		// 上次提现时间
		$uptxtime = M('jsbz')->where("user='".$userData['ue_account']."'")->order('id DESC')->getField("date");
		// 上次排单时间

		$uptgtime = M('tgbz')->where("user='".$userData['ue_account']."'")->order('id DESC')->getField("date");
		$uptxtime = strtotime($uptxtime);
		$uptgtime = strtotime($uptgtime);
		$times2 = $uptxtime+C('txpdtime')*3600;

		if($uptxtime>$uptgtime && $times2<time()){
			M('user')->where(array('UE_ID' => $_SESSION ['uid']))->setField('UE_status',1);
			$userData['ue_status'] = 1;
		}
		*/
		if($userData['ue_status']){
			$this->error("您的帐号已被冻结，请联系管理员！",U('Login/login'));
		}

		$this->assign ( 'mm001', C("mm001") );
		$this->assign ( 'mm002', C("mm002") );
		$this->assign ( 'mm003', C("mm003") );
		$this->assign ( 'mm004', C("mm004") );
		$this->assign ( 'mm005', C("mm005") );

		$this->assign ( 'jj01s', C("jj01s") );
		$this->assign ( 'jj01m', C("jj01m") );
		$this->assign ( 'jj01', C("jj01") );
		$this->assign ( 'jjdktime', C("jjdktime") );

		//提现设置
		$this->assign ( 'txthemin', C("txthemin") );
		$this->assign('txthemax',C('txthemax'));
		$this->assign ( 'txthebeishu', C("txthebeishu") );


		$this->assign ( 'jl_start', C("jl_start") );
		$this->assign('jl_e',C('jl_e'));
		$this->assign ( 'jl_beishu', C("jl_beishu") );


		$this->assign ( 'tj_start', C("tj_start") );
		$this->assign('tj_e',C('tj_e'));
		$this->assign ( 'tj_beishu', C("tj_beishu") );

		//获取一个排单币
		$this->code = M('pin')->where("user='".$userData['ue_account']."' AND zt=0")->getField('pin');
		$dates = date("Y-m-d h:i:s",strtotime(date("Y-m-d")));
		$datee = date("Y-m-d h:i:s",strtotime(date("Y-m-d"))+3600*24);
		//$jsinfo = M('jsbz')->where("user='".$_SESSION['uname']."' AND `date` between '{$dates}' AND '{$datee}'")->order("id DESC")->find();

		$this->hzsum = M('user_jj')->where("`user`='".$_SESSION['uname']."' AND `date` between '{$dates}' AND '{$datee}'")->SUM("jb");
		$this->jlsum = M('user_jl')->where("`user`='".$_SESSION['uname']."' AND `date` between '{$dates}' AND '{$datee}'")->SUM("jb");
		$this->tjsum = M('userget')->where("`UG_account`='".$_SESSION['uname']."' AND (`UG_getTime` between '{$dates}' AND '{$datee}') and UG_dataType='tjj'")->SUM("UG_money");
		$this->todaysum =  $this->hzsum + $this->jlsum + $this->tjsum;

		$this->tgbzsum = M('tgbz')->where("`user`='".$_SESSION['uname']."' AND `date` between '{$dates}' AND '{$datee}'")->SUM("jb");
		//$this->tgbz_s_count = M('ppdd')->where("`p_user`='".$_SESSION['uname']."' AND `zt` = 1  AND `date_hk` between '{$dates}' AND '{$datee}'")->COUNT();
		$this->tgbz_n_count= M('ppdd')->where("`p_user`='".$_SESSION['uname']."' AND `zt` = 0 ")->COUNT();

		$this->jsbzsum = M('jsbz')->where("`user`='".$_SESSION['uname']."' AND `date` between '{$dates}' AND '{$datee}'")->SUM("jb");
		//$this->jsbz_s_count = M('ppdd')->where("`g_user`='".$_SESSION['uname']."' AND `zt` = 2 AND `date` between '{$dates}' AND '{$datee}'")->COUNT();
		$this->jsbz_n_count= M('ppdd')->where("`g_user`='".$_SESSION['uname']."' AND `zt` = 1 AND `date` between '{$dates}' AND '{$datee}'")->COUNT();


		$UE_activeTime = $_SESSION['UE_activeTime'];
		if(! empty($UE_activeTime)){
			$NowTime = time();
			$D_Time  = strtotime($UE_activeTime);
			if($NowTime - $D_Time > 1800) $ActiveStatus = true;
		}else{
			$ActiveStatus = true;
		}
		if($ActiveStatus) {
			$UE_activeTime = date('Y-m-d H:i:s',time());
			$_SESSION['UE_activeTime'] = $UE_activeTime;
			//echo $_SESSION['uid'];
			M('user')->where(array('UE_ID' => $_SESSION['uid']))->save(array('UE_activeTime'=>$UE_activeTime));
		}

		$this->userData=$userData;
		$user_name = $_SESSION['uname'];

		//$tjx = M('user_jl')->where(array('user'=>$user_name,'zt'=>1,'ds'=>'0'))->sum('jj');

		//echo M('user_jl')->getLastSql();
		//exit;

		//$ldx = M('user_jl')->where(" ( user = '$user_name' and zt = 1 ) and ( ds ='团队奖' or ds = '动态奖' ) ")->sum('jj');

		$log_user = M('user');
		$log_data = $log_user->where(array('UE_account'=>$user_name))->field('UE_money,UE_tjx,UE_ldx,jl_he,tj_he')->find();
		//获取排单币
		$code_num = M('pin')->where("user='".$userData['ue_account']."' AND zt=0")->count();
		//获取激活码
		$pai_num = M('pai')->where("user='".$userData['ue_account']."' AND zt=0")->count();

		$money = $log_data['ue_money'];
		$tjx = $log_data['tj_he'];
		$ldx = $log_data['jl_he'];
		$this->assign('log_money', $money); // 静态余额
		$this->assign('log_tjx', $tjx); // 推荐奖
		$this->assign('log_ldx', $ldx); // 领导奖
		$this->assign('log_code', $code_num); // 排单币
		$this->assign('log_pai', $pai_num); // 激活码


		$paidan_jbs = C("paidan_jbs");	//每天用户提供帮助排单总额度
		$month_max = C("month_max");	//用户提供帮助月投资额度封顶
		$paidan_num = C("paidan_num");	//用户每天提供帮助排单数量
		$oneByone = C("oneByone");	//用户提供帮助最多允许等待匹配单数
		$tgxz = C("tgxz");	//排单限制 400,600,1000,2000,3000,5000
		$zhiti_tianjia = C("zhiti_tianjia");	//每发展一个直推增加额度



		$this->assign('pai_zong_edu', get_pai_zong_edu()); //
		$this->assign('pai_keyong_edu', get_pai_keyong_edu()); //
	}

	function   _empty(){
        header( " HTTP/1.0  404  Not Found" );
        $this->display('Public:404');
     }



	public function checkAdminSession() {

		//设置超时为10分

		$nowtime = time();

		$s_time = $_SESSION['logintime'];

		if (($nowtime - $s_time) > 3600000) {

		session_unset();

    	session_destroy();

			$this->error('当前用户登录超时，请重新登录', U('/Home/Login/index'));

		} else {

			$_SESSION['logintime'] = $nowtime;

		}

	}



	function check_verify($code) {

		$verify = new \Think\Verify ();

		return $verify->check ( $code );

	}





	public function getTreeBaseInfo($id) {

		if (! $id)

			return;

		$r = M ( "user" )->where ( array (

				'UE_account' => $id

		) )->find ();

		if ($r)

			return array (

					"id" => $r ['ue_account'],

					"pId" => $r ['ue_accname'],

					"name" => $r ['ue_account'] . "[" .sfjhff($r['ue_check']).",". $r ['ue_truename'] . "," . $r ['ue_activetime'] . "]"

			);

		return;

	}



	public function getTreeCount() {

		// if (!$this->uid) {

		// echo json_encode(array("status" => 1));

		// return ;

		// }

		$base = $this->getTreeBaseInfo ( $_SESSION ['uname'] );

		$znote = $this->getTreeInfo ( $_SESSION ['uname'] );

		$znote [] = $base;

		// dump($znote);die;

		/*

		 * $znote = array(array("id" => 1, "pId" => 0, "name"=>"1000001"), array("id" => 2, "pId" => 1, "name"=>"1000002"), array("id" => 3, "pId" => 2, "name"=>"1000003"), array("id" => 5, "pId" => 2, "name"=>"1000003"), array("id" => 4, "pId" => 1, "name"=>"1000004") );

		 */



		return count($znote);

	}




	public function getTreeInfo($id) {







		static $trees = array ();

		$ids = self::get_childs ( $id );

		if (! $ids){

			return $trees;

		}



		$_SESSION['user_jb']++;

		//echo $_SESSION['user_jb'].'<br>';

		foreach ( $ids as $v ) {



			$trees [] = $this->getTreeBaseInfo ( $v );

			$this->getTreeInfo ( $v );



		}

		//if($_SESSION['user_jb']<'10'){





		//



		return $trees;

	}

	public static function get_childs($id) {



		if (! $id)

			return null;



		$childs_id = array ();

		$childs = M ( "user" )->field ( "UE_account" )->where ( array (

				'UE_accName' => $id

		) )->select ();



		foreach ( $childs as $v ) {

			$childs_id [] = $v ['ue_account'];

		}



		if ($childs_id)

			return $childs_id;

		return 0;

	}

	public function getTree() {

		// if (!$this->uid) {

		// echo json_encode(array("status" => 1));

		// return ;

		// }

		$base = $this->getTreeBaseInfo ( $_SESSION ['uname'] );

		$znote = $this->getTreeInfo ( $_SESSION ['uname'] );

		$znote [] = $base;

		// dump($znote);die;

		/*

		 * $znote = array(array("id" => 1, "pId" => 0, "name"=>"1000001"), array("id" => 2, "pId" => 1, "name"=>"1000002"), array("id" => 3, "pId" => 2, "name"=>"1000003"), array("id" => 5, "pId" => 2, "name"=>"1000003"), array("id" => 4, "pId" => 1, "name"=>"1000004") );

		 */



		echo json_encode ( array ("status" => 0,"data" => $znote ) );

	}



	public function getTreeso() {



		if(I('post.user')<>''){



		if(! preg_match ( '/^[a-zA-Z0-9]{6,12}$/', I('post.user') )){



			echo json_encode ( array ("status" => 1,"data" => '用戶名格式不對!' ) );



		}else{



		if(!M('user')->where(array('UE_account'=>I('post.user')))->find()){

			echo json_encode ( array ("status" => 1,"data" => '用戶不存在!' ) );

		}elseif(I('post.user')==$_SESSION ['uname']){

			echo json_encode ( array ("status" => 1,"data" => '用戶名不能填自己!' ) );

		}else{

			 $account = M('user')->where(array('UE_account'=>I('post.user')))->find();

			 $accname = $account['ue_accname'];

			for ($i=1;$i<=30;$i++){

				if($accname== $_SESSION ['uname']){$quanxian = 1;$daishu=$i;break;}

				if($accname== ''){$quanxian = 0;break;}

				$account = M('user')->where(array('UE_account'=>$accname))->find();

				$accname = $account['ue_accname'];

			}

			if($quanxian == 1){

				//echo json_encode ( array ("status" => 2 );

						$base = $this->getTreeBaseInfo ( I('post.user') );

		$znote = $this->getTreeInfo ( I('post.user') );

		$znote [] = $base;

		echo json_encode ( array ("status" => 0,"data" => $znote ,"ds" =>$daishu ) );

			}elseif($quanxian == 0){

				echo json_encode ( array ("status" => 1,"data" => '此會員不在您的線下!' ) );

			}



		}

		}

		}else{



			//echo json_encode ( array ("status" => 0,'nr'=>I('post.user')) );die;

			// if (!$this->uid) {

			// echo json_encode(array("status" => 1));

			// return ;

			// }

			//die;

			$base = $this->getTreeBaseInfo ( $_SESSION ['uname'] );

			$znote = $this->getTreeInfo ($_SESSION ['uname'] );

			$znote [] = $base;

			// dump($znote);die;

			/*

			 * $znote = array(array("id" => 1, "pId" => 0, "name"=>"1000001"), array("id" => 2, "pId" => 1, "name"=>"1000002"), array("id" => 3, "pId" => 2, "name"=>"1000003"), array("id" => 5, "pId" => 2, "name"=>"1000003"), array("id" => 4, "pId" => 1, "name"=>"1000004") );

			*/



			echo json_encode ( array ("status" => 0,"data" => $znote ) );



		}

	}





	public function uploadFace() {



		//if (!$this->isPost()) {

		//	$this->error('页面不存在');

		//}

		//echo 'asdfsaf';die;

		$upload = $this->_upload('Pic');

		$this->ajaxReturn($upload);

	}











	Private function _upload ($path) {

		import('ORG.Net.UploadFile');	//引入ThinkPHP文件上传类

		$obj = new \Think\Upload();	//实例化上传类

		$obj->maxSize = 2000000;	//图片最大上传大小

		$obj->savePath =  $path . '/';	//图片保存路径

		$obj->saveRule = 'uniqid';	//保存文件名

		$obj->uploadReplace = true;	//覆盖同名文件

		$obj->allowExts = array('jpg','jpeg','png','gif');	//允许上传文件的后缀名



		$obj->autoSub = true;	//使用子目录保存文件

		$obj->subType = 'date';	//使用日期为子目录名称

		$obj->dateFormat = 'Y_m';	//使用 年_月 形式

		//$obj->upload();die;

		$info   =   $obj->upload();

		if (!$info) {

			return array('status' => 0, 'msg' => $obj->getErrorMsg());

		} else {

			foreach($info as $file){

				$pic = $file['savepath'].$file['savename'];

			}

			//$pic =  $info[0][savename];

			//echo $pic;die;

			return array(

					'status' => 1,

					'path' => $pic

			);

		}

	}







}