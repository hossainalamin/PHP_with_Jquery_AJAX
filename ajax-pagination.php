<?php
$con    = mysqli_connect('localhost','root','','test') or die ("Connection failed");
$limit  = 3;
$page   = ""; 
if(isset($_POST['page_no'])){
	$page = $_POST['page_no'];
}else{
	$page = 1;
}
$ofset = ($page-1)*$limit;
$sql    = "select * from user limit $ofset,$limit ";
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
	$output .= '</table>';
	$sql_total = "select * from user";
	$records   = mysqli_query($con,$sql_total) or die("No data found");
	$total_records = mysqli_num_rows($records);
	$total_page = ceil($total_records/$limit);
	$output .='<div id="pagination">';
	for($i=1 ; $i<= $total_page ; $i++){
		if($i == $page){
			$class_name = "active";
		}else{
			$class_name = "";	
		}
	$output .="<a href='' id='{$i}' class='{$class_name}'>{$i}</a>";
	}
	$output .='</div>';
	echo $output;
}else{
	echo "No record found";
}
?>
