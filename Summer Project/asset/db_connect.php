<?php  

//connect to database
$conn = mysqli_connect('localhost','Shawn','test1234','posts');

//check connection
if (!$conn) {
	echo "connection error:" . mysqli_connect_error();
}

?>