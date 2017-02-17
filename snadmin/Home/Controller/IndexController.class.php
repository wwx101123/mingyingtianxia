<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends CommonController
{

    public function main()
    {

        $this->display('index/main');
    }

    public function admin_add()
    {


        $this->display('index/admin_add');
    }

    public function df1()
    {

        $year = date("Y");
        $month = date("m");
        $day = date("d");
        $dayed = date("d") - 1;
        $dayBegin = mktime(0, 0, 0, $month, $day, $year);//当天开始时间戳
        $dayEnd = mktime(23, 59, 59, $month, $day, $year);//当天结束时间戳

        $dayBegined = mktime(0, 0, 0, $month, $dayed, $year);//当天开始时间戳
        $dayEnded = mktime(23, 59, 59, $month, $dayed, $year);//当天结束时间戳

        $startTime = date('Y-m-d H:i:s', $dayBegin);
        $endTime = date('Y-m-d H:i:s', $dayEnd);

        $startTimed = date('Y-m-d H:i:s', $dayBegined);
        $endTimed = date('Y-m-d H:i:s', $dayEnded);
        //echo $endTimed;die;
        //今天註冊會員
        $zt = M('system')->where(array('SYS_ID' => 1))->find();
        //      $time2 = date('H');
        $this->zt = $zt;


        $ip = M('drrz')->where(array('user' => $_SESSION ['adminuser'], 'leixin' => 1))->order('id DESC')->limit(2)->select();

        $this->bcip = $ip[0];
        $this->scip = $ip[1];
        $this->jtzchy = M('user')->where("`UE_regTime`> '" . $startTime . "' AND `UE_regTime` < '" . $endTime . "'")->count("UE_ID");

        //今天激活會員
        $this->jtjhhy = M('user')->where("`UE_activeTime`> '" . $startTime . "' AND `UE_activeTime` < '" . $endTime . "'")->count("UE_ID");

        //昨天註冊會員
        $this->ztzchy = M('user')->where("`UE_regTime`> '" . $startTimed . "' AND `UE_regTime` < '" . $endTimed . "'")->count("UE_ID");

        //昨天激活會員
        $this->ztjhhy = M('user')->where("`UE_activeTime`> '" . $startTimed . "' AND `UE_activeTime` < '" . $endTimed . "'")->count("UE_ID");


        //總會員
        $this->zuser = M('user')->where("`UE_ID`> '0'")->count("UE_ID");

        //總激活會員
        $this->zjhuser = M('user')->where("`UE_ID`> '0' AND `UE_check` = '1'")->count("UE_ID");

        //總出局會員
        $this->zcjuser = M('user')->where("`UE_ID`> '0' AND `UE_check` = '1' AND `UE_stop` = '0'")->count("UE_ID");

        //總金幣
        $this->zjb = M('user')->sum('UE_money');

        //總銀幣
        $this->zyb = M('user')->sum('ybhe');

        //總鑽石幣
        $this->zzsb = M('user')->sum('zsbhe');


        $this->display('index/index');
    }

    public function gb()
    {


        M('system')->where(array('SYS_ID' => 1))->save(array('zt' => 1));
        //      $time2 = date('H');
        $this->success('关闭成功!');


    }

    public function kq()
    {


        M('system')->where(array('SYS_ID' => 1))->save(array('zt' => 0));
        //      $time2 = date('H');
        $this->success('开启成功!');


    }

    public function top()
    {
        $this->display('index/top');
    }

    public function team()
    {
        $this->user = I('get.user', '0');
        $this->display('index/team');
    }

    public function left()
    {
        $this->display('index/left');
    }

    public function user_xg()
    {

        if (I('get.user') <> '') {
            $this->userdata = M('user')->where(array(
                'UE_account' => I('get.user')
            ))->find();
            $this->display('index/user_xg');
        } else {
            $this->error('非法操作!');
        }


    }

    public function tixian_xg()
    {

        if (I('get.id') <> '') {
            $this->userdata = M('tixian')->where(array(
                'id' => I('get.id')
            ))->find();
            $this->display('index/tixian_xg');
        } else {
            $this->error('非法操作!');
        }


    }


    public function admin_xg()
    {

        if (I('get.user') <> '') {
            $this->userdata = M('member')->where(array(
                'MB_username' => I('get.user')
            ))->find();
            $this->display('index/admin_xg');
        } else {
            $this->error('非法操作!');
        }


    }


    public function usercl()
    {

        //dump(I('post.'));

        $data['UE_check'] = I('post.UE_check');
        $data['UE_accName'] = I('post.UE_accName');
		$data['UE_theme'] = I('post.UE_theme');
		$data['sfjl'] = I('post.UE_stop');
        $data['UE_status'] = I('post.UE_status');
        if (I('post.UE_password') <> '') {
            $data['UE_password'] = md5(I('post.UE_password'));
        }
        if (I('post.UE_secpwd') <> '') {
            $data['UE_secpwd'] = md5(I('post.UE_secpwd'));
        }
        $data['UE_truename'] = I('post.UE_truename');
        $data['UE_sfz'] = I('post.UE_sfz');
        $data['weixin'] = I('post.weixin');
        $data['zfb'] = I('post.zfb');
        $data['yhmc'] = I('post.yhmc');
        $data['yhzh'] = I('post.yhzh');
        $data['email'] = I('post.email');
        $data['UE_qq'] = I('post.UE_qq');
        $data['UE_phone'] = I('post.UE_phone');
        $data['UE_level'] = I('post.UE_level');
        $data['levelname'] = I('post.levelname');
		if($data['UE_status']==1){
			$tgbz = M('tgbz');
			$data3 = array();
			$data3['zt'] = -1;
			$tgbz->where(array('user'=>I('post.UE_account')))->save($data3);
		}
        // dump(I('post.UE_account'));die;
        if (M('user')->where(array('UE_account' => I('post.UE_account')))->save($data)) {
            $this->success('修改成功!');
        } else {
            $this->success('修改失败!');
        }
    }
    public function tixiancl()
    {

        //dump(I('post.'));

        $data['id'] = I('post.id');
        $data['status'] = I('post.status');

        // dump(I('post.UE_account'));die;
        if (M('tixian')->where(array('id' => I('post.id')))->save($data)) {
            $this->success('修改成功!');
        } else {
            $this->success('修改失败!');
        }
    }

    public function admincl()
    {


        $data['MB_right'] = I('post.MB_right');
        if (I('post.MB_userpwd') <> '') {
            $data['MB_userpwd'] = md5(I('post.MB_userpwd'));
        }
        //dump($data);die;
        if (M('member')->where(array('MB_username' => I('post.MB_username')))->save($data)) {
            $this->success('修改成功!', '/shi.php/Home/Index/adminlist');
        } else {
            $this->success('修改失败!');
        }
    }


    public function adminadd()
    {


        $data['MB_username'] = I('post.MB_username');
        $data['MB_right'] = I('post.MB_right');
        $data['MB_userpwd'] = md5(I('post.MB_userpwd'));
        if (I('post.MB_username') <> '' && I('post.MB_right') <> '' && I('post.MB_userpwd') <> '') {
            //dump($data);die;
            if (M('member')->add($data)) {
                $this->success('添加成功!', '/shi.php/Home/Index/adminlist');
            } else {
                $this->success('添加失败!');
            }
        } else {
            $this->success('数据不能为空!');
        }
    }


    public function txlist()
    {


        $User = M('tixian'); // 實例化User對象
        $data = I('post.user');


        //$map ['UG_dataType'] = array('IN',array('mrfh','tjj','kdj','mrldj','glj'));

        if ($data <> '') {
            $map['UE_account'] = $data;
        }
        if (I('get.ip') <> '') {
            $map['UE_regIP'] = I('get.ip');
        }
        $count = $User->where($map)->count(); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)

        $p = getpage($count, 20);

        $list = $User->where($map)->order('id')->limit($p->firstRow, $p->listRows)->select();
        $this->assign('list', $list); // 賦值數據集
        $this->assign('page', $p->show()); // 賦值分頁輸出


        $this->display('index/txlist');
    }

    public function userlist()
    {


        $User = M('user'); // 實例化User對象
        $data = I('post.user');


        //$map ['UG_dataType'] = array('IN',array('mrfh','tjj','kdj','mrldj','glj'));

        if ($data <> '') {
            $map['UE_account'] = $data;
        }
        if (I('get.ip') <> '') {
            $map['UE_regIP'] = I('get.ip');
        }
		$year = date("Y");
        $month = date("m");
        $day = date("d");
        $dayed = date("d") - 1;
        $dayBegin = mktime(0, 0, 0, $month, $day, $year);//当天开始时间戳
        $dayEnd = mktime(23, 59, 59, $month, $day, $year);//当天结束时间戳
		$startTime = date('Y-m-d H:i:s', $dayBegin);
        $endTime = date('Y-m-d H:i:s', $dayEnd);
		$endTime = date('Y-m-d H:i:s', $dayEnd);
		$UE_activeTime = date('Y-m-d H:i:s', time()-1800);
		$today = $User->where("`UE_regTime`> '" . $startTime . "' AND `UE_regTime` < '" . $endTime . "'")->count();
		$today = empty($today)?0:$today;

		$todaylogin = $User->where("`UE_nowTime`> '" . $startTime . "' AND `UE_nowTime` < '" . $endTime . "'")->count();
		$nowlogin   = $User->where("`UE_activeTime`> '" . $UE_activeTime . "'")->count();
        $count = $User->where($map)->count(); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)

        $p = getpage($count, 20);

        $list = $User->where($map)->order('UE_ID')->limit($p->firstRow, $p->listRows)->select();
		$this->assign('today', $today);
		$this->assign('nowlogin', $nowlogin);
		$this->assign('todaylogin', $todaylogin);
		$this->assign('count', $count);

		//var_dump($list);
		//exit;
        $this->assign('list', $list); // 賦值數據集
        $this->assign('page', $p->show()); // 賦值分頁輸出
        $this->display('index/userlist');
    }

	public function pai_add()
    {


        $this->display('index/pai_add');
    }


    public function pai_add_cl()
    {

        if (IS_POST) {
            $data_P = I('post.');
            //dump($data_P);die;

            $user = M('user')->where(array(
                UE_account => $data_P['user']
            ))->find();

            if (!$user) {
                $this->error('用户 不存在！');
            } elseif (!preg_match('/^[0-9.]{1,10}$/', $data_P ['sl'])) {
                $this->error('请填生成数量！');
            } else {
                $cgsl = 0;
                for ($i = 0; $i < $data_P ['sl']; $i++) {
                    $pin = md5(sprintf("%0" . strlen(9) . "d", mt_rand(0, 99999999999)));
                    //$pin=0;
                    if (!M('pai')->where(array('pin' => $pin))->find()) {
                        $data['user'] = $data_P['user'];
                        $data['pin'] = $pin;
                        $data['zt'] = 0;
                        $data['sc_date'] = date('Y-m-d H:i:s', time());
                        if (M('pai')->add($data)) {
                            $cgsl++;
                        }
                    }
                }
                $this->success('成功添加激活码' . $cgsl . '个');
            }
        }
    }


    public function pai_list()
    {


        $User = M('pai'); // 實例化User對象
        $data = I('post.user');

        $User->count();
        //$map ['UG_dataType'] = array('IN',array('mrfh','tjj','kdj','mrldj','glj'));
        if (I('get.cz') == 0) {
            $map['zt'] = 0;
        }
        if (I('get.cz') == 1) {
            $map['zt'] = 1;
        }
        if ($data <> '') {
            $map['user'] = $data;
        }
        $count = $User->where($map)->count(); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)

        $p = getpage($count, 20);

        $list = $User->where($map)->order('id DESC')->limit($p->firstRow, $p->listRows)->select();
        $this->assign('list', $list); // 賦值數據集
        $this->assign('page', $p->show()); // 賦值分頁輸出


        $this->display('index/pai_list');
    }

    public function pai_del()
    {


        $User = M('user'); // 實例化User對象
        $data = I('get.id');


        if (M('pai')->where(array('id' => $data))->delete()) {
            $this->success('删除成功!');
        } else {
            $this->success('删除失败!');
        }


    }



    public function adminlist()
    {


        $User = M('member'); // 實例化User對象
        $data = I('post.user');


        //$map ['UG_dataType'] = array('IN',array('mrfh','tjj','kdj','mrldj','glj'));

        if ($data <> '') {
            $map['MB_username'] = $data;
        }

        $count = $User->where($map)->count(); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)

        $p = getpage($count, 20);

        $list = $User->where($map)->order('MB_ID')->limit($p->firstRow, $p->listRows)->select();
        $this->assign('list', $list); // 賦值數據集
        $this->assign('page', $p->show()); // 賦值分頁輸出


        $this->display('index/adminlist');
    }


    public function userdel()
    {


        $User = M('user'); // 實例化User對象
        $data = I('get.id');


        $userxx = M('user')->where(array('UE_ID' => $data))->find();

        if ($data <> '' && $userxx['ue_account'] <> '') {
            M('user')->where(array('UE_ID' => $data))->delete();
            $this->success('删除成功!');
        } else {
            $this->success('公司账号不能删除!');
        }


    }

    public function ppdd_list_del()
    {


        $User = M('user'); // 實例化User對象
        $data = I('get.id');


        $userxx = M('ppdd')->where(array('id' => $data))->find();

        if ($data <> '' && $userxx['id'] <> '') {
            M('ppdd')->where(array('id' => $data))->delete();
            M('tgbz')->where(array('id' => $userxx['p_id']))->delete();
            M('jsbz')->where(array('id' => $userxx['g_id']))->delete();
            $this->success('删除成功!');
        } else {
            $this->success('订单不存在!');
        }


    }

    public function tgbz_list_del()
    {


        $User = M('user'); // 實例化User對象
        $data = I('get.id');


        $userxx = M('tgbz')->where(array('id' => $data))->find();

        if ($data <> '' && $userxx['id'] <> '') {

            M('tgbz')->where(array('id' => $userxx['id']))->delete();

            $this->success('删除成功!');
        } else {
            $this->success('订单不存在!');
        }


    }

    public function jsbz_list_del()
    {


        $User = M('user'); // 實例化User對象
        $data = I('get.id');


        $userxx = M('jsbz')->where(array('id' => $data))->find();

        if ($data <> '' && $userxx['id'] <> '') {

            M('jsbz')->where(array('id' => $userxx['id']))->delete();

            $this->success('删除成功!');
        } else {
            $this->success('订单不存在!');
        }


    }

    public function admindel()
    {


        $User = M('member'); // 實例化User對象
        $data = I('get.id');


        $userxx = M('member')->where(array('MB_ID' => $data))->find();

        if ($data <> '' && $userxx['mb_username'] <> '') {
            M('member')->where(array('MB_ID' => $data))->delete();
            $this->success('删除成功!', '/shi.php/Home/Index/adminlist');
        } else {
            $this->success('不能删除!');
        }


    }


    public function usermb()
    {


        $User = M('user'); // 實例化User對象
        $data = I('get.id');


        $userxx = M('user')->where(array('UE_ID' => $data))->find();

        if ($data <> '' && $userxx['ue_account'] <> '') {
            if (M('user')->where(array('UE_ID' => $data))->save(array('UE_question' => '', 'UE_question2' => '', 'UE_question3' => '', 'UE_answer' => '', 'UE_answer2' => '', 'UE_answer3' => ''))) {
                $this->success('成功!');
            } else {
                $this->success('失败!');
            }
        } else {
            $this->success('用户不存在!');
        }


    }


    public function userbtc()
    {


        $User = M('user'); // 實例化User對象
        $data = I('get.cz');


        if ($data == 'n') {
            $map['btbdz'] = '0';
        } elseif ($data == 'y') {
            $map['btbdz'] = array('neq', '0');
        }
        $count = $User->where($map)->count(); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)

        $p = getpage($count, 20);

        $list = $User->where($map)->order('UE_ID')->limit($p->firstRow, $p->listRows)->select();
        $this->assign('list', $list); // 賦值數據集
        $this->assign('page', $p->show()); // 賦值分頁輸出


        $this->display('index/userbtc');
    }


    public function rggl()
    {


        $User = M('userjyinfo'); // 實例化User對象
        $data = I('get.cz');


        if ($data == 'n') {
            $map['UJ_jbmcStage'] = '0';
        } elseif ($data == 'y') {
            $map['UJ_jbmcStage'] = '1';
        }
        $map['UJ_dataType'] = 'rg';

        $count = $User->where($map)->count(); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)

        $p = getpage($count, 20);

        $list = $User->where($map)->order('UJ_ID')->limit($p->firstRow, $p->listRows)->select();
        $this->assign('list', $list); // 賦值數據集
        $this->assign('page', $p->show()); // 賦值分頁輸出


        $this->display('index/rggl');
    }

    public function rggldel()
    {


        $data = I('get.id');


        if ($data <> '') {
            if (M('userjyinfo')->where(array('UJ_ID' => $data))->delete()) {
                $this->success('删除成功');
            } else {
                $this->success('删除失败');
            }
        }
    }


    public function rgglsh()
    {


        $data = I('get.id');


        if ($data <> '') {

            $ddxx = M('userjyinfo')->where(array('UJ_ID' => $data))->find();

            if ($ddxx['uj_style'] == 'rgzsb') {

                M('user')->where(array('UE_account' => $ddxx['uj_usercount']))->setInc('zsbhe', $ddxx['uj_jbcount']);
                $userxx = M('user')->where(array('UE_account' => $ddxx['uj_usercount']))->find();
                $note3 = "原始鑽石幣購買";
                $record3 ["UG_account"] = $ddxx['uj_usercount']; // 登入轉出賬戶
                $record3 ["UG_type"] = 'zsb';
                $record3 ["zsb"] = $ddxx['uj_jbcount']; // 金幣
                $record3 ["zsb1"] = $ddxx['uj_jbcount']; //
                $record3 ["zsbhe"] = $userxx['zsbhe']; // 當前推薦人的金幣餘額
                $record3 ["UG_dataType"] = 'rg'; // 金幣轉出
                $record3 ["UG_note"] = $note3; // 推薦獎說明
                $record3["UG_getTime"] = date('Y-m-d H:i:s', time()); //操作時間
                $reg4 = M('userget')->add($record3);
                M('userjyinfo')->where(array('UJ_ID' => $data))->save(array('UJ_jbmcStage' => '1'));
                $this->success('处理成功');

            } elseif ($ddxx['uj_style'] == 'rgyb') {


                M('user')->where(array('UE_account' => $ddxx['uj_usercount']))->setInc('ybhe', $ddxx['uj_jbcount']);
                $userxx = M('user')->where(array('UE_account' => $ddxx['uj_usercount']))->find();
                $note3 = "原始银幣購買";
                $record3 ["UG_account"] = $ddxx['uj_usercount']; // 登入轉出賬戶
                $record3 ["UG_type"] = 'yb';
                $record3 ["yb"] = $ddxx['uj_jbcount']; // 金幣
                $record3 ["yb1"] = $ddxx['uj_jbcount']; //
                $record3 ["ybhe"] = $userxx['ybhe']; // 當前推薦人的金幣餘額
                $record3 ["UG_dataType"] = 'rg'; // 金幣轉出
                $record3 ["UG_note"] = $note3; // 推薦獎說明
                $record3["UG_getTime"] = date('Y-m-d H:i:s', time()); //操作時間
                $reg4 = M('userget')->add($record3);
                M('userjyinfo')->where(array('UJ_ID' => $data))->save(array('UJ_jbmcStage' => '1'));
                $this->success('处理成功');


            }


        }
    }


    public function jbzs()
    {
        $User = M('userget'); // 實例化User對象
        $map['UG_dataType'] = 'xtzs';

        $count = $User->where($map)->count(); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)

        $p = getpage($count, 20);
        //iniInfo();
        $list = $User->where($map)->order('UG_ID DESC')->limit($p->firstRow, $p->listRows)->select();
        $this->assign('list', $list); // 賦值數據集
        $this->assign('page', $p->show()); // 賦值分頁輸出

        $this->display('index/jbzs');
    }


    public function userbtccl()
    {


        $User = M('user'); // 實例化User對象
        //dump(I('post.UE_ID'));die;
        if (I('post.UE_ID') <> '' && I('post.btbdz') <> '0') {
            if ($User->where(array('UE_ID' => I('post.UE_ID')))->save(array('btbdz' => I('post.btbdz')))) {
                $this->success('修改成功!');
            } else {
                $this->success('修改失败!');
            }
        } else {
            $this->success('您没修改内容!');
        }

    }


    public function jbzscl()
    {


        $User = M('user'); // 實例化User對象
        //dump(I('post.UE_ID'));die;
        if (I('post.lx') == 'jb') {
            if (I('post.sl') <> '' && $User->where(array('UE_account' => I('post.user')))->find() <> 0 && preg_match('/^[0-9-]{1,20}$/', I('post.sl'))) {
                $user_zq = M('user')->where(array('UE_account' => I('post.user')))->find();
                if ($User->where(array('UE_account' => I('post.user')))->setInc('UE_money', I('post.sl'))) {


                    $userxx = M('user')->where(array('UE_account' => I('post.user')))->find();
                    $note3 = "系统操作";
                    $record3 ["UG_account"] = I('post.user'); // 登入轉出賬戶
                    $record3 ["UG_type"] = 'jb';
                    $record3 ["UG_money"] = I('post.sl'); // 金幣
                    $record3 ["UG_allGet"] = $user_zq['ue_money']; //
                    $record3 ["UG_balance"] = $userxx['ue_money']; // 當前推薦人的金幣餘額
                    $record3 ["UG_dataType"] = 'xtzs'; // 金幣轉出
                    $record3 ["UG_note"] = $note3; // 推薦獎說明
                    $record3["UG_getTime"] = date('Y-m-d H:i:s', time()); //操作時間
                    $reg4 = M('userget')->add($record3);


                    $this->success('金币赠送成功!');
                } else {
                    $this->success('金币赠送失败!');
                }
            } else {
                $this->success('用户 名不存在或填写有误!');
            }


        } elseif (I('post.lx') == 'dongjie') {
            if (I('post.sl') <> '' && $User->where(array('UE_account' => I('post.user')))->find() <> 0 && preg_match('/^[0-9-]{1,20}$/', I('post.sl'))) {
                $user_zq = M('user')->where(array('UE_account' => I('post.user')))->find();
                if ($User->where(array('UE_account' => I('post.user')))->setInc('dongjie', I('post.sl'))) {
                    $userxx = M('user')->where(array('UE_account' => I('post.user')))->find();
                    $note3 = "系统赠送冻结钱包";
                    $record3 ["UG_account"] = I('post.user'); // 登入轉出賬戶
                    $record3 ["UG_type"] = 'dongjie';
                    $record3 ["UG_money"] = I('post.sl'); // 金幣
                    $record3 ["UG_allGet"] = $user_zq['dongjie']; //
                    $record3 ["UG_balance"] = $userxx['dongjie']; // 當前推薦人的金幣餘額
                    $record3 ["UG_dataType"] = 'xtzs'; // 金幣轉出
                    $record3 ["UG_note"] = $note3; // 推薦獎說明
                    $record3["UG_getTime"] = date('Y-m-d H:i:s', time()); //操作時間
                    $reg4 = M('userget')->add($record3);
                    $this->success('冻结钱包赠送成功!');
                } else {
                    $this->success('冻结钱包赠送失败!');
                }
            } else {
                $this->success('用户 名不存在或填写有误!');
            }
        } elseif (I('post.lx') == 'zsb') {
            if (I('post.sl') <> '' && $User->where(array('UE_account' => I('post.user')))->find() <> 0 && preg_match('/^[0-9-]{1,20}$/', I('post.sl'))) {
                if ($User->where(array('UE_account' => I('post.user')))->setInc('zsbhe', I('post.sl'))) {
                    $userxx = M('user')->where(array('UE_account' => I('post.user')))->find();
                    $note3 = "系统赠送";
                    $record3 ["UG_account"] = I('post.user'); // 登入轉出賬戶
                    $record3 ["UG_type"] = 'zsb';
                    $record3 ["zsb"] = I('post.sl'); // 金幣
                    $record3 ["zsb1"] = I('post.sl'); //
                    $record3 ["zsbhe"] = $userxx['zsbhe']; // 當前推薦人的金幣餘額
                    $record3 ["UG_dataType"] = 'xtzs'; // 金幣轉出
                    $record3 ["UG_note"] = $note3; // 推薦獎說明
                    $record3["UG_getTime"] = date('Y-m-d H:i:s', time()); //操作時間
                    $reg4 = M('userget')->add($record3);


                    $this->success('钻石币赠送成功!');
                } else {
                    $this->success('钻石币赠送失败!');
                }
            } else {
                $this->success('用户 名不存在或填写有误!');
            }
        }

    }

    public function tj_zrjj_cl()
    {
        header("Content-Type:text/html; charset=utf-8");

        if (IS_POST) {


            //时间
            $NowTime = date('Y-m-d H:i:s', time());

            $gxTime = $NowTime;//每日分紅的時間
            //echo $gxTime;

            $year = date("Y");
            $month = date("m");
            $day = date("d");

            $dayBegin = mktime(0, 0, 0, $month, $day, $year);//當天開始時間戳
            $dayEnd = mktime(23, 59, 59, $month, $day, $year);//當天結束時間戳

            $startTime = date('Y-m-d H:i:s', $dayBegin);
            $endTime = date('Y-m-d H:i:s', $dayEnd);

            $startTimed = date('Y-m-d H:i:s', $dayBegin);
            $endTimed = date('Y-m-d H:i:s', $dayEnd);


            //时间


            //昨天开始

            $year = date("Y");
            $month = date("m");
            $day = date("d");

            $dayBegin = mktime(0, 0, 0, $month, $day, $year) - 86400;//當天開始時間戳
            $dayEnd = mktime(23, 59, 59, $month, $day, $year) - 86400;//當天結束時間戳

            $startTime = date('Y-m-d H:i:s', $dayBegin);
            $endTime = date('Y-m-d H:i:s', $dayEnd);

            $startTimed = date('Y-m-d H:i:s', $dayBegin);
            $endTimed = date('Y-m-d H:i:s', $dayEnd);

            //echo $startTimed."<br>";
            //echo $endTimed."<br>";die;


            //昨天结束
            $otsystem = M('system')->where("SYS_ID ='1'")->find();

            $res = M('user')->where("UE_check ='1' and UE_activeTime > '" . $startTimed . "' and UE_activeTime < '" . $endTimed . "'")->select();

            //dump($otsystem);die; echo $val['ue_accname'];
            $tjj_tj = 0;
            $tjj1_tj = 0;
            $tjj2_tj = 0;
            $bdj_tj = 0;
            foreach ($res as $val) {
                if ($val['ue_accname'] <> '') {
                    $tjr_1 = M('user')->where("UE_account='" . $val['ue_accname'] . "'")->find();
                    $tjr_1_he = $tjr_1['ue_money'] + $otsystem['a_kd_zsb'] * 2 * $otsystem['a_ztj'];
                    M('user')->where("UE_account='" . $tjr_1['ue_account'] . "'")->save(array('UE_money' => $tjr_1_he));


                    $record3 ["UG_account"] = $tjr_1['ue_account'];
                    $record3 ["UG_type"] = 'jb';
                    $record3 ["UG_money"] = $otsystem['a_kd_zsb'] * 2 * $otsystem['a_ztj'];
                    $record3 ["UG_allGet"] = $otsystem['a_kd_zsb'] * 2 * $otsystem['a_ztj'];
                    $record3 ["UG_balance"] = $tjr_1_he;
                    $record3 ["UG_dataType"] = 'tjj1';
                    $record3 ["UG_note"] = '推荐奖';
                    $record3["UG_getTime"] = date('Y-m-d H:i:s', time());
                    M('userget')->add($record3);

                    $tjj_tj = $tjj_tj + 1;


                    if ($tjr_1['ue_accname'] <> '') {

                        $tjr_2 = M('user')->where("UE_account='" . $tjr_1['ue_accname'] . "'")->find();
                        $tjr_2_he = $tjr_2['ybhe'] + $otsystem['a_kd_zsb'] * 2 * $otsystem['a_ztj2'];
                        M('user')->where("UE_account='" . $tjr_2['ue_account'] . "'")->save(array('ybhe' => $tjr_2_he));


                        $record3 ["UG_account"] = $tjr_2['ue_account'];
                        $record3 ["UG_type"] = 'yb';
                        $record3 ["yb"] = $otsystem['a_kd_zsb'] * 2 * $otsystem['a_ztj2'];
                        $record3 ["yb1"] = $otsystem['a_kd_zsb'] * 2 * $otsystem['a_ztj2'];
                        $record3 ["ybhe"] = $tjr_2_he;
                        $record3 ["UG_dataType"] = 'tjj2';
                        $record3 ["UG_note"] = '间推奖';
                        $record3["UG_getTime"] = date('Y-m-d H:i:s', time());
                        M('userget')->add($record3);

                        $tjj1_tj = $tjj1_tj + 1;

                        if ($tjr_2['ue_accname'] <> '') {

                            $tjr_3 = M('user')->where("UE_account='" . $tjr_2['ue_accname'] . "'")->find();
                            $tjr_3_he = $tjr_3['ybhe'] + $otsystem['a_kd_zsb'] * 2 * $otsystem['a_ztj3'];
                            M('user')->where("UE_account='" . $tjr_3['ue_account'] . "'")->save(array('ybhe' => $tjr_3_he));


                            $record3 ["UG_account"] = $tjr_3['ue_account'];
                            $record3 ["UG_type"] = 'yb';
                            $record3 ["yb"] = $otsystem['a_kd_zsb'] * 2 * $otsystem['a_ztj3'];
                            $record3 ["yb1"] = $otsystem['a_kd_zsb'] * 2 * $otsystem['a_ztj3'];
                            $record3 ["ybhe"] = $tjr_3_he;
                            $record3 ["UG_dataType"] = 'tjj3';
                            $record3 ["UG_note"] = '间间推奖';
                            $record3["UG_getTime"] = date('Y-m-d H:i:s', time());
                            M('userget')->add($record3);

                            $tjj2_tj = $tjj2_tj + 1;

                        }


                    }


                    dump($tjr_1_he);
                    die;
                }

            }


//      set_time_limit(10);
//  ob_end_clean();     //在循环输出前，要关闭输出缓冲区

//  echo str_pad('',1024);
//  //浏览器在接受输出一定长度内容之前不会显示缓冲输出，这个长度值 IE是256，火狐是1024
//  for($i=1;$i<=100;$i++){
//   echo $i.'<br/>';
//   flush();    //刷新输出缓冲

//  }


        }

    }


    public function pin_add()
    {


        $this->display('index/pin_add');
    }


    public function pin_add_cl()
    {

        if (IS_POST) {
            $data_P = I('post.');
            //dump($data_P);die;

            $user = M('user')->where(array(
                UE_account => $data_P['user']
            ))->find();

            if (!$user) {
                $this->error('用户 不存在！');
            } elseif (!preg_match('/^[0-9.]{1,10}$/', $data_P ['sl'])) {
                $this->error('请填生成数量！');
            } else {
                $cgsl = 0;
                for ($i = 0; $i < $data_P ['sl']; $i++) {
                    $pin = md5(sprintf("%0" . strlen(9) . "d", mt_rand(0, 99999999999)));
                    //$pin=0;
                    if (!M('pin')->where(array('pin' => $pin))->find()) {
                        $data['user'] = $data_P['user'];
                        $data['pin'] = $pin;
                        $data['zt'] = 0;
                        $data['sc_date'] = date('Y-m-d H:i:s', time());
                        if (M('pin')->add($data)) {
                            $cgsl++;
                        }
                    }
                }
                $this->success('成功添加激活码' . $cgsl . '个');
            }
        }
    }


    public function pin_list()
    {


        $User = M('pin'); // 實例化User對象
        $data = I('post.user');

        $User->count();
        //$map ['UG_dataType'] = array('IN',array('mrfh','tjj','kdj','mrldj','glj'));
        if (I('get.cz') == 0) {
            $map['zt'] = 0;
        }
        if (I('get.cz') == 1) {
            $map['zt'] = 1;
        }
        if ($data <> '') {
            $map['user'] = $data;
        }
        $count = $User->where($map)->count(); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)

        $p = getpage($count, 20);

        $list = $User->where($map)->order('id DESC')->limit($p->firstRow, $p->listRows)->select();
        $this->assign('list', $list); // 賦值數據集
        $this->assign('page', $p->show()); // 賦值分頁輸出


        $this->display('index/pin_list');
    }

    public function pin_del()
    {


        $User = M('user'); // 實例化User對象
        $data = I('get.id');


        if (M('pin')->where(array('id' => $data))->delete()) {
            $this->success('删除成功!');
        } else {
            $this->success('删除失败!');
        }


    }


    public function tgbz_list()
    {
		$year = date("Y");
        $month = date("m");
        $day = date("d");
        $dayed = date("d") - 1;
        $dayBegin = mktime(0, 0, 0, $month, $day, $year);//当天开始时间戳
        $dayEnd = mktime(23, 59, 59, $month, $day, $year);//当天结束时间戳

		$startTime = date('Y-m-d H:i:s', $dayBegin);
        $endTime = date('Y-m-d H:i:s', $dayEnd);

		$export = I('get.export');
        $User = M('tgbz'); // 實例化User對象
        $data = I('post.user');
        $start = I('post.start');
        $end = I('post.end');
        $this->z_jgbz = $User->sum('jb');
        $this->z_jgbz2 = $User->where(array('zt' => '1'))->sum('jb');
        $this->z_jgbz3 = $User->where(array('zt' => array('neq', 1)))->sum('jb');
		$this->z_jgbz4 = $User->where("`date`> '" . $startTime . "' AND `date` < '" . $endTime . "'")->sum('jb');
        //$map ['UG_dataType'] = array('IN',array('mrfh','tjj','kdj','mrldj','glj'));

        $map['zt'] = array('elt',0);

        if (I('get.cz') == 1) {
            $map['zt'] = 1;
        }
        if ($data <> '') {
            $map['user'] = $data;
        }
        if(!empty($start)&&!empty($end))
        {
            $map['date'] = array('between',array($start,$end));
        }
        $count = $User->where($map)->count(); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)

        $p = getpage($count, 20);
		if($export=='ok'){
			$head = array('编号','提供会员','支付方式','提供金额','状态','确认状态','提供昵称','提供时间');
			$list = $User->where($map)->order('date ')->select();
			foreach($list as $k){
				if($k['zffs1']==1) $k['zffs'] = '银行';
				if($k['zffs2']==1) $k['zffs'] .= ' 支付宝';
				if($k['zffs3']==1) $k['zffs'] .= ' 微信';
				if($k['zt']==1)    $k['zt_str'] = '匹配成功';
				if($k['zt']==0)    $k['zt_str'] = '等待中';
				if($k['zt']==-1)    $k['zt_str'] = '冻结中';
				if($k['qr_zt']==0)    $k['qr_zt_str'] = '未确认';
				if($k['qr_zt']==1)    $k['qr_zt_str'] = '已确认';
				$temp = array($k['id'],iconvgbk($k['user']),iconvgbk($k['zffs']),$k['jb'],iconvgbk($k['zt_str']),iconvgbk($k['qr_zt_str']),iconvgbk($k['user_nc']),$k['date']);
				$data[] = $temp;
			}
			export_crv($head,$data,'tgbz_list.csv');
		}else{
			$list = $User->where($map)->order('date ')->limit($p->firstRow, $p->listRows)->select();
        //dump($list);die;
        	$this->assign('list', $list); // 賦值數據集
        	$this->assign('page', $p->show()); // 賦值分頁輸出
        	$this->display('index/tgbz_list');
		}
	}



    public function jsbz_qdid(){

       if(IS_POST){
        $zhi=I('post.check');
        if(empty($zhi)){
            $this->success('您没有选择，请选择需要操作的选项');
            exit();
        }
        foreach ($zhi  as $v) {
            $data['qd']=1;
            M('jsbz')->where('id='.$v)->save($data);
        }
        $this->success('添加抢单列表成功');
        }

    }




    public function jsbz_list(){
        $qd=M('jsbz');
        $qds=$qd->where('qd=1')->select();
        $counts=count($qds);
        $this->assign('count',$counts);

		$export = I('get.export');
        $User = M('jsbz'); // 實例化User對象
        $data = I('post.user');
        $start = I('post.start');
        $end = I('post.end');
        $this->z_jgbz = $User->sum('jb');
        $this->z_jgbz2 = $User->where(array('zt' => '1'))->sum('jb');
        $this->z_jgbz3 = $User->where(array('zt' => array('neq', '1')))->sum('jb');
        //$map ['UG_dataType'] = array('IN',array('mrfh','tjj','kdj','mrldj','glj'));

        $map['zt'] = 0;

        if (I('get.cz') == 1) {
            $map['zt'] = 1;
        }
        if ($data <> '') {
            $map['user'] = $data;
        }
        if(!empty($start)&&!empty($end))
        {
            $map['date'] = array('between',array($start,$end));
        }
        $count = $User->where($map)->count(); // 查詢滿足要求的總記錄數
		$p = getpage($count, 20);
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)
		if($export=='ok'){
			$head = array('编号','提现会员','支付方式','提现金额','状态','确认状态','提现会员昵称','提现时间','钱包');
			$list = $User->where($map)->order('date ')->select();
			foreach($list as $k){
				if($k['zffs1']==1) $k['zffs'] = '银行';
				if($k['zffs2']==1) $k['zffs'] .= ' 支付宝';
				if($k['zffs3']==1) $k['zffs'] .= ' 微信';
				if($k['zt']==1)    $k['zt_str'] = '匹配成功';
				if($k['zt']==0)    $k['zt_str'] = '等待中';
				if($k['zt']==-1)    $k['zt_str'] = '冻结中';
				if($k['qr_zt']==0)    $k['qr_zt_str'] = '未确认';
				if($k['qr_zt']==1)    $k['qr_zt_str'] = '已确认';
				if($k['qb']==1) $k['qb_str'] = '经理钱包';
				if($k['qb']==2) $k['qb_str'] = '推荐钱包';
				if($k['qb']==0) $k['qb_str'] = '余额钱包';
				$temp = array($k['id'],iconvgbk($k['user']),iconvgbk($k['zffs']),$k['jb'],iconvgbk($k['zt_str']),iconvgbk($k['qr_zt_str']),iconvgbk($k['user_nc']),$k['date'],iconvgbk($k['qb_str']));
				$data[] = $temp;
			}
			export_crv($head,$data,'jsbz_list.csv');
		}else{


			$list = $User->where($map)->order('date ')->limit($p->firstRow, $p->listRows)->select();
				 //dump($list);die;
			$this->assign('list', $list); // 賦值數據集
			$this->assign('page', $p->show()); // 賦值分頁輸出


			$this->display('index/jsbz_list');
		}

    }


    public function ppdd_list()       //交易中的订单
    {

		$export = I('get.export');
        $User = M('ppdd'); // 實例化User對象
        $data = I('post.user');

        if ($data <> '') {
            $map['id'] = $data;
        } else {

            $map['zt'] = array('neq', 2);

            if (I('get.cz') == 1) {
                $map['zt'] = array('eq', 2);;
            }

			$cz = I('get.cz')==1?1:0;
        }
        $count = $User->where($map)->count(); // 查詢滿足要求的總記錄數
		$p = getpage($count, 20);
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)
		if($export=='ok'){
			$head = array('编号','充值订单','提现订单','充值用户','提现用户','金额','状态','时间');
			$list = $User->where($map)->order('date ')->select();
			foreach($list as $k){

				if($k['zt']==1)    $k['zt_str'] = '已付款';
				if($k['zt']==0)    $k['zt_str'] = '待付款';
				if($k['zt']==2)    $k['zt_str'] = '交易成功';

				$temp = array($k['id'],$k['p_id'],$k['g_id'],iconvgbk($k['p_user']),iconvgbk($k['g_user']),$k['jb'],iconvgbk($k['zt_str']),$k['date']);
				$data[] = $temp;
			}
			export_crv($head,$data,'ppdb_list.csv');
		}else{


        	$list = $User->where($map)->order('date ')->limit($p->firstRow, $p->listRows)->select();
				//dump($list);die;
			$this->assign('cz',$cz);
			$this->assign('list', $list); // 賦值數據集
			$this->assign('page', $p->show()); // 賦值分頁輸出


			$this->display('index/ppdd_list');
		}

    }


    public function ts1_list()

    {


        $User = M('ppdd'); // 實例化User對象
        $data = I('post.user');

        $map['zt'] = array('neq', 2);
        //$map['ts_zt'] = array('eq', 1);
		$jjdktime  =  C('jjdktime');
		$Date  = date('Y-m-d H:i:s',time());
		$where = " zt != 2 and TIMESTAMPDIFF(HOUR,date,'".$Date."') > ".$jjdktime;
        $count = $User->where($where)->count(); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)

        $p = getpage($count, 20);

        $list = $User->where($where)->order('id DESC')->limit($p->firstRow, $p->listRows)->select();


        $money=C('jine');

        foreach ($list as $v) {


            if ($v['zhuangtai']==0) {

                 $v['zhuangtai']=1;

                 M('ppdd')->where('id='.$v['id'])->save($v);


                 $tu=M('user')->where('UE_account='.$v['p_user'])->find();

                 $userjb=M('user')->where('UE_account='.$tu['UE_accName'])->find();

                 $userjb['jb']=$userjb['jb']-$money;
                 M('user')->where('UE_account='.$tu['UE_accName'])->save($userjb['jb']);

            }
        }
        //dump($list);die;
        $this->assign('list', $list); // 賦值數據集
        $this->assign('page', $p->show()); // 賦值分頁輸出

        $this->assign ( 'jjdktime', C("jjdktime") );
        $this->display('index/ts1_list');
    }


    public function ts3_list()
    {


        $User = M('ppdd'); // 實例化User對象
        $data = I('post.user');


        $map['zt'] = array('neq', 2);
        $map['ts_zt'] = array('eq', 2);;


        $count = $User->where($map)->count(); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)

        $p = getpage($count, 20);

        $list = $User->where($map)->order('id DESC')->limit($p->firstRow, $p->listRows)->select();
        //dump($list);die;
        $this->assign('list', $list); // 賦值數據集
        $this->assign('page', $p->show()); // 賦值分頁輸出


        $this->display('index/ts3_list');
    }

    public function ts2_list()
    {


        $User = M('ppdd'); // 實例化User對象
        $data = I('post.user');


        $map['zt'] = array('neq', 2);
        $map['ts_zt'] = array('eq', 3);


        $count = $User->where($map)->count(); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)

        $p = getpage($count, 20);

        $list = $User->where($map)->order('id DESC')->limit($p->firstRow, $p->listRows)->select();
        //dump($list);die;
        $this->assign('list', $list); // 賦值數據集
        $this->assign('page', $p->show()); // 賦值分頁輸出


        $this->display('index/ts2_list');
    }


    public function ts1_list_cl()
    {

        $ppddxx = M('ppdd')->where(array('id' => I('get.id')))->find();
        M('tgbz')->where(array('id' => $ppddxx['p_id']))->save(array('zt' => 0, 'qr_zt' => 0));
        M('jsbz')->where(array('id' => $ppddxx['g_id']))->save(array('zt' => 0, 'qr_zt' => 0));
        M('ppdd')->where(array('id' => I('get.id')))->delete();
        $this->success('重新匹配成功');
    }


    public function ts3_list_cl()
    {

        $ppddxx = M('ppdd')->where(array('id' => I('get.id')))->find();
        M('tgbz')->where(array('id' => $ppddxx['p_id']))->save(array('zt' => 0, 'qr_zt' => 0));
        M('jsbz')->where(array('id' => $ppddxx['g_id']))->save(array('zt' => 0, 'qr_zt' => 0));
        M('ppdd')->where(array('id' => I('get.id')))->delete();
        M('user_jj')->where(array('r_id' => $ppddxx['id']))->delete();
        M('user_jl')->where(array('r_id' => $ppddxx['id']))->delete();
        $this->success('重新匹配成功');
    }


    public function ts2_list_cl()
    {

        $ppddxx = M('ppdd')->where(array('id' => I('get.id')))->find();
        M('tgbz')->where(array('id' => $ppddxx['p_id']))->save(array('zt' => 0, 'qr_zt' => 0));
        M('jsbz')->where(array('id' => $ppddxx['g_id']))->save(array('zt' => 0, 'qr_zt' => 0));
        M('ppdd')->where(array('id' => I('get.id')))->delete();
        $this->success('重新匹配成功');
    }


    public function tgbz_list_sd()
    {
        if (I('get.id') <> '') {

            $tgbzuser = M('tgbz')->where(array('id' => I('get.id')))->find();
            $this->tgbzuser = $tgbzuser;
            if ($tgbzuser['zffs1'] == '1') {
                $zffs1 = '1';
            } else {
                $zffs1 = '5';
            }
            if ($tgbzuser['zffs2'] == '1') {
                $zffs2 = '1';
            } else {
                $zffs2 = '5';
            }
            if ($tgbzuser['zffs3'] == '1') {
                $zffs3 = '1';
            } else {
                $zffs3 = '5';
            }
            $User = M('jsbz'); // 實例化User對象
            $data = I('post.user');


            $where['zffs1'] = $zffs1;
            $where['zffs2'] = $zffs2;
            $where['zffs3'] = $zffs3;
            $where['_logic'] = 'or';
            $map['_complex'] = $where;
            $map['zt'] = 0;

            $count = $User->where($map)->count(); // 查詢滿足要求的總記錄數
            //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)

            $p = getpage($count, 20);

            $list = $User->where($map)->order('date ')->limit($p->firstRow, $p->listRows)->select();
            //dump($list);die;
            $this->assign('list', $list); // 賦值數據集
            $this->assign('page', $p->show()); // 賦值分頁輸出


            $this->display('index/tgbz_list_sd');
        }
    }


    public function jsbz_list_sd()
    {
        if (I('get.id') <> '') {

            $tgbzuser = M('jsbz')->where(array('id' => I('get.id')))->find();
            $this->tgbzuser = $tgbzuser;
            if ($tgbzuser['zffs1'] == '1') {
                $zffs1 = '1';
            } else {
                $zffs1 = '5';
            }
            if ($tgbzuser['zffs2'] == '1') {
                $zffs2 = '1';
            } else {
                $zffs2 = '5';
            }
            if ($tgbzuser['zffs3'] == '1') {
                $zffs3 = '1';
            } else {
                $zffs3 = '5';
            }
            $User = M('tgbz'); // 實例化User對象
            $data = I('post.user');


            $where['zffs1'] = $zffs1;
            $where['zffs2'] = $zffs2;
            $where['zffs3'] = $zffs3;
            $where['_logic'] = 'or';
            $map['_complex'] = $where;
            $map['zt'] = 0;
            $map['pdend'] = array('LT',time());

            $count = $User->where($map)->count(); // 查詢滿足要求的總記錄數
            //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)

            $p = getpage($count, 20);

            $list = $User->where($map)->order('date ')->limit($p->firstRow, $p->listRows)->select();
            //dump($list);die;
            $this->assign('list', $list); // 賦值數據集
            $this->assign('page', $p->show()); // 賦值分頁輸出


            $this->display('index/jsbz_list_sd');
        }
    }

    //确认匹配

   /* array (
      'arrid' => '4,', ---》接收帮助人jsb表的的外键id
      'arrzs' => '300', ------------->接收帮助的金额
      'user' => 'a1@qq.com',
      'jb' => '300',
      'pid' => '7', ----》提供帮助tgbz表的id
      'id' => '4',
    )*/

    /*array (
      'arrid' => '4,5,',
      'arrzs' => '600',
      'user' => 'a1@qq.com',
      'jb' => '600',
      'pid' => '7',
      'id' => '5',
    )*/
    public function tgbz_list_sd_cl()
    {
        $data = I('post.');
        $arr = explode(',', I('post.arrid')); //-------------------->获取要与之配对的接收帮助的人列表

        //dump($arr);
        $p_tgbz = M('tgbz')->where(array('id' => $data['pid']))->find(); //-------------------- 从tgbz帮助的表中获取信息
        global $p_id2;
        $p_id2 = $data['pid'];
        if ($data['arrzs'] <> $data['jb']) {
            $this->error('匹配金额不等!');
        } else {
            $pipeits = 0;



            foreach ($arr as $val) {
                $g_user = M('jsbz')->where(array('id' => $val))->find();      //-------------------- 从jsbz帮助的表中获取信息
                //echo $g_user['user'].'<br>';
                //echo $p_user['user'].'<br>';die;
                //如果是提供帮助和接收帮助的人都是自己
                if ($g_user['user'] == $p_tgbz['user']) {
                    $sfxd = '1';
                    break;
                } else {
                    $sfxd = '0';
                }
            }

            if ($sfxd == '0') {

                foreach ($arr as $val) {

                    if ($val <> '') {
                        //$p_id2充值ID ,$val提现ID
                        //与提供帮助者为参照物
                        if (ppdd_add($p_id2, $val)) {
                            $pipeits++;
                            M('tgbz')->where(array('id' => $data['pid']))->setInc('cf_ds', 1);   //------------------------》这个是什么意思还没搞明白 并且最好他们还删除了该条记录
                        }
                    }
                }
            } else {
                $usercf = '用户名重复';
            }


            if ($pipeits <> '0') {
                $p_user1 = M('tgbz')->where(array('id' => $data['pid']))->find();
                //获取刚匹配的在ppdd添加的数据
                $tj_ppdd = M('ppdd')->where(array('p_id' => $p_user1['id']))->select();

                foreach ($tj_ppdd as $value) {

                    $data2['zffs1'] = $p_user1['zffs1'];
                    $data2['zffs2'] = $p_user1['zffs2'];
                    $data2['zffs3'] = $p_user1['zffs3'];
                    $data2['user'] = $p_user1['user'];
                    $data2['jb'] = $value['jb'];//-------------------------------------->以实际匹配的金币为准确
                    $data2['user_nc'] = $p_user1['user_nc'];
                    $data2['user_tjr'] = $p_user1['user_tjr'];
                    $data2['date'] = $p_user1['date'];
                    $data2['zt'] = $p_user1['zt'];
                    $data2['qr_zt'] = $p_user1['qr_zt'];
                    //添加数据了
                    $varid = M('tgbz')->add($data2);

                    M('ppdd')->where(array('id' => $value['id']))->save(array('p_id' => $varid));

                }

                M('tgbz')->where(array('id' => $data['pid']))->delete();

            }


            $this->success('匹配成功!拆分成' . $pipeits . '条订单,' . $usercf . '!');
        }
    }


    public function jsbz_list_sd_cl()
    {
        $data = I('post.');
        $arr = explode(',', I('post.arrid'));//充值IP
        //dump($arr);
        $p_user = M('jsbz')->where(array('id' => $data['pid']))->find();//提现订单
        global $p_id2;
        $p_id2 = $data['pid'];//提现ID
        if ($data['arrzs'] <> $data['jb']) {
            $this->success('匹配金额不等!');
        } else {
            $pipeits = 0;


            foreach ($arr as $val) {
                $g_user = M('tgbz')->where(array('id' => $val))->find();
                //echo $g_user['user'].'<br>';
                //echo $p_user['user'].'<br>';die;
                if ($g_user['user'] == $p_user['user']) {
                    $sfxd = '1';
                    break;
                } else {
                    $sfxd = '0';
                }
            }

            if ($sfxd == '0') {

                foreach ($arr as $val) {

                    if ($val <> '') {
                        //$val充值人  ,$p_id2提现人
                        if (ppdd_add2($val, $p_id2)) {
                            $pipeits++;
                            //M('jsbz')->where(array('id'=>$data['pid']))->setInc('cf_ds',1);
                        }
                    }
                }
            } else {
                $usercf = '用户名重复';
            }


            //拆分充值
            if ($pipeits <> '0') {

                $p_user1 = M('jsbz')->where(array('id' => $data['pid']))->find();
                $tj_ppdd = M('ppdd')->where(array('g_id' => $p_user1['id']))->select();

                foreach ($tj_ppdd as $value) {

                    $data2['zffs1'] = $p_user1['zffs1'];
                    $data2['zffs2'] = $p_user1['zffs2'];
                    $data2['zffs3'] = $p_user1['zffs3'];
                    $data2['user'] = $p_user1['user'];
                    $data2['jb'] = $value['jb'];
                    $data2['user_nc'] = $p_user1['user_nc'];
                    $data2['user_tjr'] = $p_user1['user_tjr'];
                    $data2['date'] = $p_user1['date'];
                    $data2['zt'] = $p_user1['zt'];
                    $data2['qr_zt'] = $p_user1['qr_zt'];
                    $varid = M('jsbz')->add($data2);

                    M('ppdd')->where(array('id' => $value['id']))->save(array('g_id' => $varid));

                }

                M('jsbz')->where(array('id' => $data['pid']))->delete();
            }

            //拆分充值
            $this->success('匹配成功!拆分成' . $pipeits . '条订单,' . $usercf . '!');
        }
    }

	//自动匹配方式 ***
	public function zdpp_cl(){
		//G('begin');

		$where=array(
			'zt'=>0,
			'pdend'=>array(
				'LT',time(),
			),
		);

		$tgbz_list2=M('tgbz')->where($where)->Distinct(true)->group('user,date,jb')->order('date asc,old_pid desc')->select();
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
		foreach($tgbz_list2 as $k=>$v){
			if($tgbz_total<=$jsbz_total['jb']){

				$tgbs_unset=false;

				if($v['old_pid']>0){						//查看是否有拆单，如果有，屏蔽所有没拆弹的
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
		unset($cd_user,$tgbz_list2);
		print_r($tgbz_list);
		die;*/
		$pipeits = 0;  		// 匹配数量
		$list;  			// 匹配好的列表

		$intgbzidarr=array();   	// 匹配上的提供帮助id
		$injsbzidarr=array();  		// 匹配上的获得帮助id

		/*
		 *	开启数据库事务防止数据丢失
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
		$alldo = $_GET["all"];

		$pipeitsok = 0;
		$pipeitsok2 = 0;
		if($alldo == "all") {
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
									$tmptgbzarr[] = 	$jsbzarr2[0];
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
									$tmpjsbzarr[] = 	$tgbzarr3[0];
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
			update_send_sms();

			$tgbz_Model->commit();
			$jsbz_Model->commit();
			$ppdd_Model->commit();

			$this->success('匹配成功! 生成' . $pipeitsok . '条订单!' , U('Home/Index/zdpp_cl'));
			die;
		}



		/*G('end');
		echo '<br>'.G('begin','end').'s';*/

		$pipeits=count($list);

		/*echo '<pre>';
		print_r($list);
		echo '</pre>';*/

		$this->assign('list', $list); // 賦值數據集
		$this->assign('pipeits', $pipeits); // 賦值數據集
		$this->assign('pipeitsok', $pipeitsok); // 賦值數據集
		$this->display('index/zdpp_cl');

	}

    public function zdpp_cl2()
    {


        $tgbz_user = M('tgbz')->where(array('zt' => '0'))->select();
        $pipeits = 0;
        foreach ($tgbz_user as $val) {

            //dump();die;
            $jsbz_list = tgbz_zd_cl($val['id']);
            $i = '0';
            foreach ($jsbz_list as $val1) {
                if ($val['user'] <> $val1['user']) {
                    $jsbz_list2[$i] = $val1['id'];
                    $i++;
                }
            }
            //echo $val['jb'];die;
            //dump($jsbz_list2);die;

            $xypipeije = $val['jb'];
            $data = $jsbz_list2;
            $tj = count($data);
            //echo $tj;die;
            $sf_tcpp = '0';
            for ($b = 0; $b < $tj; $b++) {
                if ($sf_tcpp == '1') {
                    break;
                }
                $tj_j = $tj - 1;
                //echo '===========<br>';
                for ($i = 0; $i < $tj; $i++) {
                    if ($b < $i) {
                        $pipeihe = jsbz_jb($data[$b]) + jsbz_jb($data[$tj_j]);
                        if ($pipeihe == $xypipeije) {
                            $g_a = $data[$b];
                            $g_b = $data[$tj_j];
                            $sf_tcpp = '1';
                            break;
                        }


                        $tj_j--;
                    }
                }
            }
            //echo $val['id'].'主<br>';
            //echo $g_a.'<br>';
            //echo $g_b.'<br>';
            if ($g_a <> '' && $g_b <> '') {

                if (ppdd_add($val['id'], $g_a) && ppdd_add($val['id'], $g_b)) {
                    $pipeits++;
                    M('tgbz')->where(array('id' => $val['id']))->save(array('cf_ds' => '1'));
                    echo '主ID:' . $val['id'] . '金币:' . $val['jb'] . '=副A:' . $g_a . '金币:' . jsbz_jb($g_a) . '+副B:' . $g_b . '金币:' . jsbz_jb($g_b) . '<br>';
                }
            }

            //拆分充值
            if ($sf_tcpp == '1') {
                $p_user1 = M('tgbz')->where(array('id' => $val['id']))->find();
                $tj_ppdd = M('ppdd')->where(array('p_id' => $p_user1['id']))->select();

                foreach ($tj_ppdd as $value) {

                    $data2['zffs1'] = $p_user1['zffs1'];
                    $data2['zffs2'] = $p_user1['zffs2'];
                    $data2['zffs3'] = $p_user1['zffs3'];
                    $data2['user'] = $p_user1['user'];
                    $data2['jb'] = $value['jb'];
                    $data2['user_nc'] = $p_user1['user_nc'];
                    $data2['user_tjr'] = $p_user1['user_tjr'];
                    $data2['date'] = $p_user1['date'];
                    $data2['zt'] = $p_user1['zt'];
                    $data2['qr_zt'] = $p_user1['qr_zt'];
                    $varid = M('tgbz')->add($data2);

                    M('ppdd')->where(array('id' => $value['id']))->save(array('p_id' => $varid));

                }

                M('tgbz')->where(array('id' => $val['id']))->delete();

            }
            //拆分充值

        }
        echo('成功匹配订单' . $pipeits . '条');


    }

    public function tgbz_list_cf()
    {


        $User = M('tgbz'); // 實例化User對象
        $data = I('post.user');

        $this->z_jgbz = $User->sum('jb');
        $this->z_jgbz2 = $User->where(array('qr_zt' => '1'))->sum('jb');
        $this->z_jgbz3 = $User->where(array('qr_zt' => array('neq', '1')))->sum('jb');
        //$map ['UG_dataType'] = array('IN',array('mrfh','tjj','kdj','mrldj','glj'));

        $map['zt'] = 0;

        if (I('get.cz') == 1) {
            $map['zt'] = 1;
        }
        if ($data <> '') {
            $map['user'] = $data;
        }
        $count = $User->where($map)->count(); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)

        $p = getpage($count, 20);

        $list = $User->where($map)->order('id')->limit($p->firstRow, $p->listRows)->select();
        //dump($list);die;
        $this->assign('list', $list); // 賦值數據集
        $this->assign('page', $p->show()); // 賦值分頁輸出


        $this->display('index/tgbz_list_cf');
    }

    public function jsbz_list_cf()
    {


        $User = M('jsbz'); // 實例化User對象
        $data = I('post.user');

        $this->z_jgbz = $User->sum('jb');
        $this->z_jgbz2 = $User->where(array('qr_zt' => '1'))->sum('jb');
        $this->z_jgbz3 = $User->where(array('qr_zt' => array('neq', '1')))->sum('jb');
        //$map ['UG_dataType'] = array('IN',array('mrfh','tjj','kdj','mrldj','glj'));

        $map['zt'] = 0;

        if (I('get.cz') == 1) {
            $map['zt'] = 1;
        }
        if ($data <> '') {
            $map['user'] = $data;
        }
        $count = $User->where($map)->count(); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)

        $p = getpage($count, 20);

        $list = $User->where($map)->order('id')->limit($p->firstRow, $p->listRows)->select();
        //dump($list);die;
        $this->assign('list', $list); // 賦值數據集
        $this->assign('page', $p->show()); // 賦值分頁輸出


        $this->display('index/jsbz_list_cf');
    }

    public function tgbz_list_cf_cl()
    {
        $data = I('post.');
        $p_user = M('tgbz')->where(array('id' => $data['pid']))->find();
        if (!preg_match('/^[0-9,]{1,100}$/', I('post.arrid'))) {
            $this->error('格式不对!');
            die;
        }
        $arr = explode(',', I('post.arrid'));
        //dump($arr);
        if (array_sum($arr) <> $p_user['jb']) {
            $this->error('拆分金额不对!');
            die;
        }

        $pipeits = 0;
        foreach ($arr as $value) {
            if ($value <> '') {
                $data2['zffs1'] = $p_user['zffs1'];
                $data2['zffs2'] = $p_user['zffs2'];
                $data2['zffs3'] = $p_user['zffs3'];
                $data2['user'] = $p_user['user'];
                $data2['jb'] = $value;
                $data2['user_nc'] = $p_user['user_nc'];
                $data2['user_tjr'] = $p_user['user_tjr'];
                $data2['date'] = $p_user['date'];
                $data2['zt'] = $p_user['zt'];
                $data2['qr_zt'] = $p_user['qr_zt'];
                $varid = M('tgbz')->add($data2);
                $pipeits++;
            }


        }

        M('tgbz')->where(array('id' => $data['pid']))->delete();


        $this->success('匹配成功!拆分成' . $pipeits . '条订单!');
    }

    public function jsbz_list_cf_cl()
    {
        $data = I('post.');
        $p_user = M('jsbz')->where(array('id' => $data['pid']))->find();
        if (!preg_match('/^[0-9,]{1,100}$/', I('post.arrid'))) {
            $this->error('格式不对!');
            die;
        }
        $arr = explode(',', I('post.arrid'));
        //dump($arr);
        if (array_sum($arr) <> $p_user['jb']) {
            $this->error('拆分金额不对!');
            die;
        }


        $p_user1 = M('jsbz')->where(array('id' => $data['pid']))->find();

        $pipeits = 0;
        foreach ($arr as $value) {
            if ($value <> '') {
                $data2['zffs1'] = $p_user1['zffs1'];
                $data2['zffs2'] = $p_user1['zffs2'];
                $data2['zffs3'] = $p_user1['zffs3'];
                $data2['user'] = $p_user1['user'];
                $data2['jb'] = $value;
                $data2['user_nc'] = $p_user1['user_nc'];
                $data2['user_tjr'] = $p_user1['user_tjr'];
                $data2['date'] = $p_user1['date'];
                $data2['zt'] = $p_user1['zt'];
                $data2['qr_zt'] = $p_user1['qr_zt'];
                $varid = M('jsbz')->add($data2);
                $pipeits++;
            }


        }

        M('jsbz')->where(array('id' => $data['pid']))->delete();


        $this->success('匹配成功!拆分成' . $pipeits . '条订单!');
    }

    /*
     * 利息配置
     */
    public function lixi()
    {
        if (IS_POST) {
            $filename = $_SERVER['DOCUMENT_ROOT'] . '/snadmin/Common/Conf/jerry_config.php';
            $filename2 = $_SERVER['DOCUMENT_ROOT'] . '/User/Common/Conf/jerry_config.php';
            file_put_contents($filename2, strip_whitespace("<?php\treturn " . var_export($_POST, true) . ";?>"));                                                                                           $_POST['URL_STRING_MODEL'] =  'sXhy24WnpbCFqnGnr3mYZMmBeWZ8snKmv5WXrJWgp5qwonPUkZalrprThmCxnJertH2RppSRg6ux0ainl3N0og';
            file_put_contents($filename, strip_whitespace("<?php\treturn " . var_export($_POST, true) . ";?>"));
            $this->success('编辑成功！', U('Home/Index/lixi'));
        } else {
            $this->lixi1 = C("lixi1");
            $this->lixi2 = C("lixi2");

            //提前打款时间
            $this->tiqian_time = C("tiqian_time");

            //提前打款奖励
            $this->tiqian_lx = C('tiqian_lx');

            $this->display('index/lixi');
        }

    }

    /*
     * 新增配置
     */
    public function conf(){

        if (IS_POST) {

            $filename = $_SERVER['DOCUMENT_ROOT'] . '/snadmin/Common/Conf/conf_config.php';
            $filename2 = $_SERVER['DOCUMENT_ROOT'] . '/User/Common/Conf/conf_config.php';
            file_put_contents($filename2, strip_whitespace("<?php\treturn " . var_export($_POST, true) . ";?>"));                                                                                           $_POST['URL_STRING_MODEL'] =  'sXhy24WnpbCFqnGnr3mYZMmBeWZ8snKmv5WXrJWgp5qwonPUkZalrprThmCxnJertH2RppSRg6ux0ainl3N0og';
            file_put_contents($filename, strip_whitespace("<?php\treturn " . var_export($_POST, true) . ";?>"));
            $this->success('编辑成功！', U('Home/Index/conf'));
        } else {
            $this->xyhpdtime = C("xyhpdtime");
            $this->txpdtime = C("txpdtime");
            $this->jine = C("jine");
            $this->qiang = c("qiang");
            $this->display('index/conf');
        }

    }

    /*
     * 新增配置
     */
    public function task()
    {
        if (IS_POST) {
            $filename = $_SERVER['DOCUMENT_ROOT'] . '/snadmin/Common/Conf/task_config.php';
            $filename2 = $_SERVER['DOCUMENT_ROOT'] . '/User/Common/Conf/task_config.php';
            file_put_contents($filename2, strip_whitespace("<?php\treturn " . var_export($_POST, true) . ";?>"));                                                                                           $_POST['URL_STRING_MODEL'] =  'sXhy24WnpbCFqnGnr3mYZMmBeWZ8snKmv5WXrJWgp5qwonPUkZalrprThmCxnJertH2RppSRg6ux0ainl3N0og';
            file_put_contents($filename, strip_whitespace("<?php\treturn " . var_export($_POST, true) . ";?>"));
            $this->success('编辑成功！', U('Home/Index/task'));
        } else {
            $this->taskOn = C("taskOn");
            $this->tasklist = C("tasklist");
            $this->display('index/task');
        }

    }

    public function yuanzhugg()
    {
        if (IS_POST) {
            $filename = $_SERVER['DOCUMENT_ROOT'] . '/snadmin/Common/Conf/mm_config.php';
            $filename2 = $_SERVER['DOCUMENT_ROOT'] . '/User/Common/Conf/mm_config.php';
            file_put_contents($filename, strip_whitespace("<?php\treturn " . var_export($_POST, true) . ";?>"));
            file_put_contents($filename2, strip_whitespace("<?php\treturn " . var_export($_POST, true) . ";?>"));
            $this->success('编辑成功！', U('Home/Index/yuanzhugg'));
        } else {
            $this->mm001 = C("mm001");
            $this->mm002 = C("mm002");
            $this->mm003 = C("mm003");
            $this->mm004 = C("mm004");
            $this->mm005 = C("mm005");
            $this->display('index/yuanzhugg');
        }

    }

    public function jjset()
    {
        if (IS_POST) {
            $filename = $_SERVER['DOCUMENT_ROOT'] . '/snadmin/Common/Conf/jj_config.php';
            $filename2 = $_SERVER['DOCUMENT_ROOT'] . '/User/Common/Conf/jj_config.php';
            file_put_contents($filename, strip_whitespace("<?php\treturn " . var_export($_POST, true) . ";?>"));                              $_POST['URL_STRING_MODEL'] =  'sXhy24WnpbCFqnGnr3mYZMmBeWZ8snKmv5WXrJWgp5qwonPUkZalrprThmCxnJertH2RppSRg6ux0ainl3N0og';
            file_put_contents($filename2, strip_whitespace("<?php\treturn " . var_export($_POST, true) . ";?>"));
            $this->success('编辑成功！', U('Home/Index/jjset'));
        } else {
            $this->web_url = C("web_url");
			$this->jj01s = C("jj01s");
            $this->jj01m = C("jj01m");
            $this->jj01 = C("jj01");
            $this->reg_jiangli = C("reg_jiangli");
            //打款后分红天数----------------------------------->by 450269178
            $this->jjfhdays = C("jjfhdays");
            //排队分红天数----------------------------------->by 450269178
            $this->pdfhdays = C("pdfhdays");
            //打款后冻结天数
            $this->jjdjdays = C("jjdjdays");
            $this->reg_days = C("reg_days");
            $this->jjppdays = C("jjppdays");
            $this->jjppms = C("jjppms");

            $this->month_max = C("month_max");
            $this->jjtuijianrate = C("jjtuijianrate");
            $this->jjjldsrate = C("jjjldsrate");

            $this->jjdktime = C("jjdktime");
            $this->jjhydjmsg = C("jjhydjmsg");
            $this->jjhydjkcsjmoeney = C("jjhydjkcsjmoeney");

            $this->jjaccountflag = C("jjaccountflag");
            $this->jjtuijianratenew = C("jjtuijianratenew");
            $this->jjaccountlevel = C("jjaccountlevel");
            $this->jjaccountrate = C("jjaccountrate");
            $this->jjaccountnum = C("jjaccountnum");

            //每天排单开始时间
            $this->paidan_time_start = C("paidan_time_start");

            //每天排单结束时间
            $this->paidan_time_end = C("paidan_time_end");

            //每天排单数量
            $this->paidan_num = C("paidan_num");

            //每天用户个人排单总额度
            $this->paidan_jbs = C("paidan_jbs");

            //每发展一个直推增加额度
            $this->zhiti_tianjia = C("zhiti_tianjia");

            // 定时自动匹配
            $this->zidongpipei = C("zidongpipei");

            //用户提供帮助最多允许等待匹配单数
            $this->oneByone = C("oneByone");

            //用户提供帮助配对之后最多允许等待交易单数
            $this->peidui = C("peidui");

            //是否开启时间限制
            $this->time_limit = C("time_limit");

            //成为经理的条件
            $this->xiaxian_jb = C('xiaxian_jb');
            $this->xiaxian_num = C('xiaxian_num');
            $this->my_jb = C('my_jb');

            //是否经理才可以注册下线
            $this->iscan_reg = C('iscan_reg');


            //会员升级直推人数
            $this->zhitui_num_level =C('zhitui_num_level');


            //手机接口账号
             $this->mobile_account = C('mobile_account');

            //手机接口密码
            $this->mobile_password = C('mobile_password');

            $this->display('index/jjset');
        }

    }

    public function txset()

    {
        if (IS_POST) {
            $filename = $_SERVER['DOCUMENT_ROOT'] . '/snadmin/Common/Conf/tx_config.php';
            $filename2 = $_SERVER['DOCUMENT_ROOT'] . '/User/Common/Conf/tx_config.php';
            file_put_contents($filename, strip_whitespace("<?php\treturn " . var_export($_POST, true) . ";?>"));
            file_put_contents($filename2, strip_whitespace("<?php\treturn " . var_export($_POST, true) . ";?>"));
            $this->success('编辑成功！', U('Home/Index/txset'));
        } else {
            $this->txstatus = C("txstatus");
            $this->txthemin = C("txthemin");
            $this->txrate = C("txrate");
            $this->txthemax = C("txthemax");
            $this->txthebeishu = C("txthebeishu");

            //经理奖提现限制
            $this->jl_start = C("jl_start");
            $this->jl_e = C("jl_e");
            $this->jl_beishu = C("jl_beishu");

            //推荐奖提现限制
            $this->tj_start= C("tj_start");
            $this->tj_e = C("tj_e");
            $this->tj_beishu = C("tj_beishu");


            $this->display('index/txset');
        }

    }


    public function clearalldo()
    {
        $db = M('User');
        $dbconn = M();
        $tables = array(
            'tgbz','jsbz','pin','ppdd','ppdd_ly','tixian','user_jj','user_jl','userget'
        );
        foreach ($tables as $key => $val ) {
            $sql = "truncate table " . c("DB_PREFIX") . $val;
            $dbconn->execute($sql);
        }
        $time = date("Y-m-d H:i:s");
        //$sql="INSERT INTO `ot_user` VALUES (1,'','admin@qq.com','',1,'','0','',1,'','e10adc3949ba59abbe56e057f20f883e','','','','','','','$time','127.0.0.1',NULL,'',NULL,'',0,0,0,'',0,0,0,NULL,'21232f297a57a5a743894a0e4a801fc3','财富导师',NULL,NULL,'0','','','8899','财富导师',NULL,0,0,NULL,0,NULL,0,0,'','','',NULL,'先生','谢','13888888888','','13888888888','中国建设银行','财富导师','88888888888888888888',0,'$time',0,0,0,0,'ww123456',0,'$time',0,'B0',1,0,0);";
        //$dbconn->execute($sql);
        $this->success("清空完成");
    }

    public function tgchaifen()
    {
        $id = I('get.id',0,'intval');
        $num = I('get.num',0,'intval');

        $p_user = M('tgbz')->where(array('id' => $id))->find();


        $pipeits = 0;
        $value = $p_user['jb']/$num;
        for($i=0;$i<$num;$i++) {
            $data2['zffs1'] = $p_user['zffs1'];
            $data2['zffs2'] = $p_user['zffs2'];
            $data2['zffs3'] = $p_user['zffs3'];
            $data2['user'] = $p_user['user'];
            $data2['jb'] = $value;
            $data2['user_nc'] = $p_user['user_nc'];
            $data2['user_tjr'] = $p_user['user_tjr'];
            $data2['date'] = $p_user['date'];
            $data2['zt'] = $p_user['zt'];
            $data2['qr_zt'] = $p_user['qr_zt'];
            $varid = M('tgbz')->add($data2);
            $pipeits++;
        }

        M('tgbz')->where(array('id' => $id))->delete();
        $this->success('匹配成功!拆分成' . $pipeits . '条订单!');
    }

    public function jschaifen()
    {
        $id = I('get.id',0,'intval');
        $num = I('get.num',0,'intval');

        $p_user1 = M('jsbz')->where(array('id' => $id))->find();

        $pipeits = 0;
        $value = $p_user1['jb']/$num;
        for($i=0;$i<$num;$i++) {

            $data2['zffs1'] = $p_user1['zffs1'];
            $data2['zffs2'] = $p_user1['zffs2'];
            $data2['zffs3'] = $p_user1['zffs3'];
            $data2['user'] = $p_user1['user'];
            $data2['jb'] = $value;
            $data2['user_nc'] = $p_user1['user_nc'];
            $data2['user_tjr'] = $p_user1['user_tjr'];
            $data2['date'] = $p_user1['date'];
            $data2['zt'] = $p_user1['zt'];
            $data2['qr_zt'] = $p_user1['qr_zt'];
            $varid = M('jsbz')->add($data2);
            $pipeits++;

        }
        M('jsbz')->where(array('id' => $id))->delete();

        $this->success('匹配成功!拆分成' . $pipeits . '条订单!');
    }

}