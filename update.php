<?php 
$studentId = $_POST['studentID'];
$name      = $_POST['name'];
$email     = $_POST['email'];
$skill     = $_POST['skill'];

$con    = mysqli_connect('localhost','root','','test') or die ("Connection failed");
$query = "update user
          set
		  Name  = '{$name}',
		  Email = '{$email}',
		  Skill = '{$skill}'
		  where ID = $studentId";
$result = mysqli_query($con,$query) or die("Data not update");
if($result){
	echo 1;
}else{
	echo 0;
}  
?>
