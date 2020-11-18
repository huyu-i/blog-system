<?php

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');	// 加载模型
		$this->load->helper('url_helper');	// 辅助函数
	}

	// 显示所有
	public function index()
	{
		// 控制器获取到数据model
		$data['user'] = $this->login_model->get_user();
		$data['title'] = 'All user';
		// 将数据传递给视图view
		$this->load->view('templates/header', $data);	// 用到的是 $title，作为页面标题
		$this->load->view('login/index', $data);		// 用到的是 $user
		$this->load->view('templates/footer');
	}

	// 显示特定
	public function log_in()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('id', 'id', 'required');
		$this->form_validation->set_rules('password','password','required');

		if ($this->form_validation->run() === FALSE)
		{
			$data['title'] = '登陆';
			$this->load->view('templates/header', $data);	// 传递$title
			$this->load->view('login/log_in');
			$this->load->view('templates/footer');
		}
		else
		{
			// 前端验证成功，查询数据库验证密码
			$data['user'] = $this->login_model->check_login();
			if($data['user'] == null) {
				$data['title'] = '登陆失败';
				$this->load->view('templates/header', $data);    // 传递$title
				$this->load->view('login/log_in');
				$this->load->view('templates/footer');
			}
			else
			{
				$this->load->view('login/welcome',$data);
				$this->load->view('templates/footer');
			}
		}
	}


	// 创建
	public function create()
	{
		$this->load->helper('form');	// 导入表单库
		$this->load->library('form_validation');	// 导入表单验证库

		$data['title'] = '创建用户';

		// 设置表单验证规则（e.g.required-必填）
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('dept_id', 'dept_id', 'required');
		$this->form_validation->set_rules('notes', 'notes', 'required');
		$this->form_validation->set_rules('password','password','required');

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);	// 传递$title
			$this->load->view('login/add');
			$this->load->view('templates/footer');
		}
		else
		{
			$this->login_model->set_user();
			$this->load->view('login/success');
		}
	}
}
