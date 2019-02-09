<?php
include ('dbh.php');
?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
	#wantBorder{
		border:2px solid grey;
		border-radius: 15px;
	}
	</style>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<title>Student Attendance</title>
	<script type="text/javascript">
		function getStats(str)
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
		            document.getElementById('stats').innerHTML = "Loading...";
		        else if (xhr.readyState === 4) {
		            if (xhr.status == 200 && xhr.status < 300) {
		                document.getElementById('stats').innerHTML = xhr.responseText;
		            }
		        }
		    }
		    
		    xhr.open('GET', 'http://localhost/e-Bulletin/getStats.php?subject='+str);
		    xhr.send(null);
		}
	</script>
</head>
<body>
	<?php
		$rollno="106116009";
		$sql="SELECT * from student_subjects where rollno like '$rollno'";
		$result=mysqli_query($conn, $sql);
		$number=mysqli_num_rows($result);
		if(mysqli_num_rows($result)===0)
		{
			echo "No Subjects selected";
		}
		else
		{
			echo"<div class='container' id='wantBorder'>";
			echo "<div class='btn-group btn-group-justified'>";
			while($row = mysqli_fetch_array($result))
			{
				echo "<div class='btn'><button class='btn btn-success' value='".$row['subjectName']."' onclick='getStats(this.value)'>".$row['subjectName']."</button></div>";
			}
			echo "</div></div>";
		}
	?>
<br>
<div class='container' id="subjectName"></div>
<div id="stats"></div>
</body>
</html>