<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHp & AJAX</title>
	<link rel="stylesheet" href="style.css">
</head>

<body id="body">
	<table id="main" cellspacing=0>
		<tr>
			<td id="header">
				PHP with AJAX
			</td>
		</tr>
		<tr>
			<td id="form-load">
				<form id="form">
					Name:<input type="text" placeholder="Enter name" name="name" id="name">
					Email:<input type="text" placeholder="Enter email" name="email" id="email">
					Skill:<input type="text" placeholder="Enter skill" name="skill" id="skill">
					<input type="submit" name="submit" id="submit">
				</form>
			</td>
		</tr>
		<div id="error"></div>
		<div id="success"></div>
		<tr>
			<td id="table-data">
			</td>
		</tr>
	</table>
	<script src="js/jquery-3.5.1.min.js"></script>
	<script>
		$(document).ready(function() {
			function TableLoad() {
				$.ajax({
					url: "ajax -load.php",
					type: 'POST',
					success: function(data) {
						$('#table-data').html(data);
					}
				});
			}
			TableLoad();
			$("#submit").on("click", function(e) {
				e.preventDefault();
				var name = $('#name').val();
				var email = $('#email').val();
				var skill = $('#skill').val();
				if (name == "" || email == "" || skill == "") {
					$('#error').html("NO field should be empty").slideDown();
					$('#success').slideUp();
				} else {
					$.ajax({
						url: "ajax-insert.php",
						type: "POST",
						data: {
							name: name,
							email: email,
							skill: skill
						},
						success: function(data) {
							if (data == 1) {
								TableLoad();
								$('#form').trigger('reset');
								$('#error').html("Record save").slideDown();
								$('#success').slideUp();
							} else {
								$('#error').html("Can't save records").slideDown();
								$('#success').slideUp();
							}
						}


					});
				}
			});
		});

	</script>
</body>

</html>
