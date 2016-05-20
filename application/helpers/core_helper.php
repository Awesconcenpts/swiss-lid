<?php
global $CI;
if(!defined('encryption_key')){
	global $config;
	define('encryption_key',$config['encryption_key']);
}

function GetArrayIndex($e,$f){
	if(is_array($e) && array_key_exists(0,$e)){
		if(isset($e[0]) && isset($e[0]->$f)){
			return $e[0]->$f;
		}
	}else{
		if(isset($e->$f)){
			return $e->$f;
		}
	}
}
function get_slug_edit($id=0){
	global $CI;
	if($id!=0){
		$list=$CI->mcms->cms_get($id);
		$cms_slug=GetArrayIndex($list,'cms_slug');
	?>
    <style type="text/css">
	.slug{
		color:#F00;
		width:auto;
		height:auto;
	}
	.slug button{
		padding:0px 3px 0px 3px;
		margin:0px;
		position:absolute;
		margin-left:2px;
	}
	</style>
    <script type="text/javascript">
	$(document).ready(function(e) {
        $(".slg").click(function(){
			$.ajax({
				url: 'admin/change_slug/',
				data:{'cms_id':'<?php echo $id; ?>','cms_slug':$(".slug").html()},
				type: "post",
				dataType: "json",
				success: function(json){
					
				}
			});
		})
    });
	</script>
    <span class="text-info" style="padding-top:10px; float:left;height:auto;width:auto;"><b>URL to access this page: </b><?php echo base_url().'<i class="slug" cms-id="'.$id.'" contenteditable="true">'.$cms_slug.'</i>/ <button class="slg btn btn-green btn-xs" type="button">Ok</button>'; ?></span>
    <?php
	}
}
function add_option($id='',$key='',$val=''){
	global $CI;
	if($id!='' && $key != '' && $val != ''){
		$res=query("select option_value from ".$CI->db->dbprefix."options where option_key='".$key."' AND common_id='".$uid."'");
		
		if(sizeof($res)==0){
			$data=query("insert into ".$CI->db->dbprefix."options (option_key,option_value,common_id) values('".$key."','".$val."','".$uid."')");
		}
	}
}
function get_status($e=''){
	
}
function set_status($e='',$i=''){
	
}
function get_option($id='',$key=''){
	global $CI;
	if($key!=''){
		$data=query("select option_value from ".$CI->db->dbprefix."options where option_key='".$key."' AND common_id='".$id."'");
		$v='';
		
		if(isset($data[0]) && isset($data[0]->option_value)){
			return $data[0]->option_value;
		}
	}
}
function get_cms_option($id='',$key='',$op='',$value='value'){
	global $CI;
	if($key!=''){
		$cstm=get_option($id,$op.'custom_fields');
		$cmtm=json_decode($cstm,true);
		$cmtm=is_array($cmtm)?$cmtm:array();
		foreach($cmtm as $val){
			if($val['custom_field_key']==$key){
			return 	($value=='value')?$val['custom_field_value']:$val['custom_field_name'];
			}
		
		}
	}else{
		$cstm=get_option($id,$op.'custom_fields');
		return $cmtm=json_decode($cstm,true);
	}
}
function get_option_all($key='',$value=''){
	global $CI;
	if($key!='' && $value!=''){
		return query("select* from ".$CI->db->dbprefix."options where option_key='".$key."' AND option_value='".$value."'");
		
	}else{
		return query("select* from ".$CI->db->dbprefix."options where option_value='".$value."'");
	}
}
function delete_option($id='',$key=''){
	global $CI;
	if($id!='' && $key!=''){
		$data=query("delete from ".$CI->db->dbprefix."options where option_key='".$key."' AND common_id='".$id."'");
	}
}

