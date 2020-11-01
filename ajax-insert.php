<?php
$name  = $_POST['name'];
$email = $_POST['email'];
$skill = $_POST['skill'];
$con    = mysqli_connect('localhost','root','','test') or die ("Connection failed");
$sql    = "insert into user(Name,Email,Skill)
values('$name','$email','$skill')";
$result = mysqli_query($con,$sql) or die("No data found");
if($result){
	echo 1;
}else{
	echo 0;
}
?>