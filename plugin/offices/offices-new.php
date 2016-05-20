
<?php


$offices_name='';
$offices_desc='';
$offices_address1='';

$offices_address2='';
$offices_address3='';
$offices_address4='';
$offices_mobile='';
$offices_country='';
$offices_phone='';
$offices_url='www.swiss-led.com';
$offices_disclaimer='';
$id=isset($_GET['id'])?$_GET['id']:'0';
if(isset($_POST['offices_name'])){
	$gal_id=$CI->moffices->offices_update($id);
	header('location:?page=offices/offices-new.php&action=edit&id='.$gal_id);exit;
}

$data=$CI->moffices->offices_get($id);
	if(isset($data[0])){
		$offices_name=$data[0]->offices_name;
		$offices_desc=$data[0]->offices_desc;
		$offices_address1=$data[0]->offices_address1;
		
		$offices_address2=$data[0]->offices_address2;
		$offices_address3=$data[0]->offices_address3;
		$offices_address4=$data[0]->offices_address4;
		
		$offices_country=$data[0]->offices_country;
		$offices_phone=$data[0]->offices_phone;
		$offices_mobile=$data[0]->offices_mobile;
		$offices_url=$data[0]->offices_url;
		$offices_disclaimer=$data[0]->offices_disclaimer;
	}
?>

<form action="" method="post" role="form" id="form1" class="form validate">
	<ol class="breadcrumb 2">
		<li><a href="#"><i class="entypo-home"></i>Home</a></li>
		<li class="active"><strong>Offices</strong></li>
	</ol>
	
	<h1>
		<span>Offices</span>
		<a href="?page=offices/offices.php" class="btn btn-orange btn-sm">Back to List</a>
	</h1>
	
	<br/>
	
	
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary" data-collapsed="0">
			
				<div class="panel-heading">
					<div class="panel-title">
						Details of regional Offices
					</div>
				</div>
				
				<div class="panel-body">
					<div class="form-horizontal form-groups-bordered">
			
						<div class="form-group">
							<label class="col-sm-3 control-label">Office Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="offices_name" value="<?php echo $offices_name; ?>" id="gallery_name" data-message-required="Office Name is required." data-validate="required"  />
							</div>
						</div>
                        <div class="form-group">
							<label class="col-sm-3 control-label">Office Address 1</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="offices_address1" value="<?php echo $offices_address1; ?>" id="offices_address1" data-message-required="Office address 1 is required." data-validate="required"  />
							</div>
						</div>
                        <div class="form-group">
							<label class="col-sm-3 control-label">Office Address 2</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="offices_address2" value="<?php echo $offices_address2; ?>" id="offices_address1" data-message-required="Address 2 is required." data-validate="required"  />
							</div>
						</div>
                        <div class="form-group">
							<label class="col-sm-3 control-label">Office Address 3</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="offices_address3" value="<?php echo $offices_address3; ?>" id="offices_address3" />
							</div>
						</div>
                        <div class="form-group">
							<label class="col-sm-3 control-label">Office Address 4</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="offices_address4" value="<?php echo $offices_address4; ?>" id="offices_address4"  />
							</div>
						</div>
                        <div class="form-group">
							<label class="col-sm-3 control-label">Office Phone</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="offices_phone" value="<?php echo $offices_phone; ?>" id="offices_phone" data-message-required="Office Phone is required." data-validate="required"  />
							</div>
						</div>
                        <div class="form-group">
							<label class="col-sm-3 control-label">Office Mobile</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="offices_mobile" value="<?php echo $offices_mobile; ?>" id="offices_mobile"  />
							</div>
						</div>
                        <div class="form-group">
							<label class="col-sm-3 control-label">Office URL</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="offices_url" value="<?php echo $offices_url; ?>" id="gallery_name" data-message-required="Office URL is required." data-validate="required"  />
							</div>
						</div>
                        <div class="form-group">
							<label class="col-sm-3 control-label">Office Desc</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="offices_desc" id="offices_desc" ><?php echo $offices_desc; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Disclaimer</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="offices_disclaimer" id="offices_disclaimer" ><?php echo $offices_disclaimer; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Office Descriptor</label>
							<div class="col-sm-9">
                            
								<select class="form-control" name="offices_country">
                                <?php foreach($GLOBALS['countries'] as $key=>$val){ ?>
                                	<option <?php echo ($offices_country==$key)?'selected="selected"':''; ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                <?php } ?>
                                </select>
                                <div class="clearfix"></div>
							</div>
						</div>
						
						<div class="clearfix"></div>
						
						
						</div>
						<div class="clearfix"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label"></label>
							<div class="col-sm-9">
                            <div class="clearfix"></div>
								<button class="btn btn-blue" type="submit" name="save" style="margin-top:10px;">
									<?php if(isset($_GET['id']) && isset($_GET['action']) && $_GET['action']=='edit'){ ?>
										Update Office
									<?php }else{ ?>
										Save Office
									<?php } ?>
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

<style type="text/css">
span.validate-has-error {
	color: #f00 !important;
	}
</style>