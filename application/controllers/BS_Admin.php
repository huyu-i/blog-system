<?php

class BS_Admin extends CI_Controller
{
	function getAllAdmin(){
		$array_mset = array(
			'username'=>'huyu',
			'age'=>21);               			//设置数组内容
		$this->redis->hmset();
		$this->redis->mset($array_mset);		//以集合方式存入redis
		// 读取redisG
		$arr=$this->redis->mget('username'); //读取键值为username的值
		var_dump($arr);   //打印出来
	}
}
