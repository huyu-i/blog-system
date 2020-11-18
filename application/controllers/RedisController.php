<?php

class RedisController extends CI_Controller
{
	// 简单示例
	function redisTest(){
		$array_mset=array(
			'username'=>'huyu',
			'age'=>21);               			//设置数组内容
		$this->redis->mset($array_mset); 		//以集合方式存入redis
		// 读取redis
		$arr=$this->redis->mget('username');	//读取键值为username的值
		var_dump($arr);							//打印出来
	}

	// 获取模型层数据并存入redis的set中（没有以对象的形式存储）
	function redis_insertAsSet(){
		$this->load->model('BS_User_model');  	//加载数据库
		$this->redis->flushdb();    					//清除redis现有数据
		$userAll=$this->BS_User_model->get_user();    	//获取user_model中all方法返回结果
//		var_dump($userAll);    	   						//打印用户列表数组
		foreach ($userAll as $key => $value) {
			$this->redis->sadd('username',$value['username']);	//将username存入redis
			$this->redis->sadd('email',$value['email']);   		//将email存入redis
			$this->redis->sadd('password',$value['password']);	//将password存入redis
		}
		echo '<hr>';    	//区分水平线
		var_dump($this->redis->smembers('username')); 	//打印redis中所有username列表
	}

	// 同样的数据，使用hash表（对象的形式）存入redis
	function redis_insertAsHash(){
		$this->load->model('BS_User_model');  	//加载数据库
		$this->redis->flushdb();						//清除redis现有数据
		$userAll=$this->BS_User_model->get_user();    	//获取user_model中all方法返回结果
//		var_dump($userAll);    	   	//打印用户列表数组

		foreach ($userAll as $key => $value) {
			// 以 email 为 key，存储 userinfo
			$this->redis->hmset($value['email'],
								array(
										"username"=>$value['username'],
										"uid"=>$value['uid'],
										"password"=>$value['password']
									)
								); 		//以hash表方式存储到redis中
		}
//		echo '<hr>';
//		var_dump($this->redis->hgetall('343921998@qq.com')); //获取user1的所有信息
	}

	// 处理登录
	function redis_login(){
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password','password','required');

		$this->load->view('blog/index_redis');

		$email = $this->input->post('email');		//获取表单输入的用户名
		$userpwd = $this->input->post('password');	//获取表单输入的用户密码

		$user_exists = $this->redis->hgetall($email);  //读取redis里所有用户姓名数组

		if(in_array($email, $user_exists)){		//判断输入的用户名是否已经存在
			$db_password = $this->redis->hget($email,'password'); //如果存在，查询redis数据库里当前用户的密码
			if($userpwd==$db_password){			//如果输入密码与数据库里密码匹配
				$session['email'] = $email;		//将当前用户名保存到session里
				echo 'welcome to your site!';
				$data['username'] = $this->redis->hget($email,'username');
				var_dump($data['username']);
				$this->load->view('blog/redisWelcome',$data);
				$this->load->view('templates/footer');
			}
			else{
				echo '密码有误';
			}
		}
		else if($email!='' && $userpwd!=''){
			echo '请登陆';
			$this->redis_insertAsHash();
		}
		else
			echo '请登陆';
	}

}
