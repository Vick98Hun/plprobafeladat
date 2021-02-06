<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<link rel="stylesheet" href="bootstrap.css">
</head>
<body>
<?php
include 'connect.php';
if (isset($_GET['err']) && $_GET['err'] == "ures")
{
	echo "MINDEN MEZŐT KI KELL TÖLTENI!";
}
elseif(isset($_GET['err']) && $_GET['err'] == "nincsvalt" )
{
	echo "NINCS VÁLTOZÁS";
}
echo "<table>";
echo "<td></td>";
echo "<form action='index.php' method='post'>";
include 'option.php';
echo "<td><input type='submit' value='Szűrés'></td>";
echo "</form>";  
if(isset($_POST['statid']) &&  $_POST['statid'] != "" && isset($_POST['ownid']) && $_POST['ownid'] != "")
{
	$statid=$_POST['statid'];
	$ownid=$_POST['ownid'];
	$sql = "SELECT projects.title, projects.id as pid , statuses.name, statuses.id as statusid ,owners.name as owner, owners.id as ownid
	FROM `projects`, project_status_pivot, project_owner_pivot,owners,statuses 
	WHERE project_status_pivot.project_id=projects.id AND project_status_pivot.status_id=statuses.id 
	AND project_owner_pivot.project_id=projects.id AND project_owner_pivot.owner_id=owners.id AND project_owner_pivot.owner_id=$ownid AND project_status_pivot.status_id=$statid 
	ORDER BY projects.id ";
	include 'lekerd.php';
}
elseif (isset($_POST['statid']) &&  $_POST['statid'] == "" && isset($_POST['ownid']) && $_POST['ownid'] != "") {
	$ownid=$_POST['ownid'];
	$sql = "SELECT projects.title, projects.id as pid , statuses.name, statuses.id as statusid ,owners.name as owner, owners.id as ownid
	FROM `projects`, project_status_pivot, project_owner_pivot,owners,statuses 
	WHERE project_status_pivot.project_id=projects.id AND project_status_pivot.status_id=statuses.id 
	AND project_owner_pivot.project_id=projects.id AND project_owner_pivot.owner_id=owners.id AND project_owner_pivot.owner_id=$ownid
	ORDER BY projects.id ";	
	include 'lekerd.php';
}
elseif (isset($_POST['statid']) &&  $_POST['statid'] != "" && isset($_POST['ownid']) && $_POST['ownid'] == "") {
	$statid=$_POST['statid'];
	$sql = "SELECT projects.title, projects.id as pid , statuses.name, statuses.id as statusid ,owners.name as owner, owners.id as ownid
	FROM `projects`, project_status_pivot, project_owner_pivot,owners,statuses 
	WHERE project_status_pivot.project_id=projects.id AND project_status_pivot.status_id=statuses.id 
	AND project_owner_pivot.project_id=projects.id AND project_owner_pivot.owner_id=owners.id AND project_status_pivot.status_id=$statid 
	ORDER BY projects.id ";	
	include 'lekerd.php';
}
else{
	$sql = "SELECT projects.title, projects.id as pid , statuses.name, statuses.id as statusid ,owners.name as owner, owners.id as ownid
	FROM `projects`, project_status_pivot, project_owner_pivot,owners,statuses 
	WHERE project_status_pivot.project_id=projects.id AND project_status_pivot.status_id=statuses.id 
	AND project_owner_pivot.project_id=projects.id AND project_owner_pivot.owner_id=owners.id ORDER BY projects.id ";
	include 'lekerd.php';
}
echo"<form action='uj.php' method='post'>";
echo "<tr><td><input size='70%' type='text' id='title' name='title' placeholder='Új projekt neve'></td>";
echo "<td><input type='text' id='desc' name='desc' placeholder='Új projekt leírása'></td>";
unset($statusid);
unset($ownid);
include 'option.php';
echo "<td><input type='submit' value='Hozzáadás'></td></tr>";
echo "</form>";
echo "<form action='uj.php' method='post'>";
echo "<tr><td><input type='text' name='newown' placeholder='Új Kapcsolattartó neve'></td>";
echo "<td><input type='text' name='newemail' placeholder='Új Kapcsolattartó email címe'></td>";
echo "<td><input type='submit' value='Új Kapcsolattartó'></td></tr>";
echo "</form>";
echo "</table>"

?>
</body>
</html>