function update_option($id='',$key='',$val=''){
	global $CI;
	if($id!='' && $key!=''){
		$res=query("select option_value from ".$CI->db->dbprefix."options where option_key='".$key."' and common_id='".$id."'");
		if(sizeof($res)==0){
			$data=query("insert into ".$CI->db->dbprefix."options (option_key,option_value,common_id) values('".$key."','".$val."','".$id."')");
		}else{
			$data=query("update ".$CI->db->dbprefix."options set option_value='".$val."' where option_key='".$key."' and common_id='".$id."'");
		}
	}
}
function create_slug($table_name,$field_name,$string,$query) {
	global $CI;
	$result = preg_replace("/[^a-zA-Z0-9]+/", "-", $string);
	$res=$CI->db->query("select* from ".$CI->db->dbprefix.$table_name." where ".$field_name."='$result'".$query)->result();
	if(sizeof($res)==0){
	return strtolower($result);
	}else{
		return strtolower($result).'-'.sizeof($res).date('h');
	}
}
// User ID
function get_user_id(){
	global $CI;
	
	if(isset($CI)){
		$CI =& get_instance();
		
		if($CI->session->userdata("user_id") != ''){
			return $CI->session->userdata("user_id");
		}else{
			return '0';
		}
	}else{
		return '0';
	}
}

// User Type ID
function get_user_type_id(){
	global $CI;
	
	if(isset($CI)){
		$CI =& get_instance();
		
		if($CI->session->userdata("user_type") != ''){
			return $CI->session->userdata("user_type");
		}else{
			return '2';
		}
	}else{
		return '2';
	}
}

function query($sql){
	global $CI;
	
	if(isset($CI)){
		$CI =& get_instance();
        $CI->load->database();
		$query = $CI->db->query($sql);
		
		if((strpos($sql,'select') !== false) || (strpos($sql,'select*') !== false)) {
			return $query->result();
		}
	}else{
		global $model;
		
		if($model){
			return $model->query($sql);
		}
	}
}


function get_settings($e='',$default=''){
	global $CI;
	$datas=query("select* from ".$CI->db->dbprefix."website_setting where field_name='".$e."'");
	$res=$default;
	
	if(sizeof($datas)>0 && isset($datas[0]->field_value)){
		$res=$datas[0]->field_value;
	}
	
	return $res;
}

function get_pages($arg){
	global $CI;
	$class			= '';
	$home			= 'true';
	$parent			= '0';
	$add_last		= '';
	$page_position	= 'default';
	
	if(is_array($arg)){
		if(isset($arg['parent'])){
			$parent			= $arg['parent'];
		}
		if(isset($arg['parent'])){
			$add_last		= $arg['add_last'];
		}
		if(isset($arg['home'])){
			$home			= $arg['home'];
		}
		if(isset($arg['class'])){
			$class			= $arg['class'];
		}
		if(isset($arg['page_position'])){
			$page_position	= $arg['page_position'];
		}
	}
	
	$menus='';
	$res=query("select* from ".$CI->db->dbprefix."cms c,".$CI->db->dbprefix."cms_position p where c.cms_position_id=p.cms_position_id  AND p.cms_position_slug='".$page_position."' AND c.cms_parent='0' and c.status='Y' order by c.display_order ASC");
	if(sizeof($res)>0){
		$menus.='<ul class="'.$class.'" id="main-menu">';
		//<a href="javascript:;"  data-toggle="dropdown"  class="submenu-icon">Home <span class="glyphicon glyphicon-chevron-down"></span> <span class="glyphicon glyphicon-chevron-up"></span> </a>
		if($home=='true'){
			$cls=(get_current_page()=='')?'class="active"':'';
			$menus.='<li '.$cls.'>';
				$menus.='<a href="'.get_full_path().'">';
					$menus.='<span>Home </span>';
				$menus.='</a>';
			$menus.='</li>';
		}
	
		foreach($res as $vals){
			$sublists=get_sub_pages($vals->cms_id,'',$page_position);
			$cls=($vals->cms_title==get_current_page())?'active':'';
			
			$menus.='<li class="'.$cls.'">';
			if($sublists!=''){
				$menus.='<a href="javascript:;" data-toggle="dropdown" class="submenu-icon">'.$vals->cms_title.'<span class="glyphicon glyphicon-chevron-down"></span></a>';
			}else{
				$menus.='<a href="'.get_link($vals->cms_id,'').'" >'.$vals->cms_title.'</a>';
			}
			$menus.=$sublists;
			$menus.='</li>';
		}
		$menus.=$add_last."</ul>";
	}
	
	return $menus;
}

