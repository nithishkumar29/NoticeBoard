<?php

include('dbh.php');
$column="stud".$_GET['rollno'];
$subject=$_GET['subject'];
$sql="SELECT * from $subject where date=CURDATE()";
$result=mysqli_query($conn, $sql);
if(mysqli_num_rows($result)==0)
{
	$sql="INSERT into $subject (date) values (CURDATE())";
	mysqli_query($conn, $sql);
}
//echo $column;
$sql="UPDATE $subject set $column='0' where date=CURDATE()";
$result = mysqli_query($conn, $sql);
echo "Absent";
?>