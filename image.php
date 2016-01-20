<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<h1>Telecharge votre Avatar </h1>
<form action="image.php" method="POST" enctype="multipart/form-data">
	<input type="file" name="image" /> 
	<input type="submit" value="Upload" name="get_image" />
</form>

<?php 
	if (isset($_POST['get_image'])) {
		echo $image_name 	=  $_FILES["image"]["name"];
		echo "<br/>".$image_type 	=  $_FILES["image"]["type"];
		echo "<br/>".$image_size     =  $_FILES["image"]["size"];
		echo "<br/>".$image_tmp_name =  $_FILES["image"]["tmp_name"];
		if ($image_name == '') {
			echo "<br/>Veillez uploade une image<br/>";
		}else{
			move_uploaded_file($image_tmp_name, "uploader/$image_name");
			echo "<br/>Uploader Image Sucess<br/>";
			echo "<img src='uploader/$image_name' />";
		}
	}	
 ?>

</body>
</html>
