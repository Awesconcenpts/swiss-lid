<div class="sidebar-menu">
	<header class="logo-env">
		<div class="logo">
			<a href="#" style="font-size:25px;"><?php echo get_settings('site_name'); ?><br/><span style="font-size:10px; float:left; width:100%;"><?php echo get_settings('site_slug'); ?></span>
				<!--<img width="40" alt="" src="<?php echo base_url() ?>assets/admin/images/<?php echo get_settings('website_logo','default-logo.png'); ?>" />-->
			</a>
		</div>
		
		<div class="sidebar-collapse">
			<a class="sidebar-collapse-icon with-animation" href="#">
				<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
				<i class="entypo-menu"></i>
			</a>
		</div>
			
		<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
		<div class="sidebar-mobile-menu visible-xs">
			<a class="with-animation" href="#">
				<!-- add class "with-animation" to support animation -->
				<i class="entypo-menu"></i>
			</a>
		</div>
	</header>
		
	<ul class="" id="main-menu" style="">
		
		<li class="<?php echo (!isset($_GET['page']))?' active ':''; ?> root-level">
			<a href="<?php echo base_url() ?>admin">
				<i class="entypo-gauge"></i>
				<span>Dashboard</span>
			</a>
		</li>
		
		<!-- start new -->
		<?php
            $current=isset($_GET['page'])?$_GET['page']:'';
			$qryer=mysql_query("select* from ".prefix."user_setting where user_id='".$this->session->userdata('user_id')."'");
			$array=array();
			
			while($rowes=mysql_fetch_array($qryer)){
				$array[]=$rowes['system_id'];
			}
			$qry=mysql_query("select* from ".prefix."system where status='Y' and parent_slug='0' order by display_order ASC");
			while($row=mysql_fetch_array($qry)){
				$yes="";
				if(is_array($array) && (in_array($row['system_id'],$array))){ $yes="yes"; }else{ $yes="no"; }
				//if($this->session->userdata('user_type')=="0" || $this->session->userdata('user_type')=="1"){
					$yes="yes";
				//}
				if($yes=="yes"){
					$slg=mysql_query("select* from ".prefix."system where parent_slug='".$row['page_slug']."' order by display_order ASC");
		?>
		<li class="root-level <?php echo (GetTableName($row['page_url'])==GetTableName($current))?'active ':''; echo ((mysql_num_rows($slg)>0) && (GetTableName($row['page_url'])==GetTableName($current)))?' has-sub opened':''; ?>">
			<a href="<?php echo base_url(); ?>admin?page=<?php echo $row['page_url']; ?>">
				<i class="<?php echo $row['icon_url']; ?>"></i>
				<span><?php echo $row['menu_text']; ?></span>
			</a>
			<?php if(mysql_num_rows($slg)>0){ ?>
			<ul>
				<?php while($slb = mysql_fetch_array($slg)){ ?>
					<li class="<?php echo ($slb['page_url']==$current)?'active':''; ?>">
						<a href="<?php echo base_url(); ?>admin?page=<?php echo $slb['page_url']; ?>">
							<i class="<?php echo $slb['icon_url']; ?>"></i>
							<?php echo $slb['menu_text']; ?>
						</a>
					</li>
				<?php } ?>
			</ul>
			<?php } ?>
		</li>
		<?php
				}
			}
		?>
		<!-- end new -->
		<li class="root-level <?php echo (GetTableName($current)=='system')?' active opened ' : ''; ?>">
			<a href="<?php echo base_url(); ?>admin?page=system/settings.php">
				<i class="entypo-cog"></i>
				<span>Settings</span>
			</a>
			
		</li>
	</ul>
</div>

<?php
function GetTableName($e){
	if($e!=''){
		$module=explode('/',$e);
		if(isset($module[0])){
			return $module[0];
		}
	}
}
?>