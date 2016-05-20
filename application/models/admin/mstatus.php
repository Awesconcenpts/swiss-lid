<?php
class mstatus extends CI_Model{
    public function status_list($type=''){
		$sub='';
		if($type!=''){
			$type=' where status_owner="'.$type.'" ';
		}
       $res=$this->db->query("select * from " .$this->db->dbprefix . "status u".$type. " order by status_date DESC");
        return $res->result();
        
    }
	public function status_get($id){
       $res=$this->db->query("select * from " .$this->db->dbprefix . "status u where u.status_id='".$id."'");
        return $res->result();
        
    }
	public function status_delete($id){
       $res=$this->db->query("delete from " .$this->db->dbprefix . "status where status_id='".$id."'");
        
    }
	public function status_update($id){
		$data=array(
			'status_content'=>$_POST['status_content'],
			'status_owner'=>$_POST['status_owner'],
			'status_date'=>$_POST['status_date'],
		);	
		if($id==0){
			 $this->db->trans_start();
			 $this->db->insert('status',$data);
			 $id=$this->db->insert_id();
			 $this->db->trans_complete();
		}else{
			$this->db->where('status_id',$id);
			$this->db->update('status',$data);
		}
		return $id;
	}
    
}