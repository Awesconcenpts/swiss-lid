<div style="width:100%; padding:10px;height:auto; float:left; background-color:#f2f2f2;">
                                                <span>Status Post</span>
                                                <textarea id="status_textbox" style="width:100%; border-radius:4px; padding:8px; height:60px;" onfocus="if(this.value==''){ this.value='Whats on your Mind!!' }else{ this.value=''; }" onblur="if(this.value=='')this.value='Whats on your Mind!!'">Whats on your Mind!!</textarea>
                                                <input type="button" data-id='0' value="Post Status" id="post_status" name="post">
                                            </div>
                                            <div id="status">
                                            <?php
											$list=$CI->mstatus->status_list();
											foreach($list as $vealues){
												$image=get_option($vealues->status_owner,'profile_image');
												$name=$CI->muser->user_get($vealues->status_owner);
											?>
                                           			 	<div class="old-status">
                                                            <div class="profile-image bgimage" style="background-image:url(assets/uploader/images/<?php echo $image; ?>);"></div>
                                                            <div class="profile-status">
                                                            <strong style="position:relative; top:-3px;"><?php echo GetArrayIndex($name,'fullname') ?></strong>
                                                                <span class="status"><?php echo $vealues->status_content; ?></span>
                                                                <span class="date"><span class='posted-time' data-date='<?php echo date("c", strtotime($vealues->status_date)); ?>'></span></span>
                                                            </div>
                                                        </div>
                                                        <?php
											}
														?>
                                            </div>
                                            