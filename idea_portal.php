<?php
include('dbh.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ideate</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script type="text/javascript">
  	function ideaPublish()
	{
	var idea = document.getElementById("ideaContent").value;
	if(idea.length >= 10)
	{
		console.log(idea);
			var xhr;
			if (window.XMLHttpRequest) 
			{ 
			    xhr = new XMLHttpRequest();
			} 
			else if (window.ActiveXObject) 
			{
			    xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
			var data = "ideaContent=" + idea;
				 xhr.open("POST", "ideaPublish.php", true); 
			     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                  
			     xhr.send(data);
		alert("Success");
	}
	else
		alert("Idea must be a minimum of 10 characters");
	}
	function getIdeaList()
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
	            document.getElementById('ideaList').innerHTML = "Loading...";
	        else if (xhr.readyState === 4) {
	            if (xhr.status == 200 && xhr.status < 300) 
	                document.getElementById('ideaList').innerHTML = xhr.responseText;
	        }
	    }
	    
	    xhr.open('GET', 'http://localhost/e-Bulletin/getIdeaList.php');
	    xhr.send(null);
	}
	getIdeaList();
	setInterval(function(){ getIdeaList();	}, 1000);
  </script>
</head>
<body>
<div class="container">
  <h2>Ideate</h2>
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open innovation</button>
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Publish your idea here</h4>
        </div>
        <div class="modal-body">
        		<textarea rows='10' cols='68' name='ideaContent' id='ideaContent'></textarea>
        </div>
        <div class="modal-footer">
        	<button class="btn btn-default" type="submit" name="submit" onclick="ideaPublish()">submit
          <button onclick="getIdeaList()" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class='container' id='ideaList'></div>
</body>
</html>

