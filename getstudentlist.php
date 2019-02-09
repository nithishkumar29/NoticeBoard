<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<title>Get Student List</title>
</head>
<body>

</body>
</html>
<?php
include('dbh.php');
//echo"success";
$sec=$_GET['sec'];
$sql = "SELECT fname,lname,rollno FROM student_list where sec like '$sec' ORDER BY rollno";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    echo "<div class='container'>
    <table class='table table-hover'>
	<tr>
	<th class='rollNumber'>Roll Number</th>
	<th class='firstName'>First Name</th>
	<th class='lastName'>Last Name</th>
	<th class='status'>Present</th>
	<th class='status'>Absent</th>
	<th class='status'>Status</th>
	</tr>";
	while($row = mysqli_fetch_array($result)) {
	    echo "<tr>";
	    echo "<td class='rollNumber'>" . $row['rollno']."</td>";
	    echo "<td class='firstName'>" . $row['fname'] . "</td>";
	    echo "<td class='lastName'>" . $row['lname'] . "</td>";
	    echo "<td class='status'>
	    <button class='btn btn-success' onclick='presentAttendance(".$row['rollno'].")' name='rollno' value=".$row['rollno'].">Present</td><td>
	    <button class='btn btn-danger' onclick='absentAttendance(".$row['rollno'].")' name='rollno' value=".$row['rollno'].">Absent</td>
	    <td><b id=".$row['rollno']."></b></td><td><span id='".$row['rollno']."'></span></td></tr>";
	}
	echo "</table></div>";
}
else
{
	echo "No Students";
}
?>