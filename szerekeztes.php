<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
</head>
<body>
<?php
header('Content-Type: text/html; charset=utf-8');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pl";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}     

if(isset($_GET['id'])
{
	$gid=$_GET['id'];
	echo $_GET['id'];
}	
else{
	echo "HIBA";
}
$sql="set names 'utf8'";
$conn->query($sql);
$sql="set character set 'utf8'";
$conn->query($sql);
$sql = "SELECT projects.title, projects.id as pid , projects.description, statuses.name, owners.name as owner, owners.email FROM `projects`, project_status_pivot, project_owner_pivot,owners,statuses WHERE project_status_pivot.project_id=projects.id AND project_status_pivot.status_id=statuses.id AND project_owner_pivot.project_id=projects.id AND project_owner_pivot.owner_id=owners.id ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  $title=$row['title']; 
	  $desc=$row['description'];
	  $name=$row['name'];
	  $owner=$row['owner'];
	  $email=$row['email'];
	  $id=$row['pid'];
	 
	  
	  echo "<form action='index.php' method='get'>";
	  echo "<input type='hidden' name='id' value='$id'>";
	  echo "<input type='text' id='title' name='title' value='$title'>";
	  echo "<input type='text' id='desc' name='desc' value='$desc'>";
	  echo "<input type='text' id='name' name='name' value='$name'>";
	  echo "<input type='text' id='owner' name='owner' value='$owner'>";
	  echo "<input type='text' id='email' name='email' value='$email'>";
	  echo "<input type='submit' value='Módosítás'><br>";
	  echo $id;
	  echo "</form>";
    }
}
else {
  echo "0 results";
}
?>
</body>
</html>