<?php

namespace Home\Controller;

use Think\Controller;

class TaskController extends CommonController {
	// 首页
	public function index(){
		$User = M ('task'); // 實例化User對象
		$map ['MA_userName'] = $_SESSION ['uname'];
		$map['zt'] = 1;

		$count = $User->where ( $map )->count (); // 查詢滿足要求的總記錄數
		$page = new \Think\Page ( $count, 12 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)

		$page->setConfig ( 'header', '<li class="rows">共<b>%TOTAL_ROW%</b>條記錄    第<b>%NOW_PAGE%</b>頁/共<b>%TOTAL_PAGE%</b>頁</li>' );
		$page->setConfig ( 'prev', '上一頁' );
		$page->setConfig ( 'next', '下一頁' );
		$page->setConfig ( 'last', '末頁' );
		$page->setConfig ( 'first', '首頁' );
		$page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
	

		$show = $page->show (); // 分頁顯示輸出
		// 進行分頁數據查詢 注意limit方法的參數要使用Page類的屬性
		$list = $User->where ( $map )->order ( 'MA_ID DESC' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
		$this->assign ( 'list', $list ); // 賦值數據集
		$this->assign ( 'page', $show ); // 賦值分頁輸出
		$userData = M ( 'user' )->where ( array (
				'UE_ID' => $_SESSION ['uid']
		) )->find ();

		$this->userData = $userData;
		$this->display();
	}
	
  	public function sendMessages(){
		$this->display();
	}


	public function getMessages(){
		$User = M ('task'); // 實例化User對象
		$map ['MA_userName'] = $_SESSION ['uname'];
		$map['zt'] = 1;

		$count = $User->where ( $map )->count (); // 查詢滿足要求的總記錄數
		$page = new \Think\Page ( $count, 12 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)

		$page->setConfig ( 'header', '<li class="rows">共<b>%TOTAL_ROW%</b>條記錄    第<b>%NOW_PAGE%</b>頁/共<b>%TOTAL_PAGE%</b>頁</li>' );
		$page->setConfig ( 'prev', '上一頁' );
		$page->setConfig ( 'next', '下一頁' );
		$page->setConfig ( 'last', '末頁' );
		$page->setConfig ( 'first', '首頁' );
		$page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
	

		$show = $page->show (); // 分頁顯示輸出
		// 進行分頁數據查詢 注意limit方法的參數要使用Page類的屬性
		$list = $User->where ( $map )->order ( 'MA_ID DESC' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
		$this->assign ( 'list', $list ); // 賦值數據集
		$this->assign ( 'page', $show ); // 賦值分頁輸出

		$userData = M ( 'user' )->where ( array (
				'UE_ID' => $_SESSION ['uid']
		) )->find ();

		$this->userData = $userData;
		$this->display();
	}

	public function lxwm() {

	

		$User = M ('task'); // 實例化User對象
		$map ['MA_userName'] = $_SESSION ['uname'];

		$count = $User->where ( $map )->count (); // 查詢滿足要求的總記錄數

		$page = new \Think\Page ( $count, 12 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)

		$page->setConfig ( 'header', '<li class="rows">共<b>%TOTAL_ROW%</b>條記錄    第<b>%NOW_PAGE%</b>頁/共<b>%TOTAL_PAGE%</b>頁</li>' );

		$page->setConfig ( 'prev', '上一頁' );
		$page->setConfig ( 'next', '下一頁' );
		$page->setConfig ( 'last', '末頁' );
		$page->setConfig ( 'first', '首頁' );
		$page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );

		$show = $page->show (); // 分頁顯示輸出

		// 進行分頁數據查詢 注意limit方法的參數要使用Page類的屬性
		$list = $User->where ( $map )->order ( 'MA_ID DESC' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
		$this->assign ( 'list', $list ); // 賦值數據集
		$this->assign ( 'page', $show ); // 賦值分頁輸出

		$userData = M ( 'user' )->where ( array (
				'UE_ID' => $_SESSION ['uid']
		) )->find ();
		$this->userData = $userData;
		$this->display('lxwm');
	}

	

	public function lxwmcl() {
		if (IS_POST) {
			$data_P = I ( 'post.' );
			$user1 = M ();
			if (strlen($data_P['lybt']) > 190 || strlen($data_P['lybt']) < 1) {
				die("<script>alert('留言标题不能为空！');history.back(-1);</script>");
			} elseif ( strlen($data_P['lynr']) < 1) {
				die("<script>alert('留言內容不能为空！');history.back(-1);</script>");
			}else {
				if($_FILES['pic']['name']){
					echo "1";
					$upload = new \Think\Upload();
					$upload->maxSize   =     3145728 ;
					$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
					$upload->savePath  =      ''; 
					$upload->autoSub = false;
					$info   =   $upload->upload();  
					if(!$info){
						$this->error($upload->getError());    
					}

					$record['pic'] = "/Uploads/".$info['pic']['savename'];
				}
				$record['MA_type']		= 'message';
				$record['MA_userName']	= $_SESSION['uname'];

				//$record['pic']	= $data_P['face180'];
				$record['MA_otherInfo']	= $data_P['otlylx'];
				$record['MA_theme']		= $data_P['lybt'];
				$record['MA_note']		= $_POST['lynr'];
				$record['MA_time']		= date ( 'Y-m-d H:i:s', time () );;
				$reg = M('task')->add($record );
					if ($reg) {
						die("<script>alert('留言成功！');history.back(-1);</script>");
					} else {
						die("<script>alert('留言失败！');history.back(-1);</script>");
					}
			}

		}

	}

	public function lxwmdel() {
		if (!preg_match ( '/^[0-9]{1,10}$/', I ('get.id') )) {
			$this->success('非法操作,將凍結賬號!');
		}else{
			$userinfo = M('task')->where (array('MA_ID' => I ('get.id')) )->find ();
			if ($userinfo['ma_username']<>$_SESSION ['uname']) {
				$this->success('非法操作,將凍結賬號!');
			}else{

				$reg = M('task')->where(array('MA_ID' => I ('get.id')))->delete();
				if ($reg) {
					$this->success('刪除成功!');
				}else {
					$this->success('刪除失敗!');

				}

			}

		}

	}

	public function lxwmx() {

		if (!preg_match ( '/^[0-9]{1,10}$/', I ('get.id') )) {
			$this->success('非法操作,將凍結賬號!');
		}else{
			$id = I ( 'get.id' );
		$data = M ('task')->where ( array (
				'MA_ID' => $id,
				'MA_userName'=>$_SESSION['uname']

		) )->find ();
		//dump($data);die;

		$this->data = $data;
		$this->display('lxwmx');
		}

	}
	
}