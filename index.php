<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
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
					<input type="submit" id="submit">
					Search:<input type="text" name="search" id="search">
				</form>
			</td>
		</tr>
		<tr>
			<td id="table-data">
			</td>
		</tr>
	</table>
	<div id="error"></div>
	<div id="success"></div>
	<div id="modal">
		<div id="modal-form">
			<h2>Edit Data</h2>
			<hr>
			<table>
			</table>
			<div id="close">X</div>
		</div>
	</div>
	<script src="js/jquery-3.5.1.min.js"></script>
	<script>
		$(document).ready(function() {
			//show data
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

			//insert
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

			//delete
			$(document).on("click", ".delete-btn", function() {
				var studentId = $(this).data('id');
				var element = this;
				$.ajax({
					url: 'ajax-delete.php',
					type: 'post',
					data: {
						id: studentId
					},
					success: function(data) {
						if (data == 1) {
							$(element).closest('tr').fadeOut();
						} else {
							$('#error').html("Data not deleted").slideDown();
							$('#success').slideUp();
						}
					}
				});
			});

			//show modal
			$(document).on("click", ".edit-btn", function() {
				$('#modal').show();
				var studentId = $(this).data('eid');
				$.ajax({
					url: 'ajax-update.php',
					type: 'post',
					data: {
						studentId: studentId
					},
					success: function(data) {
						$("#modal-form table").html(data);
					}
				});
			});

			//hide modal
			$("#close").on("click", function() {
				$('#modal').hide();
			});

			//update
			$(document).on("click", "#edit", function() {
				var stdntId = $('#id').val();
				var name = $('#edit-name').val();
				var email = $('#edit-email').val();
				var skill = $('#edit-skill').val();
				$.ajax({
					url: "update.php",
					type: "POST",
					data: {
						studentID: stdntId,
						name: name,
						email: email,
						skill: skill
					},
					success: function(data) {
						if (data == 1) {
							$('#modal').hide();
							TableLoad();
						} else {
							alert('not update');
						}
					}
				});
			});

			//live search 
			$("#search").on("keyup", function() {
				var search_term = $(this).val();
				$.ajax({
					url: "ajax-live-search.php",
					type: "post",
					data: {
						search: search_term
					},
					success: function(data) {
						$('#table-data').html(data);
					}
				})
			});

			//pagination
			function loadTable(page) {
				$.ajax({
					url: "ajax-pagination.php",
					type: "POST",
					data: {
						page_no: page
					},
					success: function(data) {
						$("#table-data").html(data);
					}
				});
			}
			loadTable();
			$(document).on("click", "#pagination a", function(e){
				e.preventDefault();
				var pageId = $(this).attr("id");
				loadTable(pageId);
			});

		});

	</script>
</body>

</html>
