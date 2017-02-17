<?php

namespace Home\Controller;

use Think\Controller;

class IndexController extends CommonController {

	// 首页
	public function index() {
		$this->redirect('/Home/Index/home');
	}

  public function uploadify()
    {
        if (!empty($_FILES)) {

            //图片上传设置
            $config = array(
                'maxSize'    =>    3145728,
                'savePath'   =>    '',
                'saveName'   =>    array('uniqid',''),
                'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
                'autoSub'    =>    true,
                'subName'    =>    array('date','Ymd'),
            );
            $upload = new \Think\Upload($config);// 实例化上传类
            $images = $upload->upload();
            //判断是否有图
            if($images){
                $info=$images['Filedata']['savepath'].$images['Filedata']['savename'];
                //返回文件地址和名给JS作回调用
                echo $info;
            }
            else{
                //$this->error($upload->getError());//获取失败信息
            }
        }
    }


 public function english(){
 	$this->error('由于你未在该国。暂时无法提供该类服务!，对此我们感到很抱歉');
 }



 public function korea(){
 	$this->error('由于你未在该国。暂时无法提供该类服务!，对此我们感到很抱歉');
 }


public function home() {

		//自动匹配

		tgbz_automatch();
		/*print_r($tgbz_automatch_list);
		exit;*/

		//////////////////----------
		$User = M ( 'tgbz' ); // 实例化User对象

		$map = array();
		$map['user']=$_SESSION['uname'];
		$count = $User->where ( $map )->count (); // 查询满足要求的总记录数
		//$page = new \Think\Page ( $count, 3 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

		$p = getpage($count,100);

		$tlist = $User->field('*,sum(jb) jb,sum(qr_zt) status,count(id) num')->where($map)->order('id DESC')->group('date')->limit ($p->firstRow,$p->listRows)->select();
		//echo $User->getLastsql();
		$this->assign ( 'tlist', $tlist ); // 赋值数据集
		$this->assign ( 'page', $p->show() ); // 赋值分页输出
		/////////////////----------------




		//////////////////----------
		$User = M ( 'jsbz' ); // 实例化User对象
		$map1['user']=$_SESSION['uname'];
		$count1 = $User->where ( $map1 )->count (); // 查询满足要求的总记录数
		//$page = new \Think\Page ( $count, 3 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

		$p1 = getpage($count1,100);

		$jlist = $User->where ( $map1 )->order ( 'id DESC' )->limit ( $p1->firstRow, $p1->listRows )->select ();

		$this->assign ( 'jlist', $jlist ); // 赋值数据集
		$this->assign ( 'page1', $p1->show() ); // 赋值分页输出
		/////////////////----------------


		//推广链接
		$userInfo = $User->where ( $map )->find();
		$tgurl = "http://" . $_SERVER["HTTP_HOST"] . u("Reg/index", array("uname" => $map1['user']));
		$this->tgurl = $tgurl;
		//////////////////----------
		$User = M ( 'ppdd' ); // 实例化User对象
		$order_show = I ( 'get.order_show' );
		$order_show = empty($order_show)?0:1;
		if($order_show==1){
			$map2['zt'] = array('neq',2);
			$this->assign ( 'order_show', 0 );
		}else{
			$this->assign ( 'order_show', 1 );
		}
		$map2['p_user']=$_SESSION['uname'];
		$count2 = $User->where ( $map2 )->count (); // 查询满足要求的总记录数
		//$page = new \Think\Page ( $count, 3 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

		$p2 = getpage($count2,100);

		$plist = $User->where ( $map2 )->order ( 'id DESC' )->limit ( $p2->firstRow, $p2->listRows )->select ();
		//$plist = array_merge($plist,$plist,$plist);
		$this->assign ( 'plist', $plist ); // 赋值数据集
		$this->assign ( 'page2', $p2->show() ); // 赋值分页输出
		/////////////////----------------


        //现有单子分配操作
        $jieshou=M('jsbz');

        $jsbzss=$jieshou->where('qd=1 and qdo=0')->limit(50)->select();

        $qiang=C("qiang");
        $this->assign('qiang',$qiang);

        $this->assign('jsbzss',$jsbzss);






		//////////////////----------
		$User = M ( 'ppdd' ); // 实例化User对象
		if($order_show==1){
			$map3['zt'] = array('neq',2);
		}
		$map3['g_user']=$_SESSION['uname'];
		$count3 = $User->where ( $map3 )->count (); // 查询满足要求的总记录数
		//$page = new \Think\Page ( $count, 3 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

		$p3 = getpage($count3,100);

		$list3 = $User->where ( $map3 )->order ( 'id DESC' )->limit ( $p3->firstRow, $p3->listRows )->select ();
		$this->assign ( 'glist', $list3 ); // 赋值数据集
		$this->assign ( 'page3', $p3->show() ); // 赋值分页输出
		/////////////////----------------

		//////////////////----------
		$tgbz = M("tgbz");
   		$result = $tgbz->where(array("user" => $_SESSION['uname'], "zt" => 0))->order('id DESC')->select();
    	$this->v_list = $result;
		$User = M('user_jj'); // 實例化User對象

		$map4['user'] = $_SESSION['uname'];
		$count4 = $User->where($map4)->count(); // 查詢滿足要求的總記錄數
		//$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)
		$p4 = getpage($count1, 10);

		$list4 = $User->where($map4)->order('r_id Asc')->limit($p4->firstRow, $p4->listRows)->select();
		$Num=0;
		$list_r = $User->where($map4)->order('r_id Desc')->limit(0, 1)->select();
		$Rid  = $list_r[0]['r_id'];
		$ppdd = M('ppdd')->where(array('id'=>$Rid))->find();
		$Pid  = $ppdd['p_id'];
		if(! empty($ppdd['old_pid'])) $Pid  = $ppdd['old_pid'];
		foreach($list4 as &$rs){
			$Num++;
			$rs['tx_zt']=1;
			$ppdd = M('ppdd')->where(array('id'=>$rs['r_id']))->find();
			if($Pid==$ppdd['p_id']) $rs['tx_zt']=0;
			if(! empty($ppdd['old_pid'])){
				 if($Pid==$ppdd['old_pid']) $rs['tx_zt']=0;
			}
			if($count1==$Num) $rs['tx_zt']=0;
		}



		$this->assign('list4', $list4); // 賦值數據集
		$this->assign('page4', $p4->show()); // 賦值分頁輸出

		$this->display ( 'home' );
	}






    public function qdid(){       //前台抢单功能

        $data = I('post.');
        $id=$data['id'];

        $jie=M('jsbz');
        $jieshou=$jie->where('id='.$id)->find();    //接收帮助人信息

        if($jieshou['qdo']==1){
         $this->success('您手慢了一步，单子已经被抢啦，请看看其他的吧！');
         exit();
        }



        $user=session('uname');
        $tgbb=M('tgbz');
        $map['user']=$user;
        $t=$tgbb->where($map)->select();  //提供帮助人信息



        $tigong=array();

        foreach ($t as $key=>$v) {

            $tigong[$key]['id']=$v['id'];
            $tigong[$key]['jb']=$v['jb'];


            if ($v['user'] == $jieshou['user']) {    //判断需要帮助的人是否是自己
                    $sfxd = '1';
                    break;
                } else {
                    $sfxd = '0';
                }
        }

        $count=count($t);
        $da=array();

        $num=0;
        $jjbb=0;


        for ($i=0;$i<$count;$i++){  //取出所有符合条件的金币

            $da[] = $tigong[$i]['id'];
            $da[] = $tigong[$i]['jb'];

            if($i==($count-1)){

             $num=$tigong[$i]['id'];
             $jjbb=$tigong[$i]['jb'];

            }
        }


        if(C("qiang")=='关闭'){
        $this->success('抢单功能已经关闭，请您随时留意网站公告等待开启。');
             exit();

        }


        $jibi=M('tgbz')->where('id='.$num)->find();

         if($jieshou['jb']!=$jibi['jb']){

              $this->success('您拍下的单金额与您提供帮助列表金额不符合');
              exit();
         }


        if ($jieshou['user']==$user) {
        	$this->success('用户名重复，您不能抢自己的单子');
        	exit();
        }


             $db=M();
             $db->execute("update rrhbt2t8888_jsbz set qdo=1 where id=".$id);


          if (ppdd_add($num,$id)) {


              M('tgbz')->where('id='.$num)->delete();

              M('tgbz')->where('id='.$num)->setInc('cf_ds');

                  //把提供帮助还有接收帮助人的信息提交到ppdd表里
              $this->success('抢单匹配成功');
          }



    }









	public function jingli(){
		//////////////////----------
		$User = M ( 'tgbz' ); // 实例化User对象

		$map['user']=$_SESSION['uname'];
		$count = $User->where ( $map )->count (); // 查询满足要求的总记录数
		//$page = new \Think\Page ( $count, 3 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

		$p = getpage($count,100);

		$tlist = $User->where ( $map )->order ( 'id DESC' )->limit ( $p->firstRow, $p->listRows )->select ();
		$this->assign ( 'tlist', $tlist ); // 赋值数据集
		$this->assign ( 'page', $p->show() ); // 赋值分页输出
		/////////////////----------------




		//////////////////----------
		$User = M ( 'jsbz' ); // 实例化User对象

		$map1['user']=$_SESSION['uname'];
		$count1 = $User->where ( $map1 )->count (); // 查询满足要求的总记录数
		//$page = new \Think\Page ( $count, 3 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

		$p1 = getpage($count1,100);

		$jlist = $User->where ( $map1 )->order ( 'id DESC' )->limit ( $p1->firstRow, $p1->listRows )->select ();
		$this->assign ( 'jlist', $jlist ); // 赋值数据集
		$this->assign ( 'page1', $p1->show() ); // 赋值分页输出
		/////////////////----------------


		//推广链接
		$userInfo = $User->where ( $map )->find();
		$tgurl = "http://" . $_SERVER["HTTP_HOST"] . u("Reg/index", array("uname" => $map1['user']));
		$this->tgurl = $tgurl;
		//////////////////----------
		$User = M ( 'ppdd' ); // 实例化User对象

		$map2['p_user']=$_SESSION['uname'];
		$count2 = $User->where ( $map2 )->count (); // 查询满足要求的总记录数
		//$page = new \Think\Page ( $count, 3 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

		$p2 = getpage($count2,100);

		$plist = $User->where ( $map2 )->order ( 'id DESC' )->limit ( $p2->firstRow, $p2->listRows )->select ();
		$this->assign ( 'plist', $plist ); // 赋值数据集
		$this->assign ( 'page2', $p2->show() ); // 赋值分页输出
		/////////////////----------------


		//////////////////----------
		$User = M ( 'ppdd' ); // 实例化User对象

		$map3['g_user']=$_SESSION['uname'];
		$count3 = $User->where ( $map3 )->count (); // 查询满足要求的总记录数
		//$page = new \Think\Page ( $count, 3 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

		$p3 = getpage($count3,100);

		$list3 = $User->where ( $map3 )->order ( 'id DESC' )->limit ( $p3->firstRow, $p3->listRows )->select ();
		$this->assign ( 'glist', $list3 ); // 赋值数据集
		$this->assign ( 'page3', $p3->show() ); // 赋值分页输出
		/////////////////----------------

		$this->display ( 'jingli' );

	}



