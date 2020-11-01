<?php
$search_val = $_POST['search'];
$con    = mysqli_connect('localhost','root','','test') or die ("Connection failed");
$sql    = "select * from user where Name like '%$search_val%' or Email like '%$search_val%' or Skill like '%$search_val%' ";
$result = mysqli_query($con,$sql) or die("No data found");
$output = "";
if(mysqli_num_rows($result)>0){
	$output = "<table border = '1px' width='100%' cellspacing = '0' cellpaddin = '10px'>
				<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Email</th>
				<th>Skill</th>
				<th width='100px'>Edit</th>
				<th width='100px'>Delete</th>";
		foreach($result as $data){
			$output .="<tr><td>{$data['ID']}</td><td>{$data['Name']}</td><td>{$data['Email']}</td><td width='100px'>{$data['Skill']}</td><td><button class='edit-btn' data-eid={$data['ID']}>Edit</button></td><td><button class='delete-btn' data-id={$data['ID']}>Delete</button></td></tr>";
		}
	$output .= "</table>";
	echo $output;
}else{
	echo"<h2>No data found </h2>";
}
?>