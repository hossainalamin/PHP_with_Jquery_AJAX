<?php 
$id  = $_POST['id'];
$con    = mysqli_connect('localhost','root','','test') or die ("Connection failed");
$sql    = "delete from user where ID = {$id} ";
$result = mysqli_query($con,$sql) or die("No data found");
if($result){
	echo 1;
}else{
	echo 0;
}
?>