<?php

class BS_Blog extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('bs_blog_model');	// 加载模型
		$this->load->helper('url_helper');	// 辅助函数
	}

	// 显示所有
	public function getByUid()
	{
		// 控制器获取到数据model
		if (!isset($_COOKIE['uid'])) {
			echo "请先登录";
		}
		else{
			$data['blogs'] = $this->bs_blog_model->getByUid($_COOKIE['uid']);
			$data['title'] =  'All blog of '.$_COOKIE['username'];
			// 将数据传递给视图view
			$this->load->view('templates/header', $data);		// 用到的是 $title，作为页面标题
			$this->load->view('blog/index', $data);      	 	// 用到的是 $blogs
			$this->load->view('templates/footer');
		}
	}

	// 加载 tag 列表
	public function writeLoad()
	{
		$this->load->helper('form');	// 导入表单库
		$this->load->library('form_validation');	// 导入表单验证库
		// 控制器获取到数据model
		$data['typeList'] = $this->bs_blog_model->get_type();
		$data['title'] = '写博客';

		// 将数据传递给视图view
		$this->load->view('templates/header', $data);	// 用到的是 $title，作为页面标题
		$this->load->view('blog/write', $data);		// 用到的是 $user
		$this->load->view('templates/footer');
	}

	// 创建新博客
	public function writeSave()
	{
		$this->load->helper('form');	// 导入表单库
		$this->load->library('form_validation');	// 导入表单验证库

		$data['title'] = '写博客';

		// 设置表单验证规则（e.g.required-必填）
		$this->form_validation->set_rules('title', 'title', 'required');
		$this->form_validation->set_rules('content', 'content', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);	// 传递$title
			$this->load->view('blog/write');
			$this->load->view('templates/footer');
		}
		else
		{
			$this->bs_blog_model->write();
			$this->getByUid();
//			$this->load->view('blog/success');
		}
	}

	// 加载修改页面 —— 1.old	2.typelist
	public function modifyLoad()
	{
		$this->load->helper('form');	// 导入表单库
		$this->load->library('form_validation');	// 导入表单验证库

		$bid = $_GET["bid"];

		// 控制器获取到数据model
		$data['typeList'] = $this->bs_blog_model->get_type();
		$data['old'] = $this->bs_blog_model->getByBid($bid);
		$data['title'] = '修改博客';

		// 将数据传递给视图view
		$this->load->view('templates/header', $data);	// 用到的是 $title，作为页面标题
		$this->load->view('blog/bModify', $data);		// 用到的是 $user
		$this->load->view('templates/footer');
	}

	public function modifySave()
	{
		$this->load->helper('form');	// 导入表单库
		$this->load->library('form_validation');	// 导入表单验证库

		$data['title'] = '修改博客';

		// 设置表单验证规则（e.g.required-必填）
		$this->form_validation->set_rules('bid', 'bid', 'required');
		$this->form_validation->set_rules('title', 'title', 'required');
		$this->form_validation->set_rules('content', 'content', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);	// 传递$title
			$this->load->view('blog/uModify');
			$this->load->view('templates/footer');
		}
		else
		{
			$this->bs_blog_model->modify();
			$this->getByUid();
//			$this->load->view('blog/success');
		}
	}

	// 删除
	public function deleteByBid()
	{
		$this->load->helper('form');	// 导入表单库
		$this->load->library('form_validation');	// 导入表单验证库

		$bid = $_GET["bid"];

		$this->bs_blog_model->delete($bid);
		$this->getByUid();
//		$this->load->view('blog/success');
	}

	public function showDetail()
	{
		$bid = $_GET["bid"];

		$data['title'] = '我的博客';
		$data['blog'] = $this->bs_blog_model->getByBid($bid);

		// 将数据传递给视图view
		$this->load->view('templates/header', $data);	// 用到的是 $title，作为页面标题
		$this->load->view('blog/bDetail', $data);		// 用到的是 $blog
		$this->load->view('templates/footer');
	}

}
