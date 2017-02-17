<?php
namespace Home\Controller;
use Think\Controller;
class TaskController extends CommonController {
  
	public function ly_list() {
		$User = M ( 'task' ); // 實例化User對象
	
		if(I('post.user')==''){
			$map['zt']='0';
		}else{
			$map['MA_userName']=I('post.user');
		}
		
		if(I('get.type')=='0'){
			$map['zt']='0';
		}elseif(I('get.type')=='1'){
			$map['zt']='1';
		}
		
		
	
		$count = $User->where ( $map )->count (); // 查詢滿足要求的總記錄數
		//$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)
	
		$p = getpage($count,100);
	
		$list = $User->where ( $map )->order ( 'MA_ID DESC' )->limit ( $p->firstRow, $p->listRows )->select ();
		$this->assign ( 'list', $list ); // 賦值數據集
		$this->assign ( 'page', $p->show() ); // 賦值分頁輸出
		/////////////////----------------
	
	
	
	
		$thehost = "http://" . $_SERVER["HTTP_HOST"];
		$this->assign ( 'thehost', $thehost );
	
		$userData = M ( 'user' )->where ( array (
				'UE_ID' => $_SESSION ['uid']
		) )->find ();
		$this->userData = $userData;
	
		$this->display ();
	}
	
	
	public function ly_list_cl() {
	
		$caution = M ( 'task' )->where ( array (
				'MA_ID'=> I('get.id') ,
		) )->find ();
	
		$this->caution=$caution;
		$userData = M ( 'user' )->where ( array (
				'UE_ID' => $_SESSION ['uid']
		) )->find ();
		$this->userData = $userData;
		$this->display();
	}
	
	public function ly_list_xgcl2() {
			$data['MA_reply']=$_POST['content'];
			$data['MA_replyTime']=date ( 'Y-m-d H:i:s', time () );
			$data['zt']='1';
	
			if(M('task')->where(array('MA_ID'=>I('post.id')))->save($data)){
				$this->success('处理成功！');
			}else{
				$this->success('处理失敗！');
			}	
	}
	
	public function ly_list_del() {	
		$caution = M ( 'task' )->where ( array (
				'MA_ID'=> I('get.id') ,
		) )->delete();
		if($caution){$this->success('刪除成功!');}else{$this->error('刪除失敗!');}
	
	}
	public function test_sms(){
		update_send_sms();
		echo 'ok';
	}
	public function send_ppdd_sms(){
		ini_set("ignore_user_abort",true);//用户关闭浏览器依然执行
		ignore_user_abort(true);
		set_time_limit(0);//不设时间限制

		$where = array('is_sms'=>0);
		$ppdd = M('ppdd')->where($where)->select();
		foreach($ppdd as $p_rs){
			
			$data = array('is_sms'=>1);
			M('ppdd')->where(array('id'=>$p_rs['id']))->save($data);
			
			//查询接受方用户信息
			$get_user=M('user')->where(array('UE_account'=>$p_rs['p_user']))->find();
			if($get_user['ue_phone']) sendSMS($get_user['ue_phone'],"您好！您接受帮助的资金:".$p_rs['jb']."元，已匹配成功，请登录网站查看匹配信息！");
			sleep(2);//延缓2秒执行
			
			//查询接受方用户信息
			$get_user=M('user')->where(array('UE_account'=>$p_rs['g_user']))->find();
			if($get_user['ue_phone']) sendSMS($get_user['ue_phone'],"您好！您申请帮助的资金:".$p_rs['jb']."元，已匹配成功，请登录网站查看匹配信息！");
			sleep(2);//延缓2秒执行
		}
		//$myfile = fopen(time().".txt", "w");
		//fwrite($myfile, 'sms_send_ok');
		//fclose($myfile);
		die('sms_send_ok');
	}
}