// Subpages
function get_sub_pages($parent='0',$class='',$page_position=''){
	global $CI;
	$sub='';
	$res=query("select*  from ".$CI->db->dbprefix."cms c,".$CI->db->dbprefix."cms_position p where c.cms_position_id=p.cms_position_id AND p.cms_position_slug='".$page_position."' AND c.cms_parent='$parent' and c.status='Y' order by c.display_order ASC");
	
	if(sizeof($res)>0){
		$sub.='<ul class="dropdown-menu">';
		
		foreach($res as $vals){
			$sublists=get_sub_pages($vals->cms_id,'');
			$has=($sublists!='')?'has-sub':'';
			$cls=($vals->cms_title==get_current_page())?'class=" active $has "':'';
			$sub.='<li '.$cls.'>';
				$sub.='<a href="'.get_link($vals->cms_id,'').'">';
					$sub.='<span>'.$vals->cms_title.'</span>';
				$sub.='</a>';
				$sub.=$sublists;
			$sub.='</li>';
		}
		
		$sub.="</ul>";
	}
	
	return $sub;
}

// Link
function get_link($id,$link){
	global $CI;
	$res=query("select* from ".$CI->db->dbprefix."cms where cms_id='$id' order by display_order ASC");
	
	if(sizeof($res)>0){
		$link=($link!='')?$res[0]->cms_slug.'/'.$link:$res[0]->cms_slug;
		if($res[0]->cms_parent!='0'){
			return get_link($res[0]->cms_parent,$link);
		}else{
			return $link.'.html';
		}
	}else{ return $link.'.html'; }
}

// Set Content
function set_contents(){
	$res=query("select* from ".prefix."cms where cms_slug='".get_current_page()."' order by display_order ASC");
	
	if(sizeof($res)>0){
		return $post['db']=$res;//$res;
	}elseif(get_current_page()!=''){
		
	}else if(sizeof($res)==0 && get_current_page()!=''){
		echo get_current_page().( "Page not found");
	}
}

// URLS
function get_current_page(){
	$sinments 		= explode("#",'http://'.$_SERVER["SERVER_NAME"].$_SERVER['REQUEST_URI']);
	$sinments1 		= explode("?",$sinments[0]);
	$sinments_prm 	= explode("/",str_replace(get_full_path(),'',$sinments1[0]));
	$sinments_prm=array_filter($sinments_prm);
	
	if(sizeof($sinments_prm)>0){
		return pathinfo(urlencode($sinments_prm[sizeof($sinments_prm)-1]), PATHINFO_FILENAME);
		//return urlencode($sinments_prm[sizeof($sinments_prm)-1]);
	}else{
		return '';
	}
}

// Full Path
function get_full_path(){
	global $CI;
	
	if(isset($CI)){
		$CI =& get_instance();
		
		return $CI->config->item('base_url');
	}
}

// Page Title
function get_the_title(){
	$current=set_contents();
	
	return isset($current[0])?$current[0]->cms_title:'';
}

function formatBytes($bytes) { 
    if ($bytes >= 1073741824){
		$bytes = number_format($bytes / 1073741824, 2) . ' GB';
	}elseif ($bytes >= 1048576){
		$bytes = number_format($bytes / 1048576, 2) . ' MB';
	}elseif ($bytes >= 1024){
		$bytes = number_format($bytes / 1024, 2) . ' KB';
	}elseif ($bytes > 1){
		$bytes = $bytes . ' bytes';
	}elseif ($bytes == 1){
		$bytes = $bytes . ' byte';
	}else{
		$bytes = '0 bytes';
	}

	return $bytes;
} 

// Allowed Image Extensions (formats)
function imageExtensions(){
	return array('bmp','gif','jpeg','jpg','png');
}

function isImage($e){
	$ext = pathinfo($e, PATHINFO_EXTENSION);
	if(in_array($ext,imageExtensions())){
		return true;
	}else{
		return false;
	}
}

function code($data,$enc=true){
    if ($enc == true) {
        $output = base64_encode (convert_uuencode ($data));
    } else {
        $output = convert_uudecode (base64_decode ($data));
    }
	$result = preg_replace("/[^a-zA-Z0-9]+/", "", $output);
	
	return strtolower($result);
}

