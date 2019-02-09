<?php
include('dbh.php');
	$sql="SELECT * from idea_list";
	$result=mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($result))
	{
		echo "<div class='container'>
		<b>".$row['email']."</b><br>
		<h5>".$row['content']."</h5>
		</div>";
	}
?>