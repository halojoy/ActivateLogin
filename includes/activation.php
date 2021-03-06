<?php

if (!isset($_GET['ucode'])) {
	header('location:index.php');
	exit();
}

//contents
$usercode = $_GET['ucode'];
if (strlen($usercode) != 40)
	$message = '			Activation code is not valid.<br />';
else {
	$match = $db->getActivate($usercode);
	if (!$match)
		$message = '			Activation code does not match.<br />';
	else {
		$db->setActivate($match->id);
		$message = "			Great!<br />\n".
				   "			Your account is now activated.<br />\n".
				   "			You can go to index page and log in.<br />\n".
				   "			Your User Name is: <b>".$match->uname."</b>";
	}
	$db = null;
}
include ('themes/'.$theme.'/templates/message.head.php');
echo $message;
include ('themes/'.$theme.'/templates/message.foot.php');

?>