function get_discounted_price($price,$discount_persentage){
	return $newprice = $price * ((100-$discount_persentage) / 100);
}

function search_in_array($e,$values){
	foreach($e as $key=>$val){
		if(is_array($val)){
			if(in_array($values,$val)){
				return $key;
			}
		}else{
			return false;
		}
	}
}
function loadStatic(){
		ob_start();
		global $CI;
		if(isset($_GET['page'])){
			$explode=explode('/',$_GET['page']);
			if(isset($explode[0]) && $explode[0]=='system' && file_exists('application/views/'.$explode[1])){
				include('application/views/'.$explode[1]);
			}else{
				if(file_exists('plugin/'.$_GET['page'])){
					$CI=$CI;
					include('plugin/'.$_GET['page']);
				}else{
					echo "Sorry, your requested module was not found.";	
				}
			}
		}else{
			include('application/views/admin/home.php');
		}
		$message = ob_get_contents();
		ob_end_clean();
		return $message;
	}
	function get_plugins(){
	$directory = "plugin";
	$plugins=array();
	$plugins_name=array();

	foreach (new DirectoryIterator($directory) as $fileInfo) {
		
		if($fileInfo->isDot()) continue;
		if(!$fileInfo->isDir()) continue;
		
		foreach (new DirectoryIterator($directory.'/'.$fileInfo->getFilename()) as $files){
			
			if($files->isDot()) continue;
			if($files->isDir()) continue;
			
			if($files->getFilename()=="index.php"){
				$html =file($directory.'/'.$fileInfo->getFilename().'/'.$files->getFilename());
				
				foreach ($html as $line_num => $line) {
					$stringa = htmlspecialchars($line);
					if(preg_match('/Plugin Name (.*)/', $stringa, $match)){
						$plugins_name[]= array($stringa,$directory.'/'.$fileInfo->getFilename().'/index.php');
						break;
					}
				}
			}
		}
	}
	return $plugins_name;
}
function get_template(){
	$directory = "application/views/frontend/";
	$plugins=array();
	$plugins_name=array();
	foreach (new DirectoryIterator($directory) as $fileInfo){
		
		if($fileInfo->isDot()) continue;
		if($fileInfo->isDir()) continue;
		$html =file($directory.'/'.$fileInfo->getFilename());

		
		foreach ($html as $line_num => $line) {
			$stringa = htmlspecialchars($line);
			if(preg_match('/Template Name (.*)/', $stringa, $match)){
				$nam=explode(':',$stringa);
				$plugins_name[]= array($nam[1],$fileInfo->getFilename());
				break;
			}
		}
	}
	return $plugins_name;
}
function GridView($data){
	return new GridView($data);
}

class GridView{
	protected $_obj;
	protected $unique_key_field;
	protected $table_name;
	protected $display_order=false;
	protected $object;
	protected $edit_file_name;
	public function __construct($data){
		$this->_obj=$data;
	}
	
	function GetModuleName(){
		if(isset($_GET['page'])){
			$module=explode('/',$_GET['page']);
			if(isset($module[0])){
				return $module[0];
			}
		}
	}
	
