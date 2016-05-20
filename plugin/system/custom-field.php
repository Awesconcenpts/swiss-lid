<?php

$custom_fields='custom_fields';
	if(!isset($custom_field_prefix)){
		$custom_field_prefix='';	
	}
	$data=array();
if(isset($updated_id) && $updated_id!=''){
	
	if(isset($_POST['custom_field_name'])){
		foreach($_POST['custom_field_name'] as $key=>$val){
			$data[]=array('custom_field_key'=>$_POST['custom_field_key'][$key],'custom_field_name'=>$_POST['custom_field_name'][$key],'custom_field_value'=>$_POST['custom_field_value'][$key]);
			
		}
	}
	update_option($updated_id.'-'.$custom_field_prefix,$custom_fields,json_encode($data));
}

?>
<div class="form-group">
							<label class="col-sm-3 control-label">Custom Fields</label>
							<div class="col-sm-9">
                            	<div  id="custom_field_parents">
									<?php
                                    if(isset($id) && $id!=''){
										$cstm=get_option($id.'-'.$custom_field_prefix,$custom_fields);
										$cmtm=json_decode($cstm,true);
										$cmtm=is_array($cmtm)?$cmtm:array();
                                        foreach($cmtm as $key=>$val){
											
                                    ?>
                                	<div class="group">
                                        <div class="col-sm-4 nopadding-left">
                                        <input type="text" class="form-control custom_field_name" name="custom_field_name[]"  data-validate="required" value="<?php echo $val['custom_field_name']; ?>" placeholder="Custom Field Name" />
                                        </div>
                                        <div class="col-sm-4">
                                        <input type="text" class="form-control custom_field_value" name="custom_field_value[]"  value="<?php echo $val['custom_field_value']; ?>" placeholder="Custom Field Value" />
                                        </div>
                                        <div class="col-sm-4 nopadding-right">
                                        <input type="text" class="form-control custom_field_key" value="<?php echo $val['custom_field_key']; ?>" name="custom_field_key[]" style="width:83%; margin:0px; float:left;" readonly  />
                                        <button type="button"  value="Add Custom Field"	name="custom" 	class="entypo-trash btn btn-green btn-xs" style="font-size:16px; float:right; color:#FFF; font-weight:bold;"></button>
                                        </div>
                                        <div class="clearfix" style="margin-bottom:10px;"></div>
                                    </div>
                                    <?php
										}
									}
									?>
                                </div>
                                <div class="clearfix"></div>
                                <button type="button"  name="custom" id="custom_add" class="entypo-list-add btn btn-green btn-xs" style="font-size:14px; color:#FFF; font-weight:bold;"><span style="font-size:11px;">Add New Field</span></button>
                                <div class="clearfix"></div>
                                    <p class="text-info">Please provide details for custom fields for this content.<br><font color="#FF0000"><b>Note :</b> if you left empty value for any custom fields, then custom field will not be save.</font></p>
                                     <div class="clearfix"></div>
                           
							</div>
						</div>
<?php

?>
<script type="text/javascript">
$(document).ready(function(e) {
    custom_field_parents
	$("#custom_add").click(function(e) {
		var ste='<div class="group">'+
		'<div class="col-sm-4 nopadding-left">'+
                                    '<input type="text" class="form-control custom_field_name" name="custom_field_name[]" data-message-required="Custom field Name is Required." data-validate="required"  data-validate="required" value="" placeholder="Custom Field Name" />'+
                                    '</div>'+
                                    '<div class="col-sm-4">'+
                                    '<input type="text" class="form-control custom_field_value"  data-message-required="Custom field value is Required." data-validate="required"  name="custom_field_value[]"  value="" placeholder="Custom Field Value" />'+
                                    '</div>'+
                                    '<div class="col-sm-4 nopadding-right">'+
                                    '<input type="text" class="form-control custom_field_key" name="custom_field_key[]" style="width:83%; margin:0px; float:left;" readonly  />'+
                                    '<button type="button"  value="Add Custom Field"	name="custom" 	class="entypo-trash btn btn-green btn-xs" style="font-size:16px; float:right; color:#FFF; font-weight:bold;"></button>'+
                                    '</div>'+
                                    '<div class="clearfix" style="margin-bottom:10px;"></div></div>';
		
		$('#custom_field_parents').append(ste);
        
    });
	$("body").on('click','.entypo-trash',function(){
		$(this).closest('div.group').remove();
	});
	$("body").on('keyup','.custom_field_name',function(){
		var str=$(this).val();
		str=str.replace(/[^a-z0-9]/gi,'-');
		str="cstm-"+str;
		$(this).closest('div.group').find('input.custom_field_key').val(str.toLowerCase());

	});
});
</script>