<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
</head>
<body>
<?php
include 'connect.php';
if (isset($_POST['id'])){
	$pid=$_POST['id'];
	$sql="DELETE FROM `project_status_pivot` WHERE project_id=$pid";
	mysqli_query($db,$sql);
	$sql="DELETE FROM `project_owner_pivot` WHERE project_id=$pid";
	mysqli_query($db,$sql);
	$sql="DELETE FROM `projects` WHERE id=$pid";
	mysqli_query($db,$sql);
	header("refresh:0;index.php");
}
?>
</body>
</html>