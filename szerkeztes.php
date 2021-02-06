<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<link rel="stylesheet" href="bootstrap.css">
</head>
<body>
<?php
include 'connect.php';
echo "<table>";
if(isset($_POST['id']) && isset($_POST['sid']) && isset($_POST['oid']))
{
	$gid=$_POST['id'];
	$statusid=$_POST['sid'];
	$ownid=$_POST['oid'];

$sql = "SELECT projects.title, projects.id as pid , projects.description, owners.name as owner, statuses.name as status_name, owners.email 
FROM `projects`, project_status_pivot, project_owner_pivot,owners, statuses 
WHERE projects.`id`=$gid
AND owners.id=(SELECT project_owner_pivot.owner_id WHERE project_owner_pivot.`project_id`=$gid) 
AND statuses.id=(SELECT project_status_pivot.status_id WHERE project_status_pivot.`project_id`=$gid)";

$result = mysqli_query($db,$sql);
if (mysqli_num_rows($result)> 0) {
  while($row= mysqli_fetch_assoc($result)) {
	  $title=$row['title']; 
	  $desc=$row['description'];
	  $owner=$row['owner'];                      
	  $email=$row['email'];
	  $stat=$row['status_name'];
	  $id=$row['pid'];
	  echo "<form action='mod.php' method='post'>";
	  echo "<td><input type='hidden' name='id' value='$id'></td>";
	  echo "<td><textarea name='title'>$title</textarea>";
	  echo "<td><textarea name='desc'>$desc</textarea>";                                        
	  include 'option.php';
	  echo " <td><input type='submit' value='Módosítás'></td>";
	  echo "</form>";
	  }
    }
}
else
{
	echo "HIBA";
}
echo "</table>";
?>
</body>
</html>