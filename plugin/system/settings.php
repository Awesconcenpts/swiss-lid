<?php 
if(isset($_POST['setting'])){
	ob_start();
	define("PATH","assets/admin/images/");
	
	$temp 	= strtolower($_FILES['website_logo']['name']);
	$n 		= preg_replace("/[^a-z0-9_-s.]/i","",$temp);
	
	if(isset($n) && $n!=''){
		//unlink('images/'.$_POST['old_image']);
		//unlink('images/thumb/'.$_POST['old_image']);
		if (is_uploaded_file($_FILES['website_logo']['tmp_name'])) {
			$result = move_uploaded_file($_FILES['website_logo']['tmp_name'], PATH . $n );
			if ($result == 1){}
		} 
	} else{
		$n = $_POST['old_image'];
	}
	
	$_POST['website_logo'] = $n;
	
	foreach($_POST as $key => $val){
		$CI->db->query("update " . $CI->db->dbprefix. "website_setting set field_value='" . $val . "' where field_name='" . $key . "'");
	}
	
	set_status('success','Settings are saved.');
}
?>
<ol class="breadcrumb 2">
    <li><a href="<?php echo base_url() ?>admin"><i class="entypo-home"></i>Home</a></li>
    <li class="active"><strong>General Settings</strong></li>
</ol>

<h1><span>General Settings</span></h1>

<br/>

<?php echo get_status(); ?>

<form name="frm" action="" method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary" data-collapsed="0">
			
				<div class="panel-body">
					<div class="form-horizontal form-groups-bordered">
						<?php
						$datas=$CI->db->query("select* from " . $CI->db->dbprefix . "website_setting order by display_order")->result();
						
						foreach($datas as $val){
							if($val->field_name == 'website_logo'){
						?>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo $val->field_text; ?></label>
							<div class="col-sm-9">
								<input name="old_image" type="hidden" value="<?php echo $val->field_value; ?>" />
								<input type="file" name="<?php echo $val->field_name; ?>" class="form-control file2 inline btn btn-primary" value="" /> [180 x 84 px]
								
								<br/>
								
								<?php if($val->field_value!='' && file_exists("assets/admin/images/".$val->field_value)){ ?>
								<a style="margin: 5px 0; border: 1px solid #EFEFEF; background-color: #f0f0f0; height: 84px; width: 180px; background-position: center center; background-repeat: no-repeat; float:left; background-size: contain; background-image: url(assets/admin/images/<?php echo $val->field_value; ?>);"></a>
								
								<div class="clearfix"></div>
								
								<?php } ?>
							</div>
						</div>
						<?php
							}elseif($val->field_name == 'disclaimer'){
								?>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo $val->field_text; ?></label>
							<div class="col-sm-9">
								<textarea class="form-control" style="height:100px" name="<?php echo $val->field_name; ?>"><?php echo $val->field_value; ?></textarea>
							</div>
						</div>
						<?php
								
							}else{
						?>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo $val->field_text; ?></label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="<?php echo $val->field_name; ?>" value="<?php echo $val->field_value; ?>" />
							</div>
						</div>
						<?php
							}
						}
						?>
						<div class="form-group">
							<label class="col-sm-3 control-label"></label>
							<div class="col-sm-9">
								<button type="submit" name="setting" class="btn btn-green btn-icon icon-left">
									<i class="entypo-arrows-ccw"></i>Update Settings
								</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</form>

<div class="clearfix"></div>
