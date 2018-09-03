<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function index(){
		if (isset($_GET["ID"])) {
			$id=$_GET["ID"];
			$page=$_GET["page"];
			$limit=$_GET["limit"];
		}
		$this->load->database("default1");
		$count=$this->db->get("datatable")->result();
		$data=$this->db->limit($limit, ($page-1)*$limit)->get("datatable")->result();
		echo json_encode(array("id" => $id,"data" => $data,"total"=>count($count)));
	}
	public function addOne(){
			$this->load->database("default1");
		if (isset($_POST['id'])) {
			$id=$_POST['id'];
			$res=$this->db->update('datatable', $_POST, array('id' => $id));
			echo rejson($res);
		}else{
			$data["name"]=$_POST["name"];
			$data["content"]=$_POST["content"];
			$res=$this->db->insert("datatable",$data);
			echo json_encode($res);
		}
	}
	public function delOne(){
		$this->load->database("default1");
		$data["id"]=$_POST['id'];
		$res=$this->db->delete("datatable",$data);
		echo json_encode($res);
	}
	public function editOne(){
		$this->load->database("default1");
		$data["id"]=$_POST['id'];
		$res=$this->db->where($data)->get("datatable")->row();
		echo rejson($res);
	}
}
