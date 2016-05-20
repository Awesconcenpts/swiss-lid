<?php
class moffices extends CI_Model{
    public function offices_list(){
       $res=$this->db->query("select * from " .$this->db->dbprefix . "offices order by offices_order ASC");
        return $res->result();
        
    }
	public function offices_get($id){
       $res=$this->db->query("select * from " .$this->db->dbprefix . "offices where offices_id='".$id."'");
        return $res->result();
        
    }
	public function offices_get_id(){
       $res=$this->db->query("select * from " .$this->db->dbprefix . "offices LIMIT 1");
        $d=$res->result();
		if(isset($d[0])){
		return 	$d[0]->offices_id;
		}else{
			return '';
		}
        
    }
	public function offices_delete($id){
       $res=$this->db->query("delete from " .$this->db->dbprefix . "offices where offices_id='".$id."'");
        
    }
	public function offices_update($id){
		
		$data=array(
			'offices_name'=>$_POST['offices_name'],
			'offices_desc'=>$_POST['offices_desc'],
			'offices_address1'=>$_POST['offices_address1'],
			'offices_address2'=>$_POST['offices_address2'],
			'offices_address3'=>$_POST['offices_address3'],
			'offices_address4'=>$_POST['offices_address4'],
			'offices_country'=>$_POST['offices_country'],
			'offices_phone'=>$_POST['offices_phone'],
			'offices_url'=>$_POST['offices_url'],
			'offices_mobile'=>$_POST['offices_mobile'],
			'offices_disclaimer'=>$_POST['offices_disclaimer']
		);	
		if($id==0){
			 $this->db->trans_start();
			 $this->db->insert('offices',$data);
			 $id=$this->db->insert_id();
			 $this->db->trans_complete();
		}else{
			$this->db->where('offices_id',$id);
			$this->db->update('offices',$data);
		}
		return $id;
	}
    
}