<?php
/*
Plugin Name : Signature
*/
add_method('signature');
function signature(){
	add_menu_page('Signature Preview', 'Signature Preview', 'signature/signature.php', 'signature', 5,'entypo-brush','videolist');
}
?>