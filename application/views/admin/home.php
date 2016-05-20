<?php
global $CI;
$CI =& get_instance();
?>


<div class="row">
	<div class="col-sm-12">
		<ul class="ul_forms cap">
			<li class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<h2 class="home" style="text-transform:capitalize;">Welcome <?php echo $CI->session->userdata('user_name'); ?></h2>
			</li>
			
			<li class="col-lg-2 col-sm-2 col-md-2 col-xs-2"><strong>Name</strong></li>
			<li class="col-lg-10 col-sm-10 col-md-10 col-xs-10"><span><?php echo $CI->session->userdata('user_name'); ?></span></li>
			<li class="col-lg-2 col-sm-2 col-md-2 col-xs-2"><strong>Email</strong></li>
			<li class="col-lg-10 col-sm-10 col-md-10 col-xs-10"><span><?php echo $CI->session->userdata('email'); ?></span><li>
			<li class="col-lg-2 col-sm-2 col-md-2 col-xs-2"><strong>User Type</strong></li>
			<li class="col-lg-10 col-sm-10 col-md-10 col-xs-10"><span><?php echo ($CI->session->userdata('user_type')=="0")?'Site Administrators':'Registered User'; ?></span></li>
			<li class="col-lg-2 col-sm-2 col-md-2 col-xs-2"><strong>Last log In</strong></li>
			<li class="col-lg-10 col-sm-10 col-md-10 col-xs-10"><span><?php echo ($CI->session->userdata('last_login')=="")?'This is your first login':date("D, d M Y", strtotime($CI->session->userdata('last_login'))); ?></span></li>
			<li class="col-lg-2 col-sm-2 col-md-2 col-xs-2"><strong>Phone</strong></li>
			<li class="col-lg-10 col-sm-10 col-md-10 col-xs-10"><span><?php echo $CI->session->userdata('phone'); ?></span><li>
			<li class="col-lg-2 col-sm-2 col-md-2 col-xs-2"><strong>Address</strong></li><li class="col-lg-10 col-sm-10 col-md-10 col-xs-10"><span><?php echo $CI->session->userdata('address'); ?></span><li>
		</ul>
	</div>
</div>

<br />

<div class="clearfix"></div>
