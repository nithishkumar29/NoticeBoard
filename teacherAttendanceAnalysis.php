<?php
include ('dbh.php');
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<title>Attendance Analysis</title>
</head>
<body>
	<div class='container ' >
<form action="teacherAttendanceAnalysis.php" method="GET">
	<div class='form-group '>
	Select your Date: <input type="date" name="date"><br>
	</div>
	<div class='form-group'>
	<div class='form-group'>
		<select name="subject" id="subject" class='form-control'>
		<option value="">Select a subject:</option>
		<?php 
			$email="ank@nitt.edu";
			$sql="SELECT subject from teacher_sec_subject where email like '$email'";
			$result=mysqli_query($conn, $sql);
			while($row = mysqli_fetch_array($result)){
			echo"<option value='".$row['subject']."'>".$row['subject']."</option>";
		}
		?>
		</select>
	</div>
	</div>
	<input type="submit" name="submit"><br>
</form>
</div>
<div id='stats'></div>
</body>
</html>
<?php
function checkAttendance($x){
	if($x==0)
		return "Absent";
	else
		return "Present";
}
function pAttendance($studID, $total){
	include('dbh.php');
	$subject=$_GET['subject'];
	$sql="SELECT COUNT(*) as attended from $subject WHERE $studID='1'";
	$result=mysqli_query($conn, $sql);
	//echo mysqli_num_rows($result);
	$row=mysqli_fetch_array($result);
	$attended=$row['attended'];
	//echo "hg".$attended;
	$percentage=($attended)/($total);
	$percentage=100*$percentage;
	//echo $percentage;
	return $percentage;
}
if(isset($_GET['submit']))
{
	$date=$_GET['date'];
	$subject=$_GET['subject'];
	/*$sql="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='bulletin' AND `TABLE_NAME`='subject'";
	$result=mysqli_query($conn, $sql);
	$maxRows=mysqli_num_rows($result);
	echo $maxRows."<br>";
	$row=mysqli_fetch_array($result,MYSQLI_NUM);
	$sql2="SELECT * from subject WHERE date='$date'";
	$result2=mysqli_query($conn, $sql);*/
	$sql="SELECT * from $subject WHERE date='$date'";
	$result2=mysqli_query($conn, $sql);
	echo "<div class='container'>
	<table class='table table-hover'><tr>
	<th>Student ID </th>
	<th> Attendance </th></tr>";
	$x=1;
	$row2 = mysqli_fetch_array($result2);
	echo "<tr><td>106116001</td><td> ".checkAttendance($row2['stud106116001'])."</td></tr>";
	echo "<tr><td>106116002</td><td> ".checkAttendance($row2['stud106116002'])."</td></tr>";
	echo "<tr><td>106116003</td><td> ".checkAttendance($row2['stud106116003'])."</td></tr>";
	echo "<tr><td>106116004</td><td> ".checkAttendance($row2['stud106116004'])."</td></tr>";
	echo "<tr><td>106116005</td><td> ".checkAttendance($row2['stud106116005'])."</td></tr>";
	echo "<tr><td>106116006</td><td> ".checkAttendance($row2['stud106116006'])."</td></tr>";
	echo "<tr><td>106116007</td><td> ".checkAttendance($row2['stud106116007'])."</td></tr>";
	echo "<tr><td>106116008</td><td> ".checkAttendance($row2['stud106116008'])."</td></tr>";
	echo "<tr><td>106116009</td><td> ".checkAttendance($row2['stud106116009'])."</td></tr>";
	echo "<tr><td>106116010</td><td> ".checkAttendance($row2['stud106116010'])."</td></tr>";
	echo "</table></div>";
	echo "<br><div class='container'><b>Students with their Attendance Precentages</b></div><br>";
	$sql="SELECT COUNT(*) as total from $subject";
	$result = mysqli_query($conn, $sql);
	$row=mysqli_fetch_array($result);
	$totalClasses=$row['total'];
	echo "<div class='container'>
	<table class='table table-hover'><tr>
	<th>Student ID </th>
	<th> Attendance % </th></tr>";
	echo "<tr><td>106116001  </td><td> ".pAttendance("stud106116001", $totalClasses)."%</td></tr>";
	echo "<tr><td>106116002  </td><td> ".pAttendance("stud106116002", $totalClasses)."%</td></tr>";
	echo "<tr><td>106116003  </td><td> ".pAttendance("stud106116003", $totalClasses)."%</td></tr>";
	echo "<tr><td>106116004  </td><td> ".pAttendance("stud106116004", $totalClasses)."%</td></tr>";
	echo "<tr><td>106116005  </td><td> ".pAttendance("stud106116005", $totalClasses)."%</td></tr>";
	echo "<tr><td>106116006  </td><td> ".pAttendance("stud106116006", $totalClasses)."%</td></tr>";
	echo "<tr><td>106116007  </td><td> ".pAttendance("stud106116007", $totalClasses)."%</td></tr>";
	echo "<tr><td>106116008  </td><td> ".pAttendance("stud106116008", $totalClasses)."%</td></tr>";
	echo "<tr><td>106116009  </td><td> ".pAttendance("stud106116009", $totalClasses)."%</td></tr>";
	echo "<tr><td>106116010  </td><td> ".pAttendance("stud106116010", $totalClasses)."%</td></tr>";
	echo "</table></div>";
}

?>