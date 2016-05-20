<?php
define('prefix','sys_');
	$sql=mysql_query("select* from ".prefix."system where parent_slug='0'");
	
	while($row=mysql_fetch_array($sql)){
		if(file_exists("../plugin/".$row['page_url'])){
			$yes="yes";
		}else{
			mysql_query("delete from ".prefix."system where page_slug='".$row['page_slug']."'");
			mysql_query("delete from ".prefix."system where parent_slug='".$row['page_slug']."'");
		}
	}
	
	$page='';
	$page_title=get_settings('site_name').' - Admin Control';
	
	if(isset($_GET['page'])){
		$page=$_GET['page'];
	}
	
	$title=mysql_query("select* from ".prefix."system where page_url='".$page."'");
	
	if(mysql_num_rows($title)>0){
		while($row=mysql_fetch_array($title)){
			$page_title=$row['page_title'] . ' - '.get_settings('site_name'); break;
		}
	}
	
	if(isset($_POST['submit']) && $_POST['submit']!=''){
		$sql=mysql_query("select* from ".prefix."system where system_id='".$_POST['submit']."'");
		
		while($row=mysql_fetch_array($sql)){
			mysql_query("delete from ".prefix."system where page_slug='".$row['page_slug']."'"); 
			mysql_query("delete from ".prefix."system where parent_slug='".$row['page_slug']."'");
			set_status('success','Successfully re-activated system modules.');
		}
	}

	function add_method($function){
		$function();
	}
	
	function add_menu_page($page_title, $menu_text, $page_url, $page_slug, $display_order, $icon_url,$desc=''){
		$data=mysql_query("select* from ".prefix."system where page_slug='$page_slug'");
		
		if(mysql_num_rows($data)>0){ }else{
			$mysql_query="insert into ".prefix."system set page_title='$page_title', menu_text='$menu_text', page_url='$page_url', page_slug='$page_slug', icon_url='$icon_url', module_desc='".$desc."', display_order='$display_order', status='Y' ,parent_slug='0'";
			//echo $mysql_query."<br/>";
			
			if(!mysql_query($mysql_query)){
				die("Error while installing modules". mysql_error()."<br/> on :".$menu_text );
			}
		}
	}
	
	function add_submenu_page( $parent_slug, $page_title, $menu_text, $page_url, $page_slug, $display_order,$icon_url='entypo-right-open' ){
		$data=mysql_query("select* from ".prefix."system where page_slug='$page_slug'");
		
		if(mysql_num_rows($data)>0){}else{
			$mysql_query="insert into ".prefix."system set page_title='$page_title', menu_text='$menu_text', page_url='$page_url', page_slug='$page_slug', parent_slug='$parent_slug', display_order='$display_order', icon_url='$icon_url'";
			
			if(!mysql_query($mysql_query)){
				die("Error while installing modules". mysql_error()."<br/> on :".$menu_text);
			}
		}
	}
	
	foreach(get_plugins() as $val){
		include($val[1]);
	}
	
	$sql=mysql_query("select* from ".prefix."system where parent_slug='0'");
	$i=0;
	
	while($row=mysql_fetch_array($sql)){
		$i++;
		$yes="no";
		
		if(file_exists("plugin/".$row['page_url'])){
			$yes="yes";
		}else{
			mysql_query("delete from ".prefix."system where page_slug='".$row['page_slug']."'"); 
			mysql_query("delete from ".prefix."system where parent_slug='".$row['page_slug']."'");  
		}
	}
?>

<?php include("includes/header.php"); ?>

<div class="page-container">
	<?php include 'includes/sidebar.php'; ?>
	
	<div class="main-content">
		<?php include("includes/mid-head.php"); ?>
		
		<?php echo $content; ?>
		
		<div class="clearfix"></div>
		
		<br />
		
		<!-- Footer -->
		<?php include("includes/footer.php"); ?>
	</div>
	
	<?php include("includes/foot.php"); ?>
</div>