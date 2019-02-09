<?php
include('dbh.php');
$sql="SELECT * from subject where date=CURDATE()";
$result=mysqli_query($conn, $sql);
if(mysqli_num_rows($result)==0)
{
	$sql="INSERT into subject (date) values (CURDATE())";
	mysqli_query($conn, $sql);
	echo "<h2>Date is set </h2>";
}
else
{
	$row=mysqli_fetch_array($result);
	echo "<h2>Date is <b>".$row['date']."</b></h2>";
}
echo "I am Working";
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<style type="text/css">
	.presentBtn{
		color: green;
	}
	.absentBtn{
		color: red;
	}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<title>Attendance</title>
	<script type="text/javascript">
		function showStudents(str)
		{
			var xhr; 
		    if (window.XMLHttpRequest) 
		        xhr = new XMLHttpRequest(); 
		    else if (window.ActiveXObject) 
		        xhr = new ActiveXObject("Msxml2.XMLHTTP");
		    else 
		        throw new Error("Ajax is not supported by your browser");
		    xhr.onreadystatechange = function () {
		        if (xhr.readyState < 4)
		            document.getElementById('attendanceSheet').innerHTML = "Loading...";
		        else if (xhr.readyState === 4) {
		            if (xhr.status == 200 && xhr.status < 300) 
		                document.getElementById('attendanceSheet').innerHTML = xhr.responseText;
		        }
		    }
		    
		    xhr.open('GET', 'http://localhost/e-Bulletin/getstudentlist.php?sec='+str);
		    xhr.send(null);
		}
		function presentAttendance(ptr)
		{
			var xhr; 
			console.log("xhr created");
		    if (window.XMLHttpRequest) 
		        xhr = new XMLHttpRequest(); 
		    else if (window.ActiveXObject) 
		        xhr = new ActiveXObject("Msxml2.XMLHTTP");
		    else 
		        throw new Error("Ajax is not supported by your browser");
		    xhr.onreadystatechange = function () {
		        if (xhr.readyState < 4)
		            console.log("Loading......");
		        else if (xhr.readyState === 4) {
		            if (xhr.status == 200 && xhr.status < 300){ 
		                document.getElementsByTagName("B").innerHTML="presentAttendance";
		            }
		        }
		    }
		    xhr.open('GET', 'http://localhost/e-Bulletin/attendancePresent.php?rollno='+ptr);
		    xhr.send(null);
		}
		function absentAttendance(ptr)
		{
			var xhr; 
			console.log("xhr created");
		    if (window.XMLHttpRequest) 
		        xhr = new XMLHttpRequest(); 
		    else if (window.ActiveXObject) 
		        xhr = new ActiveXObject("Msxml2.XMLHTTP");
		    else 
		        throw new Error("Ajax is not supported by your browser");
		    xhr.onreadystatechange = function () {
		        if (xhr.readyState < 4)
		            console.log("Loading......");
		        else if (xhr.readyState === 4) {
		            if (xhr.status == 200 && xhr.status < 300) {
		                document.getElementById(ptr).innerHTML = this.responseText;
		            }
		        }
		    }
		    xhr.open('GET', 'http://localhost/e-Bulletin/attendanceAbsent.php?rollno='+ptr);
		    xhr.send(null);
		}
	</script>
</head>
<body>
<form>
<select name="sec" onchange="showStudents(this.value)">
<option value="">Select a section:</option>
<option value="cse_2a">CSE 2A</option>
<option value="cse_2b">CSE 2B</option>
<option value="cse_3a">CSE 3A</option>
<option value="cse_3b">CSE 3B</option>
<option value="cse_4a">CSE 4A</option>
<option value="cse_4b">CSE 4B</option>
</select>
</form>
<div id="attendanceSheet"><b>Attendance list will be listed here...</b></div>
</body>
</html>