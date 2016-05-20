<?php
$message="";
if(isset($_POST['first_name'])){
	$pwd="";
	$existing=$CI->db->query("select * from ".$CI->db->dbprefix."user where (user_name ='".$_POST['user_name']."' OR email='".$_POST['email']."') and user_id!='".$CI->session->userdata('user_id')."'")->result();
	
	//if(sizeof($existing)==0){
		if(($_POST['password']==$_POST['re_password'])){
			if($_POST['password']=='' && $_POST['re_password']==''){
				$pwd=$_POST['old_password'];
			}else{
				$pwd=md5($_POST['re_password']);
			}
			define("PATH","assets/admin/images/profiles/");
			$n=$CI->session->userdata('image');
			
			if(isset($_FILES['uploadfile']) && ($_FILES['uploadfile']['name'])!=''){
				$temp 	= strtolower($_FILES['uploadfile']['name']);
				$n 		= preg_replace("/[^a-z0-9_-s.]/i","",$temp);
				$result = move_uploaded_file($_FILES['uploadfile']['tmp_name'], PATH.$n );
				
				if ($result == 1){
					$resizeObj = new resize(PATH.$n);
					$resizeObj -> resizeImage(48, 48, 'crop');
					$resizeObj -> saveImage(PATH.'thumb/'.$n, 100);
				}
			}
			$data=$CI->db->query("update ".$CI->db->dbprefix."user set first_name='$_POST[first_name]',user_name='$_POST[user_name]', 
				last_name='$_POST[last_name]', address='$_POST[address]', password='".$pwd."',phone='$_POST[phone]', email='$_POST[email]' where user_id='".$CI->session->userdata('user_id')."'");
				$CI->session->set_userdata('user_name', $_POST['first_name'].' '.$_POST['last_name']);
				$CI->session->set_userdata('email',$_POST['email']);
				$CI->session->set_userdata('phone',$_POST['phone']);
				$CI->session->set_userdata('address',$_POST['address']);
				$CI->session->set_userdata('image',$n);
				set_status('success',' Your account was successfully updated.');
			
		}else{
			set_status('notice','Password doesn\'t match.');
		}
	}else{
		set_status('notice','The username and/or email address is already in use.');
	}
//}
$set=$CI->db->query("select* from ".$CI->db->dbprefix."user where user_id='".$CI->session->userdata('user_id') . "'")->result();

$first_name	= "";
$last_name	= "";
$password	= "";
$email		= "";
$address	= "";
$phone		= "";
$image		= "";
$user_name  = "";

if(is_array($set) && isset($set[0])){
	$first_name	= $set[0]->first_name;
	$last_name	= $set[0]->last_name;
	$password	= $set[0]->password;
	$email		= $set[0]->email;
	$address	= $set[0]->address;
	$phone		= $set[0]->phone;
	$image		= $set[0]->image;
	$user_name  = $set[0]->user_name;
}
?>
<form action="" class="form" method="post" enctype="multipart/form-data">
	<ol class="breadcrumb 2">
		<li><a href="<?php echo base_url() ?>admin"><i class="entypo-home"></i>Home</a></li>
		<li class="active"><strong>Account Details</strong></li>
	</ol>
	
	<h1><span>User Account Information</span></h1>
	
	<br/>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary" data-collapsed="0">
			
				<div class="panel-body">
					<div class="form-horizontal form-groups-bordered">
			
						<div class="form-group">
							<label class="col-lg-3 control-label">First Name</label>
							<div class="col-lg-9">
								<input type="text" 
									name="first_name" 
									class="form-control" 
									value="<?php echo $first_name; ?>" 
									id="first_name" />
							</div>
						</div>
				
						<div class="form-group">
							<label class="col-lg-3 control-label">Last Name</label>
							<div class="col-lg-9">
								<input type="text" 
									name="last_name" 
									class="form-control" 
									value="<?php echo $last_name; ?>" 
									id="last_name" />
							</div>
						</div>
						
						<div class="form-group" style="display:none;">
							<label class="col-lg-3 control-label">Username</label>
							<div class="col-lg-9">
								<input type="text" 
									name="user_name" 
									class="form-control" 
									value="<?php echo $user_name; ?>" 
									id="user_name" 
									readonly />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-3 control-label">Email Address</label>
							<div class="col-lg-9">
								<input type="text" 
									autocomplete="off" 
									class="form-control" 
									name="email" 
									value="<?php echo $email; ?>" 
									id="email" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-3 control-label">Account Password</label>
							<div class="col-lg-9">
								<input type="password" 
									class="form-control" 
									autocomplete="off" 
									name="password" 
									id="password" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-3 control-label">Password Confirmation</label>
							<div class="col-lg-9">
								<input type="password" class="form-control" name="re_password" id="re_password" />
								<input type="hidden" value="<?php echo $password; ?>" name="old_password" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-3 control-label">Phone Number</label>
							<div class="col-lg-9">
								<input type="text" 
									class="form-control" 
									name="phone" 
									value="<?php echo $phone; ?>" 
									id="phone" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-3 control-label">Address</label>
							<div class="col-lg-9">
								<textarea class="form-control" name="address"><?php echo $address; ?></textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-3 control-label">Profile Image</label>
							<div class="col-lg-9">
								<input type="file" 
									name="uploadfile" 
									class="form-control file2 inline btn btn-primary" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-3 control-label"></label>
							<div class="col-lg-9">
								<button class="btn btn-blue" type="submit" name="user">Update Information</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
    </div>
</form>

<div class="clearfix"></div>
