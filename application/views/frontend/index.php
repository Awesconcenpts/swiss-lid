<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Swiss LED Technologies AG</title>
<link href='https://fonts.googleapis.com/css?family=Lato:100,400,300,700' rel='stylesheet' type='text/css'>
<link href="<?php echo base_url(); ?>assets/admin/css/bootstrap.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url(); ?>assets/frontend/css/style.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/swiss-led.js"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
</head>
<body>

<div class="intro-section">

		<div class="banner-box double-border" style="<?php echo isset($_POST['download'])?'height:680px;':'width:600px;'; ?>">
		    	<h1 class="intro hs4-h1 text-black">Switch Lid<span>Swiss LED Technologies AG</span></h1>
                <div class="col-md-12">
                    <div class="row">
                    	<div class="col-lg-12">
                        	
                            	<div class="form-style" style="<?php echo isset($_POST['download'])?'padding-top:0px;':''; ?>">
                                <?php
								if(isset($_POST['download'])){
									?>
                                    <h2 style="display:none;">Thanks for using Swiss LED signature.</h2>
                                    <form name="swiss" id="swiss" method="post" action="">
                                    <iframe width="100%" height="300" scrolling="no" style="background-color:#FFF;float:left; height:300px; width:100%;" src="<?php echo 'plugin/signature/generated/prev-'.$st; ?>" frameborder="0"></iframe>
                                    <h2 style="width:100%; height:auto; float:left; margin:0px; padding:10px 20px 10px 20px">HTML Output.</h2>
                                    <textarea><?php
									$str= file_get_contents('plugin/signature/generated/'.$st);
									$ro = preg_replace('/\s+/',' ',$str);
									echo $ro;
									?>
                                    </textarea>
                                    <a type="submit" class="button" href="javascript:void(0)" onClick="history.back(1)" target="_blank">Go Back</a>
                                    <a type="submit" class="button" href="<?php echo 'home/download?download=plugin/signature/generated/'.$st; ?>" target="_blank">Download File</a>
                                    </form>
                                    <?php
								}else{
								?>
                                  <h2>Provide your details for email signature</h2>
                                  <form name="swiss" id="swiss" method="post" action="">
                                  	<div class="field" style="display:none;">
                                    <input type="text" name="surname" data-rule-required="true" data-msg-required="Please enter your Surename" placeholder="Name / Surname" />
                                    </div>
                                    <div class="field">
                                    <input type="text" name="fullname" placeholder="Full Name" data-rule-required="true" data-msg-required="Please enter your Full Name"/>
                                    </div>
                                    <div class="field">
                                    <input type="email" name="email" data-rule-required="true" data-rule-email="true" data-msg-required="Please enter your email address" data-msg-email="Please enter a valid email address" placeholder="Email Address" />
                                    </div>
                                    <div class="field">
                                    <input type="text" name="role" placeholder="Role / Title" data-rule-required="true" data-msg-required="Please enter your role/title"/>
                                    </div>
                                    <div class="fields">
                                        <div class="field">
                                        	<div class="col-lg-9 col-md-9 col-sm-8 col-xs-8">
                                            <input id="phone_1" data-rule-required="true" data-msg-required="Please enter your number" data-rule-usphone="true" data-msg-usphone="Please write phone numbers in the international ISO format eg:+41 23 456 7890" type="text" name="phone[]" placeholder="Phone Number" />
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">
                                            <select name="phone_type[]" id="phone_type1" >
                                                <option value="M.">Mobile</option>
                                                <option value="T.">Cell</option>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="field">
                                        	<div class="col-lg-9 col-md-9 col-sm-8 col-xs-8">
                                            <input id="phone_2" data-rule-required="true" data-msg-required="Please enter your number" data-rule-usphone="true" data-msg-usphone="Please write phone numbers in the international ISO format eg:+41 23 456 7890" type="text" name="phone[]" placeholder="Phone Number" />
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">
                                            <select name="phone_type[]" id="phone_type2" >
                                                <option value="M.">Mobile</option>
                                                <option value="T.">Cell</option>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="field">
                                        	<div class="col-lg-9 col-md-9 col-sm-8 col-xs-8">
                                            <input id="phone_3" data-rule-required="true" data-msg-required="Please enter your number" data-rule-usphone="true" data-msg-usphone="Please write phone numbers in the international ISO format eg:+41 23 456 7890" type="text" name="phone[]" placeholder="Phone Number" />
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">
                                            <select name="phone_type[]" id="phone_type3" >
                                                <option value="M.">Mobile</option>
                                                <option value="T.">Cell</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="field">
                                    <select name="country" placeholder="Regional Office" data-rule-required="true" data-msg-required="Please choose regional office"> 
                                    <option value="">Regional Office</option>
                                    <?php
									global $CI;
                                    	$list=$CI->moffices->offices_list();
										foreach($list as $values){
											
											
				?>		
                                        <option value="<?php echo $values->offices_id; ?>">
										<?php
										if($values->offices_address4==''){
										 echo $values->offices_name.', '.$values->offices_address2.', '.$values->offices_address3.' - '; ?>(<?php echo $values->offices_country; ?>)
                                         <?php
										}else{
										echo $values->offices_name.', '.$values->offices_address3.', '.$values->offices_address4.' - '; ?>(<?php echo $values->offices_country; ?>)
                                        <?php
										}
										 ?>
                                         
                                         </option>
                                        <?php
										}
										?>
                                    </select>
                                    </div>
                                    <input type="submit" id="sibmit" name="download" value="Get Signature" />
                                  </form>
                                  <?php
								}
								?>
                            	</div>
                            
                        </div>
                    </div>
                </div>
		</div>
</div>

</body>
</html>