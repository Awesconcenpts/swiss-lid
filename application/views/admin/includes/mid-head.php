
<div class="row">
	<div class="col-md-6 col-sm-8 clearfix">
		<ul class="user-info pull-left pull-none-xsm">
			<li class="profile-info dropdown">
				<a href="<?php echo base_url() ?>admin" class="dropdown-toggle" data-toggle="dropdown">
					<img src="<?php echo base_url() ?>assets/admin/images/profiles/thumb/<?php echo $this->session->userdata('image'); ?>" alt="" class="img-circle" width="44" />
					<?php echo $this->session->userdata('user_name'); ?>
				</a>
			</li>
		</ul>
	</div>
	<div class="col-md-6 col-sm-4 clearfix hidden-xs">
		<ul class="list-inline links-list pull-right">		
			<li>
				<a href="<?php echo base_url() ?>admin?page=system/account.php" data-animate="1">
					<i class="entypo-user"></i>
					Edit Profile
					<span class="badge badge-success chat-notifications-badge is-hidden">0</span>
				</a>
			</li>
			<li class="sep"></li>
			<li>
				<a href="<?php echo base_url() ?>admin/login/logout">
					Log Out <i class="entypo-logout right"></i>
				</a>
			</li>
		</ul>
	</div>
</div>

<hr />