	function render(){
		$tr_data=isset($this->_obj['tr_data'])?$this->_obj['tr_data']:array();
		$fields=isset($this->_obj['fields'])?$this->_obj['fields']:array();
		$object=isset($this->_obj['object'])?$this->_obj['object']:array();
		$this->edit_file_name=isset($this->_obj['edit_file_name'])?$this->_obj['edit_file_name']:'new.php';
		$this->object=$object;
		$this->unique_key_field=isset($this->_obj['unique_key_field'])?$this->_obj['unique_key_field']:'no';
		$this->table_name=isset($this->_obj['table_name'])?$this->_obj['table_name']:'';
		$table='<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-striped datatable"><thead><tr>';

		foreach($fields as $key=>$val){
			$table.="<th class=".$this->get_css($val).">".$key."</th>";
		}
		$table.='</tr></thead>';
		$table.="<tbody>";
		$index=0;
		foreach($object as $val){
			$index++;
			$table.="<tr ".$this->get_tr_data($val,$tr_data).">";
			foreach($fields as $k=>$d){
				switch($d['data_field']){
					case "sn":
						$table.="<td>".$index."</td>";
						break;
					case "snc":
						$table.="<td class='display_order'>".$index."&nbsp;&nbsp;[ID=".$val->category_id."]</td>";
						break;
					case "action":
						$table.="<td class=".$this->get_css($fields[$k]).">".$this->get_action($val,$d)."</td>";
						break;
					case "status":
						$table.="<td>".$this->get_status($val,$d)."</td>";
						break;
					case "display_order":
						$this->display_order=true;
						$table.="<td>".$this->get_display_order($val,$d)."</td>";
						break;
					case "image_with_title":
						$table.='<td>'.$this->get_title_with_image($val,$d).'</td>';
						break;
					case "cat_parent":
						$table.='<td>'.$this->get_parent_category($val,$d).'</td>';
						break;
					default:
						$table.="<td>".stripslashes($this->get_object_text($val,$d))."</td>";
						break;
				}
			}
			$table.="</tr>";
		}
		$table.='</tbody></table>';
		if($this->display_order){
			$table.='<button type="submit" style="float: right; margin-right: 0; margin-top: -6px; margin-bottom: 0;" name="update_status" value="Update Status" class="btn btn-green btn-icon icon-left"><i class="entypo-arrows-ccw"></i>Update Orders</button>';
		}
		return $table;
	}

	function get_css($data){
		return isset($data['css'])?$data['css']:'';
	}
	
	function get_object_text($data,$d){
		return isset($data->$d['data_field'])?$data->$d['data_field']:'';
	}
	
	function get_status($data,$d){
		$data_field=isset($d['data_field'])?$d['data_field']:'';
		
		if($this->unique_key_field!="no" && $this->table_name!=""){
			$id=isset($data->{$this->unique_key_field})?$data->{$this->unique_key_field}:'';
			//echo "<pre>";
			//print_r($data);
			//echo "<br>".$data->$data_field;
			$a='<input class="status" name="status" type="submit" value="'.$this->table_name.'|'.$this->unique_key_field.'|'.$id.'|'.$data_field.'" style="background-image:url(assets/admin/images/'. (($data->$data_field=='Y')?'active.gif':'inactive.gif').');"  />';
			return $a;
		}
	}
	function get_parent_category($data,$d){
		$data_field=isset($d['data_field'])?$d['data_field']:'';
	if($data->parent!='0'){
		foreach($this->_obj['object'] as $val){
			//print_r($data); die();
			if($val->category_id==$data->parent){
				return $val->category_name;
			}
		}
	}else{
		return "No Parent";
	}
		
	}
	function get_display_order($data,$d){
		if($this->unique_key_field!="no" && $this->table_name!=""){
			$id=isset($data->{$this->unique_key_field})?$data->{$this->unique_key_field}:'';
			$a='<input name="display_order[]" type="hidden" value="'.$this->table_name.'|'.$this->unique_key_field.'|'.$id.'|display_order" />';
			  $a.='<input type="text" class="input_order form-control" name="display_order_new[]" size="1" value="'. $data->display_order .'" />';
			return $a;
		}
	}
	
	function get_tr_data($val,$tr_data){
		$datas="";
		if(is_array($tr_data)){
			$i=0;
			foreach($tr_data as $key=>$dts){
				$attr=$key;
				$url=isset($dts['url'])?$dts['url']:'';
				$array=isset($dts['field_name'])?$dts['field_name']:array();
				
				foreach($array as $vals){
					$url.=isset($val->$vals)?$val->$vals.'/':'';
				}
				if($i==0){
					$datas.="'".$attr."':'".$url."'";
				}else{
					$datas.=",'".$attr."':'".$url."'";
				}
				$i++;
			}
		}
		return 'data="{'.$datas.'}"';
	}
	
