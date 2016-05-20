<form class="form" method="post" action="">
	<ol class="breadcrumb 2">
		<li><a href="<?php echo base_url() ?>admin"><i class="entypo-home"></i>Home</a></li>
		<li class="active"><strong>System Modules</strong></li>
	</ol>
	
	<h1><span>System Modules</span></h1>

	<br />

	<?php echo get_status(); ?>

	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-striped datatable dataTable">
		<thead>
			<tr>
				<th align="left">Module Name</th>
				<th align="left">Module Description</th>
				<th align="left" class="display_order">Order</th>
				<th align="left" class="width-200">Activate</th>
				<th class="status" align="left">Status</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$sql=mysql_query("select* from ".$CI->db->dbprefix."system where parent_slug='0' order by display_order DESC");
			$i=0;
			while($row=mysql_fetch_array($sql)){
				$i++;
				$yes="no";
				
				if(file_exists("plugin/".$row['page_url'])){
		?>
		<tr>
			<td align="left">
				<?php echo $row['menu_text']; ?>
			</td>
			<td align="left">
				<?php echo $row['module_desc']; ?>
			</td>
			<td align="left">
				<input type="hidden" value="system|system_id|<?php echo $row['system_id']; ?>|display_order" name="display_order[]" />
				<input class="input_order form-control" type="text" value="<?php echo $row['display_order']; ?>" size="1" name="display_order_new[]" />
			</td>
			<td align="left">
				<button class="btn btn-blue btn-icon btn-sm" type="submit" value="<?php echo $row['system_id']; ?>" name="submit">
					<i class="entypo-cw"></i>
					Reactivate
				</button>
			</td>
			<td align="left">
				<input class="status" name="status" type="submit" value="system|system_id|<?php echo $row['system_id']; ?>|status" style="background-image:url(assets/admin/images/<?php echo $status=($row['status']=='Y')?'active.gif':'inactive.gif'; ?>);" />
			</td>
		</tr>
		<?php
				}
			}
		?>
		</tbody>
	</table>
	<button type="submit" style="float: right; margin-right: 0; margin-top: -6px; margin-bottom: 0;" name="update_status" value="Update Status" class="btn btn-green btn-icon icon-left">
		<i class="entypo-arrows-ccw"></i>
		Update Orders
	</button>

	<div class="clearfix"></div>
</form>

<div class="clearfix"></div>