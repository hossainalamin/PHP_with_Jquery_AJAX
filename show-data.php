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
			<td id="table-load">
				<button id="load-button">Load data</button>
			</td>
		</tr>
		<tr>
			<td id="table-data">
			</td>
		</tr>
	</table>
	<script src="js/jquery-3.5.1.min.js"></script>
	<script>
		$(document).ready(function() {
					$('#load-button').click(function(e) {
						$.ajax({
							url: "ajax -load.php",
							type: 'POST',
							success: function(data) {
								$('#table-data').html(data);
							}
						});
					});
		});

	</script>
</body>

</html>
