<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index() {
		
		
		$id='';
		if(isset($_POST['download'])){
			global $CI;
			$str=file_get_contents('plugin/signature/templates/es_original.html');
			$id=$_POST['country'];
			// Setting up offices
			$data=$CI->moffices->offices_get($id);
			$str=$CI->mcommon->replace_backend($data,$str);
			
			//End setting up offices
			
			$str=$CI->mcommon->replace_users($data,$str);
			$id=uniqid().'.html';
			$this->session->set_userdata('id',$id);
			
			$this->session->set_userdata('email',$_POST['email']);
			$this->session->set_userdata('surname',$_POST['surname']);
			$this->session->set_userdata('fullname',$_POST['fullname']);
			$str = mb_convert_encoding($str, 'HTML-ENTITIES', "UTF-8");
			file_put_contents('plugin/signature/generated/prev-'.$id, $str);
			file_put_contents('plugin/signature/generated/'.$id, htmlentities($str));
		}
		
		$this->load->view('frontend/index',array('st'=>$id));
	}
	public function download() {
		global $CI;
		if(isset($_GET['download'])){
			
			//Emailing function
			// To user
			$config = Array(
				/*'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.gmail.com',
				'smtp_port' => 465,
				'smtp_user' => 'qdesign.dev@gmail.com',
				'smtp_pass' => 'qdesign@1234',*/
				'mailtype'  => 'html', 
				'charset'   => 'iso-8859-1'
			);
			$this->load->library('email', $config);
			$this->email->from(get_settings('email_address'), get_settings('site_name').' '.get_settings('site_slug'));
			$this->email->to($this->session->userdata('email')); 
			$this->email->subject('Download confirmation');
			$this->email->message($CI->mcommon->getuseremails()); //echo $CI->mcommon->getuseremails();	
			//$this->email->attach(base_url().$_GET['download']);
			$this->email->send();
			
			//echo $this->email->print_debugger();
			$toname=str_replace("&nbsp;", ' ',$this->session->userdata('fullname'));
			$this->email->from($this->session->userdata('email'),$toname);
			$this->email->to(get_settings('email_address')); 
			$this->email->subject($toname.' downloaded a email signature');
			$this->email->message($CI->mcommon->getadminemails());	//$CI->mcommon->getadminemails()
			//$this->email->attach(base_url().$_GET['download']);
			$this->email->send();
			//echo $this->email->print_debugger();
			//die;
			$filePath=$_GET['download'];
			$fileName ='signature.html';
			$fileSize = filesize($filePath);
			header("Cache-Control: private");
			header("Content-Type: application/stream");
			header("Content-Length: ".$fileSize);
			header("Content-Disposition: attachment; filename=".$fileName);
			readfile ($filePath);
			
			
			//End emailing function
			
			                 
			exit();
		}
	}
	public function logout() {
		$this->session->set_userdata('loggedin','false');
	}
}