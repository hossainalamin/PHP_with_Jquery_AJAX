<?php
$name    = $_POST['name'];
$age     = $_POST['age'];
$gender  = $_POST['gender'];
$country = $_POST['country'];
$con    = mysqli_connect('localhost','root','','test') or die ("Connection failed");
$sql    = "insert into ajax_form(name,age,gender,country)
values('$name',$age,'$gender','$country')";
$result = mysqli_query($con,$sql) or die("No data found");
if($result){
	echo "Hello ".$name." .Your record is saved";
}else{
	echo "Can't save data.";
}
?>
