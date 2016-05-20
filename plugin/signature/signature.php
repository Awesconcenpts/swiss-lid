<?php
if(isset($_POST['contents']) && $_POST['contents']!=''){
	//$contents = mb_convert_encoding($_POST['contents'], 'HTML-ENTITIES', "UTF-8");
	//$export = mb_convert_encoding($_POST['export'], 'HTML-ENTITIES', "UTF-8");
	//file_put_contents('plugin/signature/templates/es_'.$_POST['tmpl'].'.html', $contents);
	//file_put_contents('plugin/signature/templates/es_'.$_POST['tmpl'].'_export.html', $export);
}
?>

<form action="" method="post" role="form" id="form1" class="form validate">
	<ol class="breadcrumb 2">
		<li><a href="#"><i class="entypo-home"></i>Home</a></li>
		<li class="active"><strong>Signature Preview</strong></li>
	</ol>
	
	
	
	<br/>
	<style type="text/css">
	.menu-s,.menu-s li,.menu-s ul,.menu-s li{
		float:left;
		height:auto;
		width:auto;
		list-style:none;
		position:relative;
		margin:0px;
		padding:0px;
	}
	.menu-s{
		float:right;
	}
	.menu-s ul{
		position:absolute;
		height:auto;
		width:215px;
		top:34px;
		background-color:#FC4649;
		right:3px;
		z-index:99999;
		display:none;
	}

	.menu-s li{
		
	}
	.menu-s ul li{
		width:100%;
		border-bottom:1px solid #A41D1F;
		padding:5px 10px;
		text-align:right;
		color:#FFF;
		cursor:pointer;
		font-size:11px;
		
	}
	</style>
	
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary" data-collapsed="0">
			
				<div class="panel-heading">
					<div class="panel-title">
						Signature Preview
					</div>
                    
                    <ul class="menu-s">
                    <li class="main"><button class="btn btn-red btn-sm right" style="float:right; margin:5px;"  type="button">
									
										Load to Preview
									
                                </button>
                                <input type="hidden" name="tmpl" value="<?php echo isset($_POST['tmpl'])?$_POST['tmpl']:'ch'; ?>" id="tmpl"/>
                                <ul class="sub-menus">
                                <?php
								
                                $list=$CI->moffices->offices_list();
								foreach($list as $values){
									?>
                                	<li data-lang='<?php echo $values->offices_id; ?>'>
									<?php 
				if($values->offices_address4==''){
				echo $values->offices_name.'<br/> '.$values->offices_address2.', '.$values->offices_address3;
				}else{
					echo $values->offices_name.'<br/> '.$values->offices_address3.', '.$values->offices_address4;
				}
				
				?>
									
									(<?php echo $values->offices_country; ?>)</li>
                                    <?php
								}
									?>
                                </ul>
                                </li>
                                
                    </ul>
                    
				</div>
				
				<div class="panel-body">
					<div class="form-horizontal form-groups-bordered">
			
						<div class="form-group">
							
								<iframe id="signature" frameborder="0" width="100%" height="400" src="admin/el_load?id=<?php echo $CI->moffices->offices_get_id(); ?>&time=<?php echo time(); ?>"></iframe><textarea style="display:none;" id="contents" name="contents"></textarea><textarea style="display:none;" id="export" name="export"></textarea>
							
						</div>

					</div>
				</div>
			</div>
		</div>
    </div>
</form>



<style type="text/css">
span.validate-has-error {
	color: #f00 !important;
	}
</style>
<script type="text/javascript">
jQuery(document).ready(function(e) {

	jQuery(document).on('mouseenter','.menu-s>li.main',function(){
		$(this).closest("ul").find('ul').show();
	}).on('mouseleave','.menu-s>li.main',function(){
		$(this).closest("ul").find("ul").hide();
	})
	jQuery(document).on('click','.menu-s ul li',function(){
		$(this).closest('.menu-s').find('input').val($(this).data('lang'));
		var url="admin/el_load?id="+$(this).data('lang')+"&data="+ (new Date()).getTime();
		jQuery("#signature").attr('src',url);
		$(this).closest('ul').hide();
	})
});

</script>