<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function index() {
		if($this->uri->segment(2)==''){
			if($this->session->userdata('loggedin')=='true'){
				if(isset($_POST['status'])){
					$this->mcommon->update_status();
				}elseif(isset($_POST['display_order'])){
					$this->mcommon->update_order();
				}
				$data['userdata']=$this->session->userdata;
				$data['content']=loadStatic();
				$this->load->view('admin/index',$data);
			}else{
				redirect(base_url().'admin/login');
			}
		}
	}
	public function login(){
		$this->load->view('admin/login');
	}
	public function el_load(){
		global $CI;
		$str=file_get_contents('plugin/signature/templates/es_original.html');
		$data=$CI->moffices->offices_get($_GET['id']);
		$str=$CI->mcommon->replace_backend($data,$str);
		
		echo $str;
	}
	function logout(){
		$this->session->sess_destroy();
		header("location:".base_url()."admin/login");
	}
	function logout1(){
		$this->session->sess_destroy();
		header("location:".base_url());
	}
	function change_slug(){
		$data=array(
			'cms_slug'=>$_POST['cms_slug'],
		);	
		$this->db->where('cms_id',$_POST['cms_id']);
		$this->db->update('cms',$data);
		
	}
	function check(){
		if(isset($_POST['username']) && (isset($_POST['password']))){
			$date=$this->madmin->check($this->input->post('username'), $this->input->post('password'));
			if($date=="yes"){
				echo '[{"status":"success","redirect_url":"'.base_url().'admin/"}]';
			}else{
				 echo '[{"status":"invalid","redirect_url":"'.base_url().'admin/login"}]';
			}
		}else{
			echo '[{"status":"invalid","redirect_url":"'.base_url().'admin/login"}]';
		}
	
	}
}