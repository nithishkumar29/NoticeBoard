<?php
include('dbh.php');
$sql="SELECT * from subject where date=CURDATE()";
$result=mysqli_query($conn, $sql);
if(mysqli_num_rows($result)==0)
{
	$sql="INSERT into subject (date) values (CURDATE())";
	mysqli_query($conn, $sql);
	echo "<div class='container'><h2 class='container'>Date is set </h2></div>";
}
else
{
	$row=mysqli_fetch_array($result);
	echo "<div class='container'><h2><b>".$row['date']."</b></h2></div>";
}
//echo "I am Working";
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
	#attendanceSheetBtn{
		width: 100%;
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
		                document.getElementById(ptr).innerHTML = this.responseText;
		            }
		        }
		    }
		    var subject=document.getElementById('subject').value;
		    if(subject==="")
		    	alert("Enter the Subject field");
		    else
		    {
			    xhr.open('GET', 'http://localhost/e-Bulletin/attendancePresent.php?rollno='+ptr+'&subject='+subject);
			    xhr.send(null);
			}	
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
		    var subject=document.getElementById('subject').value;
		    if(subject==="")
		    {
		    	alert("Enter the subject Field");
		    }
		    else{
			    xhr.open('GET', 'http://localhost/e-Bulletin/attendanceAbsent.php?rollno='+ptr+'&subject='+subject);
			    xhr.send(null);
			}
		}
	</script>
</head>
<body>
	<div class='container'>
	<div class='form-group'>
		<select name="sec" class='form-control' onchange="showStudents(this.value)">
		<option value="">Select a section:</option>
		<option value="cse_2a">CSE 2A</option>
		<option value="cse_2b">CSE 2B</option>
		<option value="cse_3a">CSE 3A</option>
		<option value="cse_3b">CSE 3B</option>
		<option value="cse_4a">CSE 4A</option>
		<option value="cse_4b">CSE 4B</option>
		</select>
	</div></div>
	<div class='container'>
	<div class='form-group'>
		<select name="subject" id="subject" class='form-control'>
		<option value="">Select a subject:</option>
		<?php 
			$email="vamc@nitt.edu";
			$sql="SELECT subject from teacher_sec_subject where email like '$email'";
			$result=mysqli_query($conn, $sql);
			while($row = mysqli_fetch_array($result)){
			echo"<option value='".$row['subject']."'>".$row['subject']."</option>";
		}
		?>
		</select>
	</div>
</div>
<!--<div class='container'>
<button class='btn btn-success' id="attendanceSheetBtn">Get Attendance Sheet</button>
</div>-->
<div id="attendanceSheet" class='container'><h2>Attendance list will be listed here...</h2></div>
</body>
</html>