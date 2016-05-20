<?php

$custom_fields='timetable';
	if(!isset($custom_field_prefix)){
		$custom_field_prefix='';	
	}
	$data=array();
if(isset($updated_id) && $updated_id!=''){
	
	if(isset($_POST['timetable_day'])){
		foreach($_POST['timetable_day'] as $key=>$val){
			$data[]=array('timetable_day'=>$_POST['timetable_day'][$key],'timetable_time'=>$_POST['timetable_time'][$key]);
			
		}
	}
	update_option($updated_id.'-'.$custom_field_prefix,$custom_fields,json_encode($data));
}

?>
<div class="form-group" id="div-timetable">
							<label class="col-sm-3 control-label">Provide Timetable</label>
							<div class="col-sm-9">
                            	<div  id="timetable_parents">
									<?php
                                    if(isset($id) && $id!=''){
										$cstm=get_option($id.'-'.$custom_field_prefix,$custom_fields);
										$cmtm=json_decode($cstm,true);
										$cmtm=is_array($cmtm)?$cmtm:array();
                                        foreach($cmtm as $key=>$val){
											
                                    ?>
                                	<div class="group">
                                        <div class="col-sm-6 nopadding-left">
                                        <select class="form-control custom_field_name" name="timetable_day[]" data-message-required="Day is required." data-validate="required" >
                                            <option <?php echo ($val['timetable_day']=='Sunday')?'selected="selected"':''; ?> value="Sunday">Sunday</option>
                                            <option <?php echo ($val['timetable_day']=='Monday')?'selected="selected"':''; ?> value="Monday">Monday</option>
                                            <option <?php echo ($val['timetable_day']=='Tuesday')?'selected="selected"':''; ?> value="Tuesday">Tuesday</option>
                                            <option <?php echo ($val['timetable_day']=='Wednesday')?'selected="selected"':''; ?> value="Wednesday">Wednesday</option>
                                            <option <?php echo ($val['timetable_day']=='Thursday')?'selected="selected"':''; ?> value="Thursday">Thursday</option>
                                            <option <?php echo ($val['timetable_day']=='Friday')?'selected="selected"':''; ?> value="Friday">Friday</option>
                                            <option <?php echo ($val['timetable_day']=='Saturday')?'selected="selected"':''; ?> value="Saturday">Saturday</option>
                                        </select>
                                        </div>
                                        <div class="col-sm-6 nopadding-right">
                                        <input type="text" class="form-control custom_field_value" name="timetable_time[]"  value="<?php echo $val['timetable_time']; ?>" placeholder="Time is Required, Format should be : 1AM - 2PM" style="width:89%; margin:0px; float:left;" />
                                        <button type="button"  value="Add Custom Field"	name="timetable" 	class="entypo-trash btn btn-green btn-xs" style="font-size:16px; float:right; color:#FFF; font-weight:bold;"></button>
                                        </div>
                                       
                                        <div class="clearfix" style="margin-bottom:10px;"></div>
                                    </div>
                                    <?php
										}
									}
									?>
                                </div>
                                <div class="clearfix"></div>
                                <button type="button"  name="class" id="add_timetable" class="entypo-list-add btn btn-green btn-xs" style="font-size:14px; color:#FFF; font-weight:bold;"><span style="font-size:11px;">Add New Timetable</span></button>
                                <div class="clearfix"></div>
                                    <p class="text-info">Please provide timetable for this class.<br><font color="#FF0000"><b>Note :</b> if you left empty value for any timetable, then timetable field will not be save.</font></p>
                                     <div class="clearfix"></div>
                           
							</div>
						</div>
<?php

?>
<script type="text/javascript">
$(document).ready(function(e) {
    custom_field_parents
	$("#add_timetable").click(function(e) {
		var ste='<div class="group">'+
		'<div class="col-sm-6 nopadding-left">'+
                                    '<select class="form-control custom_field_name" name="timetable_day[]" data-message-required="Day is required." data-validate="required"  data-validate="required"><option value="Sunday">Sunday</option><option value="Monday">Monday</option><option value="Tuesday">Tuesday</option><option value="Wednesday">Wednesday</option><option value="Thursday">Thursday</option><option value="Friday">Friday</option><option value="Saturday">Saturday</option></select>'+
                                    '</div>'+
                                    '<div class="col-sm-6 nopadding-right">'+
                                    '<input type="text" class="form-control custom_field_value"  data-message-required="Time is Required, Format should be : 1AM - 2PM." data-validate="required"  name="timetable_time[]"  value="" placeholder="Time is Required, Format should be : 1AM - 2PM" style="width:89%; margin:0px; float:left;" />'+
									'<button type="button"  value="Time"	name="custom" 	class="entypo-trash btn btn-green btn-xs" style="font-size:16px; float:right; color:#FFF; font-weight:bold;"></button>'+
                                    '</div><div class="clearfix" style="margin-bottom:10px;"></div></div>';
                                   
		
		$('#timetable_parents').append(ste);
        
    });
	//$("body").on('click','.entypo-trash',function(){
	//$(this).closest('div.group').remove();
	//});
});
</script>