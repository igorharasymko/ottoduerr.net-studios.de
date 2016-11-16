<?php

	if($_POST['mini_emailTo'] == '') {
		echo $emailToError = 'You forgot to enter the email address to send to.';
	} else if (!@eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", $_POST['mini_emailTo'])) {
		echo $emailToError = 'Enter a valid email address to send to.';
	}
	if($_POST['mini_emailFrom'] == '') {
		echo $emailFromError = 'You forgot to enter the email address to send from.';
	} 
	
	
	
	if($_POST['mini_message'] == '') {
		echo $messageError = 'You forgot to enter the message.';
	}
	if($_POST['mini_name'] == '') {
		echo $nameError = 'Plese enter Your name.';
	}
if(!isset($emailToError) && !isset($emailFromError)  && !isset($messageError)) {
$emailTo = $_POST['mini_emailTo'];
$emailFrom = $_POST['mini_emailFrom'];
$subject = $_POST['mini_emailFrom'];
$message = $_POST['mini_message'];
$from = $emailFrom;
$headers = "From: $from";
			
if(mail($emailTo, $subject, $message, $headers))
{

echo "<h1 class='success'>Success</h1>";
echo "<p>Your email has been sent.</p>";
}else{
echo "error";
}

	}

?>