	public function tuijian(){
		//////////////////----------
		$User = M ( 'tgbz' ); // 实例化User对象

		$map['user']=$_SESSION['uname'];
		$count = $User->where ( $map )->count (); // 查询满足要求的总记录数
		//$page = new \Think\Page ( $count, 3 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

		$p = getpage($count,100);

		$tlist = $User->where ( $map )->order ( 'id DESC' )->limit ( $p->firstRow, $p->listRows )->select ();
		$this->assign ( 'tlist', $tlist ); // 赋值数据集
		$this->assign ( 'page', $p->show() ); // 赋值分页输出
		/////////////////----------------




		//////////////////----------
		$User = M ( 'jsbz' ); // 实例化User对象

		$map1['user']=$_SESSION['uname'];
		$count1 = $User->where ( $map1 )->count (); // 查询满足要求的总记录数
		//$page = new \Think\Page ( $count, 3 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

		$p1 = getpage($count1,100);

		$jlist = $User->where ( $map1 )->order ( 'id DESC' )->limit ( $p1->firstRow, $p1->listRows )->select ();
		$this->assign ( 'jlist', $jlist ); // 赋值数据集
		$this->assign ( 'page1', $p1->show() ); // 赋值分页输出
		/////////////////----------------


		//推广链接
		$userInfo = $User->where ( $map )->find();
		$tgurl = "http://" . $_SERVER["HTTP_HOST"] . u("Reg/index", array("uname" => $map1['user']));
		$this->tgurl = $tgurl;
		//////////////////----------
		$User = M ( 'ppdd' ); // 实例化User对象

		$map2['p_user']=$_SESSION['uname'];
		$count2 = $User->where ( $map2 )->count (); // 查询满足要求的总记录数
		//$page = new \Think\Page ( $count, 3 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

		$p2 = getpage($count2,100);

		$plist = $User->where ( $map2 )->order ( 'id DESC' )->limit ( $p2->firstRow, $p2->listRows )->select ();
		$this->assign ( 'plist', $plist ); // 赋值数据集
		$this->assign ( 'page2', $p2->show() ); // 赋值分页输出
		/////////////////----------------


		//////////////////----------
		$User = M ( 'ppdd' ); // 实例化User对象

		$map3['g_user']=$_SESSION['uname'];
		$count3 = $User->where ( $map3 )->count (); // 查询满足要求的总记录数
		//$page = new \Think\Page ( $count, 3 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

		$p3 = getpage($count3,100);

		$list3 = $User->where ( $map3 )->order ( 'id DESC' )->limit ( $p3->firstRow, $p3->listRows )->select ();
		$this->assign ( 'glist', $list3 ); // 赋值数据集
		$this->assign ( 'page3', $p3->show() ); // 赋值分页输出
		/////////////////----------------


/*
		//提现设置
		$this->assign ( 'tj_start', C("tj_start") );
		$this->assign('tj_e',C('tj_e'));
		$this->assign ( 'tj_beishu', C("tj_beishu") );*/
		$this->display ( 'tuijian' );
	}


	// 注册模块
	public function reg() {
		if(!C('isreg')){
            $this->error("系统暂停注册！");
        }
		$User = M ( 'user' ); // 实例化User对象
		$map['zcr']=$_SESSION['uname'];
		$count = $User->where ( $map )->count (); // 查询满足要求的总记录数
		//$page = new \Think\Page ( $count, 3 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

		$p = getpage($count,20);
		//iniInfo();
		$list = $User->where ( $map )->order ( 'UE_ID DESC' )->limit ( $p->firstRow, $p->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page', $p->show() ); // 赋值分页输出
		/////////////////----------------

		$this->email=sprintf("%0".strlen(9)."d", mt_rand(0,99999999999)).'@qq.com';

		$pin = M('pai')->where("user='".$_SESSION['uname']."' AND zt=0")->getField("pin");
		$this->assign('pin',$pin);

		$this->moren = $_SESSION ['uname'];
		$this->display ( 'reg' );
	}

	// 添加会员
	public function regadd() {
		$dqzhxx=M('user')->where(array('UE_account'=>$_SESSION['uname']))->find();
		if(0){
		//if($dqzhxx['sfjl']==0){
			die("<script>alert('您不是经理,不可注册会员!');history.back(-1);</script>");
		}else{
			if(C('phonecheck')){
                $this->check_phone();
            }
			$data_P = I ( 'post.' );
			$data_arr ["UE_account"] = $data_P ['email'];
			$data_arr ["UE_account1"] = $data_P ['email'];
			$data_arr ["UE_accName"] = $data_P ['pemail'];
			$data_arr ["UE_accName1"] = $data_P ['pemail'];
			$data_arr ["UE_theme"] = $data_P ['username'];

			$data_arr ["UE_sfz"] = $data_P ['UE_sfz'];  //身份证
            $data_arr ["weixin"] = $data_P ['weixin'];  //开户行
            $data_arr ["zfb"] = $data_P ['zfb'];  //开户行
            $data_arr ["zbzh"] = $data_P ['zbzh'];  //开户行
            $data_arr ["yhmc"] = $data_P ['yhmc'];  //银行名称
            $data_arr ["yhzh"] = $data_P ['yhzh'];  //银行卡号

			$data_arr ["UE_password"] = $data_P ['password'];
			$data_arr ["UE_repwd"] = $data_P ['password2'];

			$data_arr ["UE_secpwd"] = $data_P ['secpwd'];
			$data_arr ["UE_resecpwd"] = $data_P ['resecpwd'];
			$data_arr ["UE_status"] = '0'; // 用户状态
			$data_arr ["UE_level"] = '0'; // 用户等级
			$data_arr ["UE_check"] = '1'; // 是否通过验证
			$data_arr ["UE_truename"] = $data_P ['username'];
			$data_arr ["UE_phone"] = $data_P ['phone'];
			$data_arr ["UE_question"] = $data_P['question'];
            $data_arr ["UE_answer"] = $data_P['answer'];
			$data_arr ["UE_regIP"] = get_client_ip();
			$data_arr ["zcr"] = $_SESSION['uname'];
			$data_arr ["levelname"] = "B0";
			$data_arr ["UE_regTime"] = date ( 'Y-m-d H:i:s', time () );

			$data = D ( 'User' );


			//dump($data_arr);die;

			if ($data->create ( $data_arr )) {

				if(I ( 'post.ty' )<>'ye'){
					$this->error('请先勾选,我已完全了解所有风险!');
				}else{

				if ($uid = $data->add ()) {
				if($uid){
					//递归增加推荐人数
					mmtjrennumadd($data_arr ["UE_accName"]);
					//新用户注册奖
					if(C('reg_jiangli')){
						newuserjl($data_P['email'],C("reg_jiangli"),'新用户注册奖励'.C("reg_jiangli").'元');
					}

					//推荐用户奖
					if(C('zhituijiang')){
						zhituijiang($data_P ['pemail'],C("zhituijiang"),'推荐用户奖励'.C("zhituijiang").'元',$data_P['email']);
					}
					$this->success('注册成功！',U('Index/home'));
					}else{
						$this->error('注册会员失败,继续注册请刷新页面!');
					}
				} else {
					$this->error('注册会员失败,继续注册请刷新页面!');
				}
				}
			} else {
				$this->error($data->getError ());
			}
		}
	}

	public function check_phone(){
        if(!session('check_status')){
            die("<script>alert('发送手机验证码不正确,请输入正确手机号！');history.back(-1);</script>");
        }
        $phone = $_POST['phone_check'];
        if($phone != session('CHECK_CODE')){
            die("<script>alert('手机验证码不正确,请重新输入！');history.back(-1);</script>");
        }
        if($_POST['phone'] != session('PHONE_NUM')){
            die("<script>alert('手机号码与刚才接收验证码手机不同,请重新输入！');history.back(-1);</script>");
        }
    }


	public function reg2() {
		$this->data_P = I ( 'get.' );
		$this->display('reg2');
	}


	// 新闻列表页
	public function news() {
		$User = M ( 'info' ); // 实例化User对象
		$count = $User->where ( array (
				'IF_type' => 'news'
		) )->count (); // 查询满足要求的总记录数
		$page = new \Think\Page ( $count, 20 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

		// $page->lastSuffix=false;
		$page->setConfig ( 'header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录    第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>' );
		$page->setConfig ( 'prev', '上一页' );
		$page->setConfig ( 'next', '下一页' );
		$page->setConfig ( 'last', '末页' );
		$page->setConfig ( 'first', '首页' );
		$page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
		;

		$show = $page->show (); // 分页显示输出
		                        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where ( array (
				'IF_type' => 'news'
		) )->order ( 'IF_ID DESC' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page', $show ); // 赋值分页输出




		//////////////////----------
		$User = M ( 'info' ); // 实例化User对象

		$map1['IF_type']='bzzx';
		$count1 = $User->where ( $map1 )->count (); // 查询满足要求的总记录数
		//$page = new \Think\Page ( $count, 3 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

		$p1 = getpage($count1,100);

		$list1 = $User->where ( $map1 )->order ( 'IF_ID DESC' )->limit ( $p1->firstRow, $p1->listRows )->select ();
		$this->assign ( 'list1', $list1 ); // 赋值数据集
		$this->assign ( 'page1', $p1->show() ); // 赋值分页输出




		$this->display ( 'news' ); // 输出模板
	}
	// 新闻内页
	public function newsPage() {
		header ( "Content-Type:text/html; charset=utf-8" );
		$id = I ( 'id' );
		$data = M ( 'info' )->where ( array (
				'IF_ID' => $id
		) )->find ();
		$this->data = $data;
		$this->display ( 'news_page' );
	}


	// 帮助中心
	public function helpCenter() {
		header ( "Content-Type:text/html; charset=utf-8" );
		$User = M ( 'infoweb' ); // 实例化User对象
		$count = $User->where ( array (
				'IW_type' => 'bzzx'
		) )->count (); // 查询满足要求的总记录数
		$page = new \Think\Page ( $count, 20 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

		// $page->lastSuffix=false;
		$page->setConfig ( 'header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录    第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>' );
		$page->setConfig ( 'prev', '上一页' );
		$page->setConfig ( 'next', '下一页' );
		$page->setConfig ( 'last', '末页' );
		$page->setConfig ( 'first', '首页' );
		$page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
		;

		$show = $page->show (); // 分页显示输出
		                        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where ( array (
				'IW_type' => 'bzzx'
		) )->order ( 'IW_ID DESC' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page', $show ); // 赋值分页输出
		$this->display ( 'bzzx' ); // 输出模板
	}
	// 帮助中心内页
	public function helpCenterPage() {
		header ( "Content-Type:text/html; charset=utf-8" );
		$id = I ( 'id' );
		$data = M ( 'infoweb' )->where ( array (
				'IW_ID' => $id
		) )->find ();
		$this->data = $data;
		$this->display ( 'bzzx_xx' );
	}
	// 新手入门
	public function novice() {
		header ( "Content-Type:text/html; charset=utf-8" );
		$data = M ( 'infoweb' )->where ( array (
				'IW_ID' => 11
		) )->find ();
		$this->data = $data;
		$this->display ( 'bzzx_xx' );
	}
	// 安全中心
	public function safe() {

		$this->mbzt = M ( 'user' )->where ( array (UE_account => $_SESSION ['uname']) )->find ();

		$this->display ( 'zhaq' );
	}
	// 一键收币

	// 金币明细
	public function jbmx() {
		header ( "Content-Type:text/html; charset=utf-8" );
		$User = M ( 'userget' ); // 实例化User对象
		$date1 = I ( 'post.date1', '', '/^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)$/' );
		$date2 = I ( 'post.date2', '', '/^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)$/' );
		$map ['UG_account'] = $_SESSION ['uname'];
		$map ['UG_type'] = 'jb';
		//$map ['UG_dataType'] = array('IN',array('mrfh','tjj','kdj','mrldj','glj'));

		if (! empty ( $date1 ) && ! empty ( $date2 )) {
			$map ['UG_getTime'] = array (
					array (
							'gt',
							$date1
					),
					array (
							'lt',
							$date2
					),
					'and'
			);
		}
		$count = $User->where ( $map )->count (); // 查询满足要求的总记录数
		$page = new \Think\Page ( $count, 12 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

		// $page->lastSuffix=false;
		$page->setConfig ( 'header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录    第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>' );
		$page->setConfig ( 'prev', '上一页' );
		$page->setConfig ( 'next', '下一页' );
		$page->setConfig ( 'last', '末页' );
		$page->setConfig ( 'first', '首页' );
		$page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
		;

		$show = $page->show (); // 分页显示输出
		                        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where ( $map )->order ( 'UG_ID DESC' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page', $show ); // 赋值分页输出


		$ztj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'tjj'))->sum('UG_money');
		$ztj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'tjj'))->sum('UG_integral');
		$this->ztj = $ztj1+$ztj2;


		$bdj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'kdj'))->sum('UG_money');
		$bdj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'kdj'))->sum('UG_integral');
		$this->bdj = $bdj1+$bdj2;

