<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHp & AJAX</title>
	<link rel="stylesheet" href="styles.css">
</head>

<body id="body">
	<div class="main">
		<div class="header">
			<h2>PHP AJAX form serialize</h2>
		</div>
		<div class="table-data">
			<form id="form">
				<table>
					<tr>
						<td>
							<lable>Name:</lable>
						</td>
						<td><input type="text" name="name" placeholder="Enter your name" id="name"></td>
					</tr>
					<tr>
						<td>
							<lable>Age:</lable>
						</td>
						<td><input type="text" name="age" placeholder="Enter your name" id="age"></td>
					</tr>
					<tr>
						<td>
							<lable>Gender:</lable>
						</td>
						<td><input type="radio" name="gender" value="male">Male
							<input type="radio" name="gender" value="female">Female
						</td>
					</tr>
					<tr>
						<td>
							<lable>Country:</lable>
						</td>
						<td>
							<select name="country" id="country">
								<option value="Bangladesh">Bangladesh</option>
								<option value="Pakistan">Pakistan</option>
								<option value="SriLanka">SriLanka</option>
								<option value="Nepal">Nepal</option>
							</select>
						</td>
					</tr>
					<tr>
						<td></td>
						<td><input type="button" value="submit" id="submit"></td>
					</tr>
				</table>
			</form>
		</div>
		<div class="response"></div>
	</div>
	<script src="js/jquery-3.5.1.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#submit').click(function(e) {
				var name = $('#name').val();
				var age = $('#age').val();
				if (name == "" || age == "" || !$('input:radio[name=gender]').is(':checked')) {
					$('.response').fadeIn();
					$('.response').removeClass('success').addClass('error').html("Any of the feild should not be empty");
				} else {
					$.ajax({
						url: "ajax-form.php",
						type: 'POST',
						data: $('#form').serialize(),
						beforesend: function() {
							$('.response').fadeIn();
							$('.response').removeClass('error').html("Loading");
						},
						success: function(data) {
							$('#form').trigger('reset');
							$('.response').fadeIn();
							$('.response').removeClass('error').addClass('success').html(data);
							setTimeout(function() {
								$('.response').fadeOut("slow");
							}, 4000);
						}
					});
				}
			});
		});

	</script>
</body>

</html>
