<?php
class BS_User_model extends CI_Model{

	public function __construct()
	{
		$this->load->database();
	}

	// 查找全部
	public function get_user($slug = FALSE)
	{
		if ($slug === FALSE)
		{
			$query = $this->db->get('user');
			return $query->result_array();
		}

		$query = $this->db->get_where('user', array('slug' => $slug));
		return $query->row_array();
	}

	public function selectById($email,$password){
		//select "*" 可以获得完整对象
		$sql = "select * from USER where email='$email' and password='$password' and flag=1";

		$query = $this->db->query($sql);

		if($query!=null){
			$user_info = $query->row();
			if($user_info!=""){
				//第二种设置cookie的方式：通过CI框架的input类库
				$this->input->set_cookie("uid",$user_info->uid,3600);
				$this->input->set_cookie("username",$user_info->username,3600);
				$this->input->set_cookie("email",$user_info->email,3600);
				$this->input->set_cookie("role",$user_info->role,3600);
				$this->input->set_cookie("phone",$user_info->phone,3600);
	//			$this->input->set_cookie("flag",$user_info->flag,3600);
				return $user_info;
			}
			else{
				return null;
			}
		}
		else
			return null;
	}

	public function check_login(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$private_key='-----BEGIN RSA PRIVATE KEY-----
MIICXAIBAAKBgQCytYlGIkLH8Vp6FY72PSfjnlkwIkR6r8Iw6DJvSwVil8ww88hN
x3sf86CeE1ttoyIJO1jV52Oijr6P5cvtG3oG9J0ULp+wrJmtiEBJkAKuK/45+D65
boBKrI8ye/AGiQe0tm611JVGDMFyBJUKlAVQjsrkkjf93uzY562B448U4QIDAQAB
AoGAJ3eLEQeY+wI06phfQcdgy1aZuNUgjX3KY7WsCcMmNc9zY247Ut4WtYg+9Rou
S2jHKAXIyTi4WtqugCYOYtd6G7epam2V0q+RrIVwGJKXJzoR4RLYmDITAOlU/9H9
0PohTg11NMP3UjiqFWE5QG7vDFQBY9CrBFHifhJLWReW9MkCQQDWEAzSAoURyAaz
XYgoWlkYYVnhX5/IHXY+ONR2RUwY9aceBJ2WD4OPoccu3bOtKqf95i2dXiEILJWE
Em3tJIXVAkEA1bhjWHh7TnktXpt+DDEGSKES1vImHdyQc7dIgWW62ric8GV05ar2
SW949+UaY7prGdpKg2yQHv+6DKfMG7Nc3QJAeyHsXfk5FktbH13T7nJaAZ4uF2fr
/y6DT7Nc81NVPJ5BrRC2nRT7dml2q8y3iAqba382CemVUqBiuP/o35o8qQJBAJrP
+17Nv3xjuOKsPg00wfmAfDYpqES/TgAUhzf8afMgAcb9p0Tqp4cgcX8YfRo6onRS
tOEolelukuWx8t8p+R0CQBrMG0l4bvHH+nBXKGUkD8oruAKADUs33+vdt39BdhyI
Fnb+8RvK/z3S+JnSFdxCKB8tcKbyuJKC4L5Vz5r0Pm4=
-----END RSA PRIVATE KEY-----';

		//私钥解密
		openssl_private_decrypt(base64_decode($password),$decrypted,$private_key);
		$encrypt_exist = false;

		$arr = json_decode($decrypted, true);

		if(array_key_exists("encrypt",$arr)) {
			if($arr['encrypt']=="true")
				$encrypt_exist=true;
		}
		if(!$encrypt_exist)
			die("抱歉！数据提交错误！");
		//接下来进行数据库验证
		$result = $this->selectById($email,$arr['password']);

		return $result;
	}

	// 插入操作
	public function uRegister()
	{
		$this->load->helper('url');

		$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'email' => $this->input->post('email'),
//			'role' => $this->input->post('role'),
			'phone' => $this->input->post('phone'),
//			'flag' => $this->input->post('flag'),
		);

		return $this->db->insert('user', $data);
	}

}
