<?php

namespace Home\Controller;

use Think\Controller;

class RegularController extends Controller {
	public function index(){
		//自动匹配

		tgbz_automatch();
		/*print_r($tgbz_automatch_list);
		exit;*/

		$this->display();
	}

}