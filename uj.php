<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
</head>
<body>
<?php
include 'connect.php';

if(isset($_POST['title']) && $_POST['title'] != "" && isset($_POST['desc']) && $_POST['desc'] != "" && isset($_POST['statid']) && isset($_POST['ownid']))
{
	$tit=$_POST['title'];                                                 
	$desc=$_POST['desc'];
	$statid=$_POST['statid'];
	$ownid=$_POST['ownid'];
	$sql="INSERT INTO `projects`(`title`, `description`) VALUES ('$tit','$desc')";
	mysqli_query($db,$sql);
	$sql="SELECT * FROM `projects` WHERE 1 ORDER BY id DESC LIMIT 1 ";
	$result=mysqli_query($db,$sql);
	$row=mysqli_fetch_assoc($result);
	$pid=$row['id'];
	$sql="INSERT INTO `project_owner_pivot`(`project_id`, `owner_id`) VALUES ($pid,$ownid)";
	mysqli_query($db,$sql);
	$sql="INSERT INTO `project_status_pivot`(`project_id`, `status_id`) VALUES ($pid,$statid)";
	mysqli_query($db,$sql);
	header("refresh:0;url=index.php");
}
elseif(isset($_POST['newown']) && $_POST['newown'] != "" && isset($_POST['newemail']) && $_POST['newemail'] !='')
{
	$newown=$_POST['newown'];
	$newemail=$_POST['newemail'];
	$sql="INSERT INTO `owners`(`name`, `email`) VALUES ('$newown','$newemail')";
	mysqli_query($db,$sql);
	header("refresh:0;url=index.php");
}
else{
	header("refresh:0;url=index.php?err=ures");
}
?>
</body>
</html>