	function get_action($data,$d){
		if($this->unique_key_field!="no"){
			$id=isset($data->{$this->unique_key_field})?$data->{$this->unique_key_field}:'';
			$lang_id=isset($data->lang_id)?$data->lang_id:'';
			$pt=isset($data->product_type)?'&var='.$data->product_type:'';
			$a='<a  class="entypo-pencil" style="font-size:18px;color:#ff0000;" title="Edit" href="'.base_url().'admin?page='. $this->GetModuleName().'/'.$this->edit_file_name.'&action=edit&id='.$id. '"></a>';
			$a.='<a title="Delete" href="'.base_url().'admin?page='. $_GET['page'].'&action=delete&id='.$id.'" class="entypo-trash" style="font-size:18px;color:#ff0000;"></a>';
			return $a;
		}
	}
}
function upload($e='fileupload',$path='assets/uploader/images/',$mw='1024',$mh='768'){
	global $CI;

		$config['full_path'] = $_SERVER['SCRIPT_FILENAME'];
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'gif|jpg|png|jpeg|xml|pdf';
		$config['max_size']	= '100000';
		$config['max_width']  =$mw;
		$config['max_height']  =$mh;
		
		//$CI->upload->initialize($config);
		$CI->load->library('upload',$config);
		if (!$CI->upload->do_upload($e))
		{
			//$error =$CI->upload->display_errors();
			//print_r($error);
		}
		else
		{
		$check=$CI->upload->data();
		$file_name=$check['file_name'];
		return $file_name;
		}
		
		
		
		
	}
