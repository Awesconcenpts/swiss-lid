<div class="sidebar-menu">
	<header class="logo-env">
		<div class="logo">
			<a href="index.html">
				<img width="60" alt="" src="<?php echo base_url() ?>assets/admin/images/<?php echo get_settings('website_logo','default-logo.png'); ?>" />
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
		<li id="search" class="root-level">
			<form action="" method="get">
				<input type="text" placeholder="Search something..." class="search-input" name="q" />
				<button type="submit">
					<i class="entypo-search"></i>
				</button>
			</form>
		</li>
		<!--<li class="<?php echo (!isset($_GET['page']))?' active ':''; ?> root-level">
			<a href="<?php echo base_url() ?>admin">
				<i class="entypo-gauge"></i>
				<span>Dashboard</span>
			</a>
		</li>
		-->
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
		<!-- 
		<li class="root-level <?php echo (GetTableName($current)=='system')?' active has-sub opened ' : ''; ?>">
			<a href="#">
				<i class="entypo-cog"></i>
				<span>Settings</span>
			</a>
			<ul>
            
				<li <?php echo ($current=='system/modules.php')?' class="active" ' : ''; ?>>
					<a href="<?php echo base_url(); ?>admin?page=system/modules.php">
						<i class="entypo-monitor"></i>
						<span>System Modules</span>
					</a>
				</li>
				<li <?php echo ($current=='system/settings.php')?' class="active" ' : ''; ?>>
					<a href="<?php echo base_url(); ?>admin?page=system/settings.php">
						<i class="entypo-cog"></i>
						<span>General Settings</span>
					</a>
				</li>
				
			</ul>
		</li>-->
        
	</ul>
    <div style="width:80%; height:auto; padding:5px; margin:10%;">
    <?php
	$trns=0;
	$c=0;
	$before=0;
	$after=0;
	$beforeafter=0;
	$list=$this->muser->user_list('SPONSOR');
			foreach($list as $values){
				$data=get_option($values->user_id,'user_data');
				$data=json_decode($data);
				if(strtolower($data->will_you_required_transportation_from_isb_to_lower_topa)=='yes'){
					$trns=$trns+($data->total_number_of_people_attending_from_your_family);
				}
				if(strtolower($data->will_you_required_c_130_pick_and_drop_from_karachi)=='yes'){
					$c=$c+($data->total_number_of_people_attending_from_your_family);
				}
				if(strtolower($data->will_you_require_accommodations_at_islamabad_before_or_after_the_reunion)==strtolower('YES (BEFORE)')){
					$before=$before+($data->total_number_of_people_attending_from_your_family);
				}
				if(strtolower($data->will_you_require_accommodations_at_islamabad_before_or_after_the_reunion)==strtolower('YES (AFTER)')){
					$after=$after+($data->total_number_of_people_attending_from_your_family);
				}
				if(strtolower($data->will_you_require_accommodations_at_islamabad_before_or_after_the_reunion)==strtolower('YES (BEFORE AND AFTER)')){
					$beforeafter=$beforeafter+($data->total_number_of_people_attending_from_your_family);
				}
				
				
				
				
			}
			
	?>
    <style type="text/css">
	.tbls td,.tbls th{
		padding:5px;

	}
	</style>
    <table class="tbls" style="width:100%; border:1px solid #FFF;" cellpadding="5" cellpadding="5">
        <tr>
            <td>Transport to Lower Topa : </td>
            <td><?php echo $trns; ?></td>
        </tr>
        <tr  style="border-top:2px solid #FFF;">
            <td>C130 Pick & Drop :</td>
            <td><?php echo $c; ?></td>
        </tr>
        <tr style="border-top:2px solid #FFF;">
            <td colspan="2"><strong>Accommodation in ISB</strong></td>
        </tr>
        <tr>
            <td>Before :</td>
            <td><?php echo $before; ?> </td>
        </tr>
        <tr>
            <td>After :</td>
            <td><?php echo $after; ?></td>
        </tr>
        <tr>
            <td>Before and After :</td>
            <td><?php echo $beforeafter; ?></td>
        </tr>
    </table>
    
    </div>
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