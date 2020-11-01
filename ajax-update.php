<?php 
$studentId = $_POST['studentId'];
$con    = mysqli_connect('localhost','root','','test') or die ("Connection failed");
$sql    = "select * from user where ID = '$studentId'";
$result = mysqli_query($con,$sql) or die("No data found");
$output = "";
if(mysqli_num_rows($result)>0){
		foreach($result as $data){
			$output .="<tr>
					<td>Name:</td>
					<td><input type='text'  id='edit-name' value='{$data["Name"]}'></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><input type='text' id='edit-email' value='{$data["Email"]}' ></td>
				</tr>
				<tr>
					<td>Skill:</td>
					<td><input type='text' id='edit-skill' value='{$data["Skill"]}' ></td>		
					<td><input type='text' hidden  id='id' value='{$data["ID"]}' ></td>
				</tr>
				<tr>
					<td></td>
					<td><input type='submit' id='edit' value='Save'></td>
				</tr>";
		}
	echo $output;
}else{
	echo"<h2>No data found </h2>";
}  
?>
