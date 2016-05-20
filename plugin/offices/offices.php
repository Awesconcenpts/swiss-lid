<?php
if(isset($_GET['action']) && $_GET['action']=='delete'){
$id=isset($_GET['id'])?$_GET['id']:'';
$CI->moffices->offices_delete($id);	
}
?>
<ol class="breadcrumb 2">
    <li><a href="#"><i class="entypo-home"></i>Home</a></li>
    <li class="active"><strong>Offices</strong></li>
</ol>

<h1>
    <span>Offices</span> 
    <a href="?page=offices/offices-new.php" class="btn btn-orange btn-sm" type="button">Add New Office</a>
</h1>

<br />
<form action="" method="post">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-striped datatable dataTable">
		<thead>
			<tr>
				<th align="left">Office Name</th>
				<th align="left">Country / Address</th>
                <th align="left">Display Order</th>
                <th class="action" align="left">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$id='';
		if(!isset($_GET['action']) && isset($_GET['id'])){
			$id=$_GET['id'];
		}
			$list=$CI->moffices->offices_list();
			foreach($list as $values){
		?>
		<tr>
			<td align="left">
				<?php echo $values->offices_name; ?>
			</td>
			
            <td align="left">
				<?php 
				if($values->offices_address4==''){
				echo $values->offices_name.', '.$values->offices_address2.', '.$values->offices_address3.' - '.$GLOBALS['countries'][$values->offices_country];
				}else{
					echo $values->offices_name.', '.$values->offices_address3.', '.$values->offices_address4.' - '.$GLOBALS['countries'][$values->offices_country];
				}
				
				?>
			</td>
            <td align="left">
				<input type="hidden" value="offices|offices_id|<?php echo $values->offices_id; ?>|offices_order" name="display_order[]" />
				<input class="input_order form-control" type="text" value="<?php echo $values->offices_order; ?>" size="1" name="display_order_new[]" />
			</td>
            <td>
            <a  class="entypo-pencil" style="font-size:18px;color:#ff0000;" title="Edit" href="<?php echo '?page=offices/offices-new.php&action=edit&id='.$values->offices_id; ?>"></a>
			<a title="Delete" href="<?php echo '?page=offices/offices.php&action=delete&id='.$values->offices_id; ?>" class="entypo-trash" style="font-size:18px;color:#ff0000;"></a>
            </td>
		</tr>
		<?php
			
			}
		?>
		</tbody>
	</table>
    
						<div class="clearfix"></div>
    <button type="submit" style="float: right; margin-right: 0; margin-top: -10px; margin-bottom: 10;" name="update_status" value="Update Status" class="btn btn-green btn-icon icon-left">
		<i class="entypo-arrows-ccw"></i>
		Update Orders
	</button>

	<div class="clearfix"></div>
</form>

						<div class="clearfix"></div>