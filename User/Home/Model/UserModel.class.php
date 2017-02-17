<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model {

	protected $_validate = array(
		//	array('UE_account','/^[_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,3}$/','用户名格式不对！',1),

			array('UE_account','UE_account1','用户名两次输入不对！',1,'confirm',self::MODEL_BOTH),
			array('UE_account','','用户名已存在！',1,'unique',self::MODEL_BOTH),
		//	array('UE_accName','/^[_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,3}$/','介绍人用户名格式不对！',1),
			array('UE_accName','require','介绍人必填！',1),
			array('UE_accName','validate','介绍人不存在！',1,'callback',self::MODEL_BOTH),

		//	array('UE_accName','UE_accName1','介绍人两次输入不对！',1,'confirm',self::MODEL_BOTH),
			array('UE_theme','1,50','昵称1-10个字元！',1,'length',self::MODEL_BOTH),

		//	array('UE_qq','require','QQ必填！',1),

			array('UE_phone','require','手机必填！',1),

			//array('weixin','require','微信不能为空',1),
			array('zfb','require','支付宝不能为空！',1),
			array('zbzh','require','开户行不能为空！',1),
			array('yhmc','require','银行名称不能为空！',1),
			array('yhzh','require','银行卡号不能为空！',1),

			//array('email','require','邮箱必填！',1),
			array('UE_phone','','手机号已存在!',1,'unique',self::MODEL_BOTH),


			array('UE_password','/^[a-zA-Z0-9]{6,15}$/','登入密码6-12个字元,大小写英文+数字,请勿用特殊词符！',1),

			array('UE_secpwd','/^[a-zA-Z0-9]{6,15}$/','二级密码6-12个字元,大小写英文+数字,请勿用特殊词符！',1),

			array('UE_password','UE_repwd','两次输入密码不同！',1,'confirm',self::MODEL_BOTH),
			array('UE_secpwd','UE_resecpwd','两次输入二级密码不同！',1,'confirm',self::MODEL_BOTH),

			//array('pin','/^[a-zA-Z0-9]{1,60}$/','PIN码输入不对,或已使用！',1),

			//array('pin','pinyz','PIN码输入不对,或已使用！',1,'callback',self::MODEL_BOTH),

			//array('pin','pin2','两次输入PIN码不同！',1,'confirm',self::MODEL_BOTH),
			array('active','active','激活码不正确！请重新获取',1,'callback',self::MODEL_BOTH),





	);

	protected $_auto = array (

			array('UE_password','md5',3,'function') ,

			array('UE_secpwd','md5',3,'function')

	);

	public function validate($data){

		if(M('user')->where(array('UE_account'=>$data))->find()){

			return TRUE;

		}else{

			return FALSE;

		}

	}

	function active($data){
		$data = $_POST['active'];
		if(M('pai')->where(array('pin'=>$data,'zt'=>'0'))->find()){
			M('pai')->where(array('pin'=>$data))->data(array('zt'=>'1','sy_user'=>$_POST['email'],'sy_date'=>date('Y-m-d H:i:s')))->save();
			return TRUE;
		}else{
			return FALSE;
		}
	}



	public function pinyz($data){

		if(M('pin')->where(array('pin'=>$data,'zt'=>'0'))->find()){

			return TRUE;

		}else{

			return FALSE;

		}

	}



	public function validate1($data){

		if(M('user')->where(array('UE_account'=>$data))->find()){

			return TRUE;

		}else{

			return FALSE;

		}

	}



}