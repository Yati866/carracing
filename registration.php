<?php
session_start();
$con = mysqli_connect('localhost','root');
// if($con){
// 	echo "connection sucessful";
// }
// else{
// 	echo "connection unsucessful";
// }
mysqli_select_db($con, 'sessionpractical');
$name = $_POST['user'];
$pass = $_POST['password'];

$q = "select * from signin where name='$name' && password='$pass'";
$result = mysqli_query($con,$q);
$num = mysqli_num_rows($result);
if($num==1){
	echo "Username already exist";
}
else{
	$qy = "insert into signin(name,password) values ('$name', '$pass')";
	mysqli_query($con,$qy);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		body{
			width: 100%;
			height: 100vh;
			background-repeat: no-repeat;
			background-size: cover;
			background-image: url(car3.jpg);
		}
	</style>
</head>
<body>
      <h1>Wohoo Sign In sucessful!!!</h1>
</body>
</html>