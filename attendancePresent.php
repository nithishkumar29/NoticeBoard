<?php

include('dbh.php');
$column="stud".$_GET['rollno'];
$subject=$_GET['subject'];
//echo $column;
$sql="SELECT * from $subject where date=CURDATE()";
$result=mysqli_query($conn, $sql);
if(mysqli_num_rows($result)==0)
{
	$sql="INSERT into $subject (date) values (CURDATE())";
	mysqli_query($conn, $sql);
}
$sql="UPDATE $subject set $column='1' where date=CURDATE()";
$result = mysqli_query($conn, $sql);
echo "Present";
?>