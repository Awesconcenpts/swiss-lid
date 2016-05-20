<?php
class muser extends CI_Model{
    public function user_list($type=''){
		$sub='';
		if($type!=''){
			$type=' where user_type="'.$type.'" ';
		}
       $res=$this->db->query("select *, CONCAT(u.first_name,' ',u.last_name) as fullname from " .$this->db->dbprefix . "user u".$type);
        return $res->result();
        
    }
	public function user_get($id){
       $res=$this->db->query("select *, CONCAT(u.first_name,' ',u.last_name) as fullname from " .$this->db->dbprefix . "user u where u.user_id='".$id."'");
        return $res->result();
        
    }
	public function user_check_username_password(){
       $res=$this->db->query("select * from sys_user where (user_name='".$_POST['username']."' OR email='".$_POST['username']."') AND status='Y' AND password='".md5($_POST['password'])."' AND (user_type='SPONSOR' OR user_type='TRAINER')");
        $data=$res->result();
		
		return $data;
        
    }
	public function user_delete($id){
       $res=$this->db->query("delete from " .$this->db->dbprefix . "user where user_id='".$id."'");
        
    }
	public function user_update($id){
		$_POST['password']=($_POST['password']!='')?md5($_POST['password']):$_POST['oldpwd'];
		$data=array(
			'first_name'=>$_POST['first_name'],
			'last_name'=>$_POST['last_name'],
			'email'=>$_POST['email'],
			'user_name'=>$_POST['user_name'],
			'user_type'=>$_POST['user_type'],
			'password'=>$_POST['password'],
			'phone'=>$_POST['phone'],
			'address'=>$_POST['address'],
		);	
		if($id==0){
			 $this->db->trans_start();
			 $this->db->insert('user',$data);
			 $id=$this->db->insert_id();
			 $this->db->trans_complete();
		}else{
			$this->db->where('user_id',$id);
			$this->db->update('user',$data);
		}
		return $id;
	}
    
}