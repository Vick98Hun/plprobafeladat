<?php
echo "<tr><th>Cím</th><th>Státusz</th><th>Kapcsolattartó</th>";
$result =mysqli_query($db,$sql);
	if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)){
	  $title=$row['title']; 
	  $name=$row['name'];
	  $owner=$row['owner'];
	  $id=$row['pid'];
	  $statusid=$row['statusid'];
	  $ownid=$row['ownid'];
	  echo "<tr>";
	  echo "<form action='szerkeztes.php' method='post'>";
	  echo "<input type='hidden' name='id' value='$id'>";
	  echo "<input type='hidden' name='sid' value='$statusid'>";
	  echo "<input type='hidden' name='oid' value='$ownid'>";
	  echo "<td>$title</td><td>$name</td><td>$owner</td>";
	  echo "<td><input type='submit' value='Szerkesztés'></td>";
	  echo "</form>";
	  echo "<form method='post' action='torol.php''>";
	  echo "<input type='hidden' name='id' value='$id'>";
	  echo "<td><button type='submit' onclick='return confirm(`Biztos benne hogy törli?`)' style='background-color:red'>Törlés</button></td>";
	  echo "</form>";
	  echo "</tr>";
	 
	  }
	}
	else {
		echo "0 results";
	}
?>