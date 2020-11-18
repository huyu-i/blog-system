<?php
class Login_model extends CI_Model{

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

	// 插入操作
	public function set_user()
	{
		$this->load->helper('url');

//		$slug = url_title($this->input->post('title'), 'dash', TRUE);

		$data = array(
			'name' => $this->input->post('name'),
			'password' => $this->input->post('password'),
			'dept_id' => $this->input->post('dept_id'),
			'notes' => $this->input->post('notes')
		);

		return $this->db->insert('user', $data);
	}

	public function selectById($id,$password){
		$sql = "select name from USER where id='$id' and password='$password'";

		$query = $this->db->query($sql);

		if($query!=null)
			return $query->row();
		else
			return null;
	}

	public function check_login(){
		$id = $this->input->post('id');
		$password = $this->input->post('password');


		$result = $this->selectById($id,$password);

		return $result;
	}

}