		$fhj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrfh'))->sum('UG_money');
		$fhj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrfh'))->sum('UG_integral');
		$this->fhj = $fhj1+$fhj2;

		$ldj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrldj'))->sum('UG_money');
		$ldj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrldj'))->sum('UG_integral');
		$this->ldj = $ldj1+$ldj2;


		$glj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'glj'))->sum('UG_money');
		$glj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'glj'))->sum('UG_integral');
		$this->glj = $glj1+$glj2;




		$this->display ( 'jbmx' ); // 输出模板
	}

	public function ybmx() {
		header ( "Content-Type:text/html; charset=utf-8" );
		$User = M ( 'userget' ); // 实例化User对象
		$date1 = I ( 'post.date1', '', '/^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)$/' );
		$date2 = I ( 'post.date2', '', '/^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)$/' );
		$map ['UG_account'] = $_SESSION ['uname'];
		$map ['UG_type'] = 'yb';
		//$map ['UG_dataType'] = array('IN',array('mrfh','tjj','kdj','mrldj','glj'));

		if (! empty ( $date1 ) && ! empty ( $date2 )) {
			$map ['UG_getTime'] = array (
					array (
							'gt',
							$date1
					),
					array (
							'lt',
							$date2
					),
					'and'
			);
		}
		$count = $User->where ( $map )->count (); // 查询满足要求的总记录数
		$page = new \Think\Page ( $count, 12 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

		// $page->lastSuffix=false;
		$page->setConfig ( 'header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录    第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>' );
		$page->setConfig ( 'prev', '上一页' );
		$page->setConfig ( 'next', '下一页' );
		$page->setConfig ( 'last', '末页' );
		$page->setConfig ( 'first', '首页' );
		$page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
		;

		$show = $page->show (); // 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where ( $map )->order ( 'UG_ID DESC' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page', $show ); // 赋值分页输出


		$ztj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'tjj'))->sum('UG_money');
		$ztj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'tjj'))->sum('UG_integral');
		$this->ztj = $ztj1+$ztj2;


		$bdj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'kdj'))->sum('UG_money');
		$bdj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'kdj'))->sum('UG_integral');
		$this->bdj = $bdj1+$bdj2;

		$fhj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrfh'))->sum('UG_money');
		$fhj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrfh'))->sum('UG_integral');
		$this->fhj = $fhj1+$fhj2;

		$ldj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrldj'))->sum('UG_money');
		$ldj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrldj'))->sum('UG_integral');
		$this->ldj = $ldj1+$ldj2;


		$glj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'glj'))->sum('UG_money');
		$glj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'glj'))->sum('UG_integral');
		$this->glj = $glj1+$glj2;




		$this->display ( 'ybmx' ); // 输出模板
	}

	public function zsbmx() {
		header ( "Content-Type:text/html; charset=utf-8" );
		$User = M ( 'userget' ); // 实例化User对象
		$date1 = I ( 'post.date1', '', '/^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)$/' );
		$date2 = I ( 'post.date2', '', '/^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)$/' );
		$map ['UG_account'] = $_SESSION ['uname'];
		$map ['UG_type'] = 'zsb';
		//$map ['UG_dataType'] = array('IN',array('mrfh','tjj','kdj','mrldj','glj'));

		if (! empty ( $date1 ) && ! empty ( $date2 )) {
			$map ['UG_getTime'] = array (
					array (
							'gt',
							$date1
					),
					array (
							'lt',
							$date2
					),
					'and'
			);
		}
		$count = $User->where ( $map )->count (); // 查询满足要求的总记录数
		$page = new \Think\Page ( $count, 12 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

		// $page->lastSuffix=false;
		$page->setConfig ( 'header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录    第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>' );
		$page->setConfig ( 'prev', '上一页' );
		$page->setConfig ( 'next', '下一页' );
		$page->setConfig ( 'last', '末页' );
		$page->setConfig ( 'first', '首页' );
		$page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
		;

		$show = $page->show (); // 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where ( $map )->order ( 'UG_ID DESC' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page', $show ); // 赋值分页输出


		$ztj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'tjj'))->sum('UG_money');
		$ztj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'tjj'))->sum('UG_integral');
		$this->ztj = $ztj1+$ztj2;


		$bdj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'kdj'))->sum('UG_money');
		$bdj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'kdj'))->sum('UG_integral');
		$this->bdj = $bdj1+$bdj2;

		$fhj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrfh'))->sum('UG_money');
		$fhj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrfh'))->sum('UG_integral');
		$this->fhj = $fhj1+$fhj2;

		$ldj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrldj'))->sum('UG_money');
		$ldj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrldj'))->sum('UG_integral');
		$this->ldj = $ldj1+$ldj2;


		$glj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'glj'))->sum('UG_money');
		$glj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'glj'))->sum('UG_integral');
		$this->glj = $glj1+$glj2;




		$this->display ( 'zsbmx' ); // 输出模板
	}


	// 奖金明细
	public function jjjl() {
		header ( "Content-Type:text/html; charset=utf-8" );
		$User = M ( 'userget' ); // 实例化User对象
		$date1 = I ( 'post.date1', '', '/^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)$/' );
		$date2 = I ( 'post.date2', '', '/^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)$/' );
		$map ['UG_account'] = $_SESSION ['uname'];
		$map ['UG_dataType'] = array('IN',array('mrfh','tjj','tjj1','tjj2','tjj3','bdj','mrldj'));

		if (! empty ( $date1 ) && ! empty ( $date2 )) {
			$map ['UG_getTime'] = array (
					array (
							'gt',
							$date1
					),
					array (
							'lt',
							$date2
					),
					'and'
			);
		}

		//$map  = array('tjj','kdj','glj');
		//	$map['UE_Faccount']  = $_SESSION ['uname']
		//$ljtc1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>array('IN',$map)))->sum('UG_money');

		$count = $User->where ( $map )->count (); // 查询满足要求的总记录数
		$page = new \Think\Page ( $count, 12 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

		// $page->lastSuffix=false;
		$page->setConfig ( 'header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录    第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>' );
		$page->setConfig ( 'prev', '上一页' );
		$page->setConfig ( 'next', '下一页' );
		$page->setConfig ( 'last', '末页' );
		$page->setConfig ( 'first', '首页' );
		$page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
		;

		$show = $page->show (); // 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where ( $map )->order ( 'UG_ID DESC' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page', $show ); // 赋值分页输出

		$this->display ( 'jjjl' ); // 输出模板
	}

	// 金币转账
	public function jbzz() {
		header ( "Content-Type:text/html; charset=utf-8" );
		$userData = M ( 'user' )->where ( array (
				'UE_account' => $_SESSION ['uname']
		) )->find ();
		$this->userData = $userData;
		$this->display ( 'jbzz' );
	}
	// 金币转账处理
	public function jbzzcl() {
		if (IS_POST) {
			$pin_zs=M('pin')->where ( array('user'=>$_SESSION['uname'],'zt'=>0) )->count ();
			$data_P = I ( 'post.' );
			//$user = M ( 'user' )->where ( array (UE_account => $_SESSION ['uname']) )->find ();
			//$user1 = M ();
			$user_df = M ( 'user' )->where ( array (UE_account => $data_P['user']) )->find ();
			//! $this->check_verify ( I ( 'post.yzm' ) )
			//! $user1->autoCheckToken ( $_POST )
			$userxx=M('user')->where(array('UE_account'=>$_SESSION['uname']))->find();

			//dump($userxx);die;

			//$userxx['ue_secpwd']<>md5($data_P['ejmm'])
			if(false){
				die("<script>alert('二级密码输入有误！');history.back(-1);</script>");
			}else{


			$jbhe=$data_P ['sh'];
			if (! preg_match ( '/^[0-9]{1,10}$/', $data_P ['sh'] )||!$data_P ['sh']>0) {
				die("<script>alert('数量输入有勿！');history.back(-1);</script>");
			} elseif ($pin_zs < $jbhe) {
				die("<script>alert('门票不足！');history.back(-1);</script>");
			}elseif (!$user_df) {
				die("<script>alert('对方账号不存在！');history.back(-1);</script>");
			//}elseif ($user_df['sfjl']=='0') {
			//	die("<script>alert('对方不是经理,不可转出！');history.back(-1);</script>");
			} else {

				$pin_zs_df=M('pin')->where ( array('user'=>$data_P['user'],'zt'=>0) )->count ();


				for ($i=0;$i<$data_P ['sh'];$i++){

					$pin_xx=M('pin')->where ( array('user'=>$_SESSION['uname'],'zt'=>0) )->find();

					M('pin')->where ( array('id'=>$pin_xx['id'],'zt'=>0) )->save(array('user'=>$data_P['user']));
				}

				$pin_zs_xz=M('pin')->where ( array('user'=>$_SESSION['uname'],'zt'=>0) )->count ();
				$pin_zs_df_xz=M('pin')->where ( array('user'=>$data_P['user'],'zt'=>0) )->count ();

				$note3 = "激活码转出";
				$record3 ["UG_account"] = $_SESSION['uname']; // 登入转出账户
				$record3 ["UG_type"] = 'mp';
				$record3 ["UG_allGet"] = $pin_zs; // 金币
				$record3 ["UG_money"] = '-'.$jbhe; //
				$record3 ["UG_balance"] = $pin_zs_xz; // 当前推荐人的金币馀额
				$record3 ["UG_dataType"] = 'jbzc'; // 金币转出
				$record3 ["UG_note"] = $note3; // 推荐奖说明
				$record3["UG_getTime"]		= date ( 'Y-m-d H:i:s', time () ); //操作时间
				$reg4 = M ( 'userget' )->add ( $record3 );

				$note3 = "激活码转入";
				$record3 ["UG_account"] = $data_P['user']; // 登入转出账户
				$record3 ["UG_type"] = 'mp';
				$record3 ["UG_allGet"] = $pin_zs_df; // 金币
				$record3 ["UG_money"] = '+'.$jbhe; //
				$record3 ["UG_balance"] = $pin_zs_df_xz; // 当前推荐人的金币馀额
				$record3 ["UG_dataType"] = 'jbzr'; // 金币转出
				$record3 ["UG_note"] = $note3; // 推荐奖说明
				$record3["UG_getTime"]		= date ( 'Y-m-d H:i:s', time () ); //操作时间
				$reg4 = M ( 'userget' )->add ( $record3 );


				$this->success('转让成功!');
			}
			}
		}
	}

	public function jhmzzcl() {
		if (IS_POST) {
			$pin_zs=M('pai')->where ( array('user'=>$_SESSION['uname'],'zt'=>0) )->count ();
			$data_P = I ( 'post.' );
			$user_df = M ( 'user' )->where ( array (UE_account => $data_P['user']) )->find ();
			$userxx=M('user')->where(array('UE_account'=>$_SESSION['uname']))->find();
			if(false){
				die("<script>alert('二级密码输入有误！');history.back(-1);</script>");
			}else{

			$jbhe=$data_P ['sh'];
			if (! preg_match ( '/^[0-9]{1,10}$/', $data_P ['sh'] )||!$data_P ['sh']>0) {
				die("<script>alert('数量输入有勿！');history.back(-1);</script>");
			} elseif ($pin_zs < $jbhe) {
				die("<script>alert('门票不足！');history.back(-1);</script>");
			}elseif (!$user_df) {
				die("<script>alert('对方账号不存在！');history.back(-1);</script>");
			//}elseif ($user_df['sfjl']=='0') {
			//	die("<script>alert('对方不是经理,不可转出！');history.back(-1);</script>");
			} else {

				$pin_zs_df=M('pai')->where ( array('user'=>$data_P['user'],'zt'=>0) )->count ();


				for ($i=0;$i<$data_P ['sh'];$i++){

					$pin_xx=M('pai')->where ( array('user'=>$_SESSION['uname'],'zt'=>0) )->find();

					M('pai')->where ( array('id'=>$pin_xx['id'],'zt'=>0) )->save(array('user'=>$data_P['user']));
				}

				$pin_zs_xz=M('pai')->where ( array('user'=>$_SESSION['uname'],'zt'=>0) )->count ();
				$pin_zs_df_xz=M('pai')->where ( array('user'=>$data_P['user'],'zt'=>0) )->count ();

				$note3 = "激活码转出";
				$record3 ["UG_account"] = $_SESSION['uname']; // 登入转出账户
				$record3 ["UG_type"] = 'mp';
				$record3 ["UG_allGet"] = $pin_zs; // 金币
				$record3 ["UG_money"] = '-'.$jbhe; //
				$record3 ["UG_balance"] = $pin_zs_xz; // 当前推荐人的金币馀额
				$record3 ["UG_dataType"] = 'jbzc'; // 金币转出
				$record3 ["UG_note"] = $note3; // 推荐奖说明
				$record3["UG_getTime"]		= date ( 'Y-m-d H:i:s', time () ); //操作时间
				$reg4 = M ( 'userget' )->add ( $record3 );

				$note3 = "激活码转入";
				$record3 ["UG_account"] = $data_P['user']; // 登入转出账户
				$record3 ["UG_type"] = 'mp';
				$record3 ["UG_allGet"] = $pin_zs_df; // 金币
				$record3 ["UG_money"] = '+'.$jbhe; //
				$record3 ["UG_balance"] = $pin_zs_df_xz; // 当前推荐人的金币馀额
				$record3 ["UG_dataType"] = 'jbzr'; // 金币转出
				$record3 ["UG_note"] = $note3; // 推荐奖说明
				$record3["UG_getTime"]		= date ( 'Y-m-d H:i:s', time () ); //操作时间
				$reg4 = M ( 'userget' )->add ( $record3 );


				$this->success('转让成功!');
			}
			}
		}
	}



	public function ldtj() {
		if(IS_AJAX){
			//$this->ajaxReturn ( array ('nr' => '验证码错误!','sf' => 0 ) );
			if (false) {
				$this->ajaxReturn ( array ('nr' => '验证码错误!','sf' => 0 ) );
			}else {

		$user = M('user');
		$ztname=$user->where(array('UE_accName'=>$_SESSION ['uname'],'UE_Faccount'=>'0','UE_check'=>'1','UE_stop'=>'1'))->getField('ue_account',true);
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
					$reg=$user->where(array('UE_accName'=>array('IN',$reg),'UE_Faccount'=>'0','UE_check'=>'1','UE_stop'=>'1'))->getField('ue_account',true);
					$datazs +=count($reg);
				}
			}

		}

		$this->ajaxReturn(array ('nr' => $datazs,'sf' => 0 ) );
			}
		}

	}
	public function zzjl() {
		$User = M ( 'userjyinfo' ); // 实例化User对象

	$map ['UJ_usercount'] = $_SESSION ['uname'];
	$map ['UJ_dataType'] = 'zs';




	$count = $User->where ( $map )->count (); // 查询满足要求的总记录数
	//dump($var)
	$page = new \Think\Page ( $count, 12 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

	// $page->lastSuffix=false;
	$page->setConfig ( 'header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录    第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>' );
	$page->setConfig ( 'prev', '上一页' );
	$page->setConfig ( 'next', '下一页' );
	$page->setConfig ( 'last', '末页' );
	$page->setConfig ( 'first', '首页' );
	$page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
	;

	$show = $page->show (); // 分页显示输出
	// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
	$list = $User->where ( $map )->order ( 'UJ_ID DESC' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();

	//dump($list);die;

	$this->assign ( 'list', $list ); // 赋值数据集
	$this->assign ( 'page', $show ); // 赋值分页输出
	$this->display ( 'zzjl' );
	}







	public function tgbzcl() {
		if (IS_POST) {
				$data_P = I ( 'post.' );
				$user = M('user')->where(array('UE_account'=>$_SESSION ['uname']))->find();
				$usermm = M('user')->where(array('UE_account'=>$_SESSION ['uname']))->find ();

				//仅为新注册用户冻结天数不是交易冻结天数
				if(C("reg_days")>0){
					if((strtotime($usermm['ue_regtime'])+C("reg_days")*3600*24 )> time()){
						die("<script>alert('该帐号仍在冻结时间内！冻结时为注册日期".C("reg_days")."天');history.back(-1);</script>");
					}
				}

				/**是否比上次排单金额少**/
				if(C('futou')){
					$bb = C('futou')/100;
					$uppdjb = M('tgbz')->where("user='".$_SESSION['uname']."'")->order("id DESC")->group('date')->SUM("jb");
					if($uppdjb*$bb>$data_P['amount']){
						die("<script>alert('排单金额不能小于上次排单的".C('futou')."%，请重新排单');history.back(-1);</script>");
					}
				}


				//是否开启时间限制
				if(C('time_limit')){

					//每天排单开始时间
					$time_unix = strtotime(date('Ymd'));
					$now_time_unix = time();
					$start_info = explode(':', C('paidan_time_start'));
					$start_unix = 0;
					if(is_array($start_info)){
						$start_unix = $start_info[0]*3600 +$start_info[1]*60;
					}
					//每天排单结束时间
					$end_info = explode(':', C('paidan_time_end'));
					$end_unix = 0;
					if(is_array($end_info)){
						$end_unix = $end_info[0]*3600 +$end_info[1]*60;
					}

					$paidan_time_start = $time_unix+$start_unix;
					$paidan_time_end = $time_unix + $end_unix;
					if($now_time_unix<$paidan_time_start){
						die("<script>alert('不好意思今天排单时间还早哦！每日排单时间为". C('paidan_time_start')."到". C('paidan_time_end')."');history.back(-1);</script>");
					}elseif($now_time_unix>$paidan_time_end){
						die("<script>alert('很遗憾你已经错过了排单时间！每日排单时间为". C('paidan_time_start')."到". C('paidan_time_end')."');history.back(-1);</script>");
					}
				}

				//每天排单数量
				$paidan_num =   C('paidan_num');
				if($paidan_num>0){
					$uname = $_SESSION ['uname'];
					$starttime = date('Y-m-d 00:00:01', time());
		            $endtime = date('Y-m-d 23:59:59', time());
		            $count = M("tgbz")->where("date>='$starttime' and date<='$endtime' and user='$uname'")->count();
		            if ($count >= $paidan_num) {
		                die("<script>alert('排单失败，每天只允许排单".$paidan_num."次！');history.back(-1);</script>");
		            }
				}

	            //每天用户个人排单总额度
	            /*$paidan_jbs = C('paidan_jbs');
	            if($paidan_jbs>0){
		            $count = M("tgbz")->where("date>='$starttime' and date<='$endtime' and user='$uname'")->sum('jb');
		            if ($count >= $paidan_jbs) {
		                die("<script>alert('排单失败，每天只允许总排单".$paidan_jbs."元！');history.back(-1);</script>");
		            }
	        	}*/


                //用户提供帮助最多允许等待匹配单数
                $oneByone = C('oneByone');
                if($oneByone>0){
                	$tgbz_count=M('tgbz')->where("user='".$_SESSION ['uname']."' and zt =0")->count();
	                //$tgbztj=M('tgbz')->where("user='".$_SESSION ['uname']."' and qr_zt=0")->sum('jb');   原来
	                if($tgbz_count >= $oneByone) {
						die("<script>alert('用户提供帮助最多允许等待匹配".$oneByone."单！');history.back(-1);</script>");
					}
                }

                $peidui = C('peidui');
                if($peidui >0 ){
                	$ppdd= M('ppdd');
					$where=array();
					$where['g_user'] = $_SESSION ['uname'];  //这里用g_user也就是确认收款这。及时确认
					$where['zt'] =array('NEQ',2);
					$rs=$ppdd->where($where)->count();
					if ( $rs>=$peidui )
					{
						die("<script>alert('您还有未完成的".$peidui."个订单未处理，不能继续申请');history.back(-1);</script>");
					}
                }


                $pai_keyong_edu = get_pai_keyong_edu();
                if($data_P['amount'] > $pai_keyong_edu ){
                	die("<script>alert('您当前最多只能派单".$pai_keyong_edu."元');history.back(-1);</script>");
                }

                //启用排单币
                if(C('ispdb')){
                	$pin= M('pin');
					$where=array();
					$where['user'] = $_SESSION ['uname'];
					$where['pin'] =$data_P['pin'];
					$rss=$pin->where($where)->find();
					if ($rss['id']=="" or $rss['zt']==1){
						die("<script>alert('您的排单币错误或已使用，暂不能继续申请');history.back(-1);</script>");
					}
                }

				if ($data_P ['zffs1']<>'1'&&$data_P ['zffs2']<>'1'&&$data_P ['zffs3']<>'1') {
					die("<script>alert('至少选择一个收款方式！');history.back(-1);</script>");
				}  elseif ($data_P ['amount']<C("jj01s")||$data_P ['amount']>C("jj01m") || $data_P ['amount']% C("jj01") > 0) {
					//帮助金额500-20000,并且是100的倍数！
					die("<script>alert('帮助金额".C("jj01s")."-".C("jj01m").",并且是".C("jj01")."的倍数！');history.back(-1);</script>");

				} else {
					//$data_P ['amount']=$data_P ['amount']*6;
					$timea=time ();
					$kssj=strtotime($user['date_leiji'])+86400*30;
					$startTime = date('Y-m-d H:i:s',$kssj);
					if($user['tz_leiji']=='0'||$timea>=$kssj){  //如果他还没有超过当月累计或者已经过了一个月  $user['tz_leiji'] ===>每月金额的统计
						M('user')->where(array('UE_account' => $_SESSION ['uname']))->save(array('date_leiji'=>date('Y-m-d H:i:s',$timea),'tz_leiji'=>'0'));
					}
					if($user['tz_leiji']+$data_P ['amount']>C("month_max")){

						die("<script>alert('当前投资加当月累计超过".$user['tz_leiji'].'|'.C("month_max").",请在".$startTime."以后在试！');history.back(-1);</script>");
					}




					//支付方式
					if($data_P ['zffs1']=='1'){$data['zffs1']='1';}else{$data['zffs1']='0';}
					if($data_P ['zffs2']=='1'){$data['zffs2']='1';}else{$data['zffs2']='0';}
					if($data_P ['zffs3']=='1'){$data['zffs3']='1';}else{$data['zffs3']='0';}
					$data['user']=$user['ue_account'];
					$data['jb']=$data_P ['amount'];
					$data['user_nc']=$user['ue_theme'];//昵称
					$data['user_tjr']=$user['zcr']; //推荐人
					$data['date']=date ( 'Y-m-d H:i:s', time () ); //排单时间
					$data['zt']=0; //等待匹配
					$data['qr_zt']=0; //未确认

					$tgxz = explode(",",C('tgxz'));
					$tgcf = explode(",",C('tgcf'));
					$key = array_search($data_P ['amount'],$tgxz);
					$data2 = array();
					$jb = $data_P ['amount']/$tgcf[$key];
					$data['jb'] = $jb;
					for($i=0;$i<$tgcf[$key];$i++){
						$data2[] = $data;
					}

					//如此可以看出他是在排单等待中就添加金额		  tz_leiji-----》投资累计
					M('user')->where(array('UE_account'=> $_SESSION ['uname']))->setInc('tz_leiji',$data_P ['amount']);

					if(M('tgbz')->addAll($data2)){
						if(C('ispdb')){
							M('pin')->where(array('id' => $rss['id']))->save(array('zt' => 1));
						}

						/**解冻上次提现记录**/
						M('user_jj')->where("user='".$user['ue_account']."' ANd status=0")->limit(1)->setField('status',1);
						die("<script>alert('提交成功！');window.location.href='/';</script>");
					}else{
						die("<script>alert('提交失败！');history.back(-1);</script>");
					}
				}
		}
	}

	//---------------------------------->直接体现暂时没发现什么用意
	public function mmtixian() {
		if (IS_POST) {

			$data_P = I ( 'post.' );
			//echo "<pre>";print_r($data_P);die;
			$user = M ( 'user' )->where ( array (
					UE_account => $_SESSION ['uname']
			) )->find ();
			$user1 = M ();
			//! $this->check_verify ( I ( 'post.yzm' ) )
			//! $user1->autoCheckToken ( $_POST )

			$usermm = M ( 'user' )->where ( array (UE_account => $_SESSION ['uname']) )->find ();
			if((strtotime($usermm['UE_regTime'])+C("reg_days")*3600*24 )> time()){
				die("<script>alert('该帐号仍在冻结时间内！冻结时为注册日期".C("reg_days")."天');history.back(-1);</script>");
			}

			if (!in_array($data_P ['zffs'],array('1','2','3'))) {
				die("<script>alert('至少选择一种收款方式！');history.back(-1);</script>");
			} elseif ($data_P ['get_amount']<C("txthemin")) {
					die("<script>alert('提现金额".C("txthemin")."起并且是".C("txthebeishu")."的倍数！');history.back(-1);</script>");
			} elseif ($data_P ['get_amount']% C("txthebeishu") > 0) {
					die("<script>alert('提现金额".C("txthemin")."起并且是".C("txthebeishu")."的倍数！');history.back(-1);</script>");
			} elseif ($user['ue_money']<$data_P ['get_amount']) {
				die("<script>alert('余额不足！');history.back(-1);</script>");
			} else {

				$data['zffs']=$data_P ['zffs'];
				$data['UG_account']=$user['ue_account'];
				$data['TX_money']=$data_P ['get_amount'];
				$data['status']='0';
				$data['addtime']=date ( 'Y-m-d H:i:s', time () );

				M('user')->where(array('UE_account' => $_SESSION ['uname']))->setDec('UE_money',$data_P ['get_amount']);

				if(M('tixian')->add($data)){
					die("<script>alert('提交成功！');window.location.href='/';</script>");
				}else{
					die("<script>alert('提交失败！');history.back(-1);</script>");
				}
			}

		}
	}


	public function jsbzcl() {
		if (IS_POST) {

			$data_P = I ( 'post.' );
			//dump($data_P);die;
			$user = M ( 'user' )->where ( array (
					UE_account => $_SESSION ['uname']
			) )->find ();
			$user1 = M ();
			//! $this->check_verify ( I ( 'post.yzm' ) )
			//! $user1->autoCheckToken ( $_POST )

			$usermm = M('user')->where(array('UE_account' =>$_SESSION ['uname']))->find ();

			if((strtotime($usermm['UE_regTime'])+C("reg_days")*3600*24 )> time()){
				die("<script>alert('该帐号仍在冻结时间内！冻结时为注册日期".C("reg_days")."天');history.back(-1);</script>");
			}

			if ($data_P ['zffs1']<>'1'&&$data_P ['zffs2']<>'1'&&$data_P ['zffs3']<>'1') {
				die("<script>alert('至少选择一种收款方式！');history.back(-1);</script>");
			} elseif ($data_P ['get_amount']<C("txthemin")) {
					die("<script>alert('接受帮助金额".C("txthemin")."起并且是".C("txthebeishu")."的倍数！');history.back(-1);</script>");
			} elseif ($data_P ['get_amount']% C("txthebeishu") > 0) {
					die("<script>alert('接受帮助金额".C("txthemin")."起并且是".C("txthebeishu")."的倍数！！');history.back(-1);</script>");
			} elseif($data_P ['get_amount']>C("txthemax")){
				die("<script>alert('接受帮助最大金额为".C("txthemax")."');history.back(-1);</script>");
			}elseif ($user['ue_money']<$data_P ['get_amount']) {
				die("<script>alert('余额不足！');history.back(-1);</script>");
			} else {

				//支付方式
				if($data_P ['zffs1']=='1'){$data['zffs1']='1';}else{$data['zffs1']='0';}
				if($data_P ['zffs2']=='1'){$data['zffs2']='1';}else{$data['zffs2']='0';}
				if($data_P ['zffs3']=='1'){$data['zffs3']='1';}else{$data['zffs3']='0';}
				$data['user']=$user['ue_account'];  //提交接收帮助的人
				$data['jb']=$data_P ['get_amount'];  //金额
				$data['user_nc']=$user['ue_theme']; //昵称
				$data['user_tjr']=$user['zcr'];  //推荐人
				$data['date']=date ( 'Y-m-d H:i:s', time () );  //时间
				$data['zt']=0;  //为匹配
				$data['qr_zt']=0;  //为确认收款
				$user_zq=M('user')->where(array('UE_ID'=>$_SESSION['uid']))->find();

				$jsbz_id = M('jsbz')->add($data);

				if($jsbz_id){
					M('user')->where(array('UE_account' => $_SESSION ['uname']))->setDec("UE_money",$data_P ['get_amount']);

					$user_xz=M('user')->where(array('UE_ID'=>$_SESSION['uid']))->find();
					$note3 = "接受帮助扣款";
					$record3 ["UG_account"] = $_SESSION['uname']; // 登入转出账户
					$record3 ["UG_type"] = 'jb';
					$record3 ["UG_allGet"] = $user_zq['ue_money']; // 金币
					$record3 ["UG_money"] = '-'.$data_P ['get_amount']; //
					$record3 ["UG_balance"] = $user_xz['ue_money']; // 当前推荐人的金币馀额
					$record3 ["UG_dataType"] = 'jsbz'; // 金币转出
					$record3 ["UG_note"] = $note3; // 推荐奖说明
					$record3["UG_getTime"]		= date ( 'Y-m-d H:i:s', time () ); //操作时间
					$record3["jsbzID"] = $jsbz_id;
					$reg4 = M ( 'userget' )->add ( $record3 );

					die("<script>alert('提交成功！');window.location.href='/';</script>");
				}else{
					die("<script>alert('提交失败！');history.back(-1);</script>");
				}
			}

		}
	}
	public function jsbzcl1() {
		if (IS_POST) {

			$data_P = I ( 'post.' );
			//dump($data_P);die;
			$user = M ( 'user' )->where ( array (
					UE_account => $_SESSION ['uname']
			) )->find ();
			$user1 = M ();
			//! $this->check_verify ( I ( 'post.yzm' ) )
			//! $user1->autoCheckToken ( $_POST )
			$usermm = M ( 'user' )->where ( array (UE_account => $_SESSION ['uname']) )->find ();
			if((strtotime($usermm['UE_regTime'])+C("reg_days")*3600*24 )> time()){
				die("<script>alert('该帐号仍在冻结时间内！冻结时为注册日期".C("reg_days")."天');history.back(-1);</script>");
			}
			if ($data_P ['zffs1']<>'1'&&$data_P ['zffs2']<>'1'&&$data_P ['zffs3']<>'1') {
				die("<script>alert('至少选择一种收款方式！');history.back(-1);</script>");
			}  elseif ($data_P ['get_amount']<C("jl_start")) {
					die("<script>alert('接受帮助金额".C("jl_start")."起并且是".C("jl_beishu")."的倍数！');history.back(-1);</script>");
			}elseif ($data_P ['get_amount']>C("jl_e")) {
					die("<script>alert('接受帮助金额最大".C("jl_e")."并且是".C("jl_beishu")."的倍数！');history.back(-1);</script>");
			} elseif ($data_P ['get_amount']% C("jl_beishu") > 0) {
					die("<script>alert('接受帮助金额".C("jl_start")."起并且是".C("jl_beishu")."的倍数！！');history.back(-1);</script>");
			} elseif ($user['jl_he']<$data_P ['get_amount']) {
				die("<script>alert('余额不足！');history.back(-1);</script>");
			} else {
				$timea=time ();
				$kssj=strtotime($user['tx_date'])+86400*7;
				$startTime = date('Y-m-d H:i:s',$kssj);
				if($user['tx_leiji']=='0'||$timea>=$kssj){
					M('user')->where(array(UE_account => $_SESSION ['uname']))->save(array('tx_date'=>date('Y-m-d H:i:s',$timea),'tx_leiji'=>'0'));
					$user = M ( 'user' )->where ( array (UE_account => $_SESSION ['uname']) )->find ();
				}

				if($user['tx_leiji']+$data_P ['get_amount']>C("month_max")){
					die("<script>alert('经理奖金本周提现超过".C("month_max")."RMB,请在".$startTime."以后在试！');history.back(-1);</script>");
				}else{
					M('user')->where(array(UE_account => $_SESSION ['uname']))->setInc('tx_leiji',$data_P ['get_amount']);

				if($data_P ['zffs1']=='1'){$data['zffs1']='1';}else{$data['zffs1']='0';}
				if($data_P ['zffs2']=='1'){$data['zffs2']='1';}else{$data['zffs2']='0';}
				if($data_P ['zffs3']=='1'){$data['zffs3']='1';}else{$data['zffs3']='0';}
				$data['user']=$user['ue_account'];
				$data['jb']=$data_P ['get_amount'];
				$data['user_nc']=$user['ue_theme'];
				$data['user_tjr']=$user['zcr'];
				$data['date']=date ( 'Y-m-d H:i:s', time () );
				$data['zt']=0;
				$data['qr_zt']=0;
				$data['qb']=1;
				$user_zq=M('user')->where(array('UE_ID'=>$_SESSION['uid']))->find();


				M('user')->where(array('UE_account' => $_SESSION ['uname']))->setDec('jl_he',$data_P ['get_amount']);

				$user_xz=M('user')->where(array('UE_ID'=>$_SESSION['uid']))->find();
				$note3 = "接受帮助扣款";
				$record3 ["UG_account"] = $_SESSION['uname']; // 登入转出账户
				$record3 ["UG_type"] = 'jb';
				$record3 ["UG_allGet"] = $user_zq['jl_he']; // 金币
				$record3 ["UG_money"] = '-'.$data_P ['get_amount']; //
				$record3 ["UG_balance"] = $user_xz['jl_he']; // 当前推荐人的金币馀额
				$record3 ["UG_dataType"] = 'jsbz'; // 金币转出
				$record3 ["UG_note"] = $note3; // 推荐奖说明
				$record3["UG_getTime"]		= date ( 'Y-m-d H:i:s', time () ); //操作时间
				$reg4 = M ( 'userget' )->add( $record3 );

				if(M('jsbz')->add($data)){
					die("<script>alert('提交成功！');window.location.href='/';</script>");
				}else{
					die("<script>alert('提交失败！');history.back(-1);</script>");
				}

			}
			}
		}
	}

	public function jsbzcl2() {
		if (IS_POST) {

			$data_P = I ( 'post.' );
			//dump($data_P);die;
			$user = M ( 'user' )->where ( array (
					UE_account => $_SESSION ['uname']
			) )->find ();
			$user1 = M ();
			//! $this->check_verify ( I ( 'post.yzm' ) )
			//! $user1->autoCheckToken ( $_POST )

			$usermm = M ( 'user' )->where ( array (UE_account => $_SESSION ['uname']) )->find ();
			if((strtotime($usermm['UE_regTime'])+C("reg_days")*3600*24 )> time()){
				die("<script>alert('该帐号仍在冻结时间内！冻结时为注册日期".C("reg_days")."天');history.back(-1);</script>");
			}

			if ($data_P ['zffs1']<>'1'&&$data_P ['zffs2']<>'1'&&$data_P ['zffs3']<>'1') {
				die("<script>alert('至少选择一种收款方式！');history.back(-1);</script>");
			}elseif ($data_P ['get_amount']<C("tj_start")) {
					die("<script>alert('接受帮助金额".C("tj_start")."起并且是".C("tj_beishu")."的倍数！');history.back(-1);</script>");
			}elseif ($data_P ['get_amount']>C("tj_e")) {
					die("<script>alert('接受帮助金额最大".C("tj_e")."并且是".C("tj_beishu")."的倍数！');history.back(-1);</script>");
			} elseif ($data_P ['get_amount']% C("tj_beishu") > 0) {
					die("<script>alert('接受帮助金额".C("tj_start")."起并且是".C("tj_beishu")."的倍数！！');history.back(-1);</script>");
			} elseif ($user['tj_he']<$data_P ['get_amount']) {
				die("<script>alert('余额不足！');history.back(-1);</script>");
			} else {

				if($data_P ['zffs1']=='1'){$data['zffs1']='1';}else{$data['zffs1']='0';}
				if($data_P ['zffs2']=='1'){$data['zffs2']='1';}else{$data['zffs2']='0';}
				if($data_P ['zffs3']=='1'){$data['zffs3']='1';}else{$data['zffs3']='0';}
				$data['user']=$user['ue_account'];
				$data['jb']=$data_P ['get_amount'];
				$data['user_nc']=$user['ue_theme'];
				$data['user_tjr']=$user['zcr'];
				$data['date']=date ( 'Y-m-d H:i:s', time () );
				$data['zt']=0;
				$data['qr_zt']=0;
				$data['qb']=2;
				$user_zq=M('user')->where(array('UE_ID'=>$_SESSION['uid']))->find();

				M('user')->where(array('UE_account' => $_SESSION ['uname']))->setDec('tj_he',$data_P ['get_amount']);

				$user_xz=M('user')->where(array('UE_ID'=>$_SESSION['uid']))->find();
				$note3 = "接受帮助扣款";
				$record3 ["UG_account"] = $_SESSION['uname']; // 登入转出账户
				$record3 ["UG_type"] = 'jb';
				$record3 ["UG_allGet"] = $user_zq['tj_he']; // 金币
				$record3 ["UG_money"] = '-'.$data_P ['get_amount']; //
				$record3 ["UG_balance"] = $user_xz['tj_he']; // 当前推荐人的金币馀额
				$record3 ["UG_dataType"] = 'jsbz'; // 金币转出
				$record3 ["UG_note"] = $note3; // 推荐奖说明
				$record3["UG_getTime"]		= date ( 'Y-m-d H:i:s', time () ); //操作时间
				$reg4 = M ( 'userget' )->add ( $record3 );

				if(M('jsbz')->add($data)){
					die("<script>alert('提交成功！');window.location.href='/';</script>");
				}else{
					die("<script>alert('提交失败！');history.back(-1);</script>");
				}
			}

		}
	}
	public function tgbz_del() {
		if (!preg_match ( '/^[0-9]{1,10}$/', I ('get.id') )) {
			$this->success('非法操作,将冻结账号!');
		}else{
			$userinfo = M ( 'tgbz' )->where ( array ('id' => I ('get.id'),'zt'=>'0') )->find ();
			//dump(I ('get.id'));
			//dump($userinfo['ue_accname']);die;
			if ($userinfo['user']<>$_SESSION ['uname']) {
				$this->success('订单当前状态不可取消!');
			}else{
				lkdsjfsdfj($userinfo['user'],'-'.$userinfo['jb']);
				$reg = M ( 'tgbz' )->where(array ('id' => I ('get.id')))->delete();

				if ($reg) {
					die("<script>alert('取消成功!');window.location.href='/';</script>");
				}else {
					die("<script>alert('取消失败!');window.location.href='/';</script>");
				}
			}
		}
	}
	//取消等待接受帮助
	public function jsbz_del() {
		//die("<script>alert('不可取消!');window.location.href='/';</script>");
		if (!preg_match ( '/^[0-9]{1,10}$/', I ('get.id') )) {
			$this->success('非法操作,将冻结账号!');
		}else{
			$userinfo = M ( 'jsbz' )->where ( array ('id' => I ('get.id'),'zt'=>'0') )->find ();
			//dump(I ('get.id'));
			//dump($userinfo['ue_accname']);die;
			if ($userinfo['user']<>$_SESSION ['uname']) {
				$this->success('订单当前状态不可取消!');
			}else{

				$reg = M ( 'jsbz' )->where(array ('id' => I ('get.id')))->delete();
				$del_getInfo =  M ( 'userget' )->where(array ('jsbzID' => I('get.id')))->delete();
				if ($reg  && M('user')->where(array('UE_account' => $userinfo['user']))->setInc('UE_money',$userinfo['jb'])) {
					die("<script>alert('取消成功!');window.location.href='/';</script>");
				}else {
					die("<script>alert('取消失败!');window.location.href='/';</script>");
				}
			}
		}
	}



	public function pipei() {

		$xypipeije=10;
		$data=array(1,2,3,4,5,6,7,8);
		$tj=count($data);
		$sf_tcpp='0';
		for ($b=0;$b<$tj;$b++){
			if($sf_tcpp=='1'){break;}
			$tj_j=$tj-1;
			echo '===========<br>';
		for ($i=0;$i<$tj;$i++){
			if($b<$i){
				$pipeihe=$data[$b]+$data[$tj_j];
				if($pipeihe==$xypipeije){
					echo $data[$b].'+'.$data[$tj_j].'<br>';$sf_tcpp='1';break;
				}



			$tj_j--;
			}
		}
		}

	}

	public function home_ddxx(){

		$ppddxx=M('ppdd')->where(array('id'=>I('get.id')))->find();
		$g_user=M('user')->where(array('UE_account'=>$ppddxx['g_user']))->find();
		$g_user_t=M('user')->where(array('UE_account'=>$g_user['ue_accname']))->find();
		$p_user=M('user')->where(array('UE_account'=>$ppddxx['p_user']))->find();
		$p_user_t=M('user')->where(array('UE_account'=>$p_user['ue_accname']))->find();

		$this->ppddxx=$ppddxx;
		$this->g_user=$g_user;
		$this->p_user=$p_user;

		$this->g_user_t=$g_user_t;
		$this->p_user_t=$p_user_t;
		$this->display('home_ddxx');
	}

	public function home_ddxx_ly(){
		$ppddxx=M('ppdd')->where(array('id'=>I('get.id')))->find();;
		$this->ppddxx=$ppddxx;



		//////////////////----------
		$User = M ( 'ppdd_ly' ); // 实例化User对象

		$map['ppdd_id']=I('get.id');
		$list = $User->where ( $map )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		//dump($list);die;
		/////////////////----------------



		$this->display('home_ddxx_ly');
	}


	public function home_ddxx_ly_cl(){

		$data_P = I ( 'post.' );
		//echo strlen(trim($data_P['mesg']));die;
		$ppddxx=M('ppdd')->where(array('id'=>$data_P['id']))->find();

		$user1 = M ();
		if ($ppddxx['p_user']<>$_SESSION['uname']&&$ppddxx['g_user']<>$_SESSION['uname']) {

			die("<script>alert('非法操作！');history.back(-1);</script>");
		} elseif( strlen(trim($data_P['mesg']))<1) {
		    die("<script>alert('留言内容不能为空！');history.back(-1);</script>");
		}else {
			$userData = M ( 'user' )->where ( array (
					'UE_ID' => $_SESSION ['uid']
			) )->find ();

			$record['ppdd_id'] = $ppddxx['id'];
			$record['user']	= $_SESSION['uname'];
			$record['user_nc']	= $userData['ue_theme'];
			$record['nr']	= $data_P['mesg'];
			$record['date']		= date ( 'Y-m-d H:i:s', time () );;

			$reg = M ( 'ppdd_ly' )->add ( $record );




			if ($reg) {
				$this->success( '留言成功!' );
			} else {
				$this->success( '留言失败!' );
			}

		}

	}

	public function home_ddxx_pcz(){
		$this->id = I ( 'get.id' );
		$ppdd = M('ppdd');
		$ob = $ppdd->where("id={$this->id}")->find();
		$this->assign('ob',$ob);
		$this->display('home_ddxx_pcz');
	}



	public function home_ddxx_pcz_cl(){

		$data_P = I ( 'post.' );
		//echo strlen(trim($data_P['mesg']));die;
		$ppddxx=M('ppdd')->where(array('id'=>$data_P['id'],'zt'=>'0'))->find();
		if($ppddxx['dk_ci']>$ppddxx['sk_ci']){
			die("<script>alert('对方未确认收款，无法再次打款！');history.back(-1);</script>");
		}
		//如果不是本人
		if ($ppddxx['p_user']<>$_SESSION['uname']) {

			die("<script>alert('非法操作！');history.back(-1);</script>");
		}elseif($data_P['comfir2']<>'1') {
		    die("<script>alert('请选择,我完成打款！');history.back(-1);</script>");
		}else {
			if(empty($data_P['face180'])){
				die("<script>alert('请上传证明截图');history.back(-1);</script>");
			}
			if($data_P['comfir2']=='1'){
				M('ppdd')->where(array('id'=>$data_P['id'],'zt'=>'0'))->save(array('pic'=>$data_P['face180'],'zt'=>'1','date_hk'=>date ( 'Y-m-d H:i:s', time () )));
			}

			if($data_P['content']<>''){
				$userData = M('user')->where(array('UE_ID' =>$_SESSION ['uid']))->find();
				$record['ppdd_id'] = $ppddxx['id'];
				//-------------------->ppddd的外键id
				$record['user']	= $_SESSION['uname'];
				//------------------------>留言者也就是打款人
				$record['user_nc']	= $userData['ue_theme'];
				//-------------------->留言者也就是打款人的昵称
				$record['nr']	= $data_P['content'];
				//------------------------------->打款时的留言
				$record['date']		= date('Y-m-d H:i:s',time());
				//------------------>打款时间
				$reg = M('ppdd_ly')->add($record );
			}

				$peiduidate=M('tgbz')->where(array('id'=>$ppddxx['p_id'],'user'=>$ppddxx['p_user']))->find();
				$data2['user']=$ppddxx['p_user'];
				$data2['r_id']=$ppddxx['id'];	//------------------------->ppdd的外键id
				$data2['date']=$peiduidate['date'];            //---------------------->配对时间
				$data2['note']='提供帮助';				//------------------>说明
				$data2['jb']=$ppddxx['jb']+$ppddxx['jb']*(C('lixi')/100);          //--------------------------------
				if(M('user_jj')->add($data2)){       //--------------------------

					$tgbz_user_xx=M('user')->where(array('UE_account'=>$ppddxx['p_user']))->find();//充值人详细
					$get_user=M('user')->where(array('UE_account'=>$ppddxx['g_user']))->find();
					if($tgbz_user_xx['ue_level']==0){
						M('user')->where(array('UE_account'=>$tgbz_user_xx['ue_account']))->save(array('UE_level'=>1,'levelname'=>'B1'));
					}
					if($get_user['ue_phone']) sendSMS($get_user['ue_phone'],"您好！您申请帮助的资金：".$ppddxx['jb']."元，对方已打款。请查收！");
					M('ppdd')->where(array('id'=>$data_P['id']))->setInc('dk_ci',1);
					die("<script>alert('提交成功,请联系对方确认收款！');parent.location.reload();</script>");
				}else{
					die("<script>alert('提交失败,请联系管理员！');history.back(-1);</script>");
				}
		}
	}

	public function home_ddxx_gcz(){
		$this->id = I ( 'get.id' );
		$ppdd = M('ppdd');
		$ob = $ppdd->where("id={$this->id}")->find();
		$this->assign('ob',$ob);
		$this->display('home_ddxx_gcz');
	}

	public function home_ddxx_gcz_cl(){
		$data_P = I ( 'post.' );
		$ppddxx=M('ppdd')->where(array('id'=>$data_P['id'],'zt'=>'1'))->find();
		//获取提交的id所对应的并且已经支付的数据
		if ($ppddxx['g_user']<>$_SESSION['uname']) {
			die("<script>alert('非法操作！');history.back(-1);</script>");
		}elseif($data_P['comfir']<>'1'&&$data_P['comfir']<>'2'&&$data_P['comfir']<>'3') {
			die("<script>alert('请选择,确认收款或未收到款投诉！');history.back(-1);</script>");
		}elseif($ppddxx['ts_zt']=='3') {
			die("<script>alert('".C("jjdktime")."小时未确认收款,已被投诉！');history.back(-1);</script>");
		}else {
			if($data_P['comfir']=='1'){
				//充值人详细
			    $tgbz_user_xx=M('user')->where(array('UE_account'=>$ppddxx['p_user']))->find();

				//在配对表中写人zt = 2 说明已经交易成功
				M('ppdd')->where(array('id'=>$data_P['id'],'zt'=>'1'))->save(array('zt'=>'2'));//更新此订单状态

				if($tgbz_user_xx['ue_accname']<>''){
					//想法领导奖
					LingDaoJiang($tgbz_user_xx['ue_accname'],$ppddxx['jb'],$tgbz_user_xx['ue_account']);
			    }
				M('user')->where("UE_account='".$tgbz_user_xx['ue_account']."'")->setField('isNew',0);

				//获取接收帮助交易的金额
				$txyqr=M('ppdd')->where(array('g_id'=>$ppddxx['g_id'],'zt'=>'2'))->sum('jb');

				//其实这里应该加个排序限制下
				$txzs=M('jsbz')->where(array('id'=>$ppddxx['g_id']))->find();
				if($txzs['jb']==$txyqr){
					M('jsbz')->where(array('id'=>$ppddxx['g_id']))->save(array('qr_zt'=>'1'));
					//提现订单已确认
				}

				$czyqr=M('ppdd')->where(array('p_id'=>$ppddxx['p_id'],'zt'=>'2'))->sum('jb');


				$czzs=M('tgbz')->where(array('id'=>$ppddxx['p_id']))->find();
				if($czzs['jb']==$czyqr){
					M('tgbz')->where(array('id'=>$ppddxx['p_id']))->save(array('qr_zt'=>'1'));
					//提现订单已确认
				}



			    /**更新上次可提现状态**/
			    $jid = M('user_jj')->where("r_id=".$data_P['id'])->order("id DESC")->getField('id');
			    $ujid = M('user_jj')->where("id<{$jid}")->order("id DESC")->getField('id');
			    if($ujid){
			    	M('user_jj')->where("id=".$ujid)->setField('status',1);
			    }

			    /**释放冻结钱包**/
			    if(C('isdongjie')){
			    	$bl = $ppddxx['jb']*(C('sfbl')/100);
			    	//当用户冻结钱包小于释放比例时，释放全部钱包
			    	if($tgbz_user_xx['dongjie']<$bl){
			    		$bl = $tgbz_user_xx['dongjie'];
			    	}
			    	if($bl){
			    		$note3 = "释放冻结钱包".C('sfbl')."%";
					    $record3 ["user"] = $tgbz_user_xx['ue_account'];
					    $record3 ["jb"] = $bl;
					    $record3 ["jj"] = $bl;
					    $record3 ["zt"] = 1;
					    $record3 ["r_id"] = 0;
					    $record3 ["note"] = $note3;
					    $record3 ["from"] = '';
					    $record3["date"] = date ( 'Y-m-d H:i:s', time () ); //操作时间
					    $reg4 = M('user_jl')->add($record3);
					    M('user')->where("UE_account='".$tgbz_user_xx['ue_account']."'")->setInc("jl_he",$bl);
					    M('user')->where("UE_account='".$tgbz_user_xx['ue_account']."'")->setDec("dongjie",$bl);
			    	}
			    }

			    M('ppdd')->where(array('id'=>$data_P['id']))->setInc('sk_ci',1);
				die("<script>alert('此次交易成功！');parent.location.reload();</script>");

			}elseif($data_P['comfir']=='2'){
				if($ppddxx['ts_zt']=='2'){
					die("<script>alert('您已经投诉过了,请等待管理员审核！');parent.location.reload();</script>");
				}else{

					if($data_P['face180']==''){
						die("<script>alert('请上传截图！');parent.location.reload();</script>");
					}else{
					M('ppdd')->where(array('id'=>$data_P['id'],'zt'=>'1'))->save(array('ts_zt'=>'2','pic2'=>$data_P['face180']));
					die("<script>alert('投诉成功,等待管理员审核,如果在审核过程中你收到款了,您还可以确认收款！');parent.location.reload();</script>");
					}
				}
			}
		}
	}

	public function home_ddxx_pic_no(){
		$this->id = I ( 'get.id' );
		$this->display('home_ddxx_pic_no');
	}

	public function home_ddxx_g_wdk(){


		$this->id = I ( 'get.id' );

		$this->display('home_ddxx_g_wdk');
	}
	public function home_ddxx_g_wqr(){


		$this->id = I ( 'get.id' );

		$this->display('home_ddxx_g_wqr');
	}


	//------------------------------------------------》投诉处理
	public function home_ddxx_g_wdk_cl(){

		$data_P = I ( 'post.' );




// 		$NowTime = '2015-07-01 01:56:17';
// 		$aab=strtotime($NowTime);
// 		$aab2=$aab+86400+86400;

// 		echo "Today:",date('Y-m-d H:i:s',$aab),"<br>";
// echo "Tomorrow:",date('Y-m-d H:i:s',$aab2);die;



		//echo strlen(trim($data_P['mesg']));die;
		$ppddxx=M('ppdd')->where(array('id'=>$data_P['id'],'zt'=>'0'))->find();
		$NowTime = $ppddxx['date'];
		$aab=strtotime($NowTime);
		$aab2=$aab+3600*C("jjdktime");
		$bba = date('Y-m-d H:i:s',time());
		$bba2=strtotime($bba);

		/*if ($ppddxx['g_user']<>$_SESSION['uname']) {

			//die("<script>alert('非法操作！');history.back(-1);</script>");
		}else*/if($aab2>$bba2) {
			die("<script>alert('汇款时间未超过".C("jjdktime")."小时,暂不能投诉,如未打款,请与提供帮助者取得联系！');history.back(-1);</script>");
		}elseif($data_P['comfir']<>'1'&&$data_P['comfir']<>'2') {
			die("<script>alert('请选择,确认投诉！');history.back(-1);</script>");
		}elseif($ppddxx['ts_zt']=='1'&&$data_P['comfir']<>'2') {
			die("<script>alert('您已经投诉过了,请等待管理员处理！');history.back(-1);</script>");
		}else {

			//echo '成功';die;
			if($data_P['comfir']=='1'){
				M('ppdd')->where(array('id'=>$data_P['id'],'zt'=>'0'))->save(array('ts_zt'=>'1'));
				die("<script>alert('投诉提交成功,请等待管理员审核通过！');parent.location.reload();</script>");
			}elseif($data_P['comfir']=='2'){
				M('ppdd')->where(array('id'=>$data_P['id'],'zt'=>'0'))->save(array('ts_zt'=>'0'));
				die("<script>alert('投诉取消成功,卖家可以继续汇款！');parent.location.reload();</script>");
			}

		}
	}




	public function home_ddxx_g_wqr_cl(){

		$data_P = I ( 'post.' );

	//dump($data_P);die;


		// 		$NowTime = '2015-07-01 01:56:17';
		// 		$aab=strtotime($NowTime);
		// 		$aab2=$aab+86400+86400;

		// 		echo "Today:",date('Y-m-d H:i:s',$aab),"<br>";
		// echo "Tomorrow:",date('Y-m-d H:i:s',$aab2);die;







		//echo strlen(trim($data_P['mesg']));die;
		$ppddxx=M('ppdd')->where(array('id'=>$data_P['id'],'zt'=>'1'))->find();
		$NowTime = $ppddxx['date_hk'];
		$aab=strtotime($NowTime);
		$aab2=$aab+3600*C("jjdktime");
		$bba = date('Y-m-d H:i:s',time());
		$bba2=strtotime($bba);

		if ($ppddxx['p_user']<>$_SESSION['uname']) {

			die("<script>alert('非法操作！');history.back(-1);</script>");
		}elseif($aab2>$bba2) {
			die("<script>alert('确认时间未超过".C("jjdktime")."小时,暂不能投诉,如未确认,请与对方取得联系！');history.back(-1);</script>");
		}elseif($data_P['comfir']<>'1'&&$data_P['comfir']<>'2') {
			die("<script>alert('请选择,确认或取消！');history.back(-1);</script>");
		}elseif($ppddxx['ts_zt']=='2') {
			die("<script>alert('您已被对方投诉,请与对方取得联系！');history.back(-1);</script>");
		}else{










			//dump($data_P);die;
			//echo strlen(trim($data_P['mesg']));die;




				if($data_P['comfir']=='1'){

					M('ppdd')->where(array('id'=>$data_P['id'],'zt'=>'1'))->save(array('zt'=>'2'));//更新此订单状态

					$txyqr=M('ppdd')->where(array('g_id'=>$ppddxx['g_id'],'zt'=>'2'))->sum('jb');


					$txzs=M('jsbz')->where(array('id'=>$ppddxx['g_id']))->find();
					if($txzs['jb']==$txyqr){
						M('jsbz')->where(array('id'=>$ppddxx['g_id']))->save(array('qr_zt'=>'1'));//提现订单已确认
					}


					$czyqr=M('ppdd')->where(array('p_id'=>$ppddxx['p_id'],'zt'=>'2'))->sum('jb');


					$czzs=M('tgbz')->where(array('id'=>$ppddxx['p_id']))->find();
					if($czzs['jb']==$czyqr){
						M('tgbz')->where(array('id'=>$ppddxx['p_id']))->save(array('qr_zt'=>'1'));//提现订单已确认
					}



					////更新提现订单状态

					//M('tgbz')->where(array('id'=>$ppddxx['p_id']))->setInc('jycg_ds',1);

					// 			    $tgbzcs=M('tgbz')->where(array('id'=>$ppddxx['p_id']))->find();
					// 			    if($tgbzcs['cf_ds']==$tgbzcs['jycg_ds']){
					// 			    	M('tgbz')->where(array('id'=>$ppddxx['p_id']))->save(array('qr_zt'=>'1'));//更新充值订单状态
					// 			    }

					//推荐奖10%

					$tgbz_user_xx=M('user')->where(array('UE_account'=>$ppddxx['p_user']))->find();//充值人详细
					//echo $ppddxx['p_id'];die;
					if($tgbz_user_xx['ue_accname']<>''){
						//===2015/12/1  add
						fftuijianmoney($tgbz_user_xx['ue_accname'],$ppddxx['jb'],1);
						//===end

						//$money_jlj1=;

						$mmtemparr = explode(',',C("jjjldsrate"));

						if($tgbz_user_xx['zcr']<>''){
							$zcr2=jlj($tgbz_user_xx['zcr'],$ppddxx['jb']*((float)$mmtemparr[0])/100,'经理奖'.$mmtemparr[0].'%');
							if($zcr2<>''){
								$zcr3=jlj($zcr2,$ppddxx['jb']*((float)$mmtemparr[1])/100,'经理奖'.$mmtemparr[1].'%');
								//echo $ppddxx['p_user'].'sadfsaf';die;
								if($zcr3<>''){
									$zcr4=jlj($zcr3,$ppddxx['jb']*((float)$mmtemparr[2])/100,'经理奖'.$mmtemparr[2].'%');
									if($zcr4<>''){
										$zcr5=jlj($zcr4,$ppddxx['jb']*((float)$mmtemparr[3])/100,'经理奖'.$mmtemparr[3].'%');
										if($zcr5<>''){
											jlj($zcr5,$ppddxx['jb']*((float)$mmtemparr[4])/100,'经理奖'.$mmtemparr[4].'%');
										}
									}
								}
							}
						}





					}






					die("<script>alert('系统自动处理成功！');parent.location.reload();</script>");


				}
















		}
	}

	public function tgbz_list_cf(){


		$User = M ( 'tgbz' ); // 实例化User对象
		$data = I ( 'post.user' );

		$this->z_jgbz=$User->sum('jb');
		$this->z_jgbz2=$User->where(array('qr_zt'=>'1'))->sum('jb');
		$this->z_jgbz3=$User->where(array('qr_zt'=>array('neq','1')))->sum('jb');
		//$map ['UG_dataType'] = array('IN',array('mrfh','tjj','kdj','mrldj','glj'));

		$map['zt']=0;

		if(I ( 'get.cz' )==1){
			$map['zt']=1;
		}
		if($data<>''){
			$map['user']=$data;
		}
		$count = $User->where ( $map )->count (); // 查询满足要求的总记录数
		//$page = new \Think\Page ( $count, 3 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

		$p = getpage($count,20);

		$list = $User->where ( $map )->order ( 'id DESC' )->limit ( $p->firstRow, $p->listRows )->select ();
		//dump($list);die;
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page', $p->show() ); // 赋值分页输出



		$this->display('index/tgbz_list_cf');
	}


	public function jsbz_list_cf(){



		$User = M ( 'jsbz' ); // 实例化User对象
		$data = I ( 'post.user' );

		$this->z_jgbz=$User->sum('jb');
		$this->z_jgbz2=$User->where(array('qr_zt'=>'1'))->sum('jb');
		$this->z_jgbz3=$User->where(array('qr_zt'=>array('neq','1')))->sum('jb');
		//$map ['UG_dataType'] = array('IN',array('mrfh','tjj','kdj','mrldj','glj'));

		$map['zt']=0;

		if(I ( 'get.cz' )==1){
			$map['zt']=1;
		}
		if($data<>''){
			$map['user']=$data;
		}
		$count = $User->where ( $map )->count (); // 查询满足要求的总记录数
		//$page = new \Think\Page ( $count, 3 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

		$p = getpage($count,20);

		$list = $User->where ( $map )->order ( 'id DESC' )->limit ( $p->firstRow, $p->listRows )->select ();
		//dump($list);die;
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page', $p->show() ); // 赋值分页输出



		$this->display('index/jsbz_list_cf');
	}

	public function tgbz_list_cf_cl(){
		$data=I('post.');
		$p_user=M('tgbz')->where(array('id'=>$data['pid']))->find();
		if (! preg_match ( '/^[0-9,]{1,100}$/', I('post.arrid') )) {
			$this->error( '格式不对!' );
			die;
		}
		$arr = explode(',',I('post.arrid'));
		//dump($arr);
		if(array_sum($arr)<>$p_user['jb']){
			$this->error( '拆分金额不对!' );
			die;
		}




		$p_user1=M('tgbz')->where(array('id'=>$data['pid']))->find();

		$pipeits=0;
		foreach($arr as $value){
			if($value<>''){
				$data2['zffs1']=$p_user1['zffs1'];
				$data2['zffs2']=$p_user1['zffs2'];
				$data2['zffs3']=$p_user1['zffs3'];
				$data2['user']=$p_user1['user'];
				$data2['jb']=$value;
				$data2['user_nc']=$p_user1['user_nc'];
				$data2['user_tjr']=$p_user1['user_tjr'];
				$data2['date']=$p_user1['date'];
				$data2['zt']=$p_user1['zt'];
				$data2['qr_zt']=$p_user1['qr_zt'];
				$varid = M('tgbz')->add($data2);
				$pipeits++;
			}


		}

		M('tgbz')->where(array('id'=>$data['pid']))->delete();




		$this->success('匹配成功!拆分成'.$pipeits.'条订单!');
	}

	public function jsbz_list_cf_cl(){
		$data=I('post.');
		$p_user=M('jsbz')->where(array('id'=>$data['pid']))->find();
		if (! preg_match ( '/^[0-9,]{1,100}$/', I('post.arrid') )) {
			$this->error( '格式不对!' );
			die;
		}
		$arr = explode(',',I('post.arrid'));
		//dump($arr);
		if(array_sum($arr)<>$p_user['jb']){
			$this->error( '拆分金额不对!' );
			die;
		}




		$p_user1=M('jsbz')->where(array('id'=>$data['pid']))->find();

		$pipeits=0;
		foreach($arr as $value){
			if($value<>''){
				$data2['zffs1']=$p_user1['zffs1'];
				$data2['zffs2']=$p_user1['zffs2'];
				$data2['zffs3']=$p_user1['zffs3'];
				$data2['user']=$p_user1['user'];
				$data2['jb']=$value;
				$data2['user_nc']=$p_user1['user_nc'];
				$data2['user_tjr']=$p_user1['user_tjr'];
				$data2['date']=$p_user1['date'];
				$data2['zt']=$p_user1['zt'];
				$data2['qr_zt']=$p_user1['qr_zt'];
				$varid = M('jsbz')->add($data2);
				$pipeits++;
			}


		}

		M('jsbz')->where(array('id'=>$data['pid']))->delete();




		$this->success('匹配成功!拆分成'.$pipeits.'条订单!');
	}



		// QQ
	public function jujue(){
		if(IS_POST){
			$id =I('id',0,'intval');
			if($id>0){

				if(empty($pipei)){
					echo json_encode(array(
					'error' => 1,
					'msg' => '拒绝付款失败!无法重新匹配',
					));
				}
				//提供帮助者表单信息

				//file_put_contents('./t.txt',var_export(M('jsbz')->where(array('id'=>$pipei['p_id']))->find(),true));
				$applyData = M('tgbz')->where(array('id'=>$pipei['p_id']))->save(array('zt'=>0,'cf_ds'=>0));
				//接收帮助者表单信息

				$needData = M('jsbz')->where(array('id'=>$pipei['g_id']))->save(array('zt'=>0,'cf_ds'=>0));

				 M("ppdd")->where(array('id'=>$id))->delete();
				echo json_encode(array(
						'error' => 0,
						'msg' => '拒绝付款成功，等待匹配中',
					));
			}else{
				echo json_encode(array(
					'error' => 1,
					'msg' => '拒绝付款失败!无法重新匹配',
				));
			}
		}else{
			$this->error('非法操作！');
		}
    }

    public function chongxinpipei($id){
    	$pipei  = M("ppdd")->where(array('id'=>$id))->find();

		$applyData = M('tgbz')->where(array('id'=>$pipei['p_id']))->save(array('zt'=>0,'cf_ds'=>0));
		//接收帮助者表单信息

		$needData = M('jsbz')->where(array('id'=>$pipei['g_id']))->save(array('zt'=>0,'cf_ds'=>0));

		 M("ppdd")->where(array('id'=>$id))->delete();
    }



    	public function messageInbox(){
		$this->display("Index/messageInbox");
	}

	public function pdList(){
		$User = M ( 'tgbz' ); // 实例化User对象

		$map['user']=$_SESSION['uname'];
		$count = $User->where ( $map )->count (); // 查询满足要求的总记录数
		//$page = new \Think\Page ( $count, 3 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

		$p = getpage($count,100);

		$list = $User->where ( $map )->order ( 'id DESC' )->limit ( $p->firstRow, $p->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page', $p->show() ); // 赋值分页输出

		//提供帮助配对流程
		//////////////////----------
		$User = M ( 'ppdd' ); // 实例化User对象

		$map2['p_user']=$_SESSION['uname'];
		$count2 = $User->where ( $map2 )->count (); // 查询满足要求的总记录数
		//$page = new \Think\Page ( $count, 3 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

		$p2 = getpage($count2,100);

		$Plists = $User->where ( $map2 )->order ( 'id DESC' )->limit ( $p2->firstRow, $p2->listRows )->select ();
		$this->assign ( 'Plists', $Plists ); // 赋值数据集
		$this->assign ( 'page2', $p2->show() ); // 赋值分页输出

		//导航激活
		$this->she_list = true;

		$this->display('Index/pdList');
	}

	public function  gdList(){
		//////////////////----------
		$User = M ( 'jsbz' ); // 实例化User对象

		$map['user']=$_SESSION['uname'];
		$count = $User->where ( $map )->count (); // 查询满足要求的总记录数
		//$page = new \Think\Page ( $count, 3 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

		$p = getpage($count,100);

		$list = $User->where ( $map)->order ( 'id DESC' )->limit ( $p->firstRow, $p->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page', $p->show() ); // 赋值分页输出
		/////////////////----------------






		$User = M ( 'ppdd' ); // 实例化User对象

		$map3['g_user']=$_SESSION['uname'];
		$count3 = $User->where ( $map3 )->count (); // 查询满足要求的总记录数
		//$page = new \Think\Page ( $count, 3 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)

		$p3 = getpage($count3,100);

		$glist = $User->where ( $map3 )->order ( 'id DESC' )->limit ( $p3->firstRow, $p3->listRows )->select ();
		$this->assign ( 'glist', $glist ); // 赋值数据集
		$this->assign ( 'gpage', $p3->show() ); // 赋值分页输出


		//导航激活
		$this->de_list = true;

		$this->display('Index/gdList');
	}

	public function checkamount(){
		$amount = I('get.amount');
		$tgbz = M('tgbz');
		$uppd = $tgbz->where("user='".$_SESSION ['uname']."'")->order('id DESC')->getField("jb");
		if($uppd && $amount<$uppd){
			$this->ajaxReturn(array('status'=>0,'info'=>'排单金额必须大于或者等于上次排单金额：'.$uppd,'money'=>$uppd));
		}
		$this->ajaxReturn(array('status'=>1,'info'=>''));
	}

}