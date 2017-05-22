<?php

require('includes/init.php');
$sess->isAdmin();

if (isset($_POST['adm_id']))
	$db->setUtype($_POST['adm_id'], 'admin');
if (isset($_POST['mem_id']))
	$db->setUtype($_POST['mem_id'], 'member');
if (isset($_POST['del_id']))
	$db->deleteUser($_POST['del_id']);

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Admin Users</title>
		<style>
			body		{width:775px; margin-left:200px; border:1px solid black}
			a:link,a:visited {color:blue; text-decoration:none}
			a:hover 	{color:red; text-decoration:underline}
			#header    	{padding-left:8px; background:#f0f0f0}
			#homelink	{font-weight:bold; margin-right:40px}
			#menuitems 	{}
			#contents 	{padding:0px 20px 0px 100px; background:#ffffe7;
						 border-top:2px solid black; border-bottom:2px solid black}
			.headline  	{font-size:120%; font-weight:bold}
			#footer    	{text-align:center; background:#f0f0f0;
						 font-size:90%; font-style:italic}
			table		{border-collapse:collapse; margin-bottom:20px; background:#f0f0f0}
			td			{border:1px solid black; padding:0px 3px 0px 3px}
			form		{margin:0px 5px 0px 5px}
		</style>
	</head>
	<body>
		<div id="header">
			<span id="homelink">
				<a href="index.php">Home</a>
			</span>
			<span id="menuitems">
				<?php echo $loginmenu."\n"; ?>
			</span>
		</div>

		<div id="contents">
			<p class="headline">Admin Users</p>
			<table>
<?php
	// Admin Users
	$users = $db->getUsers();
	foreach ($users as $user) {
		echo '				<tr>'."\n";
		echo '				<td>' . $user->uname . '</td>' . "\n";
		echo '				<td><a href="mailto:' . $user->umail . '">' . $user->umail . '</a></td>' . "\n";
		echo '				<td>' . $user->utype . '</td>' . "\n";
?>
				<td><form action="admin.php" method="post">
					<input type="hidden" name="adm_id" value="<?php echo $user->id ?>"/>
					<input type="submit" value="Admin"></form></td>
				<td><form action="admin.php" method="post">
					<input type="hidden" name="mem_id" value="<?php echo $user->id ?>"/>
					<input type="submit" value="Member"></form></td>
				<td><form action="admin.php" method="post">
					<input type="hidden" name="del_id" value="<?php echo $user->id ?>"/>
					<input type="submit" value="Delete"></form></td>
				</tr>
<?php } ?>
			</table>
		</div>
		
		<div id="footer">
			<a href="https://github.com/halojoy/ActivateLogin" 
			target="_blank">ActivateLogin</a>&nbsp;-&nbsp;halojoy &copy; 2017
		</div>
	</body>
</html>