function truncate($text, $length = 140,$is=false) {

      if(strlen($text) > $length) {

      // $length - strlen($text) is used to find the last occurrence of a blank

      // UP TO the $length character in the string.
if($is==false){
      $text = substr($text, 0, strrpos($text,' ', $length - strlen($text) ));
}else{
	 $text = substr($text, 0, strrpos($text,' ', $length - strlen($text) )).' ... ';
}

      }

      return $text;

 }
 Class resize
		{
			// *** Class variables
			private $image;
		    private $width;
		    private $height;
			private $imageResized;

			function __construct($fileName)
			{
				// *** Open up the file
				$this->image = $this->openImage($fileName);

			    // *** Get width and height
			    $this->width  = imagesx($this->image);
			    $this->height = imagesy($this->image);
			}

			## --------------------------------------------------------

			private function openImage($file)
			{
				// *** Get extension
				$extension = strtolower(strrchr($file, '.'));

				switch($extension)
				{
					case '.jpg':
					case '.jpeg':
						$img = @imagecreatefromjpeg($file);
						break;
					case '.gif':
						$img = @imagecreatefromgif($file);
						break;
					case '.png':
						$img = @imagecreatefrompng($file);
						break;
					default:
						$img = false;
						break;
				}
				return $img;
			}

			## --------------------------------------------------------

			public function resizeImage($newWidth, $newHeight, $option="auto")
			{
				// *** Get optimal width and height - based on $option
				$optionArray = $this->getDimensions($newWidth, $newHeight, $option);

				$optimalWidth  = $optionArray['optimalWidth'];
				$optimalHeight = $optionArray['optimalHeight'];


				// *** Resample - create image canvas of x, y size
				$this->imageResized = imagecreatetruecolor($optimalWidth, $optimalHeight);
				imagecopyresampled($this->imageResized, $this->image, 0, 0, 0, 0, $optimalWidth, $optimalHeight, $this->width, $this->height);


				// *** if option is 'crop', then crop too
				if ($option == 'crop') {
					$this->crop($optimalWidth, $optimalHeight, $newWidth, $newHeight);
				}
			}

			## --------------------------------------------------------
			
			private function getDimensions($newWidth, $newHeight, $option)
			{

			   switch ($option)
				{
					case 'exact':
						$optimalWidth = $newWidth;
						$optimalHeight= $newHeight;
						break;
					case 'portrait':
						$optimalWidth = $this->getSizeByFixedHeight($newHeight);
						$optimalHeight= $newHeight;
						break;
					case 'landscape':
						$optimalWidth = $newWidth;
						$optimalHeight= $this->getSizeByFixedWidth($newWidth);
						break;
					case 'auto':
						$optionArray = $this->getSizeByAuto($newWidth, $newHeight);
						$optimalWidth = $optionArray['optimalWidth'];
						$optimalHeight = $optionArray['optimalHeight'];
						break;
					case 'crop':
						$optionArray = $this->getOptimalCrop($newWidth, $newHeight);
						$optimalWidth = $optionArray['optimalWidth'];
						$optimalHeight = $optionArray['optimalHeight'];
						break;
				}
				return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
			}

			## --------------------------------------------------------

			private function getSizeByFixedHeight($newHeight)
			{
				$ratio = $this->width / $this->height;
				$newWidth = $newHeight * $ratio;
				return $newWidth;
			}

			private function getSizeByFixedWidth($newWidth)
			{
				$ratio = $this->height / $this->width;
				$newHeight = $newWidth * $ratio;
				return $newHeight;
			}

			private function getSizeByAuto($newWidth, $newHeight)
			{
				if ($this->height < $this->width)
				// *** Image to be resized is wider (landscape)
				{
					$optimalWidth = $newWidth;
					$optimalHeight= $this->getSizeByFixedWidth($newWidth);
				}
				elseif ($this->height > $this->width)
				// *** Image to be resized is taller (portrait)
				{
					$optimalWidth = $this->getSizeByFixedHeight($newHeight);
					$optimalHeight= $newHeight;
				}
				else
				// *** Image to be resizerd is a square
				{
					if ($newHeight < $newWidth) {
						$optimalWidth = $newWidth;
						$optimalHeight= $this->getSizeByFixedWidth($newWidth);
					} else if ($newHeight > $newWidth) {
						$optimalWidth = $this->getSizeByFixedHeight($newHeight);
						$optimalHeight= $newHeight;
					} else {
						// *** Sqaure being resized to a square
						$optimalWidth = $newWidth;
						$optimalHeight= $newHeight;
					}
				}

				return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
			}

			## --------------------------------------------------------

			private function getOptimalCrop($newWidth, $newHeight)
			{

				$heightRatio = $this->height / $newHeight;
				$widthRatio  = $this->width /  $newWidth;

				if ($heightRatio < $widthRatio) {
					$optimalRatio = $heightRatio;
				} else {
					$optimalRatio = $widthRatio;
				}

				$optimalHeight = $this->height / $optimalRatio;
				$optimalWidth  = $this->width  / $optimalRatio;

				return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
			}

			## --------------------------------------------------------

			private function crop($optimalWidth, $optimalHeight, $newWidth, $newHeight)
			{
				// *** Find center - this will be used for the crop
				$cropStartX = ( $optimalWidth / 2) - ( $newWidth /2 );
				$cropStartY = ( $optimalHeight/ 2) - ( $newHeight/2 );

				$crop = $this->imageResized;
				//imagedestroy($this->imageResized);

				// *** Now crop from center to exact requested size
				$this->imageResized = imagecreatetruecolor($newWidth , $newHeight);
				imagecopyresampled($this->imageResized, $crop , 0, 0, $cropStartX, $cropStartY, $newWidth, $newHeight , $newWidth, $newHeight);
			}

			## --------------------------------------------------------

			public function saveImage($savePath, $imageQuality="100")
			{
				// *** Get extension
        		$extension = strrchr($savePath, '.');
       			$extension = strtolower($extension);

				switch($extension)
				{
					case '.jpg':
					case '.jpeg':
						if (imagetypes() & IMG_JPG) {
							imagejpeg($this->imageResized, $savePath, $imageQuality);
						}
						break;

					case '.gif':
						if (imagetypes() & IMG_GIF) {
							imagegif($this->imageResized, $savePath);
						}
						break;

					case '.png':
						// *** Scale quality from 0-100 to 0-9
						$scaleQuality = round(($imageQuality/100) * 9);

						// *** Invert quality setting as 0 is best, not 9
						$invertScaleQuality = 9 - $scaleQuality;

						if (imagetypes() & IMG_PNG) {
							 imagepng($this->imageResized, $savePath, $invertScaleQuality);
						}
						break;

					// ... etc

					default:
						// *** No extension - No save.
						break;
				}

				imagedestroy($this->imageResized);
			}


			## --------------------------------------------------------

		}

?>