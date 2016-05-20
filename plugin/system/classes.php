<?php

$custom_fields='class-session';
	if(!isset($custom_field_prefix)){
		$custom_field_prefix='';	
	}
	$data=array();
if(isset($updated_id) && $updated_id!=''){
	
	if(isset($_POST['classes_name'])){
		foreach($_POST['classes_name'] as $key=>$val){
			$data[]=array('classes_name'=>$_POST['classes_name'][$key],'classes_price'=>$_POST['classes_price'][$key]);
			
		}
	}
	update_option($updated_id.'-'.$custom_field_prefix,$custom_fields,json_encode($data));
}

?>
<div class="form-group" id="div-classes">
							<label class="col-sm-3 control-label">Provide Session</label>
							<div class="col-sm-9">
                            	<div  id="classes_parents">
									<?php
                                    if(isset($id) && $id!=''){
										$cstm=get_option($id.'-'.$custom_field_prefix,$custom_fields);
										$cmtm=json_decode($cstm,true);
										$cmtm=is_array($cmtm)?$cmtm:array();
                                        foreach($cmtm as $key=>$val){
											
                                    ?>
                                	<div class="group">
                                        <div class="col-sm-6 nopadding-left">
                                        <input type="text" class="form-control custom_field_name" name="classes_name[]"  data-validate="required" value="<?php echo $val['classes_name']; ?>" placeholder="Session" />
                                        </div>
                                        <div class="col-sm-6 nopadding-right">
                                        <input type="text" class="form-control custom_field_value" name="classes_price[]"  value="<?php echo $val['classes_price']; ?>" placeholder="Price" style="width:89%; margin:0px; float:left;" />
                                        <button type="button"  value="Add Custom Field"	name="classes" 	class="entypo-trash btn btn-green btn-xs" style="font-size:16px; float:right; color:#FFF; font-weight:bold;"></button>
                                        </div>
                                       
                                        <div class="clearfix" style="margin-bottom:10px;"></div>
                                    </div>
                                    <?php
										}
									}
									?>
                                </div>
                                <div class="clearfix"></div>
                                <button type="button"  name="class" id="add_classes" class="entypo-list-add btn btn-green btn-xs" style="font-size:14px; color:#FFF; font-weight:bold;"><span style="font-size:11px;">Add New Session</span></button>
                                <div class="clearfix"></div>
                                    <p class="text-info">Please provide details for session for this class.<br><font color="#FF0000"><b>Note :</b> if you left empty value for any session, then session field will not be save.</font></p>
                                     <div class="clearfix"></div>
                           
							</div>
						</div>
<?php

?>
<script type="text/javascript">
$(document).ready(function(e) {
	$("#add_classes").click(function(e) {
		var ste='<div class="group">'+
		'<div class="col-sm-6 nopadding-left">'+
                                    '<input type="text" class="form-control custom_field_name" name="classes_name[]" data-message-required="Session Name is Required." data-validate="required"  data-validate="required" value="" placeholder="Session" />'+
                                    '</div>'+
                                    '<div class="col-sm-6 nopadding-right">'+
                                    '<input type="text" class="form-control custom_field_value"  data-message-required="Price is Required." data-validate="required"  name="classes_price[]"  value="" placeholder="Price" style="width:89%; margin:0px; float:left;" />'+
									'<button type="button"  value="Price"	name="custom" 	class="entypo-trash btn btn-green btn-xs" style="font-size:16px; float:right; color:#FFF; font-weight:bold;"></button>'+
                                    '</div><div class="clearfix" style="margin-bottom:10px;"></div></div>';
                                   
		
		$('#classes_parents').append(ste);
        
    });
	//$("body").on('click','.entypo-trash',function(){
	//$(this).closest('div.group').remove();
	//});
});
</script>