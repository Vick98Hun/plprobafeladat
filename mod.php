<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
</head>
<body>
<?php
include 'connect.php';
ini_set('SMTP','localhost');
if(isset($_POST['id']) &&isset($_POST['title']) &&isset($_POST['desc']) &&isset($_POST['ownid']) &&isset($_POST['statid'])){
$statid=$_POST['statid'];
$pid=$_POST['id'];
$ownid=$_POST['ownid'];
$title=$_POST['title'];
$desc=$_POST['desc'];
$sql="SELECT email FROM owners WHERE id=$ownid";
$res=mysqli_query($db,$sql);
while($row=mysqli_fetch_assoc($res))
{
	$email=$row['email'];
} 
$sql="SELECT status_id FROM `project_status_pivot` WHERE project_id=$pid";
$res=mysqli_query($db,$sql);
while($row=mysqli_fetch_assoc($res))
{
	$oristatid=$row['status_id'];
}
$sql="SELECT owner_id FROM `project_owner_pivot` WHERE project_id=$pid";
$res=mysqli_query($db,$sql);
while($row=mysqli_fetch_assoc($res))
{
	$oriownid=$row['owner_id'];
}
$sql="SELECT title,description FROM projects WHERE id=$pid";
$res=mysqli_query($db,$sql);
while($row=mysqli_fetch_assoc($res))
{
	$orititle=$row['title'];
	$oridesc=$row['description'];
}
if($orititle==$title && $oridesc == $desc && $oriownid == $ownid && $oristatid==$statid)
{
	header("refresh:0;index.php?err=nincsvalt");
}
elseif($orititle==$title && $oridesc == $desc && $oriownid == $ownid && $oristatid!=$statid)
{
	$sql="UPDATE `project_status_pivot` SET `status_id`=$statid WHERE project_id=$pid";
	mysqli_query($db,$sql);
	$sql="SELECT name FROM statuses WHERE id=$statid";
	$res=mysqli_query($db,$sql);
	while($row=mysqli_fetch_assoc($res))
	{
		$statname=$row['name'];
	}
	mail("$email", "projekt változás", "az ön projektje változott: $statname");
	header("refresh:0;index.php");
}
elseif($orititle==$title && $oridesc == $desc && $oriownid != $ownid && $oristatid==$statid)
{
	$sql="UPDATE `project_owner_pivot` SET `owner_id`=$ownid WHERE project_id=$pid";
	mysqli_query($db,$sql);
	$sql="SELECT name FROM owners WHERE id=$ownid";
	$res=mysqli_query($db,$sql);
	while($row=mysqli_fetch_assoc($res))
	{
		$ownname=$row['name'];
	}
	mail("$email", "projekt változás", "az ön projektje változott: $ownname");
	header("refresh:0;index.php");
}
elseif($orititle==$title && $oridesc != $desc && $oriownid == $ownid && $oristatid==$statid)
{
	$sql="UPDATE `projects` SET `description`='$desc' WHERE id=$pid";
	mysqli_query($db,$sql);
	mail("$email", "projekt változás", "az ön projektje változott: $desc");
	header("refresh:0;index.php");
}
elseif($orititle!=$title && $oridesc == $desc && $oriownid == $ownid && $oristatid==$statid)
{
	$sql="UPDATE `projects` SET `title`='$title' WHERE id=$pid";
	mysqli_query($db,$sql);
	mail("$email", "projekt változás", "az ön projektje változott: $title");
	header("refresh:0;index.php");
}
elseif($orititle!=$title && $oridesc != $desc && $oriownid == $ownid && $oristatid==$statid)
{
	$sql="UPDATE `projects` SET `title`='$title',`description`='$desc' WHERE id=$pid";
	mysqli_query($db,$sql);
	mail("$email", "projekt változás", "az ön projektje változott: $title,$desc");
	header("refresh:0;index.php");
}
else
{
	$sql="UPDATE `project_owner_pivot` SET `owner_id`=$ownid WHERE project_id=$pid";
	mysqli_query($db,$sql);
	$sql="UPDATE `project_status_pivot` SET `status_id`=$statid WHERE project_id=$pid";
	mysqli_query($db,$sql);
	$sql="UPDATE `projects` SET `title`='$title',`description`='$desc' WHERE id=$pid";
	mysqli_query($db,$sql);
	mail("$email", "projekt változás", "az ön projektje változott: $title,$desc");
	header("refresh:0;index.php");
}
 


}
else
{
	echo "HIBA HIÁNYZÓ ADAT";
}
?>
</body>
</html>