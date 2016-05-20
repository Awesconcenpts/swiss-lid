<?php
/*
Plugin Name : Offices
*/
add_method('offices');
function offices(){
	add_menu_page('Regional Offices', 'Regional Offices', 'offices/offices.php', 'offices', 5,'entypo-book','videolist');
}
?>