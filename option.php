<?php
if (isset($statusid) && isset($ownid))
{
	$sql2="SELECT name, id FROM statuses";
	$res2 = mysqli_query($db,$sql2);
	$sorok=mysqli_num_rows($res2);
	if ($sorok> 0){		
		echo "<td><select name='statid'>";
		echo "<option value='' selected='selected'>Státusz</option>";
		if($sorok == 1){
			$row2=mysqli_fetch_array($res2);
			$id2=$row2['id'];
			$name2=$row2['name'];
			echo "<option value='$id2'>$name2</option>";
		}
		else {
			while($row2 = mysqli_fetch_assoc($res2)) {
			$id2=$row2['id'];
			$name2=$row2['name'];
				if($statusid==$id2){
					echo "<option value='$id2' selected='selected'>$name2</option>";
				}
				else{
					echo "<option value='$id2'>$name2</option>";
				}			
			}			
		}
	echo "</select></td>";
	}
	$sql2="SELECT name, id FROM owners";
	$res2 = mysqli_query($db,$sql2);
	$sorok=mysqli_num_rows($res2);
	if ($sorok> 0){
		echo "<td><select name='ownid'>";
		echo "<option value='' selected='selected'>Kapcsolattartó</option>";
		if($sorok == 1){
			$row2=mysqli_fetch_array($res2);
			$id2=$row2['id'];
			$name2=$row2['name'];	
			echo "<option value='$id2'>$name2</option>";
		}
		else {
			while($row2 = mysqli_fetch_assoc($res2)) {
			$id2=$row2['id'];
			$name2=$row2['name'];
				if($ownid==$id2){
					echo "<option value='$id2' selected='selected'>$name2</option>";
				}
				else{
					echo "<option value='$id2'>$name2</option>";	
				}
			}
		}
	    echo "</select></td>";
	}
}
else{
	$sql2="SELECT name, id FROM statuses";
	$res2 = mysqli_query($db,$sql2);
	$sorok=mysqli_num_rows($res2);
	if ($sorok> 0){		
		echo "<td><select name='statid'>";
		echo "<option value='' selected='selected'>Státusz</option>";
		if($sorok == 1){
			$row2=mysqli_fetch_array($res2);
			$id2=$row2['id'];
			$name2=$row2['name'];
			echo "<option value='$id2'>$name2</option>";
		}
		else {
			while($row2 = mysqli_fetch_assoc($res2)) {
				$id2=$row2['id'];
				$name2=$row2['name'];
				echo "<option value='$id2'>$name2</option>";	
			}			
		}
		echo "</select></td>";
	}
	$sql2="SELECT name, id FROM owners";
	$res2 = mysqli_query($db,$sql2);
	$sorok=mysqli_num_rows($res2);
	if ($sorok> 0){
		echo "<td><select name='ownid'>";
		echo "<option value='' selected='selected'>Kapcsolattartó</option>";
		if($sorok == 1){
			$row2=mysqli_fetch_array($res2);
			$id2=$row2['id'];
			$name2=$row2['name'];	
			echo "<option value='$id2'>$name2</option>";
		}
		else {
			while($row2 = mysqli_fetch_assoc($res2)) {
			$id2=$row2['id'];
			$name2=$row2['name'];
			echo "<option value='$id2'>$name2</option>";			
			}
		}
	}
	echo "</select></td>";
}
?>