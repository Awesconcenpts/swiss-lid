<?php
class mcommon extends CI_Model{
    public function update_status(){
		$tbl=explode('|',$_POST['status']);
		$data=$this->db->query("select* from ".$this->db->dbprefix.$tbl[0]." where ".$tbl[1]."='".$tbl[2]."'")->result();
		$yn=(isset($data[0]->$tbl[3]) && $data[0]->$tbl[3]=='N')?'Y':'N';
		$this->db->query("update ".$this->db->dbprefix.$tbl[0]." set ".$tbl[3]."='$yn' where ".$tbl[1]."='".$tbl[2]."'");
		set_status('success','Successfully updated data status.');
	}
	public function update_order(){		
		if(is_array($_POST['display_order'])){
			foreach ($_POST['display_order'] as $key=>$val){
				$tbl=explode('|',$val);
				$this->db->query("update ".$this->db->dbprefix.$tbl[0]." set ".$tbl[3]."='".$_POST['display_order_new'][$key]."' where ".$tbl[1]."='".$tbl[2]."'");
			}
		set_status('success','Successfully updated display orders.');	
		}
		
		
	}
	public function reactivate(){
		if(isset($_POST['submit']) && $_POST['submit']!=''){
		$sql=$this->db->query("select* from ".prefix."system where system_id='".$_POST['submit']."'")->result();
		
			foreach($sql as $row){
				$this->db->query("delete from ".$this->db->dbprefix."system where page_slug='".$row->page_slug."'")->result(); 
				$this->db->query("delete from ".$this->db->dbprefix."system where parent_slug='".$row->page_slug."'")->result();
				set_status('success','Successfully re-activated system modules.');
			}
		}
	}
	public function replace_backend($data='',$str=''){
		
	if(isset($data[0])){
			$offices_name=str_replace(" ",'&nbsp;',$data[0]->offices_name);
			$offices_desc=str_replace(" ",'&nbsp;',$data[0]->offices_desc);
			$offices_address1=str_replace(" ",'&nbsp;',$data[0]->offices_address1);
			
			$offices_address2=str_replace(" ",'&nbsp;',$data[0]->offices_address2);
			$offices_address3=str_replace(" ",'&nbsp;',$data[0]->offices_address3);
			$offices_address4=str_replace(" ",'&nbsp;',$data[0]->offices_address4);
			$offices_country=str_replace(" ",'&nbsp;',$data[0]->offices_country);
			$offices_phone=str_replace(" ",'&nbsp;',$data[0]->offices_phone);
			$offices_mobile=str_replace(" ",'&nbsp;',$data[0]->offices_mobile);
			$offices_url=str_replace(" ",'&nbsp;',$data[0]->offices_url);
			$offices_disclaimer=str_replace(" ",'&nbsp;',$data[0]->offices_disclaimer);
			$office_fon='';
			if($offices_phone!=''){
			$office_fon='<a href="tel:+'.$offices_phone.'" style="text-decoration: none;color: #000;font-family: Roboto, Geneva, sans-serif;" >'.$offices_phone.'</a></br>';
			}
			if($offices_mobile!=''){
			$office_fon.='<a href="tel:+'.$offices_mobile.'" style="text-decoration: none;color: #000;font-family: Roboto, Geneva, sans-serif;" >'.$offices_mobile.'</a>';

			}
			$str = str_replace("[Address Title with \"&_nbsp;\"]",$offices_name,$str);
			$str = str_replace("[OFFICE PHONE]",$office_fon,$str);
			$str = str_replace("[Address line 1]",$offices_address1,$str);
			$str = str_replace("[Address line 2]",$offices_address2,$str);
			$str = str_replace("[Address line 3]",$offices_address3,$str);
			$str = str_replace("[Address line 4]",$offices_address4,$str);
			$str = str_replace("www.swiss-led.com",$offices_url,$str);
			$dec='The information in this e-mail and in any attachment is confidential and intended solely for the attention of the named addressee. If you have received this e-mail by error, please inform us immediately and delete this message and any attachment from your system without producing, distributing or retaining copies hereof. All our activities are subject to our General Terms and Conditions that can be found on our website.';
			$decl=str_replace(' ','&nbsp;',get_settings('disclaimer').$offices_disclaimer);
			//$str = str_replace($dec,$decl,$str);
			$dec='Technologies for the future';
			$decl=str_replace(' ','&nbsp;',get_settings('slogan'));
			$str = str_replace($dec,$decl,$str);
			$dec='Switzerland&ensp;&mdash;&ensp;United States&ensp;&mdash;&ensp;South Africa&ensp;&mdash;&ensp;United Arab Emirates&ensp;&mdash;&ensp;China&ensp;&mdash;&ensp;Netherlands&ensp;&mdash;&ensp;Spain&ensp;&mdash;&ensp;Turkey';
			$decl=str_replace(' ','&nbsp;',get_settings('regional_offices'));
			$str = str_replace($dec,$decl,$str);
			return $str;
	}
			
		}
		public function replace_users($data='',$str=''){
			if(isset($_POST)){
			foreach($_POST as $key=>$val){
				$_POST[$key]=str_replace(' ','&nbsp;',$_POST[$key]);
			}
			}
		if(isset($data[0])){	
		$str = str_replace("[FULL NAME]", $_POST['fullname'],$str);
			$str = str_replace("[TITLE]", $_POST['role'],$str);
			
			$data='<a style="text-decoration: none;line-height: 1.5;font-family: Roboto, Geneva, sans-serif; font-size: 1em;font-weight: lighter;color: #000;" href="tel:+11234567890">Phone: +1 (123) 456-7890</a><br />
<a style="text-decoration: none;line-height: 1.5;font-family: Roboto, Geneva, sans-serif; font-size: 1em;font-weight: lighter;color: #000;" href="tel:+18187262752">Cell.: +1 (848) 716-2712</a><br />
<a style="text-decoration: none;line-height: 1.5;font-family: Roboto, Geneva, sans-serif; font-size: 1em;font-weight: lighter;color: #000;" href="tel:+18187262752">Cell.: +1 (828) 726-1752</a><br />';
			$new='';
			foreach($_POST['phone'] as $key=>$val){
				if($val!==''){
			$new.='<a style="text-decoration: none;line-height: 1.5;font-family: Roboto, Geneva, sans-serif; font-size: 1em;font-weight: lighter;color: #000;" href="tel:phone1">'.$_POST['phone_type'][$key].' '.$val.'</a><br>';
				}
			}
			$str = str_replace($data, $new,$str);
			
			return $str;
		}
		}
	public function getuseremails(){
		ob_start();
		?>
        
         <!DOCTYPE html>
 <html lang="en">
 <head>
 <style>
 @media only screen and (max-width: 640px) { body[yahoofix] img:not(.list img) { max-width: 100%; }
 body[yahoofix] .grid_3:not(.mobile-inline), body[yahoofix] .grid_9:not(.mobile-inline), body[yahoofix] .grid_6:not(.mobile-inline), { display: block; width: 100% !important; }
 body[yahoofix] .mobile-inline { box-sizing: border-box; padding: 10px 0; }
 body[yahoofix] .wrapper { width: 340px !important; }
 body[yahoofix] .m-cent { text-align: center !important; margin: 0 auto; float: none }
 body[yahoofix] .m-left { text-align: left !important; float: none; }
 body[yahoofix] .header h2 { font-size: 20px !important; }
 body[yahoofix] .header p { font-size: 18px !important; }
 body[yahoofix] .grid_1:not(.mobile-inline), body[yahoofix] .grid_2:not(.mobile-inline), body[yahoofix] .grid_3:not(.mobile-inline), body[yahoofix] .grid_4:not(.mobile-inline), body[yahoofix] .grid_5:not(.mobile-inline), body[yahoofix] .grid_6:not(.mobile-inline), body[yahoofix] .grid_7:not(.mobile-inline), body[yahoofix] .grid_8:not(.mobile-inline), body[yahoofix] .grid_9:not(.mobile-inline), body[yahoofix] .grid_10:not(.mobile-inline), body[yahoofix] .grid_11:not(.mobile-inline), body[yahoofix] .grid_12:not(.mobile-inline) { display: block !important; width: 100% !important; padding: 0 !important; padding-top: 5px !important; padding-bottom: 9px !important; /*background:rgba(155,0,0,0.3); outline: 1px dotted rgba(155,0,0,0.5); */ }
 body[yahoofix] img { margin: 0; }
 body[yahoofix] .container_12 { padding-left: 15px !important; padding-right: 15px !important; padding-top: 0 !important; padding-bottom: 0 !important; box-sizing: border-box; display: block; width: 100% !important; }
 body[yahoofix] .content { padding: 15px 15px 0 !important; }
 body[yahoofix] td.container_12.picheader { padding: 0 !important; width: 100% !important; }
 body[yahoofix] .reset-padding { padding-bottom: 0 !important; padding-top: 0 !important; }
 body[yahoofix] .m-cent { text-align: center !important; }
 body[yahoofix] .m-cent table { margin: 0 auto; }
 body[yahoofix] .m-cent img { margin: 0 auto; }
 .container_12.grey_grad { background-image: none; background: #ffffff; /* Old browsers */ background: -moz-linear-gradient(top, #ffffff 0%, #f7f7f7 100%); /* FF3.6+ */ background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ffffff), color-stop(100%, #f7f7f7)); /* Chrome,Safari4+ */ background: -webkit-linear-gradient(top, #ffffff 0%, #f7f7f7 100%); /* Chrome10+,Safari5.1+ */ background: -o-linear-gradient(top, #ffffff 0%, #f7f7f7 100%); /* Opera 11.10+ */ background: -ms-linear-gradient(top, #ffffff 0%, #f7f7f7 100%); /* IE10+ */ background: linear-gradient(to bottom, #ffffff 0%, #f7f7f7 100%); /* W3C */ filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#f7f7f7', GradientType=0); /* IE6-9 */ }
 body[yahoofix] .hdr { padding-top: 25px !important; }
 a{
	 color:#343434!important;
 }
 </style>
 </head>
 <body yahoofix="true" style="background: #FFF;">
     <p class="snippet" style="color: #FFF; display: none; font-size: 1px; line-height: 1px;">
     	Thanks for downloading email signature from <?php echo get_settings('site_name'); ?> <?php echo get_settings('site_slug'); ?> &nbsp;|&nbsp;
     </p>
     <table align="center" class="wrapper narrow dailydigest" cellspacing="0" cellpadding="0" style="background: #d2232a; border: 1px solid #d2232a; width: 695px;">
         <tr>
         <td class="container_12 header" align="center" style="background: #FFF; color: #343434; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 13px; height: 110px; padding-bottom: 5px; padding-left: 42px; padding-right: 38px; padding-top: 4px; text-align: left; width: 100%;">
             <table class="inner spacer" align="center" cellspacing="0" cellpadding="0" style="margin: 0 auto; width: 100%;">
                 <tr>
                     <td class="grid_12 desktop" style="color: #343434; display: table-cell; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 13px; padding-left: 4px; padding-right: 4px; position: relative; text-align: left; width: 98.0%;">&nbsp;
                     
                     </td>
                 </tr>
             </table>
             <table cellspacing="0" class="inner" align="center" cellpadding="0" style="margin: 0 auto; width: 100%;">
                 <tr>
                     <td class="grid_6 mobile-inline" style="color: #343434; display: table-cell; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 13px; padding-left: 4px; padding-right: 4px; position: relative; text-align: left; width: 48.5%;">
                        <h2 style="color: #5F5F65; font-size: 25px; margin-bottom: 0; margin-top: 0; text-transform: uppercase;"> <?php echo get_settings('site_name'); ?></h2>
                         <p style="color: #5F5F65; font-size: 20px; margin: 0;">
                         <?php echo get_settings('site_slug'); ?>
                         </p>
                     </td>
                     <td class="grid_6 right middle mobile-inline" align="right" valign="middle" style="color: #343434; display: table-cell; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 13px; padding-left: 4px; padding-right: 4px; position: relative; text-align: right; width: 48.5%;">
                        <img src="<?php echo base_url(); ?>assets/admin/images/<?php echo get_settings('website_logo'); ?>">
                     </td>
                 </tr>
             </table>
         </td>
         </tr>
         <tr>
         <td class="container_12 hdr" align="center" style="color: #343434; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 13px; padding-bottom: 0; padding-left: 42px; padding-right: 38px; padding-top: 40px; text-align: left; width: 100%;">&nbsp;</td>
         </tr>
         <tr>
         <td class="container_12" align="center" style="color: #343434; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 13px; padding-bottom: 5px; padding-left: 42px; padding-right: 38px; padding-top: 4px; text-align: left; width: 100%;">
             <table class="inner" align="center" cellspacing="0" cellpadding="0" style="margin: 0 auto; width: 100%;">
                 	 <tr>
                     <!-- REPEAT blocks in incoming tasks: left -->
                     <td class="grid_6 block" style="color: #343434; display: table-cell; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 13px; padding-left: 4px; padding-right: 4px; position: relative; text-align: left; width: 48.5%; vertical-align: top;">
                             <table class="block-inner" cellspacing="0" cellpadding="0" style="background: #FFF; border: 1px solid #d2232a; padding-left: 2px; /*border-radius: 3px; box-shadow: 0 1px 2px rgba(0,0,0,0.05);*/ width: 100%;">
                                 <tr>
                                     <td style="padding: 6px 0 9px 10px; color: #343434; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 13px; text-align: left;">
                                             <table cellspacing="0" cellpadding="0" style="width: 100%;">
                                                 <tr>
                                                     <td class="name" style="color: #343434; font-family: 'Segoe UI Semibold', 'Segoe UI', 'Open Sans Semibold', 'Arial', sans-serif; font-size: 13px; font-weight: bolder; height: 48px; line-height: 18px; text-align: left; vertical-align: top; width: 100%;">
                                                             <table cellspacing="0" cellpadding="0" style="width: 100%;">
                                                                 <tr>
                                                                     <td class="name" style="color: #343434; font-family: 'Segoe UI Semibold', 'Segoe UI', 'Open Sans Semibold', 'Arial', sans-serif; font-size: 13px; height: 48px; line-height: 18px; text-align: left; vertical-align: top;">
                                                                        <br/>
                                                                        Hello <?php echo $this->session->userdata('fullname'); ?>,<br/><br/>
                                                                        
                                                                        Thanks for downloading email signature.<br/><br/>
                                                                        
                                                                        
                                                                        
                                                                       
                                                                        <p style="font-size: 13px;"></p>
                                                                        <br/>
                                                                     </td>
                                                                 </tr>
                                                             </table>
                                                     </td>
                                                 </tr>
                                                
                                             </table>
                                     </td>
                                 </tr>
                             </table>
                     </td>
                     <!-- REPEAT blocks in incoming tasks: right -->
                     </tr>
                     <tr>
                     <!-- REPEAT blocks in incoming tasks: left -->
                     <td class="grid_6 block" style="color: #343434; display: table-cell; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 13px; padding-left: 4px; padding-right: 4px; position: relative; text-align: left; width: 48.5%; vertical-align: top;">
                             <table class="block-inner" cellspacing="0" cellpadding="0" style=" padding-left: 2px;  width: 100%;">
                                 <tr>
                                     <td style="padding: 6px 0 9px 10px; color: #343434; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 13px; text-align: left;">
                                             <table cellspacing="0" cellpadding="0" style="width: 100%;">
                                                 <tr>
                                                     <td class="name" style="color: #343434; font-family: 'Segoe UI Semibold', 'Segoe UI', 'Open Sans Semibold', 'Arial', sans-serif; font-size: 13px; font-weight: bolder; height: 48px; line-height: 18px; text-align: left; vertical-align: top; width: 100%;">
                                                             <table cellspacing="0" cellpadding="0" style="width: 100%;">
                                                                 <tr>
                                                                     <td class="name" style="color: #DCF4FD; font-family: 'Segoe UI Semibold', 'Segoe UI', 'Open Sans Semibold', 'Arial', sans-serif; font-size: 12px; height: 48px; line-height: 18px; text-align: center; vertical-align: top;  ">
                                                                        This email was intended for <?php echo $this->session->userdata('fullname'); ?>, If you need assistance or have questions, please contact <a style="color:#FFF" href="mailto:<?php echo get_settings('email_address'); ?>"><?php echo get_settings('site_name'); ?> <?php echo get_settings('site_slug'); ?></a>
                                                                     </td>
                                                                 </tr>
                                                             </table>
                                                     </td>
                                                 </tr>
                                                
                                                
                                             </table>
                                     </td>
                                 </tr>
                             </table>
                     </td>
                     <!-- REPEAT blocks in incoming tasks: right -->
                 </tr>
             </table>
         </td>
         </tr>
         <tr>
             <td class="container_12 ftr" align="center" style="color: #343434; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 13px; padding-bottom: 5px; padding-left: 42px; padding-right: 38px; padding-top: 4px; text-align: left; width: 100%;">&nbsp;</td>
         </tr>
         <tr>
             <td class="container_12 ftr" align="center" style="color: #343434; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 13px; padding-bottom: 5px; padding-left: 42px; padding-right: 38px; padding-top: 4px; text-align: left; width: 100%;">
                 <table class="inner" align="center" cellspacing="0" cellpadding="0" style="margin: 0 auto; width: 100%;">
                     <tr>
                        <td class="grid_12" style="color: #666; display: table-cell; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 12px; padding-left: 4px; padding-right: 4px; position: relative; text-align: left; width: 98.0%;">
                     </td>
                     </tr>
                 </table>
                 <table class="inner" cellspacing="0" cellpadding="0" style="margin: 0 auto; width: 100%;border-collapse: collapse;">
                     <tr>
                        <td style="padding-top: 17px; font-size: 1px; line-height: 1px;"><i>&nbsp;</i></td>
                     </tr>
                 </table>
             </td>
         </tr>
         <tr>
             <td class="container_12 footer" align="center" style="background: #FFF; color: #343434; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 13px; padding-bottom: 5px; padding-left: 42px; padding-right: 38px; padding-top: 4px; text-align: left; width: 100%;">
                 <table class="inner" align="center" cellspacing="0" cellpadding="0" style="margin: 0 auto; width: 100%;">
                     <tr>
                         <td class="grid_12 subscription" style=" color: #666; display: table-cell; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 16px; padding-left: 4px; padding-right: 4px; padding-top: 6px; padding-bottom: 10px; position: relative; text-align: left; width: 98.0%;">
                             <h2 style="color: #5F5F65; font-size: 25px; margin-bottom: 0; text-align:center; margin-top: 0;">Thank You, <?php echo get_settings('site_name'); ?> <?php echo get_settings('site_slug'); ?>!!</h2>
                         </td>
                     </tr>
                 </table>
             </td>
         </tr>
     </table>

 </body>
 </html>
        <?php
		$output = ob_get_contents();
ob_end_clean();
return $output;
		
	}
	public function getadminemails(){
		ob_start();
		?>
        
         <!DOCTYPE html>
 <html lang="en">
 <head>
 <style>
 @media only screen and (max-width: 640px) { body[yahoofix] img:not(.list img) { max-width: 100%; }
 body[yahoofix] .grid_3:not(.mobile-inline), body[yahoofix] .grid_9:not(.mobile-inline), body[yahoofix] .grid_6:not(.mobile-inline), { display: block; width: 100% !important; }
 body[yahoofix] .mobile-inline { box-sizing: border-box; padding: 10px 0; }
 body[yahoofix] .wrapper { width: 340px !important; }
 body[yahoofix] .m-cent { text-align: center !important; margin: 0 auto; float: none }
 body[yahoofix] .m-left { text-align: left !important; float: none; }
 body[yahoofix] .header h2 { font-size: 20px !important; }
 body[yahoofix] .header p { font-size: 18px !important; }
 body[yahoofix] .grid_1:not(.mobile-inline), body[yahoofix] .grid_2:not(.mobile-inline), body[yahoofix] .grid_3:not(.mobile-inline), body[yahoofix] .grid_4:not(.mobile-inline), body[yahoofix] .grid_5:not(.mobile-inline), body[yahoofix] .grid_6:not(.mobile-inline), body[yahoofix] .grid_7:not(.mobile-inline), body[yahoofix] .grid_8:not(.mobile-inline), body[yahoofix] .grid_9:not(.mobile-inline), body[yahoofix] .grid_10:not(.mobile-inline), body[yahoofix] .grid_11:not(.mobile-inline), body[yahoofix] .grid_12:not(.mobile-inline) { display: block !important; width: 100% !important; padding: 0 !important; padding-top: 5px !important; padding-bottom: 9px !important; /*background:rgba(155,0,0,0.3); outline: 1px dotted rgba(155,0,0,0.5); */ }
 body[yahoofix] img { margin: 0; }
 body[yahoofix] .container_12 { padding-left: 15px !important; padding-right: 15px !important; padding-top: 0 !important; padding-bottom: 0 !important; box-sizing: border-box; display: block; width: 100% !important; }
 body[yahoofix] .content { padding: 15px 15px 0 !important; }
 body[yahoofix] td.container_12.picheader { padding: 0 !important; width: 100% !important; }
 body[yahoofix] .reset-padding { padding-bottom: 0 !important; padding-top: 0 !important; }
 body[yahoofix] .m-cent { text-align: center !important; }
 body[yahoofix] .m-cent table { margin: 0 auto; }
 body[yahoofix] .m-cent img { margin: 0 auto; }
 .container_12.grey_grad { background-image: none; background: #ffffff; /* Old browsers */ background: -moz-linear-gradient(top, #ffffff 0%, #f7f7f7 100%); /* FF3.6+ */ background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ffffff), color-stop(100%, #f7f7f7)); /* Chrome,Safari4+ */ background: -webkit-linear-gradient(top, #ffffff 0%, #f7f7f7 100%); /* Chrome10+,Safari5.1+ */ background: -o-linear-gradient(top, #ffffff 0%, #f7f7f7 100%); /* Opera 11.10+ */ background: -ms-linear-gradient(top, #ffffff 0%, #f7f7f7 100%); /* IE10+ */ background: linear-gradient(to bottom, #ffffff 0%, #f7f7f7 100%); /* W3C */ filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#f7f7f7', GradientType=0); /* IE6-9 */ }
 body[yahoofix] .hdr { padding-top: 25px !important; }
 a{
	 color:#343434!important;
 }
 </style>
 </head>
 <body yahoofix="true" style="background: #FFF;">
     <p class="snippet" style="color: #FFF; display: none; font-size: 1px; line-height: 1px;">
     	<?php echo $this->session->userdata('fullname'); ?> downloaded email signature from <?php echo get_settings('site_name'); ?> <?php echo get_settings('site_slug'); ?> &nbsp;|&nbsp;
     </p>
     <table align="center" class="wrapper narrow dailydigest" cellspacing="0" cellpadding="0" style="background: #d2232a; border: 1px solid #d2232a; width: 695px;">
         <tr>
         <td class="container_12 header" align="center" style="background: #FFF; color: #343434; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 13px; height: 110px; padding-bottom: 5px; padding-left: 42px; padding-right: 38px; padding-top: 4px; text-align: left; width: 100%;">
             <table class="inner spacer" align="center" cellspacing="0" cellpadding="0" style="margin: 0 auto; width: 100%;">
                 <tr>
                     <td class="grid_12 desktop" style="color: #343434; display: table-cell; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 13px; padding-left: 4px; padding-right: 4px; position: relative; text-align: left; width: 98.0%;">&nbsp;
                     
                     </td>
                 </tr>
             </table>
             <table cellspacing="0" class="inner" align="center" cellpadding="0" style="margin: 0 auto; width: 100%;">
                 <tr>
                     <td class="grid_6 mobile-inline" style="color: #343434; display: table-cell; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 13px; padding-left: 4px; padding-right: 4px; position: relative; text-align: left; width: 48.5%;">
                        <h2 style="color: #5F5F65; font-size: 25px; margin-bottom: 0; margin-top: 0; text-transform: uppercase;"> <?php echo get_settings('site_name'); ?></h2>
                         <p style="color: #5F5F65; font-size: 20px; margin: 0;">
                         <?php echo get_settings('site_slug'); ?>
                         </p>
                     </td>
                     <td class="grid_6 right middle mobile-inline" align="right" valign="middle" style="color: #343434; display: table-cell; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 13px; padding-left: 4px; padding-right: 4px; position: relative; text-align: right; width: 48.5%;">
                        <img src="<?php echo base_url(); ?>assets/admin/images/<?php echo get_settings('website_logo'); ?>">
                     </td>
                 </tr>
             </table>
         </td>
         </tr>
         <tr>
         <td class="container_12 hdr" align="center" style="color: #343434; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 13px; padding-bottom: 0; padding-left: 42px; padding-right: 38px; padding-top: 40px; text-align: left; width: 100%;">&nbsp;</td>
         </tr>
         <tr>
         <td class="container_12" align="center" style="color: #343434; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 13px; padding-bottom: 5px; padding-left: 42px; padding-right: 38px; padding-top: 4px; text-align: left; width: 100%;">
             <table class="inner" align="center" cellspacing="0" cellpadding="0" style="margin: 0 auto; width: 100%;">
                 	 <tr>
                     <!-- REPEAT blocks in incoming tasks: left -->
                     <td class="grid_6 block" style="color: #343434; display: table-cell; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 13px; padding-left: 4px; padding-right: 4px; position: relative; text-align: left; width: 48.5%; vertical-align: top;">
                             <table class="block-inner" cellspacing="0" cellpadding="0" style="background: #FFF; border: 1px solid #d2232a; padding-left: 2px; /*border-radius: 3px; box-shadow: 0 1px 2px rgba(0,0,0,0.05);*/ width: 100%;">
                                 <tr>
                                     <td style="padding: 6px 0 9px 10px; color: #343434; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 13px; text-align: left;">
                                             <table cellspacing="0" cellpadding="0" style="width: 100%;">
                                                 <tr>
                                                     <td class="name" style="color: #343434; font-family: 'Segoe UI Semibold', 'Segoe UI', 'Open Sans Semibold', 'Arial', sans-serif; font-size: 13px; font-weight: bolder; height: 48px; line-height: 18px; text-align: left; vertical-align: top; width: 100%;">
                                                             <table cellspacing="0" cellpadding="0" style="width: 100%;">
                                                                 <tr>
                                                                     <td class="name" style="color: #343434; font-family: 'Segoe UI Semibold', 'Segoe UI', 'Open Sans Semibold', 'Arial', sans-serif; font-size: 13px; height: 48px; line-height: 18px; text-align: left; vertical-align: top;">
                                                                        <br/>
                                                                        Hello Admin,<br/><br/>
                                                                        
                                                                        <?php echo $this->session->userdata('fullname'); ?> Downloaded email signature.<br/><br/>
                                                                        
                                                                       
                                                                        <p style="font-size: 13px;"></p>
                                                                        <br/>
                                                                     </td>
                                                                 </tr>
                                                             </table>
                                                     </td>
                                                 </tr>
                                                
                                             </table>
                                     </td>
                                 </tr>
                             </table>
                     </td>
                     <!-- REPEAT blocks in incoming tasks: right -->
                     </tr>
                     <tr>
                     <!-- REPEAT blocks in incoming tasks: left -->
                     <td class="grid_6 block" style="color: #343434; display: table-cell; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 13px; padding-left: 4px; padding-right: 4px; position: relative; text-align: left; width: 48.5%; vertical-align: top;">
                             <table class="block-inner" cellspacing="0" cellpadding="0" style=" padding-left: 2px;  width: 100%;">
                                 <tr>
                                     <td style="padding: 6px 0 9px 10px; color: #343434; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 13px; text-align: left;">
                                             <table cellspacing="0" cellpadding="0" style="width: 100%;">
                                                 <tr>
                                                     <td class="name" style="color: #343434; font-family: 'Segoe UI Semibold', 'Segoe UI', 'Open Sans Semibold', 'Arial', sans-serif; font-size: 13px; font-weight: bolder; height: 48px; line-height: 18px; text-align: left; vertical-align: top; width: 100%;">
                                                             <table cellspacing="0" cellpadding="0" style="width: 100%;">
                                                                 <tr>
                                                                     <td class="name" style="color: #DCF4FD; font-family: 'Segoe UI Semibold', 'Segoe UI', 'Open Sans Semibold', 'Arial', sans-serif; font-size: 12px; height: 48px; line-height: 18px; text-align: center; vertical-align: top;  ">
                                                                        This email was intended for <?php echo get_settings('site_name'); ?> <?php echo get_settings('site_slug'); ?>, If you do not want to receive these emails, please change your website's configuration.
                                                                     </td>
                                                                 </tr>
                                                             </table>
                                                     </td>
                                                 </tr>
                                                
                                                
                                             </table>
                                     </td>
                                 </tr>
                             </table>
                     </td>
                     <!-- REPEAT blocks in incoming tasks: right -->
                 </tr>
             </table>
         </td>
         </tr>
         <tr>
             <td class="container_12 ftr" align="center" style="color: #343434; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 13px; padding-bottom: 5px; padding-left: 42px; padding-right: 38px; padding-top: 4px; text-align: left; width: 100%;">&nbsp;</td>
         </tr>
         <tr>
             <td class="container_12 ftr" align="center" style="color: #343434; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 13px; padding-bottom: 5px; padding-left: 42px; padding-right: 38px; padding-top: 4px; text-align: left; width: 100%;">
                 <table class="inner" align="center" cellspacing="0" cellpadding="0" style="margin: 0 auto; width: 100%;">
                     <tr>
                        <td class="grid_12" style="color: #666; display: table-cell; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 12px; padding-left: 4px; padding-right: 4px; position: relative; text-align: left; width: 98.0%;">
                     </td>
                     </tr>
                 </table>
                 <table class="inner" cellspacing="0" cellpadding="0" style="margin: 0 auto; width: 100%;border-collapse: collapse;">
                     <tr>
                        <td style="padding-top: 17px; font-size: 1px; line-height: 1px;"><i>&nbsp;</i></td>
                     </tr>
                 </table>
             </td>
         </tr>
         <tr>
             <td class="container_12 footer" align="center" style="background: #FFF; color: #343434; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 13px; padding-bottom: 5px; padding-left: 42px; padding-right: 38px; padding-top: 4px; text-align: left; width: 100%;">
                 <table class="inner" align="center" cellspacing="0" cellpadding="0" style="margin: 0 auto; width: 100%;">
                     <tr>
                         <td class="grid_12 subscription" style=" color: #666; display: table-cell; font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif; font-size: 16px; padding-left: 4px; padding-right: 4px; padding-top: 6px; padding-bottom: 10px; position: relative; text-align: left; width: 98.0%;">
                             <h2 style="color: #5F5F65; font-size: 25px; margin-bottom: 0; text-align:center; margin-top: 0;">Thank You, <?php echo get_settings('site_name'); ?> <?php echo get_settings('site_slug'); ?>!!</h2>
                         </td>
                     </tr>
                 </table>
             </td>
         </tr>
     </table>

 </body>
 </html>
        <?php
		$output = ob_get_contents();
ob_end_clean();
return $output;
		
	}
	
    
}