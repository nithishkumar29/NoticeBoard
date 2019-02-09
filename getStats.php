<?php

include('dbh.php');
$column="stud106116009";
$subject=$_GET['subject'];
//echo $column;

$sql="SELECT COUNT(*) as attended from $subject where $column='1'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_array($result);
$attendedClasses=$row['attended'];
echo "<div class='container'><ul class='list-group'>";
echo "<li class='list-group-item'>Classes Attended <span class='badge'><span class='badgeText'>".$attendedClasses."</span></span></li><br>";
$sql="SELECT COUNT(*) as total from $subject";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_array($result);
$totalClasses=$row['total'];
echo "<li class='list-group-item'>Total Classes <span class='badge'><span class='badgeText'>".$totalClasses."</span></span></li><br>";
$percentage=($attendedClasses)/($totalClasses);
$percentage=100*$percentage;
echo "<li class='list-group-item'>Attendance Percentage is <span class='badge'><span class='badgeText'>".$percentage."%</span></span></li><br>";
$safeBunks=floor($attendedClasses-(0.75*$totalClasses));
if($safeBunks>0)
echo "<li class='list-group-item list-group-item-success'>Safe Bunks available are <span class='badge'><span class='badgeText'>".$safeBunks."</span></span></li><br>";
else
echo "<li class='list-group-item list-group-item-danger'>No Safe Bunks available right now</li><br>";
echo "</ul>";
$sql="SELECT date from $subject where $column='0'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0)
{
	echo "<div class='table-responsive'><h3>Absent Dates for <b>".$subject."</b> are</h3> <br>";
	echo "<table class='table table-hover'>
	<tr>
	<th>Date</th></tr>";
	while($row=mysqli_fetch_array($result))
	{
		echo "<tr><td>".$row['date']."</td></tr>";
	}
	echo "</table></div>";
}

?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
	li{
		font-size: 1.5vw;
	}
	.badgeText{
		font-size: 1.5vw;
	}
	.table-hover{
		font-size: 1.5vw;
	}
	</style>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<title>Stats</title>
</head>
<body>

</body>
</html>