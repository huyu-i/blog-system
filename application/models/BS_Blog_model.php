<?php
class BS_Blog_model extends CI_Model{

	public function __construct()
	{
		$this->load->database();
	}

	// 按 uid 查询文章(列表)
	public function getByUid($uid){

		$sql = "select * from BLOG where uid=$uid and flag=1";

		$query = $this->db->query($sql);

		if($query!=null){
			return $query->result_array();		//多个结果，用result_array
		}
		else {
			return null;
		}
	}

	// 按 bid 查询文章
	public function getByBid($bid){

		$sql = "select * from BLOG where bid=$bid and flag=1";

		$query = $this->db->query($sql);

		if($query!=null){
			return $query->row_array();		//单个结果，用row_array
		}
		else {
			return null;
		}
	}

	public function get_type(){
		$query = $this->db->get('type');
		return $query->result_array();
	}

	// 插入操作
	public function write(){
		$this->load->helper('url');

		$sql = 'insert into BLOG (uid, title, content, time, tag) VALUES ("'
			.$_COOKIE['uid'].'", "'
			.$this->input->post('title').'", "'
			.$this->input->post('content').'", '
			.'sysdate(),"'
			.$this->input->post("tag").'")';
//		echo $sql;

		$this->db->query($sql);

//		由于php的date有点麻烦，所以直接用上面的sql语句，使用mysql的sysdate()
//		$data = array(
//			'uid' => $_COOKIE['uid'],
//			'title' => $this->input->post('title'),
//			'content' => $this->input->post('content'),
//			'time' => date("Y-m-d H:i:s"),
//			'tag' => $this->input->post('tag')
//		);
//		return $this->db->insert('blog', $data);
	}

	// 插入操作
	public function modify(){
		$this->load->helper('url');

		$bid = $this->input->post('bid');

		$sql = 'update BLOG set '
			.'title="'
			.$this->input->post('title').'", '
			.'content="'
			.$this->input->post('content').'", '
			.'tag="'
			.$this->input->post("tag").'" '
			.'where bid='
			.$bid;
//		echo $sql;

		$this->db->query($sql);
	}

	// 删除操作（修改标识位）
	public function delete($bid){
		$this->load->helper('url');

		$sql = 'update BLOG set flag=0 where bid='.$bid;
//		echo $sql;

		$this->db->query($sql);
	}
}
