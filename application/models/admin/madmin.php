<?php
class madmin extends CI_Model{
    public function test(){
       $res=$this->db->query("select* from sys_user");
        return $res->result();
        
    }
	function check(){
		$data=$this->db->query("Select* from sys_user where (email='".$_POST['username']."' OR user_name='".$_POST['username']."') AND password='".md5($_POST['password'])."' AND status='Y' AND (user_type='ADMIN' || user_type='USER')");
		$data=$data->result();
		if(isset($data[0])){
			$this->session->set_userdata('user_type',$data[0]->user_type);
			$this->session->set_userdata('user_id',$data[0]->user_id);
			$this->session->set_userdata('user_name',$data[0]->first_name.' '.$data[0]->last_name);
			$this->session->set_userdata('last_login',$data[0]->last_login);
			$this->session->set_userdata('email',$data[0]->email);
			$this->session->set_userdata('phone',$data[0]->phone);
			$this->session->set_userdata('address',$data[0]->address);
			$this->session->set_userdata('image',$data[0]->image);
			$this->session->set_userdata('loggedin','true');
			$this->db->query("update sys_user set last_login=NOW() where user_id='".$data[0]->user_id."'");
			return "yes";
		}else{
			return "no";	
		}
	}
    
}