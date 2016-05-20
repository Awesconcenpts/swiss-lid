<?php

function sendMail($to,$from,$from_name,$subject,$message)
    {
		$CI =& get_instance();
		$CI->load->library('email');		
		$CI->email->set_newline("\r\n");
		$CI->email->from($from.'&nbsp;'.$from_name);
		$CI->email->to($to);
		$CI->email->subject($subject);
		$CI->email->message($message);
		$CI->email->print_debugger();
		return $CI->email->send();    
	}
    
    
    ?>