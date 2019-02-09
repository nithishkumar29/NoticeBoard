<?php
include('dbh.php');
$ideaContent=$_POST['ideaContent'];
$email="106116005@nitt.edu";
$sql="INSERT into idea_list values ('$email','$ideaContent')";
$result=mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Publishing Idea</title>
</head>
<body>

</body>
</html>